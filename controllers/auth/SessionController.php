<?php

namespace alekas\controller\auth;

use alekas\core\Aplicacion;
use alekas\core\Controller;
use alekas\core\Session;
use alekas\corelib\GenerarToken;
use alekas\core\Request;
use alekas\models\UsuariosGenerales;

class SessionGeneralesController extends Controller {

    public function login(Request $request) {
        $token = new GenerarToken();
        $datos = $request->parametrosJson();
        $datos->password = $token->TokenUnico($datos->password);
        $usuario = UsuariosGenerales::select()->where([["correo", $datos->correo], ["password", $datos->password]])->run()->datos();
        if (!empty($usuario)) {
            Session::inicio($datos->recordar);
            Session::setValue('id', $usuario[0]["id"]);
            return $this->json($resultado["error"] = 1);
        } else {
            $usuario = UsuariosGenerales::select()->where([["correo", $datos->correo]])->run()->datos();
            return empty($usuario) ? $this->json($resultado["error"] = 2) : $this->json($resultado["error"] = 3);
        }
    }

    public function logout() {
        return Session::destroy() ? $this->json($resultado["error"] = 1) : $this->json($resultado["error"] = 0);
    }
    

}
