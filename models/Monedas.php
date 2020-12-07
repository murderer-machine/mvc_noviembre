<?php

namespace alekas\models;

use alekas\core\Model;

class Monedas extends Model {

    protected static $table = "t_monedas";
    protected $id;
    protected $nombre;
    protected $simbolo;

    function __construct($id, $nombre, $simbolo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->simbolo = $simbolo;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getSimbolo() {
        return $this->simbolo;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setSimbolo($simbolo) {
        $this->simbolo = $simbolo;
        return $this;
    }

}
