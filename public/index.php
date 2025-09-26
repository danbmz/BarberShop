<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\HomeController;
use Controllers\UserController;
use Controllers\AdminController;
use Controllers\APIController;
use MVC\Router;

$router = new Router();

// Rutas para pagina web - RUTAS PUBLICAS
$router->get('/', [HomeController::class, 'index']);
$router->get('/services', [HomeController::class, 'services']);
$router->get('/aboutUs', [HomeController::class, 'aboutUs']);
$router->get('/contact', [HomeController::class, 'contact']);

// Rutas para iniciar-cerrar sesion
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
// Crear nueva cuenta
$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);
// Confirmar cuenta
$router->get('/confirm-account', [LoginController::class, 'confirm']);
$router->get('/message', [LoginController::class, 'message']);

// Recuperar-resetear password  
$router->get('/forgot-password', [LoginController::class, 'forgot']);
$router->post('/forgot-password', [LoginController::class, 'forgot']);
$router->get('/reset-password', [LoginController::class, 'reset']);
$router->post('/reset-password', [LoginController::class, 'reset']);

// Panel de usuario y Panel Administrativo - RUTAS PRIVADAS
$router->get('/user/account', [UserController::class, 'account']);
$router->get('/admin', [AdminController::class, 'dashboard']);

// Sub-rutas usuario y admin
// $router->get('/user/reservas/actuales', [UserController::class, 'reservasActuales']);
// $router->get('/user/reservas/anteriores', [UserController::class, 'reservasAnteriores']);

// $router->get('/admin/usuarios', [AdminController::class, 'usuarios']);
// $router->get('/admin/reservas', [AdminController::class, 'reservas']);

// API CITAS
$router->get('/api/services', [APIController::class, 'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();