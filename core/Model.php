<?php

namespace alekas\core;

use PDO;
use PDOException;
use alekas\core\Database;
use ReflectionMethod;
use ReflectionClass;

class Model {

    private static $db;
    protected static $consulta = '';
    protected static $array_consulta = array();
    protected static $data;

    function __construct() {
        self::conexion();
    }

    public static function conexion() {
        try {
            self::$db = new Database(
                    $_ENV['_DB_TYPE'],
                    $_ENV['MODO'] === 'prod' ? $_ENV['_DB_HOST_PROD'] : $_ENV['_DB_HOST_DEV'],
                    $_ENV['MODO'] === 'prod' ? $_ENV['_DB_NAME_PROD'] : $_ENV['_DB_NAME_DEV'],
                    $_ENV['MODO'] === 'prod' ? $_ENV['_DB_USER_PROD'] : $_ENV['_DB_USER_DEV'],
                    $_ENV['MODO'] === 'prod' ? $_ENV['_DB_PASS_PROD'] : $_ENV['_DB_PASS_DEV']);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage();
            die();
        }
    }

    public static function select($campos = '*') {
        self::$consulta = "SELECT $campos FROM " . static::$table;
        return new self;
    }

    public static function where($datos, $condicion2 = 'AND') {
        foreach ($datos as $dato) {
            $logica = count($dato) === 2 ? '=' : $dato[2];
            $condicion = strpos(self::$consulta, "WHERE");
            $var = $condicion ? $condicion2 : "WHERE";
            self::$consulta = self::$consulta . " $var $dato[0] $logica '" . addslashes($dato[1]) . "'";
        }
        return new self;
    }

    public static function orWhere($datos) {
        return self::where($datos, 'OR');
    }

    public static function run($consulta = false) {
        try {
            $resultado = self::$db->select(self::$consulta, self::$array_consulta);
        } catch (PDOException $e) {
            $resultado = $e->getMessage();
        }
        self::$data = $resultado;
        echo $consulta ? '<pre>' . self::$consulta . '</pre>' : '';
        return new self;
    }

    public static function datos($json = false) {
        return !$json ? self::$data : json_encode(self::$data, JSON_PRETTY_PRINT);
    }

    public function create() {
        self::conexion();
        $values = get_object_vars($this);
        $result = self::$db->insert(static::$table, $values);
        if ($result) {
            $response = array(
                'error' => 0,
                'getID' => self::$db->lastInsertId(),
                'msg' => get_class($this) . ' Created'
            );
            $this->setId(self::$db->lastInsertId());
        } else {
            $response = array(
                'error' => 1,
                'msg' => 'Error ' . $result
            );
        }
        return $response;
    }

    public static function getById($id) {
        $whereReturn = self::select()->where([['id', $id]])->run()->datos();
        $data = $whereReturn[0] ?? array();
        if (count($data) === 0) {
            echo 'no existe el id';
            die();
        } else {
            $result = self::instanciate($data);
            return $result;
        }
    }

    public static function instanciate($args) {
        if (count($args) > 0) {
            $refMethod = new ReflectionMethod(get_called_class(), '__construct');
            $params = $refMethod->getParameters();
            $re_args = array();
            foreach ($params as $key => $param) {
                if ($param->isPassedByReference()) {
                    $re_args[$param->getName()] = &$args[$param->getName()]; // por revisar
                } else {
                    $re_args[$param->getName()] = $args[$param->getName()];
                }
            }
            $refClass = new ReflectionClass(get_called_class());
            return $refClass->newInstanceArgs((array) $re_args);
        }
    }

    public function update($field = "id", $value = null) {
        self::conexion();
        $values = get_object_vars($this);
        $value = ($value == null) ? $values["id"] : $value;
        $result = self::$db->update(static::$table, $values, $field . " = " . $value);
        if ($result) {
            $response = array(
                'error' => 0,
                'msg' => get_class($this) . ' Updated'
            );
        } else {
            $response = array(
                'error' => 1,
                'msg' => 'Error ' . $result
            );
        }
        return $response;
    }

    public static function delete(Request $request) {
        $result = self::$db->delete(static::$table, "id = " . $request->parametros()['id']);
        if ($result) {
            $result = array(
                'error' => 0,
                'message' => 'Objeto Eliminado'
            );
        } else {
            $result = array(
                'error' => 1,
                'message' => self::$db->getError()
            );
        }
        return $result;
    }

    public static function setDataCreate($parametros) {
        $parametros = (json_decode(json_encode($parametros), true));
        $result = self::instanciate($parametros);
        return $result;
    }

    public function setDataUpdate($parametros) {
        $parametros = (json_decode(json_encode($parametros), true));
        foreach ($parametros as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function join($table, $argumento_a, $operador, $argumento_b) {
        self::$consulta = self::$consulta . " INNER JOIN $table ON $argumento_a $operador $argumento_b";
        return new self;
    }

    public function orderBy($datos) {
        self::$consulta = self::$consulta . " ORDER BY ";
        $count = count($datos) - 1;
        foreach ($datos as $key => $dato) {
            $condicion = $count === $key ? '' : ',';
            self::$consulta = self::$consulta . "$dato[0] $dato[1]$condicion";
        }
        return new self;
    }

    public function limit($numero) {
        self::$consulta = self::$consulta . " LIMIT $numero";
        return new self;
    }

}
