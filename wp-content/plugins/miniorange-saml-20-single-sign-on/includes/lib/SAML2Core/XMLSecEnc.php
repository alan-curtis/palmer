<?php


namespace RobRichards\XMLSecLibs;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Exception;
use RobRichards\XMLSecLibs\Utils\XPath as XPath;
class XMLSecEnc
{
    const template = "\x3c\170\x65\x6e\x63\x3a\x45\156\x63\162\171\x70\164\x65\x64\x44\x61\x74\x61\x20\170\155\x6c\x6e\x73\x3a\170\145\x6e\x63\x3d\47\x68\x74\x74\x70\72\x2f\57\x77\167\x77\x2e\167\x33\56\157\x72\147\57\x32\60\x30\x31\x2f\60\64\57\x78\x6d\x6c\145\x6e\143\x23\x27\76\15\12\x20\40\40\x3c\170\145\156\x63\72\103\x69\160\x68\x65\162\104\141\x74\141\x3e\15\xa\x20\40\x20\40\40\40\74\170\145\156\x63\x3a\103\151\x70\150\145\x72\x56\x61\x6c\165\x65\76\x3c\57\x78\145\156\143\72\103\151\x70\150\145\162\x56\x61\x6c\x75\x65\x3e\15\12\40\x20\x20\x3c\57\x78\145\156\x63\72\103\151\x70\x68\145\x72\x44\141\x74\141\76\15\xa\74\57\x78\145\156\143\72\105\x6e\x63\x72\171\160\164\145\144\x44\141\x74\x61\76";
    const Element = "\150\x74\164\160\x3a\57\57\167\167\x77\x2e\x77\63\x2e\x6f\162\147\x2f\62\60\60\61\57\60\64\x2f\170\x6d\x6c\x65\x6e\x63\43\x45\x6c\145\155\145\x6e\164";
    const Content = "\150\x74\x74\x70\x3a\57\x2f\x77\167\167\56\167\63\x2e\x6f\162\x67\x2f\62\60\x30\x31\x2f\60\x34\x2f\170\155\x6c\x65\156\143\x23\x43\157\156\x74\x65\x6e\164";
    const URI = 3;
    const XMLENCNS = "\150\164\x74\160\72\x2f\x2f\167\x77\167\x2e\167\x33\56\x6f\x72\x67\x2f\x32\60\60\x31\x2f\x30\x34\x2f\x78\x6d\154\x65\x6e\x63\43";
    private $encdoc = null;
    private $rawNode = null;
    public $type = null;
    public $encKey = null;
    private $references = array();
    public function __construct()
    {
        $this->_resetTemplate();
    }
    private function _resetTemplate()
    {
        $this->encdoc = new DOMDocument();
        $this->encdoc->loadXML(self::template);
    }
    public function addReference($Jh, $y5, $km)
    {
        if ($y5 instanceof DOMNode) {
            goto B_;
        }
        throw new Exception("\x24\156\x6f\144\x65\40\151\x73\x20\156\x6f\x74\x20\x6f\146\x20\x74\x79\x70\x65\40\x44\117\x4d\116\157\x64\x65");
        B_:
        $fk = $this->encdoc;
        $this->_resetTemplate();
        $w1 = $this->encdoc;
        $this->encdoc = $fk;
        $Ue = XMLSecurityDSig::generateGUID();
        $Ba = $w1->documentElement;
        $Ba->setAttribute("\111\x64", $Ue);
        $this->references[$Jh] = array("\156\157\144\x65" => $y5, "\x74\171\160\145" => $km, "\x65\x6e\143\x6e\x6f\x64\x65" => $w1, "\162\145\x66\165\162\151" => $Ue);
    }
    public function setNode($y5)
    {
        $this->rawNode = $y5;
    }
    public function encryptNode($X6, $IM = true)
    {
        $h6 = '';
        if (!empty($this->rawNode)) {
            goto UR;
        }
        throw new Exception("\116\x6f\144\145\40\x74\157\x20\x65\156\x63\x72\171\x70\x74\x20\x68\141\163\x20\156\x6f\164\40\x62\145\145\156\x20\163\145\164");
        UR:
        if ($X6 instanceof XMLSecurityKey) {
            goto nG;
        }
        throw new Exception("\111\156\x76\x61\154\x69\x64\x20\113\x65\171");
        nG:
        $ra = $this->rawNode->ownerDocument;
        $Mu = new DOMXPath($this->encdoc);
        $at = $Mu->query("\x2f\x78\145\156\143\72\x45\156\x63\x72\171\x70\164\145\144\104\x61\164\x61\x2f\170\145\156\x63\72\x43\x69\x70\x68\145\162\104\141\164\141\x2f\170\145\x6e\143\x3a\x43\x69\x70\x68\x65\x72\x56\x61\x6c\x75\145");
        $DD = $at->item(0);
        if (!($DD == null)) {
            goto HD;
        }
        throw new Exception("\105\x72\162\x6f\162\40\154\x6f\143\x61\x74\x69\x6e\x67\40\x43\151\x70\150\145\x72\x56\x61\x6c\x75\145\x20\x65\x6c\145\x6d\x65\x6e\164\x20\167\151\164\150\151\156\40\x74\x65\x6d\x70\154\141\x74\x65");
        HD:
        switch ($this->type) {
            case self::Element:
                $h6 = $ra->saveXML($this->rawNode);
                $this->encdoc->documentElement->setAttribute("\124\x79\x70\x65", self::Element);
                goto gg;
            case self::Content:
                $yu = $this->rawNode->childNodes;
                foreach ($yu as $F3) {
                    $h6 .= $ra->saveXML($F3);
                    xn:
                }
                ok:
                $this->encdoc->documentElement->setAttribute("\x54\x79\160\145", self::Content);
                goto gg;
            default:
                throw new Exception("\124\171\x70\x65\40\151\163\40\x63\x75\x72\x72\x65\156\164\x6c\171\x20\156\157\164\x20\163\x75\160\160\157\162\x74\145\x64");
        }
        k1:
        gg:
        $zf = $this->encdoc->documentElement->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\x65\x6e\x63\x3a\x45\156\x63\162\171\160\164\151\x6f\x6e\x4d\x65\x74\150\157\x64"));
        $zf->setAttribute("\x41\154\147\x6f\x72\x69\x74\x68\155", $X6->getAlgorithm());
        $DD->parentNode->parentNode->insertBefore($zf, $DD->parentNode->parentNode->firstChild);
        $zW = base64_encode($X6->encryptData($h6));
        $nj = $this->encdoc->createTextNode($zW);
        $DD->appendChild($nj);
        if ($IM) {
            goto Ce;
        }
        return $this->encdoc->documentElement;
        goto ud;
        Ce:
        switch ($this->type) {
            case self::Element:
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto Is;
                }
                return $this->encdoc;
                Is:
                $Ya = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                $this->rawNode->parentNode->replaceChild($Ya, $this->rawNode);
                return $Ya;
            case self::Content:
                $Ya = $this->rawNode->ownerDocument->importNode($this->encdoc->documentElement, true);
                A6:
                if (!$this->rawNode->firstChild) {
                    goto WG;
                }
                $this->rawNode->removeChild($this->rawNode->firstChild);
                goto A6;
                WG:
                $this->rawNode->appendChild($Ya);
                return $Ya;
        }
        VT:
        cF:
        ud:
    }
    public function encryptReferences($X6)
    {
        $WW = $this->rawNode;
        $kl = $this->type;
        foreach ($this->references as $Jh => $p0) {
            $this->encdoc = $p0["\145\x6e\143\156\157\144\x65"];
            $this->rawNode = $p0["\x6e\157\144\145"];
            $this->type = $p0["\164\171\160\145"];
            try {
                $uB = $this->encryptNode($X6);
                $this->references[$Jh]["\145\x6e\x63\x6e\157\144\x65"] = $uB;
            } catch (Exception $zg) {
                $this->rawNode = $WW;
                $this->type = $kl;
                throw $zg;
            }
            BJ:
        }
        Tg:
        $this->rawNode = $WW;
        $this->type = $kl;
    }
    public function getCipherValue()
    {
        if (!empty($this->rawNode)) {
            goto CK;
        }
        throw new Exception("\116\157\144\x65\x20\164\157\40\x64\145\x63\x72\171\x70\x74\40\x68\x61\163\40\156\157\x74\40\142\x65\x65\x6e\40\163\145\164");
        CK:
        $ra = $this->rawNode->ownerDocument;
        $Mu = new DOMXPath($ra);
        $Mu->registerNamespace("\x78\155\154\145\156\x63\x72", self::XMLENCNS);
        $k0 = "\56\57\170\x6d\x6c\145\156\x63\162\x3a\x43\x69\x70\x68\x65\162\104\x61\x74\x61\57\170\x6d\154\x65\x6e\x63\162\72\x43\151\x70\x68\x65\x72\x56\x61\x6c\x75\x65";
        $ym = $Mu->query($k0, $this->rawNode);
        $y5 = $ym->item(0);
        if ($y5) {
            goto Q4;
        }
        return null;
        Q4:
        return base64_decode($y5->nodeValue);
    }
    public function decryptNode($X6, $IM = true)
    {
        if ($X6 instanceof XMLSecurityKey) {
            goto pr;
        }
        throw new Exception("\111\x6e\166\141\x6c\x69\x64\x20\x4b\145\171");
        pr:
        $DA = $this->getCipherValue();
        if ($DA) {
            goto cP;
        }
        throw new Exception("\103\x61\156\156\157\164\x20\154\x6f\143\x61\x74\x65\x20\x65\x6e\x63\162\x79\160\164\145\x64\x20\x64\x61\x74\x61");
        goto o0;
        cP:
        $aG = $X6->decryptData($DA);
        if ($IM) {
            goto dv;
        }
        return $aG;
        goto fv;
        dv:
        switch ($this->type) {
            case self::Element:
                $wE = new DOMDocument();
                $wE->loadXML($aG);
                if (!($this->rawNode->nodeType == XML_DOCUMENT_NODE)) {
                    goto wN;
                }
                return $wE;
                wN:
                $Ya = $this->rawNode->ownerDocument->importNode($wE->documentElement, true);
                $this->rawNode->parentNode->replaceChild($Ya, $this->rawNode);
                return $Ya;
            case self::Content:
                if ($this->rawNode->nodeType == XML_DOCUMENT_NODE) {
                    goto eC;
                }
                $ra = $this->rawNode->ownerDocument;
                goto Ay;
                eC:
                $ra = $this->rawNode;
                Ay:
                $oL = $ra->createDocumentFragment();
                $oL->appendXML($aG);
                $hQ = $this->rawNode->parentNode;
                $hQ->replaceChild($oL, $this->rawNode);
                return $hQ;
            default:
                return $aG;
        }
        MM:
        Q0:
        fv:
        o0:
    }
    public function encryptKey($Qx, $E3, $gf = true)
    {
        if (!(!$Qx instanceof XMLSecurityKey || !$E3 instanceof XMLSecurityKey)) {
            goto QT;
        }
        throw new Exception("\x49\x6e\166\141\154\x69\144\x20\113\145\171");
        QT:
        $CJ = base64_encode($Qx->encryptData($E3->key));
        $Tk = $this->encdoc->documentElement;
        $c_ = $this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\x63\x3a\105\156\143\162\171\x70\x74\145\144\113\x65\x79");
        if ($gf) {
            goto eQ;
        }
        $this->encKey = $c_;
        goto Ey;
        eQ:
        $vC = $Tk->insertBefore($this->encdoc->createElementNS("\150\164\164\160\72\57\x2f\x77\x77\167\56\167\x33\x2e\157\x72\x67\x2f\x32\60\60\60\57\60\x39\57\x78\x6d\x6c\x64\163\x69\147\x23", "\144\x73\x69\147\72\113\145\x79\x49\156\x66\x6f"), $Tk->firstChild);
        $vC->appendChild($c_);
        Ey:
        $zf = $c_->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\x6e\143\x3a\x45\x6e\x63\x72\x79\x70\x74\151\157\156\115\145\164\150\157\x64"));
        $zf->setAttribute("\x41\x6c\x67\x6f\162\x69\164\150\155", $Qx->getAlgorith());
        if (empty($Qx->name)) {
            goto qO;
        }
        $vC = $c_->appendChild($this->encdoc->createElementNS("\150\x74\x74\x70\72\x2f\57\x77\167\167\x2e\167\63\x2e\157\162\x67\x2f\x32\60\x30\x30\x2f\x30\x39\x2f\170\155\154\x64\x73\x69\x67\43", "\x64\x73\x69\x67\72\113\145\171\x49\x6e\x66\157"));
        $vC->appendChild($this->encdoc->createElementNS("\150\164\x74\x70\x3a\57\57\167\167\x77\56\167\63\56\157\x72\147\x2f\62\x30\x30\x30\57\x30\71\57\170\x6d\x6c\x64\x73\151\147\43", "\x64\x73\x69\x67\72\x4b\x65\171\116\141\155\145", $Qx->name));
        qO:
        $wN = $c_->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\x78\145\x6e\x63\x3a\x43\151\160\x68\x65\x72\104\141\164\141"));
        $wN->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\x6e\143\72\x43\x69\160\x68\x65\x72\126\x61\x6c\x75\145", $CJ));
        if (!(is_array($this->references) && count($this->references) > 0)) {
            goto Xd;
        }
        $cq = $c_->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\145\x6e\143\72\122\145\146\x65\162\145\x6e\143\x65\x4c\151\x73\x74"));
        foreach ($this->references as $Jh => $p0) {
            $Ue = $p0["\x72\145\146\x75\162\x69"];
            $T4 = $cq->appendChild($this->encdoc->createElementNS(self::XMLENCNS, "\170\x65\156\x63\x3a\104\x61\164\x61\x52\145\146\145\x72\145\x6e\x63\145"));
            $T4->setAttribute("\x55\x52\111", "\43" . $Ue);
            Cy:
        }
        i4:
        Xd:
        return;
    }
    public function decryptKey($c_)
    {
        if ($c_->isEncrypted) {
            goto cj;
        }
        throw new Exception("\113\145\x79\x20\151\x73\x20\156\x6f\x74\x20\x45\156\x63\x72\x79\160\x74\145\x64");
        cj:
        if (!empty($c_->key)) {
            goto x_;
        }
        throw new Exception("\113\x65\171\40\x69\163\40\x6d\x69\163\x73\x69\x6e\x67\x20\144\x61\x74\x61\40\164\157\x20\160\145\x72\x66\x6f\162\x6d\40\x74\150\145\x20\x64\x65\143\162\171\160\164\x69\157\x6e");
        x_:
        return $this->decryptNode($c_, false);
    }
    public function locateEncryptedData($Ba)
    {
        if ($Ba instanceof DOMDocument) {
            goto NC;
        }
        $ra = $Ba->ownerDocument;
        goto Ck;
        NC:
        $ra = $Ba;
        Ck:
        if (!$ra) {
            goto e2;
        }
        $eR = new DOMXPath($ra);
        $k0 = "\x2f\57\x2a\x5b\154\x6f\x63\x61\154\55\x6e\141\x6d\x65\x28\x29\75\47\x45\x6e\143\x72\x79\x70\164\145\x64\104\x61\x74\141\47\40\141\x6e\x64\40\156\x61\155\x65\x73\x70\141\143\145\x2d\165\x72\x69\x28\51\75\x27" . self::XMLENCNS . "\x27\x5d";
        $ym = $eR->query($k0);
        return $ym->item(0);
        e2:
        return null;
    }
    public function locateKey($y5 = null)
    {
        if (!empty($y5)) {
            goto b2;
        }
        $y5 = $this->rawNode;
        b2:
        if ($y5 instanceof DOMNode) {
            goto rE;
        }
        return null;
        rE:
        if (!($ra = $y5->ownerDocument)) {
            goto Vn;
        }
        $eR = new DOMXPath($ra);
        $eR->registerNamespace("\x78\x6d\154\x73\145\x63\145\x6e\x63", self::XMLENCNS);
        $k0 = "\x2e\57\x2f\x78\x6d\x6c\x73\145\143\145\x6e\x63\72\x45\156\x63\x72\171\160\x74\x69\x6f\x6e\x4d\x65\164\150\x6f\144";
        $ym = $eR->query($k0, $y5);
        if (!($lm = $ym->item(0))) {
            goto Kn;
        }
        $Rp = $lm->getAttribute("\x41\x6c\x67\157\162\x69\164\150\155");
        try {
            $X6 = new XMLSecurityKey($Rp, array("\x74\171\x70\x65" => "\160\x72\151\x76\x61\x74\x65"));
        } catch (Exception $zg) {
            return null;
        }
        return $X6;
        Kn:
        Vn:
        return null;
    }
    public static function staticLocateKeyInfo($If = null, $y5 = null)
    {
        if (!(empty($y5) || !$y5 instanceof DOMNode)) {
            goto ss;
        }
        return null;
        ss:
        $ra = $y5->ownerDocument;
        if ($ra) {
            goto wf;
        }
        return null;
        wf:
        $eR = new DOMXPath($ra);
        $eR->registerNamespace("\x78\x6d\x6c\163\x65\143\145\156\143", self::XMLENCNS);
        $eR->registerNamespace("\x78\x6d\x6c\x73\145\143\144\163\151\x67", XMLSecurityDSig::XMLDSIGNS);
        $k0 = "\x2e\x2f\x78\155\x6c\x73\x65\143\144\x73\151\x67\x3a\x4b\145\x79\x49\156\146\157";
        $ym = $eR->query($k0, $y5);
        $lm = $ym->item(0);
        if ($lm) {
            goto u4;
        }
        return $If;
        u4:
        foreach ($lm->childNodes as $F3) {
            switch ($F3->localName) {
                case "\113\x65\x79\x4e\x61\x6d\145":
                    if (empty($If)) {
                        goto Cn;
                    }
                    $If->name = $F3->nodeValue;
                    Cn:
                    goto Vw;
                case "\x4b\145\171\126\x61\x6c\x75\145":
                    foreach ($F3->childNodes as $Jz) {
                        switch ($Jz->localName) {
                            case "\x44\123\x41\113\x65\x79\x56\141\x6c\x75\x65":
                                throw new Exception("\104\x53\x41\x4b\x65\x79\x56\x61\x6c\165\x65\40\x63\165\x72\162\145\156\x74\x6c\x79\x20\x6e\x6f\x74\40\x73\165\x70\160\157\x72\x74\145\x64");
                            case "\x52\123\101\x4b\x65\171\126\141\154\165\x65":
                                $JQ = null;
                                $fS = null;
                                if (!($Ma = $Jz->getElementsByTagName("\115\x6f\x64\x75\154\x75\163")->item(0))) {
                                    goto FE;
                                }
                                $JQ = base64_decode($Ma->nodeValue);
                                FE:
                                if (!($B2 = $Jz->getElementsByTagName("\105\x78\160\x6f\156\145\156\x74")->item(0))) {
                                    goto J1;
                                }
                                $fS = base64_decode($B2->nodeValue);
                                J1:
                                if (!(empty($JQ) || empty($fS))) {
                                    goto co;
                                }
                                throw new Exception("\115\x69\163\x73\151\x6e\147\40\x4d\x6f\x64\165\154\165\x73\x20\157\x72\x20\x45\170\x70\157\156\145\156\164");
                                co:
                                $pt = XMLSecurityKey::convertRSA($JQ, $fS);
                                $If->loadKey($pt);
                                goto Z0;
                        }
                        bt:
                        Z0:
                        yk:
                    }
                    QA:
                    goto Vw;
                case "\122\145\164\x72\x69\145\x76\141\x6c\x4d\x65\164\x68\157\144":
                    $km = $F3->getAttribute("\x54\171\x70\x65");
                    if (!($km !== "\150\164\x74\x70\72\x2f\x2f\167\167\x77\x2e\x77\63\56\x6f\x72\x67\57\62\60\x30\x31\57\60\64\x2f\x78\155\154\145\156\x63\x23\105\156\x63\x72\x79\x70\x74\145\x64\x4b\145\171")) {
                        goto mU;
                    }
                    goto Vw;
                    mU:
                    $JE = $F3->getAttribute("\125\x52\x49");
                    if (!($JE[0] !== "\43")) {
                        goto mq;
                    }
                    goto Vw;
                    mq:
                    $yT = substr($JE, 1);
                    $k0 = "\x2f\57\x78\155\x6c\163\145\x63\x65\156\x63\72\x45\156\143\162\x79\x70\164\x65\x64\x4b\145\171\x5b\100\111\x64\75\x22" . XPath::filterAttrValue($yT, XPath::DOUBLE_QUOTE) . "\42\135";
                    $oR = $eR->query($k0)->item(0);
                    if ($oR) {
                        goto gq;
                    }
                    throw new Exception("\125\156\141\142\x6c\x65\x20\164\157\40\154\157\x63\141\x74\145\x20\x45\156\143\162\x79\x70\164\x65\144\x4b\145\171\x20\167\x69\x74\150\x20\x40\111\144\x3d\47{$yT}\47\56");
                    gq:
                    return XMLSecurityKey::fromEncryptedKeyElement($oR);
                case "\105\x6e\143\162\x79\x70\164\x65\144\x4b\145\x79":
                    return XMLSecurityKey::fromEncryptedKeyElement($F3);
                case "\130\x35\x30\x39\x44\x61\x74\141":
                    if (!($Sa = $F3->getElementsByTagName("\x58\65\x30\x39\103\x65\x72\164\x69\x66\x69\143\141\164\x65"))) {
                        goto Hq;
                    }
                    if (!($Sa->length > 0)) {
                        goto U7;
                    }
                    $mq = $Sa->item(0)->textContent;
                    $mq = str_replace(array("\xd", "\xa", "\40"), '', $mq);
                    $mq = "\x2d\x2d\55\x2d\55\x42\x45\x47\111\116\40\x43\x45\x52\x54\x49\x46\x49\103\x41\x54\x45\x2d\55\55\x2d\x2d\xa" . chunk_split($mq, 64, "\xa") . "\55\55\x2d\55\55\x45\x4e\x44\x20\x43\105\x52\124\111\106\111\x43\x41\x54\x45\x2d\55\55\x2d\55\xa";
                    $If->loadKey($mq, false, true);
                    U7:
                    Hq:
                    goto Vw;
            }
            Cr:
            Vw:
            wK:
        }
        bD:
        return $If;
    }
    public function locateKeyInfo($If = null, $y5 = null)
    {
        if (!empty($y5)) {
            goto Kt;
        }
        $y5 = $this->rawNode;
        Kt:
        return self::staticLocateKeyInfo($If, $y5);
    }
}
