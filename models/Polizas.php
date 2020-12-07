<?php

namespace alekas\models;

use alekas\core\Model;

class Polizas extends Model {

    protected static $table = 't_polizas';
    protected $id;
    protected $nro_poliza;
    protected $nro_poliza_corregido;
    protected $id_cliente;
    protected $id_empresa;
    protected $id_producto;
    protected $id_ramo;
    protected $moneda;
    protected $descripcion;
    protected $endoso_a_favor;
    protected $anulada;
    protected $fecha_creado;
    protected $id_creado;

    function __construct($id, $nro_poliza, $nro_poliza_corregido, $id_cliente, $id_empresa, $id_producto, $id_ramo, $moneda, $descripcion, $endoso_a_favor, $anulada, $fecha_creado, $id_creado) {
        $this->id = $id;
        $this->nro_poliza = $nro_poliza;
        $this->nro_poliza_corregido = $nro_poliza_corregido;
        $this->id_cliente = $id_cliente;
        $this->id_empresa = $id_empresa;
        $this->id_producto = $id_producto;
        $this->id_ramo = $id_ramo;
        $this->moneda = $moneda;
        $this->descripcion = $descripcion;
        $this->endoso_a_favor = $endoso_a_favor;
        $this->anulada = $anulada;
        $this->fecha_creado = $fecha_creado;
        $this->id_creado = $id_creado;
    }

    function getId() {
        return $this->id;
    }

    function getNro_poliza() {
        return $this->nro_poliza;
    }

    function getNro_poliza_corregido() {
        return $this->nro_poliza_corregido;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function getId_empresa() {
        return $this->id_empresa;
    }

    function getId_producto() {
        return $this->id_producto;
    }

    function getId_ramo() {
        return $this->id_ramo;
    }

    function getMoneda() {
        return $this->moneda;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getEndoso_a_favor() {
        return $this->endoso_a_favor;
    }

    function getAnulada() {
        return $this->anulada;
    }

    function getFecha_creado() {
        return $this->fecha_creado;
    }

    function getId_creado() {
        return $this->id_creado;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNro_poliza($nro_poliza) {
        $this->nro_poliza = $nro_poliza;
        return $this;
    }

    function setNro_poliza_corregido($nro_poliza_corregido) {
        $this->nro_poliza_corregido = $nro_poliza_corregido;
        return $this;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
        return $this;
    }

    function setId_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
        return $this;
    }

    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
        return $this;
    }

    function setId_ramo($id_ramo) {
        $this->id_ramo = $id_ramo;
        return $this;
    }

    function setMoneda($moneda) {
        $this->moneda = $moneda;
        return $this;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        return $this;
    }

    function setEndoso_a_favor($endoso_a_favor) {
        $this->endoso_a_favor = $endoso_a_favor;
        return $this;
    }

    function setAnulada($anulada) {
        $this->anulada = $anulada;
        return $this;
    }

    function setFecha_creado($fecha_creado) {
        $this->fecha_creado = $fecha_creado;
        return $this;
    }

    function setId_creado($id_creado) {
        $this->id_creado = $id_creado;
        return $this;
    }

}
