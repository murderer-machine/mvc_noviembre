<?php

namespace alekas\core;

use alekas\corelib\FechaHora;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Class Aplicacion
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class Aplicacion {

    public static Aplicacion $app;
    public static string $root;
    public static string $root_principal;
    public Request $request;
    public Ruta $ruta;
    public Controller $controller;
    public Session $session;
    private static Headers $header;
    private static FechaHora $fechaHora;

    public function __construct($root, $root_principal) {
        self::$header = new Headers();
        self::$fechaHora = new FechaHora();
        self::$root = $root;
        self::$root_principal = $root_principal;
        self::$app = $this;
        $this->session = new Session();
        $this->request = new Request(self::$root);
        $this->ruta = new Ruta($this->request, $this->session);
        require "$root_principal/corelib/VariablesGlobales.php";
    }

    public function Run() {
        echo $this->ruta->Resolver();
    }

}
