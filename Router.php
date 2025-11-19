<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        // Proteger Rutas de Admin...
        session_start(); // Activa erl session de manera global, todas las paginas pueden acceder al session;
        $admin = $_SESSION['admin'] ?? null;
        // Arreglo de rutas protegidas...
        $rutas_protegidas = ['/admin', '/api/delete', '/admin/services', '/admin/services/create'];

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        // 5. Restringimos el acceso a las rutas protegidas
        if(in_array($currentUrl, $rutas_protegidas) && !$admin){
            header('Location: /');
        }

        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            call_user_func($fn, $this); // This es para pasar argumentos
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {   
        // Variables para mostrar el nombre en todas las pagina cuando se ha iniciado sesion.
        $datos['isLoggedIn'] = $_SESSION['login'] ?? null; // Insertamos dentro de $datos para menor dispersion de variables
        $datos['isAdmin'] = $_SESSION['admin'] ?? null;
        $datos['nombreUsuario'] = $_SESSION['nombre'] ?? null;

        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            if (in_array($key, ['contenido'])) continue; //Evita reescribir la variable $contenido en caso de venir una con el mismo nombre
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}
