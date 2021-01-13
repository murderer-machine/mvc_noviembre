<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use alekas\core\Aplicacion;
use alekas\controllers\cupones\Cupones_controller;
use alekas\controllers\empresas\EmpresasSeguros_controller;
use alekas\controllers\clientes\Clientes_controller;

$url = $_GET['alekas_url'] ?? "/";

$app = new Aplicacion($url, dirname(__DIR__));

//Rutas GET
$app->ruta->get('cupones/mostrar', [Cupones_controller::class, 'mostrar']);
$app->ruta->get('aseguradoras/mostrar', [EmpresasSeguros_controller::class, 'mostrar']);
$app->ruta->get('clientes/mostrar', [Clientes_controller::class, 'mostrar']);

$app->ruta->get('cupones/anularpoliza', [Cupones_controller::class, 'anularPoliza']);
$app->ruta->get('cupones/mostrarrespuesta', [Cupones_controller::class, 'mostarRespuestas']);

//Rutas POST
$app->ruta->post('cupones/agregarrespuesta', [Cupones_controller::class, 'agregarRespuesta']);
//Vistas
$app->ruta->get('/', 'ingreso');
$app->Run();




