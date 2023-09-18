<?php


class mo_saml_wp_cli_commands
{
    private function check_for_empty_or_null($sF, $y9)
    {
        if (!empty($sF)) {
            goto fU;
        }
        WP_CLI::error("\124\x68\x65\162\145\40\x68\141\163\40\142\x65\x65\156\x20\145\x72\162\x6f\162\40\x70\x72\x6f\x63\x65\x73\163\151\x6e\x67\x20\171\x6f\x75\x72\x20\x72\x65\x71\x75\x65\x73\x74\x2e\x20" . $y9 . "\x20\x69\163\40\145\x69\164\x68\145\162\40\145\155\160\164\171\x20\x6f\162\40\x6e\165\154\x6c");
        fU:
    }
    private function file_checks($ii)
    {
        if (file_exists($ii)) {
            goto mZ;
        }
        WP_CLI::error(mo_saml_cli_error::File_Not_Found);
        mZ:
        $vT = filetype($ii);
        if (!($vT != "\152\x73\157\156")) {
            goto IO;
        }
        WP_CLI::error(mo_saml_cli_error::Incorrect_File_Format);
        IO:
    }
    public function fetch($ZB, $pj)
    {
        $this->check_for_empty_or_null($pj["\x63\157\156\x66\151\x67"], "\111\x6e\160\165\164");
        $ii = dirname(__FILE__) . "\x2f" . $pj["\x63\x6f\x6e\146\x69\147"];
        $this->file_checks($ii);
        $Z_ = file_get_contents($ii);
        $Z_ = json_decode($Z_, true);
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto Bb;
        }
        WP_CLI::error(mo_saml_cli_error::Invalid_JSON);
        Bb:
        mo_update_configuration_array($Z_);
        WP_CLI::success("\123\145\164\164\151\156\147\163\x20\141\x70\160\154\x69\x65\144\40\163\x75\143\x63\x65\163\163\x66\165\x6c\154\x79\x2e");
        exit;
    }
    public function activate($ZB, $pj)
    {
        $this->check_for_empty_or_null($pj["\x66\151\x6c\x65"], "\106\151\x6c\x65");
        $this->check_for_empty_or_null($pj["\144\157\x6d\141\151\156"], "\x44\157\x6d\x61\x69\x6e");
        $ii = dirname(__FILE__) . "\x2f" . $pj["\146\151\x6c\145"];
        $this->file_checks($ii);
        $Np = file_get_contents($ii);
        $Bc = json_decode($Np);
        if (!(json_last_error() !== JSON_ERROR_NONE)) {
            goto Ae;
        }
        WP_CLI::error(mo_saml_cli_error::Invalid_JSON);
        Ae:
        $Vi = $Bc->customer_key;
        $co = $Bc->customer_api_key;
        $NA = $Bc->customer_token_key;
        $Kd = $Bc->admin_email;
        $this->check_for_empty_or_null($Vi, "\103\x75\x73\x74\157\155\x65\x72\40\113\145\171");
        $this->check_for_empty_or_null($co, "\103\165\163\164\x6f\155\x65\x72\x20\101\120\111\x20\113\x65\171");
        $this->check_for_empty_or_null($NA, "\103\165\163\164\157\x6d\x65\x72\40\124\x6f\153\145\156");
        $this->check_for_empty_or_null($Kd, "\x41\x64\155\151\156\40\105\155\141\151\x6c");
        $aY = $pj["\144\157\155\141\x69\156"];
        $zp = $Bc->{$aY};
        $Jx = $zp->mo_saml_license_key;
        $this->check_for_empty_or_null($Jx, "\x4c\151\x63\145\x6e\163\145\x20\113\x65\171");
        $m5 = new saml_mo_login();
        $m5->mo_sso_saml_deactivate();
        $m5->mo_cli_save_details($Vi, $co, $NA, $Kd, $Jx);
    }
}
WP_CLI::add_command("\163\141\155\154", "\155\157\137\x73\x61\x6d\154\x5f\x77\160\x5f\x63\154\x69\137\x63\x6f\155\155\141\156\x64\163");
