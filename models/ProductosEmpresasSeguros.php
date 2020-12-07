<?php

namespace alekas\models;

use alekas\core\Model;

class ProductosEmpresasSeguros extends Model {

    protected static $table = "t_productos_empresas_seguros";
    protected $id;
    protected $nombre;
    protected $id_empresas_seguro;
    protected $id_ramo;
    protected $comision;

    function __construct($id, $nombre, $id_empresas_seguro, $id_ramo, $comision) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->id_empresas_seguro = $id_empresas_seguro;
        $this->id_ramo = $id_ramo;
        $this->comision = $comision;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getId_empresas_seguro() {
        return $this->id_empresas_seguro;
    }

    function getId_ramo() {
        return $this->id_ramo;
    }

    function getComision() {
        return $this->comision;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setId_empresas_seguro($id_empresas_seguro) {
        $this->id_empresas_seguro = $id_empresas_seguro;
        return $this;
    }

    function setId_ramo($id_ramo) {
        $this->id_ramo = $id_ramo;
        return $this;
    }

    function setComision($comision) {
        $this->comision = $comision;
        return $this;
    }

}
