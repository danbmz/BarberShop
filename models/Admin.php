<?php 
namespace Model;

class Admin extends ActiveRecord{
    protected static $tabla = "citasservicios";
    protected static $columnasDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio'];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public static function getCitasInfo($fecha){
        $query = "SELECT citas.id, citas.hora, 
        CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente,
        usuarios.email, usuarios.telefono, servicios.nombre as servicio , servicios.precio
        FROM citas 
        LEFT OUTER JOIN usuarios 
        ON citas.usuarioId=usuarios.id
        LEFT OUTER JOIN  citasservicios
        ON citasservicios.citasId=citas.id
        LEFT OUTER JOIN servicios
        ON servicios.id=citasservicios.serviciosId
        WHERE fecha = '$fecha'";

        $resultado = self::consultarSQL($query);
        return $resultado;
    }
}