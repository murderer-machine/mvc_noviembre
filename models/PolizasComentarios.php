<?php

namespace alekas\models;

use alekas\core\Model;

class PolizasComentarios extends Model {

    protected static $table = "t_polizas_comentarios";
    protected $id = null;
    protected $id_poliza;
    protected $comentario;
    protected $fecha_hora;
    protected $id_usuario;

    function __construct($id_poliza, $comentario) {
        $this->id_poliza = $id_poliza;
        $this->comentario = $comentario;
        $this->id = null;
        $this->fecha_hora = fecha_hora;
        $this->id_usuario = 0;
    }

    function getId() {
        return $this->id;
    }

    function getId_poliza() {
        return $this->id_poliza;
    }

    function getComentario() {
        return $this->comentario;
    }

    function getFecha_hora() {
        return $this->fecha_hora;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setId_poliza($id_poliza): void {
        $this->id_poliza = $id_poliza;
    }

    function setComentario($comentario): void {
        $this->comentario = $comentario;
    }

    function setFecha_hora($fecha_hora): void {
        $this->fecha_hora = $fecha_hora;
    }

    function setId_usuario($id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

}
