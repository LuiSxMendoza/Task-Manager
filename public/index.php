<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\PanelController;
use Controllers\TareaController;
use MVC\Router;
$router = new Router();

//! Iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//! Recuperar cuenta
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//! Registrar usuario
$router->get('/registrar', [LoginController::class, 'registrar']);
$router->post('/registrar', [LoginController::class, 'registrar']);

//! Confirmar cuenta
$router->get('/confirma', [LoginController::class, 'confirma']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

//TODO: Area privada
$router->get('/index', [PanelController::class, 'index']);
$router->get('/crear-proyecto', [PanelController::class, 'crear']);
$router->post('/crear-proyecto', [PanelController::class, 'crear']);
$router->get('/proyecto', [PanelController::class, 'proyecto']);
$router->post('/proyecto', [PanelController::class, 'eliminar']);
$router->get('/perfil', [PanelController::class, 'perfil']);
$router->post('/perfil', [PanelController::class, 'perfil']);
$router->get('/upd-pswrd', [PanelController::class, 'updpswrd']);
$router->post('/upd-pswrd', [PanelController::class, 'updpswrd']);

//? API para las tareas
$router->get('/api/tareas', [TareaController::class, 'index']);
$router->post('/api/tarea', [TareaController::class, 'crear']);
$router->post('/api/actualizar', [TareaController::class, 'actualizar']);
$router->post('/api/eliminar', [TareaController::class, 'eliminar']);

//? Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();