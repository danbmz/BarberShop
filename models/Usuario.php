<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }
    // Valida los campos del formulario de Registro
    public function validar(){
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Ingresa un nombre';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'Ingresa un apellido';
        }
        if (!$this->email || !preg_match('/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/', $this->email)) {
            self::$alertas['error'][] = 'Ingresa un correo válido';
        }
        if (!$this->telefono || !preg_match('/^\d{10}$/', $this->telefono)) {
            self::$alertas['error'][] = 'Ingresa un numero válido';
        }
        if (!$this->password || !preg_match('/^(?=.*\d).{6,}$/', $this->password)) {
            self::$alertas['error'][] = 'Ingresa al menos 6 caracteres incluido un numero';
        }
        return self::$alertas;
    }
    // Busca en la DB si ya hay un registro con el mismo correo
    public function verificarUsuario(){
        $query = "SELECT id FROM " . self::$tabla ." WHERE email = '". self::$db->escape_string($this->email) . "' LIMIT 1;";
        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'Ya existe una cuenta con este correo. Iniciar sesión o recupera tu contraseña';
        }
        return $resultado;
    }
    // Encriptar contrasena
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    // Genera un token unico
    public function generarToken(){
        $this->token = uniqid();
    }
    // Valida los campos del formulario Login
    public function validarLogin(){
        if (!$this->email || !$this->password) {
            self::$alertas['error'][] = 'Ingresa tus datos para iniciar sesión';
        }
        return self::$alertas;
    }
    // Verifica que se haya confirmado una cuenta
    public function isConfirmed(){
        if(!$this->confirmado){
            self::$alertas['error'][] = 'No haz confirmado tu cuenta';
            return false;
        }
        return true;
    }
    // Compara la contraseña escrita con la de la DB
    public function verifyPassword($password){
        $resultado = password_verify($password, $this->password);
        if (!$resultado) {
            self::$alertas['error'][] = 'Contraseña incorrecta';
        } 
        return $resultado;
    }
    // Valida el formato de la contrasena ingresada (formulario reset)
    public function validatePassword(){
        if (!preg_match('/^(?=.*\d).{6,}$/', $this->password)) {
            self::$alertas['error'][] = 'Ingresa al menos 6 caracteres incluido un numero';
        }
        return self::$alertas;
    }
}

