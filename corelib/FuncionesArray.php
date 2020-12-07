<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace alekas\corelib;

/**
 * Class FuncionesArray
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class FuncionesArray {

    public static function groupArray($array, $groupkey ,$nombre = 'datos') {
        if (count($array) > 0) {
            $keys = array_keys($array[0]);
            $removekey = array_search($groupkey, $keys);
            if ($removekey === false)
                return array("Clave \"$groupkey\" no existe");
            else
                unset($keys[$removekey]);
            $groupcriteria = array();
            $return = array();
            foreach ($array as $value) {
                $item = null;
                foreach ($keys as $key) {
                    $item[$key] = $value[$key];
                }
                $busca = array_search($value[$groupkey], $groupcriteria);
                if ($busca === false) {
                    $groupcriteria[] = $value[$groupkey];
                    $return[] = array($groupkey => $value[$groupkey], $nombre => array());
                    $busca = count($return) - 1;
                }
                $return[$busca][$nombre][] = $item;
            }
            return $return;
        } else
            return array();
    }

}
