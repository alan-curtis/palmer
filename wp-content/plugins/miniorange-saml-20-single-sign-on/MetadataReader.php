<?php


include_once "\x55\x74\151\154\151\164\x69\145\163\56\160\150\160";
class IDPMetadataReader
{
    private $identityProviders;
    private $serviceProviders;
    public function __construct(DOMNode $tW = NULL)
    {
        $this->identityProviders = array();
        $this->serviceProviders = array();
        $kZ = SAMLSPUtilities::xpQuery($tW, "\56\x2f\x73\x61\155\154\x5f\x6d\145\x74\141\x64\141\164\x61\x3a\x45\156\x74\151\164\x69\145\x73\104\x65\163\x63\x72\x69\160\x74\157\162");
        if (!empty($kZ)) {
            goto Pl;
        }
        $q3 = SAMLSPUtilities::xpQuery($tW, "\x2e\57\163\141\155\x6c\x5f\x6d\x65\x74\141\144\141\164\141\72\x45\x6e\164\x69\x74\x79\x44\145\163\x63\x72\x69\160\x74\x6f\x72");
        goto RK;
        Pl:
        $q3 = SAMLSPUtilities::xpQuery($kZ[0], "\56\x2f\x73\x61\x6d\x6c\137\155\x65\164\x61\x64\141\164\x61\72\x45\156\x74\151\164\x79\104\x65\163\x63\162\151\160\x74\x6f\x72");
        RK:
        foreach ($q3 as $jY) {
            $e2 = SAMLSPUtilities::xpQuery($jY, "\56\57\163\x61\155\154\x5f\155\145\x74\x61\x64\x61\x74\141\x3a\111\104\x50\x53\x53\117\104\145\x73\x63\x72\x69\160\164\157\162");
            if (!(isset($e2) && !empty($e2))) {
                goto nf;
            }
            array_push($this->identityProviders, new IdentityProviders($jY));
            nf:
            PH:
        }
        LD:
    }
    public function getIdentityProviders()
    {
        return $this->identityProviders;
    }
    public function getServiceProviders()
    {
        return $this->serviceProviders;
    }
}
class IdentityProviders
{
    private $idpName;
    private $entityID;
    private $loginDetails;
    private $logoutDetails;
    private $signingCertificate;
    private $encryptionCertificate;
    private $signedRequest;
    public function __construct(DOMElement $tW = NULL)
    {
        $this->idpName = '';
        $this->loginDetails = array();
        $this->logoutDetails = array();
        $this->signingCertificate = array();
        $this->encryptionCertificate = array();
        if (!$tW->hasAttribute("\x65\156\x74\x69\164\171\x49\x44")) {
            goto Bi;
        }
        $this->entityID = $tW->getAttribute("\x65\x6e\x74\x69\x74\171\x49\x44");
        Bi:
        if (!$tW->hasAttribute("\x57\x61\156\164\101\165\x74\x68\156\x52\x65\x71\x75\x65\163\x74\163\x53\x69\147\156\x65\x64")) {
            goto MX;
        }
        $this->signedRequest = $tW->getAttribute("\127\x61\156\164\101\165\x74\x68\156\x52\x65\x71\165\x65\x73\164\163\x53\x69\x67\156\145\x64");
        MX:
        $e2 = SAMLSPUtilities::xpQuery($tW, "\56\x2f\x73\x61\x6d\154\x5f\155\145\x74\x61\144\x61\x74\x61\72\x49\x44\x50\123\123\x4f\x44\145\x73\x63\x72\x69\160\164\x6f\x72");
        if (count($e2) > 1) {
            goto J6;
        }
        if (empty($e2)) {
            goto rJ;
        }
        goto cX;
        J6:
        throw new Exception("\x4d\x6f\x72\145\40\164\150\x61\156\40\x6f\x6e\x65\x20\74\x49\x44\x50\123\123\x4f\x44\145\163\143\162\151\160\164\x6f\162\x3e\40\151\156\40\x3c\105\156\164\151\x74\x79\x44\145\x73\143\x72\x69\x70\164\x6f\162\76\x2e");
        goto cX;
        rJ:
        throw new Exception("\115\x69\163\x73\x69\x6e\147\40\162\145\x71\x75\x69\x72\x65\144\x20\74\x49\x44\x50\123\123\117\x44\145\x73\143\162\151\x70\x74\157\x72\x3e\40\x69\156\x20\74\105\156\x74\151\164\x79\x44\x65\x73\143\x72\x69\160\x74\x6f\162\x3e\x2e");
        cX:
        $bq = $e2[0];
        $Ef = SAMLSPUtilities::xpQuery($tW, "\x2e\x2f\163\x61\x6d\x6c\x5f\x6d\145\x74\141\x64\x61\x74\141\72\105\170\x74\145\156\x73\x69\x6f\156\x73");
        if (!$Ef) {
            goto M3;
        }
        $this->parseInfo($bq);
        M3:
        $this->parseSSOService($bq);
        $this->parseSLOService($bq);
        $this->parsex509Certificate($bq);
    }
    private function parseInfo($tW)
    {
        $Kg = SAMLSPUtilities::xpQuery($tW, "\56\57\x6d\x64\x75\x69\x3a\x55\x49\x49\x6e\x66\157\x2f\x6d\144\165\151\x3a\104\151\163\x70\154\141\171\x4e\x61\x6d\x65");
        foreach ($Kg as $Jh) {
            if (!($Jh->hasAttribute("\x78\x6d\x6c\72\x6c\x61\x6e\x67") && $Jh->getAttribute("\x78\155\x6c\72\154\141\x6e\147") == "\x65\x6e")) {
                goto Fk;
            }
            $this->idpName = $Jh->textContent;
            Fk:
            mH:
        }
        f9:
    }
    private function parseSSOService($tW)
    {
        $oX = SAMLSPUtilities::xpQuery($tW, "\56\57\163\x61\155\x6c\x5f\155\145\x74\141\x64\x61\x74\x61\x3a\123\x69\x6e\x67\154\145\x53\x69\147\x6e\x4f\x6e\x53\145\162\166\x69\x63\x65");
        foreach ($oX as $G1) {
            $Qw = str_replace("\165\x72\x6e\72\x6f\141\x73\151\163\x3a\156\141\x6d\145\x73\72\x74\x63\x3a\123\101\115\114\x3a\62\56\x30\x3a\142\x69\x6e\x64\151\156\147\x73\x3a", '', $G1->getAttribute("\x42\x69\x6e\x64\x69\x6e\147"));
            $this->loginDetails = array_merge($this->loginDetails, array($Qw => $G1->getAttribute("\114\x6f\x63\141\x74\151\157\x6e")));
            I5:
        }
        lP:
    }
    private function parseSLOService($tW)
    {
        $Gt = SAMLSPUtilities::xpQuery($tW, "\x2e\x2f\163\141\155\x6c\137\155\145\164\141\144\x61\x74\x61\x3a\x53\x69\x6e\147\x6c\145\114\x6f\x67\157\x75\164\123\145\162\166\x69\143\x65");
        if (!empty($Gt)) {
            goto BU;
        }
        $this->logoutDetails = array("\x48\124\124\x50\55\x52\x65\144\151\x72\145\x63\x74" => '');
        goto XG;
        BU:
        foreach ($Gt as $qV) {
            $Qw = str_replace("\165\162\x6e\x3a\157\x61\x73\151\163\x3a\x6e\141\x6d\x65\163\x3a\x74\143\x3a\x53\101\115\114\72\x32\56\60\72\x62\x69\x6e\x64\151\x6e\x67\163\72", '', $qV->getAttribute("\102\151\156\x64\x69\x6e\147"));
            $this->logoutDetails = array_merge($this->logoutDetails, array($Qw => $qV->getAttribute("\114\157\x63\141\x74\151\157\x6e")));
            uW:
        }
        jZ:
        XG:
    }
    private function parsex509Certificate($tW)
    {
        foreach (SAMLSPUtilities::xpQuery($tW, "\56\x2f\x73\141\155\154\x5f\155\x65\164\141\x64\141\x74\x61\x3a\x4b\145\171\104\x65\163\x63\x72\x69\x70\x74\157\162") as $lc) {
            if ($lc->hasAttribute("\x75\163\145")) {
                goto f3;
            }
            $this->parseSigningCertificate($lc);
            goto Aw;
            f3:
            if ($lc->getAttribute("\x75\163\145") == "\145\x6e\143\162\x79\160\x74\151\157\x6e") {
                goto od;
            }
            $this->parseSigningCertificate($lc);
            goto HE;
            od:
            $this->parseEncryptionCertificate($lc);
            HE:
            Aw:
            rN:
        }
        Mt:
    }
    private function parseSigningCertificate($tW)
    {
        $DP = SAMLSPUtilities::xpQuery($tW, "\x2e\57\144\x73\72\x4b\145\171\111\x6e\x66\157\x2f\144\x73\x3a\130\65\x30\x39\x44\141\x74\x61\57\x64\x73\x3a\x58\x35\x30\71\103\145\162\164\x69\x66\151\143\141\x74\145");
        $Vu = trim($DP[0]->textContent);
        $Vu = str_replace(array("\15", "\xa", "\11", "\x20"), '', $Vu);
        if (empty($DP)) {
            goto yW;
        }
        array_push($this->signingCertificate, SAMLSPUtilities::sanitize_certificate($Vu));
        yW:
    }
    private function parseEncryptionCertificate($tW)
    {
        $DP = SAMLSPUtilities::xpQuery($tW, "\56\x2f\x64\163\x3a\x4b\145\x79\x49\x6e\146\157\x2f\144\x73\72\130\65\60\71\104\141\x74\x61\57\144\x73\72\130\65\x30\71\103\x65\x72\x74\x69\146\x69\143\141\x74\145");
        $Vu = trim($DP[0]->textContent);
        $Vu = str_replace(array("\15", "\xa", "\11", "\x20"), '', $Vu);
        if (empty($DP)) {
            goto Sf;
        }
        array_push($this->encryptionCertificate, $Vu);
        Sf:
    }
    public function getIdpName()
    {
        return $this->idpName;
    }
    public function getEntityID()
    {
        return $this->entityID;
    }
    public function getLoginURL($Qw)
    {
        return $this->loginDetails[$Qw];
    }
    public function getLogoutURL($Qw)
    {
        return $this->logoutDetails[$Qw];
    }
    public function getLoginDetails()
    {
        return $this->loginDetails;
    }
    public function getLogoutDetails()
    {
        return $this->logoutDetails;
    }
    public function getSigningCertificate()
    {
        return $this->signingCertificate;
    }
    public function getEncryptionCertificate()
    {
        return $this->encryptionCertificate[0];
    }
    public function isRequestSigned()
    {
        return $this->signedRequest;
    }
}
class ServiceProviders
{
}
