<?php


include_once "\125\164\151\154\151\164\x69\x65\x73\56\x70\150\x70";
include_once "\170\155\x6c\x73\145\x63\154\x69\142\x73\56\x70\150\160";
use RobRichards\XMLSecLibs\XMLSecurityKey;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecEnc;
class SAML2SPLogoutRequest
{
    private $tagName;
    private $id;
    private $issuer;
    private $destination;
    private $issueInstant;
    private $certificates;
    private $validators;
    private $notOnOrAfter;
    private $encryptedNameId;
    private $nameId;
    private $sessionIndexes;
    public function __construct(DOMElement $tW = NULL)
    {
        $this->tagName = "\114\157\x67\157\165\164\122\x65\x71\x75\x65\163\164";
        $this->id = SAMLSPUtilities::generateID();
        $this->issueInstant = time();
        $this->certificates = array();
        $this->validators = array();
        if (!($tW === NULL)) {
            goto Ef;
        }
        return;
        Ef:
        if ($tW->hasAttribute("\x49\104")) {
            goto ci;
        }
        throw new Exception("\x4d\151\x73\163\x69\156\x67\40\111\x44\x20\141\164\164\162\151\x62\165\164\145\40\157\x6e\40\123\x41\115\x4c\40\x6d\x65\x73\x73\x61\147\145\56");
        ci:
        $this->id = $tW->getAttribute("\x49\x44");
        if (!($tW->getAttribute("\126\x65\162\163\151\157\x6e") !== "\x32\56\x30")) {
            goto EK;
        }
        throw new Exception("\x55\x6e\163\165\x70\x70\x6f\x72\164\145\x64\x20\166\145\162\x73\151\x6f\156\x3a\x20" . $tW->getAttribute("\x56\145\x72\x73\x69\157\156"));
        EK:
        $this->issueInstant = SAMLSPUtilities::xsDateTimeToTimestamp($tW->getAttribute("\x49\163\163\165\x65\111\156\x73\x74\141\156\164"));
        if (!$tW->hasAttribute("\x44\145\163\164\151\x6e\141\x74\x69\x6f\156")) {
            goto ea;
        }
        $this->destination = $tW->getAttribute("\104\x65\x73\x74\x69\x6e\141\164\x69\x6f\156");
        ea:
        $JV = SAMLSPUtilities::xpQuery($tW, "\x2e\x2f\163\141\x6d\x6c\x5f\x61\x73\x73\x65\162\164\151\x6f\156\x3a\x49\163\163\165\x65\x72");
        if (empty($JV)) {
            goto Hs;
        }
        $this->issuer = trim($JV[0]->textContent);
        Hs:
        try {
            $la = SAMLSPUtilities::validateElement($tW);
            if (!($la !== FALSE)) {
                goto bV;
            }
            $this->certificates = $la["\x43\x65\x72\164\x69\x66\x69\143\x61\x74\x65\163"];
            $this->validators[] = array("\x46\165\156\143\164\151\x6f\156" => array("\125\164\151\x6c\151\164\x69\x65\x73", "\166\x61\x6c\x69\x64\x61\164\x65\x53\x69\x67\156\x61\x74\x75\x72\x65"), "\104\141\164\x61" => $la);
            bV:
        } catch (Exception $zg) {
        }
        $this->sessionIndexes = array();
        if (!$tW->hasAttribute("\x4e\x6f\164\x4f\156\117\x72\x41\x66\164\x65\162")) {
            goto Ov;
        }
        $this->notOnOrAfter = SAMLSPUtilities::xsDateTimeToTimestamp($tW->getAttribute("\x4e\157\x74\x4f\156\x4f\x72\101\146\x74\x65\x72"));
        Ov:
        $Jw = SAMLSPUtilities::xpQuery($tW, "\x2e\57\163\x61\155\x6c\x5f\x61\163\163\x65\x72\164\151\x6f\156\72\116\141\155\x65\x49\x44\40\174\40\x2e\57\x73\141\155\154\137\x61\163\163\145\162\x74\151\157\x6e\x3a\x45\156\143\162\x79\x70\164\x65\144\111\104\x2f\x78\x65\156\x63\x3a\x45\x6e\x63\162\x79\x70\x74\145\x64\104\141\x74\141");
        if (empty($Jw)) {
            goto vj;
        }
        if (count($Jw) > 1) {
            goto Ap;
        }
        goto Vv;
        vj:
        throw new Exception("\115\151\x73\163\151\156\147\x20\74\x73\141\x6d\154\72\x4e\x61\x6d\145\111\104\76\40\157\162\40\74\163\141\155\x6c\x3a\105\156\x63\x72\x79\160\164\x65\x64\111\x44\76\40\151\x6e\x20\74\163\141\155\154\x70\72\x4c\157\x67\157\x75\x74\122\x65\161\165\x65\x73\164\x3e\56");
        goto Vv;
        Ap:
        throw new Exception("\x4d\x6f\162\145\40\164\x68\141\156\40\x6f\x6e\x65\40\x3c\x73\x61\x6d\x6c\x3a\116\x61\155\145\111\x44\x3e\x20\x6f\162\x20\x3c\x73\x61\x6d\154\x3a\x45\156\x63\162\171\x70\164\145\144\x44\76\x20\x69\x6e\40\x3c\163\141\x6d\154\160\72\114\x6f\x67\157\x75\x74\122\x65\x71\165\145\x73\164\x3e\x2e");
        Vv:
        $Jw = $Jw[0];
        if ($Jw->localName === "\x45\156\x63\162\171\160\164\145\144\104\x61\164\x61") {
            goto Cq;
        }
        $this->nameId = SAMLSPUtilities::parseNameId($Jw);
        goto ql;
        Cq:
        $this->encryptedNameId = $Jw;
        ql:
        $V9 = SAMLSPUtilities::xpQuery($tW, "\56\x2f\163\141\x6d\x6c\x5f\160\162\x6f\x74\157\x63\x6f\x6c\x3a\x53\145\x73\x73\x69\x6f\x6e\111\x6e\144\145\170");
        foreach ($V9 as $rB) {
            $this->sessionIndexes[] = trim($rB->textContent);
            G9:
        }
        Gj:
    }
    public function getNotOnOrAfter()
    {
        return $this->notOnOrAfter;
    }
    public function setNotOnOrAfter($fg)
    {
        $this->notOnOrAfter = $fg;
    }
    public function isNameIdEncrypted()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto ju;
        }
        return TRUE;
        ju:
        return FALSE;
    }
    public function encryptNameId(XMLSecurityKey $y9)
    {
        $ra = new DOMDocument();
        $Tk = $ra->createElement("\x72\x6f\157\164");
        $ra->appendChild($Tk);
        SAML2_Utils::addNameId($Tk, $this->nameId);
        $Jw = $Tk->firstChild;
        SAML2_Utils::getContainer()->debugMessage($Jw, "\x65\x6e\143\162\x79\x70\x74");
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
            goto yy;
        }
        return;
        yy:
        $Jw = SAML2_Utils::decryptElement($this->encryptedNameId, $y9, $Ls);
        SAML2_Utils::getContainer()->debugMessage($Jw, "\x64\x65\x63\x72\x79\160\164");
        $this->nameId = SAML2_Utils::parseNameId($Jw);
        $this->encryptedNameId = NULL;
    }
    public function getNameId()
    {
        if (!($this->encryptedNameId !== NULL)) {
            goto S4;
        }
        throw new Exception("\101\164\164\145\155\x70\164\145\x64\40\x74\157\x20\162\x65\164\x72\151\x65\x76\x65\40\x65\156\143\162\x79\x70\164\x65\x64\40\116\141\x6d\x65\x49\x44\x20\167\x69\x74\x68\x6f\165\x74\40\x64\x65\143\x72\x79\x70\x74\151\156\147\40\151\x74\x20\x66\x69\x72\163\164\x2e");
        S4:
        return $this->nameId;
    }
    public function setNameId($Jw)
    {
        $this->nameId = $Jw;
    }
    public function getSessionIndexes()
    {
        return $this->sessionIndexes;
    }
    public function setSessionIndexes(array $V9)
    {
        $this->sessionIndexes = $V9;
    }
    public function getSessionIndex()
    {
        if (!empty($this->sessionIndexes)) {
            goto Bs;
        }
        return NULL;
        Bs:
        return $this->sessionIndexes[0];
    }
    public function setSessionIndex($rB)
    {
        if (is_null($rB)) {
            goto gV;
        }
        $this->sessionIndexes = array($rB);
        goto KK;
        gV:
        $this->sessionIndexes = array();
        KK:
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
    public function getDestination()
    {
        return $this->destination;
    }
    public function setDestination($GH)
    {
        $this->destination = $GH;
    }
    public function getIssuer()
    {
        return $this->issuer;
    }
    public function setIssuer($JV)
    {
        $this->issuer = $JV;
    }
}
