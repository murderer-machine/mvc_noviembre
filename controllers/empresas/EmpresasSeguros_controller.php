<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace alekas\controllers\empresas;

use alekas\core\Controller;
use alekas\models\EmpresasSeguros;

/**
 * Class EmpresasSeguros
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class EmpresasSeguros_controller extends Controller {

    public function mostrar() {
        $empresas = EmpresasSeguros::select('id,nombre,ruc')->where([['activo', 1]])->run()->datos(true);
        return $empresas;
    }

}
