<?php

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router){
        $router->render('auth/login');
    }
    public static function authenticate(){
        echo 'Desde authenticate...';
    }
    public static function logout(){
        echo 'Desde logout...';
    }
    public static function register(Router $router){

        $router->render('auth/register');
    }
    public static function store(){
        echo 'Desde store...';
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