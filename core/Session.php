<?php

namespace alekas\core;

/**
 * Class session
 *
 * @author Marco Antonio Rodriguez Salinas <alekas_oficial@hotmail.com>
 */
class Session {

    public function __construct() {
        ini_set("session.hash_bits_per_character", 5);
        ini_set("session.hash_function", 5);
        ini_set("session.use_only_cookies", true);
        ini_set("session.use_trans_sid", true);
        ini_set("session.cookie_httponly", true);
        ini_set("session.cookie_secure", true);
        $this->inicio();
    }

    public function inicio() {
        $time = time() + 60 * 60 * 24 * 365;
        session_set_cookie_params(60 * 60 * 24 * 365);
        $id = 'SESSION_ALEKAS';
        session_name('SESSION_ALEKAS');
        !isset($_COOKIE[$id]) ? setcookie($id, session_create_id(), $time) : session_id($_COOKIE[$id]);
        session_start();      
    }

    static function imprimirSession() {
        print_r($_SESSION);
        print_r($_COOKIE);
    }

    static function destroy() {
        session_unset();
        session_destroy();
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
        if (sizeof($_SESSION) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
