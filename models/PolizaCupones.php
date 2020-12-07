<?php

namespace alekas\models;

use alekas\core\Model;

class PolizaCupones extends Model {

    protected static $table = "t_polizas_documentos_cupones";
    protected $id;
    protected $id_documento;
    protected $nro_orden;
    protected $nro_cuota;
    protected $importe;
    protected $fecha_obligacion;
    protected $fecha_limite;
    protected $situacion;
    protected $fecha_pago;
    protected $observaciones;
    protected $revisado_general;

    function __construct($id, $id_documento, $nro_orden, $nro_cuota, $importe, $fecha_obligacion, $fecha_limite, $situacion, $fecha_pago, $observaciones, $revisado_general) {
        $this->id = $id;
        $this->id_documento = $id_documento;
        $this->nro_orden = $nro_orden;
        $this->nro_cuota = $nro_cuota;
        $this->importe = $importe;
        $this->fecha_obligacion = $fecha_obligacion;
        $this->fecha_limite = $fecha_limite;
        $this->situacion = $situacion;
        $this->fecha_pago = $fecha_pago;
        $this->observaciones = $observaciones;
        $this->revisado_general = $revisado_general;
    }

    function getId() {
        return $this->id;
    }

    function getId_documento() {
        return $this->id_documento;
    }

    function getNro_orden() {
        return $this->nro_orden;
    }

    function getNro_cuota() {
        return $this->nro_cuota;
    }

    function getImporte() {
        return $this->importe;
    }

    function getFecha_obligacion() {
        return $this->fecha_obligacion;
    }

    function getFecha_limite() {
        return $this->fecha_limite;
    }

    function getSituacion() {
        return $this->situacion;
    }

    function getFecha_pago() {
        return $this->fecha_pago;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getRevisado_general() {
        return $this->revisado_general;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setId_documento($id_documento) {
        $this->id_documento = $id_documento;
        return $this;
    }

    function setNro_orden($nro_orden) {
        $this->nro_orden = $nro_orden;
        return $this;
    }

    function setNro_cuota($nro_cuota) {
        $this->nro_cuota = $nro_cuota;
        return $this;
    }

    function setImporte($importe) {
        $this->importe = $importe;
        return $this;
    }

    function setFecha_obligacion($fecha_obligacion) {
        $this->fecha_obligacion = $fecha_obligacion;
        return $this;
    }

    function setFecha_limite($fecha_limite) {
        $this->fecha_limite = $fecha_limite;
        return $this;
    }

    function setSituacion($situacion) {
        $this->situacion = $situacion;
        return $this;
    }

    function setFecha_pago($fecha_pago) {
        $this->fecha_pago = $fecha_pago;
        return $this;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
        return $this;
    }

    function setRevisado_general($revisado_general) {
        $this->revisado_general = $revisado_general;
        return $this;
    }

}
