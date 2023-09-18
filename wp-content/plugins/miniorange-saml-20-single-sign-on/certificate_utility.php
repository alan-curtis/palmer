<?php


class CertificateUtility
{
    public static function generate_certificate($Ll, $Yh, $Aw)
    {
        $Nd = openssl_pkey_new();
        $Og = openssl_csr_new($Ll, $Nd, $Yh);
        $NK = openssl_csr_sign($Og, null, $Nd, $Aw, $Yh, time());
        openssl_csr_export($Og, $XL);
        openssl_x509_export($NK, $SZ);
        openssl_pkey_export($Nd, $kf);
        kM:
        if (!(($zg = openssl_error_string()) !== false)) {
            goto ac;
        }
        error_log("\103\145\x72\x74\151\146\x69\x63\141\x74\x65\125\164\x69\154\151\x74\x79\72\x20\x45\162\x72\157\162\x20\x67\x65\x6e\x65\x72\141\164\x69\x6e\x67\40\143\145\x72\164\x69\x66\151\143\141\x74\x65\x2e\40" . $zg);
        goto kM;
        ac:
        $Pa = array("\160\165\x62\154\151\x63\137\x6b\145\171" => $SZ, "\160\162\151\x76\x61\x74\x65\x5f\x6b\x65\171" => $kf);
        return $Pa;
    }
}
