<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use alekas\core\Aplicacion;
use alekas\controllers\cupones\Cupones_controller;
use alekas\controllers\empresas\EmpresasSeguros_controller;
use alekas\controllers\clientes\Clientes_controller;
use alekas\controllers\auth\SessionController;
use alekas\core\Session;
use alekas\core\Controller;

$url = $_GET['alekas_url'] ?? "/";

$app = new Aplicacion($url, dirname(__DIR__));

//Rutas GET
//
$app->ruta->get('cupones/mostrar', [Cupones_controller::class, 'mostrar']);
$app->ruta->get('aseguradoras/mostrar', [EmpresasSeguros_controller::class, 'mostrar']);
$app->ruta->get('clientes/mostrar', [Clientes_controller::class, 'mostrar']);
$app->ruta->get('cupones/anularpoliza', [Cupones_controller::class, 'anularPoliza']);
$app->ruta->get('cupones/mostrarrespuesta', [Cupones_controller::class, 'mostarRespuestas']);
$app->ruta->get('logout', [SessionController::class, 'logout']);

//Rutas POST
$app->ruta->post('cupones/agregarrespuesta', [Cupones_controller::class, 'agregarRespuesta']);
$app->ruta->post('login', [SessionController::class, 'login']);

//Vistas
$app->ruta->get('/', 'ingreso');
$app->ruta->get('ejemplo', 'inicio');

//Funciones
/* $app->ruta->get('ejemplo', function() {
  echo 'soy ejemplo';
  $respuesta = new Controller();
  $respuesta->VerificaSession();
  Session::imprimirSession();

  }); */

$app->Run();




