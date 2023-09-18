<?php


class AESEncryption
{
    public static function encrypt_data($h6, $y9)
    {
        $y9 = openssl_digest($y9, "\x73\150\x61\62\x35\66");
        $Uc = "\141\x65\x73\x2d\61\x32\x38\x2d\145\143\142";
        $cm = openssl_encrypt($h6, $Uc, $y9, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING);
        return base64_encode($cm);
    }
    public static function decrypt_data($h6, $y9)
    {
        $Na = base64_decode($h6);
        $y9 = openssl_digest($y9, "\x73\150\x61\x32\x35\66");
        $Uc = "\101\x45\123\x2d\x31\62\x38\55\x45\x43\102";
        $mH = openssl_cipher_iv_length($Uc);
        $rg = substr($Na, 0, $mH);
        $h6 = substr($Na, $mH);
        $Z8 = openssl_decrypt($h6, $Uc, $y9, OPENSSL_RAW_DATA || OPENSSL_ZERO_PADDING, $rg);
        return $Z8;
    }
}
