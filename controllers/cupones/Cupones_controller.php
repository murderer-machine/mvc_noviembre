<?php

namespace alekas\controllers\cupones;

use alekas\core\Controller;
use alekas\core\Request;
use alekas\core\Session;
use alekas\corelib\FuncionesArray;
use alekas\corelib\FechaHora;
use alekas\models\Polizas;
use alekas\models\PolizaCupones;
use alekas\models\Clientes;
use alekas\models\ProductosEmpresasSeguros;
use alekas\models\Ramos;
use alekas\models\EmpresasSeguros;
use alekas\models\Monedas;
use alekas\models\PolizasVehiculos;
use alekas\models\Marcas;
use alekas\models\Modelos;
use alekas\models\PolizasComentarios;
use alekas\models\PolizasRespuestas;

class Cupones_controller extends Controller {

    public function mostrar(Request $request) {
        $where = [['fecha_obligacion', fecha, '<='], ['situacion', 0], ['anulada', 0]];
        $orwhere = [];
        if (count($request->parametrosUrl()) > 0) {
            $request->parametrosUrl()[0] == 'null' ?: array_push($where, ['t_polizas.id_empresa', $request->parametrosUrl()[0]]);
            $request->parametrosUrl()[1] == 'null' ?: array_push($where, ['t_polizas.id_cliente', $request->parametrosUrl()[1]]);
            $request->parametrosUrl()[2] == 'null' ?: array_push($where, ['t_polizas.nro_poliza', "%" . $request->parametrosUrl()[2] . "%", 'LIKE']);
            $request->parametrosUrl()[2] == 'null' ?: array_push($where, ['t_polizas.nro_poliza_corregido', "%" . $request->parametrosUrl()[2] . "%", 'LIKE']);
            $request->parametrosUrl()[3] == 'null' ?: array_push($where, ['t_polizas_documentos_cupones.nro_cuota', "%" . $request->parametrosUrl()[3] . "%", 'LIKE']);
        }
        $cupones = PolizaCupones::select('t_polizas_documentos_cupones.*,t_polizas_documentos.id_poliza,t_polizas.id_cliente,t_polizas.nro_poliza,t_polizas.nro_poliza_corregido,t_polizas.id_empresa,t_polizas.anulada')
                ->join('t_polizas_documentos', 't_polizas_documentos.id', '=', 't_polizas_documentos_cupones.id_documento')
                ->join('t_polizas', 't_polizas.id', '=', 't_polizas_documentos.id_poliza')
                ->where($where)
                ->orWhere($orwhere)
                ->run()
                ->datos();

        $cupones = FuncionesArray::groupArray($cupones, 'id_cliente', 'polizas');
        foreach ($cupones as $cupon_k => $cupon_v) {
            $polizas = FuncionesArray::groupArray($cupones[$cupon_k]['polizas'], 'id_poliza', 'documentos');
            $cupones[$cupon_k]['polizas'] = $polizas;
            foreach ($cupones[$cupon_k]['polizas'] as $polizas_k => $polizas_v) {
                $documentos = FuncionesArray::groupArray($cupones[$cupon_k]['polizas'][$polizas_k]['documentos'], 'id_documento', 'cupones');
                $polizacomentarios = PolizasComentarios::select()->where([['id_poliza', $polizas_v['id_poliza']]])->orderBy([['id', 'DESC']])->limit(1)->run()->datos();
                foreach ($polizacomentarios as $polizacomentarios_k => $polizacomentarios_v) {
                    $respuestas = PolizasRespuestas::select()->where([['id_poliza_comentario', $polizacomentarios_v['id']]])->orderBy([['id', 'DESC']])->limit(2)->run()->datos();
                    $polizacomentarios[$polizacomentarios_k]['respuestas'] = $respuestas;
                }
                $cupones[$cupon_k]['polizas'][$polizas_k]['documentos'] = $documentos;
                $cupones[$cupon_k]['polizas'][$polizas_k]['comentarios'] = $polizacomentarios;
            }
        }
        foreach ($cupones as $cupon_k => $cupon_v) {
            $cliente = Clientes::select('nombre,nrodoc')->where([['id', $cupon_v['id_cliente']]])->run()->datos();
            $cupones[$cupon_k]['id_cliente'] = $cliente[0];
            foreach ($cupones[$cupon_k]['polizas'] as $polizas_k => $polizas_v) {
                $poliza = Polizas::select()->where([['id', $polizas_v['id_poliza']]])->run()->datos();
                $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza'] = $poliza[0];
                $vehiculos = PolizasVehiculos::select('id,placa,marca,modelo')->where([['id', $polizas_v['id_poliza']]])->run()->datos();
                foreach ($vehiculos as $vehiculos_k => $vehiculos_v) {
                    $marca = Marcas::select('marca')->where([['id', $vehiculos_v['marca']]])->run()->datos();
                    $modelo = Modelos::select('modelo')->where([['id', $vehiculos_v['modelo']]])->run()->datos();
                    $vehiculos[$vehiculos_k]['marca'] = $marca[0];
                    $vehiculos[$vehiculos_k]['modelo'] = $modelo[0];
                }
                $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['vehiculos'] = $vehiculos;
                foreach ($cupones[$cupon_k]['polizas'][$polizas_k]['documentos'] as $documento_k => $documento_v) {
                    foreach ($cupones[$cupon_k]['polizas'][$polizas_k]['documentos'][$documento_k]['cupones'] as $cupones_key => $cupones_value) {
                        $cupones[$cupon_k]['polizas'][$polizas_k]['documentos'][$documento_k]['cupones'][$cupones_key]['dias_vencidos'] = FechaHora::DiferenciaFechas($cupones[$cupon_k]['polizas'][$polizas_k]['documentos'][$documento_k]['cupones'][$cupones_key]['fecha_obligacion']);
                        $cupones[$cupon_k]['polizas'][$polizas_k]['documentos'][$documento_k]['cupones'][$cupones_key]['fecha_obligacion'] = FechaHora::CambiarTipo($cupones[$cupon_k]['polizas'][$polizas_k]['documentos'][$documento_k]['cupones'][$cupones_key]['fecha_obligacion']);
                    }
                }
                $empresa = EmpresasSeguros::select('id,nombre,ruc,logo')->where([['id', $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['id_empresa']]])->run()->datos();
                $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['id_empresa'] = $empresa[0];
                $producto = ProductosEmpresasSeguros::select('id,nombre')->where([['id', $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['id_producto']]])->run()->datos();
                $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['id_producto'] = $producto[0];
                $ramo = Ramos::select('id,descripcion')->where([['id', $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['id_ramo']]])->run()->datos();
                $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['id_ramo'] = $ramo[0];
                $moneda = Monedas::select()->where([['id', $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['moneda']]])->run()->datos();
                $cupones[$cupon_k]['polizas'][$polizas_k]['id_poliza']['moneda'] = $moneda[0];
            }
        }
        return $this->json($cupones);
    }

    public function anularPoliza(Request $request) {
        $poliza = Polizas::getById($request->parametrosUrl()[0]);
        $poliza->setAnulada(1);
        $respuesta = $poliza->update();
        echo $this->json($respuesta);
    }

    public function agregarComentario() {
        $polizacomentario = new PolizasComentarios(351, 'ejemplo');
        $respuesta = $polizacomentario->create();
        print_r($respuesta);
    }

    public function agregarRespuesta(Request $request) {
        $respuesta = PolizasRespuestas::setDataCreate($request->parametrosJson());
        $resultado = $respuesta->create();
        return $this->json($resultado['error']);
    }

    public function mostarRespuestas() {
        $respuestas = PolizasRespuestas::select()->orderBy([['id', 'DESC']])->limit(2)->run(true)->datos();
        return $this->json($respuestas);
    }

}
