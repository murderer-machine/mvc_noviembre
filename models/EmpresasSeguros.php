<?php

namespace alekas\models;

use alekas\core\Model;

class EmpresasSeguros extends Model {

    protected static $table = "t_empresas_seguro";
    protected $id;
    protected $nombre;
    protected $ruc;
    protected $factor_general;
    protected $factor_soat;
    protected $gastos_emision;
    protected $gastos_emision_minimo;
    protected $gastos_emision_minimo_soat;
    protected $activo;
    protected $logo;

    function __construct($id, $nombre, $ruc, $factor_general, $factor_soat, $gastos_emision, $gastos_emision_minimo, $gastos_emision_minimo_soat, $activo, $logo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ruc = $ruc;
        $this->factor_general = $factor_general;
        $this->factor_soat = $factor_soat;
        $this->gastos_emision = $gastos_emision;
        $this->gastos_emision_minimo = $gastos_emision_minimo;
        $this->gastos_emision_minimo_soat = $gastos_emision_minimo_soat;
        $this->activo = $activo;
        $this->logo = $logo;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getRuc() {
        return $this->ruc;
    }

    function getFactor_general() {
        return $this->factor_general;
    }

    function getFactor_soat() {
        return $this->factor_soat;
    }

    function getGastos_emision() {
        return $this->gastos_emision;
    }

    function getGastos_emision_minimo() {
        return $this->gastos_emision_minimo;
    }

    function getGastos_emision_minimo_soat() {
        return $this->gastos_emision_minimo_soat;
    }

    function getActivo() {
        return $this->activo;
    }

    function getLogo() {
        return $this->logo;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setRuc($ruc) {
        $this->ruc = $ruc;
        return $this;
    }

    function setFactor_general($factor_general) {
        $this->factor_general = $factor_general;
        return $this;
    }

    function setFactor_soat($factor_soat) {
        $this->factor_soat = $factor_soat;
        return $this;
    }

    function setGastos_emision($gastos_emision) {
        $this->gastos_emision = $gastos_emision;
        return $this;
    }

    function setGastos_emision_minimo($gastos_emision_minimo) {
        $this->gastos_emision_minimo = $gastos_emision_minimo;
        return $this;
    }

    function setGastos_emision_minimo_soat($gastos_emision_minimo_soat) {
        $this->gastos_emision_minimo_soat = $gastos_emision_minimo_soat;
        return $this;
    }

    function setActivo($activo) {
        $this->activo = $activo;
        return $this;
    }

    function setLogo($logo) {
        $this->logo = $logo;
        return $this;
    }

}
