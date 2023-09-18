<?php


function mo_save_environment_settings($Gb)
{
    if (get_option("\x6d\x6f\x5f\x65\156\141\142\154\x65\137\155\165\154\x74\x69\160\x6c\x65\137\154\x69\x63\145\x6e\x73\x65\163")) {
        goto Fs;
    }
    return false;
    Fs:
    $og = LicenseHelper::getSelectedEnvironment();
    $Kt = get_option("\x6d\x6f\x5f\x73\x61\155\x6c\137\x65\x6e\166\x69\x72\x6f\156\155\x65\x6e\164\x5f\x6f\x62\x6a\145\x63\x74\163");
    if (!($Kt and isset($Kt[$og]))) {
        goto cb;
    }
    $Kt[$og]->setPluginSettings($Gb, true);
    cb:
    update_option("\x6d\157\137\x73\141\155\x6c\x5f\x65\156\x76\151\x72\157\x6e\155\145\156\x74\x5f\157\x62\152\145\x63\164\x73", $Kt);
    return true;
}
