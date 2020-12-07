<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace alekas\controllers;

use alekas\core\Controller;
use alekas\models\Clientes;

/**
 * Class Clientes_controller
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class Clientes_controller extends Controller {

    public function mostrar() {
        $clientes = Clientes::select('id,nombre,nrodoc')->run()->datos(true);
        return $clientes;
    }

}
