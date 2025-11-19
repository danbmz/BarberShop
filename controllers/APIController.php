<?php 

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Services;

class APIController{
    public static function index(){
        $servicios = Services::all();
        echo json_encode($servicios); //Transformamos en formato JSON
    }
    
    public static function post(){
        // Guardamos cita en tabla de citas
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        // Guardamos cita y servicios en tabla CitaServicios
        $idServicios = explode(",", $_POST['idService']);
        foreach($idServicios as $id){
            $args = [
                'citasId' => $resultado['id'],
                'serviciosId' => $id
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
        
        echo json_encode(['respuesta' => $resultado]);
    }
    public static function delete(){
        $id = $_POST['id'];
        $cita = Cita::find($id);
        $cita->eliminar();
        if ($cita) {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
    
    // Metodo que guarda nuevos registros de Servicios
    public static function saveServices(){
        $service = new Services($_POST);
        // Antes de guardar deberiamos realizar una validacion de los datos recibidos
        $resultado = $service->guardar();
        echo json_encode(['respuesta' => $resultado]);
    }
}
