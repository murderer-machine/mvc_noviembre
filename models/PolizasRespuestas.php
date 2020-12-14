<?php

namespace alekas\models;

use alekas\core\Model;

class PolizasRespuestas extends Model {

    protected static $table = "t_polizas_comentarios_respuestas";
    protected $id = null;
    protected $id_poliza_comentario;
    protected $comentario;
    protected $fecha_hora = fecha_hora;
    protected $id_usuario = 0;

    function __construct($id_poliza_comentario, $comentario) {
        $this->id_poliza_comentario = $id_poliza_comentario;
        $this->comentario = $comentario;
    }

    function getId() {
        return $this->id;
    }

    function getId_poliza_comentario() {
        return $this->id_poliza_comentario;
    }

    function getComentario() {
        return $this->comentario;
    }

    function getFecha_hora() {
        return $this->fecha_hora;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setId_poliza_comentario($id_poliza_comentario): void {
        $this->id_poliza_comentario = $id_poliza_comentario;
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
