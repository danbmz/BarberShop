<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\HomeController;
use Controllers\UserController;
use Controllers\AdminController;
use Controllers\APIController;
use Controllers\ServiceController;
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
// Sub-rutas admin / Panel que muestra la lista de servicios
$router->get('/admin/services', [ServiceController::class, 'services']);

// API CITAS
// Listamos los servicios - User view
$router->get('/api/services', [APIController::class, 'index']);
// Crea - Actualiza y Elimina un servicio - Admin
$router->post('/api/services/create', [APIController::class, 'createServices']);
$router->post('/api/services/update', [APIController::class, 'updateService']);
$router->post('/api/services/delete', [APIController::class, 'deleteService']);
// Creamos y Elimina una cita - User view y Admin view
$router->post('/api/reservation/create', [APIController::class, 'createReservation']);
$router->post('/api/reservation/delete', [APIController::class, 'deleteReservation']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();