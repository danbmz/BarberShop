<?php

namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function login(Router $router){
        $router->render('auth/login');
    }
    public static function logout(){
        echo 'Desde logout...';
    }
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
                        header('Location: /message');
                    }

                    debuguear($email);
                }
            }
        }

        $router->render('auth/register', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function message(Router $router){
        $router->render('auth/message');
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
    public static function forgot(Router $router){
        $router->render('auth/forgot');
    }
    public static function sendResetLink(){
        echo 'Desde sendresetlink...';
    }
    public static function reset(Router $router){
        $router->render('auth/reset');
    }
    public static function updatePassword(){
        echo 'Desde update...';
    }
}