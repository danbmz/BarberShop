<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;

class AdminController{
    public static function dashboard(Router $router){

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechaSep = explode('-', $fecha);
        $isCorrect = checkdate($fechaSep[1], $fechaSep[2], $fechaSep[0]);
        
        if(!$isCorrect){
            header('Location: /404');
        }
        // Consultar la DB
        $datos = Admin::getCitasInfo($fecha);

        $router->render('admin/dashboard', [
            'datos'=> $datos,
            'fecha' => $fecha
        ]);
    }


}

