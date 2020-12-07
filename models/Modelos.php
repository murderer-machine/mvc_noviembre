<?php

namespace alekas\models;

use alekas\core\Model;

class Modelos extends Model {

    protected static $table = "car_models";
    protected $id;
    protected $modelo;
    protected $id_marca;

    function __construct($id, $modelo, $id_marca) {
        $this->id = $id;
        $this->modelo = $modelo;
        $this->id_marca = $id_marca;
    }

    function getId() {
        return $this->id;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getId_marca() {
        return $this->id_marca;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
        return $this;
    }

    function setId_marca($id_marca) {
        $this->id_marca = $id_marca;
        return $this;
    }

}
