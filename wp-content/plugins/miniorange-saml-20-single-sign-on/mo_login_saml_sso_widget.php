<?php


include_once dirname(__FILE__) . "\x2f\x55\164\151\x6c\x69\x74\x69\145\x73\x2e\160\150\x70";
include_once dirname(__FILE__) . "\57\122\145\163\x70\x6f\156\163\145\56\x70\x68\x70";
include_once dirname(__FILE__) . "\57\114\x6f\147\157\165\x74\122\x65\161\165\145\x73\x74\56\x70\x68\160";
include_once "\170\155\154\163\x65\143\x6c\x69\x62\x73\x2e\160\150\160";
use RobRichards\XMLSecLibs\XMLSecurityKey;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecEnc;
if (class_exists("\101\x45\x53\105\156\x63\162\171\160\164\151\157\x6e")) {
    goto z2;
}
require_once dirname(__FILE__) . "\57\151\x6e\x63\154\165\x64\x65\163\57\154\151\142\x2f\145\156\143\162\x79\160\164\151\x6f\x6e\56\160\150\x70";
z2:
class mo_login_wid extends WP_Widget
{
    public function __construct()
    {
        $hb = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        parent::__construct("\123\141\x6d\154\x5f\114\x6f\x67\x69\156\x5f\x57\151\144\147\x65\x74", "\114\x6f\x67\151\x6e\x20\x77\x69\164\150\x20" . $hb, array("\x64\145\x73\143\x72\151\x70\164\151\157\x6e" => __("\124\150\151\x73\x20\151\163\x20\x61\x20\155\x69\x6e\151\117\162\141\x6e\147\x65\x20\x53\101\x4d\x4c\x20\154\x6f\x67\x69\156\x20\167\x69\144\x67\145\164\x2e", "\x6d\157\x73\x61\155\154")));
    }
    public function widget($ZB, $hW)
    {
        extract($ZB);
        $ab = apply_filters("\167\151\x64\x67\x65\x74\x5f\x74\x69\x74\x6c\x65", $hW["\x77\151\144\137\164\x69\164\x6c\x65"]);
        echo $ZB["\x62\145\146\x6f\x72\145\x5f\167\x69\x64\147\145\x74"];
        if (empty($ab)) {
            goto ue;
        }
        echo $ZB["\142\145\146\x6f\x72\x65\137\164\x69\x74\154\x65"] . $ab . $ZB["\141\146\x74\145\162\x5f\x74\x69\164\154\145"];
        ue:
        $this->loginForm();
        echo $ZB["\x61\146\164\145\162\137\x77\x69\x64\x67\x65\164"];
    }
    public function update($RJ, $Mh)
    {
        $hW = array();
        $hW["\x77\151\144\137\164\x69\164\154\145"] = strip_tags($RJ["\x77\151\x64\137\164\x69\x74\154\145"]);
        return $hW;
    }
    public function form($hW)
    {
        $ab = '';
        if (!array_key_exists("\167\151\x64\137\164\151\x74\x6c\145", $hW)) {
            goto ZU;
        }
        $ab = $hW["\x77\x69\144\137\x74\151\164\x6c\x65"];
        ZU:
        echo "\15\12\11\11\74\x70\76\74\154\x61\x62\x65\154\x20\146\x6f\162\x3d\42" . $this->get_field_id("\167\x69\144\x5f\x74\x69\x74\154\x65") . "\40\42\x3e" . _e("\124\151\164\x6c\145\72") . "\40\x3c\x2f\x6c\141\x62\x65\x6c\76\15\xa\x9\x9\x3c\151\156\160\165\164\40\x63\154\141\163\x73\x3d\42\167\151\144\x65\146\141\x74\42\x20\151\144\x3d\x22" . $this->get_field_id("\x77\x69\x64\x5f\x74\151\x74\x6c\x65") . "\42\40\x6e\x61\x6d\145\75\42" . $this->get_field_name("\x77\x69\144\137\164\x69\x74\154\x65") . "\42\x20\x74\x79\160\x65\x3d\x22\164\x65\170\164\x22\x20\166\x61\x6c\x75\x65\75\x22" . $ab . "\42\40\x2f\x3e\xd\12\x9\11\74\x2f\x70\76";
    }
    public function loginForm()
    {
        global $post;
        $Qf = SAMLSPUtilities::mo_saml_is_user_logged_in();
        if (!$Qf) {
            goto Tn;
        }
        $current_user = wp_get_current_user();
        $zJ = "\110\145\154\154\157\54";
        if (!get_option("\x6d\x6f\137\163\x61\155\x6c\137\x63\165\x73\x74\157\x6d\x5f\x67\x72\x65\x65\x74\151\x6e\147\137\x74\x65\170\x74")) {
            goto jN;
        }
        $zJ = get_option("\x6d\157\137\x73\x61\155\x6c\137\143\x75\x73\x74\x6f\155\137\x67\x72\x65\x65\x74\151\x6e\147\137\164\145\x78\x74");
        jN:
        $N9 = '';
        if (!get_option("\x6d\x6f\137\x73\x61\x6d\x6c\137\x67\162\x65\145\164\x69\x6e\x67\x5f\156\x61\155\145")) {
            goto aI;
        }
        switch (get_option("\x6d\157\x5f\163\x61\155\154\137\147\162\145\145\x74\x69\156\x67\x5f\156\141\x6d\145")) {
            case "\x55\x53\105\122\116\x41\x4d\x45":
                $N9 = $current_user->user_login;
                goto Bz;
            case "\x45\115\101\x49\114":
                $N9 = $current_user->user_email;
                goto Bz;
            case "\x46\116\x41\x4d\105":
                $N9 = $current_user->user_firstname;
                goto Bz;
            case "\x4c\116\101\x4d\x45":
                $N9 = $current_user->user_lastname;
                goto Bz;
            case "\106\116\101\x4d\105\137\x4c\116\x41\115\x45":
                $N9 = $current_user->user_firstname . "\x20" . $current_user->user_lastname;
                goto Bz;
            case "\x4c\x4e\101\115\105\x5f\106\116\x41\x4d\105":
                $N9 = $current_user->user_lastname . "\40" . $current_user->user_firstname;
                goto Bz;
            default:
                $N9 = $current_user->user_login;
        }
        Tx:
        Bz:
        aI:
        $N9 = trim($N9);
        if (!empty($N9)) {
            goto HM;
        }
        $N9 = $current_user->user_login;
        HM:
        $qv = $zJ . "\40" . $N9;
        $hU = "\x4c\157\147\x6f\x75\164";
        if (!get_option("\x6d\x6f\137\x73\x61\x6d\154\137\143\x75\x73\x74\x6f\x6d\137\x6c\157\x67\x6f\x75\164\137\x74\x65\170\164")) {
            goto a0;
        }
        $hU = get_option("\155\157\x5f\x73\141\x6d\x6c\137\x63\165\x73\x74\x6f\155\x5f\x6c\157\x67\x6f\165\164\137\164\145\x78\x74");
        a0:
        echo $qv . "\40\x7c\x20\x3c\x61\40\x68\x72\x65\146\x3d\x22" . wp_logout_url(home_url()) . "\x22\x20\164\x69\x74\x6c\x65\75\42\154\157\147\157\165\x74\42\40\76" . $hU . "\x3c\x2f\141\76\x3c\x2f\x6c\151\x3e";
        goto X9;
        Tn:
        $Nj = saml_get_current_page_url();
        echo "\xd\12\x9\x9\74\x73\x63\x72\x69\x70\x74\76\15\xa\x9\11\146\165\156\x63\164\151\157\156\x20\x73\165\142\x6d\x69\164\x53\141\x6d\154\x46\157\x72\155\50\51\173\40\144\x6f\143\165\x6d\145\x6e\x74\56\x67\145\x74\105\x6c\145\155\x65\x6e\x74\102\171\111\144\50\42\x6d\x69\x6e\x69\x6f\x72\x61\156\147\145\x2d\x73\141\155\154\55\x73\x70\55\163\163\x6f\55\154\157\147\x69\156\55\x66\x6f\x72\x6d\42\x29\x2e\x73\x75\x62\155\151\x74\50\51\73\x20\x7d\15\12\11\x9\74\57\163\143\162\x69\160\x74\x3e\15\12\11\x9\74\x66\x6f\162\x6d\x20\x6e\x61\155\x65\75\x22\x6d\x69\x6e\x69\157\162\141\156\147\145\x2d\163\x61\x6d\154\x2d\163\160\55\163\x73\157\x2d\154\157\147\x69\156\55\146\x6f\x72\155\x22\40\x69\144\75\x22\x6d\x69\x6e\x69\x6f\x72\x61\156\147\145\x2d\163\141\155\154\x2d\x73\x70\x2d\163\x73\x6f\55\154\x6f\x67\151\x6e\55\x66\x6f\x72\155\42\40\155\145\164\x68\x6f\x64\75\42\160\157\163\x74\x22\40\141\x63\x74\x69\157\156\75\x22\x22\x3e\xd\xa\11\11\74\x69\x6e\160\x75\x74\40\x74\x79\160\145\75\42\150\151\x64\x64\145\x6e\x22\x20\156\141\155\145\75\x22\x6f\160\164\x69\157\x6e\42\x20\166\141\154\x75\145\75\42\x73\x61\155\154\x5f\165\x73\145\x72\x5f\154\157\x67\151\x6e\42\x20\57\76\xd\xa\x9\x9\x3c\151\x6e\x70\x75\164\x20\164\x79\160\145\75\42\150\151\144\144\145\x6e\x22\40\x6e\141\x6d\x65\75\x22\162\x65\144\151\162\145\x63\164\137\x74\157\x22\x20\166\x61\x6c\x75\x65\75\x22" . $Nj . "\42\40\x2f\76\xd\xa\15\12\11\11\74\x66\x6f\x6e\x74\40\163\x69\x7a\x65\75\42\x2b\x31\42\40\x73\x74\x79\x6c\x65\75\x22\x76\x65\x72\164\151\x63\141\x6c\x2d\x61\x6c\x69\147\156\72\164\157\160\x3b\42\x3e\x20\x3c\57\146\157\156\x74\76";
        $eO = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        if (!empty($eO)) {
            goto FV;
        }
        echo "\120\154\145\x61\163\145\x20\143\157\x6e\x66\151\x67\165\162\145\x20\164\x68\145\40\x6d\151\x6e\x69\x4f\162\141\156\x67\x65\x20\x53\x41\x4d\x4c\x20\120\154\165\x67\151\156\40\146\x69\162\x73\x74\x2e";
        goto rB;
        FV:
        $kX = "\x4c\157\147\151\156\40\x77\x69\x74\x68\40\43\43\111\x44\120\43\x23";
        if (!get_option("\155\157\x5f\x73\141\x6d\154\x5f\143\x75\x73\164\157\155\137\x6c\x6f\147\151\156\x5f\x74\x65\x78\164")) {
            goto Xe;
        }
        $kX = get_option("\155\157\x5f\163\141\x6d\154\x5f\x63\x75\163\164\x6f\155\137\154\157\147\151\x6e\137\x74\145\170\164");
        Xe:
        $kX = str_replace("\43\x23\x49\x44\120\43\x23", $eO, $kX);
        $PF = false;
        if (!get_option("\x6d\x6f\x5f\x73\141\155\x6c\x5f\165\163\x65\137\x62\x75\x74\x74\x6f\x6e\x5f\141\x73\x5f\167\151\144\x67\x65\x74")) {
            goto mR;
        }
        if (!(get_option("\x6d\157\137\163\141\155\x6c\x5f\x75\x73\x65\x5f\142\x75\164\164\x6f\x6e\137\x61\163\137\167\151\144\x67\x65\x74") == "\x74\x72\x75\x65")) {
            goto Nc;
        }
        $PF = true;
        Nc:
        mR:
        if (!$PF) {
            goto jP;
        }
        $Od = get_option("\x6d\x6f\137\163\141\155\154\137\x62\165\164\x74\157\156\x5f\x77\151\144\x74\150") ? get_option("\x6d\157\137\x73\x61\x6d\x6c\x5f\x62\x75\164\164\x6f\x6e\x5f\167\x69\144\x74\150") : "\x31\x30\60";
        $W7 = get_option("\155\157\137\x73\x61\155\x6c\137\x62\x75\164\164\x6f\156\x5f\x68\145\x69\147\150\164") ? get_option("\155\x6f\137\x73\x61\155\154\137\142\x75\164\x74\157\156\137\150\145\151\x67\x68\164") : "\x35\x30";
        $XQ = get_option("\155\157\x5f\163\x61\155\x6c\x5f\142\165\164\164\x6f\156\x5f\x73\151\172\145") ? get_option("\155\157\137\163\x61\155\x6c\137\x62\165\164\x74\x6f\x6e\x5f\163\151\x7a\145") : "\x35\x30";
        $z7 = get_option("\155\x6f\x5f\x73\x61\x6d\154\x5f\142\165\164\164\x6f\x6e\x5f\143\165\162\x76\x65") ? get_option("\155\x6f\x5f\x73\x61\x6d\x6c\137\x62\165\164\164\157\x6e\x5f\143\x75\x72\166\145") : "\65";
        $b1 = get_option("\x6d\x6f\x5f\x73\x61\x6d\x6c\x5f\142\x75\164\x74\157\x6e\x5f\x63\157\154\x6f\x72") ? get_option("\x6d\x6f\x5f\x73\x61\155\154\137\x62\x75\164\164\x6f\156\x5f\143\157\x6c\x6f\162") : "\60\60\70\65\142\x61";
        $Xa = get_option("\x6d\x6f\x5f\x73\x61\155\154\137\142\165\164\164\157\x6e\137\164\x68\145\x6d\x65") ? get_option("\155\x6f\137\163\x61\155\154\137\x62\x75\x74\164\157\156\137\164\150\x65\x6d\x65") : "\x6c\x6f\x6e\x67\142\x75\164\164\157\156";
        $YB = isset($_SESSION["\x6d\x6f\x5f\147\165\145\x73\x74\x5f\x6c\157\x67\x69\x6e"]["\154\x6f\147\147\x65\x64\137\151\156\x5f\151\144\160\x5f\156\141\155\x65"]) ? $_SESSION["\155\157\x5f\x67\x75\145\x73\164\x5f\x6c\157\x67\x69\x6e"]["\x6c\157\147\x67\145\x64\x5f\x69\156\137\x69\x64\x70\x5f\x6e\x61\155\x65"] : LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Identity_name);
        $WD = get_option("\x6d\157\x5f\163\141\x6d\154\137\x62\165\164\164\157\x6e\137\164\x65\170\164") ? get_option("\x6d\157\137\163\141\x6d\154\137\x62\165\164\164\157\156\x5f\x74\145\170\x74") : ($YB ? $YB : "\x4c\157\x67\151\156");
        $j7 = get_option("\x6d\x6f\137\x73\x61\155\154\x5f\x66\x6f\156\x74\x5f\143\157\154\157\162") ? get_option("\x6d\157\x5f\x73\x61\155\154\x5f\146\157\x6e\x74\x5f\143\157\154\x6f\162") : "\146\x66\x66\x66\146\146";
        $dr = get_option("\155\x6f\137\x73\x61\155\x6c\x5f\146\157\156\x74\137\x73\151\x7a\145") ? get_option("\x6d\x6f\x5f\163\141\x6d\154\x5f\146\157\156\x74\137\163\x69\x7a\145") : "\62\x30";
        $kX = "\74\x69\156\160\165\164\x20\x74\171\x70\145\75\42\x62\x75\x74\164\157\x6e\42\x20\156\141\155\x65\75\42\155\157\x5f\x73\141\x6d\x6c\137\x77\160\137\163\x73\x6f\x5f\142\x75\164\164\x6f\x6e\x22\40\x76\141\x6c\165\145\75\x22" . $WD . "\42\x20\x73\164\171\x6c\145\75\x22";
        $qZ = '';
        if ($Xa == "\154\x6f\156\x67\x62\x75\164\164\x6f\x6e") {
            goto eb;
        }
        if ($Xa == "\143\x69\x72\x63\x6c\x65") {
            goto X4;
        }
        if ($Xa == "\x6f\x76\x61\x6c") {
            goto TV;
        }
        if ($Xa == "\163\x71\165\141\x72\x65") {
            goto bm;
        }
        goto MP;
        X4:
        $qZ = $qZ . "\167\151\x64\x74\x68\72" . $XQ . "\x70\170\x3b";
        $qZ = $qZ . "\150\x65\151\147\150\x74\x3a" . $XQ . "\160\170\x3b";
        $qZ = $qZ . "\x62\x6f\x72\x64\145\162\x2d\162\x61\x64\151\165\163\x3a\x39\x39\x39\160\x78\x3b";
        goto MP;
        TV:
        $qZ = $qZ . "\167\151\144\x74\x68\x3a" . $XQ . "\x70\x78\x3b";
        $qZ = $qZ . "\x68\x65\x69\x67\150\164\72" . $XQ . "\x70\170\73";
        $qZ = $qZ . "\x62\157\x72\x64\x65\x72\55\x72\141\x64\x69\165\163\x3a\65\160\170\x3b";
        goto MP;
        bm:
        $qZ = $qZ . "\167\151\x64\x74\x68\x3a" . $XQ . "\160\170\73";
        $qZ = $qZ . "\x68\145\x69\147\150\x74\72" . $XQ . "\x70\170\x3b";
        $qZ = $qZ . "\142\x6f\162\144\x65\x72\55\x72\141\x64\x69\165\x73\x3a\60\x70\x78\x3b";
        MP:
        goto l7;
        eb:
        $qZ = $qZ . "\167\x69\x64\x74\150\x3a" . $Od . "\x70\170\73";
        $qZ = $qZ . "\x68\145\x69\147\150\x74\72" . $W7 . "\160\x78\73";
        $qZ = $qZ . "\142\157\162\x64\x65\x72\55\162\x61\x64\x69\x75\x73\x3a" . $z7 . "\160\170\x3b";
        l7:
        $qZ = $qZ . "\142\x61\x63\x6b\147\162\x6f\165\x6e\x64\x2d\143\157\x6c\x6f\162\x3a\43" . $b1 . "\x3b";
        $qZ = $qZ . "\142\157\x72\144\x65\x72\x2d\143\x6f\154\157\162\x3a\x74\x72\141\156\x73\x70\141\162\x65\156\x74\73";
        $qZ = $qZ . "\143\157\x6c\157\x72\x3a\x23" . $j7 . "\x3b";
        $qZ = $qZ . "\146\x6f\x6e\164\x2d\163\x69\x7a\145\72" . $dr . "\x70\170\x3b";
        $qZ = $qZ . "\x70\141\144\x64\151\156\147\x3a\60\x70\x78\73";
        $kX = $kX . $qZ . "\x22\x2f\76";
        jP:
        echo "\40\x3c\x61\40\x68\162\145\x66\x3d\42\x23\42\x20\157\156\103\154\151\x63\153\75\42\163\165\x62\x6d\151\x74\x53\x61\155\x6c\x46\157\162\x6d\x28\x29\x22\x3e";
        echo $kX;
        echo "\x3c\x2f\141\x3e\74\57\146\x6f\x72\155\x3e\40";
        rB:
        if ($this->mo_saml_check_empty_or_null_val(get_option("\x6d\157\137\163\x61\x6d\154\x5f\x72\145\x64\151\x72\145\x63\x74\x5f\x65\x72\162\x6f\x72\x5f\143\157\x64\x65"))) {
            goto Yu;
        }
        echo "\74\x64\151\x76\76\74\x2f\144\151\x76\x3e\74\x64\x69\166\40\164\x69\164\x6c\145\75\x22\114\157\147\x69\x6e\40\105\162\162\x6f\162\x22\76\x3c\x66\157\x6e\164\40\143\x6f\x6c\x6f\x72\75\42\162\145\x64\x22\x3e\x57\x65\x20\143\x6f\x75\x6c\x64\x20\156\157\x74\40\x73\151\147\156\40\x79\157\165\40\x69\x6e\x2e\x20\x50\x6c\x65\141\x73\145\x20\x63\x6f\x6e\164\141\143\x74\x20\x79\x6f\165\162\x20\101\x64\x6d\x69\156\151\x73\164\x72\x61\164\x6f\162\56\74\x2f\146\x6f\x6e\x74\x3e\74\57\144\151\x76\76";
        delete_option("\155\x6f\x5f\x73\x61\x6d\x6c\137\x72\145\144\151\162\x65\x63\x74\137\145\162\162\157\162\137\143\x6f\x64\x65");
        delete_option("\x6d\157\137\x73\x61\x6d\x6c\x5f\x72\145\144\151\162\145\x63\164\137\x65\162\x72\x6f\162\137\x72\x65\141\x73\157\156");
        Yu:
        echo "\x9\74\x2f\165\x6c\76\15\12\x9\11\x3c\x2f\146\x6f\x72\x6d\76";
        X9:
    }
    public function mo_saml_check_empty_or_null_val($nj)
    {
        if (!(!isset($nj) || empty($nj))) {
            goto Su;
        }
        return true;
        Su:
        return false;
    }
    public function mo_saml_widget_init()
    {
        if (!(defined("\127\x50\137\x43\114\111") && WP_CLI)) {
            goto l8;
        }
        require_once dirname(__FILE__) . "\x2f\x6d\157\55\x73\141\155\154\55\167\160\55\143\154\151\55\143\157\155\155\141\156\144\163\x2e\160\x68\160";
        l8:
        if (!(isset($_REQUEST["\157\160\x74\151\157\156"]) and $_REQUEST["\x6f\160\164\151\157\156"] == "\163\x61\x6d\x6c\x5f\165\163\x65\x72\x5f\154\x6f\147\157\x75\x74")) {
            goto Pv;
        }
        $user = is_user_logged_in() ? wp_get_current_user() : null;
        if (empty($user)) {
            goto og;
        }
        $this->mo_saml_logout($user->ID);
        og:
        Pv:
    }
    function mo_saml_logout($DT)
    {
        $user = get_user_by("\x69\x64", $DT);
        $AU = htmlspecialchars_decode(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Logout_URL));
        $Sy = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Logout_binding_type);
        $XD = wp_get_referer();
        $uW = get_option("\155\x6f\137\163\x61\x6d\154\x5f\163\160\x5f\142\x61\163\145\137\165\x72\154");
        if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
            goto Bm;
        }
        session_start();
        Bm:
        if (!empty($XD)) {
            goto AV;
        }
        $XD = !empty($uW) ? $uW : home_url();
        AV:
        if (empty($AU)) {
            goto wU;
        }
        if (isset($_SESSION["\x6d\157\x5f\x73\141\x6d\154\137\154\x6f\147\x6f\x75\x74\x5f\162\145\x71\x75\x65\x73\164"])) {
            goto Df;
        }
        if (isset($_SESSION["\x6d\x6f\x5f\163\141\155\154"]["\x6c\x6f\147\147\x65\144\137\151\x6e\137\x77\151\x74\x68\x5f\x69\x64\x70"])) {
            goto WD;
        }
        goto e4;
        Df:
        self::createLogoutResponseAndRedirect($AU, $Sy);
        exit;
        goto e4;
        WD:
        $current_user = $user;
        if (isset($_SESSION["\x6d\157\137\x67\165\145\163\164\137\x6c\157\x67\151\x6e"]["\x6e\141\155\x65\111\x44"])) {
            goto Eu;
        }
        if (isset($_COOKIE["\x6e\141\x6d\145\x49\x44"])) {
            goto fk;
        }
        $Jw = get_user_meta($current_user->ID, "\x6d\157\137\x73\x61\x6d\154\x5f\x6e\x61\x6d\145\137\151\144");
        goto Ep;
        fk:
        $Jw = $_COOKIE["\156\x61\x6d\145\111\104"];
        Ep:
        goto EV;
        Eu:
        $Jw = $_SESSION["\155\x6f\x5f\x67\x75\145\163\x74\137\x6c\157\x67\x69\x6e"]["\x6e\x61\155\145\111\x44"];
        EV:
        if (isset($_SESSION["\x6d\157\x5f\x67\165\145\x73\x74\137\154\x6f\x67\x69\156"]["\x73\145\x73\x73\151\157\156\x49\x6e\x64\145\x78"])) {
            goto d8;
        }
        if (isset($_COOKIE["\163\145\x73\x73\x69\x6f\156\x49\x6e\x64\x65\170"])) {
            goto DN;
        }
        $rB = get_user_meta($current_user->ID, "\x6d\157\x5f\x73\141\155\154\x5f\163\145\163\x73\x69\x6f\x6e\x5f\151\156\x64\x65\170");
        goto rs;
        DN:
        $rB = $_COOKIE["\163\x65\x73\163\x69\157\x6e\111\x6e\144\x65\170"];
        rs:
        goto DZ;
        d8:
        $rB = $_SESSION["\x6d\x6f\137\x67\x75\x65\163\x74\x5f\154\x6f\147\151\156"]["\163\145\x73\163\x69\x6f\156\111\x6e\144\x65\x78"];
        DZ:
        if (empty($Jw)) {
            goto HL;
        }
        unset($_SESSION["\x6d\157\x5f\x73\141\155\x6c"]);
        unset($_SESSION["\x6d\x6f\137\x67\x75\145\163\x74\x5f\x6c\157\x67\151\x6e"]);
        setcookie("\x6e\x61\155\x65\111\x44", '', time() - 3600, "\57");
        setcookie("\163\145\x73\x73\x69\157\x6e\111\156\x64\145\x78", '', time() - 3600, "\57");
        mo_saml_create_logout_request($Jw, $rB, $AU, $Sy, $XD);
        HL:
        e4:
        wU:
        if (!isset($_SESSION["\155\x6f\137\x67\x75\145\x73\x74\x5f\x6c\x6f\147\151\x6e"]["\156\141\x6d\x65\x49\104"])) {
            goto dS;
        }
        unset($_SESSION["\x6d\157\x5f\147\165\x65\163\164\137\154\157\x67\x69\x6e"]);
        setcookie("\x6e\141\x6d\x65\x49\104", '', time() - 3600, "\57");
        setcookie("\x73\x65\163\163\151\157\x6e\111\156\x64\145\170", '', time() - 3600, "\57");
        dS:
        $KO = get_option("\155\x6f\x5f\x73\x61\155\154\x5f\x6c\157\147\x6f\165\164\x5f\x72\145\154\141\171\x5f\163\x74\x61\164\145");
        if (empty($KO)) {
            goto eN;
        }
        wp_redirect($KO);
        exit;
        eN:
        return $XD;
    }
    function createLogoutResponseAndRedirect($AU, $Sy)
    {
        $uW = get_option("\x6d\157\x5f\x73\141\x6d\154\137\x73\x70\137\142\x61\163\145\137\x75\x72\x6c");
        if (!empty($uW)) {
            goto cW;
        }
        $uW = home_url();
        cW:
        $me = $_SESSION["\155\157\x5f\x73\141\x6d\x6c\x5f\154\x6f\147\x6f\165\x74\x5f\x72\145\161\x75\x65\x73\x74"];
        $yZ = $_SESSION["\x6d\x6f\137\163\141\x6d\154\137\154\157\x67\157\165\x74\137\162\x65\x6c\141\171\137\163\164\141\164\x65"];
        unset($_SESSION["\x6d\x6f\x5f\x73\x61\155\154\137\154\157\147\157\165\x74\137\162\145\x71\x75\x65\x73\x74"]);
        unset($_SESSION["\x6d\x6f\137\x73\x61\x6d\154\137\x6c\157\x67\157\165\164\x5f\162\x65\154\x61\x79\137\x73\x74\x61\x74\x65"]);
        $Jl = new DOMDocument();
        $Jl->loadXML($me);
        $me = $Jl->firstChild;
        if (!($me->localName == "\114\157\147\x6f\x75\164\x52\145\x71\x75\x65\x73\x74")) {
            goto uM;
        }
        $SW = new SAML2SPLogoutRequest($me);
        $Hq = get_option("\x6d\157\137\163\141\155\x6c\137\163\160\137\x65\156\x74\151\x74\171\x5f\x69\x64");
        if (!empty($Hq)) {
            goto Yy;
        }
        $Hq = $uW . "\57\x77\x70\x2d\143\157\156\164\x65\x6e\164\57\x70\154\165\x67\x69\156\x73\x2f\x6d\x69\x6e\151\157\x72\141\156\147\x65\x2d\163\141\155\x6c\55\62\x30\x2d\163\x69\x6e\147\154\145\x2d\163\151\147\x6e\55\157\156\57";
        Yy:
        $GH = $AU;
        $vu = SAMLSPUtilities::createLogoutResponse($SW->getId(), $Hq, $GH, $Sy);
        if (empty($Sy) || $Sy == "\110\164\x74\160\x52\145\x64\151\x72\145\143\164") {
            goto qc;
        }
        if (!(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Request_signed) != "\143\x68\145\143\153\145\x64")) {
            goto jD;
        }
        $z1 = base64_encode($vu);
        SAMLSPUtilities::postSAMLResponse($AU, $z1, $yZ);
        exit;
        jD:
        $gG = '';
        $J1 = '';
        $z1 = SAMLSPUtilities::signXML($vu, "\x53\164\x61\164\165\x73");
        SAMLSPUtilities::postSAMLResponse($AU, $z1, $yZ);
        goto mj;
        qc:
        $ud = $AU;
        if (strpos($AU, "\x3f") !== false) {
            goto z4;
        }
        $ud .= "\x3f";
        goto PF;
        z4:
        $ud .= "\46";
        PF:
        if (!(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Request_signed) != "\143\x68\x65\x63\153\x65\x64")) {
            goto Nh;
        }
        $ud .= "\x53\101\x4d\114\x52\x65\163\160\x6f\x6e\163\145\x3d" . $vu . "\46\122\x65\x6c\141\171\123\x74\x61\x74\x65\75" . urlencode($yZ);
        header("\114\x6f\x63\x61\x74\151\157\x6e\72\40" . $ud);
        exit;
        Nh:
        $AA = "\x53\101\x4d\114\122\x65\163\160\x6f\156\x73\145\75" . $vu . "\46\x52\x65\154\x61\x79\x53\x74\x61\x74\145\75" . urlencode($yZ) . "\46\x53\151\147\101\154\147\75" . urlencode(XMLSecurityKey::RSA_SHA256);
        $we = array("\164\x79\160\x65" => "\x70\x72\151\166\141\164\145");
        $y9 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $we);
        $ln = get_option("\155\157\137\163\x61\x6d\154\x5f\143\x75\162\x72\145\x6e\164\137\143\x65\x72\x74\x5f\160\162\x69\x76\x61\x74\x65\137\x6b\145\x79");
        $y9->loadKey($ln, FALSE);
        $Ce = new XMLSecurityDSig();
        $IB = $y9->signData($AA);
        $IB = base64_encode($IB);
        $ud .= $AA . "\46\x53\151\147\156\141\x74\x75\162\x65\x3d" . urlencode($IB);
        header("\114\157\x63\x61\164\151\x6f\x6e\x3a\x20" . $ud);
        exit;
        mj:
        uM:
    }
}
function mo_saml_create_logout_request($Jw, $rB, $AU, $Sy, $XD)
{
    $uW = get_option("\155\157\137\163\141\x6d\x6c\x5f\x73\160\137\x62\x61\163\145\x5f\x75\x72\x6c");
    if (!empty($uW)) {
        goto ax;
    }
    $uW = home_url();
    ax:
    $Hq = get_option("\x6d\x6f\x5f\x73\141\155\x6c\137\163\160\137\145\156\164\x69\164\x79\137\x69\x64");
    if (!empty($Hq)) {
        goto s4;
    }
    $Hq = $uW . "\x2f\167\x70\55\143\157\156\164\x65\156\164\x2f\x70\154\x75\x67\x69\156\x73\57\x6d\x69\156\x69\157\x72\141\x6e\147\x65\55\x73\141\x6d\x6c\x2d\x32\x30\55\x73\x69\156\x67\154\x65\x2d\163\151\x67\156\55\157\x6e\x2f";
    s4:
    $GH = $AU;
    $gA = $XD;
    $gA = mo_saml_get_relay_state($gA);
    $AA = SAMLSPUtilities::createLogoutRequest($Jw, $Hq, $GH, $rB, $Sy);
    if (empty($Sy) || $Sy == "\x48\x74\164\160\x52\145\x64\x69\162\x65\x63\x74") {
        goto C3;
    }
    if (!(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Request_signed) != "\x63\x68\x65\x63\153\x65\x64")) {
        goto nl;
    }
    $z1 = base64_encode($AA);
    SAMLSPUtilities::postSAMLRequest($AU, $z1, $gA);
    exit;
    nl:
    $gG = '';
    $J1 = '';
    $z1 = SAMLSPUtilities::signXML($AA, "\116\141\155\x65\111\104");
    SAMLSPUtilities::postSAMLRequest($AU, $z1, $gA);
    goto Ql;
    C3:
    $ud = $AU;
    if (strpos($AU, "\77") !== false) {
        goto Aa;
    }
    $ud .= "\x3f";
    goto RG;
    Aa:
    $ud .= "\46";
    RG:
    if (!(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Request_signed) != "\x63\150\x65\x63\153\145\144")) {
        goto H8;
    }
    $ud .= "\x53\101\115\114\122\145\x71\x75\x65\x73\164\75" . $AA . "\46\x52\x65\x6c\x61\171\x53\164\x61\x74\x65\75" . urlencode($gA);
    header("\x4c\x6f\143\141\x74\151\157\156\x3a\40" . $ud);
    exit;
    H8:
    $AA = "\x53\x41\x4d\x4c\122\x65\x71\x75\145\163\164\x3d" . $AA . "\46\122\x65\x6c\141\171\123\x74\x61\164\145\x3d" . urlencode($gA) . "\x26\123\151\147\101\x6c\x67\75" . urlencode(XMLSecurityKey::RSA_SHA256);
    $we = array("\164\171\x70\145" => "\160\x72\151\166\x61\x74\145");
    $y9 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $we);
    $ln = get_option("\155\157\x5f\x73\x61\x6d\154\x5f\x63\x75\x72\162\145\x6e\x74\137\143\x65\x72\x74\x5f\160\x72\151\x76\x61\x74\145\x5f\153\x65\171");
    $y9->loadKey($ln, FALSE);
    $Ce = new XMLSecurityDSig();
    $IB = $y9->signData($AA);
    $IB = base64_encode($IB);
    $ud .= $AA . "\x26\123\x69\x67\156\x61\164\165\x72\x65\75" . urlencode($IB);
    header("\x4c\x6f\143\x61\164\151\x6f\156\x3a\40" . $ud);
    exit;
    Ql:
}
function mo_login_validate()
{
    if (!(isset($_REQUEST["\157\160\164\x69\157\156"]) && $_REQUEST["\x6f\x70\164\151\157\156"] == "\155\157\x73\141\155\154\137\155\145\164\x61\x64\141\164\x61")) {
        goto JV;
    }
    miniorange_generate_metadata();
    JV:
    if (!(isset($_REQUEST["\157\x70\x74\x69\x6f\156"]) && $_REQUEST["\x6f\160\x74\x69\x6f\156"] == "\x65\170\x70\157\162\x74\137\x63\x6f\x6e\146\151\147\x75\162\141\164\151\157\156")) {
        goto ot;
    }
    if (!current_user_can("\x6d\x61\x6e\x61\x67\145\x5f\x6f\x70\164\151\x6f\x6e\x73")) {
        goto Z8;
    }
    miniorange_import_export(true);
    Z8:
    exit;
    ot:
    if (!mo_saml_is_customer_license_verified()) {
        goto jdo;
    }
    if (!(isset($_REQUEST["\157\x70\x74\x69\x6f\x6e"]) && $_REQUEST["\x6f\160\164\151\157\156"] == "\163\141\155\154\137\x75\163\145\162\x5f\x6c\157\147\x69\x6e" || isset($_REQUEST["\x6f\160\164\151\157\x6e"]) && $_REQUEST["\x6f\x70\164\x69\x6f\x6e"] == "\x74\x65\x73\x74\151\144\160\x63\157\x6e\x66\x69\x67" || isset($_REQUEST["\157\160\x74\x69\157\x6e"]) && $_REQUEST["\157\160\164\151\157\x6e"] == "\147\145\x74\163\141\x6d\154\162\145\x71\165\x65\163\x74" || isset($_REQUEST["\x6f\160\164\151\157\x6e"]) && $_REQUEST["\x6f\x70\x74\x69\157\x6e"] == "\147\145\x74\163\141\155\x6c\x72\145\163\160\157\x6e\x73\x65")) {
        goto B38;
    }
    if (!mo_saml_is_sp_configured()) {
        goto HIb;
    }
    if (!(is_user_logged_in() && $_REQUEST["\x6f\160\x74\x69\x6f\156"] == "\163\141\155\154\137\165\x73\x65\162\137\x6c\157\x67\x69\156")) {
        goto XQ;
    }
    if (!isset($_REQUEST["\162\145\144\x69\x72\x65\143\x74\137\x74\157"])) {
        goto N4;
    }
    $TG = htmlspecialchars($_REQUEST["\x72\145\x64\151\x72\145\x63\x74\x5f\164\157"]);
    header("\114\x6f\143\x61\x74\x69\157\156\x3a\40" . $TG);
    exit;
    N4:
    return;
    XQ:
    $uW = get_option("\x6d\157\x5f\x73\141\x6d\154\137\163\x70\x5f\142\x61\163\x65\x5f\x75\162\x6c");
    if (!empty($uW)) {
        goto Uf;
    }
    $uW = home_url();
    Uf:
    if (isset($_REQUEST["\x69\x64\160"]) and !empty($_REQUEST["\x69\x64\160"])) {
        goto Ir;
    }
    $BH = '';
    goto WV;
    Ir:
    $BH = htmlspecialchars($_REQUEST["\151\x64\x70"]);
    WV:
    if ($_REQUEST["\157\160\164\151\x6f\x6e"] == "\x74\x65\x73\164\x69\144\x70\x63\x6f\x6e\x66\151\x67" and array_key_exists("\x6e\145\167\x63\145\x72\164", $_REQUEST)) {
        goto EC;
    }
    if ($_REQUEST["\157\160\164\x69\157\x6e"] == "\164\145\163\164\x69\x64\x70\143\157\x6e\x66\x69\147") {
        goto pS;
    }
    if ($_REQUEST["\x6f\x70\x74\x69\x6f\156"] == "\147\x65\x74\163\x61\x6d\x6c\162\145\161\x75\x65\163\x74") {
        goto C0;
    }
    if ($_REQUEST["\x6f\160\164\151\157\x6e"] == "\147\145\x74\x73\141\155\154\x72\x65\x73\x70\x6f\156\163\x65") {
        goto Re;
    }
    if (get_option("\155\x6f\137\x73\x61\x6d\x6c\137\x72\145\x6c\x61\171\x5f\163\x74\141\164\x65") && get_option("\x6d\157\x5f\163\141\x6d\x6c\137\x72\x65\x6c\141\x79\x5f\x73\164\141\164\145") != '') {
        goto zf;
    }
    if (isset($_REQUEST["\x72\x65\x64\151\x72\145\x63\x74\137\x74\x6f"])) {
        goto jz;
    }
    $gA = wp_get_referer();
    goto ZC;
    jz:
    $gA = htmlspecialchars($_REQUEST["\x72\x65\144\x69\x72\x65\143\164\x5f\x74\157"]);
    ZC:
    goto F8;
    zf:
    $gA = get_option("\155\157\x5f\163\141\x6d\154\137\162\x65\154\x61\x79\x5f\x73\164\x61\x74\145");
    F8:
    goto GG;
    Re:
    $gA = "\x64\x69\x73\160\154\141\171\x53\101\x4d\x4c\x52\145\x73\160\157\x6e\163\x65";
    GG:
    goto Ah;
    C0:
    $gA = "\144\151\x73\160\x6c\141\171\x53\101\115\x4c\x52\x65\161\165\x65\163\164";
    Ah:
    goto wr;
    pS:
    $gA = "\164\145\x73\x74\x56\141\154\x69\x64\x61\164\145";
    wr:
    goto Ax;
    EC:
    $gA = "\164\x65\x73\164\x4e\145\167\103\145\x72\164\x69\146\x69\143\x61\164\145";
    Ax:
    if (!empty($gA)) {
        goto Cj;
    }
    $gA = $uW;
    Cj:
    $jG = htmlspecialchars_decode(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Login_URL));
    $mj = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Login_binding_type);
    $z8 = get_option("\x6d\x6f\x5f\x73\x61\155\154\137\x66\x6f\x72\143\x65\x5f\141\165\x74\x68\145\156\164\x69\x63\x61\x74\151\x6f\156");
    $hC = $uW . "\57";
    $Hq = get_option("\155\x6f\x5f\163\141\x6d\154\x5f\x73\160\x5f\x65\x6e\164\151\x74\x79\x5f\151\x64");
    $AS = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::NameID_Format);
    if (!empty($AS)) {
        goto dw;
    }
    $AS = "\61\x2e\61\72\156\141\x6d\x65\x69\x64\55\146\x6f\x72\155\x61\x74\x3a\165\156\x73\160\x65\x63\151\x66\151\x65\144";
    dw:
    if (!empty($Hq)) {
        goto TnZ;
    }
    $Hq = $uW . "\57\x77\160\x2d\x63\157\156\164\x65\x6e\x74\x2f\160\154\x75\x67\151\x6e\163\x2f\x6d\x69\156\151\157\x72\141\x6e\x67\145\55\163\x61\155\154\55\62\x30\x2d\x73\x69\156\x67\x6c\x65\55\x73\x69\147\156\x2d\157\156\x2f";
    TnZ:
    $AA = SAMLSPUtilities::createAuthnRequest($hC, $Hq, $jG, $z8, $mj, $AS);
    if (!($gA == "\144\x69\163\x70\x6c\141\x79\123\x41\x4d\x4c\122\x65\161\x75\x65\163\x74")) {
        goto Wws;
    }
    mo_saml_show_SAML_log(SAMLSPUtilities::createAuthnRequest($hC, $Hq, $jG, $z8, "\110\124\x54\x50\120\x6f\163\164", $AS), $gA);
    Wws:
    $ud = $jG;
    if (strpos($jG, "\x3f") !== false) {
        goto Hvi;
    }
    $ud .= "\77";
    goto icv;
    Hvi:
    $ud .= "\x26";
    icv:
    cldjkasjdksalc();
    $gA = mo_saml_get_relay_state($gA);
    $gA = empty($gA) ? "\57" : $gA;
    if (empty($mj) || $mj == "\x48\x74\x74\160\122\x65\x64\151\x72\x65\143\x74") {
        goto Pk0;
    }
    if (!(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Request_signed) != "\x63\150\145\143\153\145\x64")) {
        goto h8g;
    }
    $z1 = base64_encode($AA);
    SAMLSPUtilities::postSAMLRequest($jG, $z1, $gA);
    exit;
    h8g:
    $gG = '';
    $J1 = '';
    if ($_REQUEST["\157\x70\164\151\x6f\x6e"] == "\164\145\163\x74\151\x64\x70\143\x6f\156\x66\x69\x67" && array_key_exists("\156\x65\167\143\x65\162\164", $_REQUEST)) {
        goto Ph5;
    }
    $z1 = SAMLSPUtilities::signXML($AA, "\x4e\141\155\145\111\104\x50\x6f\154\x69\143\171");
    goto ZkQ;
    Ph5:
    $z1 = SAMLSPUtilities::signXML($AA, "\116\x61\x6d\145\x49\x44\x50\x6f\x6c\x69\x63\171", true);
    ZkQ:
    SAMLSPUtilities::postSAMLRequest($jG, $z1, $gA, $BH);
    update_option("\155\157\137\x73\141\155\x6c\x5f\x6e\x65\167\137\x63\x65\x72\164\x5f\x74\145\163\164", true);
    goto Bz1;
    Pk0:
    if (!(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Request_signed) != "\143\150\145\143\x6b\145\144")) {
        goto xU1;
    }
    $ud .= "\123\x41\x4d\x4c\x52\x65\161\165\145\163\x74\x3d" . $AA . "\46\x52\145\x6c\x61\x79\x53\164\x61\164\145\75" . urlencode($gA);
    if (empty($BH)) {
        goto rpm;
    }
    $ud .= "\46\165\163\x65\x72\116\x61\x6d\x65\75" . $BH;
    rpm:
    header("\143\141\143\x68\x65\x2d\x63\x6f\x6e\164\162\157\154\72\x20\155\x61\170\x2d\141\147\145\75\60\x2c\x20\x70\x72\151\x76\141\164\x65\54\x20\x6e\157\x2d\x73\164\157\162\145\54\x20\156\x6f\55\x63\141\143\x68\145\54\40\155\x75\163\x74\55\x72\x65\166\141\154\151\x64\x61\x74\x65");
    header("\114\157\143\141\x74\x69\x6f\x6e\x3a\x20" . $ud);
    exit;
    xU1:
    $AA = "\123\x41\115\114\x52\x65\161\165\x65\x73\x74\75" . $AA . "\46\122\145\154\141\x79\123\164\x61\x74\145\x3d" . urlencode($gA) . "\46\123\151\x67\101\154\x67\x3d" . urlencode(XMLSecurityKey::RSA_SHA256);
    $we = array("\164\x79\x70\145" => "\160\162\x69\x76\x61\x74\x65");
    $y9 = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, $we);
    if ($_REQUEST["\x6f\160\164\x69\157\156"] == "\x74\145\163\x74\x69\x64\160\x63\157\156\146\151\x67" && array_key_exists("\x6e\x65\167\x63\145\x72\164", $_REQUEST)) {
        goto juQ;
    }
    $ln = get_option("\x6d\x6f\x5f\x73\x61\155\x6c\x5f\143\165\x72\x72\x65\x6e\x74\x5f\143\145\x72\164\137\x70\162\x69\x76\141\x74\145\x5f\x6b\145\171");
    goto cgZ;
    juQ:
    $ln = file_get_contents(plugin_dir_path(__FILE__) . "\162\145\163\157\x75\162\x63\x65\x73" . DIRECTORY_SEPARATOR . "\x6d\151\156\151\x6f\162\141\156\147\145\x5f\x73\x70\137\x32\x30\x32\x30\x5f\x70\x72\151\x76\x2e\153\x65\x79");
    cgZ:
    $y9->loadKey($ln, FALSE);
    $Ce = new XMLSecurityDSig();
    $IB = $y9->signData($AA);
    $IB = base64_encode($IB);
    $ud .= $AA . "\x26\x53\151\x67\156\141\x74\x75\x72\x65\75" . urlencode($IB);
    if (empty($BH)) {
        goto WV5;
    }
    $ud .= "\x26\165\x73\x65\162\x4e\141\x6d\145\x3d" . $BH;
    WV5:
    header("\143\x61\x63\150\145\55\x63\157\156\x74\x72\x6f\154\72\x20\x6d\x61\170\55\x61\x67\x65\x3d\60\54\40\x70\162\151\x76\x61\164\145\54\40\156\157\55\x73\164\157\162\145\x2c\40\156\157\x2d\x63\141\143\150\145\x2c\40\155\165\163\x74\x2d\162\145\x76\x61\x6c\151\144\141\x74\145");
    header("\x4c\157\x63\141\164\x69\157\x6e\72\x20" . $ud);
    exit;
    Bz1:
    HIb:
    B38:
    if (!(array_key_exists("\x53\x41\x4d\x4c\122\x65\163\160\x6f\156\x73\145", $_REQUEST) && !empty($_REQUEST["\x53\x41\x4d\114\122\145\x73\160\157\x6e\163\x65"]))) {
        goto KHM;
    }
    if (array_key_exists("\x52\145\x6c\141\x79\123\x74\x61\164\x65", $_POST) && !empty($_POST["\122\x65\x6c\141\171\x53\x74\x61\x74\x65"]) && $_POST["\122\x65\x6c\x61\171\x53\164\x61\164\x65"] != "\x2f") {
        goto mKF;
    }
    $sl = '';
    goto CNb;
    mKF:
    $sl = $_POST["\122\x65\154\141\171\x53\164\x61\164\x65"];
    CNb:
    $uW = get_option("\x6d\x6f\137\x73\141\x6d\154\x5f\163\160\137\x62\x61\163\145\x5f\165\x72\154");
    if (!empty($uW)) {
        goto fbp;
    }
    $uW = home_url();
    fbp:
    $LA = htmlspecialchars($_REQUEST["\123\101\115\x4c\x52\145\x73\160\x6f\x6e\163\x65"]);
    $LA = base64_decode($LA);
    if (!($sl == "\144\x69\163\x70\154\x61\171\x53\x41\x4d\114\122\145\x73\x70\x6f\156\163\145")) {
        goto Z03;
    }
    mo_saml_show_SAML_log($LA, $sl);
    Z03:
    if (!(array_key_exists("\x53\101\x4d\114\x52\145\163\x70\x6f\x6e\163\x65", $_GET) && !empty($_GET["\123\101\x4d\x4c\122\145\x73\160\x6f\x6e\163\x65"]))) {
        goto YiH;
    }
    $LA = gzinflate($LA);
    YiH:
    $Jl = new DOMDocument();
    $Jl->loadXML($LA);
    $iH = $Jl->firstChild;
    $ra = $Jl->documentElement;
    $eR = new DOMXpath($Jl);
    $eR->registerNamespace("\x73\x61\x6d\154\160", "\165\162\x6e\72\157\x61\x73\x69\x73\x3a\x6e\141\x6d\x65\163\x3a\164\143\72\x53\101\115\114\72\x32\56\60\x3a\160\162\x6f\164\157\x63\x6f\x6c");
    $eR->registerNamespace("\163\x61\155\154", "\x75\x72\156\x3a\x6f\x61\163\151\163\x3a\x6e\x61\x6d\145\x73\72\164\143\x3a\123\101\x4d\x4c\72\62\56\60\x3a\x61\x73\x73\x65\x72\164\151\157\x6e");
    if ($iH->localName == "\x4c\x6f\x67\157\x75\x74\x52\x65\163\x70\157\x6e\x73\x65") {
        goto jpr;
    }
    $Q3 = $eR->query("\x2f\x73\141\x6d\x6c\160\x3a\x52\x65\x73\160\157\x6e\x73\145\57\163\141\155\154\160\x3a\123\164\x61\164\165\163\x2f\163\x61\155\154\160\72\x53\x74\141\164\165\163\x43\x6f\144\145", $ra);
    $wP = $Q3->item(0)->getAttribute("\x56\x61\154\165\x65");
    $yO = $eR->query("\57\163\141\x6d\154\160\72\122\x65\x73\x70\157\x6e\x73\x65\x2f\163\x61\x6d\x6c\160\x3a\x53\164\x61\x74\x75\163\57\163\141\155\154\x70\x3a\x53\x74\141\164\165\163\x4d\145\163\x73\141\147\x65", $ra)->item(0);
    if (empty($yO)) {
        goto xYC;
    }
    $yO = $yO->nodeValue;
    xYC:
    $Z1 = explode("\72", $wP);
    $Q3 = $Z1[7];
    if (array_key_exists("\122\x65\154\141\171\x53\x74\141\164\145", $_POST) && !empty($_POST["\x52\x65\154\x61\x79\123\164\141\164\x65"]) && $_POST["\122\145\154\x61\x79\x53\x74\x61\164\145"] != "\57") {
        goto q3R;
    }
    $sl = '';
    goto jAk;
    q3R:
    $sl = $_POST["\x52\x65\154\x61\x79\x53\x74\x61\x74\x65"];
    jAk:
    if (!($Q3 != "\x53\165\x63\x63\x65\163\163")) {
        goto fFW;
    }
    show_status_error($Q3, $sl, $yO);
    fFW:
    $dF = maybe_unserialize(LicenseHelper::getCurrentOption(mo_options_enum_service_provider::X509_certificate));
    $hC = $uW . "\x2f";
    update_option("\x6d\x6f\137\x73\141\x6d\154\x5f\x72\x65\163\x70\157\x6e\x73\145", base64_encode($LA));
    if ($sl == "\x74\x65\x73\164\x4e\x65\167\103\145\x72\164\151\146\x69\x63\141\x74\x65") {
        goto N8M;
    }
    $LA = new SAML2SPResponse($iH, get_option("\x6d\x6f\x5f\x73\x61\155\154\137\x63\165\x72\162\145\x6e\164\137\143\x65\162\x74\137\160\x72\151\x76\141\x74\x65\x5f\x6b\x65\171"));
    goto R6X;
    N8M:
    $Hk = file_get_contents(plugin_dir_path(__FILE__) . "\x72\145\x73\157\165\x72\143\145\x73" . DIRECTORY_SEPARATOR . "\x6d\151\156\151\x6f\x72\x61\156\147\145\x5f\x73\160\x5f\x32\60\x32\x30\137\160\x72\151\166\56\x6b\x65\171");
    $LA = new SAML2SPResponse($iH, $Hk);
    R6X:
    $NF = $LA->getSignatureData();
    $mA = current($LA->getAssertions())->getSignatureData();
    if (!(empty($mA) && empty($NF))) {
        goto C_n;
    }
    if ($sl == "\164\x65\163\x74\126\x61\154\151\144\x61\x74\145" or $sl == "\x74\x65\x73\164\116\145\x77\x43\x65\x72\164\x69\146\x69\x63\141\x74\145") {
        goto uWm;
    }
    wp_die("\127\145\x20\x63\157\165\154\x64\x20\156\157\x74\40\x73\x69\147\x6e\x20\x79\157\165\x20\x69\156\x2e\40\120\x6c\x65\141\x73\x65\40\x63\157\x6e\x74\x61\143\x74\40\141\x64\x6d\x69\156\151\x73\x74\162\141\164\157\x72", "\105\162\162\x6f\162\72\40\111\x6e\166\141\x6c\x69\x64\x20\123\101\115\114\x20\x52\145\163\x70\157\156\x73\x65");
    goto UrB;
    uWm:
    $NH = mo_options_error_constants::Error_no_certificate;
    $g6 = mo_options_error_constants::Cause_no_certificate;
    echo "\x3c\144\x69\x76\40\163\164\x79\x6c\x65\75\42\146\x6f\156\164\x2d\x66\x61\x6d\151\x6c\171\72\x43\x61\x6c\x69\142\162\151\73\x70\141\x64\x64\x69\156\147\x3a\60\40\x33\45\x3b\x22\x3e\15\12\x9\11\11\x9\x3c\x64\x69\x76\40\163\164\x79\154\x65\75\42\143\157\x6c\157\162\x3a\x20\x23\x61\x39\64\x34\x34\62\73\142\141\143\153\147\x72\157\x75\156\x64\x2d\143\x6f\154\x6f\x72\x3a\x20\x23\x66\x32\144\x65\x64\145\73\160\x61\x64\144\x69\x6e\147\x3a\40\61\x35\x70\170\73\x6d\141\x72\147\x69\x6e\55\x62\157\x74\x74\x6f\x6d\x3a\40\62\x30\160\x78\x3b\x74\x65\x78\164\55\x61\x6c\x69\x67\156\x3a\x63\145\x6e\x74\x65\x72\73\x62\x6f\162\144\x65\162\x3a\61\160\x78\40\x73\157\x6c\151\x64\x20\x23\105\66\x42\x33\x42\x32\73\146\x6f\156\x74\55\x73\151\x7a\145\72\x31\70\x70\164\x3b\42\76\40\x45\122\x52\x4f\x52\x3c\x2f\144\x69\x76\76\xd\xa\x9\11\11\11\x3c\144\151\166\40\x73\164\x79\x6c\145\x3d\42\143\157\154\157\162\x3a\40\x23\141\71\64\64\x34\62\73\146\x6f\156\164\x2d\x73\x69\x7a\x65\x3a\61\64\160\164\73\x20\155\x61\162\x67\151\x6e\55\142\x6f\164\x74\x6f\155\72\x32\x30\160\170\73\42\x3e\74\x70\76\x3c\x73\164\162\x6f\x6e\x67\x3e\x45\162\162\157\162\40\x20\72" . $NH . "\x20\74\x2f\163\x74\x72\x6f\x6e\x67\76\74\x2f\160\x3e\15\12\x9\11\11\11\xd\12\x9\11\x9\11\x3c\160\x3e\x3c\163\164\162\157\156\147\x3e\120\x6f\163\163\x69\x62\x6c\x65\x20\x43\141\165\163\145\72\x20" . $g6 . "\x3c\57\x73\x74\162\x6f\x6e\147\76\x3c\57\x70\x3e\15\12\x9\x9\x9\11\xd\12\x9\11\11\x9\x3c\57\x64\151\166\76\74\57\144\x69\x76\x3e";
    mo_saml_download_logs($NH, $g6);
    exit;
    UrB:
    C_n:
    $x0 = '';
    if (is_array($dF)) {
        goto Rwc;
    }
    $Rb = XMLSecurityKey::getRawThumbprint($dF);
    $Rb = mo_saml_convert_to_windows_iconv($Rb);
    $Rb = preg_replace("\x2f\134\163\53\57", '', $Rb);
    if (empty($NF)) {
        goto ujk;
    }
    $x0 = SAMLSPUtilities::processResponse($hC, $Rb, $NF, $LA, 0, $sl);
    ujk:
    if (empty($mA)) {
        goto m1N;
    }
    $x0 = SAMLSPUtilities::processResponse($hC, $Rb, $mA, $LA, 0, $sl);
    m1N:
    goto Klu;
    Rwc:
    foreach ($dF as $y9 => $nj) {
        $Rb = XMLSecurityKey::getRawThumbprint($nj);
        $Rb = mo_saml_convert_to_windows_iconv($Rb);
        $Rb = preg_replace("\57\134\x73\53\x2f", '', $Rb);
        if (empty($NF)) {
            goto JK4;
        }
        $x0 = SAMLSPUtilities::processResponse($hC, $Rb, $NF, $LA, $y9, $sl);
        JK4:
        if (empty($mA)) {
            goto Eui;
        }
        $x0 = SAMLSPUtilities::processResponse($hC, $Rb, $mA, $LA, $y9, $sl);
        Eui:
        if (!$x0) {
            goto EGv;
        }
        goto xsJ;
        EGv:
        KXO:
    }
    xsJ:
    Klu:
    if ($NF) {
        goto hvL;
    }
    if ($mA) {
        goto H2C;
    }
    goto jNn;
    hvL:
    $Mf = $NF["\x43\x65\162\x74\x69\x66\151\x63\141\164\x65\x73"][0];
    goto jNn;
    H2C:
    $Mf = $mA["\103\x65\x72\x74\151\146\151\x63\141\164\x65\163"][0];
    jNn:
    if ($x0) {
        goto Tf9;
    }
    if ($sl == "\164\145\163\x74\x56\141\154\x69\x64\141\164\x65" or $sl == "\x74\x65\x73\164\x4e\x65\167\103\x65\x72\x74\151\146\151\x63\141\x74\x65") {
        goto hs2;
    }
    wp_die("\x57\145\40\x63\x6f\x75\154\x64\x20\156\157\x74\40\x73\151\147\156\x20\171\157\165\x20\151\x6e\56\x20\x50\x6c\x65\141\x73\x65\x20\143\157\156\164\x61\143\x74\40\x79\157\x75\162\40\141\144\155\151\156\151\x73\164\x72\x61\x74\157\x72", "\105\x72\x72\157\x72\x3a\x20\111\156\166\141\x6c\151\144\40\123\x41\x4d\114\x20\122\x65\x73\x70\157\156\x73\145");
    goto LEl;
    hs2:
    $NH = mo_options_error_constants::Error_wrong_certificate;
    $g6 = mo_options_error_constants::Cause_wrong_certificate;
    $rk = "\55\55\x2d\x2d\x2d\102\105\107\111\116\40\x43\105\122\x54\x49\x46\111\x43\101\x54\x45\55\x2d\55\55\55\74\142\162\x3e" . chunk_split($Mf, 64) . "\x3c\142\162\x3e\55\55\x2d\x2d\x2d\x45\x4e\104\x20\x43\x45\x52\124\x49\x46\111\x43\101\124\105\x2d\x2d\55\55\55";
    echo "\74\144\x69\166\x20\163\164\171\154\x65\75\x22\x66\157\x6e\164\55\146\141\155\x69\154\x79\x3a\x43\141\154\x69\142\162\x69\73\160\141\x64\x64\151\x6e\147\72\60\x20\63\45\x3b\42\76";
    echo "\74\144\151\166\x20\163\164\171\154\145\x3d\42\x63\x6f\154\x6f\x72\72\40\43\141\x39\64\x34\64\62\x3b\x62\141\143\153\147\162\x6f\165\156\144\x2d\143\157\154\157\x72\x3a\40\43\x66\x32\x64\145\144\x65\x3b\160\141\x64\144\151\156\x67\72\x20\x31\65\x70\170\x3b\155\x61\162\x67\x69\x6e\55\142\157\164\164\x6f\155\72\x20\62\60\x70\170\x3b\x74\145\170\164\x2d\141\x6c\x69\x67\x6e\72\143\x65\x6e\x74\x65\162\x3b\142\x6f\162\x64\145\162\x3a\61\x70\170\40\x73\157\154\x69\144\x20\x23\105\x36\102\63\x42\62\73\x66\x6f\156\164\55\163\x69\x7a\145\72\61\70\x70\164\73\x22\x3e\x20\105\122\x52\x4f\122\x3c\57\144\x69\166\76\xd\12\x9\11\x9\74\144\151\166\40\x73\x74\171\154\145\x3d\x22\x63\157\x6c\157\x72\x3a\40\43\141\x39\64\x34\x34\x32\x3b\x66\x6f\x6e\164\55\x73\x69\172\145\72\61\64\160\x74\x3b\x20\x6d\141\162\147\151\x6e\55\x62\157\164\x74\x6f\155\x3a\x32\60\x70\170\73\x22\76\74\x70\x3e\74\x73\x74\162\157\x6e\x67\x3e\x45\162\x72\x6f\162\72\x20\74\x2f\x73\x74\x72\x6f\156\x67\x3e\x55\156\141\x62\x6c\x65\40\164\157\x20\x66\151\x6e\144\40\x61\40\x63\x65\162\x74\x69\146\151\143\141\164\145\x20\155\141\164\143\150\x69\156\x67\40\164\150\x65\x20\143\x6f\x6e\146\x69\147\x75\x72\x65\x64\40\x66\x69\x6e\147\x65\162\x70\x72\151\x6e\164\x2e\74\57\160\x3e\15\12\11\x9\11\74\x70\x3e\120\154\145\x61\x73\x65\40\x63\x6f\x6e\164\141\x63\x74\40\171\x6f\165\x72\x20\141\x64\x6d\x69\156\x69\163\x74\x72\141\164\x6f\162\40\x61\x6e\144\40\162\x65\160\157\x72\164\40\x74\x68\145\40\146\157\x6c\154\157\167\x69\x6e\147\x20\x65\162\162\x6f\162\72\x3c\57\x70\x3e\15\xa\11\x9\11\x3c\160\x3e\x3c\x73\x74\162\x6f\x6e\x67\x3e\x50\x6f\x73\163\151\x62\154\145\x20\103\141\165\x73\x65\x3a\40\x3c\x2f\x73\164\x72\x6f\156\x67\76\47\x58\56\x35\60\x39\40\x43\145\162\164\x69\146\x69\x63\141\x74\x65\47\40\146\x69\x65\x6c\144\x20\151\156\40\160\154\165\x67\151\x6e\40\144\157\145\x73\x20\156\157\x74\40\155\141\x74\143\150\x20\164\x68\x65\x20\x63\145\x72\164\x69\146\151\x63\141\164\x65\x20\x66\157\x75\x6e\144\40\x69\156\40\x53\101\115\114\40\x52\x65\163\x70\157\156\x73\x65\56\x3c\57\x70\76\15\xa\11\11\x9\x3c\x70\x3e\74\x73\164\x72\157\156\147\76\x43\x65\162\x74\151\x66\151\x63\141\164\x65\x20\x66\x6f\165\x6e\144\40\151\156\40\x53\x41\115\x4c\40\122\x65\163\x70\157\156\163\145\x3a\x20\74\57\163\x74\162\157\x6e\147\x3e\x3c\x66\x6f\156\164\x20\146\141\143\145\75\x22\x43\x6f\x75\x72\151\145\162\x20\x4e\145\167\x22\x3b\146\157\156\x74\x2d\x73\x69\172\x65\x3a\x31\60\x70\164\x3e\74\142\x72\76\x3c\142\162\76" . $rk . "\x3c\57\160\76\74\57\x66\x6f\x6e\x74\76\xd\xa\11\11\x9\x3c\x70\76\74\163\x74\162\157\x6e\x67\76\123\x6f\x6c\x75\x74\x69\157\156\72\x20\x3c\57\163\x74\x72\157\156\x67\76\74\57\160\76\15\xa\x9\11\x9\x20\x3c\157\x6c\76\15\12\x20\x20\40\x20\40\40\40\x20\40\40\x20\40\x20\x20\40\x20\x3c\x6c\x69\x3e\103\x6f\160\171\x20\160\x61\x73\x74\x65\40\164\150\145\40\143\145\x72\164\x69\x66\x69\x63\x61\x74\145\x20\160\x72\x6f\x76\x69\144\145\144\40\141\142\157\x76\x65\x20\x69\x6e\40\130\x35\x30\71\40\103\145\x72\x74\x69\146\151\143\x61\164\145\40\x75\x6e\x64\145\x72\40\123\x65\x72\x76\151\x63\x65\40\120\x72\x6f\x76\x69\x64\x65\x72\40\x53\145\x74\165\160\40\x74\x61\142\x2e\x3c\x2f\x6c\151\76\15\xa\40\x20\40\x20\x20\x20\40\40\40\40\40\40\x20\40\x20\40\x3c\154\151\76\x49\146\40\151\163\163\165\145\x20\x70\x65\x72\163\x69\x73\164\x73\40\x64\x69\163\x61\142\x6c\145\x20\x3c\142\x3e\103\x68\x61\x72\x61\x63\x74\145\x72\40\145\x6e\x63\157\x64\x69\156\x67\74\x2f\142\x3e\x20\165\x6e\x64\145\162\x20\123\x65\162\166\x69\143\145\x20\x50\x72\x6f\x76\144\x65\x72\x20\x53\145\x74\165\x70\40\x74\x61\x62\56\x3c\x2f\154\x69\76\15\xa\40\40\x20\40\x20\40\40\x20\x20\40\x20\x20\x20\x3c\57\x6f\x6c\76\x9\x9\xd\12\11\x9\11\x3c\x2f\x64\151\x76\x3e\xd\12\x9\11\x9\11\x9\x3c\x64\151\x76\x20\x73\164\x79\154\145\75\42\x6d\x61\x72\147\151\x6e\x3a\x33\45\x3b\144\151\x73\x70\x6c\x61\x79\x3a\x62\154\x6f\x63\153\x3b\164\145\170\x74\x2d\141\154\x69\147\x6e\72\143\145\156\164\x65\162\x3b\42\x3e\xd\12\x9\11\11\x9\x9\x3c\x64\x69\166\x20\x73\164\x79\154\x65\75\x22\155\x61\162\x67\x69\156\x3a\63\45\73\x64\151\163\160\154\141\x79\72\x62\x6c\x6f\143\153\x3b\164\145\x78\164\x2d\x61\x6c\151\147\x6e\72\143\x65\x6e\x74\145\x72\x3b\42\x3e\x3c\x69\156\160\x75\164\40\x73\164\171\154\x65\x3d\42\x70\x61\x64\144\x69\156\x67\x3a\x31\x25\x3b\167\151\144\164\x68\x3a\x31\x30\x30\160\170\73\142\141\x63\x6b\147\162\x6f\x75\x6e\x64\72\x20\x23\x30\60\x39\x31\x43\104\x20\x6e\x6f\x6e\x65\40\162\x65\x70\145\x61\x74\40\163\143\x72\157\x6c\x6c\40\x30\45\x20\x30\x25\x3b\x63\165\162\163\157\162\72\40\160\157\151\156\x74\145\162\73\146\157\156\x74\x2d\x73\151\x7a\x65\72\61\x35\160\x78\73\142\x6f\162\x64\x65\162\55\167\x69\144\x74\150\72\x20\61\160\170\x3b\x62\157\162\144\145\162\55\x73\164\171\154\145\72\40\x73\x6f\154\x69\x64\x3b\x62\x6f\x72\x64\x65\x72\55\x72\141\144\151\165\163\72\40\63\x70\170\73\167\x68\x69\164\x65\x2d\163\160\141\x63\x65\x3a\40\x6e\x6f\x77\x72\141\x70\73\x62\x6f\x78\55\163\151\172\151\x6e\147\x3a\x20\142\157\162\x64\x65\x72\55\x62\157\170\x3b\x62\157\162\144\x65\x72\55\143\157\154\x6f\x72\72\40\43\x30\x30\67\63\x41\101\x3b\x62\157\x78\55\x73\x68\141\144\x6f\x77\72\x20\x30\x70\170\40\x31\160\170\40\x30\x70\x78\x20\162\147\142\x61\x28\61\62\x30\x2c\x20\62\60\x30\x2c\40\x32\63\x30\54\x20\60\56\x36\x29\x20\151\x6e\163\x65\164\73\x63\x6f\154\x6f\162\x3a\x20\43\106\106\x46\x3b\x22\164\171\160\x65\x3d\x22\142\x75\164\x74\157\156\x22\40\x76\x61\154\165\145\x3d\x22\104\x6f\x6e\x65\42\40\x6f\156\103\154\x69\143\153\75\x22\x73\x65\154\146\x2e\143\154\x6f\x73\145\50\x29\73\x22\x3e\x3c\57\144\151\166\x3e";
    mo_saml_download_logs($NH, $g6);
    exit;
    LEl:
    Tf9:
    $JV = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Issuer);
    $Hq = get_option("\155\x6f\x5f\x73\141\155\x6c\x5f\x73\160\x5f\x65\156\x74\151\164\171\x5f\151\x64");
    if (!empty($Hq)) {
        goto F80;
    }
    $Hq = $uW . "\57\167\160\55\143\157\156\164\x65\156\x74\57\x70\154\x75\147\x69\x6e\163\x2f\x6d\x69\x6e\151\x6f\x72\x61\156\147\x65\x2d\163\141\x6d\x6c\55\62\x30\55\x73\x69\156\147\x6c\x65\x2d\163\x69\x67\x6e\x2d\157\156\x2f";
    F80:
    SAMLSPUtilities::validateIssuerAndAudience($LA, $Hq, $JV, $sl);
    $E8 = current(current($LA->getAssertions())->getNameId());
    $Nz = current($LA->getAssertions())->getAttributes();
    $Nz["\x4e\141\155\145\111\x44"] = array("\60" => $E8);
    $rB = current($LA->getAssertions())->getSessionIndex();
    mo_saml_checkMapping($Nz, $sl, $rB);
    goto bue;
    jpr:
    if (!isset($_REQUEST["\122\x65\154\141\x79\x53\164\141\164\x65"])) {
        goto KOC;
    }
    $yZ = $_REQUEST["\x52\145\x6c\141\x79\x53\164\x61\x74\145"];
    KOC:
    $KO = get_option("\x6d\157\x5f\163\x61\x6d\154\137\x6c\x6f\147\x6f\165\x74\x5f\162\x65\154\x61\171\137\x73\x74\x61\x74\145");
    if (empty($KO)) {
        goto qGd;
    }
    $yZ = $KO;
    qGd:
    wp_logout();
    if (!empty($yZ)) {
        goto qcz;
    }
    $yZ = home_url();
    qcz:
    header("\x4c\x6f\143\x61\164\151\157\156\72\40" . $yZ);
    exit;
    bue:
    KHM:
    if (!(array_key_exists("\x53\101\x4d\x4c\122\x65\x71\x75\145\x73\x74", $_REQUEST) && !empty($_REQUEST["\123\101\x4d\x4c\x52\x65\x71\165\x65\x73\164"]))) {
        goto NFM;
    }
    $AA = htmlspecialchars($_REQUEST["\123\101\x4d\114\x52\x65\161\165\145\x73\x74"]);
    $sl = "\x2f";
    if (!array_key_exists("\x52\145\154\x61\x79\123\164\141\x74\x65", $_REQUEST)) {
        goto akU;
    }
    $sl = $_REQUEST["\122\x65\154\x61\x79\123\x74\141\x74\145"];
    akU:
    $AA = base64_decode($AA);
    if (!(array_key_exists("\123\x41\x4d\x4c\122\x65\161\x75\x65\163\x74", $_GET) && !empty($_GET["\x53\x41\x4d\x4c\122\145\x71\165\145\163\164"]))) {
        goto kV5;
    }
    $AA = gzinflate($AA);
    kV5:
    $Jl = new DOMDocument();
    $Jl->loadXML($AA);
    $vh = $Jl->firstChild;
    if (!($vh->localName == "\114\x6f\x67\x6f\165\164\x52\x65\161\x75\145\x73\164")) {
        goto pPg;
    }
    $SW = new SAML2SPLogoutRequest($vh);
    if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
        goto qje;
    }
    session_start();
    qje:
    $_SESSION["\155\x6f\137\163\x61\155\154\x5f\x6c\157\147\157\165\x74\137\162\x65\x71\165\145\163\x74"] = $AA;
    $_SESSION["\x6d\x6f\137\x73\141\155\154\137\154\157\x67\157\165\164\x5f\162\x65\x6c\141\x79\137\x73\164\x61\x74\x65"] = $sl;
    wp_redirect(htmlspecialchars_decode(wp_logout_url()));
    exit;
    pPg:
    NFM:
    if (!(isset($_REQUEST["\157\x70\164\x69\157\x6e"]) and strpos($_REQUEST["\157\160\x74\x69\x6f\x6e"], "\x72\145\141\x64\163\141\x6d\154\154\x6f\147\151\x6e") !== false)) {
        goto vQm;
    }
    require_once dirname(__FILE__) . "\x2f\x69\156\x63\154\165\x64\145\163\57\154\151\142\x2f\x65\x6e\x63\x72\171\x70\x74\x69\x6f\156\56\x70\150\160";
    if (isset($_POST["\123\124\101\x54\x55\x53"]) && $_POST["\123\124\x41\124\x55\x53"] == "\105\122\122\117\122") {
        goto wyr;
    }
    if (!(isset($_POST["\123\124\x41\124\125\x53"]) && $_POST["\123\x54\101\124\x55\x53"] == "\123\125\x43\x43\x45\123\x53")) {
        goto NJ8;
    }
    $Nj = '';
    if (!(isset($_REQUEST["\x72\145\x64\151\x72\x65\143\x74\x5f\164\157"]) && !empty($_REQUEST["\x72\145\x64\151\x72\x65\143\164\137\164\157"]) && $_REQUEST["\162\145\144\x69\162\x65\143\x74\137\164\x6f"] != "\x2f")) {
        goto aqf;
    }
    $Nj = htmlspecialchars($_REQUEST["\162\145\144\151\x72\x65\143\x74\137\164\157"]);
    aqf:
    delete_option("\x6d\157\137\163\141\155\x6c\x5f\162\x65\x64\x69\x72\145\x63\164\x5f\x65\162\x72\157\x72\137\x63\x6f\x64\145");
    delete_option("\x6d\x6f\x5f\163\141\155\154\x5f\162\145\x64\151\162\x65\143\x74\137\x65\162\x72\x6f\x72\x5f\x72\x65\x61\x73\x6f\156");
    try {
        $u4 = get_option("\x73\x61\155\x6c\x5f\x61\155\x5f\145\x6d\x61\151\x6c");
        $y3 = get_option("\x73\141\155\x6c\x5f\x61\x6d\137\x75\163\x65\162\156\x61\155\x65");
        $dh = get_option("\163\x61\155\154\x5f\x61\155\x5f\x66\151\x72\163\164\x5f\x6e\x61\155\x65");
        $Sj = get_option("\x73\141\x6d\x6c\137\x61\x6d\x5f\154\141\x73\164\137\156\141\x6d\x65");
        $sM = get_option("\163\141\155\154\137\141\x6d\137\147\162\x6f\x75\x70\137\x6e\x61\x6d\145");
        $Hc = get_option("\163\141\155\x6c\x5f\141\x6d\137\144\145\146\141\x75\x6c\x74\x5f\165\163\145\162\x5f\162\157\154\145");
        $Hf = get_option("\163\141\155\154\x5f\141\155\137\x64\157\x6e\x74\137\x61\154\x6c\x6f\167\x5f\x75\x6e\154\151\163\164\x65\144\137\x75\x73\x65\162\x5f\162\157\154\145");
        $us = get_option("\163\x61\x6d\x6c\x5f\141\155\137\141\143\x63\157\x75\156\x74\137\155\141\164\143\150\145\162");
        $iD = '';
        $mh = '';
        $dh = str_replace("\x2e", "\137", $dh);
        $dh = str_replace("\40", "\137", $dh);
        if (!(!empty($dh) && array_key_exists($dh, $_POST))) {
            goto FxU;
        }
        $dh = htmlspecialchars($_POST[$dh]);
        FxU:
        $Sj = str_replace("\56", "\x5f", $Sj);
        $Sj = str_replace("\40", "\x5f", $Sj);
        if (!(!empty($Sj) && array_key_exists($Sj, $_POST))) {
            goto pjC;
        }
        $Sj = htmlspecialchars($_POST[$Sj]);
        pjC:
        $y3 = str_replace("\x2e", "\137", $y3);
        $y3 = str_replace("\40", "\137", $y3);
        if (!empty($y3) && array_key_exists($y3, $_POST)) {
            goto Sbp;
        }
        $mh = htmlspecialchars($_POST["\x4e\141\155\x65\111\x44"]);
        goto Atp;
        Sbp:
        $mh = htmlspecialchars($_POST[$y3]);
        Atp:
        $iD = str_replace("\x2e", "\x5f", $u4);
        $iD = str_replace("\x20", "\x5f", $u4);
        if (!empty($u4) && array_key_exists($u4, $_POST)) {
            goto MaC;
        }
        $iD = htmlspecialchars($_POST["\116\141\155\145\111\104"]);
        goto QTA;
        MaC:
        $iD = htmlspecialchars($_POST[$u4]);
        QTA:
        $sM = str_replace("\x2e", "\137", $sM);
        $sM = str_replace("\40", "\137", $sM);
        if (!(!empty($sM) && array_key_exists($sM, $_POST))) {
            goto EaC;
        }
        $sM = htmlspecialchars($_POST[$sM]);
        EaC:
        if (!empty($us)) {
            goto Wzm;
        }
        $us = "\145\155\141\x69\154";
        Wzm:
        $y9 = get_option("\155\x6f\137\163\141\155\x6c\137\x63\165\163\164\157\x6d\145\x72\137\164\x6f\x6b\145\156");
        if (!(isset($y9) || trim($y9) != '')) {
            goto s7Y;
        }
        $BV = AESEncryption::decrypt_data($iD, $y9);
        $iD = $BV;
        s7Y:
        if (!(!empty($dh) && !empty($y9))) {
            goto gvD;
        }
        $LE = AESEncryption::decrypt_data($dh, $y9);
        $dh = $LE;
        gvD:
        if (!(!empty($Sj) && !empty($y9))) {
            goto GXB;
        }
        $FA = AESEncryption::decrypt_data($Sj, $y9);
        $Sj = $FA;
        GXB:
        if (!(!empty($mh) && !empty($y9))) {
            goto bIm;
        }
        $Af = AESEncryption::decrypt_data($mh, $y9);
        $mh = $Af;
        bIm:
        if (!(!empty($sM) && !empty($y9))) {
            goto goT;
        }
        $aT = AESEncryption::decrypt_data($sM, $y9);
        $sM = $aT;
        goT:
    } catch (Exception $zg) {
        echo sprintf("\x41\156\40\145\162\x72\157\x72\40\157\143\x63\165\162\162\145\x64\x20\167\x68\x69\154\x65\x20\160\162\157\x63\x65\163\163\x69\156\147\40\x74\x68\145\x20\123\x41\x4d\x4c\40\122\x65\x73\160\x6f\156\x73\x65\x2e");
        exit;
    }
    $AM = array($sM);
    mo_saml_login_user($iD, $dh, $Sj, $mh, $AM, $Hf, $Hc, $Nj, $us);
    NJ8:
    goto BJG;
    wyr:
    update_option("\x6d\x6f\x5f\x73\141\x6d\x6c\x5f\x72\145\x64\151\x72\x65\143\164\x5f\145\x72\x72\x6f\162\137\143\x6f\x64\145", htmlspecialchars($_POST["\x45\x52\122\x4f\x52\137\x52\x45\x41\123\x4f\116"]));
    update_option("\155\157\137\163\x61\x6d\154\x5f\x72\x65\144\x69\162\145\x63\164\x5f\145\x72\x72\x6f\x72\x5f\x72\145\x61\x73\157\x6e", htmlspecialchars($_POST["\105\x52\x52\x4f\x52\x5f\x4d\105\123\123\101\x47\105"]));
    BJG:
    vQm:
    jdo:
}
function cldjkasjdksalc()
{
    $s5 = plugin_dir_path(__FILE__);
    $bX = wp_upload_dir();
    $GW = home_url();
    $GW = trim($GW, "\x2f");
    if (preg_match("\x23\136\150\164\164\160\x28\x73\x29\x3f\x3a\57\x2f\x23", $GW)) {
        goto GBt;
    }
    $GW = "\150\x74\164\160\x3a\x2f\x2f" . $GW;
    GBt:
    $X5 = parse_url($GW);
    $aY = preg_replace("\x2f\x5e\x77\167\167\x5c\x2e\57", '', $X5["\x68\157\163\x74"]);
    $Ka = $aY . "\55" . $bX["\x62\141\163\145\144\151\162"];
    $RQ = hash_hmac("\163\x68\141\x32\x35\66", $Ka, "\x34\x44\x48\x66\152\x67\x66\x6a\x61\x73\156\144\146\163\x61\152\146\110\107\112");
    if (is_writable($s5 . "\x6c\x69\143\x65\156\163\x65")) {
        goto FK5;
    }
    $Bf = base64_decode("\x62\x47\116\153\141\155\164\150\143\62\160\153\141\63\116\150\x59\x32\x77\x3d");
    $aH = get_option($Bf);
    if (empty($aH)) {
        goto yle;
    }
    $mk = str_rot13($aH);
    yle:
    goto S1o;
    FK5:
    $aH = file_get_contents($s5 . "\154\x69\143\145\x6e\x73\145");
    if (!$aH) {
        goto GtS;
    }
    $mk = base64_encode($aH);
    GtS:
    S1o:
    if (!empty($aH)) {
        goto NYR;
    }
    $kB = base64_decode("\x54\107\154\152\132\x57\x35\x7a\132\123\x42\107\141\127\170\154\x49\x47\x31\160\143\x33\116\160\142\155\143\x67\x5a\156\112\166\142\123\102\60\141\x47\x55\x67\143\x47\x78\x31\x5a\62\154\165\114\147\x3d\75");
    wp_die($kB);
    NYR:
    if (strpos($mk, $RQ) !== false) {
        goto ePS;
    }
    $dI = new Customersaml();
    $y9 = get_option("\155\157\137\x73\141\x6d\154\x5f\143\x75\163\x74\157\155\x65\x72\137\164\157\x6b\145\x6e");
    $ew = AESEncryption::decrypt_data(get_option("\x73\155\x6c\137\x6c\x6b"), $y9);
    $fY = $dI->mo_saml_vl($ew, false);
    if ($fY) {
        goto Qav;
    }
    return;
    Qav:
    $fY = json_decode($fY, true);
    if (isset($fY["\163\164\141\x74\165\x73"]) and strcasecmp($fY["\163\x74\x61\164\x75\x73"], "\x53\125\103\x43\x45\x53\x53") == 0) {
        goto zDB;
    }
    $cJ = base64_decode("\123\x57\65\62\131\127\x78\160\x5a\103\x42\x4d\x61\x57\x4e\x6c\x62\x6e\116\154\111\x45\132\x76\144\127\x35\x6b\x4c\x69\102\121\x62\107\x56\150\x63\62\125\147\x59\62\x39\165\x64\107\x46\152\144\103\x42\65\x62\63\x56\171\x49\107\x46\153\142\x57\154\x75\x61\x58\x4e\x30\143\x6d\106\60\142\x33\x49\147\x64\x47\70\x67\144\x58\116\154\x49\x48\x52\x6f\x5a\x53\x42\152\x62\63\x4a\171\132\x57\116\x30\111\x47\170\x70\x59\x32\126\165\143\x32\125\165\x49\105\132\166\x63\x69\x42\164\x62\63\x4a\154\x49\x47\x52\154\x64\x47\106\x70\x62\110\115\x73\x49\x48\x42\x79\142\63\x5a\x70\x5a\x47\125\x67\x64\x47\x68\x6c\x49\106\x4a\x6c\x5a\155\126\x79\x5a\x57\65\152\132\123\x42\x4a\122\104\157\x67\124\x55\x38\x79\x4e\104\x49\x34\115\124\x41\x79\115\x54\x63\167\116\123\102\60\x62\171\x42\x35\x62\63\126\171\x49\x47\106\153\x62\127\154\165\141\130\x4e\60\143\155\x46\60\x62\63\111\147\x64\107\x38\147\x59\62\150\x6c\131\62\x73\147\x61\130\x51\147\x64\127\65\x6b\132\130\111\x67\x53\x47\126\x73\x63\x43\101\155\111\x45\132\x42\125\123\x42\60\x59\x57\x49\147\x61\127\x34\x67\144\x47\x68\x6c\x49\x48\x42\x73\144\x57\x64\160\142\151\64\x3d");
    $cJ = str_replace("\110\x65\154\x70\x20\46\x20\x46\101\121\40\x74\x61\x62\x20\x69\156", "\106\101\x51\163\x20\x73\145\x63\x74\x69\157\x6e\40\157\x66", $cJ);
    $Wo = base64_decode("\122\x58\112\x79\x62\63\111\x36\111\105\154\x75\144\155\106\x73\x61\127\121\147\124\107\x6c\x6a\132\x57\x35\172\x5a\x51\75\75");
    wp_die($cJ, $Wo);
    goto san;
    zDB:
    $s5 = plugin_dir_path(__FILE__);
    $GW = home_url();
    $GW = trim($GW, "\57");
    if (preg_match("\43\136\150\164\164\x70\50\163\x29\77\72\x2f\57\x23", $GW)) {
        goto ELf;
    }
    $GW = "\x68\164\164\160\x3a\57\57" . $GW;
    ELf:
    $X5 = parse_url($GW);
    $aY = preg_replace("\57\x5e\x77\167\167\134\x2e\57", '', $X5["\150\x6f\x73\164"]);
    $bX = wp_upload_dir();
    $Ka = $aY . "\x2d" . $bX["\142\x61\163\x65\144\x69\162"];
    $RQ = hash_hmac("\x73\x68\x61\x32\65\x36", $Ka, "\64\104\110\x66\x6a\x67\x66\x6a\x61\163\156\144\x66\163\x61\x6a\x66\110\x47\x4a");
    $Ve = djkasjdksa();
    $Fv = round(strlen($Ve) / rand(2, 20));
    $Ve = substr_replace($Ve, $RQ, $Fv, 0);
    $U5 = base64_decode($Ve);
    if (is_writable($s5 . "\x6c\151\x63\x65\156\163\145")) {
        goto Kok;
    }
    $Ve = str_rot13($Ve);
    $Bf = base64_decode("\142\x47\116\153\141\155\164\150\143\62\x70\153\x61\x33\116\150\x59\x32\x77\75");
    update_option($Bf, $Ve);
    goto DFP;
    Kok:
    file_put_contents($s5 . "\x6c\x69\143\145\x6e\163\x65", $U5);
    DFP:
    return true;
    san:
    goto fND;
    ePS:
    return true;
    fND:
}
function djkasjdksa()
{
    $VJ = "\x21\x7e\100\x23\44\x25\136\46\x2a\x28\x29\x5f\53\174\x7b\x7d\74\x3e\x3f\60\61\x32\x33\x34\x35\x36\x37\70\x39\141\x62\x63\x64\145\146\147\x68\x69\152\x6b\154\x6d\156\157\x70\161\x72\x73\164\x75\x76\167\170\x79\x7a\x41\102\x43\104\105\106\x47\x48\111\112\x4b\114\115\x4e\x4f\x50\x51\122\123\124\x55\126\x57\x58\x59\132";
    $WO = strlen($VJ);
    $lL = '';
    $y_ = 0;
    XsY:
    if (!($y_ < 10000)) {
        goto Ft1;
    }
    $lL .= $VJ[rand(0, $WO - 1)];
    vtI:
    $y_++;
    goto XsY;
    Ft1:
    return $lL;
}
function mo_saml_show_SAML_log($vh, $km)
{
    header("\103\x6f\x6e\164\145\156\164\55\x54\x79\160\x65\x3a\x20\164\145\x78\164\57\150\x74\x6d\154");
    $ra = new DOMDocument();
    $ra->preserveWhiteSpace = false;
    $ra->formatOutput = true;
    $ra->loadXML($vh);
    if ($km == "\144\151\x73\160\154\x61\x79\x53\x41\115\114\122\145\161\165\145\163\x74") {
        goto mYQ;
    }
    $Iw = "\x53\x41\115\x4c\40\122\x65\163\160\x6f\156\x73\145";
    goto jPH;
    mYQ:
    $Iw = "\x53\101\x4d\114\x20\x52\145\x71\x75\145\x73\x74";
    jPH:
    $SC = $ra->saveXML();
    $wn = htmlentities($SC);
    $wn = rtrim($wn);
    $tW = simplexml_load_string($SC);
    $Np = json_encode($tW);
    $cx = json_decode($Np);
    $H4 = plugins_url("\151\156\x63\x6c\x75\x64\x65\x73\x2f\x63\163\163\x2f\163\x74\x79\154\145\x5f\x73\145\164\164\151\156\x67\x73\x2e\x63\x73\163\x3f\166\145\162\75\x34\56\x38\x2e\x34\60", __FILE__);
    echo "\74\154\x69\x6e\153\40\162\x65\154\x3d\47\x73\164\171\x6c\145\163\x68\x65\x65\164\47\x20\151\144\75\47\x6d\157\x5f\x73\x61\155\x6c\137\141\x64\155\151\x6e\137\x73\x65\164\x74\x69\156\147\163\137\x73\x74\x79\x6c\x65\55\143\163\x73\47\40\40\150\162\145\146\75\47" . $H4 . "\47\40\164\x79\160\145\75\x27\x74\145\x78\164\57\143\x73\x73\x27\x20\x6d\145\x64\151\141\x3d\x27\141\x6c\x6c\x27\x20\x2f\76\15\xa\x20\x20\40\x20\x20\40\x20\x20\40\40\x20\x20\xd\xa\11\11\11\74\144\x69\166\x20\x63\x6c\141\x73\163\x3d\x22\x6d\x6f\55\x64\151\163\160\154\141\x79\55\154\157\147\x73\x22\40\x3e\74\x70\x20\164\171\160\x65\x3d\x22\x74\145\x78\164\x22\40\40\40\x69\x64\75\42\123\101\115\x4c\137\164\x79\x70\x65\42\76" . $Iw . "\x3c\x2f\x70\76\x3c\57\144\x69\x76\76\15\xa\x9\11\11\11\15\12\x9\x9\x9\74\144\151\x76\40\164\171\x70\x65\75\x22\164\x65\x78\x74\x22\40\151\x64\x3d\x22\x53\x41\115\114\x5f\144\x69\x73\x70\154\141\x79\x22\x20\143\x6c\x61\163\x73\x3d\x22\155\x6f\55\x64\x69\x73\x70\154\141\171\55\x62\154\x6f\x63\x6b\42\x3e\74\x70\162\x65\x20\143\154\141\x73\x73\x3d\47\142\x72\x75\x73\x68\x3a\40\170\x6d\154\x3b\47\76" . $wn . "\74\57\160\162\145\76\x3c\57\x64\151\x76\x3e\xd\12\x9\11\11\x3c\x62\x72\x3e\15\xa\x9\x9\11\x3c\x64\151\166\x9\40\x73\x74\171\x6c\145\75\x22\155\141\162\147\151\156\72\63\x25\73\144\151\163\x70\154\141\171\72\x62\154\157\143\153\x3b\x74\x65\x78\x74\55\x61\x6c\x69\x67\156\72\x63\x65\x6e\x74\145\x72\73\x22\76\15\xa\x20\x20\40\40\x20\x20\x20\x20\x20\x20\x20\40\15\xa\x9\x9\x9\x3c\x64\151\166\x20\x73\x74\171\x6c\x65\x3d\x22\155\x61\162\147\151\156\72\63\45\x3b\x64\151\163\x70\154\x61\x79\72\x62\154\x6f\143\153\73\x74\x65\170\164\x2d\141\154\151\x67\x6e\x3a\x63\145\156\x74\145\162\73\42\x20\x3e\xd\12\x9\15\12\40\x20\x20\x20\40\x20\40\x20\40\x20\x20\x20\x3c\x2f\144\x69\166\76\xd\xa\x9\11\x9\74\142\x75\164\x74\x6f\x6e\x20\151\x64\x3d\x22\x63\x6f\160\171\42\40\x6f\156\143\154\151\x63\153\75\x22\143\157\x70\x79\x44\151\166\x54\x6f\x43\154\151\x70\142\x6f\x61\x72\x64\50\51\x22\40\40\163\x74\x79\154\x65\75\42\x70\x61\x64\144\151\x6e\x67\72\x31\x25\73\167\151\x64\164\x68\x3a\x31\x30\x30\x70\170\x3b\142\x61\x63\153\x67\162\x6f\165\156\144\x3a\x20\43\x30\x30\71\x31\103\104\40\156\x6f\156\145\40\162\x65\160\x65\141\164\x20\163\x63\x72\157\154\x6c\x20\60\45\x20\60\x25\x3b\x63\x75\x72\163\x6f\162\x3a\x20\x70\157\151\x6e\164\145\x72\x3b\146\157\156\164\x2d\x73\x69\x7a\145\72\x31\65\160\x78\x3b\142\x6f\x72\144\x65\x72\55\167\151\x64\x74\150\x3a\x20\x31\x70\x78\x3b\142\x6f\x72\x64\145\162\55\163\164\171\x6c\145\x3a\40\163\157\x6c\x69\144\x3b\x62\x6f\x72\x64\145\x72\55\162\141\144\x69\165\x73\72\40\x33\x70\170\x3b\167\x68\151\x74\145\55\163\160\x61\143\145\72\x20\x6e\x6f\167\162\x61\160\x3b\x62\x6f\x78\55\163\151\172\x69\x6e\x67\x3a\x20\142\157\x72\x64\x65\x72\x2d\x62\x6f\x78\73\142\157\x72\x64\x65\x72\x2d\143\x6f\x6c\x6f\162\72\x20\43\60\x30\67\x33\x41\x41\73\x62\157\x78\x2d\163\150\x61\144\x6f\x77\x3a\40\x30\160\x78\40\61\160\x78\40\x30\160\x78\40\x72\x67\x62\141\50\61\62\60\54\40\x32\60\60\54\40\x32\x33\x30\x2c\x20\60\56\66\51\40\151\156\x73\x65\164\x3b\143\157\154\157\x72\72\x20\x23\x46\106\106\73\42\x20\x3e\x43\x6f\160\x79\x3c\57\142\165\164\x74\157\x6e\x3e\15\xa\11\x9\x9\x26\x6e\x62\x73\160\x3b\xd\12\40\x20\x20\40\40\40\x20\x20\40\x20\x20\x20\x20\40\40\x3c\x69\x6e\160\165\x74\x20\151\144\75\42\144\x77\x6e\55\x62\x74\156\x22\40\163\164\x79\154\x65\x3d\42\x70\x61\144\144\x69\156\147\72\x31\x25\x3b\x77\x69\144\164\150\72\x31\x30\x30\160\170\73\142\141\x63\153\x67\x72\x6f\165\156\x64\x3a\40\43\x30\x30\71\x31\x43\104\x20\156\x6f\x6e\x65\40\x72\x65\160\x65\141\x74\40\163\143\x72\x6f\x6c\154\x20\60\45\x20\x30\45\73\x63\x75\x72\163\157\162\x3a\x20\160\157\x69\156\x74\145\162\73\146\157\156\x74\55\163\x69\x7a\x65\72\x31\x35\160\x78\73\x62\x6f\x72\144\145\162\x2d\x77\x69\144\x74\x68\x3a\40\61\x70\x78\73\142\x6f\162\x64\x65\162\55\163\x74\171\154\x65\x3a\40\x73\x6f\x6c\151\144\73\x62\x6f\162\144\x65\162\55\162\x61\144\x69\165\163\x3a\x20\x33\x70\x78\x3b\167\x68\151\164\x65\x2d\163\160\x61\143\145\72\40\x6e\157\x77\162\141\x70\73\142\157\x78\x2d\x73\151\x7a\151\156\x67\x3a\x20\x62\x6f\162\x64\x65\x72\x2d\x62\157\170\73\142\157\162\144\x65\x72\55\143\x6f\154\157\162\72\40\x23\x30\60\67\x33\x41\x41\x3b\x62\157\x78\55\x73\x68\141\x64\157\167\x3a\40\60\x70\x78\x20\61\160\170\x20\x30\160\170\40\x72\x67\x62\141\50\x31\x32\60\x2c\x20\62\x30\x30\x2c\x20\x32\63\60\x2c\x20\60\56\x36\x29\x20\151\156\x73\145\x74\x3b\x63\x6f\x6c\157\x72\72\x20\43\x46\x46\106\x3b\x22\x74\x79\x70\145\75\x22\142\165\164\164\157\156\x22\40\166\x61\x6c\165\x65\x3d\x22\x44\x6f\x77\x6e\154\x6f\141\144\x22\x20\15\12\40\40\40\x20\40\x20\40\x20\40\x20\40\x20\x20\x20\x20\x22\76\xd\12\11\11\11\74\x2f\144\151\166\x3e\15\12\x9\11\11\74\x2f\x64\151\x76\x3e\xd\xa\x9\x9\x9\15\12\x9\x9\15\xa\11\x9\x9";
    ob_end_flush();
    echo "\xd\12\x9\x3c\163\143\x72\x69\x70\164\x3e\15\12\xd\12\x20\x20\x20\40\40\40\40\40\146\165\x6e\x63\164\151\157\x6e\40\143\x6f\160\171\x44\151\166\x54\x6f\103\x6c\151\x70\142\157\x61\162\x64\50\51\x20\x7b\15\12\40\40\40\40\x20\x20\x20\x20\40\x20\x20\40\x76\141\x72\40\x61\x75\170\x20\x3d\x20\x64\x6f\143\x75\x6d\145\156\164\x2e\x63\x72\145\x61\x74\145\105\x6c\x65\155\x65\x6e\164\50\42\151\156\x70\x75\164\x22\x29\x3b\15\12\40\x20\40\x20\40\x20\40\x20\40\40\40\40\x61\165\170\x2e\x73\x65\x74\101\164\164\162\151\x62\165\164\x65\50\x22\x76\x61\154\165\145\42\54\x20\x64\157\x63\165\x6d\145\x6e\x74\x2e\x67\x65\164\x45\154\145\155\x65\x6e\x74\102\171\111\144\x28\x22\x53\101\x4d\x4c\x5f\144\x69\163\x70\154\x61\171\x22\51\56\x74\x65\x78\164\x43\157\156\164\x65\156\x74\x29\73\xd\12\40\40\x20\x20\40\40\x20\40\40\40\40\40\x64\x6f\143\x75\x6d\145\156\x74\x2e\142\157\x64\x79\56\x61\160\x70\145\x6e\144\x43\x68\x69\154\144\x28\141\x75\x78\x29\x3b\xd\xa\x20\40\x20\40\x20\x20\40\x20\40\x20\40\x20\x61\165\x78\56\x73\x65\154\145\143\x74\x28\x29\73\xd\xa\x20\40\40\40\x20\x20\x20\40\40\x20\40\x20\x64\157\x63\165\x6d\145\x6e\164\56\x65\x78\145\x63\x43\157\155\x6d\141\x6e\144\x28\x22\143\157\160\171\42\51\73\15\12\x20\40\x20\40\40\40\x20\x20\40\40\x20\40\144\157\x63\165\155\145\x6e\164\56\142\157\x64\171\x2e\162\145\155\157\x76\x65\103\x68\151\x6c\x64\50\141\x75\170\51\73\15\12\40\40\x20\x20\40\x20\40\x20\40\40\x20\40\144\x6f\143\165\155\145\156\164\56\147\145\x74\105\x6c\x65\155\145\156\164\x42\x79\x49\x64\50\47\143\x6f\160\171\x27\51\x2e\164\145\x78\164\103\x6f\156\164\145\x6e\x74\40\x3d\40\x22\x43\157\x70\151\145\x64\x22\x3b\xd\12\x20\x20\x20\40\x20\40\x20\x20\40\40\x20\x20\144\157\x63\x75\155\145\x6e\x74\x2e\147\x65\x74\105\x6c\x65\155\x65\156\164\x42\171\111\x64\50\x27\143\x6f\160\171\47\51\x2e\163\164\x79\x6c\145\x2e\x62\x61\x63\x6b\147\162\x6f\165\x6e\144\x20\75\x20\42\147\162\x65\x79\x22\x3b\xd\12\x20\x20\40\x20\40\x20\x20\x20\40\40\40\x20\x77\151\x6e\x64\157\167\x2e\147\145\164\x53\x65\x6c\x65\x63\x74\x69\x6f\x6e\x28\51\x2e\x73\x65\154\145\x63\x74\101\x6c\x6c\x43\150\151\x6c\144\162\145\x6e\50\x20\144\x6f\x63\x75\x6d\x65\156\x74\x2e\147\x65\164\105\x6c\145\x6d\x65\x6e\x74\x42\171\111\144\x28\40\x22\x53\101\x4d\114\x5f\x64\x69\x73\160\x6c\141\x79\42\x20\51\40\51\73\xd\xa\xd\12\x20\x20\40\40\40\x20\x20\x20\175\xd\12\xd\xa\x20\40\x20\x20\x20\40\40\40\146\165\x6e\143\x74\151\x6f\156\40\x64\157\x77\156\154\157\x61\144\50\x66\x69\x6c\x65\x6e\x61\x6d\x65\x2c\40\164\145\170\x74\51\x20\x7b\15\12\x20\x20\40\40\40\x20\40\40\x20\x20\x20\40\x76\141\162\x20\145\154\x65\x6d\145\x6e\x74\x20\x3d\40\x64\x6f\x63\x75\x6d\x65\156\x74\56\143\x72\145\x61\x74\x65\x45\x6c\145\155\x65\x6e\164\x28\x27\141\47\51\73\xd\xa\x20\40\x20\40\x20\40\x20\40\40\x20\40\x20\145\154\x65\155\x65\x6e\164\x2e\163\145\164\x41\164\164\162\151\142\165\x74\145\50\47\150\x72\145\x66\x27\54\x20\47\x64\x61\164\141\x3a\x41\160\160\154\151\143\x61\x74\x69\x6f\156\57\157\x63\x74\x65\x74\x2d\x73\164\x72\145\141\155\73\x63\150\141\x72\163\x65\164\x3d\x75\164\146\x2d\x38\54\47\x20\53\40\145\156\143\157\144\x65\x55\122\x49\103\x6f\155\160\157\x6e\x65\156\x74\50\x74\145\170\x74\51\51\x3b\xd\xa\x20\40\40\40\x20\40\x20\40\x20\40\40\40\145\154\x65\x6d\x65\156\164\x2e\x73\145\x74\x41\x74\164\162\x69\x62\x75\x74\x65\x28\47\x64\x6f\167\x6e\154\x6f\141\x64\47\x2c\40\x66\151\x6c\145\156\x61\155\145\51\73\xd\12\xd\xa\x20\40\x20\x20\40\x20\40\x20\40\x20\x20\x20\x65\x6c\145\x6d\145\x6e\164\56\163\164\171\154\x65\56\144\x69\163\x70\x6c\x61\x79\x20\x3d\x20\47\x6e\x6f\156\x65\47\73\15\12\40\40\40\40\x20\40\x20\40\x20\x20\x20\40\144\x6f\143\x75\155\145\156\164\56\142\157\x64\x79\x2e\141\160\160\145\156\x64\103\x68\151\154\144\50\x65\x6c\145\x6d\145\x6e\x74\51\73\xd\12\15\xa\x20\40\x20\x20\x20\40\x20\40\40\40\x20\40\x65\x6c\x65\x6d\x65\156\x74\56\x63\154\151\143\x6b\50\51\73\xd\xa\xd\xa\40\40\40\40\x20\40\40\x20\40\40\x20\x20\144\x6f\x63\165\155\x65\x6e\x74\56\142\x6f\144\x79\56\162\145\x6d\157\166\145\103\x68\151\154\144\x28\x65\154\145\x6d\145\156\x74\x29\x3b\15\xa\x20\x20\x20\40\x20\x20\x20\40\175\15\12\15\xa\x20\40\40\x20\x20\x20\x20\40\x64\x6f\x63\x75\155\145\x6e\164\x2e\147\x65\164\x45\x6c\145\155\x65\156\164\x42\171\x49\144\50\42\x64\167\156\55\142\x74\x6e\42\51\x2e\141\x64\144\x45\166\145\156\x74\114\x69\163\164\x65\156\145\162\50\x22\x63\x6c\x69\143\x6b\42\x2c\x20\146\x75\x6e\143\164\x69\x6f\x6e\40\x28\x29\40\173\15\xa\15\xa\x20\x20\x20\40\40\x20\x20\40\x20\x20\x20\40\166\x61\x72\40\x66\x69\x6c\x65\x6e\x61\155\x65\x20\75\x20\x64\x6f\x63\165\x6d\145\x6e\164\x2e\147\145\x74\x45\154\145\x6d\145\x6e\x74\x42\171\111\x64\x28\42\x53\101\115\114\x5f\x74\x79\x70\145\x22\x29\56\x74\145\x78\x74\x43\157\156\x74\x65\x6e\164\x2b\42\56\170\155\x6c\42\x3b\15\12\40\x20\40\x20\x20\40\x20\x20\x20\x20\40\40\x76\x61\x72\x20\x6e\x6f\x64\x65\40\75\x20\x64\157\x63\165\155\x65\156\x74\56\x67\145\x74\x45\154\145\155\145\x6e\x74\102\171\x49\x64\x28\x22\x53\x41\x4d\x4c\137\144\151\x73\x70\x6c\141\171\x22\51\73\xd\xa\x20\x20\x20\40\x20\40\40\40\40\x20\40\40\x68\x74\155\154\x43\157\x6e\164\x65\156\164\40\x3d\40\156\x6f\144\145\56\151\x6e\x6e\145\162\110\x54\x4d\114\73\xd\12\x20\40\x20\40\x20\40\40\x20\x20\40\x20\40\164\145\x78\164\x20\x3d\x20\x6e\157\x64\x65\56\x74\145\x78\164\x43\x6f\x6e\x74\145\156\x74\x3b\xd\xa\40\x20\x20\40\40\x20\x20\x20\x20\x20\x20\40\x63\157\x6e\x73\x6f\154\145\x2e\x6c\x6f\147\50\x74\x65\170\164\51\73\15\12\x20\40\40\x20\40\40\40\40\40\x20\x20\x20\144\x6f\x77\x6e\x6c\x6f\141\x64\x28\146\151\154\145\x6e\x61\155\x65\54\40\164\145\170\x74\51\73\xd\xa\40\x20\x20\x20\40\x20\40\40\x7d\54\x20\x66\x61\154\163\x65\x29\73\xd\xa\xd\12\15\12\xd\xa\15\12\15\xa\40\x20\40\40\x3c\57\163\x63\162\151\x70\164\76\xd\12";
    exit;
}
function mo_saml_checkMapping($Nz, $sl, $rB)
{
    try {
        $u4 = get_option("\x73\141\x6d\154\137\141\x6d\137\145\155\x61\151\154");
        $y3 = get_option("\x73\141\155\x6c\137\141\x6d\137\x75\163\145\x72\156\141\x6d\x65");
        $dh = get_option("\x73\x61\x6d\154\137\x61\x6d\x5f\146\x69\x72\163\x74\x5f\156\x61\x6d\145");
        $Sj = get_option("\163\141\x6d\x6c\137\141\x6d\x5f\154\141\x73\164\x5f\156\x61\155\145");
        $sM = get_option("\163\x61\155\x6c\x5f\x61\x6d\x5f\x67\162\157\x75\x70\x5f\156\x61\x6d\145");
        $Hc = get_option("\x73\x61\155\x6c\x5f\141\x6d\137\x64\x65\x66\x61\165\154\164\137\x75\163\145\x72\137\x72\x6f\154\145");
        $Hf = get_option("\163\x61\155\x6c\137\x61\155\137\144\x6f\x6e\x74\x5f\141\154\x6c\157\167\x5f\165\x6e\154\151\x73\x74\x65\x64\137\165\x73\x65\162\x5f\x72\x6f\154\x65");
        $us = get_option("\163\141\155\154\137\141\155\x5f\141\x63\143\x6f\165\156\164\137\x6d\x61\164\x63\150\x65\x72");
        $iD = '';
        $mh = '';
        if (empty($Nz)) {
            goto P3G;
        }
        if (!empty($dh) && array_key_exists($dh, $Nz)) {
            goto nCC;
        }
        $dh = '';
        goto bK4;
        nCC:
        $dh = $Nz[$dh][0];
        bK4:
        if (!empty($Sj) && array_key_exists($Sj, $Nz)) {
            goto HEM;
        }
        $Sj = '';
        goto Lie;
        HEM:
        $Sj = $Nz[$Sj][0];
        Lie:
        if (!empty($y3) && array_key_exists($y3, $Nz)) {
            goto si1;
        }
        $mh = $Nz["\x4e\x61\x6d\x65\111\104"][0];
        goto OTv;
        si1:
        $mh = $Nz[$y3][0];
        OTv:
        if (!empty($u4) && array_key_exists($u4, $Nz)) {
            goto PXR;
        }
        $iD = $Nz["\116\x61\x6d\145\111\x44"][0];
        goto t_F;
        PXR:
        $iD = $Nz[$u4][0];
        t_F:
        if (!empty($sM) && array_key_exists($sM, $Nz)) {
            goto XGs;
        }
        $sM = array();
        goto fPC;
        XGs:
        $sM = $Nz[$sM];
        fPC:
        if (!empty($us)) {
            goto Hwd;
        }
        $us = "\x65\155\x61\151\x6c";
        Hwd:
        P3G:
        if ($sl == "\x74\x65\163\164\x56\x61\x6c\151\144\141\x74\x65") {
            goto OB7;
        }
        if ($sl == "\x74\x65\163\x74\x4e\x65\167\103\145\162\164\151\x66\x69\143\x61\x74\145") {
            goto reQ;
        }
        mo_saml_login_user($iD, $dh, $Sj, $mh, $sM, $Hf, $Hc, $sl, $us, $rB, $Nz["\116\x61\x6d\x65\x49\x44"][0], $Nz);
        goto MAY;
        OB7:
        update_option("\x6d\157\137\163\141\155\154\x5f\x74\x65\163\164", "\x54\145\x73\x74\x20\163\165\143\x63\145\163\x73\146\165\154");
        mo_saml_show_test_result($dh, $Sj, $iD, $sM, $Nz, $sl);
        goto MAY;
        reQ:
        update_option("\x6d\x6f\137\x73\x61\155\154\137\x74\x65\x73\164\137\156\145\x77\x5f\x63\145\x72\164", "\x54\x65\x73\x74\40\163\165\x63\143\145\163\163\x66\165\154");
        mo_saml_show_test_result($dh, $Sj, $iD, $sM, $Nz, $sl);
        MAY:
    } catch (Exception $zg) {
        echo sprintf("\x41\x6e\40\145\x72\x72\157\162\x20\157\143\143\x75\162\x72\x65\x64\x20\167\x68\151\154\145\x20\x70\x72\x6f\143\145\x73\163\151\156\x67\x20\x74\x68\145\x20\123\101\x4d\114\x20\122\145\163\x70\157\156\163\145\56");
        exit;
    }
}
function mo_saml_show_test_result($dh, $Sj, $iD, $sM, $Nz, $sl)
{
    echo "\x3c\144\x69\166\40\x73\x74\171\x6c\x65\x3d\x22\x66\x6f\156\x74\55\146\141\x6d\151\x6c\171\72\x43\x61\x6c\x69\x62\x72\x69\73\160\x61\144\144\x69\156\147\72\60\x20\x33\45\73\x22\x3e";
    if (!empty($iD)) {
        goto um6;
    }
    echo "\74\144\x69\x76\40\163\x74\x79\154\145\x3d\x22\143\x6f\154\x6f\x72\72\40\x23\x61\71\64\x34\64\x32\73\142\x61\143\153\147\x72\157\x75\x6e\144\55\x63\x6f\154\157\x72\72\40\x23\146\62\144\145\x64\145\x3b\x70\141\x64\144\151\x6e\147\72\x20\61\x35\x70\170\73\x6d\141\162\147\x69\156\55\142\157\164\x74\x6f\x6d\x3a\x20\62\x30\x70\x78\73\164\145\x78\x74\x2d\x61\154\151\147\156\x3a\143\x65\156\164\145\162\x3b\142\157\x72\x64\145\162\x3a\x31\x70\170\40\x73\157\x6c\x69\144\40\x23\105\66\x42\x33\102\62\73\x66\157\x6e\x74\55\163\x69\x7a\x65\x3a\x31\70\160\x74\x3b\x22\x3e\x54\x45\123\x54\40\106\101\x49\114\x45\104\x3c\57\144\x69\166\76\15\xa\x9\x9\11\x9\x3c\144\x69\166\40\163\x74\171\154\x65\x3d\42\x63\x6f\x6c\157\x72\72\40\x23\x61\x39\x34\x34\x34\x32\73\x66\157\156\164\55\163\151\172\145\x3a\x31\x34\x70\164\73\x20\155\x61\x72\147\x69\x6e\55\142\157\x74\x74\x6f\155\72\x32\x30\x70\170\73\42\76\127\101\122\x4e\x49\116\x47\x3a\40\x53\157\155\145\x20\101\164\164\x72\151\x62\x75\x74\145\163\40\104\151\x64\40\116\x6f\164\x20\x4d\141\164\x63\150\x2e\74\57\144\151\166\76\xd\xa\x9\x9\11\x9\x3c\x64\151\x76\x20\x73\x74\x79\154\x65\x3d\42\x64\151\163\x70\154\141\171\72\x62\154\157\143\153\73\x74\x65\x78\x74\55\x61\x6c\x69\147\x6e\72\143\145\156\164\145\x72\x3b\x6d\141\x72\x67\x69\x6e\x2d\x62\x6f\164\164\x6f\155\x3a\64\45\73\42\x3e\74\151\x6d\147\40\163\164\x79\x6c\x65\75\42\x77\151\x64\x74\x68\72\61\65\x25\73\42\163\162\143\x3d\42" . plugin_dir_url(__FILE__) . "\x69\155\x61\x67\x65\163\57\167\162\x6f\x6e\147\56\x70\x6e\147\x22\76\x3c\x2f\x64\151\x76\x3e";
    goto CyV;
    um6:
    update_option("\x6d\157\x5f\x73\x61\x6d\x6c\137\x74\145\163\164\x5f\143\x6f\156\x66\x69\x67\x5f\x61\x74\x74\162\163", $Nz);
    echo "\74\x64\x69\x76\x20\x73\164\171\x6c\x65\75\x22\143\157\154\157\x72\x3a\40\x23\63\x63\x37\x36\63\x64\x3b\xd\12\x9\x9\11\11\142\x61\143\153\147\x72\x6f\165\156\x64\55\x63\157\x6c\157\162\72\x20\x23\144\x66\146\x30\x64\70\x3b\40\160\x61\x64\x64\151\156\147\72\x32\x25\73\155\x61\162\147\151\x6e\x2d\x62\x6f\164\x74\157\x6d\72\x32\x30\160\170\x3b\164\x65\170\x74\x2d\141\x6c\x69\x67\156\x3a\x63\145\x6e\164\x65\162\73\x20\x62\157\162\x64\x65\x72\x3a\x31\160\170\40\163\x6f\154\x69\144\x20\x23\101\105\104\x42\x39\101\73\40\x66\x6f\156\164\55\x73\151\x7a\145\72\61\x38\160\x74\73\x22\76\x54\x45\x53\124\x20\123\125\x43\x43\x45\x53\123\x46\125\x4c\x3c\x2f\144\x69\x76\x3e\15\xa\x9\x9\11\11\x3c\x64\151\x76\x20\163\x74\171\154\x65\75\42\x64\x69\x73\x70\154\x61\171\72\142\154\x6f\x63\x6b\x3b\164\145\170\x74\x2d\x61\x6c\151\x67\x6e\72\143\x65\x6e\164\x65\x72\73\155\141\x72\x67\x69\x6e\55\142\157\x74\164\157\x6d\x3a\64\45\x3b\42\76\x3c\151\155\x67\40\163\x74\171\x6c\145\x3d\x22\x77\x69\144\x74\150\72\61\x35\45\73\42\163\x72\143\x3d\42" . plugin_dir_url(__FILE__) . "\x69\155\141\147\145\x73\x2f\x67\x72\x65\x65\156\x5f\143\x68\x65\x63\x6b\x2e\160\x6e\x67\42\76\x3c\57\144\151\x76\76";
    CyV:
    $YD = get_option("\155\157\137\x73\141\155\x6c\137\145\156\141\x62\x6c\145\137\144\157\155\141\x69\x6e\x5f\x72\145\163\x74\x72\151\143\164\x69\x6f\x6e\137\154\x6f\147\151\x6e");
    $pg = $sl == "\164\145\163\x74\116\x65\167\x43\x65\x72\164\x69\146\x69\x63\x61\164\145" ? "\x64\x69\x73\160\x6c\141\171\x3a\156\x6f\156\x65" : '';
    if (!$YD) {
        goto FsS;
    }
    $m1 = get_option("\155\x6f\x5f\163\x61\x6d\x6c\137\x61\154\154\x6f\x77\x5f\144\x65\156\x79\137\x75\x73\145\162\x5f\x77\x69\164\150\x5f\144\x6f\155\x61\x69\x6e");
    if (!empty($m1) && $m1 == "\x64\x65\156\171") {
        goto yQM;
    }
    $yS = get_option("\x73\x61\155\154\x5f\x61\x6d\x5f\145\155\141\x69\154\x5f\144\157\155\x61\151\x6e\163");
    $lu = explode("\x3b", $yS);
    $bZ = explode("\x40", $iD);
    $Mo = array_key_exists("\61", $bZ) ? $bZ[1] : '';
    if (in_array($Mo, $lu)) {
        goto aVU;
    }
    echo "\74\x70\x20\x73\x74\171\154\145\75\x22\143\x6f\x6c\x6f\162\72\162\145\x64\73\42\x3e\124\x68\151\163\40\x75\163\145\162\40\167\x69\x6c\x6c\x20\x6e\x6f\x74\x20\142\145\40\x61\154\x6c\157\x77\x65\144\x20\164\157\x20\154\x6f\147\151\x6e\40\x61\163\x20\164\150\145\40\x64\x6f\x6d\x61\151\x6e\x20\x6f\146\x20\164\x68\145\x20\x65\155\141\x69\x6c\x20\151\163\40\x6e\x6f\164\x20\x69\156\143\154\165\144\145\144\40\x69\x6e\40\x74\150\x65\40\141\154\x6c\157\167\x65\x64\x20\154\151\x73\x74\40\157\x66\40\x44\x6f\x6d\141\x69\x6e\x20\122\x65\x73\x74\x72\x69\x63\x74\x69\x6f\x6e\x2e\x3c\x2f\x70\76";
    aVU:
    goto hME;
    yQM:
    $yS = get_option("\163\x61\155\154\137\141\155\x5f\145\155\x61\151\154\137\144\x6f\155\x61\151\156\x73");
    $lu = explode("\73", $yS);
    $bZ = explode("\x40", $iD);
    $Mo = array_key_exists("\61", $bZ) ? $bZ[1] : '';
    if (!in_array($Mo, $lu)) {
        goto MKF;
    }
    echo "\74\160\x20\163\164\x79\x6c\145\x3d\x22\x63\x6f\154\157\x72\x3a\x72\x65\144\x3b\42\x3e\124\150\x69\x73\40\x75\x73\145\162\40\167\x69\x6c\154\40\156\x6f\164\x20\x62\x65\40\x61\x6c\x6c\157\x77\145\x64\x20\164\157\40\154\x6f\x67\151\156\40\141\163\x20\x74\150\145\x20\144\x6f\x6d\x61\151\156\x20\x6f\146\x20\x74\x68\x65\40\145\x6d\141\151\x6c\40\151\x73\40\x69\156\143\154\165\144\x65\x64\40\151\156\40\x74\150\145\40\144\x65\156\151\x65\x64\40\x6c\151\x73\164\40\157\x66\40\x44\157\155\x61\x69\x6e\40\x52\x65\x73\164\162\151\143\x74\151\x6f\156\x2e\74\57\160\76";
    MKF:
    hME:
    FsS:
    $AG = get_option("\163\141\x6d\x6c\137\141\155\x5f\165\163\145\162\x6e\x61\155\145");
    if (!(!empty($AG) && array_key_exists($AG, $Nz))) {
        goto beY;
    }
    $KJ = $Nz[$AG][0];
    if (!(strlen($KJ) > 60)) {
        goto KIB;
    }
    echo "\74\x70\40\163\x74\x79\154\x65\75\x22\143\157\x6c\x6f\x72\72\162\145\144\x3b\x22\76\116\117\x54\105\x20\x3a\40\x54\x68\151\x73\x20\x75\x73\145\x72\40\167\x69\154\154\40\x6e\157\x74\x20\x62\x65\x20\141\x62\154\x65\40\164\157\x20\x6c\157\x67\x69\x6e\x20\x61\163\40\x74\150\145\x20\165\x73\x65\x72\x6e\x61\155\x65\40\x76\141\154\x75\145\40\x69\163\x20\155\x6f\x72\x65\40\x74\150\141\156\40\x36\x30\40\143\150\x61\162\141\x63\x74\145\162\163\x20\154\x6f\156\x67\x2e\74\142\x72\x2f\x3e\15\xa\x9\x9\x9\120\154\x65\141\163\145\40\x74\162\x79\40\x63\150\141\x6e\147\x69\156\147\40\x74\150\x65\x20\x6d\141\x70\x70\151\156\147\x20\157\x66\40\x55\163\x65\162\156\x61\x6d\x65\x20\x66\x69\x65\154\144\40\151\156\40\x3c\141\40\x68\162\145\x66\x3d\42\x23\x22\40\157\x6e\103\154\x69\143\153\75\42\143\154\157\163\145\137\x61\x6e\144\137\x72\x65\144\151\x72\x65\x63\164\x28\51\73\x22\76\101\x74\x74\x72\x69\142\x75\164\x65\x2f\x52\x6f\154\145\x20\x4d\x61\160\160\151\x6e\147\74\x2f\141\76\40\x74\141\142\x2e\x3c\57\160\76";
    KIB:
    beY:
    echo "\x3c\163\160\x61\156\40\x73\164\x79\154\145\75\42\146\x6f\x6e\x74\x2d\163\151\x7a\145\x3a\x31\64\160\x74\73\42\76\74\142\76\110\x65\154\x6c\157\x3c\57\x62\76\54\x20" . $iD . "\74\57\x73\x70\141\156\76\74\142\x72\57\76\x3c\160\40\163\164\171\154\x65\75\42\x66\157\x6e\164\55\167\x65\x69\x67\x68\x74\x3a\142\157\154\x64\x3b\146\x6f\156\x74\55\163\x69\x7a\145\x3a\61\64\160\164\x3b\155\x61\162\x67\x69\156\55\154\x65\x66\x74\72\x31\45\73\42\x3e\x41\124\124\122\x49\x42\125\124\105\123\x20\122\x45\x43\105\111\126\105\x44\x3a\74\57\x70\76\xd\12\11\x9\x9\11\74\164\141\x62\x6c\145\x20\x73\x74\171\x6c\145\75\42\x62\x6f\162\x64\x65\x72\x2d\x63\x6f\x6c\x6c\x61\160\163\145\x3a\x63\157\x6c\154\x61\160\163\x65\73\142\157\x72\144\x65\x72\55\163\160\x61\x63\151\x6e\x67\72\x30\x3b\x20\x64\151\x73\x70\154\x61\171\x3a\164\141\x62\154\x65\x3b\167\151\144\164\x68\x3a\x31\60\60\45\73\x20\146\157\156\164\x2d\163\x69\x7a\145\x3a\x31\64\160\164\73\142\x61\x63\153\x67\162\157\x75\x6e\144\55\143\157\154\x6f\x72\72\43\x45\x44\x45\x44\105\104\x3b\42\x3e\15\12\11\x9\11\11\x3c\x74\162\40\163\x74\x79\x6c\x65\75\x22\x74\145\x78\164\x2d\141\154\x69\147\x6e\x3a\x63\145\x6e\164\x65\162\x3b\42\76\74\x74\x64\x20\x73\x74\171\x6c\145\75\42\x66\157\x6e\164\x2d\x77\145\151\x67\150\x74\x3a\142\x6f\x6c\144\x3b\142\x6f\162\x64\145\162\72\x32\x70\x78\40\163\157\x6c\151\x64\40\43\x39\x34\71\x30\71\x30\73\160\x61\x64\x64\151\156\147\x3a\x32\x25\73\42\76\x41\x54\124\x52\x49\102\125\124\x45\40\116\x41\115\105\x3c\x2f\164\144\76\74\164\x64\40\x73\x74\x79\154\x65\75\x22\146\157\x6e\164\55\167\145\151\x67\150\164\72\x62\x6f\x6c\x64\73\x70\x61\144\144\x69\x6e\x67\x3a\62\45\73\142\157\162\144\x65\x72\72\x32\160\170\40\x73\157\x6c\x69\x64\40\43\x39\x34\71\60\71\60\x3b\x20\167\x6f\x72\x64\x2d\167\162\141\x70\72\142\x72\x65\x61\x6b\x2d\x77\157\162\x64\x3b\42\76\101\x54\124\x52\111\102\125\124\x45\x20\126\101\114\125\105\74\x2f\x74\144\76\74\57\164\x72\76";
    if (!empty($Nz)) {
        goto nBz;
    }
    echo "\x4e\x6f\x20\101\x74\164\x72\151\142\165\164\x65\163\x20\x52\x65\x63\145\x69\166\x65\x64\x2e";
    goto ftZ;
    nBz:
    foreach ($Nz as $y9 => $nj) {
        echo "\74\164\162\x3e\74\x74\x64\40\x73\x74\171\154\x65\x3d\x27\146\157\156\164\55\167\x65\151\x67\150\x74\72\142\x6f\154\x64\73\142\157\x72\144\145\162\x3a\x32\160\170\40\x73\x6f\154\x69\x64\x20\x23\71\64\71\60\x39\x30\73\x70\141\144\x64\151\156\x67\72\x32\45\x3b\47\x3e" . $y9 . "\x3c\x2f\164\x64\76\x3c\164\144\40\163\x74\171\x6c\x65\x3d\47\x70\x61\144\144\151\156\x67\x3a\x32\x25\73\x62\157\x72\x64\x65\x72\72\x32\x70\x78\x20\x73\157\154\151\x64\x20\x23\x39\64\x39\60\x39\60\x3b\40\167\157\162\x64\55\x77\x72\141\160\x3a\x62\162\x65\141\x6b\55\167\x6f\x72\x64\x3b\47\76" . implode("\x3c\x68\x72\57\76", $nj) . "\74\57\164\144\x3e\74\57\164\x72\76";
        IOH:
    }
    gLS:
    ftZ:
    echo "\74\57\x74\141\x62\154\x65\x3e\74\x2f\x64\151\x76\x3e";
    echo "\x3c\x64\151\166\40\163\164\171\154\145\75\42\x6d\141\x72\147\151\156\72\63\x25\73\144\151\x73\160\x6c\141\171\72\x62\x6c\157\143\153\73\164\x65\170\164\55\x61\154\151\x67\x6e\72\x63\x65\x6e\x74\145\x72\73\42\x3e\xd\xa\x9\x9\x3c\151\x6e\160\165\x74\40\x73\164\x79\154\145\75\42\160\x61\x64\144\151\x6e\147\x3a\61\45\x3b\x77\151\144\x74\150\x3a\x32\x35\60\x70\170\x3b\142\x61\143\x6b\x67\x72\157\x75\x6e\144\72\40\43\60\60\71\x31\x43\104\x20\156\157\156\x65\40\162\145\160\145\141\164\x20\163\x63\x72\157\x6c\154\40\x30\x25\40\60\45\x3b\15\xa\11\x9\143\165\162\x73\x6f\x72\x3a\40\x70\x6f\151\156\164\x65\162\73\x66\x6f\156\x74\55\163\x69\x7a\x65\x3a\x31\65\x70\x78\x3b\x62\157\x72\144\145\x72\x2d\167\151\x64\164\x68\x3a\x20\61\160\x78\x3b\x62\157\162\x64\145\162\55\163\x74\x79\154\145\x3a\x20\x73\x6f\x6c\x69\x64\x3b\142\x6f\162\144\145\x72\55\x72\141\144\x69\x75\x73\72\40\63\x70\170\73\x77\150\151\x74\x65\x2d\x73\160\x61\143\x65\x3a\15\xa\11\x9\40\156\x6f\167\x72\141\x70\73\142\157\x78\55\x73\x69\172\151\156\x67\72\x20\142\157\x72\x64\x65\162\55\142\x6f\170\x3b\x62\x6f\x72\144\x65\x72\55\x63\x6f\x6c\x6f\162\72\40\43\60\x30\x37\x33\101\101\73\x62\x6f\170\x2d\163\x68\x61\144\x6f\167\72\40\x30\x70\x78\40\x31\x70\170\40\x30\x70\x78\40\x72\147\x62\141\x28\61\x32\60\x2c\40\x32\60\60\x2c\x20\62\63\60\x2c\40\x30\x2e\x36\x29\40\151\x6e\x73\x65\x74\x3b\x63\x6f\154\157\162\72\x20\x23\x46\x46\106\x3b" . $pg . "\42\15\12\40\40\x20\x20\40\40\40\x20\40\40\x20\x20\x74\171\x70\145\75\x22\142\x75\x74\164\x6f\x6e\x22\x20\x76\x61\x6c\165\145\x3d\x22\x43\x6f\x6e\x66\151\147\x75\162\145\40\101\x74\164\162\151\x62\165\x74\x65\57\x52\x6f\154\145\40\x4d\x61\x70\x70\151\156\x67\42\x20\157\x6e\x43\x6c\x69\143\153\75\x22\x63\154\157\163\x65\x5f\141\156\x64\137\162\145\144\151\x72\145\x63\164\50\x29\x3b\x22\x3e\40\x26\x6e\x62\163\160\73\x20\xd\12\40\x20\40\x20\40\40\40\40\x20\x20\x20\40\15\12\x9\11\x3c\x69\156\160\165\164\x20\163\x74\x79\154\x65\75\x22\x70\141\x64\x64\x69\156\x67\x3a\61\45\73\167\151\x64\x74\x68\x3a\x31\60\60\160\170\x3b\142\x61\x63\153\x67\x72\157\165\x6e\x64\72\40\x23\x30\x30\71\x31\103\x44\40\x6e\x6f\x6e\145\x20\x72\145\x70\x65\141\164\40\x73\143\x72\x6f\x6c\x6c\x20\60\x25\40\60\45\x3b\143\165\162\x73\157\162\x3a\x20\x70\x6f\x69\x6e\x74\x65\x72\x3b\x66\157\x6e\164\x2d\x73\151\x7a\x65\x3a\x31\65\x70\x78\x3b\x62\157\162\x64\x65\x72\x2d\x77\151\144\164\150\x3a\x20\61\x70\170\73\142\157\x72\x64\145\162\x2d\x73\x74\x79\154\x65\x3a\40\x73\157\154\151\144\73\142\157\x72\144\145\162\x2d\162\141\144\x69\x75\x73\72\40\x33\x70\x78\73\167\150\151\x74\145\x2d\163\160\x61\143\x65\72\40\x6e\157\167\x72\141\160\x3b\142\157\170\55\163\151\x7a\151\156\147\x3a\x20\142\x6f\162\144\145\162\55\x62\157\x78\x3b\x62\157\x72\144\x65\x72\55\x63\157\154\x6f\x72\x3a\40\x23\60\x30\x37\63\101\x41\73\142\157\170\55\x73\150\141\x64\x6f\x77\x3a\x20\x30\x70\x78\x20\61\160\x78\x20\60\x70\x78\40\162\x67\142\141\50\x31\x32\60\x2c\x20\62\60\60\54\x20\62\x33\x30\x2c\40\60\x2e\x36\51\40\x69\156\163\x65\164\73\143\x6f\x6c\x6f\x72\72\40\x23\x46\106\106\73\42\164\x79\x70\x65\75\42\x62\165\x74\x74\157\x6e\x22\40\166\141\x6c\165\145\x3d\x22\104\x6f\156\145\42\x20\x6f\156\103\x6c\x69\143\x6b\75\x22\163\x65\154\x66\56\x63\x6c\x6f\163\145\x28\51\x3b\42\76\74\57\x64\x69\166\76\15\xa\11\x9\15\12\x9\x9\74\x73\143\x72\x69\160\x74\76\15\xa\x20\x20\x20\40\x20\x20\40\40\x20\x20\x20\x20\x20\x66\165\x6e\143\x74\x69\157\156\40\143\x6c\x6f\x73\x65\137\141\x6e\x64\x5f\x72\x65\x64\x69\162\x65\x63\164\x28\51\173\15\xa\x20\x20\x20\40\40\x20\40\x20\40\x20\x20\40\40\40\x20\40\40\167\x69\156\x64\x6f\167\x2e\x6f\160\145\x6e\145\x72\56\162\145\144\x69\162\x65\143\164\x5f\x74\x6f\x5f\141\164\x74\162\x69\x62\x75\x74\145\x5f\x6d\x61\160\160\x69\x6e\x67\x28\x29\73\15\xa\40\40\x20\x20\x20\40\x20\40\x20\40\x20\x20\40\x20\40\x20\x20\163\x65\154\146\x2e\143\x6c\x6f\x73\145\50\x29\73\xd\xa\x20\x20\x20\40\x20\x20\40\40\40\x20\x20\x20\x20\175\40\x20\x20\xd\xa\15\xa\x9\11\74\57\x73\x63\162\151\160\x74\76";
    exit;
}
function mo_saml_convert_to_windows_iconv($Rb)
{
    $bU = LicenseHelper::getCurrentOption(mo_options_enum_service_provider::Is_encoding_enabled);
    if (!($bU === "\x63\150\x65\x63\x6b\x65\144")) {
        goto Xpi;
    }
    return iconv("\125\x54\x46\55\70", "\x43\120\x31\x32\65\x32\57\x2f\x49\107\116\117\122\105", $Rb);
    Xpi:
    return $Rb;
}
function mo_saml_login_user($iD, $dh, $Sj, $mh, $sM, $Hf, $Hc, $sl, $us, $rB = '', $Jw = '', $Nz = null)
{
    do_action("\155\157\137\141\x62\x72\x5f\146\151\x6c\164\x65\x72\x5f\x6c\x6f\x67\151\156", $Nz, $Jw, $rB);
    check_if_user_allowed_to_login_due_to_role_restriction($sM);
    $uW = get_option("\x6d\157\x5f\163\141\155\154\x5f\x73\x70\137\142\x61\x73\145\137\165\162\x6c");
    if (!empty($uW)) {
        goto BNw;
    }
    $uW = home_url();
    BNw:
    mo_saml_restrict_users_based_on_domain($iD);
    $mh = mo_saml_sanitize_username($mh);
    if (!(strlen($mh) > 60)) {
        goto twh;
    }
    wp_die("\x57\x65\40\x63\157\x75\154\144\40\156\x6f\x74\40\163\x69\147\x6e\40\x79\x6f\165\40\x69\156\x2e\x20\x50\x6c\x65\141\x73\x65\x20\143\x6f\x6e\x74\x61\143\164\40\171\x6f\165\162\40\141\144\155\x69\156\151\x73\x74\x72\x61\164\157\x72\x2e", "\105\162\162\157\x72\40\72\x20\x55\x73\x65\x72\156\141\x6d\145\x20\154\x65\x6e\147\164\x68\40\154\151\x6d\151\164\x20\162\145\141\x63\150\x65\x64");
    exit;
    twh:
    $eO = array("\x69\x64\160\137\x6e\141\155\x65" => get_option("\163\141\x6d\154\137\151\x64\145\156\164\x69\164\171\x5f\x6e\x61\x6d\145"));
    $nu = get_option("\155\157\x5f\141\154\x6c\157\x77\137\145\x78\151\163\164\x69\x6e\x67\x5f\165\163\x65\x72\x5f\x6c\x6f\x67\x69\156");
    if (username_exists($mh) || email_exists($iD)) {
        goto M__;
    }
    do_action("\x6d\x6f\x5f\x67\165\145\163\164\x5f\154\x6f\x67\x69\156", $Jw, $rB, $eO);
    $XK = get_option("\x73\141\155\x6c\x5f\141\x6d\137\x72\157\x6c\x65\x5f\x6d\141\x70\160\x69\156\147");
    $XK = maybe_unserialize($XK);
    $Sf = true;
    $IL = get_option("\x6d\x6f\x5f\x73\141\x6d\x6c\137\x64\157\x6e\164\137\143\162\145\x61\x74\145\x5f\165\163\x65\162\137\151\146\137\x72\157\154\145\137\x6e\157\164\x5f\x6d\141\160\x70\145\144");
    if (!(!empty($IL) && strcmp($IL, "\x63\x68\x65\143\x6b\145\144") == 0)) {
        goto UYp;
    }
    $IR = is_role_mapping_configured_for_user($XK, $sM);
    $Sf = $IR;
    UYp:
    if ($Sf === true) {
        goto Vp3;
    }
    $yy = get_option("\155\x6f\137\x73\x61\155\154\137\141\143\x63\x6f\x75\156\x74\x5f\x63\x72\x65\141\x74\151\157\156\137\x64\x69\x73\x61\x62\x6c\145\144\x5f\155\163\147");
    if (!empty($yy)) {
        goto fHB;
    }
    $yy = "\127\145\x20\143\157\165\154\x64\x20\x6e\157\164\x20\163\x69\x67\156\x20\171\157\165\40\x69\x6e\x2e\x20\120\x6c\145\x61\163\145\40\143\x6f\x6e\x74\x61\143\164\x20\x79\157\165\162\x20\x41\x64\x6d\x69\x6e\x69\x73\164\x72\141\x74\157\162\x2e";
    fHB:
    wp_die($yy, "\x45\162\162\157\x72\72\40\116\157\x74\x20\x61\x20\127\x6f\162\144\120\x72\x65\163\163\40\x4d\145\x6d\x62\x65\162");
    exit;
    goto wKD;
    Vp3:
    $FC = wp_generate_password(10, false);
    if (!empty($mh)) {
        goto ocf;
    }
    $DT = wp_create_user($iD, $FC, $iD);
    goto ntH;
    ocf:
    $DT = wp_create_user($mh, $FC, $iD);
    ntH:
    if (!is_wp_error($DT)) {
        goto iaf;
    }
    wp_die($DT->get_error_message() . "\x3c\x62\x72\x3e\x50\x6c\145\141\163\x65\x20\x63\x6f\x6e\164\x61\143\x74\x20\171\157\165\162\40\101\x64\155\151\x6e\151\x73\x74\162\141\x74\157\x72\56\x3c\x62\162\x3e\74\x62\76\125\x73\x65\x72\156\141\155\x65\x3c\x2f\x62\76\72\40" . $iD, "\x45\162\x72\157\x72\x3a\40\103\x6f\165\154\144\x6e\47\x74\x20\143\162\x65\141\x74\x65\x20\165\x73\x65\162");
    iaf:
    $user = get_user_by("\151\144", $DT);
    $ER = assign_roles_to_user($user, $XK, $sM);
    if ($ER !== true && !empty($Hf) && $Hf == "\143\x68\x65\143\x6b\145\x64") {
        goto yF9;
    }
    if ($ER !== true && !empty($Hc)) {
        goto IkS;
    }
    if ($ER !== true) {
        goto KcC;
    }
    goto X8q;
    yF9:
    $SF = wp_update_user(array("\x49\104" => $DT, "\x72\x6f\x6c\x65" => false));
    goto X8q;
    IkS:
    $SF = wp_update_user(array("\111\104" => $DT, "\162\x6f\154\145" => $Hc));
    goto X8q;
    KcC:
    $Hc = get_option("\x64\x65\x66\x61\x75\x6c\x74\x5f\x72\157\154\145");
    $SF = wp_update_user(array("\x49\104" => $DT, "\x72\157\154\145" => $Hc));
    X8q:
    mo_saml_map_attributes($user, $dh, $Sj, $Nz);
    mo_saml_set_auth_cookie($user, $rB, $Jw, true);
    do_action("\x6d\157\137\163\x61\x6d\x6c\x5f\x61\x74\x74\x72\151\142\165\x74\x65\x73", $mh, $iD, $dh, $Sj, $sM);
    wKD:
    goto PwR;
    M__:
    if (!($nu != "\x74\x72\165\145")) {
        goto ExN;
    }
    do_action("\x6d\157\x5f\147\165\x65\163\164\x5f\x6c\157\x67\x69\156", $Jw, $rB, $eO);
    ExN:
    if (username_exists($mh)) {
        goto f_N;
    }
    if (!email_exists($iD)) {
        goto VIh;
    }
    $user = get_user_by("\x65\155\141\151\154", $iD);
    $DT = $user->ID;
    VIh:
    goto eNO;
    f_N:
    $user = get_user_by("\154\x6f\147\151\156", $mh);
    $DT = $user->ID;
    if (!(!empty($iD) && is_email($iD))) {
        goto tbz;
    }
    $SF = wp_update_user(array("\x49\x44" => $DT, "\x75\163\x65\x72\x5f\x65\x6d\141\151\x6c" => $iD));
    tbz:
    eNO:
    mo_saml_map_attributes($user, $dh, $Sj, $Nz);
    $XK = maybe_unserialize(get_option("\163\x61\x6d\154\x5f\141\x6d\137\x72\157\x6c\x65\x5f\155\x61\x70\160\x69\x6e\x67"));
    $yJ = get_option("\x73\x61\x6d\x6c\x5f\x61\x6d\x5f\144\157\156\x74\137\x75\160\144\x61\164\x65\137\145\x78\x69\163\164\x69\x6e\x67\x5f\165\x73\145\162\x5f\x72\x6f\x6c\x65");
    if (!(empty($yJ) || $yJ != "\x63\x68\145\x63\x6b\x65\144")) {
        goto DS9;
    }
    $ER = assign_roles_to_user($user, $XK, $sM);
    $m3 = get_option("\163\141\x6d\154\x5f\x61\x6d\137\x75\x70\x64\x61\x74\145\137\x61\x64\x6d\151\156\137\165\x73\x65\162\163\137\x72\x6f\154\x65");
    if ($ER !== true && !is_administrator_user($user) && !empty($Hf) && $Hf == "\143\x68\x65\x63\153\x65\144") {
        goto qQu;
    }
    if ($ER !== true && !is_administrator_user($user) && !empty($Hc)) {
        goto XWR;
    }
    if ($ER !== true && is_administrator_user($user) && !empty($m3) && $m3 == "\143\150\x65\143\153\145\144" && !empty($Hf) && $Hf == "\x63\150\145\143\153\145\x64") {
        goto FoA;
    }
    if ($ER !== true && is_administrator_user($user) && !empty($m3) && $m3 == "\x63\x68\145\143\153\145\144" && !empty($Hc)) {
        goto CLr;
    }
    goto Ykz;
    qQu:
    $SF = wp_update_user(array("\111\104" => $DT, "\162\x6f\154\145" => false));
    goto Ykz;
    XWR:
    $SF = wp_update_user(array("\111\x44" => $DT, "\162\157\x6c\x65" => $Hc));
    goto Ykz;
    FoA:
    $SF = wp_update_user(array("\111\104" => $DT, "\162\157\154\145" => false));
    goto Ykz;
    CLr:
    $SF = wp_update_user(array("\x49\x44" => $DT, "\x72\x6f\x6c\145" => $Hc));
    Ykz:
    DS9:
    mo_saml_set_auth_cookie($user, $rB, $Jw);
    do_action("\x6d\x6f\x5f\163\141\155\154\137\141\164\x74\162\151\x62\x75\164\x65\163", $mh, $iD, $dh, $Sj, $sM);
    PwR:
    mo_saml_post_login_redirection($sl, $uW);
}
function mo_saml_sanitize_username($mh)
{
    $Sd = sanitize_user($mh, true);
    $vU = apply_filters("\160\x72\x65\137\x75\163\145\162\137\154\157\147\151\156", $Sd);
    $mh = trim($vU);
    return $mh;
}
function mo_saml_restrict_users_based_on_domain($iD)
{
    $YD = get_option("\x6d\157\x5f\163\141\155\154\137\x65\x6e\x61\142\154\x65\137\x64\x6f\155\x61\x69\156\x5f\162\x65\163\164\x72\x69\143\x74\x69\x6f\x6e\137\x6c\157\147\x69\x6e");
    if (!$YD) {
        goto ALU;
    }
    $yS = get_option("\x73\141\x6d\x6c\137\141\x6d\x5f\145\x6d\x61\151\154\x5f\x64\x6f\x6d\x61\x69\x6e\163");
    $lu = explode("\73", $yS);
    $bZ = explode("\x40", $iD);
    $Mo = array_key_exists("\x31", $bZ) ? $bZ[1] : '';
    $m1 = get_option("\x6d\x6f\137\x73\x61\x6d\154\x5f\141\x6c\x6c\157\x77\x5f\144\x65\x6e\x79\x5f\x75\163\145\162\137\167\x69\x74\150\x5f\144\157\155\x61\x69\x6e");
    $yy = get_option("\x6d\x6f\x5f\163\x61\155\154\137\x72\145\x73\x74\162\x69\143\x74\x65\x64\137\144\x6f\155\141\x69\156\137\x65\x72\162\157\x72\x5f\x6d\163\x67");
    if (!empty($yy)) {
        goto vxs;
    }
    $yy = "\131\x6f\x75\x20\141\x72\x65\40\156\x6f\x74\40\x61\154\x6c\x6f\x77\145\144\x20\x74\157\x20\154\157\147\151\x6e\x2e\x20\x50\154\145\x61\163\145\40\x63\x6f\156\164\141\143\x74\40\171\157\x75\x72\40\x41\144\x6d\151\x6e\151\163\164\162\141\x74\x6f\x72\x2e";
    vxs:
    if (!empty($m1) && $m1 == "\144\x65\x6e\171") {
        goto nda;
    }
    if (in_array($Mo, $lu)) {
        goto Hjf;
    }
    wp_die($yy, "\x50\145\162\x6d\x69\163\163\x69\x6f\x6e\x20\x44\145\x6e\x69\145\144\40\72\x20\x4e\157\164\40\141\x20\127\x68\x69\x74\x65\x6c\151\x73\164\x65\144\40\x75\163\x65\x72\x2e");
    Hjf:
    goto qrc;
    nda:
    if (!in_array($Mo, $lu)) {
        goto paK;
    }
    wp_die($yy, "\120\145\x72\x6d\x69\x73\163\151\157\x6e\40\x44\x65\156\151\x65\x64\x20\72\x20\102\x6c\x61\x63\x6b\154\151\163\164\x65\144\40\165\x73\x65\x72\x2e");
    paK:
    qrc:
    ALU:
}
function mo_saml_map_attributes($user, $dh, $Sj, $Nz)
{
    mo_saml_map_basic_attributes($user, $dh, $Sj, $Nz);
    mo_saml_map_custom_attributes($user, $Nz);
}
function mo_saml_map_basic_attributes($user, $dh, $Sj, $Nz)
{
    $DT = $user->ID;
    if (empty($dh)) {
        goto HTB;
    }
    $SF = wp_update_user(array("\x49\x44" => $DT, "\146\151\x72\x73\x74\137\x6e\141\x6d\145" => $dh));
    HTB:
    if (empty($Sj)) {
        goto XzC;
    }
    $SF = wp_update_user(array("\111\x44" => $DT, "\154\x61\163\164\137\x6e\x61\155\x65" => $Sj));
    XzC:
    if (is_null($Nz)) {
        goto zKK;
    }
    update_user_meta($DT, "\155\x6f\137\163\x61\155\x6c\137\165\163\x65\x72\x5f\141\164\164\x72\x69\x62\x75\164\x65\x73", $Nz);
    $c5 = get_option("\x73\x61\155\x6c\137\141\x6d\137\x64\151\163\160\154\141\171\137\156\x61\x6d\x65");
    if (empty($c5)) {
        goto AnC;
    }
    if (strcmp($c5, "\x55\123\105\122\x4e\x41\x4d\x45") == 0) {
        goto TOX;
    }
    if (strcmp($c5, "\x46\116\x41\x4d\x45") == 0 && !empty($dh)) {
        goto eR9;
    }
    if (strcmp($c5, "\x4c\x4e\x41\115\105") == 0 && !empty($Sj)) {
        goto W7L;
    }
    if (strcmp($c5, "\x46\116\x41\115\x45\x5f\114\116\101\x4d\105") == 0 && !empty($Sj) && !empty($dh)) {
        goto agz;
    }
    if (!(strcmp($c5, "\114\x4e\101\x4d\105\137\106\x4e\x41\115\105") == 0 && !empty($Sj) && !empty($dh))) {
        goto B05;
    }
    $SF = wp_update_user(array("\x49\x44" => $DT, "\144\151\163\x70\154\x61\x79\137\156\141\155\x65" => $Sj . "\x20" . $dh));
    B05:
    goto mfA;
    agz:
    $SF = wp_update_user(array("\x49\104" => $DT, "\144\x69\x73\160\x6c\141\x79\137\156\141\x6d\145" => $dh . "\40" . $Sj));
    mfA:
    goto sJ1;
    W7L:
    $SF = wp_update_user(array("\111\104" => $DT, "\144\x69\163\160\154\141\x79\137\x6e\x61\x6d\145" => $Sj));
    sJ1:
    goto sb5;
    eR9:
    $SF = wp_update_user(array("\x49\104" => $DT, "\x64\151\163\160\154\141\x79\x5f\156\141\x6d\145" => $dh));
    sb5:
    goto C1Q;
    TOX:
    $SF = wp_update_user(array("\111\x44" => $DT, "\x64\x69\x73\x70\154\x61\171\x5f\x6e\x61\155\x65" => $user->user_login));
    C1Q:
    AnC:
    zKK:
}
function mo_saml_map_custom_attributes($user, $Nz)
{
    $DT = $user->ID;
    if (!get_option("\155\157\137\163\x61\155\154\x5f\x63\165\x73\164\157\x6d\137\x61\164\x74\x72\x73\x5f\155\141\160\160\x69\156\147")) {
        goto ZTN;
    }
    $XH = maybe_unserialize(get_option("\x6d\x6f\x5f\163\141\155\x6c\x5f\x63\x75\x73\164\x6f\x6d\137\x61\x74\x74\162\163\x5f\155\x61\160\x70\x69\156\147"));
    foreach ($XH as $y9 => $nj) {
        if (!array_key_exists($nj, $Nz)) {
            goto VDH;
        }
        $a_ = false;
        if (!(count($Nz[$nj]) == 1)) {
            goto Xfk;
        }
        $a_ = true;
        Xfk:
        if (!$a_) {
            goto s26;
        }
        update_user_meta($DT, $y9, $Nz[$nj][0]);
        goto rC1;
        s26:
        $Wg = array();
        foreach ($Nz[$nj] as $MK) {
            array_push($Wg, $MK);
            LSU:
        }
        mFk:
        update_user_meta($DT, $y9, $Wg);
        rC1:
        VDH:
        YXi:
    }
    hb5:
    ZTN:
}
function mo_saml_set_auth_cookie($user, $rB, $Jw, $kI = false)
{
    $DT = $user->ID;
    wp_set_current_user($DT);
    $eN = false;
    $eN = apply_filters("\155\157\x5f\162\x65\155\x65\x6d\142\145\162\x5f\x6d\x65", $eN);
    wp_set_auth_cookie($DT, $eN);
    if (!$kI) {
        goto utr;
    }
    do_action("\x75\x73\145\x72\137\x72\x65\147\x69\163\x74\145\x72", $DT);
    utr:
    do_action("\167\160\x5f\x6c\157\x67\x69\x6e", $user->user_login, $user);
    if (empty($rB)) {
        goto AqA;
    }
    update_user_meta($DT, "\155\157\137\x73\141\155\154\137\163\x65\163\x73\x69\x6f\x6e\137\x69\156\144\x65\x78", $rB);
    AqA:
    if (empty($Jw)) {
        goto uiW;
    }
    update_user_meta($DT, "\155\157\137\163\141\155\x6c\137\x6e\141\x6d\145\137\151\144", $Jw);
    uiW:
    if (!(!session_id() || session_id() == '' || !isset($_SESSION))) {
        goto k9M;
    }
    session_start();
    k9M:
    $_SESSION["\x6d\x6f\137\163\141\x6d\x6c"]["\x6c\x6f\x67\x67\145\144\137\151\156\137\167\151\x74\150\x5f\151\x64\160"] = TRUE;
}
function mo_saml_post_login_redirection($sl, $uW)
{
    $sl = htmlspecialchars_decode($sl);
    $Fn = get_option("\x6d\157\137\x73\x61\155\154\137\162\x65\154\x61\171\137\163\164\x61\164\145");
    if (!empty($Fn)) {
        goto klv;
    }
    if (empty($sl)) {
        goto LHr;
    }
    $Oo = '';
    if (!get_option("\x6d\157\137\x73\x61\155\154\x5f\x73\145\156\x64\137\x61\142\163\157\x6c\165\x74\145\137\162\145\x6c\141\x79\x5f\x73\164\141\164\145")) {
        goto Y08;
    }
    $Vi = get_option("\155\157\137\x73\141\x6d\x6c\x5f\143\165\x73\164\157\155\145\x72\137\164\x6f\153\145\156");
    $Oo = AESEncryption::decrypt_data($sl, $Vi);
    Y08:
    if (!empty($Oo)) {
        goto c5P;
    }
    if (filter_var($sl, FILTER_VALIDATE_URL) === FALSE) {
        goto x1j;
    }
    if (strpos($sl, home_url()) !== false) {
        goto zWt;
    }
    $Sg = htmlspecialchars_decode($uW);
    goto ebd;
    zWt:
    $Sg = htmlspecialchars_decode($sl);
    ebd:
    goto iAU;
    c5P:
    $Sg = htmlspecialchars_decode($Oo);
    goto iAU;
    x1j:
    $Sg = htmlspecialchars_decode($sl);
    iAU:
    LHr:
    goto PuY;
    klv:
    $Sg = htmlspecialchars_decode($Fn);
    PuY:
    if (!empty($Sg)) {
        goto cS9;
    }
    $Sg = htmlspecialchars_decode($uW);
    cS9:
    wp_redirect($Sg);
    exit;
}
function check_if_user_allowed_to_login_due_to_role_restriction($sM)
{
    $Z9 = get_option("\x73\141\x6d\x6c\137\x61\x6d\137\144\x6f\156\164\137\141\154\x6c\x6f\167\137\165\x73\x65\x72\x5f\x74\157\154\157\x67\x69\156\x5f\x63\162\145\x61\x74\x65\137\167\151\x74\x68\x5f\x67\151\x76\145\x6e\137\147\162\157\165\x70\163");
    if (!($Z9 == "\143\150\145\143\153\x65\144")) {
        goto BXN;
    }
    if (empty($sM)) {
        goto bzK;
    }
    $nk = get_option("\155\x6f\x5f\x73\141\155\154\137\x72\x65\163\x74\x72\x69\143\164\137\x75\163\x65\x72\x73\x5f\167\x69\x74\150\137\147\162\x6f\x75\x70\x73");
    $JK = explode("\x3b", $nk);
    foreach ($JK as $C5) {
        foreach ($sM as $Ik) {
            $Ik = trim($Ik);
            if (!(!empty($Ik) && $Ik == $C5)) {
                goto B7T;
            }
            wp_die("\x59\x6f\165\40\x61\x72\145\40\x6e\157\164\x20\141\x75\x74\x68\x6f\162\x69\172\x65\144\40\164\x6f\x20\x6c\x6f\147\x69\156\56\40\120\154\145\141\x73\x65\x20\x63\x6f\156\164\x61\x63\x74\40\x79\157\x75\x72\40\x61\144\x6d\x69\x6e\151\163\164\162\141\164\157\x72\56", "\x45\162\x72\157\162");
            B7T:
            T4V:
        }
        As8:
        i1V:
    }
    xBn:
    bzK:
    BXN:
}
function assign_roles_to_user($user, $XK, $sM)
{
    $ER = false;
    if (!(!empty($sM) && !empty($XK) && !is_administrator_user($user))) {
        goto kJp;
    }
    $user->set_role(false);
    $C2 = '';
    $l5 = false;
    foreach ($XK as $Jt => $AX) {
        $JK = explode("\x3b", $AX);
        foreach ($JK as $C5) {
            foreach ($sM as $Ik) {
                $Ik = trim($Ik);
                if (!(!empty($Ik) && $Ik == $C5)) {
                    goto pE4;
                }
                $ER = true;
                $user->add_role($Jt);
                pE4:
                oGA:
            }
            jQg:
            beq:
        }
        Ib6:
        dql:
    }
    a_K:
    kJp:
    return $ER;
}
function is_role_mapping_configured_for_user($XK, $sM)
{
    if (!(!empty($sM) && !empty($XK))) {
        goto el1;
    }
    foreach ($XK as $Jt => $AX) {
        $JK = explode("\73", $AX);
        foreach ($JK as $C5) {
            foreach ($sM as $Ik) {
                $Ik = trim($Ik);
                if (!(!empty($Ik) && $Ik == $C5)) {
                    goto DLd;
                }
                return true;
                DLd:
                QJ6:
            }
            Kka:
            sdY:
        }
        rKX:
        XNb:
    }
    U1O:
    el1:
    return false;
}
function is_administrator_user($user)
{
    $S0 = $user->roles;
    if (!is_null($S0) && in_array("\141\144\x6d\151\156\151\163\x74\x72\141\164\x6f\x72", $S0, TRUE)) {
        goto FCk;
    }
    return false;
    goto Qix;
    FCk:
    return true;
    Qix:
}
function mo_saml_is_customer_registered()
{
    $Dm = get_option("\x6d\x6f\137\163\x61\155\x6c\x5f\141\x64\x6d\x69\x6e\x5f\145\x6d\141\151\154");
    $Da = get_option("\155\157\x5f\163\141\x6d\x6c\137\x61\144\155\151\x6e\x5f\143\165\x73\x74\157\x6d\x65\162\137\153\145\171");
    if (!$Dm || !$Da || !is_numeric(trim($Da))) {
        goto bbI;
    }
    return 1;
    goto bsf;
    bbI:
    return 0;
    bsf:
}
function mo_saml_is_customer_license_verified()
{
    $y9 = get_option("\x6d\x6f\137\x73\141\x6d\x6c\137\143\165\163\x74\157\x6d\145\x72\137\164\x6f\x6b\145\156");
    $i_ = AESEncryption::decrypt_data(get_option("\164\137\163\x69\x74\145\137\163\x74\x61\164\165\163"), $y9);
    $bv = get_option("\x73\x6d\x6c\x5f\154\153");
    $Dm = get_option("\155\157\137\163\x61\x6d\x6c\137\x61\144\155\x69\156\137\145\x6d\141\151\x6c");
    $Da = get_option("\x6d\x6f\x5f\x73\x61\155\154\x5f\x61\144\155\x69\x6e\137\x63\165\x73\x74\157\x6d\x65\x72\x5f\x6b\145\171");
    if (!$i_ && !$bv || !$Dm || !$Da || !is_numeric(trim($Da))) {
        goto iQL;
    }
    return 1;
    goto vH6;
    iQL:
    return 0;
    vH6:
}
function saml_get_current_page_url()
{
    $zz = $_SERVER["\x48\x54\124\120\x5f\110\x4f\x53\x54"];
    if (!(substr($zz, -1) == "\57")) {
        goto lHV;
    }
    $zz = substr($zz, 0, -1);
    lHV:
    $m9 = $_SERVER["\122\105\x51\x55\105\123\124\x5f\125\x52\x49"];
    if (!(substr($m9, 0, 1) == "\57")) {
        goto L9s;
    }
    $m9 = substr($m9, 1);
    L9s:
    $hO = isset($_SERVER["\110\124\x54\x50\x53"]) && strcasecmp($_SERVER["\110\124\124\x50\123"], "\x6f\156") == 0;
    $yZ = "\x68\x74\x74\x70" . ($hO ? "\x73" : '') . "\72\x2f\57" . $zz . "\57" . $m9;
    return $yZ;
}
function show_status_error($lx, $sl, $Le)
{
    $lx = strip_tags($lx);
    $Le = strip_tags($Le);
    if ($sl == "\164\145\x73\x74\x56\141\154\151\144\141\164\145" or $sl == "\x74\x65\163\164\116\x65\167\x43\x65\x72\x74\x69\146\151\143\141\x74\145") {
        goto oA9;
    }
    wp_die("\127\145\40\x63\157\165\154\x64\40\x6e\x6f\164\x20\163\x69\x67\156\40\171\x6f\x75\40\x69\156\56\x20\120\154\x65\141\163\x65\x20\143\x6f\156\x74\141\x63\x74\x20\x79\x6f\x75\162\40\x41\x64\155\x69\x6e\x69\x73\164\x72\141\164\x6f\162\x2e", "\x45\x72\x72\x6f\x72\72\x20\111\x6e\x76\141\154\x69\144\40\123\x41\115\x4c\x20\x52\145\x73\x70\x6f\156\x73\145\x20\x53\164\x61\x74\x75\x73");
    goto NBs;
    oA9:
    echo "\x3c\144\x69\166\40\x73\164\171\x6c\x65\x3d\x22\x66\157\156\x74\55\x66\141\x6d\151\x6c\171\x3a\103\141\x6c\151\x62\162\151\73\160\x61\144\144\151\156\x67\72\60\40\x33\45\73\42\76";
    echo "\x3c\144\x69\166\x20\x73\164\x79\x6c\145\x3d\42\143\x6f\154\157\x72\72\40\43\141\x39\x34\64\64\62\73\x62\141\x63\153\x67\162\x6f\x75\156\144\x2d\x63\157\x6c\157\162\x3a\x20\x23\146\x32\144\145\144\x65\73\160\x61\x64\144\x69\156\147\x3a\x20\61\65\160\x78\73\155\141\162\147\151\156\55\x62\157\164\x74\x6f\x6d\72\40\x32\60\160\x78\73\164\145\170\x74\x2d\141\154\x69\x67\156\x3a\x63\x65\156\164\x65\x72\73\x62\x6f\162\144\x65\162\x3a\x31\160\170\40\163\157\x6c\x69\x64\x20\43\x45\66\x42\x33\102\62\x3b\146\x6f\156\x74\x2d\x73\x69\172\x65\72\x31\70\x70\x74\x3b\42\x3e\x20\105\122\x52\x4f\122\x3c\x2f\144\151\x76\x3e\15\xa\40\40\x20\40\40\x20\x20\40\40\x20\x20\x20\40\40\40\x20\74\144\x69\x76\x20\x73\164\171\x6c\x65\x3d\x22\x63\157\154\x6f\x72\72\40\x23\x61\71\x34\64\x34\62\x3b\x66\157\x6e\x74\55\x73\151\172\x65\72\61\64\160\x74\73\x20\155\141\x72\147\x69\156\55\142\157\x74\164\157\155\72\x32\x30\x70\170\x3b\42\76\74\x70\76\74\163\x74\x72\x6f\156\x67\x3e\x45\162\x72\x6f\x72\x3a\40\x3c\x2f\x73\x74\x72\x6f\156\x67\x3e\x20\x49\156\x76\x61\154\x69\x64\40\x53\x41\115\114\x20\x52\145\x73\x70\157\156\163\145\x20\x53\164\x61\x74\165\163\x2e\x3c\57\x70\76\15\xa\40\x20\40\40\40\40\40\40\40\x20\x20\40\40\x20\40\40\74\160\76\x3c\x73\x74\162\157\x6e\x67\76\x43\x61\x75\x73\x65\163\x3c\x2f\163\x74\x72\157\156\147\76\x3a\x20\x49\144\145\x6e\x74\x69\164\x79\x20\120\162\x6f\166\x69\x64\x65\x72\x20\150\x61\163\40\163\145\x6e\164\x20\x27" . $lx . "\x27\x20\x73\164\141\x74\165\x73\x20\143\157\x64\x65\40\151\x6e\40\123\x41\115\114\40\x52\145\x73\x70\x6f\x6e\x73\x65\56\40\74\x2f\x70\x3e\15\xa\11\11\x9\x9\x9\x9\x9\11\x3c\160\76\x3c\x73\164\x72\157\x6e\x67\x3e\122\x65\141\x73\x6f\156\74\57\163\164\x72\x6f\x6e\x67\x3e\x3a\x20" . get_status_message($lx) . "\x3c\57\x70\x3e\x20";
    if (empty($Le)) {
        goto yYy;
    }
    echo "\74\x70\x3e\74\x73\x74\162\x6f\156\147\x3e\123\164\141\x74\165\163\x20\115\145\x73\163\x61\x67\x65\x20\x69\156\x20\x74\150\145\x20\x53\x41\115\114\x20\x52\145\163\x70\157\156\x73\x65\x3a\74\57\163\x74\x72\x6f\x6e\x67\76\40\x3c\x62\162\x2f\76" . $Le . "\74\57\x70\76";
    yYy:
    echo "\x3c\x62\x72\76\15\xa\x20\40\40\x20\x20\40\40\40\40\x20\40\x20\40\40\x20\x20\74\57\144\151\x76\x3e\xd\xa\xd\12\x20\x20\x20\40\40\40\40\x20\40\x20\x20\40\x20\40\40\40\x3c\x64\151\166\40\163\164\171\x6c\145\75\42\x6d\x61\162\147\151\x6e\72\x33\45\x3b\x64\151\x73\160\154\141\171\72\142\154\157\143\153\73\164\x65\x78\x74\55\141\x6c\x69\147\x6e\72\143\x65\x6e\x74\x65\x72\73\x22\x3e\xd\xa\40\40\x20\40\x20\40\40\x20\x20\40\x20\40\40\x20\x20\40\74\144\151\x76\40\163\164\171\154\x65\75\42\155\x61\162\147\151\156\72\x33\45\73\144\x69\x73\160\x6c\141\171\x3a\142\x6c\157\143\x6b\73\164\x65\170\x74\x2d\141\x6c\x69\x67\156\72\x63\x65\156\x74\145\162\73\x22\76\74\151\x6e\x70\165\164\x20\x73\x74\x79\154\x65\x3d\x22\160\141\144\144\151\x6e\x67\72\61\45\x3b\x77\151\144\164\x68\x3a\x31\x30\60\x70\170\73\x62\x61\143\153\x67\x72\x6f\165\156\144\x3a\x20\43\60\x30\71\x31\x43\x44\x20\156\157\156\x65\40\x72\145\160\x65\x61\164\x20\x73\x63\x72\157\x6c\154\40\60\45\40\60\x25\73\x63\x75\162\163\x6f\162\x3a\x20\160\x6f\x69\156\x74\145\162\73\x66\x6f\156\x74\55\x73\151\x7a\x65\72\61\65\x70\x78\x3b\x62\x6f\x72\x64\x65\162\x2d\x77\151\x64\x74\150\x3a\40\61\x70\170\x3b\142\157\x72\144\145\x72\55\163\x74\171\154\145\x3a\x20\163\x6f\x6c\x69\144\73\142\x6f\x72\x64\145\x72\55\x72\141\144\x69\x75\163\72\x20\63\x70\170\73\167\x68\151\x74\x65\x2d\x73\x70\141\x63\x65\x3a\40\x6e\x6f\x77\x72\x61\160\x3b\142\157\x78\x2d\x73\x69\172\151\x6e\147\x3a\40\x62\x6f\x72\144\x65\x72\x2d\x62\157\170\73\142\x6f\162\x64\x65\162\x2d\x63\157\154\x6f\162\x3a\40\43\x30\60\x37\x33\101\x41\x3b\142\x6f\170\55\x73\150\141\144\157\167\x3a\40\x30\160\x78\40\61\160\x78\40\x30\x70\x78\x20\x72\x67\x62\141\x28\61\62\x30\x2c\40\x32\60\60\54\40\x32\x33\x30\x2c\40\60\56\66\x29\x20\151\156\163\145\x74\x3b\143\157\x6c\x6f\162\x3a\40\x23\x46\x46\x46\73\x22\x74\171\160\145\75\42\142\x75\164\x74\x6f\x6e\42\40\166\x61\x6c\165\145\75\x22\x44\x6f\x6e\145\x22\x20\157\156\x43\x6c\151\143\x6b\75\42\x73\145\x6c\146\x2e\x63\x6c\157\x73\x65\50\51\x3b\42\x3e\74\57\x64\151\166\76";
    exit;
    NBs:
}
function addLink($Ri, $gd)
{
    $qC = "\x3c\141\40\x68\162\x65\x66\x3d\x22" . $gd . "\42\76" . $Ri . "\x3c\57\141\x3e";
    return $qC;
}
function get_status_message($lx)
{
    switch ($lx) {
        case "\x52\x65\x71\165\145\x73\164\x65\x72":
            return "\x54\150\x65\x20\162\145\161\x75\145\163\164\40\x63\157\x75\x6c\x64\40\x6e\157\164\40\142\x65\x20\x70\x65\162\x66\x6f\162\155\145\x64\40\144\x75\145\x20\164\x6f\x20\x61\156\40\x65\162\162\157\x72\40\157\156\x20\x74\150\x65\40\160\141\162\x74\x20\x6f\146\x20\x74\150\x65\40\x72\145\161\165\145\x73\x74\145\162\56";
            goto G2n;
        case "\122\145\163\160\x6f\156\x64\145\x72":
            return "\x54\150\x65\40\x72\145\161\x75\x65\x73\164\x20\x63\x6f\165\x6c\144\x20\156\157\x74\x20\x62\x65\x20\x70\x65\x72\x66\x6f\162\x6d\x65\x64\x20\144\x75\x65\40\164\x6f\x20\141\156\40\145\162\x72\157\x72\40\x6f\x6e\x20\x74\150\145\40\x70\x61\x72\x74\x20\x6f\x66\40\x74\x68\145\x20\x53\101\115\114\x20\162\145\x73\x70\157\156\x64\145\x72\40\157\162\x20\x53\x41\x4d\114\x20\x61\165\164\150\x6f\x72\x69\x74\171\x2e";
            goto G2n;
        case "\126\x65\x72\x73\151\157\156\x4d\x69\x73\155\141\164\143\150":
            return "\124\x68\145\40\123\101\115\x4c\40\x72\145\163\x70\x6f\x6e\x64\145\162\40\143\x6f\165\x6c\x64\x20\x6e\x6f\x74\x20\160\x72\157\143\145\163\163\40\164\x68\x65\x20\162\x65\161\x75\145\x73\x74\40\x62\145\143\141\165\163\145\x20\164\150\x65\40\166\145\x72\x73\151\x6f\156\40\x6f\x66\40\x74\x68\x65\x20\x72\145\161\x75\x65\163\164\x20\155\x65\x73\x73\x61\147\145\x20\167\141\x73\40\x69\x6e\x63\x6f\x72\x72\145\x63\x74\x2e";
            goto G2n;
        default:
            return "\125\x6e\153\x6e\x6f\x77\x6e";
    }
    kJJ:
    G2n:
}
function mo_saml_register_widget()
{
    register_widget("\x6d\157\137\154\x6f\147\x69\156\x5f\167\x69\144");
}
function mo_saml_get_relay_state($yZ)
{
    if (!($yZ == "\164\x65\x73\x74\x56\x61\x6c\151\x64\x61\164\145" || $yZ == "\x74\145\163\164\116\145\167\x43\x65\162\x74\x69\x66\x69\143\141\164\x65")) {
        goto k78;
    }
    return $yZ;
    k78:
    if (get_option("\x6d\x6f\x5f\163\x61\x6d\x6c\x5f\163\145\x6e\144\137\x61\x62\x73\157\154\165\164\x65\x5f\162\x65\x6c\141\171\137\x73\x74\141\164\145")) {
        goto H3F;
    }
    $fj = parse_url($yZ, PHP_URL_PATH);
    if (!parse_url($yZ, PHP_URL_QUERY)) {
        goto V9B;
    }
    $Io = parse_url($yZ, PHP_URL_QUERY);
    $fj = $fj . "\77" . $Io;
    V9B:
    if (!parse_url($yZ, PHP_URL_FRAGMENT)) {
        goto S0G;
    }
    $ol = parse_url($yZ, PHP_URL_FRAGMENT);
    $fj = $fj . "\43" . $ol;
    S0G:
    goto pGt;
    H3F:
    $Vi = get_option("\x6d\x6f\x5f\163\x61\x6d\154\137\143\x75\163\x74\157\155\x65\162\x5f\x74\157\x6b\x65\156");
    $fj = AESEncryption::encrypt_data($yZ, $Vi);
    pGt:
    return $fj;
}
add_action("\167\151\x64\x67\145\x74\163\137\151\156\x69\x74", "\x6d\157\137\163\x61\x6d\x6c\137\162\x65\x67\x69\163\x74\x65\x72\x5f\x77\151\x64\x67\x65\164");
add_action("\x69\156\x69\x74", "\155\157\137\x6c\157\147\151\x6e\x5f\x76\x61\154\151\144\x61\x74\145");
