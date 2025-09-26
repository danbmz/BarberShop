<?php

namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router){

        $alertas = Usuario::getAlertas();
        $auth = new Usuario();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth->sincronizar($_POST);
            // 1. Verificar que existe
            $usuario = Usuario::where('email', $auth->email);
            if($usuario){
                // 2. Verificar que esta confirmado
                if($usuario->isConfirmed()){
                    // 3. Verificar credenciales
                    if($usuario->verifyPassword($auth->password)){
                        // 4. Autenticamos al ususario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        
                        // 5. Verificar si es Admin o Cliente
                        if ($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /user/account');
                        }
                    }
                }
            } else {
                Usuario::setAlerta('error', 'Correo no válido');
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }
    public static function logout(){
        echo 'Desde logout...';
    }
    // Funciones asociadas a la creacion de cuenta
    public static function register(Router $router){
        $usuario = new Usuario;
        $alertas = Usuario::getAlertas(); // Obtenemos el arreglo vacio

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST); // sincronizamos el $usuario vacio con los datos del POST
            $alertas = $usuario->validar();
            
            if (empty($alertas)) {
                $resultado = $usuario->verificarUsuario(); // Validamos si exista cuenta con el mismo correo
                if ($resultado->num_rows) { // Si existe, mostramos un mensaje
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hasheamos antes de registrar la cuenta
                    $usuario->hashPassword();
                    // Generamos token
                    $usuario->generarToken();
                    // Enviar correo para confirmar cuenta
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->confirmarEmail();
                    // Registrar usuario en la DB
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /message?type=0');
                    }
                }
            }
        }

        $router->render('auth/register', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function message(Router $router){
        $type = s($_GET['type']);

        $title0 = "Confirma tu cuenta";
        $mensaje0 = "¡Gracias por registrarte! Para completar tu registro y activar tu cuenta, hemos enviado un correo electrónico a la dirección que proporcionaste. Por favor, revisa tu bandeja de entrada y también la carpeta de spam o correo no deseado, y sigue el enlace que aparece en el mensaje para confirmar tu cuenta.";
        $title1 = "Reestablecer contraseña";
        $mensaje1 = "Hemos recibido tu solicitud para restablecer tu contraseña. Revisa tu correo electrónico, incluyendo la carpeta de spam o correo no deseado, para encontrar el mensaje con las instrucciones y el enlace para crear una nueva contraseña.";
        
        $router->render('auth/message', [
            'type' => $type,
            'title0' => $title0,
            'mensaje0' => $mensaje0,
            'title1' => $title1,
            'mensaje1' => $mensaje1
        ]);
    }
    public static function confirm(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        
        if (empty($usuario)) {
            // Si el token es invalido
            Usuario::setAlerta('error', 'Token no valido');
        } else {
            // Procedemos a cambiar el valor de confirmado y token
            $usuario->confirmado = "1";
            $usuario->token = '';
            $usuario->guardar();
            // Setear mensaje de exito
            Usuario::setAlerta('exito', 'Tu cuenta ha sido confirmada exitosamente, ahora puedes iniciar sesion');
        }

        // Recuperamos el arreglo para tener acceso a los mensajes que seteamos con setAlerta
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirm', [
            'alertas'=>$alertas
        ]);
    }
    // Funciones relacionadas a restableecer password
    public static function forgot(Router $router){
        $alertas = Usuario::getAlertas();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            // 1. Buscamos el correo en la DB
            $resultado = Usuario::where('email', $usuario->email);
            // 2. Si existe y esta confirmado...
            if ($resultado && $resultado->confirmado === "1") {
                $resultado->generarToken(); // 2.1 Generamos un nuevo token
                $resultado->guardar(); // 2.2 Actualizamos el registro en la DB con el nuevo token
                // 2.3 Instancionamos un objeto Email con los datos
                $email = new Email($resultado->email, $resultado->nombre, $resultado->token);
                // 2.4 Enviamos el Email
                $resultado = $email->sendPasswordResetEmail();
                // 2.5 Si se envió, redireccionamos
                if($resultado){
                    header('Location: /message?type=1');
                }
            } else {
                // 3. Si no, mostramos una alerta
                Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado.');
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/forgot', [
            'alertas' => $alertas,
        ]);
    }
    public static function reset(Router $router){
        $alertas = [];
        $error = false;
        // Obtenemos el token y buscamos en la DB
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        // Si no coincide, mostramos una alerta
        if (!$usuario) {
            Usuario::setAlerta('error','Token no válido');
            $error = true; 
        }
        // Cuando se envia el formulario...
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new Usuario($_POST); // Leer el nuevo password
            $alertas = $password->validatePassword(); // Validar
            if (empty($alertas)) {
                $password->hashPassword(); // Hasheamos
                $usuario->password = $password->password; // Reasignamos con el nuevo password
                $usuario->token = ''; // Eliminamos el token
                $resultado = $usuario->guardar(); // Actualizamos en la DB

                if ($resultado) {
                    header('Location: /login'); // Lo ideal seria mostrar una pestana confirmando el cambio y un boton para redirijir al login;
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/reset', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
}