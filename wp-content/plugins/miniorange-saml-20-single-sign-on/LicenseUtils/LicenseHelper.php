<?php


class LicenseHelper
{
    public static function getBasePluginConfigurationArray()
    {
        $QM = array();
        foreach (mo_options_enum_service_provider::getConstants() as $j5) {
            $QM[$j5] = get_option($j5);
            Lu:
        }
        YT:
        foreach (mo_options_enum_attribute_mapping::getConstants() as $j5) {
            $QM[$j5] = get_option($j5);
            P5:
        }
        p8:
        foreach (mo_options_enum_domain_restriction::getConstants() as $j5) {
            $QM[$j5] = get_option($j5);
            cS:
        }
        Yk:
        foreach (mo_options_enum_role_mapping::getConstants() as $j5) {
            $QM[$j5] = get_option($j5);
            E_:
        }
        nz:
        return $QM;
    }
    public static function getPluginConfiguration($IF = '')
    {
        $rx = get_option("\155\x6f\137\x65\x6e\x61\142\x6c\145\x5f\155\165\154\164\x69\x70\x6c\145\137\x6c\x69\x63\x65\156\x73\145\163");
        if ($rx) {
            goto Sa;
        }
        return self::getBasePluginConfigurationArray();
        Sa:
        $u9 = get_option("\155\x6f\x5f\163\x61\x6d\154\137\145\156\x76\x69\x72\157\x6e\x6d\145\x6e\x74\x5f\x6f\x62\x6a\x65\x63\x74\163");
        $og = self::getSelectedEnvironment();
        if (!is_array($u9)) {
            goto aO;
        }
        if (array_key_exists($IF, $u9)) {
            goto gB;
        }
        if (!array_key_exists($og, $u9)) {
            goto LY;
        }
        return $u9[$og]->getPluginSettings();
        LY:
        goto d5;
        gB:
        return $u9[$IF]->getPluginSettings();
        d5:
        aO:
        return self::getBasePluginConfigurationArray();
    }
    public static function getOptionForSelectedEnvironment($j5)
    {
        $O9 = self::getPluginConfiguration();
        if (isset($O9[$j5])) {
            goto E0;
        }
        return false;
        goto jL;
        E0:
        return $O9[$j5];
        jL:
    }
    public static function getCurrentEnvironment()
    {
        $dX = site_url();
        $ut = get_option("\155\x6f\137\163\x61\155\x6c\137\x65\x6e\x76\151\162\157\156\155\145\x6e\164\x5f\157\142\152\x65\143\164\163");
        $Q8 = '';
        if (!is_array($ut)) {
            goto Wy;
        }
        foreach ($ut as $n_ => $Tp) {
            if (!(self::parseEnvironmentUrl($Tp->getWpSiteUrl()) == self::parseEnvironmentUrl($dX))) {
                goto wY;
            }
            $Q8 = $n_;
            wY:
            OZ:
        }
        mf:
        Wy:
        return $Q8;
    }
    public static function parseEnvironmentUrl($H4)
    {
        $uV = parse_url($H4, PHP_URL_SCHEME);
        $H4 = str_replace($uV . "\x3a\57\x2f", '', $H4);
        return $H4;
    }
    public static function getCurrentOption($JR)
    {
        $xj = self::getPluginConfiguration(self::getCurrentEnvironment());
        if ($JR == "\x73\141\155\x6c\x5f\170\x35\x30\71\x5f\x63\145\x72\164\x69\x66\x69\143\x61\x74\x65") {
            goto X2;
        }
        $oo = isset($xj[$JR]) ? $xj[$JR] : false;
        goto GT;
        X2:
        $oo = isset($xj[$JR]) ? maybe_unserialize(htmlspecialchars_decode($xj[$JR])) : false;
        GT:
        return $oo;
    }
    public static function getNewEnvironmentObject($TI)
    {
        $rt = new LicenseObject($TI);
        $rt->setPluginSettings(self::getBasePluginConfigurationArray());
        return $rt;
    }
    public static function fetchExistingEnvironmentName($n_, $TI)
    {
        $ut = get_option("\x6d\157\137\x73\x61\155\x6c\x5f\145\156\x76\151\x72\157\156\155\x65\156\164\137\157\x62\152\145\143\164\x73");
        if (!empty($ut)) {
            goto Ao;
        }
        return false;
        Ao:
        if (array_key_exists($n_, $ut)) {
            goto jA;
        }
        foreach ($ut as $n_ => $lW) {
            if (!(self::parseEnvironmentUrl($lW->getWpSiteUrl()) == self::parseEnvironmentUrl($TI))) {
                goto Lj;
            }
            return $n_;
            Lj:
            qR:
        }
        pI:
        goto wl;
        jA:
        return $n_;
        wl:
        return false;
    }
    public static function getSelectedEnvironment()
    {
        $og = get_option("\155\157\137\x73\141\x6d\x6c\137\x73\x65\x6c\x65\143\x74\145\144\x5f\x65\x6e\x76\151\x72\157\x6e\155\x65\156\x74");
        $ut = get_option("\155\157\x5f\163\x61\x6d\154\x5f\x65\156\166\x69\x72\157\156\x6d\145\x6e\164\137\x6f\x62\152\145\x63\164\x73");
        if (!(empty($og) || !array_key_exists($og, $ut))) {
            goto Je;
        }
        $og = self::getCurrentEnvironment();
        Je:
        return $og;
    }
    public static function migrateExistingEnvironments()
    {
        $QC = get_option("\x65\x6e\x76\151\162\157\156\x6d\145\156\x74\x5f\157\142\x6a\145\x63\164\163");
        $sw = get_option("\x6d\157\x5f\x73\141\155\x6c\137\x65\156\166\151\x72\157\156\x6d\145\x6e\x74\137\x6f\x62\x6a\x65\x63\164\163");
        if (!(!empty($QC) and empty($sw))) {
            goto nj;
        }
        $sw = $QC;
        update_option("\155\157\137\163\141\x6d\x6c\x5f\145\156\x76\x69\x72\157\x6e\x6d\145\156\164\x5f\x6f\142\152\145\x63\x74\163", $sw);
        nj:
    }
}
