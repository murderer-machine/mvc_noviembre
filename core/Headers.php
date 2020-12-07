<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace alekas\core;

/**
 * Class Headers
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class Headers {
    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,application/json");
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        header('Cache-Control: no-cache');
        header('Pragma: no-cache');
    }
}
