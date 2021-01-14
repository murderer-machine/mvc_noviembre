<?php

namespace alekas\controllers\auth;

use alekas\core\Aplicacion;
use alekas\core\Controller;
use alekas\core\Session;
use alekas\corelib\GenerarToken;
use alekas\core\Request;
use alekas\models\Usuarios;

class SessionController extends Controller {
  
    public function login(Request $request) {
        $token = new GenerarToken();
        $datos = $request->parametrosJson();
        $datos->password = $token->TokenUnico($datos->password);
        $usuario = Usuarios::select()->where([["dni", $datos->dni], ["password", $datos->password]])->run()->datos();
        if (!empty($usuario)) {
            Session::inicio($datos->recordar);
            Session::setValue('id', $usuario[0]["id"]);
            return $this->json($resultado["error"] = 1);
        } else {
            return $this->json($resultado["error"] = 0);
        }
    }

    public function logout() {
        Session::destroy();
        header("Location: /");
    }

}
