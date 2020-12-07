<?php

namespace alekas\core;

/**
 * Class Controller
 * 
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@outlook.com>
 * @package app\core
 */
class Controller {

    public function render($vista, $parametros = []) {

        return Aplicacion::$app->ruta->vistaPlantilla($vista, $parametros);
    }

    public function json($datos) {
        return json_encode($datos, JSON_PRETTY_PRINT);
    }

}
