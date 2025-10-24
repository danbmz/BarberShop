<?php

namespace Controllers;

use MVC\Router;

class UserController{
    public static function account(Router $router){
        // session_start(); //Ya existe un session_start en el Router
        isAuth();

        $nombre = $_SESSION['nombre'] . " " . $_SESSION['apellido'];
        $router->render('user/account', [
            'nombre' => $nombre,
            'id' => $_SESSION['id']
        ]);
    }
}

