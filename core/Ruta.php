<?php

namespace alekas\core;

/**
 * Class Ruta
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class Ruta {

    private Request $request;
    private Session $session;
    private array $ruta;
 

    public function __construct(Request $request, Session $session) {
        
        $this->request = $request;
        $this->session = $session;
        
    }

    public function get(string $path, $callback) {

        $this->ruta['get'][$path] = $callback;
    }

    public function post(string $path, $callback) {
        $this->ruta['post'][$path] = $callback;
    }

    public function Resolver() {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->ruta[$method][$path] ?? false;
        if (!$callback) {
            return $this->vista('_404');
        }
        if (is_string($callback)) {
            if ($this->verificaVista($callback)) {
                return $this->vistaPlantilla($callback);
            }
            return "no existe vista <b>$callback</b>";
        }
        if (is_array($callback)) {
            Aplicacion::$app->controller = new $callback[0]();
            $callback[0] = Aplicacion::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }

    public function vistaPlantilla(string $nombre_vista, array $parametros = []) {
      
        $vista = $this->vista($nombre_vista, $parametros);
        if (preg_match("/\@plantilla\(\'([A-Za-z]+?)\'\)/", $vista, $out_archivo_plantilla) || preg_match("/\@plantilla\(\'\'\)/", $vista, $out_archivo_plantilla)) {
            $out_archivo_plantilla = $out_archivo_plantilla[1] ?? 'vacia';
            if ($this->verificaPlantilla($out_archivo_plantilla)) {
                $plantilla = $this->plantilla($out_archivo_plantilla);
            } else {
                return "no existe plantilla <b>" . $out_archivo_plantilla . "</b>";
            }
        } else {
            return $vista;
        }
        preg_match_all("/\@bloque\(\'([A-Za-z0-9 ]+?)\'\)/", $plantilla, $out);
        foreach ($out[1] as $key => $value) {
            if (preg_match("/\@bloque\(\'" . $out[1][$key] . "\'\)((.*[\s])+?)\@fin/", $vista, $out_vista)) {
                $plantilla = str_replace($out[0][$key], $out_vista[1], $plantilla);
            } else {
                $plantilla = str_replace($out[0][$key], '', $plantilla);
            }
        }
        return $plantilla;
    }

    protected function vista(string $nombre_vista, array $parametros = []) {
      
        foreach ($parametros as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Aplicacion::$root_principal . "/views/$nombre_vista.php";
        return ob_get_clean();
    }

    protected function plantilla($nombre_plantilla, array $parametros = []) {
        foreach ($parametros as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Aplicacion::$root_principal . "/views/plantilla/$nombre_plantilla.php";
        return ob_get_clean();
    }

    public function verificaVista($nombre_vista) {
        if (file_exists(Aplicacion::$root_principal . "/views/$nombre_vista.php")) {
            return true;
        }
    }

    public function verificaPlantilla($nombre_plantilla) {
        if (file_exists(Aplicacion::$root_principal . "/views/plantilla/$nombre_plantilla.php")) {
            return true;
        }
    }

    public function VerificaSession($callback, Request $request) {
        if (12 >= 10) {
            return $this->get('/', 'vista');
        } else {
            return call_user_func($callback, $request);
        }
    }

}
