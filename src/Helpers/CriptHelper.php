<?php

namespace HeroSeguros\HeroLaravelLibrary\Helpers;

use HeroSeguros\HeroLaravelLibrary\Exceptions\HeroLibException;

class CriptHelper
{
    private string $key;
    private string $cipher;

    public function __construct(string $key = null)
    {
        if (mb_strlen($key) !== 64) {
            throw new HeroLibException("A chave precisa ter 64 caracteres hexadecimais.");
        }

        $this->key = hex2bin($key);
        $this->cipher = 'AES-256-CBC';
    }

    public function encrypt($data)
    {
        $data = base64_encode($data);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
        $encrypted = openssl_encrypt($data, $this->cipher, $this->key, 0, $iv);

        if ($encrypted === false) {
            throw new HeroLibException("Não foi possível criptografar os dados.");
        }

        $encrypted = base64_encode($encrypted . '::' . $iv);
        return urlencode($encrypted);
    }

    public function decrypt($data)
    {
        $data = base64_decode(urldecode($data));
        list($encrypted_data, $iv) = explode('::', $data, 2);

        $decrypted = openssl_decrypt($encrypted_data, $this->cipher, $this->key, 0, $iv);

        if ($decrypted === false) {
            throw new HeroLibException("Não foi possível descriptografar os dados.");
        }

        return base64_decode($decrypted);
    }
}
