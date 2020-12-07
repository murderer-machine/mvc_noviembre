<?php

namespace alekas\models;

use alekas\core\Model;

class Usuarios extends Model {

    protected static $table = "t_usuarios";
    protected $id;
    protected $dni;
    protected $nombres;
    protected $apellidos;
    protected $correo;
    protected $password;
    protected $fecha_creacion;

    function __construct($id, $dni, $nombres, $apellidos, $correo, $password, $fecha_creacion) {
        $this->id = $id;
        $this->dni = $dni;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->password = $password;
        $this->fecha_creacion = $fecha_creacion;
    }

    static function getTable() {
        return self::$table;
    }

    function getId() {
        return $this->id;
    }

    function getDni() {
        return $this->dni;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getPassword() {
        return $this->password;
    }

    function getFecha_creacion() {
        return $this->fecha_creacion;
    }

    static function setTable($table) {
        self::$table = $table;
        return self;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setDni($dni) {
        $this->dni = $dni;
        return $this;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
        return $this;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
        return $this;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
        return $this;
    }

    function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    function setFecha_creacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
        return $this;
    }

}
