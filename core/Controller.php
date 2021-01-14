<?php

namespace alekas\core;

use alekas\core\Session;

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

    public function VerificaSession() {
        Session::exist() ?: $this->redirect('/');
        exit;
    }

    public function VerificarSessionAuth() {
        !Session::exist() ?: $this->redirect('/ejemplo');
    }

    public function redirect($url) {
        echo'<script type="text/javascript">window.location.href="' . $url . '";</script>';
    }

}
