<?php

namespace alekas\models;

use alekas\core\Model;

class Marcas extends Model {

    protected static $table = "car_makes";
    protected $id;
    protected $marca;

    function __construct($id, $marca) {
        $this->id = $id;
        $this->marca = $marca;
    }

    function getId() {
        return $this->id;
    }

    function getMarca() {
        return $this->marca;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setMarca($marca) {
        $this->marca = $marca;
        return $this;
    }

}
