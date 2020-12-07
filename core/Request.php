<?php

namespace alekas\core;

/**
 * Class Request
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class Request {

    public $root;
    public array $parametros;

    public function __construct($root) {
        $this->root = $root;
        $this->parametros = [];
    }

    public function getPath() {
        $url = explode("/", $this->root);
        if (count($url) >= 3) {
            for ($i = 2; $i < count($url); $i++) {
                array_push($this->parametros, $url[$i]);
            }
            $this->parametros = array_filter($this->parametros);
        }
       
        if (count($url) === 1) {
            return $url[0];
        }
        if (count($url) === 2 || count($url) >= 3) {
            return "$url[0]/$url[1]";
        }
    }

    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet() {
        return $this->getMethod() === 'get';
    }

    public function isPost() {
        return $this->getMethod() === 'post';
    }

    public function parametrosUrl() {
        return $this->parametros;
    }

    public function parametrosJson() {
        $raw = file_get_contents("php://input");
        $data = json_decode($raw);
        if (is_null($data)) {
            return ("json inválido");
        } else {
            return ($data);
        }
    }

    public function parametros() {
        $data = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        unset($data['alekas_url']);
        return $data;
    }

}
