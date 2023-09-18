<?php


class LicenseObject
{
    private $wp_site_url;
    private $plugin_settings = array();
    public function __construct($eu)
    {
        $this->wp_site_url = $eu;
    }
    public function getWpSiteUrl()
    {
        return $this->wp_site_url;
    }
    public function setWpSiteUrl($eu)
    {
        $this->wp_site_url = $eu;
    }
    public function getPluginSettings()
    {
        return $this->plugin_settings;
    }
    public function setPluginSettings($kz, $Gb = false)
    {
        if ($Gb) {
            goto pk;
        }
        $this->plugin_settings = $kz;
        goto hj;
        pk:
        foreach (mo_options_enum_service_provider::getConstants() as $j5) {
            if ($j5 == mo_options_enum_service_provider::Request_signed || $j5 == mo_options_enum_service_provider::Is_encoding_enabled) {
                goto gv;
            }
            if (!isset($kz[$j5])) {
                goto op;
            }
            if (!($j5 == mo_options_enum_service_provider::X509_certificate)) {
                goto kB;
            }
            $FL = $kz[mo_options_enum_service_provider::X509_certificate];
            $HU = array();
            foreach ($FL as $y9 => $nj) {
                if (empty($nj)) {
                    goto J3;
                }
                $HU[$y9] = SAMLSPUtilities::sanitize_certificate($nj);
                if (@openssl_x509_read($HU[$y9])) {
                    goto oH;
                }
                update_option("\155\157\x5f\x73\x61\155\x6c\137\x6d\145\163\x73\141\147\x65", "\x49\156\166\141\x6c\151\144\40\143\145\162\164\x69\146\x69\143\141\164\x65\72\x20\x50\154\x65\141\x73\145\40\x70\162\x6f\x76\x69\144\x65\x20\141\x20\166\141\x6c\x69\144\x20\x63\145\162\x74\x69\146\x69\143\141\164\x65\x2e");
                delete_option("\163\x61\155\x6c\x5f\x78\65\60\x39\x5f\143\x65\x72\164\151\x66\x69\x63\141\x74\145");
                return;
                oH:
                goto MW;
                J3:
                unset($FL[$y9]);
                MW:
                An:
            }
            dd:
            $kz[$j5] = maybe_serialize($HU);
            kB:
            $this->plugin_settings[$j5] = htmlspecialchars(trim($kz[$j5]));
            op:
            goto t5;
            gv:
            if (isset($kz[$j5]) and !empty($kz[$j5])) {
                goto tF;
            }
            $kz[$j5] = "\165\156\x63\x68\x65\x63\153\145\x64";
            goto p1;
            tF:
            $kz[$j5] = "\143\150\145\x63\153\145\x64";
            p1:
            $this->plugin_settings[$j5] = htmlspecialchars(trim($kz[$j5]));
            t5:
            v0:
        }
        OB:
        foreach (mo_options_enum_attribute_mapping::getConstants() as $j5) {
            if (!isset($kz[$j5])) {
                goto Ze;
            }
            $this->plugin_settings[$j5] = htmlspecialchars(trim($kz[$j5]));
            Ze:
            ez:
        }
        rl:
        foreach (mo_options_enum_domain_restriction::getConstants() as $j5) {
            if (!isset($kz[$j5])) {
                goto Fv;
            }
            $this->plugin_settings[$j5] = htmlspecialchars(trim($kz[$j5]));
            Fv:
            Ve:
        }
        rp:
        foreach (mo_options_enum_role_mapping::getConstants() as $j5) {
            if (!isset($kz[$j5])) {
                goto SH;
            }
            $this->plugin_settings[$j5] = htmlspecialchars(trim($kz[$j5]));
            SH:
            Pn:
        }
        xj:
        hj:
    }
}
