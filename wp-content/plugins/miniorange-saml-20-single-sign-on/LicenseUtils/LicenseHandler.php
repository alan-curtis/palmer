<?php


function initializeLicenseObjectArray()
{
    $VI = get_bloginfo("\x6e\141\155\x65");
    $G6 = site_url();
    if (!empty(get_option("\x6d\157\x5f\163\x61\155\x6c\x5f\145\156\x76\151\162\x6f\156\x6d\145\x6e\x74\137\x6f\142\x6a\x65\x63\164\x73"))) {
        goto JY;
    }
    $ut = array($VI => LicenseHelper::getNewEnvironmentObject($G6));
    update_option("\x6d\x6f\x5f\163\x61\x6d\x6c\x5f\145\156\166\151\x72\x6f\x6e\x6d\x65\156\x74\137\157\x62\x6a\145\x63\164\163", $ut);
    JY:
    update_option("\155\157\137\x73\x61\x6d\x6c\137\x73\145\x6c\145\143\164\145\144\x5f\145\156\x76\x69\x72\157\x6e\x6d\x65\x6e\164", $VI);
}
function updateLicenseObjects($Gb)
{
    $Z7 = array();
    $ux = array();
    if (!checkIssetAndEmpty($Gb, "\x6d\x6f\137\163\x61\x6d\154\x5f\145\x6e\x76\x69\x72\x6f\x6e\x6d\145\x6e\x74\x5f\x6e\141\x6d\145\x73")) {
        goto i6;
    }
    $Z7 = $Gb["\155\x6f\x5f\163\x61\155\x6c\x5f\145\156\166\x69\x72\157\x6e\x6d\145\156\164\137\x6e\141\x6d\x65\163"];
    i6:
    if (!checkIssetAndEmpty($Gb, "\x6d\157\137\x73\x61\x6d\154\x5f\145\156\166\151\x72\157\156\x6d\x65\x6e\x74\x5f\165\x72\154\x73")) {
        goto Me;
    }
    $ux = $Gb["\x6d\x6f\137\x73\141\155\154\137\145\x6e\166\151\162\x6f\156\x6d\x65\x6e\164\x5f\x75\162\x6c\x73"];
    Me:
    if (!(isArrayWithDuplicateEntries($Z7) || isArrayWithDuplicateEntries($ux) || isCurrentEnvironmentRemoved($ux))) {
        goto pJ;
    }
    return false;
    pJ:
    $I1 = array_combine($Z7, $ux);
    $I1 = array_filter($I1);
    $u9 = createEnvironmentObjectsForEnvironments($I1);
    update_option("\x6d\x6f\x5f\x73\x61\x6d\x6c\x5f\145\156\166\151\162\x6f\x6e\x6d\145\156\164\x5f\157\x62\152\145\x63\x74\x73", $u9);
    return true;
}
function checkIssetAndEmpty($cx, $L6)
{
    if (!(isset($cx[$L6]) and !empty($cx[$L6]))) {
        goto o9;
    }
    return true;
    o9:
    return false;
}
function mo_saml_filter_environmentObjects($u9, $I1)
{
    foreach ($u9 as $n_ => $lW) {
        if (!(empty($n_) || empty($lW->getWpSiteUrl()) || !array_key_exists($n_, $I1))) {
            goto y8;
        }
        unset($u9[$n_]);
        y8:
        Fi:
    }
    M9:
    return $u9;
}
function isArrayWithDuplicateEntries($I1)
{
    $yd = array_unique($I1);
    if (count($I1) != count($yd)) {
        goto QS;
    }
    return false;
    goto sL;
    QS:
    return true;
    sL:
}
function createEnvironmentObjectsForEnvironments($I1)
{
    $u9 = get_option("\155\157\137\163\141\x6d\154\137\x65\x6e\166\x69\x72\x6f\156\155\x65\x6e\x74\x5f\157\x62\x6a\x65\x63\164\163");
    $Q8 = LicenseHelper::getCurrentEnvironment();
    $SO = isset($u9[$Q8]) ? $u9[$Q8]->getPluginSettings() : null;
    foreach ($I1 as $IF => $H4) {
        $Ug = $H4;
        if (!(substr($Ug, -1) == "\x2f")) {
            goto Vz;
        }
        $Ug = substr($Ug, 0, -1);
        Vz:
        $gK = LicenseHelper::fetchExistingEnvironmentName($IF, $H4);
        if (!empty($gK)) {
            goto Il;
        }
        $Jd = new LicenseObject($Ug);
        $u9[$IF] = $Jd;
        $Jd->setPluginSettings($SO);
        goto uc;
        Il:
        $P5 = $u9[$gK];
        $P5->setWpSiteUrl($Ug);
        unset($u9[$gK]);
        $u9[$IF] = $P5;
        uc:
        i5:
    }
    ME:
    $u9 = mo_saml_filter_environmentObjects($u9, $I1);
    return $u9;
}
function isCurrentEnvironmentRemoved($ux)
{
    $dX = LicenseHelper::parseEnvironmentUrl(site_url());
    foreach ($ux as $TI) {
        if (!($dX == LicenseHelper::parseEnvironmentUrl($TI))) {
            goto sO;
        }
        return false;
        sO:
        bB:
    }
    wy:
    return true;
}
