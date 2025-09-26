<?php

namespace Controllers;

use MVC\Router;

class AdminController{
    public static function dashboard(Router $router){
        $router->render('admin/dashboard');
    }
}

