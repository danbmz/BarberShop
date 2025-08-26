<?php
namespace Controllers;
use MVC\Router;

class HomeController{
    public static function index(Router $router){
        $router->render('main/index');
    }
    public static function services(Router $router){
        $router->render('main/services');
    }
    public static function aboutUs(Router $router){
        $router->render('main/aboutUs');
    }
    public static function contact(Router $router){
        $router->render('main/contact');
    }
}