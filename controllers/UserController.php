<?php

namespace Controllers;

use MVC\Router;

class UserController{
    public static function account(Router $router){
        // session_start(); //Ya existe un session_start en el Router

        // debuguear($_SESSION);
        $router->render('user/account', [
            'nombre' => $_SESSION['nombre']
        ]);
    }
}

