<?php

namespace alekas\models;

use alekas\core\Model;

class PolizasVehiculos extends Model {

    protected static $table = "t_polizas_vehiculos";
    protected $id;
    protected $id_poliza;
    protected $placa;
    protected $clase;
    protected $uso;
    protected $categoria;
    protected $marca;
    protected $modelo;
    protected $ano;
    protected $nro_asientos;
    protected $nro_pasajeros;
    protected $nro_serie;
    protected $motor;
    protected $color;
    protected $timon;
    protected $combustible;
    protected $carroceria;

    function __construct($id, $id_poliza, $placa, $clase, $uso, $categoria, $marca, $modelo, $ano, $nro_asientos, $nro_pasajeros, $nro_serie, $motor, $color, $timon, $combustible, $carroceria) {
        $this->id = $id;
        $this->id_poliza = $id_poliza;
        $this->placa = $placa;
        $this->clase = $clase;
        $this->uso = $uso;
        $this->categoria = $categoria;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->nro_asientos = $nro_asientos;
        $this->nro_pasajeros = $nro_pasajeros;
        $this->nro_serie = $nro_serie;
        $this->motor = $motor;
        $this->color = $color;
        $this->timon = $timon;
        $this->combustible = $combustible;
        $this->carroceria = $carroceria;
    }

    function getId() {
        return $this->id;
    }

    function getId_poliza() {
        return $this->id_poliza;
    }

    function getPlaca() {
        return $this->placa;
    }

    function getClase() {
        return $this->clase;
    }

    function getUso() {
        return $this->uso;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getAno() {
        return $this->ano;
    }

    function getNro_asientos() {
        return $this->nro_asientos;
    }

    function getNro_pasajeros() {
        return $this->nro_pasajeros;
    }

    function getNro_serie() {
        return $this->nro_serie;
    }

    function getMotor() {
        return $this->motor;
    }

    function getColor() {
        return $this->color;
    }

    function getTimon() {
        return $this->timon;
    }

    function getCombustible() {
        return $this->combustible;
    }

    function getCarroceria() {
        return $this->carroceria;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setId_poliza($id_poliza) {
        $this->id_poliza = $id_poliza;
        return $this;
    }

    function setPlaca($placa) {
        $this->placa = $placa;
        return $this;
    }

    function setClase($clase) {
        $this->clase = $clase;
        return $this;
    }

    function setUso($uso) {
        $this->uso = $uso;
        return $this;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }

    function setMarca($marca) {
        $this->marca = $marca;
        return $this;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
        return $this;
    }

    function setAno($ano) {
        $this->ano = $ano;
        return $this;
    }

    function setNro_asientos($nro_asientos) {
        $this->nro_asientos = $nro_asientos;
        return $this;
    }

    function setNro_pasajeros($nro_pasajeros) {
        $this->nro_pasajeros = $nro_pasajeros;
        return $this;
    }

    function setNro_serie($nro_serie) {
        $this->nro_serie = $nro_serie;
        return $this;
    }

    function setMotor($motor) {
        $this->motor = $motor;
        return $this;
    }

    function setColor($color) {
        $this->color = $color;
        return $this;
    }

    function setTimon($timon) {
        $this->timon = $timon;
        return $this;
    }

    function setCombustible($combustible) {
        $this->combustible = $combustible;
        return $this;
    }

    function setCarroceria($carroceria) {
        $this->carroceria = $carroceria;
        return $this;
    }

}
