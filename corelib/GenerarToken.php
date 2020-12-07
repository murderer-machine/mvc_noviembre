<?php

namespace alekas\corelib;

class GenerarToken {

    protected static $clave = 'alekas@2015';
    protected static $metodo = 'aes-128-ctr';
    protected static $algoritmo = 'sha512';
    protected static $enc_key;

    public function __construct() {
        self::$enc_key = openssl_digest(self::$clave, self::$algoritmo, TRUE);
    }

    static function Encriptar($texto) {
        $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::$metodo));
        $crypted_token = openssl_encrypt($texto, self::$metodo, self::$enc_key, OPENSSL_ZERO_PADDING, $enc_iv) . "." . bin2hex($enc_iv);
        return base64_encode($crypted_token);
    }

    static function Desencriptar(string $token) {
        list($token, $enc_iv) = explode(".", base64_decode($token));
        $token = openssl_decrypt($token, self::$metodo, self::$enc_key, 0, hex2bin($enc_iv));
        return $token;
    }

}
