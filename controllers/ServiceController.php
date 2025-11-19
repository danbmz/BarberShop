<?php 
namespace Controllers;

use Model\Services;
use MVC\Router;

class ServiceController{
    public static function services( Router $router){
        $servicios = Services::all();
        
        $router->render('admin/services', [
            'servicios' => $servicios
        ]);
    }
    public static function create(Router $router){
        debuguear($_POST);

        $router->render('admin/crearServicio');
    }
    public static function update(){
    }
    public static function delete(){
    }
}