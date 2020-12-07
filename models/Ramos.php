<?php

namespace alekas\models;

use alekas\core\Model;

class Ramos extends Model {

    protected static $table = "t_ramos";
    protected $id;
    protected $descripcion;

    function __construct($id, $descripcion) {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    function getId() {
        return $this->id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

}
