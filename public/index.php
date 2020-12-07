<?php

require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use alekas\core\Aplicacion;
use alekas\controllers\Cupones_controller;
use alekas\controllers\EmpresasSeguros_controller;
use alekas\controllers\Clientes_controller;

$url = $_GET['alekas_url'] ?? "/";

$app = new Aplicacion($url, dirname(__DIR__));

//Api
$app->ruta->get('cupones/mostrar', [Cupones_controller::class, 'mostrar']);
$app->ruta->get('aseguradoras/mostrar', [EmpresasSeguros_controller::class, 'mostrar']);
$app->ruta->get('clientes/mostrar', [Clientes_controller::class, 'mostrar']);

$app->ruta->get('cupones/anularpoliza', [Cupones_controller::class, 'anularPoliza']);

//Vistas
$app->ruta->get('/', 'cupones');

$app->Run();




