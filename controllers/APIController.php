<?php 

namespace Controllers;

use Model\Services;

class APIController{
    public static function index(){
        $servicios = Services::all();
        echo json_encode($servicios); //Transformamos en formato JSON
    }
}
