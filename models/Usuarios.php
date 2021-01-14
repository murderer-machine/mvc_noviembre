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
    protected $fecha_creacion = fecha;

    function __construct($id, $dni, $nombres, $apellidos, $correo, $password) {
        $this->id = $id;
        $this->dni = $dni;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->password = $password;
        $this->fecha_creacion = $fecha_creacion;
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

    function setId($id): void {
        $this->id = $id;
    }

    function setDni($dni): void {
        $this->dni = $dni;
    }

    function setNombres($nombres): void {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    function setCorreo($correo): void {
        $this->correo = $correo;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setFecha_creacion($fecha_creacion): void {
        $this->fecha_creacion = $fecha_creacion;
    }

}
