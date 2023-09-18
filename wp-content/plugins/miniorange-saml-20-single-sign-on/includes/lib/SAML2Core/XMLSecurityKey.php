<?php


namespace RobRichards\XMLSecLibs;

use DOMElement;
use Exception;
class XMLSecurityKey
{
    const TRIPLEDES_CBC = "\x68\x74\x74\x70\72\57\x2f\x77\x77\167\56\167\x33\x2e\157\162\147\x2f\62\60\60\x31\57\x30\x34\57\170\155\x6c\x65\156\143\43\x74\x72\151\x70\x6c\145\x64\145\x73\55\x63\x62\x63";
    const AES128_CBC = "\x68\x74\x74\160\x3a\x2f\x2f\x77\x77\167\x2e\167\63\x2e\157\x72\x67\57\62\x30\x30\x31\57\x30\x34\x2f\170\155\154\145\156\x63\43\141\145\x73\x31\x32\x38\55\x63\x62\143";
    const AES192_CBC = "\x68\164\164\160\72\x2f\57\167\x77\x77\x2e\167\x33\56\157\x72\x67\x2f\x32\x30\60\61\57\60\64\x2f\x78\155\x6c\x65\x6e\x63\x23\x61\145\163\x31\x39\x32\x2d\x63\x62\x63";
    const AES256_CBC = "\x68\x74\164\x70\72\57\x2f\x77\x77\167\x2e\x77\63\x2e\x6f\162\147\57\62\x30\x30\61\57\60\x34\57\x78\x6d\x6c\x65\156\143\43\x61\145\x73\62\65\66\55\x63\142\x63";
    const AES128_GCM = "\x68\x74\x74\x70\72\57\x2f\167\x77\167\56\x77\x33\x2e\157\162\147\x2f\62\60\x30\71\57\x78\155\154\x65\156\x63\61\x31\x23\141\145\x73\61\x32\x38\55\x67\x63\155";
    const AES192_GCM = "\150\164\164\160\x3a\57\57\167\x77\167\56\x77\63\x2e\x6f\x72\147\x2f\x32\x30\x30\71\x2f\x78\x6d\154\145\x6e\143\x31\61\x23\141\x65\163\x31\x39\62\55\x67\143\155";
    const AES256_GCM = "\x68\x74\164\160\72\57\x2f\167\167\x77\x2e\x77\x33\x2e\157\x72\x67\57\62\x30\x30\71\x2f\x78\x6d\154\x65\x6e\x63\61\61\43\x61\x65\163\62\x35\x36\55\x67\143\155";
    const RSA_1_5 = "\150\x74\x74\160\72\x2f\57\x77\167\x77\56\167\63\56\x6f\162\x67\x2f\x32\x30\x30\61\57\60\x34\57\170\155\x6c\145\x6e\143\43\162\163\141\x2d\61\137\65";
    const RSA_OAEP_MGF1P = "\150\x74\x74\160\72\x2f\x2f\x77\167\x77\56\167\63\x2e\x6f\162\x67\x2f\x32\60\60\61\x2f\60\64\x2f\x78\155\154\x65\x6e\x63\x23\x72\163\x61\55\157\x61\x65\x70\55\x6d\x67\146\x31\160";
    const RSA_OAEP = "\x68\164\164\x70\x3a\x2f\x2f\167\x77\167\56\167\63\x2e\x6f\x72\147\x2f\62\x30\x30\71\57\170\155\154\145\156\x63\61\x31\43\162\163\141\x2d\x6f\x61\x65\x70";
    const DSA_SHA1 = "\150\x74\164\160\72\x2f\57\167\167\x77\x2e\x77\63\x2e\157\x72\147\57\62\60\x30\60\x2f\60\71\57\170\x6d\x6c\144\x73\151\147\43\x64\163\141\55\163\x68\x61\61";
    const RSA_SHA1 = "\x68\x74\x74\x70\x3a\57\57\167\x77\x77\x2e\167\63\56\157\162\147\57\x32\60\60\x30\57\x30\x39\57\x78\x6d\x6c\x64\x73\151\x67\43\x72\163\x61\x2d\163\x68\141\x31";
    const RSA_SHA256 = "\x68\x74\x74\160\72\57\x2f\x77\167\x77\x2e\167\x33\x2e\x6f\x72\x67\57\x32\x30\60\61\x2f\60\x34\x2f\x78\155\154\x64\163\151\x67\x2d\155\157\162\x65\x23\x72\x73\141\55\x73\x68\x61\62\65\66";
    const RSA_SHA384 = "\150\x74\x74\x70\72\57\x2f\167\x77\167\x2e\167\x33\56\157\x72\147\x2f\62\60\x30\61\57\60\x34\x2f\170\x6d\x6c\x64\163\151\x67\x2d\x6d\157\x72\145\43\x72\163\x61\x2d\x73\150\x61\x33\x38\x34";
    const RSA_SHA512 = "\150\164\x74\x70\x3a\57\x2f\x77\167\167\x2e\x77\63\56\x6f\162\147\57\62\x30\x30\61\x2f\x30\x34\57\x78\x6d\154\144\x73\151\x67\55\155\x6f\x72\x65\x23\162\163\x61\x2d\163\x68\141\x35\x31\x32";
    const HMAC_SHA1 = "\x68\164\x74\160\72\x2f\57\x77\x77\x77\56\167\63\56\x6f\162\x67\x2f\x32\x30\x30\x30\x2f\x30\x39\x2f\170\x6d\154\144\x73\x69\147\x23\x68\155\x61\143\55\x73\150\141\x31";
    const AUTHTAG_LENGTH = 16;
    private $cryptParams = array();
    public $type = 0;
    public $key = null;
    public $passphrase = '';
    public $iv = null;
    public $name = null;
    public $keyChain = null;
    public $isEncrypted = false;
    public $encryptedCtx = null;
    public $guid = null;
    private $x509Certificate = null;
    private $X509Thumbprint = null;
    public function __construct($km, $Jo = null)
    {
        switch ($km) {
            case self::TRIPLEDES_CBC:
                $this->cryptParams["\154\151\142\x72\x61\162\171"] = "\x6f\x70\145\156\163\x73\154";
                $this->cryptParams["\x63\x69\x70\x68\x65\162"] = "\x64\x65\x73\55\145\x64\x65\x33\x2d\143\142\143";
                $this->cryptParams["\x74\171\160\145"] = "\x73\171\155\x6d\x65\x74\162\151\143";
                $this->cryptParams["\x6d\x65\164\x68\157\x64"] = "\150\164\164\x70\72\x2f\57\x77\x77\167\x2e\167\63\x2e\x6f\162\147\x2f\62\x30\60\x31\57\x30\64\x2f\x78\x6d\154\x65\156\143\x23\164\162\x69\x70\154\145\x64\x65\163\55\x63\142\143";
                $this->cryptParams["\153\145\171\x73\151\x7a\145"] = 24;
                $this->cryptParams["\142\154\x6f\x63\153\163\151\x7a\145"] = 8;
                goto o8;
            case self::AES128_CBC:
                $this->cryptParams["\x6c\x69\x62\162\x61\x72\x79"] = "\157\x70\x65\156\163\163\x6c";
                $this->cryptParams["\x63\151\x70\150\145\x72"] = "\x61\145\163\55\x31\62\x38\x2d\143\x62\x63";
                $this->cryptParams["\164\x79\160\x65"] = "\x73\x79\155\155\145\164\x72\151\143";
                $this->cryptParams["\155\x65\x74\150\157\x64"] = "\150\164\x74\x70\x3a\x2f\x2f\x77\x77\x77\56\x77\63\x2e\x6f\162\x67\x2f\x32\60\x30\61\x2f\60\64\57\x78\155\154\x65\x6e\143\x23\x61\x65\x73\x31\62\x38\55\143\142\x63";
                $this->cryptParams["\x6b\x65\x79\163\151\172\x65"] = 16;
                $this->cryptParams["\x62\x6c\x6f\x63\x6b\x73\x69\172\145"] = 16;
                goto o8;
            case self::AES192_CBC:
                $this->cryptParams["\154\x69\142\x72\x61\162\x79"] = "\157\x70\x65\156\163\163\x6c";
                $this->cryptParams["\x63\151\160\150\145\162"] = "\x61\145\x73\55\61\x39\62\x2d\x63\142\143";
                $this->cryptParams["\x74\171\160\145"] = "\x73\x79\x6d\155\145\x74\162\x69\x63";
                $this->cryptParams["\x6d\145\x74\150\157\x64"] = "\x68\x74\x74\160\x3a\x2f\57\x77\x77\167\56\167\x33\56\157\x72\x67\57\x32\60\x30\x31\x2f\60\x34\57\170\155\x6c\145\156\x63\43\x61\145\x73\x31\71\x32\55\143\x62\143";
                $this->cryptParams["\x6b\x65\171\163\151\x7a\145"] = 24;
                $this->cryptParams["\x62\154\157\143\153\163\x69\x7a\145"] = 16;
                goto o8;
            case self::AES256_CBC:
                $this->cryptParams["\154\x69\x62\162\x61\162\171"] = "\157\x70\145\x6e\x73\x73\x6c";
                $this->cryptParams["\143\151\160\150\x65\x72"] = "\141\x65\163\x2d\62\x35\x36\55\x63\142\143";
                $this->cryptParams["\x74\x79\160\145"] = "\163\171\x6d\155\145\x74\x72\151\143";
                $this->cryptParams["\x6d\x65\164\150\x6f\144"] = "\x68\x74\x74\160\x3a\57\57\167\x77\x77\x2e\x77\63\x2e\x6f\162\147\x2f\62\x30\x30\x31\57\60\64\x2f\170\x6d\154\145\x6e\143\43\141\x65\163\x32\65\x36\55\x63\x62\x63";
                $this->cryptParams["\153\x65\171\163\x69\172\145"] = 32;
                $this->cryptParams["\x62\x6c\157\143\x6b\163\x69\172\145"] = 16;
                goto o8;
            case self::AES128_GCM:
                $this->cryptParams["\x6c\151\142\x72\141\x72\x79"] = "\157\160\x65\x6e\163\x73\154";
                $this->cryptParams["\143\x69\160\150\x65\162"] = "\x61\145\x73\55\x31\x32\x38\55\x67\143\x6d";
                $this->cryptParams["\x74\171\x70\x65"] = "\x73\x79\x6d\x6d\x65\x74\162\151\143";
                $this->cryptParams["\155\145\164\x68\157\x64"] = "\x68\164\x74\x70\72\x2f\x2f\167\167\167\x2e\167\63\x2e\157\x72\x67\x2f\62\x30\60\71\57\x78\x6d\154\145\156\x63\x31\61\x23\141\145\x73\61\62\x38\x2d\x67\143\x6d";
                $this->cryptParams["\153\145\171\x73\x69\172\x65"] = 16;
                $this->cryptParams["\x62\x6c\157\x63\153\x73\x69\x7a\145"] = 16;
                goto o8;
            case self::AES192_GCM:
                $this->cryptParams["\154\151\142\x72\x61\162\171"] = "\157\160\145\x6e\163\163\x6c";
                $this->cryptParams["\143\151\160\x68\x65\162"] = "\141\145\x73\x2d\x31\71\62\55\147\143\x6d";
                $this->cryptParams["\164\171\160\145"] = "\163\171\x6d\155\145\x74\x72\x69\x63";
                $this->cryptParams["\x6d\145\x74\150\x6f\x64"] = "\x68\x74\x74\160\x3a\57\57\167\167\x77\56\167\x33\x2e\157\162\147\x2f\x32\60\x30\x39\x2f\x78\155\x6c\145\x6e\x63\61\x31\x23\x61\145\x73\x31\x39\62\55\x67\143\155";
                $this->cryptParams["\153\145\171\x73\151\x7a\145"] = 24;
                $this->cryptParams["\x62\154\157\143\x6b\163\151\x7a\145"] = 16;
                goto o8;
            case self::AES256_GCM:
                $this->cryptParams["\154\x69\142\x72\x61\x72\x79"] = "\x6f\160\145\x6e\163\163\x6c";
                $this->cryptParams["\143\x69\x70\150\145\162"] = "\x61\145\x73\x2d\62\x35\66\55\x67\143\x6d";
                $this->cryptParams["\x74\x79\x70\x65"] = "\x73\171\155\x6d\x65\x74\162\x69\x63";
                $this->cryptParams["\x6d\x65\164\150\157\x64"] = "\x68\x74\x74\160\72\x2f\57\167\167\167\56\x77\63\x2e\157\162\x67\x2f\62\x30\60\x39\57\x78\x6d\154\145\156\x63\x31\61\43\141\145\x73\x32\65\x36\55\x67\x63\155";
                $this->cryptParams["\x6b\145\171\x73\151\x7a\x65"] = 32;
                $this->cryptParams["\142\x6c\157\143\x6b\x73\151\172\x65"] = 16;
                goto o8;
            case self::RSA_1_5:
                $this->cryptParams["\x6c\x69\x62\x72\141\x72\171"] = "\157\x70\x65\156\163\x73\x6c";
                $this->cryptParams["\x70\x61\x64\x64\151\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\155\x65\164\x68\x6f\x64"] = "\150\x74\164\x70\x3a\x2f\x2f\x77\167\167\56\167\x33\x2e\x6f\162\x67\57\x32\60\x30\x31\x2f\60\x34\57\170\155\x6c\x65\x6e\143\43\162\163\141\55\x31\137\x35";
                if (!(is_array($Jo) && !empty($Jo["\164\x79\x70\x65"]))) {
                    goto Ea;
                }
                if (!($Jo["\x74\x79\160\x65"] == "\160\x75\x62\154\151\143" || $Jo["\x74\171\160\x65"] == "\160\x72\x69\166\x61\x74\145")) {
                    goto EZ;
                }
                $this->cryptParams["\164\171\x70\145"] = $Jo["\x74\171\160\x65"];
                goto o8;
                EZ:
                Ea:
                throw new Exception("\103\x65\162\x74\151\146\x69\x63\141\164\x65\40\x22\x74\171\x70\145\42\40\x28\160\x72\151\x76\x61\x74\145\x2f\160\x75\x62\154\151\143\x29\40\155\165\163\x74\40\142\x65\40\x70\x61\x73\163\145\x64\40\166\x69\141\40\160\141\x72\141\x6d\145\x74\x65\162\x73");
            case self::RSA_OAEP_MGF1P:
                $this->cryptParams["\154\x69\x62\162\x61\162\x79"] = "\157\x70\145\156\163\163\x6c";
                $this->cryptParams["\160\x61\144\x64\x69\x6e\147"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\x6d\x65\164\150\x6f\x64"] = "\x68\164\164\x70\x3a\57\57\x77\167\167\56\x77\63\56\x6f\162\147\x2f\x32\x30\x30\61\57\x30\x34\57\170\155\154\145\x6e\143\43\x72\163\141\55\x6f\141\145\x70\55\x6d\x67\146\61\160";
                $this->cryptParams["\x68\141\x73\x68"] = null;
                if (!(is_array($Jo) && !empty($Jo["\164\x79\x70\145"]))) {
                    goto MV;
                }
                if (!($Jo["\x74\x79\x70\145"] == "\160\165\142\154\151\x63" || $Jo["\x74\171\x70\145"] == "\x70\162\151\166\141\x74\x65")) {
                    goto Qg;
                }
                $this->cryptParams["\164\171\x70\145"] = $Jo["\x74\x79\160\x65"];
                goto o8;
                Qg:
                MV:
                throw new Exception("\x43\x65\162\x74\x69\146\x69\x63\x61\164\145\x20\x22\x74\171\160\145\42\40\50\x70\162\x69\x76\x61\164\145\x2f\160\165\x62\x6c\151\143\51\x20\155\x75\x73\x74\40\142\x65\x20\160\x61\163\163\x65\x64\x20\166\151\x61\40\x70\141\x72\x61\x6d\x65\x74\145\x72\x73");
            case self::RSA_OAEP:
                $this->cryptParams["\154\x69\x62\x72\141\162\x79"] = "\x6f\x70\x65\156\x73\x73\x6c";
                $this->cryptParams["\160\x61\144\144\x69\x6e\x67"] = OPENSSL_PKCS1_OAEP_PADDING;
                $this->cryptParams["\155\x65\x74\150\x6f\x64"] = "\x68\164\x74\160\72\57\x2f\167\167\x77\56\167\x33\x2e\157\162\x67\57\x32\x30\60\x39\x2f\170\x6d\154\x65\x6e\x63\61\61\43\x72\x73\x61\x2d\x6f\141\145\x70";
                $this->cryptParams["\150\x61\163\x68"] = "\150\x74\164\x70\x3a\x2f\57\x77\x77\x77\x2e\167\63\x2e\157\x72\147\x2f\x32\x30\60\71\x2f\x78\155\x6c\145\x6e\x63\61\61\x23\155\147\146\61\x73\x68\x61\x31";
                if (!(is_array($Jo) && !empty($Jo["\164\171\x70\x65"]))) {
                    goto AX;
                }
                if (!($Jo["\164\171\160\145"] == "\160\165\142\154\x69\x63" || $Jo["\x74\x79\160\x65"] == "\x70\162\151\x76\141\x74\145")) {
                    goto oW;
                }
                $this->cryptParams["\x74\171\160\145"] = $Jo["\164\171\160\145"];
                goto o8;
                oW:
                AX:
                throw new Exception("\x43\x65\162\x74\151\x66\151\x63\x61\164\x65\x20\x22\x74\171\160\145\42\40\50\160\x72\x69\166\141\x74\145\57\x70\x75\142\154\x69\x63\51\40\155\165\x73\164\x20\142\145\40\160\141\163\163\x65\x64\40\x76\x69\141\x20\160\141\x72\x61\155\145\x74\145\162\163");
            case self::RSA_SHA1:
                $this->cryptParams["\154\151\142\x72\141\x72\x79"] = "\x6f\x70\145\156\x73\x73\154";
                $this->cryptParams["\x6d\x65\164\x68\x6f\x64"] = "\150\164\x74\160\x3a\57\57\167\167\167\x2e\167\63\x2e\157\x72\x67\x2f\62\60\60\60\x2f\x30\x39\57\170\155\154\x64\163\x69\147\43\162\163\141\x2d\x73\150\x61\x31";
                $this->cryptParams["\160\x61\x64\144\151\156\x67"] = OPENSSL_PKCS1_PADDING;
                if (!(is_array($Jo) && !empty($Jo["\x74\x79\x70\145"]))) {
                    goto I1;
                }
                if (!($Jo["\164\171\160\x65"] == "\x70\x75\x62\154\151\143" || $Jo["\x74\171\160\x65"] == "\160\162\151\x76\x61\x74\145")) {
                    goto Xl;
                }
                $this->cryptParams["\x74\171\160\x65"] = $Jo["\164\x79\160\145"];
                goto o8;
                Xl:
                I1:
                throw new Exception("\103\x65\x72\x74\151\x66\151\143\x61\164\145\x20\42\164\x79\160\x65\x22\40\50\x70\x72\x69\166\x61\x74\x65\57\x70\x75\142\x6c\151\x63\51\x20\155\165\x73\x74\40\x62\x65\40\x70\x61\x73\163\x65\144\x20\x76\151\141\x20\160\x61\x72\x61\x6d\x65\164\145\x72\x73");
            case self::RSA_SHA256:
                $this->cryptParams["\154\151\142\162\141\x72\171"] = "\157\160\145\x6e\163\x73\x6c";
                $this->cryptParams["\155\145\x74\x68\157\x64"] = "\150\164\164\x70\72\57\x2f\167\167\167\x2e\167\63\56\x6f\x72\x67\57\x32\x30\60\61\x2f\60\64\x2f\170\x6d\x6c\144\x73\x69\147\x2d\155\x6f\x72\x65\x23\162\163\141\x2d\163\x68\x61\x32\x35\x36";
                $this->cryptParams["\160\141\144\144\151\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\x69\x67\145\x73\164"] = "\123\110\x41\62\x35\x36";
                if (!(is_array($Jo) && !empty($Jo["\164\x79\x70\145"]))) {
                    goto yl;
                }
                if (!($Jo["\x74\x79\160\145"] == "\160\x75\142\154\x69\x63" || $Jo["\x74\171\160\145"] == "\x70\162\x69\x76\x61\x74\x65")) {
                    goto aR;
                }
                $this->cryptParams["\164\x79\160\x65"] = $Jo["\164\171\x70\145"];
                goto o8;
                aR:
                yl:
                throw new Exception("\103\x65\x72\x74\151\x66\151\x63\141\x74\x65\x20\42\164\x79\160\145\x22\x20\x28\160\x72\151\166\x61\x74\x65\x2f\x70\165\142\x6c\151\143\x29\x20\155\165\163\164\x20\x62\145\x20\160\141\163\x73\145\x64\x20\166\x69\141\40\x70\141\162\141\155\145\x74\145\x72\x73");
            case self::RSA_SHA384:
                $this->cryptParams["\154\151\x62\x72\x61\162\x79"] = "\x6f\160\x65\x6e\x73\x73\154";
                $this->cryptParams["\155\145\164\150\157\x64"] = "\x68\x74\x74\160\72\57\x2f\167\167\167\x2e\167\63\56\157\x72\x67\57\x32\60\x30\61\x2f\60\x34\x2f\x78\x6d\x6c\x64\x73\x69\x67\55\155\x6f\x72\x65\x23\x72\163\x61\x2d\163\150\141\63\70\x34";
                $this->cryptParams["\x70\x61\144\144\x69\156\x67"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\144\x69\147\145\163\164"] = "\x53\110\x41\63\70\64";
                if (!(is_array($Jo) && !empty($Jo["\x74\x79\x70\x65"]))) {
                    goto aY;
                }
                if (!($Jo["\x74\x79\x70\x65"] == "\160\165\142\x6c\151\143" || $Jo["\164\171\160\x65"] == "\x70\x72\x69\x76\x61\164\145")) {
                    goto KS;
                }
                $this->cryptParams["\164\171\x70\145"] = $Jo["\164\x79\160\145"];
                goto o8;
                KS:
                aY:
                throw new Exception("\103\145\x72\164\x69\x66\x69\x63\141\x74\145\40\42\x74\x79\160\x65\42\x20\x28\x70\x72\151\x76\141\x74\x65\x2f\x70\165\142\x6c\x69\x63\x29\40\155\x75\163\164\x20\x62\145\40\160\141\x73\x73\x65\x64\40\x76\x69\141\x20\x70\141\162\x61\x6d\145\164\x65\162\163");
            case self::RSA_SHA512:
                $this->cryptParams["\x6c\151\142\162\x61\x72\171"] = "\x6f\x70\x65\156\x73\163\154";
                $this->cryptParams["\x6d\x65\164\x68\x6f\x64"] = "\150\164\164\160\x3a\57\57\167\x77\x77\x2e\x77\x33\x2e\157\x72\x67\57\x32\60\x30\x31\57\60\x34\57\x78\155\x6c\144\163\x69\x67\55\x6d\x6f\x72\x65\x23\162\163\141\55\x73\x68\141\x35\61\x32";
                $this->cryptParams["\x70\x61\144\x64\x69\156\147"] = OPENSSL_PKCS1_PADDING;
                $this->cryptParams["\x64\x69\147\x65\x73\x74"] = "\123\x48\101\65\61\x32";
                if (!(is_array($Jo) && !empty($Jo["\x74\x79\x70\145"]))) {
                    goto AQ;
                }
                if (!($Jo["\x74\x79\x70\145"] == "\160\165\142\x6c\x69\143" || $Jo["\x74\171\160\x65"] == "\x70\162\151\166\x61\164\x65")) {
                    goto DK;
                }
                $this->cryptParams["\164\171\x70\x65"] = $Jo["\164\171\x70\145"];
                goto o8;
                DK:
                AQ:
                throw new Exception("\x43\145\162\x74\151\146\x69\x63\x61\x74\145\x20\x22\164\171\x70\145\x22\x20\x28\160\162\x69\166\141\164\145\57\x70\165\142\154\x69\x63\51\40\155\x75\x73\x74\x20\142\x65\40\160\141\163\x73\x65\x64\40\x76\x69\141\x20\x70\x61\x72\x61\155\145\x74\x65\162\163");
            case self::HMAC_SHA1:
                $this->cryptParams["\x6c\x69\x62\x72\x61\x72\x79"] = $km;
                $this->cryptParams["\x6d\x65\164\x68\x6f\144"] = "\150\x74\x74\x70\72\57\x2f\x77\167\x77\x2e\167\63\56\157\162\147\57\62\60\60\60\x2f\x30\x39\57\x78\x6d\x6c\144\163\x69\x67\x23\x68\155\141\143\55\x73\x68\x61\61";
                goto o8;
            default:
                throw new Exception("\x49\156\x76\x61\x6c\x69\x64\x20\x4b\145\x79\40\124\x79\160\145");
        }
        Ie:
        o8:
        $this->type = $km;
    }
    public function getSymmetricKeySize()
    {
        if (isset($this->cryptParams["\153\145\x79\x73\151\x7a\145"])) {
            goto dF;
        }
        return null;
        dF:
        return $this->cryptParams["\x6b\x65\x79\163\x69\x7a\x65"];
    }
    public function generateSessionKey()
    {
        if (isset($this->cryptParams["\x6b\145\171\x73\151\x7a\x65"])) {
            goto KM;
        }
        throw new Exception("\125\x6e\153\156\157\x77\156\x20\x6b\x65\171\40\163\151\x7a\145\x20\146\x6f\162\40\164\x79\160\x65\40\42" . $this->type . "\x22\x2e");
        KM:
        $iQ = $this->cryptParams["\153\x65\171\163\x69\x7a\x65"];
        $y9 = openssl_random_pseudo_bytes($iQ);
        if (!($this->type === self::TRIPLEDES_CBC)) {
            goto kN;
        }
        $y_ = 0;
        X0:
        if (!($y_ < strlen($y9))) {
            goto oB;
        }
        $Z4 = ord($y9[$y_]) & 0xfe;
        $GF = 1;
        $dv = 1;
        dX:
        if (!($dv < 8)) {
            goto ou;
        }
        $GF ^= $Z4 >> $dv & 1;
        Uv:
        $dv++;
        goto dX;
        ou:
        $Z4 |= $GF;
        $y9[$y_] = chr($Z4);
        N_:
        $y_++;
        goto X0;
        oB:
        kN:
        $this->key = $y9;
        return $y9;
    }
    public static function getRawThumbprint($EK)
    {
        $Ei = explode("\xa", $EK);
        $h6 = '';
        $FX = false;
        foreach ($Ei as $pa) {
            if (!$FX) {
                goto ga;
            }
            if (!(strncmp($pa, "\55\x2d\55\55\55\105\116\104\40\x43\x45\x52\124\111\x46\x49\103\x41\x54\x45", 20) == 0)) {
                goto EO;
            }
            goto Vb;
            EO:
            $h6 .= trim($pa);
            goto Hj;
            ga:
            if (!(strncmp($pa, "\x2d\x2d\55\x2d\x2d\102\105\x47\111\116\40\x43\x45\x52\124\111\106\111\x43\101\124\105", 22) == 0)) {
                goto IT;
            }
            $FX = true;
            IT:
            Hj:
            eE:
        }
        Vb:
        if (empty($h6)) {
            goto Td;
        }
        return strtolower(sha1(base64_decode($h6)));
        Td:
        return null;
    }
    public function loadKey($y9, $ZO = false, $r8 = false)
    {
        if ($ZO) {
            goto bI;
        }
        $this->key = $y9;
        goto Eb;
        bI:
        $this->key = file_get_contents($y9);
        Eb:
        if ($r8) {
            goto Ut;
        }
        $this->x509Certificate = null;
        goto Fz;
        Ut:
        $this->key = openssl_x509_read($this->key);
        openssl_x509_export($this->key, $b4);
        $this->x509Certificate = $b4;
        $this->key = $b4;
        Fz:
        if (!($this->cryptParams["\154\x69\142\x72\x61\x72\x79"] == "\157\160\x65\x6e\163\163\x6c")) {
            goto Fj;
        }
        switch ($this->cryptParams["\x74\x79\160\x65"]) {
            case "\x70\x75\142\154\151\143":
                if (!$r8) {
                    goto wt;
                }
                $this->X509Thumbprint = self::getRawThumbprint($this->key);
                wt:
                $this->key = openssl_get_publickey($this->key);
                if ($this->key) {
                    goto qu;
                }
                throw new Exception("\x55\156\x61\x62\x6c\145\x20\x74\157\40\145\x78\x74\x72\141\143\x74\40\160\165\x62\154\151\143\40\153\x65\171");
                qu:
                goto W6;
            case "\x70\162\x69\166\141\164\145":
                $this->key = openssl_get_privatekey($this->key, $this->passphrase);
                goto W6;
            case "\x73\171\155\x6d\145\x74\x72\151\x63":
                if (!(strlen($this->key) < $this->cryptParams["\x6b\145\171\163\x69\x7a\x65"])) {
                    goto Dn;
                }
                throw new Exception("\x4b\x65\x79\x20\x6d\x75\163\164\40\x63\157\x6e\164\141\151\156\40\x61\164\40\154\145\141\x73\164\x20" . $this->cryptParams["\x6b\x65\171\163\151\x7a\x65"] . "\x20\143\150\141\x72\141\143\164\145\162\163\x20\x66\x6f\x72\x20\164\150\x69\x73\40\143\151\x70\x68\145\x72\54\x20\x63\157\156\164\x61\x69\156\x73\40" . strlen($this->key));
                Dn:
                goto W6;
            default:
                throw new Exception("\125\156\x6b\x6e\x6f\167\156\x20\x74\171\160\145");
        }
        LE:
        W6:
        Fj:
    }
    private function padISO10126($h6, $VO)
    {
        if (!($VO > 256)) {
            goto hx;
        }
        throw new Exception("\x42\x6c\157\x63\x6b\40\x73\x69\x7a\x65\40\x68\151\x67\150\x65\x72\40\164\150\x61\156\x20\62\x35\x36\x20\x6e\x6f\x74\40\141\x6c\x6c\x6f\167\145\144");
        hx:
        $yk = $VO - strlen($h6) % $VO;
        $pU = chr($yk);
        return $h6 . str_repeat($pU, $yk);
    }
    private function unpadISO10126($h6)
    {
        $yk = substr($h6, -1);
        $wf = ord($yk);
        return substr($h6, 0, -$wf);
    }
    private function encryptSymmetric($h6)
    {
        $this->iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cryptParams["\143\x69\160\x68\x65\x72"]));
        $v5 = null;
        if (in_array($this->cryptParams["\143\x69\160\150\x65\162"], ["\141\x65\x73\55\61\62\x38\x2d\147\x63\x6d", "\141\145\163\x2d\x31\71\62\55\147\x63\x6d", "\x61\x65\x73\x2d\62\x35\66\x2d\x67\x63\155"])) {
            goto om;
        }
        $h6 = $this->padISO10126($h6, $this->cryptParams["\142\x6c\x6f\x63\x6b\163\151\172\145"]);
        $zC = openssl_encrypt($h6, $this->cryptParams["\143\151\x70\x68\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        goto rI;
        om:
        if (!(version_compare(PHP_VERSION, "\x37\56\61\x2e\60") < 0)) {
            goto gi;
        }
        throw new Exception("\x50\110\120\40\67\x2e\x31\56\60\40\x69\x73\40\x72\145\161\165\x69\162\145\x64\x20\164\x6f\40\x75\x73\145\x20\101\x45\123\x20\x47\103\115\40\141\154\147\157\x72\151\x74\150\x6d\163");
        gi:
        $v5 = openssl_random_pseudo_bytes(self::AUTHTAG_LENGTH);
        $zC = openssl_encrypt($h6, $this->cryptParams["\x63\151\160\x68\145\x72"], $this->key, OPENSSL_RAW_DATA, $this->iv, $v5);
        rI:
        if (!(false === $zC)) {
            goto nH;
        }
        throw new Exception("\106\x61\151\154\165\x72\x65\x20\145\x6e\143\162\x79\x70\x74\151\156\x67\40\104\141\164\141\x20\50\x6f\160\x65\x6e\x73\163\x6c\40\x73\171\155\155\x65\x74\x72\151\x63\x29\40\55\x20" . openssl_error_string());
        nH:
        return $this->iv . $zC . $v5;
    }
    private function decryptSymmetric($h6)
    {
        $Du = openssl_cipher_iv_length($this->cryptParams["\143\151\160\150\145\x72"]);
        $this->iv = substr($h6, 0, $Du);
        $h6 = substr($h6, $Du);
        $v5 = null;
        if (in_array($this->cryptParams["\x63\x69\160\150\145\162"], ["\141\x65\163\55\61\62\70\x2d\x67\x63\x6d", "\141\x65\163\x2d\61\71\62\55\x67\x63\x6d", "\x61\145\163\55\62\65\x36\x2d\x67\143\155"])) {
            goto qS;
        }
        $aG = openssl_decrypt($h6, $this->cryptParams["\x63\151\160\150\145\162"], $this->key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING, $this->iv);
        goto NW;
        qS:
        if (!(version_compare(PHP_VERSION, "\67\x2e\61\x2e\60") < 0)) {
            goto LC;
        }
        throw new Exception("\120\110\x50\x20\67\56\x31\56\60\40\x69\163\x20\162\145\161\x75\x69\x72\145\x64\x20\x74\157\x20\x75\163\x65\x20\x41\105\x53\40\x47\103\x4d\x20\141\154\x67\157\x72\x69\x74\x68\x6d\163");
        LC:
        $cd = 0 - self::AUTHTAG_LENGTH;
        $v5 = substr($h6, $cd);
        $h6 = substr($h6, 0, $cd);
        $aG = openssl_decrypt($h6, $this->cryptParams["\143\151\x70\150\x65\x72"], $this->key, OPENSSL_RAW_DATA, $this->iv, $v5);
        NW:
        if (!(false === $aG)) {
            goto a1;
        }
        throw new Exception("\106\x61\x69\x6c\x75\162\145\40\144\145\143\162\171\x70\x74\151\x6e\x67\40\104\x61\164\141\x20\x28\x6f\160\145\x6e\x73\x73\154\40\x73\x79\155\x6d\x65\164\x72\x69\x63\51\40\x2d\x20" . openssl_error_string());
        a1:
        return null !== $v5 ? $aG : $this->unpadISO10126($aG);
    }
    private function encryptPublic($h6)
    {
        if (openssl_public_encrypt($h6, $zC, $this->key, $this->cryptParams["\160\x61\144\144\151\x6e\147"])) {
            goto xg;
        }
        throw new Exception("\106\141\x69\x6c\x75\x72\145\x20\x65\x6e\x63\x72\x79\x70\164\x69\156\x67\x20\x44\141\164\141\x20\x28\x6f\160\145\156\x73\163\x6c\x20\160\x75\x62\154\x69\143\x29\40\55\40" . openssl_error_string());
        xg:
        return $zC;
    }
    private function decryptPublic($h6)
    {
        if (openssl_public_decrypt($h6, $aG, $this->key, $this->cryptParams["\160\x61\144\x64\x69\156\x67"])) {
            goto so;
        }
        throw new Exception("\106\141\151\x6c\165\162\145\x20\x64\145\143\162\x79\160\x74\151\x6e\147\x20\x44\x61\x74\141\x20\x28\x6f\160\x65\156\x73\163\x6c\40\x70\165\142\154\x69\143\x29\40\x2d\x20" . openssl_error_string());
        so:
        return $aG;
    }
    private function encryptPrivate($h6)
    {
        if (openssl_private_encrypt($h6, $zC, $this->key, $this->cryptParams["\160\x61\144\x64\x69\156\147"])) {
            goto Ri;
        }
        throw new Exception("\106\x61\151\154\165\x72\x65\40\145\156\143\162\x79\x70\x74\151\156\147\x20\104\141\x74\x61\x20\x28\157\x70\145\156\163\163\154\40\160\162\151\166\141\164\145\51\40\55\x20" . openssl_error_string());
        Ri:
        return $zC;
    }
    private function decryptPrivate($h6)
    {
        if (openssl_private_decrypt($h6, $aG, $this->key, $this->cryptParams["\x70\141\144\x64\151\x6e\x67"])) {
            goto ZR;
        }
        throw new Exception("\x46\141\151\x6c\x75\162\145\40\x64\145\x63\162\171\x70\x74\x69\x6e\x67\x20\104\x61\x74\141\40\50\x6f\160\145\156\x73\x73\154\x20\160\x72\x69\166\141\x74\145\x29\x20\55\40" . openssl_error_string());
        ZR:
        return $aG;
    }
    private function signOpenSSL($h6)
    {
        $bz = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\144\x69\147\145\163\x74"])) {
            goto T9;
        }
        $bz = $this->cryptParams["\144\151\x67\145\x73\x74"];
        T9:
        if (openssl_sign($h6, $IB, $this->key, $bz)) {
            goto vs;
        }
        throw new Exception("\106\141\151\x6c\165\162\145\40\x53\x69\x67\x6e\x69\x6e\147\x20\x44\141\x74\x61\x3a\x20" . openssl_error_string() . "\40\55\x20" . $bz);
        vs:
        return $IB;
    }
    private function verifyOpenSSL($h6, $IB)
    {
        $bz = OPENSSL_ALGO_SHA1;
        if (empty($this->cryptParams["\x64\151\147\145\163\164"])) {
            goto Er;
        }
        $bz = $this->cryptParams["\x64\x69\x67\145\163\x74"];
        Er:
        return openssl_verify($h6, $IB, $this->key, $bz);
    }
    public function encryptData($h6)
    {
        if (!($this->cryptParams["\x6c\151\x62\x72\141\x72\x79"] === "\x6f\160\x65\156\x73\x73\x6c")) {
            goto Ge;
        }
        switch ($this->cryptParams["\164\x79\x70\x65"]) {
            case "\163\171\x6d\155\145\x74\x72\151\143":
                return $this->encryptSymmetric($h6);
            case "\160\x75\x62\154\x69\143":
                return $this->encryptPublic($h6);
            case "\x70\x72\151\x76\x61\x74\x65":
                return $this->encryptPrivate($h6);
        }
        gH:
        VH:
        Ge:
    }
    public function decryptData($h6)
    {
        if (!($this->cryptParams["\154\x69\142\162\141\162\x79"] === "\157\x70\x65\156\163\163\x6c")) {
            goto Fw;
        }
        switch ($this->cryptParams["\164\x79\160\145"]) {
            case "\163\x79\x6d\155\145\164\x72\151\x63":
                return $this->decryptSymmetric($h6);
            case "\x70\165\142\154\x69\143":
                return $this->decryptPublic($h6);
            case "\x70\162\x69\x76\141\164\145":
                return $this->decryptPrivate($h6);
        }
        nP:
        vc:
        Fw:
    }
    public function signData($h6)
    {
        switch ($this->cryptParams["\x6c\151\x62\162\141\x72\x79"]) {
            case "\157\160\x65\x6e\x73\163\154":
                return $this->signOpenSSL($h6);
            case self::HMAC_SHA1:
                return hash_hmac("\163\x68\x61\61", $h6, $this->key, true);
        }
        Fo:
        ww:
    }
    public function verifySignature($h6, $IB)
    {
        switch ($this->cryptParams["\x6c\x69\x62\162\x61\162\171"]) {
            case "\x6f\x70\x65\156\163\x73\x6c":
                return $this->verifyOpenSSL($h6, $IB);
            case self::HMAC_SHA1:
                $px = hash_hmac("\x73\150\141\x31", $h6, $this->key, true);
                return strcmp($IB, $px) == 0;
        }
        i3:
        U8:
    }
    public function getAlgorith()
    {
        return $this->getAlgorithm();
    }
    public function getAlgorithm()
    {
        return $this->cryptParams["\x6d\x65\x74\150\157\144"];
    }
    public static function makeAsnSegment($km, $aR)
    {
        switch ($km) {
            case 0x2:
                if (!(ord($aR) > 0x7f)) {
                    goto HR;
                }
                $aR = chr(0) . $aR;
                HR:
                goto Qt;
            case 0x3:
                $aR = chr(0) . $aR;
                goto Qt;
        }
        tU:
        Qt:
        $T7 = strlen($aR);
        if ($T7 < 128) {
            goto xm;
        }
        if ($T7 < 0x100) {
            goto X1;
        }
        if ($T7 < 0x10000) {
            goto Yp;
        }
        $pB = null;
        goto Dd;
        Yp:
        $pB = sprintf("\45\x63\45\143\x25\x63\x25\143\45\x73", $km, 0x82, $T7 / 0x100, $T7 % 0x100, $aR);
        Dd:
        goto vR;
        X1:
        $pB = sprintf("\x25\143\45\143\x25\143\45\x73", $km, 0x81, $T7, $aR);
        vR:
        goto jW;
        xm:
        $pB = sprintf("\45\143\x25\x63\45\x73", $km, $T7, $aR);
        jW:
        return $pB;
    }
    public static function convertRSA($JQ, $fS)
    {
        $x8 = self::makeAsnSegment(0x2, $fS);
        $iE = self::makeAsnSegment(0x2, $JQ);
        $Pd = self::makeAsnSegment(0x30, $iE . $x8);
        $eF = self::makeAsnSegment(0x3, $Pd);
        $dk = pack("\x48\x2a", "\x33\60\60\x44\x30\x36\60\x39\x32\101\70\66\x34\x38\70\66\x46\67\x30\104\x30\x31\60\x31\60\x31\60\65\x30\x30");
        $j4 = self::makeAsnSegment(0x30, $dk . $eF);
        $BE = base64_encode($j4);
        $Rm = "\x2d\55\55\55\55\102\x45\107\111\116\x20\120\125\x42\114\111\103\40\x4b\105\131\x2d\x2d\x2d\x2d\x2d\12";
        $cd = 0;
        T6:
        if (!($wO = substr($BE, $cd, 64))) {
            goto jd;
        }
        $Rm = $Rm . $wO . "\12";
        $cd += 64;
        goto T6;
        jd:
        return $Rm . "\55\55\x2d\x2d\55\105\x4e\104\x20\120\x55\102\114\x49\x43\40\113\105\131\55\x2d\55\55\x2d\xa";
    }
    public function serializeKey($hQ)
    {
    }
    public function getX509Certificate()
    {
        return $this->x509Certificate;
    }
    public function getX509Thumbprint()
    {
        return $this->X509Thumbprint;
    }
    public static function fromEncryptedKeyElement(DOMElement $Ba)
    {
        $pD = new XMLSecEnc();
        $pD->setNode($Ba);
        if ($X6 = $pD->locateKey()) {
            goto et;
        }
        throw new Exception("\125\x6e\x61\142\x6c\145\40\x74\157\x20\x6c\157\x63\141\164\145\40\141\154\x67\157\162\151\x74\x68\155\40\x66\157\162\x20\164\150\151\163\40\105\156\143\162\171\x70\164\x65\x64\x20\x4b\145\x79");
        et:
        $X6->isEncrypted = true;
        $X6->encryptedCtx = $pD;
        XMLSecEnc::staticLocateKeyInfo($X6, $Ba);
        return $X6;
    }
}
