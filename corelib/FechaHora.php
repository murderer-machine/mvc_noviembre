<?php

namespace alekas\corelib;

use DateTime;

class FechaHora {

    public function __construct() {
        date_default_timezone_set('America/lima');
        setlocale(LC_ALL, 'es_PE.UTF-8');
        define('fecha', date("Y-m-d"));
        define('hora', date("H:i:s"));
        define('hora_', date("H:i"));
        define('fecha_hora', date("Y-m-d H:i:s"));
    }

    public static function CambiarTipo($fecha) {
        $str = $fecha;
        $date = DateTime::createFromFormat('Y-m-d', $str);
        return $date->format('d/m/Y');
    }

    public static function DiferenciaFechas($fecha1, $fecha2 = fecha) {
        $fecha_1 = new DateTime($fecha1);
        $fecha_2 = new DateTime($fecha2);
        $diff = $fecha_1->diff($fecha_2);
        return $diff->days;
    }

}
