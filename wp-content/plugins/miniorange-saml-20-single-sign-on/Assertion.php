<?php


include_once "\125\164\151\x6c\x69\164\151\x65\163\x2e\x70\150\160";
include_once "\x78\155\x6c\x73\x65\x63\x6c\151\x62\163\x2e\160\x68\160";
use RobRichards\XMLSecLibs\XMLSecurityKey;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecEnc;
class SAML2SPAssertion
{
    private $id;
    private $issueInstant;
    private $issuer;
    private $nameId;
    private $encryptedNameId;
    private $encryptedAttribute;
    private $encryptionKey;
    private $notBefore;
    private $notOnOrAfter;
    private $validAudiences;
    private $sessionNotOnOrAfter;
    private $sessionIndex;
    private $authnInstant;
    private $authnContextClassRef;
    private $authnContextDecl;
    private $authnContextDeclRef;
    private $AuthenticatingAuthority;
    private $attributes;
    private $nameFormat;
    private $signatureKey;
    private $certificates;
    private $signatureData;
    private $requiredEncAttributes;
    private $SubjectConfirmation;
    private $privateKeyUrl;
    protected $wasSignedAtConstruction = FALSE;
    public function __construct(DOMElement $tW = NULL, $pW)
    {
        $this->id = SAMLSPUtilities::generateId();
        $this->issueInstant = SAMLSPUtilities::generateTimestamp();
        $this->issuer = '';
        $this->authnInstant = SAMLSPUtilities::generateTimestamp();
        $this->attributes = array();
        $this->nameFormat = "\165\162\156\72\157\141\x73\151\163\x3a\x6e\x61\155\x65\163\72\x74\x63\72\123\x41\x4d\x4c\72\61\56\61\72\x6e\x61\155\145\151\144\55\146\x6f\162\x6d\141\x74\72\165\156\163\160\x65\143\x69\146\x69\x65\x64";
        $this->certificates = array();
        $this->AuthenticatingAuthority = array();
        $this->SubjectConfirmation = array();
        if (!($tW === NULL)) {
            goto JW;
        }
        return;
        JW:
        if (!($tW->localName === "\x45\x6e\143\162\171\x70\164\x65\x64\x41\163\x73\x65\x72\x74\151\x6f\x6e")) {
            goto zR;
        }
        $h6 = SAMLSPUtilities::xpQuery($tW, "\56\x2f\170\145\x6e\x63\x3a\105\156\x63\x72\171\x70\x74\145\x64\x44\141\x74\141");
        $UR = SAMLSPUtilities::xpQuery($tW, "\x2f\57\x2a\x5b\154\157\143\x61\154\x2d\156\141\155\145\x28\51\x3d\x27\105\156\143\x72\171\x70\x74\x65\144\x4b\145\171\x27\x5d\57\x2a\x5b\x6c\157\x63\x61\154\x2d\x6e\141\x6d\x65\x28\51\75\47\x45\156\143\162\171\x70\x74\x69\x6f\156\115\145\x74\x68\157\144\x27\x5d\x2f\100\101\x6c\147\157\162\151\x74\150\x6d");
        $Uc = $UR[0]->value;
        $bz = SAMLSPUtilities::getEncryptionAlgorithm($Uc);
        if (count($h6) === 0) {
            goto eB;
        }
        if (count($h6) > 1) {
            goto tE;
        }
        goto cp;
        eB:
        throw new Exception("\115\151\x73\163\x69\x6e\x67\40\145\156\x63\x72\x79\160\164\x65\144\40\x64\x61\164\141\40\x69\156\x20\74\163\141\155\x6c\x3a\x45\156\143\x72\171\160\164\x65\x64\x41\163\163\145\x72\x74\x69\157\156\76\x2e");
        goto cp;
        tE:
        throw new Exception("\115\157\162\x65\40\164\x68\141\156\x20\x6f\x6e\145\40\145\156\x63\162\x79\x70\164\x65\144\40\x64\141\x74\141\x20\145\x6c\x65\155\x65\x6e\164\40\151\156\x20\74\163\x61\x6d\x6c\x3a\x45\156\x63\162\171\160\x74\x65\x64\x41\163\x73\x65\162\164\x69\157\156\x3e\x2e");
        cp:
        $y9 = new XMLSecurityKey($bz, array("\x74\171\160\145" => "\x70\x72\151\x76\141\x74\x65"));
        $y9->loadKey($pW, FALSE);
        $Ls = array();
        $tW = SAMLSPUtilities::decryptElement($h6[0], $y9, $Ls);
        zR:
        if ($tW->hasAttribute("\111\x44")) {
            goto bg;
        }
        throw new Exception("\x4d\151\163\x73\151\x6e\x67\x20\x49\x44\x20\x61\x74\164\162\151\142\x75\x74\145\x20\157\x6e\40\x53\101\115\114\x20\141\x73\163\x65\x72\x74\151\157\x6e\x2e");
        bg:
        $this->id = $tW->getAttribute("\x49\104");
        if (!($tW->getAttribute("\126\145\162\x73\x69\157\156") !== "\x32\56\60")) {
            goto Gi;
        }
        throw new Exception("\x55\x6e\163\165\160\160\157\x72\x74\x65\x64\x20\x76\x65\162\163\151\157\156\72\x20" . $tW->getAttribute("\126\x65\162\163\x69\157\x6e"));
        Gi:
        $this->issueInstant = SAMLSPUtilities::xsDateTimeToTimestamp($tW->getAttribute("\111\x73\x73\165\145\111\156\x73\164\x61\x6e\164"));
        $JV = SAMLSPUtilities::xpQuery($tW, "\x2e\x2f\x73\141\x6d\x6c\x5f\141\163\x73\145\x72\x74\151\157\x6e\72\x49\x73\163\165\x65\162");
        if (!empty($JV)) {
            goto oS;
        }
        throw new Exception("\115\151\x73\x73\151\x6e\x67\40\74\163\141\155\154\x3a\111\x73\163\165\x65\162\x3e\40\x69\156\40\x61\163\163\145\x72\x74\151\157\x6e\x2e");
        oS:
        $this->issuer = trim($JV[0]->textContent);
        $this->parseConditions($tW);
        $this->parseAuthnStatement($tW);
        $this->parseAttributes($tW);
        $this->parseEncryptedAttributes($tW);
        $this->parseSignature($tW);
        $this->parseSubject($tW);
    }
    private function parseSubject(DOMElement $tW)
    {
        $zY = SAMLSPUtilities::xpQuery($tW, "\x2e\57\163\141\155\154\137\141\x73\x73\x65\x72\164\151\x6f\x6e\72\123\x75\142\x6a\x65\143\164");
        if (empty($zY)) {
            goto uQ;
        }
        if (count($zY) > 1) {
            goto HZ;
        }
        goto fV;
        uQ:
        return;
        goto fV;
        HZ:
        throw new Exception("\115\157\162\145\40\164\x68\141\x6e\40\157\156\145\40\74\x73\141\x6d\154\x3a\x53\x75\142\152\145\143\164\x3e\40\x69\x6e\40\74\163\x61\x6d\x6c\x3a\x41\x73\x73\x65\x72\x74\151\x6f\x6e\76\x2e");
        fV:
        $zY = $zY[0];
        $Jw = SAMLSPUtilities::xpQuery($zY, "\x2e\x2f\x73\141\x6d\154\137\141\x73\163\145\x72\x74\x69\x6f\x6e\72\x4e\141\155\145\111\x44\40\x7c\40\x2e\x2f\x73\x61\155\x6c\137\141\163\163\145\162\x74\x69\157\x6e\x3a\105\x6e\x63\162\171\160\164\145\x64\111\104\x2f\170\145\156\143\72\x45\x6e\x63\x72\171\x70\x74\x65\144\104\141\164\141");
        if (empty($Jw)) {
            goto No;
        }
        if (count($Jw) > 1) {
            goto hK;
        }
        goto XX;
        No:
        $sl = $_POST["\x52\145\154\141\171\x53\x74\141\x74\145"];
        if ($sl == "\164\x65\x73\x74\x56\x61\154\151\x64\x61\x74\145" or $sl == "\x74\145\163\164\x4e\x65\167\103\x65\x72\164\x69\146\x69\x63\x61\164\145") {
            goto B7;
        }
        wp_die("\127\x65\40\x63\157\x75\x6c\x64\40\x6e\x6f\x74\40\163\x69\x67\x6e\40\171\x6f\165\x20\151\156\x2e\x20\120\154\x65\x61\x73\145\x20\143\157\156\164\x61\x63\x74\x20\x79\157\165\162\x20\141\144\x6d\x69\156\151\163\x74\x72\141\164\x6f\x72");
        goto Vt;
        B7:
        echo "\74\144\x69\166\x20\x73\164\x79\154\145\75\42\146\157\156\164\55\x66\141\x6d\x69\x6c\x79\x3a\x43\141\154\x69\x62\162\151\x3b\x70\x61\144\144\151\156\147\72\60\40\x33\x25\x3b\42\76";
        echo "\74\144\x69\166\x20\163\x74\171\x6c\x65\x3d\42\x63\x6f\154\157\x72\72\x20\43\141\71\64\x34\x34\x32\73\x62\141\x63\153\x67\x72\x6f\x75\x6e\x64\55\143\x6f\x6c\157\162\x3a\x20\x23\x66\x32\144\145\144\x65\73\x70\141\x64\144\151\x6e\147\x3a\40\x31\65\160\170\x3b\155\x61\162\147\151\156\55\142\x6f\x74\x74\x6f\x6d\72\x20\x32\x30\160\x78\73\164\x65\x78\164\55\141\154\151\147\x6e\72\x63\145\x6e\x74\x65\162\x3b\x62\157\162\x64\x65\x72\x3a\61\x70\170\40\163\x6f\x6c\x69\x64\x20\43\105\66\x42\x33\102\x32\x3b\x66\157\156\164\x2d\x73\x69\172\145\72\61\x38\160\x74\73\x22\x3e\x20\x45\122\x52\x4f\x52\74\x2f\x64\x69\x76\x3e\15\12\40\x20\x20\40\40\x20\x20\x20\40\40\x20\74\x64\151\166\40\163\164\171\154\145\75\x22\143\x6f\154\157\x72\x3a\40\43\141\x39\x34\64\64\x32\73\146\x6f\x6e\164\55\x73\151\x7a\145\72\x31\64\x70\164\73\40\155\141\162\147\x69\156\x2d\x62\x6f\164\164\x6f\155\x3a\62\60\160\x78\73\x22\76\x3c\160\76\x3c\163\x74\x72\157\156\147\x3e\105\x72\162\x6f\162\72\x20\74\57\163\x74\x72\x6f\156\x67\x3e\115\x69\x73\x73\151\x6e\x67\x20\40\x4e\x61\155\145\111\104\40\x6f\x72\40\x45\156\143\x72\x79\160\x74\x65\x64\x49\x44\40\x69\x6e\40\x53\x41\115\114\x20\122\x65\x73\x70\x6f\x6e\163\145\x2e\74\57\x70\x3e\xd\12\x20\x20\x20\40\40\40\40\x20\40\40\40\40\x20\40\40\x20\74\x70\76\120\x6c\x65\x61\x73\x65\40\143\x6f\156\x74\x61\143\x74\x20\171\x6f\x75\162\40\141\x64\155\151\156\x69\163\x74\x72\141\164\157\x72\x20\x61\x6e\x64\40\x72\x65\160\157\162\x74\x20\164\x68\x65\x20\146\157\x6c\154\157\167\151\x6e\x67\x20\145\162\162\x6f\x72\x3a\x3c\57\160\76\xd\xa\x20\x20\40\x20\40\x20\x20\40\40\x20\40\x20\40\40\40\40\x3c\160\x3e\x3c\x73\164\x72\x6f\x6e\147\76\x50\x6f\163\x73\x69\x62\154\145\40\x43\141\165\163\145\x3a\x3c\57\163\164\162\157\156\147\76\x20\x4e\141\155\145\111\104\x20\x6e\x6f\x74\x20\146\157\x75\x6e\x64\40\x69\156\x20\x53\101\115\x4c\40\122\x65\x73\x70\157\156\x73\145\x20\163\165\142\152\145\143\x74\56\74\57\160\x3e\15\xa\x20\40\x20\40\40\x20\x20\x20\x20\x20\x20\x20\x20\x20\40\x20\x3c\57\144\x69\x76\x3e\xd\xa\40\x20\x20\40\40\x20\40\40\40\40\x20\40\40\x20\40\x20\74\x64\x69\x76\x20\163\164\171\x6c\x65\x3d\42\155\x61\x72\x67\151\156\x3a\x33\x25\73\144\x69\163\x70\x6c\x61\x79\x3a\x62\x6c\x6f\x63\x6b\73\x74\145\170\164\55\141\x6c\x69\x67\156\x3a\x63\145\156\164\145\x72\x3b\42\76\15\12\x20\x20\x20\x20\40\x20\x20\40\40\40\x20\40\x20\x20\x20\x20\74\144\151\x76\x20\x73\x74\x79\x6c\x65\x3d\x22\x6d\x61\x72\147\x69\156\72\63\x25\x3b\144\151\163\x70\154\x61\171\72\142\x6c\157\x63\153\x3b\x74\x65\x78\164\55\x61\x6c\151\147\x6e\72\143\x65\x6e\164\145\x72\x3b\42\x3e\74\151\x6e\x70\165\x74\40\163\164\x79\x6c\x65\x3d\42\x70\x61\144\x64\x69\x6e\x67\x3a\61\x25\73\167\x69\144\164\150\x3a\x31\x30\60\x70\170\73\x62\x61\143\153\x67\x72\157\x75\156\x64\x3a\40\x23\60\60\71\61\103\x44\40\x6e\x6f\156\x65\40\x72\x65\x70\x65\141\x74\x20\x73\143\x72\157\x6c\x6c\x20\60\45\x20\60\x25\x3b\143\165\x72\x73\x6f\x72\x3a\40\160\x6f\x69\156\x74\145\162\x3b\146\x6f\x6e\164\x2d\x73\151\x7a\145\72\x31\x35\160\x78\x3b\x62\x6f\162\144\x65\x72\x2d\x77\151\x64\x74\x68\72\x20\x31\160\x78\73\x62\x6f\x72\x64\x65\162\55\x73\x74\171\x6c\145\x3a\40\163\x6f\154\x69\x64\73\142\x6f\x72\x64\x65\x72\x2d\162\141\x64\151\x75\x73\72\40\63\160\x78\73\167\150\x69\x74\145\x2d\x73\160\141\143\x65\x3a\x20\x6e\157\167\x72\x61\160\x3b\x62\x6f\170\x2d\163\151\172\151\156\x67\72\40\142\157\162\144\x65\x72\55\x62\x6f\x78\73\142\157\162\144\145\x72\x2d\143\157\154\x6f\162\x3a\40\x23\60\x30\x37\63\101\x41\73\142\x6f\170\x2d\x73\150\x61\x64\x6f\167\x3a\40\x30\x70\x78\40\61\160\x78\40\60\x70\170\40\x72\147\142\x61\50\x31\62\60\x2c\40\62\x30\x30\54\x20\x32\x33\60\x2c\x20\x30\x2e\66\x29\x20\151\x6e\x73\x65\x74\73\143\157\154\157\x72\x3a\40\x23\106\x46\x46\73\x22\x74\x79\160\x65\75\42\142\165\164\164\x6f\156\x22\x20\166\141\154\x75\x65\x3d\x22\104\x6f\156\145\42\40\x6f\x6e\103\x6c\x69\143\153\x3d\x22\163\x65\154\146\56\143\154\157\163\x65\50\51\73\42\76\x3c\x2f\x64\151\x76\76";
        exit;
        Vt:
        goto XX;
        hK:
        throw new Exception("\115\x6f\162\x65\40\164\150\141\x6e\40\x6f\156\x65\x20\x3c\x73\141\155\x6c\72\116\x61\x6d\145\111\x44\76\x20\157\162\40\74\163\x61\155\x6c\72\x45\x6e\143\162\x79\x70\x74\x65\x64\104\x3e\x20\151\156\40\74\x73\141\x6d\x6c\x3a\x53\165\x62\152\x65\143\x74\76\56");
        XX:
        $Jw = $Jw[0];
        if ($Jw->localName === "\x45\x6e\143\162\171\160\x74\x65\x64\x44\x61\164\x61") {
            goto L6;
        }
        $this->nameId = SAMLSPUtilities::parseNameId($Jw);
        goto j3;
        L6:
        $this->encryptedNameId = $Jw;
        j3:
    }
    private function parseConditions(DOMElement $tW)
    {
        $ru = SAMLSPUtilities::xpQuery($tW, "\x2e\57\x73\x61\155\154\137\141\163\x73\145\162\x74\x69\157\x6e\72\x43\x6f\x6e\x64\x69\x74\151\x6f\x6e\163");
        if (empty($ru)) {
            goto Tv;
        }
        if (count($ru) > 1) {
            goto gc;
        }
        goto Wd;
        Tv:
        return;
        goto Wd;
        gc:
        throw new Exception("\115\x6f\x72\x65\x20\164\150\141\156\x20\x6f\156\x65\x20\x3c\163\141\155\154\x3a\103\157\x6e\x64\x69\x74\151\x6f\x6e\163\x3e\x20\151\x6e\x20\x3c\x73\x61\155\x6c\x3a\101\163\x73\145\162\x74\151\x6f\156\x3e\56");
        Wd:
        $ru = $ru[0];
        if (!$ru->hasAttribute("\x4e\157\164\x42\x65\x66\x6f\x72\x65")) {
            goto IE;
        }
        $O1 = SAMLSPUtilities::xsDateTimeToTimestamp($ru->getAttribute("\116\x6f\164\x42\x65\146\x6f\162\x65"));
        if (!($this->notBefore === NULL || $this->notBefore < $O1)) {
            goto ey;
        }
        $this->notBefore = $O1;
        ey:
        IE:
        if (!$ru->hasAttribute("\116\x6f\x74\117\x6e\117\x72\101\146\164\145\x72")) {
            goto JJ;
        }
        $fg = SAMLSPUtilities::xsDateTimeToTimestamp($ru->getAttribute("\116\x6f\x74\x4f\x6e\117\162\101\146\164\145\x72"));
        if (!($this->notOnOrAfter === NULL || $this->notOnOrAfter > $fg)) {
            goto T4;
        }
        $this->notOnOrAfter = $fg;
        T4:
        JJ:
        $y5 = $ru->firstChild;
        tm:
        if (!($y5 !== NULL)) {
            goto ev;
        }
        if (!$y5 instanceof DOMText) {
            goto UK;
        }
        goto jJ;
        UK:
        if (!($y5->namespaceURI !== "\165\162\156\72\x6f\141\x73\151\163\72\x6e\x61\x6d\x65\163\x3a\164\143\72\x53\x41\x4d\x4c\72\62\x2e\60\72\x61\x73\163\145\162\164\151\x6f\156")) {
            goto uI;
        }
        throw new Exception("\125\x6e\153\156\157\x77\156\x20\156\141\x6d\145\163\160\x61\x63\145\40\157\x66\x20\x63\x6f\156\144\x69\x74\x69\157\x6e\72\x20" . var_export($y5->namespaceURI, TRUE));
        uI:
        switch ($y5->localName) {
            case "\101\165\x64\151\145\156\x63\x65\122\x65\x73\x74\x72\x69\x63\x74\151\x6f\156":
                $hh = SAMLSPUtilities::extractStrings($y5, "\x75\x72\x6e\x3a\157\141\163\151\163\72\156\x61\x6d\145\x73\72\164\x63\72\123\x41\x4d\x4c\x3a\62\x2e\60\72\x61\x73\163\x65\x72\x74\x69\157\156", "\x41\165\x64\x69\x65\156\x63\x65");
                if ($this->validAudiences === NULL) {
                    goto rA;
                }
                $this->validAudiences = array_intersect($this->validAudiences, $hh);
                goto dZ;
                rA:
                $this->validAudiences = $hh;
                dZ:
                goto P6;
            case "\x4f\x6e\145\124\151\155\145\125\163\145":
                goto P6;
            case "\x50\162\x6f\170\x79\122\x65\x73\164\x72\x69\143\164\151\x6f\x6e":
                goto P6;
            default:
                throw new Exception("\125\x6e\x6b\x6e\x6f\x77\156\x20\143\x6f\x6e\x64\x69\x74\x69\157\156\72\x20" . var_export($y5->localName, TRUE));
        }
        XC:
        P6:
        jJ:
        $y5 = $y5->nextSibling;
        goto tm;
        ev:
    }
    private function parseAuthnStatement(DOMElement $tW)
    {
        $wC = SAMLSPUtilities::xpQuery($tW, "\56\x2f\163\x61\x6d\x6c\x5f\141\x73\x73\x65\162\164\151\157\156\72\101\x75\x74\150\156\x53\164\x61\164\145\155\x65\x6e\164");
        if (empty($wC)) {
            goto zG;
        }
        if (count($wC) > 1) {
            goto QV;
        }
        goto nJ;
        zG:
        $this->authnInstant = NULL;
        return;
        goto nJ;
        QV:
        throw new Exception("\115\x6f\x72\x65\40\x74\150\141\164\40\x6f\x6e\x65\x20\74\163\x61\x6d\x6c\x3a\x41\x75\x74\x68\x6e\x53\164\x61\x74\x65\x6d\x65\156\x74\76\x20\x69\156\x20\x3c\x73\141\155\x6c\72\101\163\x73\145\162\164\x69\157\156\76\x20\156\x6f\x74\40\163\165\160\x70\x6f\x72\164\x65\x64\x2e");
        nJ:
        $vQ = $wC[0];
        if ($vQ->hasAttribute("\x41\x75\164\x68\156\111\156\163\x74\x61\x6e\x74")) {
            goto UD;
        }
        throw new Exception("\x4d\x69\163\163\x69\156\x67\40\162\145\161\165\151\x72\x65\144\x20\101\x75\x74\150\x6e\111\x6e\163\164\141\x6e\x74\x20\x61\164\164\x72\x69\x62\x75\x74\145\x20\x6f\x6e\x20\x3c\x73\141\155\154\72\x41\x75\x74\150\156\x53\164\141\164\145\x6d\x65\x6e\164\76\56");
        UD:
        $this->authnInstant = SAMLSPUtilities::xsDateTimeToTimestamp($vQ->getAttribute("\101\x75\x74\x68\156\x49\156\x73\x74\x61\x6e\x74"));
        if (!$vQ->hasAttribute("\123\x65\x73\x73\151\157\x6e\116\x6f\x74\x4f\156\117\x72\x41\146\164\145\162")) {
            goto y6;
        }
        $this->sessionNotOnOrAfter = SAMLSPUtilities::xsDateTimeToTimestamp($vQ->getAttribute("\x53\x65\163\x73\x69\x6f\156\116\x6f\x74\x4f\x6e\117\162\x41\x66\164\145\x72"));
        y6:
        if (!$vQ->hasAttribute("\x53\x65\163\163\151\157\x6e\111\156\144\145\170")) {
            goto ls;
        }
        $this->sessionIndex = $vQ->getAttribute("\x53\145\x73\x73\x69\x6f\156\x49\x6e\144\x65\170");
        ls:
        $this->parseAuthnContext($vQ);
    }
    private function parseAuthnContext(DOMElement $Dr)
    {
        $SE = SAMLSPUtilities::xpQuery($Dr, "\56\57\163\x61\155\154\x5f\x61\x73\163\145\162\164\151\x6f\156\x3a\101\165\x74\x68\x6e\x43\x6f\x6e\x74\x65\170\164");
        if (count($SE) > 1) {
            goto lw;
        }
        if (empty($SE)) {
            goto CW;
        }
        goto qg;
        lw:
        throw new Exception("\115\x6f\x72\145\x20\x74\x68\141\156\x20\x6f\x6e\x65\x20\74\163\141\x6d\154\x3a\101\x75\x74\x68\156\x43\157\156\164\145\x78\x74\76\x20\151\x6e\x20\x3c\x73\141\x6d\154\x3a\x41\x75\164\150\x6e\123\164\x61\164\145\155\145\x6e\164\x3e\x2e");
        goto qg;
        CW:
        throw new Exception("\x4d\x69\x73\x73\x69\x6e\147\40\162\x65\x71\x75\151\x72\145\x64\x20\x3c\x73\x61\155\x6c\72\101\165\x74\150\156\x43\x6f\x6e\164\145\x78\164\76\x20\x69\x6e\x20\74\163\141\x6d\x6c\x3a\101\165\164\150\x6e\123\164\x61\164\x65\x6d\145\x6e\164\76\56");
        qg:
        $iX = $SE[0];
        $LR = SAMLSPUtilities::xpQuery($iX, "\56\57\x73\141\155\154\x5f\141\163\x73\145\x72\x74\151\157\x6e\72\x41\x75\x74\150\156\x43\x6f\156\164\145\170\x74\x44\x65\x63\154\x52\145\146");
        if (count($LR) > 1) {
            goto n7;
        }
        if (count($LR) === 1) {
            goto Zh;
        }
        goto Fe;
        n7:
        throw new Exception("\x4d\157\162\145\40\164\x68\x61\156\40\157\x6e\x65\40\x3c\x73\141\155\154\72\x41\x75\164\150\x6e\x43\x6f\156\x74\x65\x78\164\104\145\x63\154\122\145\146\76\x20\146\x6f\x75\156\144\x3f");
        goto Fe;
        Zh:
        $this->setAuthnContextDeclRef(trim($LR[0]->textContent));
        Fe:
        $RA = SAMLSPUtilities::xpQuery($iX, "\56\57\163\x61\x6d\x6c\x5f\x61\x73\x73\x65\162\164\151\x6f\156\x3a\x41\x75\x74\x68\156\103\x6f\x6e\164\145\170\164\x44\145\x63\154");
        if (count($RA) > 1) {
            goto dY;
        }
        if (count($RA) === 1) {
            goto qr;
        }
        goto gG;
        dY:
        throw new Exception("\115\157\x72\x65\40\164\x68\x61\156\x20\157\156\x65\40\x3c\x73\x61\x6d\154\x3a\101\165\164\x68\x6e\103\x6f\156\x74\x65\170\x74\104\145\x63\x6c\76\x20\146\x6f\x75\156\x64\x3f");
        goto gG;
        qr:
        $this->setAuthnContextDecl(new SAML2_XML_Chunk($RA[0]));
        gG:
        $qK = SAMLSPUtilities::xpQuery($iX, "\56\x2f\163\x61\x6d\x6c\137\x61\163\163\145\x72\x74\151\x6f\156\72\101\165\x74\150\156\x43\157\156\x74\x65\x78\164\x43\154\x61\163\x73\x52\145\146");
        if (count($qK) > 1) {
            goto HX;
        }
        if (count($qK) === 1) {
            goto hF;
        }
        goto Hz;
        HX:
        throw new Exception("\115\157\x72\x65\40\164\x68\141\x6e\40\157\156\145\x20\x3c\x73\141\155\154\x3a\x41\x75\x74\150\156\x43\x6f\156\164\x65\170\x74\x43\x6c\x61\x73\x73\x52\145\146\x3e\x20\151\156\x20\74\163\x61\155\154\72\x41\165\x74\x68\156\x43\x6f\x6e\x74\145\170\x74\x3e\x2e");
        goto Hz;
        hF:
        $this->setAuthnContextClassRef(trim($qK[0]->textContent));
        Hz:
        if (!(empty($this->authnContextClassRef) && empty($this->authnContextDecl) && empty($this->authnContextDeclRef))) {
            goto zv;
        }
        throw new Exception("\115\151\x73\x73\151\156\x67\40\145\x69\x74\150\x65\162\x20\74\x73\141\x6d\154\x3a\x41\x75\164\x68\156\x43\157\156\x74\x65\x78\164\103\154\x61\163\163\x52\x65\146\76\x20\x6f\162\x20\x3c\x73\141\x6d\x6c\72\x41\165\164\x68\x6e\x43\x6f\156\164\x65\170\164\104\x65\x63\154\x52\x65\146\76\x20\157\162\x20\74\163\x61\x6d\154\72\101\x75\x74\150\156\103\157\156\164\145\x78\164\104\x65\143\x6c\x3e");
        zv:
        $this->AuthenticatingAuthority = SAMLSPUtilities::extractStrings($iX, "\165\162\156\x3a\157\141\163\x69\x73\x3a\x6e\141\155\145\163\x3a\x74\x63\72\x53\x41\x4d\x4c\72\62\x2e\60\x3a\x61\x73\x73\145\x72\x74\x69\x6f\156", "\101\165\164\x68\x65\156\x74\151\x63\x61\164\151\x6e\x67\101\x75\x74\150\157\162\x69\x74\171");
    }
    private function parseAttributes(DOMElement $tW)
    {
        $Qt = TRUE;
        $Tr = SAMLSPUtilities::xpQuery($tW, "\x2e\x2f\x73\x61\x6d\x6c\137\141\163\x73\x65\x72\164\x69\157\156\72\101\164\164\x72\x69\x62\x75\x74\x65\x53\164\141\x74\x65\x6d\x65\156\164\57\x73\141\x6d\154\x5f\141\163\163\x65\x72\x74\x69\157\x6e\72\101\164\x74\162\x69\x62\x75\x74\145");
        foreach ($Tr as $md) {
            if ($md->hasAttribute("\116\x61\x6d\x65")) {
                goto pA;
            }
            throw new Exception("\115\x69\x73\x73\151\x6e\x67\40\x6e\x61\x6d\145\40\157\x6e\x20\74\x73\141\x6d\x6c\x3a\x41\x74\164\162\x69\x62\165\164\x65\76\x20\145\154\145\155\x65\x6e\164\56");
            pA:
            $Jh = $md->getAttribute("\116\x61\x6d\x65");
            if ($md->hasAttribute("\116\141\155\145\x46\x6f\162\x6d\141\x74")) {
                goto Go;
            }
            $zF = "\x75\162\x6e\72\x6f\x61\163\x69\163\72\156\x61\155\x65\x73\72\164\143\72\x53\101\115\x4c\x3a\x31\x2e\61\x3a\x6e\x61\155\x65\x69\x64\x2d\x66\157\x72\x6d\141\164\72\x75\x6e\x73\x70\x65\143\x69\x66\151\x65\144";
            goto fu;
            Go:
            $zF = $md->getAttribute("\x4e\x61\x6d\145\x46\157\162\x6d\x61\164");
            fu:
            if ($Qt) {
                goto L0;
            }
            if (!($this->nameFormat !== $zF)) {
                goto EF;
            }
            $this->nameFormat = "\165\162\x6e\x3a\157\x61\x73\151\x73\x3a\156\x61\x6d\145\x73\72\164\143\72\123\x41\115\114\72\x31\56\61\x3a\156\141\155\145\x69\144\55\146\157\x72\x6d\x61\x74\x3a\x75\x6e\x73\x70\x65\x63\x69\x66\x69\x65\144";
            EF:
            goto fY;
            L0:
            $this->nameFormat = $zF;
            $Qt = FALSE;
            fY:
            if (array_key_exists($Jh, $this->attributes)) {
                goto OK;
            }
            $this->attributes[$Jh] = array();
            OK:
            $JZ = SAMLSPUtilities::xpQuery($md, "\x2e\x2f\x73\x61\155\x6c\x5f\141\x73\x73\145\x72\x74\151\x6f\x6e\x3a\101\x74\164\162\x69\x62\x75\164\x65\x56\x61\x6c\x75\x65");
            foreach ($JZ as $nj) {
                $this->attributes[$Jh][] = trim($nj->textContent);
                vJ:
            }
            dJ:
            N2:
        }
        Xk:
    }
    private function parseEncryptedAttributes(DOMElement $tW)
    {
        $this->encryptedAttribute = SAMLSPUtilities::xpQuery($tW, "\x2e\57\x73\x61\155\x6c\137\x61\x73\163\x65\x72\164\151\x6f\156\72\x41\x74\164\x72\151\x62\x75\164\x65\123\164\x61\x74\145\x6d\145\x6e\x74\57\x73\141\155\154\x5f\x61\163\163\x65\x72\x74\151\x6f\156\x3a\105\x6e\x63\x72\x79\160\x74\x65\x64\x41\x74\x74\162\x69\142\165\x74\145");
    }
    private function parseSignature(DOMElement $tW)
    {
        $la = SAMLSPUtilities::validateElement($tW);
        if (!($la !== FALSE)) {
            goto Jn;
        }
        $this->wasSignedAtConstruction = TRUE;
        $this->certificates = $la["\103\145\x72\x74\151\146\151\x63\x61\x74\145\163"];
        $this->signatureData = $la;
        Jn:
    }
    public function validate(XMLSecurityKey $y9)
    {
        if (!($this->signatureData === NULL)) {
            goto wz;
        }
        return FALSE;
        wz:
        SAMLSPUtilities::validateSignature($this->signatureData, $y9);
        return TRUE;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($yT)
    {
        $this->id = $yT;
    }
    public function getIssueInstant()
    {
        return $this->issueInstant;
    }
    public function setIssueInstant($j3)
    {
        $this->issueInstant = $j3;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($JV)
    {
        $this->issuer = $JV;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto PQ;
        }
        throw new Exception("\x41\164\164\145\155\x70\164\145\144\40\x74\x6f\40\x72\x65\x74\162\x69\145\166\x65\40\145\x6e\143\x72\171\160\x74\x65\144\40\x4e\141\155\x65\x49\x44\40\167\x69\x74\150\x6f\x75\164\x20\144\x65\x63\162\171\x70\164\x69\156\147\40\151\x74\40\x66\x69\162\x73\x74\56");
        PQ:
        return $this->nameId;
    }
    public function setNameId($Jw)
    {
        $this->nameId = $Jw;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto bE;
        }
        return TRUE;
        bE:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $y9)
    {
        $ra = new DOMDocument();
        $Tk = $ra->createElement("\162\x6f\157\x74");
        $ra->appendChild($Tk);
        SAMLSPUtilities::addNameId($Tk, $this->nameId);
        $Jw = $Tk->firstChild;
        SAMLSPUtilities::getContainer()->debugMessage($Jw, "\x65\156\x63\x72\x79\x70\164");
        $xz = new XMLSecEnc();
        $xz->setNode($Jw);
        $xz->type = XMLSecEnc::Element;
        $HA = new XMLSecurityKey(XMLSecurityKey::AES128_CBC);
        $HA->generateSessionKey();
        $xz->encryptKey($y9, $HA);
        $this->encryptedNameId = $xz->encryptNode($HA);
        $this->nameId = NULL;
    }
    public function decryptNameId(XMLSecurityKey $y9, array $Ls = array())
    {
        if (!($this->encryptedNameId === NULL)) {
            goto ra;
        }
        return;
        ra:
        $Jw = SAMLSPUtilities::decryptElement($this->encryptedNameId, $y9, $Ls);
        SAMLSPUtilities::getContainer()->debugMessage($Jw, "\x64\145\x63\x72\x79\160\x74");
        $this->nameId = SAMLSPUtilities::parseNameId($Jw);
        $this->encryptedNameId = NULL;
    }
    public function decryptAttributes(XMLSecurityKey $y9, array $Ls = array())
    {
        if (!($this->encryptedAttribute === NULL)) {
            goto Sz;
        }
        return;
        Sz:
        $Qt = TRUE;
        $Tr = $this->encryptedAttribute;
        foreach ($Tr as $Gn) {
            $md = SAMLSPUtilities::decryptElement($Gn->getElementsByTagName("\105\x6e\x63\162\171\160\164\145\x64\104\x61\x74\141")->item(0), $y9, $Ls);
            if ($md->hasAttribute("\x4e\x61\155\145")) {
                goto fX;
            }
            throw new Exception("\115\x69\x73\x73\x69\156\147\x20\x6e\141\x6d\x65\40\157\x6e\x20\74\x73\141\155\154\72\x41\x74\164\x72\x69\x62\x75\x74\145\76\40\145\154\145\x6d\145\x6e\x74\x2e");
            fX:
            $Jh = $md->getAttribute("\x4e\141\155\145");
            if ($md->hasAttribute("\x4e\141\x6d\145\x46\157\x72\155\141\164")) {
                goto pD;
            }
            $zF = "\165\162\x6e\72\x6f\x61\163\x69\163\x3a\x6e\141\155\x65\x73\72\x74\143\x3a\x53\101\x4d\114\72\x32\x2e\60\72\141\x74\164\162\156\141\155\145\55\x66\157\x72\155\141\164\72\x75\156\x73\160\x65\x63\151\x66\x69\x65\x64";
            goto C7;
            pD:
            $zF = $md->getAttribute("\116\141\155\145\106\x6f\x72\x6d\141\x74");
            C7:
            if ($Qt) {
                goto Ss;
            }
            if (!($this->nameFormat !== $zF)) {
                goto gU;
            }
            $this->nameFormat = "\x75\x72\x6e\x3a\x6f\141\163\x69\163\72\156\141\155\x65\x73\x3a\164\x63\x3a\123\101\x4d\114\x3a\x32\x2e\x30\72\x61\164\x74\162\x6e\x61\x6d\145\55\x66\x6f\x72\155\141\164\x3a\x75\156\x73\x70\x65\143\151\x66\151\x65\x64";
            gU:
            goto cD;
            Ss:
            $this->nameFormat = $zF;
            $Qt = FALSE;
            cD:
            if (array_key_exists($Jh, $this->attributes)) {
                goto in;
            }
            $this->attributes[$Jh] = array();
            in:
            $JZ = SAMLSPUtilities::xpQuery($md, "\56\57\163\x61\x6d\x6c\x5f\141\163\x73\145\x72\x74\151\x6f\156\72\x41\164\164\x72\x69\x62\165\164\145\126\141\154\165\145");
            foreach ($JZ as $nj) {
                $this->attributes[$Jh][] = trim($nj->textContent);
                jC:
            }
            DW:
            qK:
        }
        dj:
    }
    public function getNotBefore()
    {
        return $this->notBefore;
    }
    public function setNotBefore($O1)
    {
        $this->notBefore = $O1;
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($fg)
    {
        $this->notOnOrAfter = $fg;
    }
    public function setEncryptedAttributes($pr)
    {
        $this->requiredEncAttributes = $pr;
    }
    public function getValidAudiences()
    {
        return $this->validAudiences;
    }
    public function setValidAudiences(array $cC = NULL)
    {
        $this->validAudiences = $cC;
    }
    public function getAuthnInstant()
    {
        return $this->authnInstant;
    }
    public function setAuthnInstant($jJ)
    {
        $this->authnInstant = $jJ;
    }
    public function getSessionNotOnOrAfter()
    {
        return $this->sessionNotOnOrAfter;
    }
    public function setSessionNotOnOrAfter($i5)
    {
        $this->sessionNotOnOrAfter = $i5;
    }
    public function getSessionIndex()
    {
        return $this->sessionIndex;
    }
    public function setSessionIndex($rB)
    {
        $this->sessionIndex = $rB;
    }
    public function getAuthnContext()
    {
        if (empty($this->authnContextClassRef)) {
            goto Up;
        }
        return $this->authnContextClassRef;
        Up:
        if (empty($this->authnContextDeclRef)) {
            goto xU;
        }
        return $this->authnContextDeclRef;
        xU:
        return NULL;
    }
    public function setAuthnContext($D_)
    {
        $this->setAuthnContextClassRef($D_);
    }
    public function getAuthnContextClassRef()
    {
        return $this->authnContextClassRef;
    }
    public function setAuthnContextClassRef($yG)
    {
        $this->authnContextClassRef = $yG;
    }
    public function setAuthnContextDecl(SAML2_XML_Chunk $bu)
    {
        if (empty($this->authnContextDeclRef)) {
            goto Zq;
        }
        throw new Exception("\x41\x75\x74\x68\x6e\103\x6f\156\164\145\170\x74\x44\145\x63\x6c\x52\145\146\40\x69\163\x20\141\x6c\162\x65\141\x64\171\x20\x72\x65\x67\151\x73\164\145\x72\x65\144\41\40\115\141\171\x20\x6f\156\x6c\171\x20\x68\x61\x76\x65\x20\x65\151\164\x68\145\162\40\x61\x20\104\145\x63\154\40\157\162\x20\141\x20\104\145\x63\x6c\122\145\x66\x2c\x20\156\157\164\40\x62\157\x74\150\x21");
        Zq:
        $this->authnContextDecl = $bu;
    }
    public function getAuthnContextDecl()
    {
        return $this->authnContextDecl;
    }
    public function setAuthnContextDeclRef($CP)
    {
        if (empty($this->authnContextDecl)) {
            goto k8;
        }
        throw new Exception("\101\x75\x74\150\156\x43\x6f\x6e\x74\145\170\x74\x44\x65\143\x6c\40\x69\163\40\x61\x6c\x72\x65\141\144\x79\40\162\x65\147\151\x73\164\145\162\x65\144\x21\x20\x4d\141\x79\40\x6f\x6e\154\x79\40\x68\141\x76\x65\x20\145\x69\x74\150\145\x72\40\x61\40\x44\145\143\154\x20\157\x72\x20\141\40\104\145\x63\x6c\x52\145\146\54\x20\156\x6f\x74\40\x62\157\x74\x68\x21");
        k8:
        $this->authnContextDeclRef = $CP;
    }
    public function getAuthnContextDeclRef()
    {
        return $this->authnContextDeclRef;
    }
    public function getAuthenticatingAuthority()
    {
        return $this->AuthenticatingAuthority;
    }
    public function setAuthenticatingAuthority($TT)
    {
        $this->AuthenticatingAuthority = $TT;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }
    public function setAttributes(array $Tr)
    {
        $this->attributes = $Tr;
    }
    public function getAttributeNameFormat()
    {
        return $this->nameFormat;
    }
    public function setAttributeNameFormat($zF)
    {
        $this->nameFormat = $zF;
    }
    public function getSubjectConfirmation()
    {
        return $this->SubjectConfirmation;
    }
    public function setSubjectConfirmation(array $Ig)
    {
        $this->SubjectConfirmation = $Ig;
    }
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }
    public function setSignatureKey(XMLsecurityKey $g7 = NULL)
    {
        $this->signatureKey = $g7;
    }
    public function getEncryptionKey()
    {
        return $this->encryptionKey;
    }
    public function setEncryptionKey(XMLSecurityKey $IX = NULL)
    {
        $this->encryptionKey = $IX;
    }
    public function setCertificates(array $Pa)
    {
        $this->certificates = $Pa;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
    public function getWasSignedAtConstruction()
    {
        return $this->wasSignedAtConstruction;
    }
    public function toXML(DOMNode $lq = NULL)
    {
        if ($lq === NULL) {
            goto vP;
        }
        $Jl = $lq->ownerDocument;
        goto c7;
        vP:
        $Jl = new DOMDocument();
        $lq = $Jl;
        c7:
        $Tk = $Jl->createElementNS("\x75\x72\156\x3a\157\141\163\151\x73\72\156\141\155\x65\x73\72\x74\143\x3a\x53\101\x4d\114\72\62\56\60\x3a\141\163\163\x65\162\164\x69\x6f\x6e", "\x73\x61\x6d\x6c\x3a" . "\101\163\163\x65\162\x74\151\157\156");
        $lq->appendChild($Tk);
        $Tk->setAttributeNS("\165\162\x6e\x3a\x6f\141\163\151\163\x3a\x6e\141\x6d\x65\x73\72\x74\x63\x3a\123\x41\x4d\114\72\62\x2e\60\x3a\160\162\157\x74\x6f\143\x6f\x6c", "\x73\141\155\x6c\160\x3a\x74\x6d\x70", "\164\155\160");
        $Tk->removeAttributeNS("\165\x72\x6e\72\x6f\141\x73\x69\163\72\156\141\155\145\163\x3a\164\x63\x3a\123\101\115\x4c\72\62\56\60\72\160\162\157\164\x6f\x63\x6f\x6c", "\x74\x6d\x70");
        $Tk->setAttributeNS("\150\164\164\160\x3a\x2f\x2f\167\167\167\56\167\63\x2e\x6f\162\x67\57\x32\60\x30\x31\x2f\x58\115\114\123\143\150\145\x6d\x61\55\151\156\x73\164\141\156\143\145", "\170\163\x69\x3a\x74\x6d\x70", "\164\155\x70");
        $Tk->removeAttributeNS("\150\164\x74\160\72\57\57\x77\167\167\56\x77\x33\56\x6f\x72\x67\57\62\x30\60\x31\57\x58\115\x4c\x53\143\x68\145\155\141\x2d\x69\156\163\164\141\156\x63\x65", "\x74\155\x70");
        $Tk->setAttributeNS("\x68\164\164\x70\72\x2f\57\x77\x77\x77\x2e\167\63\x2e\x6f\x72\147\x2f\x32\x30\60\x31\57\x58\115\x4c\123\x63\150\x65\155\141", "\170\163\x3a\x74\x6d\160", "\164\155\x70");
        $Tk->removeAttributeNS("\150\x74\164\160\x3a\x2f\x2f\x77\167\167\56\x77\x33\x2e\157\x72\x67\x2f\x32\x30\60\x31\57\130\115\x4c\x53\x63\x68\x65\x6d\141", "\x74\155\x70");
        $Tk->setAttribute("\x49\x44", $this->id);
        $Tk->setAttribute("\126\145\x72\x73\x69\x6f\x6e", "\x32\56\60");
        $Tk->setAttribute("\111\x73\163\165\145\111\x6e\x73\164\141\156\x74", gmdate("\131\55\155\x2d\x64\x5c\x54\x48\x3a\151\x3a\x73\134\x5a", $this->issueInstant));
        $JV = SAMLSPUtilities::addString($Tk, "\x75\x72\156\72\157\141\163\151\x73\x3a\x6e\x61\155\x65\163\x3a\164\x63\x3a\x53\101\x4d\x4c\x3a\x32\x2e\60\72\x61\163\163\x65\x72\x74\151\x6f\156", "\163\x61\x6d\154\x3a\x49\163\x73\x75\x65\162", $this->issuer);
        $this->addSubject($Tk);
        $this->addConditions($Tk);
        $this->addAuthnStatement($Tk);
        if ($this->requiredEncAttributes == FALSE) {
            goto O1;
        }
        $this->addEncryptedAttributeStatement($Tk);
        goto U1;
        O1:
        $this->addAttributeStatement($Tk);
        U1:
        if (!($this->signatureKey !== NULL)) {
            goto LO;
        }
        SAMLSPUtilities::insertSignature($this->signatureKey, $this->certificates, $Tk, $JV->nextSibling);
        LO:
        return $Tk;
    }
    private function addSubject(DOMElement $Tk)
    {
        if (!($this->nameId === NULL && $this->encryptedNameId === NULL)) {
            goto zS;
        }
        return;
        zS:
        $zY = $Tk->ownerDocument->createElementNS("\x75\162\x6e\x3a\x6f\141\x73\151\x73\72\156\141\155\x65\163\72\164\x63\72\123\101\115\x4c\x3a\62\x2e\60\72\x61\x73\x73\x65\x72\164\x69\157\x6e", "\x73\141\155\x6c\x3a\123\165\x62\x6a\x65\143\x74");
        $Tk->appendChild($zY);
        if ($this->encryptedNameId === NULL) {
            goto vr;
        }
        $Qk = $zY->ownerDocument->createElementNS("\x75\162\156\x3a\157\x61\x73\151\163\72\156\141\x6d\145\163\x3a\164\x63\x3a\x53\x41\115\x4c\72\x32\56\60\72\x61\x73\x73\145\162\164\151\157\x6e", "\163\x61\x6d\x6c\x3a" . "\105\156\x63\162\171\160\164\145\x64\x49\104");
        $zY->appendChild($Qk);
        $Qk->appendChild($zY->ownerDocument->importNode($this->encryptedNameId, TRUE));
        goto Wf;
        vr:
        SAMLSPUtilities::addNameId($zY, $this->nameId);
        Wf:
        foreach ($this->SubjectConfirmation as $dN) {
            $dN->toXML($zY);
            aG:
        }
        Fc:
    }
    private function addConditions(DOMElement $Tk)
    {
        $Jl = $Tk->ownerDocument;
        $ru = $Jl->createElementNS("\165\162\156\x3a\157\x61\163\151\x73\x3a\x6e\141\155\x65\x73\72\x74\143\x3a\123\x41\115\114\72\x32\56\x30\x3a\x61\163\163\x65\x72\x74\x69\x6f\x6e", "\163\141\x6d\154\72\103\x6f\156\x64\151\x74\151\157\156\x73");
        $Tk->appendChild($ru);
        if (!($this->notBefore !== NULL)) {
            goto Z3;
        }
        $ru->setAttribute("\116\x6f\164\x42\145\146\157\162\x65", gmdate("\131\x2d\x6d\x2d\144\134\x54\110\72\151\x3a\163\134\x5a", $this->notBefore));
        Z3:
        if (!($this->notOnOrAfter !== NULL)) {
            goto f1;
        }
        $ru->setAttribute("\x4e\157\164\x4f\156\117\x72\x41\146\164\x65\x72", gmdate("\131\55\155\x2d\x64\x5c\x54\x48\x3a\151\x3a\x73\134\132", $this->notOnOrAfter));
        f1:
        if (!($this->validAudiences !== NULL)) {
            goto Ms;
        }
        $f7 = $Jl->createElementNS("\165\162\x6e\x3a\157\x61\x73\151\163\72\x6e\141\x6d\x65\x73\x3a\164\x63\72\x53\101\x4d\x4c\72\x32\x2e\x30\72\141\163\163\x65\x72\x74\151\x6f\156", "\x73\141\x6d\x6c\72\101\165\x64\151\145\156\143\145\x52\145\163\164\162\151\x63\164\151\x6f\156");
        $ru->appendChild($f7);
        SAMLSPUtilities::addStrings($f7, "\x75\x72\156\72\157\141\163\x69\163\72\156\141\x6d\x65\163\72\164\x63\72\123\101\x4d\114\72\62\x2e\x30\72\x61\x73\x73\x65\x72\164\151\x6f\156", "\163\x61\155\154\x3a\x41\x75\x64\x69\x65\x6e\143\145", FALSE, $this->validAudiences);
        Ms:
    }
    private function addAuthnStatement(DOMElement $Tk)
    {
        if (!($this->authnInstant === NULL || $this->authnContextClassRef === NULL && $this->authnContextDecl === NULL && $this->authnContextDeclRef === NULL)) {
            goto Oo;
        }
        return;
        Oo:
        $Jl = $Tk->ownerDocument;
        $Dr = $Jl->createElementNS("\x75\162\156\x3a\x6f\x61\x73\x69\x73\x3a\156\x61\155\145\163\x3a\x74\143\x3a\123\101\115\114\72\62\56\60\72\x61\163\x73\145\x72\x74\x69\x6f\156", "\x73\141\155\x6c\72\x41\165\164\150\156\123\164\x61\164\145\x6d\145\x6e\164");
        $Tk->appendChild($Dr);
        $Dr->setAttribute("\x41\165\164\150\x6e\x49\x6e\x73\x74\141\156\164", gmdate("\x59\55\155\55\x64\134\x54\x48\x3a\x69\72\163\x5c\132", $this->authnInstant));
        if (!($this->sessionNotOnOrAfter !== NULL)) {
            goto qM;
        }
        $Dr->setAttribute("\123\x65\163\x73\x69\x6f\156\x4e\157\164\117\x6e\x4f\162\x41\146\164\145\x72", gmdate("\x59\x2d\x6d\x2d\144\x5c\124\x48\72\151\x3a\163\134\132", $this->sessionNotOnOrAfter));
        qM:
        if (!($this->sessionIndex !== NULL)) {
            goto r6;
        }
        $Dr->setAttribute("\x53\x65\x73\163\151\157\x6e\111\x6e\x64\x65\170", $this->sessionIndex);
        r6:
        $iX = $Jl->createElementNS("\x75\162\156\x3a\x6f\141\163\x69\x73\x3a\x6e\141\x6d\145\x73\x3a\x74\143\x3a\x53\x41\x4d\x4c\72\62\56\x30\72\x61\x73\163\145\162\164\151\157\156", "\163\141\x6d\154\x3a\101\165\x74\x68\x6e\x43\x6f\x6e\x74\145\x78\164");
        $Dr->appendChild($iX);
        if (empty($this->authnContextClassRef)) {
            goto yM;
        }
        SAMLSPUtilities::addString($iX, "\x75\162\x6e\x3a\x6f\141\x73\151\163\x3a\156\x61\155\145\163\72\x74\143\x3a\123\101\115\x4c\x3a\62\x2e\x30\72\x61\x73\x73\x65\x72\x74\x69\157\x6e", "\x73\x61\x6d\x6c\x3a\x41\165\x74\150\x6e\x43\157\156\164\x65\x78\x74\x43\154\141\x73\x73\x52\x65\146", $this->authnContextClassRef);
        yM:
        if (empty($this->authnContextDecl)) {
            goto Kp;
        }
        $this->authnContextDecl->toXML($iX);
        Kp:
        if (empty($this->authnContextDeclRef)) {
            goto q5;
        }
        SAMLSPUtilities::addString($iX, "\x75\x72\x6e\72\157\x61\x73\x69\x73\72\x6e\141\155\x65\x73\x3a\164\x63\x3a\123\101\115\114\72\x32\x2e\60\x3a\x61\x73\x73\145\162\164\151\x6f\x6e", "\163\141\155\154\x3a\x41\x75\x74\150\x6e\103\157\156\x74\145\x78\164\104\x65\x63\154\x52\145\146", $this->authnContextDeclRef);
        q5:
        SAMLSPUtilities::addStrings($iX, "\x75\162\x6e\72\x6f\x61\x73\151\163\72\x6e\x61\155\x65\163\x3a\164\143\72\x53\101\115\x4c\72\62\56\60\72\x61\x73\x73\x65\162\x74\x69\157\156", "\163\x61\155\154\72\x41\165\164\x68\x65\156\x74\151\x63\x61\x74\x69\156\x67\x41\x75\164\150\x6f\x72\x69\x74\171", FALSE, $this->AuthenticatingAuthority);
    }
    private function addAttributeStatement(DOMElement $Tk)
    {
        if (!empty($this->attributes)) {
            goto OX;
        }
        return;
        OX:
        $Jl = $Tk->ownerDocument;
        $Cb = $Jl->createElementNS("\165\x72\x6e\72\157\x61\163\151\x73\72\x6e\x61\x6d\x65\163\x3a\x74\x63\72\123\x41\115\114\72\62\x2e\x30\x3a\x61\163\x73\145\x72\164\x69\x6f\x6e", "\x73\141\x6d\154\72\101\x74\x74\x72\x69\142\165\164\x65\123\x74\141\164\x65\x6d\x65\x6e\164");
        $Tk->appendChild($Cb);
        foreach ($this->attributes as $Jh => $JZ) {
            $md = $Jl->createElementNS("\x75\162\156\x3a\x6f\x61\163\151\163\72\x6e\141\x6d\x65\163\72\x74\x63\x3a\x53\101\x4d\x4c\72\62\x2e\60\x3a\141\163\x73\x65\162\x74\x69\157\x6e", "\x73\141\155\x6c\x3a\x41\x74\164\162\151\x62\165\164\145");
            $Cb->appendChild($md);
            $md->setAttribute("\x4e\141\155\x65", $Jh);
            if (!($this->nameFormat !== "\x75\x72\x6e\x3a\157\141\163\x69\x73\72\156\141\155\145\x73\x3a\164\143\x3a\123\x41\x4d\114\72\62\x2e\60\x3a\x61\x74\x74\162\156\141\x6d\x65\55\x66\x6f\x72\x6d\141\x74\x3a\x75\x6e\x73\x70\x65\143\x69\146\x69\x65\144")) {
                goto pB;
            }
            $md->setAttribute("\x4e\x61\155\x65\106\x6f\162\155\x61\x74", $this->nameFormat);
            pB:
            foreach ($JZ as $nj) {
                if (is_string($nj)) {
                    goto af;
                }
                if (is_int($nj)) {
                    goto dl;
                }
                $km = NULL;
                goto yt;
                af:
                $km = "\170\x73\72\x73\164\x72\x69\x6e\147";
                goto yt;
                dl:
                $km = "\x78\x73\x3a\151\x6e\164\x65\x67\x65\162";
                yt:
                $EG = $Jl->createElementNS("\165\x72\156\x3a\157\x61\163\151\x73\x3a\156\x61\x6d\x65\x73\72\164\x63\x3a\123\x41\x4d\114\x3a\62\x2e\x30\x3a\141\163\163\x65\162\x74\151\157\156", "\163\x61\x6d\x6c\72\x41\164\x74\162\x69\x62\x75\164\x65\126\141\x6c\165\145");
                $md->appendChild($EG);
                if (!($km !== NULL)) {
                    goto AY;
                }
                $EG->setAttributeNS("\150\x74\164\x70\72\57\57\167\167\167\x2e\x77\x33\x2e\157\x72\147\57\x32\60\x30\61\57\x58\115\114\123\143\x68\x65\x6d\141\55\x69\156\163\164\x61\x6e\x63\x65", "\x78\163\x69\x3a\164\x79\x70\x65", $km);
                AY:
                if (!is_null($nj)) {
                    goto TT;
                }
                $EG->setAttributeNS("\150\x74\x74\x70\x3a\57\57\x77\167\167\56\167\63\56\157\x72\x67\x2f\62\x30\60\61\x2f\130\115\114\123\x63\x68\145\155\141\55\x69\156\163\x74\141\x6e\x63\x65", "\170\163\151\72\156\x69\x6c", "\x74\162\165\145");
                TT:
                if ($nj instanceof DOMNodeList) {
                    goto jj;
                }
                $EG->appendChild($Jl->createTextNode($nj));
                goto yA;
                jj:
                $y_ = 0;
                uz:
                if (!($y_ < $nj->length)) {
                    goto ru;
                }
                $y5 = $Jl->importNode($nj->item($y_), TRUE);
                $EG->appendChild($y5);
                Bf:
                $y_++;
                goto uz;
                ru:
                yA:
                eq:
            }
            la:
            I7:
        }
        mA:
    }
    private function addEncryptedAttributeStatement(DOMElement $Tk)
    {
        if (!($this->requiredEncAttributes == FALSE)) {
            goto CI;
        }
        return;
        CI:
        $Jl = $Tk->ownerDocument;
        $Cb = $Jl->createElementNS("\x75\162\156\72\x6f\x61\x73\151\x73\x3a\156\141\x6d\145\163\x3a\164\x63\72\x53\x41\x4d\x4c\72\x32\x2e\60\72\141\x73\x73\145\162\x74\x69\x6f\156", "\x73\141\155\x6c\72\101\164\164\162\x69\142\165\x74\145\123\x74\x61\x74\x65\x6d\x65\156\x74");
        $Tk->appendChild($Cb);
        foreach ($this->attributes as $Jh => $JZ) {
            $nf = new DOMDocument();
            $md = $nf->createElementNS("\x75\x72\156\x3a\157\141\163\x69\163\72\x6e\x61\x6d\x65\x73\72\x74\143\72\x53\101\115\x4c\x3a\62\56\60\x3a\141\x73\x73\x65\162\x74\151\157\x6e", "\163\141\x6d\154\72\101\x74\164\x72\151\x62\165\164\145");
            $md->setAttribute("\x4e\141\155\x65", $Jh);
            $nf->appendChild($md);
            if (!($this->nameFormat !== "\x75\x72\156\x3a\157\141\163\x69\x73\72\156\x61\155\x65\163\72\x74\x63\72\x53\101\115\114\72\62\56\x30\x3a\x61\164\x74\162\156\x61\155\145\55\146\157\162\x6d\x61\x74\72\x75\156\x73\160\145\143\x69\x66\151\x65\144")) {
                goto bY;
            }
            $md->setAttribute("\116\141\x6d\x65\x46\157\x72\x6d\141\x74", $this->nameFormat);
            bY:
            foreach ($JZ as $nj) {
                if (is_string($nj)) {
                    goto o1;
                }
                if (is_int($nj)) {
                    goto z9;
                }
                $km = NULL;
                goto Dw;
                o1:
                $km = "\170\x73\72\163\x74\162\151\x6e\147";
                goto Dw;
                z9:
                $km = "\170\163\x3a\x69\x6e\x74\x65\147\145\162";
                Dw:
                $EG = $nf->createElementNS("\165\162\x6e\x3a\157\x61\163\151\x73\x3a\x6e\x61\155\x65\163\x3a\164\143\72\123\101\115\x4c\72\x32\56\x30\x3a\141\x73\x73\x65\162\x74\x69\157\x6e", "\x73\x61\x6d\154\x3a\x41\x74\164\x72\x69\142\165\x74\145\x56\x61\x6c\165\x65");
                $md->appendChild($EG);
                if (!($km !== NULL)) {
                    goto QH;
                }
                $EG->setAttributeNS("\x68\164\164\x70\72\x2f\57\167\167\x77\56\167\x33\56\x6f\x72\147\57\x32\x30\x30\61\57\130\x4d\x4c\x53\143\150\x65\x6d\x61\x2d\x69\x6e\x73\164\x61\x6e\x63\x65", "\x78\x73\151\72\164\x79\x70\x65", $km);
                QH:
                if ($nj instanceof DOMNodeList) {
                    goto WK;
                }
                $EG->appendChild($nf->createTextNode($nj));
                goto Gy;
                WK:
                $y_ = 0;
                Eq:
                if (!($y_ < $nj->length)) {
                    goto RL;
                }
                $y5 = $nf->importNode($nj->item($y_), TRUE);
                $EG->appendChild($y5);
                jh:
                $y_++;
                goto Eq;
                RL:
                Gy:
                D2:
            }
            LX:
            $xY = new XMLSecEnc();
            $xY->setNode($nf->documentElement);
            $xY->type = "\x68\164\164\x70\72\x2f\57\167\x77\167\56\167\x33\x2e\157\x72\147\x2f\x32\60\60\61\57\60\x34\57\170\155\x6c\145\x6e\x63\43\x45\x6c\145\155\x65\x6e\164";
            $HA = new XMLSecurityKey(XMLSecurityKey::AES256_CBC);
            $HA->generateSessionKey();
            $xY->encryptKey($this->encryptionKey, $HA);
            $X4 = $xY->encryptNode($HA);
            $cR = $Jl->createElementNS("\x75\x72\156\72\157\141\163\151\163\x3a\x6e\141\x6d\145\x73\72\x74\x63\x3a\x53\x41\x4d\114\x3a\x32\x2e\60\x3a\141\163\163\x65\162\x74\x69\x6f\156", "\x73\141\x6d\154\x3a\105\x6e\x63\x72\x79\160\x74\x65\x64\101\164\164\162\151\142\165\164\145");
            $Cb->appendChild($cR);
            $eA = $Jl->importNode($X4, TRUE);
            $cR->appendChild($eA);
            lY:
        }
        Q8:
    }
    public function getPrivateKeyUrl()
    {
        return $this->privateKeyUrl;
    }
    public function setPrivateKeyUrl($pW)
    {
        $this->privateKeyUrl = $pW;
    }
}
