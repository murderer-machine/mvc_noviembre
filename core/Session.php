<?php

namespace alekas\core;

/**
 * Class session
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class Session {

    private static $nombreId;

    public function __construct() {
        ini_set("session.hash_bits_per_character", 5);
        ini_set("session.hash_function", 5);
        ini_set("session.use_only_cookies", true);
        ini_set("session.use_trans_sid", true);
        ini_set("session.cookie_httponly", true);
        ini_set("session.cookie_secure", true);
        self::$nombreId = "SESSION_ALEKAS";
        session_name(self::$nombreId);
        session_start();
    }

    public static function inicio($limite = false) {
        session_unset();
        session_destroy();
        $id = self::$nombreId;
        session_name($id);
        if ($limite) {
            $time = time() + 60 * 60 * 24 * 365;
            session_set_cookie_params(60 * 60 * 24 * 365);
            !isset($_COOKIE[$id]) ? setcookie($id, session_create_id(), $time) : session_id($_COOKIE[$id]);
        } else {
            !isset($_COOKIE[$id]) ? setcookie($id, session_create_id()) : session_id($_COOKIE[$id]);
        }
        session_start();
    }

    static function imprimirSession() {
        print_r($_SESSION);
        print_r($_COOKIE);
    }

    public static function destroy() {
        session_unset();
        session_destroy();
        return true;
    }

    static function getValue($var) {
        return $_SESSION[$var];
    }

    static function setValue($var, $val) {
        $_SESSION[$var] = $val;
    }

    static function unsetValue($var) {
        if (isset($_SESSION[$var])) {
            unset($_SESSION[$var]);
        }
    }

    static function exist() {
        return sizeof($_SESSION) > 0 ? true : false;
    }

}
