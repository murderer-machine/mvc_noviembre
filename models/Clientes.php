<?php

namespace alekas\models;

use alekas\core\Model;

class Clientes extends Model {

    protected static $table = "t_clientes";
    protected $id;
    protected $nombre;
    protected $id_tipodoc;
    protected $nrodoc;
    protected $id_giro_negocio;
    protected $direccion;
    protected $referencia;
    protected $id_ubigeo;
    protected $fecha_creacion;
    protected $id_subagente;
    protected $eliminado_logico;

    function __construct($id, $nombre, $id_tipodoc, $nrodoc, $id_giro_negocio, $direccion, $referencia, $id_ubigeo, $fecha_creacion, $id_subagente, $eliminado_logico) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->id_tipodoc = $id_tipodoc;
        $this->nrodoc = $nrodoc;
        $this->id_giro_negocio = $id_giro_negocio;
        $this->direccion = $direccion;
        $this->referencia = $referencia;
        $this->id_ubigeo = $id_ubigeo;
        $this->fecha_creacion = $fecha_creacion;
        $this->id_subagente = $id_subagente;
        $this->eliminado_logico = $eliminado_logico;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getId_tipodoc() {
        return $this->id_tipodoc;
    }

    function getNrodoc() {
        return $this->nrodoc;
    }

    function getId_giro_negocio() {
        return $this->id_giro_negocio;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getReferencia() {
        return $this->referencia;
    }

    function getId_ubigeo() {
        return $this->id_ubigeo;
    }

    function getFecha_creacion() {
        return $this->fecha_creacion;
    }

    function getId_subagente() {
        return $this->id_subagente;
    }

    function getEliminado_logico() {
        return $this->eliminado_logico;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setId_tipodoc($id_tipodoc) {
        $this->id_tipodoc = $id_tipodoc;
        return $this;
    }

    function setNrodoc($nrodoc) {
        $this->nrodoc = $nrodoc;
        return $this;
    }

    function setId_giro_negocio($id_giro_negocio) {
        $this->id_giro_negocio = $id_giro_negocio;
        return $this;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
        return $this;
    }

    function setReferencia($referencia) {
        $this->referencia = $referencia;
        return $this;
    }

    function setId_ubigeo($id_ubigeo) {
        $this->id_ubigeo = $id_ubigeo;
        return $this;
    }

    function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
        return $this;
    }

    function setId_subagente($id_subagente) {
        $this->id_subagente = $id_subagente;
        return $this;
    }

    function setEliminado_logico($eliminado_logico) {
        $this->eliminado_logico = $eliminado_logico;
        return $this;
    }

}
