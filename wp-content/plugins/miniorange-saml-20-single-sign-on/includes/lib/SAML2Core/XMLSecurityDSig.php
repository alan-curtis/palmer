<?php


namespace RobRichards\XMLSecLibs;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;
use Exception;
use RobRichards\XMLSecLibs\Utils\XPath as XPath;
class XMLSecurityDSig
{
    const XMLDSIGNS = "\x68\x74\164\160\x3a\x2f\x2f\167\x77\167\x2e\167\x33\x2e\157\x72\x67\57\x32\60\60\x30\x2f\x30\71\57\x78\x6d\154\144\x73\151\x67\x23";
    const SHA1 = "\150\164\164\160\x3a\x2f\x2f\x77\167\x77\x2e\167\63\x2e\157\x72\147\57\x32\x30\x30\60\x2f\60\x39\57\x78\155\x6c\144\163\x69\147\43\x73\150\x61\61";
    const SHA256 = "\150\164\164\160\72\57\x2f\167\167\x77\x2e\x77\63\x2e\x6f\162\147\57\x32\x30\60\61\x2f\60\x34\57\170\155\154\145\x6e\x63\x23\163\150\141\62\65\66";
    const SHA384 = "\x68\164\164\x70\x3a\57\57\x77\167\x77\x2e\167\63\x2e\157\x72\147\x2f\x32\x30\60\x31\x2f\60\64\x2f\170\x6d\154\144\163\151\x67\55\155\157\x72\145\x23\x73\x68\141\63\x38\64";
    const SHA512 = "\x68\164\x74\160\72\x2f\x2f\x77\167\x77\x2e\x77\63\x2e\157\x72\147\57\x32\x30\60\x31\57\x30\64\57\170\155\154\x65\156\143\x23\163\150\141\x35\x31\62";
    const RIPEMD160 = "\x68\164\164\160\72\57\57\167\x77\167\x2e\167\x33\x2e\x6f\162\147\57\x32\x30\x30\x31\57\x30\64\x2f\170\x6d\x6c\145\156\x63\x23\162\x69\x70\x65\x6d\x64\61\66\x30";
    const C14N = "\150\x74\x74\160\x3a\57\x2f\167\x77\x77\x2e\167\63\x2e\157\162\x67\x2f\124\122\57\62\60\60\x31\x2f\x52\105\103\x2d\170\155\154\55\143\61\64\x6e\55\62\x30\60\x31\60\x33\61\65";
    const C14N_COMMENTS = "\150\x74\164\x70\x3a\x2f\57\167\x77\x77\x2e\x77\63\x2e\x6f\162\x67\57\124\x52\57\x32\x30\60\x31\x2f\x52\105\103\55\x78\x6d\154\x2d\143\x31\x34\156\x2d\62\60\60\x31\x30\x33\61\x35\43\127\x69\x74\150\x43\157\155\x6d\x65\x6e\164\163";
    const EXC_C14N = "\150\164\x74\160\x3a\x2f\57\x77\167\x77\56\167\x33\56\157\162\147\57\x32\x30\60\61\x2f\x31\x30\x2f\170\x6d\x6c\55\x65\170\x63\x2d\x63\61\x34\156\x23";
    const EXC_C14N_COMMENTS = "\x68\164\164\x70\72\x2f\57\x77\167\167\56\x77\63\x2e\157\162\147\57\x32\x30\60\x31\x2f\61\60\57\x78\x6d\x6c\55\145\x78\143\x2d\143\x31\64\x6e\x23\127\x69\x74\150\x43\157\155\155\x65\x6e\x74\163";
    const template = "\74\x64\163\72\x53\x69\147\156\x61\x74\x75\x72\x65\x20\170\155\154\x6e\x73\x3a\144\163\x3d\x22\150\x74\x74\x70\x3a\57\x2f\x77\x77\167\56\167\63\x2e\157\x72\147\57\62\x30\x30\x30\x2f\x30\x39\x2f\170\155\x6c\x64\163\151\x67\x23\42\76\15\12\x20\40\x3c\144\163\x3a\123\x69\x67\x6e\145\144\111\156\x66\x6f\76\xd\12\x20\x20\40\40\x3c\x64\x73\72\123\x69\147\x6e\x61\164\x75\x72\x65\x4d\145\x74\150\157\144\x20\57\x3e\15\xa\x20\40\x3c\x2f\144\163\x3a\x53\x69\x67\x6e\145\x64\111\156\146\157\x3e\15\xa\x3c\x2f\144\x73\x3a\x53\x69\x67\x6e\141\x74\165\162\145\76";
    const BASE_TEMPLATE = "\x3c\x53\151\147\156\141\164\x75\x72\145\40\x78\155\154\x6e\x73\75\x22\150\164\x74\x70\72\x2f\x2f\167\x77\x77\56\167\63\56\x6f\x72\x67\x2f\x32\x30\x30\x30\x2f\60\71\57\170\155\154\x64\163\x69\x67\43\42\x3e\xd\12\40\x20\74\123\x69\x67\156\x65\x64\x49\156\x66\157\x3e\xd\xa\x20\x20\x20\40\74\x53\151\147\x6e\141\164\165\162\145\x4d\145\x74\x68\157\x64\40\57\x3e\xd\12\40\x20\74\57\x53\x69\x67\156\x65\x64\x49\x6e\x66\157\76\xd\12\x3c\x2f\x53\x69\147\156\x61\164\165\x72\145\76";
    public $sigNode = null;
    public $idKeys = array();
    public $idNS = array();
    private $signedInfo = null;
    private $xPathCtx = null;
    private $canonicalMethod = null;
    private $prefix = '';
    private $searchpfx = "\x73\145\x63\x64\163\151\x67";
    private $validatedNodes = null;
    public function __construct($Kb = "\144\x73")
    {
        $My = self::BASE_TEMPLATE;
        if (empty($Kb)) {
            goto LF;
        }
        $this->prefix = $Kb . "\72";
        $IU = array("\74\x53", "\74\57\123", "\170\155\154\156\x73\x3d");
        $IM = array("\x3c{$Kb}\x3a\x53", "\x3c\57{$Kb}\x3a\x53", "\x78\x6d\x6c\x6e\x73\72{$Kb}\x3d");
        $My = str_replace($IU, $IM, $My);
        LF:
        $B3 = new DOMDocument();
        $B3->loadXML($My);
        $this->sigNode = $B3->documentElement;
    }
    private function resetXPathObj()
    {
        $this->xPathCtx = null;
    }
    private function getXPathObj()
    {
        if (!(empty($this->xPathCtx) && !empty($this->sigNode))) {
            goto KG;
        }
        $eR = new DOMXPath($this->sigNode->ownerDocument);
        $eR->registerNamespace("\x73\x65\143\144\x73\x69\147", self::XMLDSIGNS);
        $this->xPathCtx = $eR;
        KG:
        return $this->xPathCtx;
    }
    public static function generateGUID($Kb = "\160\x66\x78")
    {
        $uN = md5(uniqid(mt_rand(), true));
        $Pc = $Kb . substr($uN, 0, 8) . "\x2d" . substr($uN, 8, 4) . "\55" . substr($uN, 12, 4) . "\x2d" . substr($uN, 16, 4) . "\55" . substr($uN, 20, 12);
        return $Pc;
    }
    public static function generate_GUID($Kb = "\x70\x66\x78")
    {
        return self::generateGUID($Kb);
    }
    public function locateSignature($zB, $ti = 0)
    {
        if ($zB instanceof DOMDocument) {
            goto fc;
        }
        $ra = $zB->ownerDocument;
        goto a2;
        fc:
        $ra = $zB;
        a2:
        if (!$ra) {
            goto us;
        }
        $eR = new DOMXPath($ra);
        $eR->registerNamespace("\163\145\143\x64\163\151\x67", self::XMLDSIGNS);
        $k0 = "\x2e\x2f\57\x73\145\x63\x64\x73\151\147\72\x53\151\x67\156\141\x74\x75\x72\x65";
        $ym = $eR->query($k0, $zB);
        $this->sigNode = $ym->item($ti);
        $k0 = "\x2e\57\x73\x65\x63\x64\x73\x69\147\x3a\x53\x69\147\x6e\145\x64\x49\x6e\146\x6f";
        $ym = $eR->query($k0, $this->sigNode);
        if (!($ym->length > 1)) {
            goto KF;
        }
        throw new Exception("\111\156\166\141\154\x69\144\40\163\164\162\165\x63\x74\x75\x72\x65\40\55\40\124\157\x6f\x20\155\x61\156\x79\40\123\151\147\x6e\x65\x64\111\156\146\157\x20\x65\x6c\x65\x6d\x65\x6e\x74\x73\40\x66\157\165\x6e\144");
        KF:
        return $this->sigNode;
        us:
        return null;
    }
    public function createNewSignNode($Jh, $nj = null)
    {
        $ra = $this->sigNode->ownerDocument;
        if (!is_null($nj)) {
            goto n_;
        }
        $y5 = $ra->createElementNS(self::XMLDSIGNS, $this->prefix . $Jh);
        goto pM;
        n_:
        $y5 = $ra->createElementNS(self::XMLDSIGNS, $this->prefix . $Jh, $nj);
        pM:
        return $y5;
    }
    public function setCanonicalMethod($Uc)
    {
        switch ($Uc) {
            case "\x68\164\x74\160\x3a\57\57\x77\x77\167\56\x77\x33\56\157\x72\x67\57\124\x52\x2f\62\60\60\x31\57\122\105\x43\x2d\x78\155\154\x2d\143\61\x34\156\55\62\60\60\61\x30\63\61\65":
            case "\150\x74\164\x70\72\x2f\x2f\167\x77\x77\56\x77\63\56\x6f\x72\x67\57\x54\x52\57\62\60\x30\x31\x2f\x52\105\103\x2d\170\155\x6c\55\x63\61\64\156\x2d\62\60\x30\x31\x30\x33\x31\x35\43\127\x69\164\150\x43\157\x6d\x6d\x65\x6e\x74\x73":
            case "\150\x74\164\x70\x3a\x2f\57\167\167\x77\56\x77\63\56\x6f\162\147\x2f\x32\60\60\x31\x2f\x31\x30\x2f\170\155\x6c\55\145\x78\x63\55\143\x31\x34\x6e\x23":
            case "\150\x74\164\160\x3a\x2f\57\x77\167\x77\x2e\167\63\x2e\157\x72\x67\x2f\62\x30\x30\x31\x2f\x31\x30\57\170\155\x6c\x2d\145\x78\143\55\x63\61\x34\156\x23\127\x69\164\x68\x43\x6f\x6d\155\145\156\164\x73":
                $this->canonicalMethod = $Uc;
                goto wm;
            default:
                throw new Exception("\111\x6e\166\141\x6c\151\x64\40\x43\x61\156\157\156\151\143\141\154\x20\x4d\x65\164\x68\x6f\144");
        }
        IP:
        wm:
        if (!($eR = $this->getXPathObj())) {
            goto qk;
        }
        $k0 = "\x2e\57" . $this->searchpfx . "\x3a\x53\151\x67\x6e\x65\144\x49\x6e\x66\157";
        $ym = $eR->query($k0, $this->sigNode);
        if (!($to = $ym->item(0))) {
            goto zi;
        }
        $k0 = "\56\x2f" . $this->searchpfx . "\x43\141\x6e\x6f\156\151\x63\141\154\x69\x7a\x61\164\x69\157\156\115\x65\164\150\x6f\144";
        $ym = $eR->query($k0, $to);
        if ($wB = $ym->item(0)) {
            goto Ys;
        }
        $wB = $this->createNewSignNode("\103\x61\156\157\x6e\151\x63\x61\154\x69\172\x61\164\151\157\x6e\x4d\x65\x74\x68\x6f\x64");
        $to->insertBefore($wB, $to->firstChild);
        Ys:
        $wB->setAttribute("\101\x6c\x67\x6f\x72\x69\x74\150\x6d", $this->canonicalMethod);
        zi:
        qk:
    }
    private function canonicalizeData($y5, $v1, $as = null, $AN = null)
    {
        $La = false;
        $Bm = false;
        switch ($v1) {
            case "\150\164\x74\x70\72\57\x2f\x77\x77\167\x2e\x77\x33\56\157\x72\147\57\x54\122\x2f\62\60\x30\x31\57\122\105\103\55\170\x6d\154\55\143\x31\x34\x6e\x2d\62\60\60\x31\60\63\61\x35":
                $La = false;
                $Bm = false;
                goto Jd;
            case "\x68\164\164\x70\72\x2f\57\x77\x77\x77\x2e\x77\63\x2e\157\x72\147\57\x54\122\x2f\62\60\60\x31\x2f\x52\x45\103\55\170\x6d\154\x2d\143\x31\64\x6e\55\x32\60\60\x31\x30\63\x31\x35\43\127\151\x74\x68\103\157\x6d\155\x65\156\x74\x73":
                $Bm = true;
                goto Jd;
            case "\x68\x74\164\x70\72\57\x2f\x77\x77\167\x2e\x77\63\56\x6f\x72\147\x2f\x32\60\x30\x31\57\61\x30\57\x78\x6d\x6c\x2d\145\170\x63\x2d\143\x31\x34\x6e\x23":
                $La = true;
                goto Jd;
            case "\150\164\164\160\72\x2f\57\x77\x77\x77\x2e\167\63\x2e\x6f\162\147\57\62\60\60\61\57\61\60\x2f\x78\x6d\154\55\x65\170\143\55\x63\x31\64\156\x23\x57\x69\164\x68\x43\157\155\x6d\145\x6e\164\163":
                $La = true;
                $Bm = true;
                goto Jd;
        }
        Xr:
        Jd:
        if (!(is_null($as) && $y5 instanceof DOMNode && $y5->ownerDocument !== null && $y5->isSameNode($y5->ownerDocument->documentElement))) {
            goto xy;
        }
        $Ba = $y5;
        L5:
        if (!($hI = $Ba->previousSibling)) {
            goto zm;
        }
        if (!($hI->nodeType == XML_PI_NODE || $hI->nodeType == XML_COMMENT_NODE && $Bm)) {
            goto Hm;
        }
        goto zm;
        Hm:
        $Ba = $hI;
        goto L5;
        zm:
        if (!($hI == null)) {
            goto I6;
        }
        $y5 = $y5->ownerDocument;
        I6:
        xy:
        return $y5->C14N($La, $Bm, $as, $AN);
    }
    public function canonicalizeSignedInfo()
    {
        $ra = $this->sigNode->ownerDocument;
        $v1 = null;
        if (!$ra) {
            goto UV;
        }
        $eR = $this->getXPathObj();
        $k0 = "\56\x2f\163\145\x63\x64\163\x69\x67\72\x53\x69\x67\x6e\145\144\111\x6e\x66\x6f";
        $ym = $eR->query($k0, $this->sigNode);
        if (!($ym->length > 1)) {
            goto Sl;
        }
        throw new Exception("\x49\156\166\x61\154\x69\x64\40\x73\x74\162\x75\143\x74\x75\x72\145\x20\55\x20\124\157\157\40\155\x61\156\x79\40\123\x69\147\156\x65\144\111\x6e\146\157\x20\145\154\x65\155\x65\156\164\x73\x20\146\x6f\x75\x6e\144");
        Sl:
        if (!($NT = $ym->item(0))) {
            goto wc;
        }
        $k0 = "\x2e\57\163\x65\143\x64\x73\151\147\x3a\103\141\156\157\x6e\151\x63\141\154\x69\x7a\141\164\x69\157\x6e\x4d\x65\x74\150\x6f\144";
        $ym = $eR->query($k0, $NT);
        $AN = null;
        if (!($wB = $ym->item(0))) {
            goto PU;
        }
        $v1 = $wB->getAttribute("\101\x6c\147\x6f\x72\x69\x74\150\155");
        foreach ($wB->childNodes as $y5) {
            if (!($y5->localName == "\x49\x6e\x63\x6c\x75\x73\151\166\145\x4e\x61\x6d\x65\x73\160\x61\143\145\x73")) {
                goto R2;
            }
            if (!($IQ = $y5->getAttribute("\x50\x72\x65\146\151\170\114\x69\163\164"))) {
                goto E5;
            }
            $FB = array_filter(explode("\40", $IQ));
            if (!(count($FB) > 0)) {
                goto El;
            }
            $AN = array_merge($AN ? $AN : array(), $FB);
            El:
            E5:
            R2:
            FX:
        }
        OJ:
        PU:
        $this->signedInfo = $this->canonicalizeData($NT, $v1, null, $AN);
        return $this->signedInfo;
        wc:
        UV:
        return null;
    }
    public function calculateDigest($Jy, $h6, $SU = true)
    {
        switch ($Jy) {
            case self::SHA1:
                $hL = "\163\x68\141\61";
                goto xW;
            case self::SHA256:
                $hL = "\163\150\141\x32\65\66";
                goto xW;
            case self::SHA384:
                $hL = "\163\x68\x61\x33\x38\64";
                goto xW;
            case self::SHA512:
                $hL = "\163\150\141\65\x31\62";
                goto xW;
            case self::RIPEMD160:
                $hL = "\162\151\x70\x65\155\144\61\66\x30";
                goto xW;
            default:
                throw new Exception("\103\141\156\156\x6f\x74\x20\x76\x61\x6c\151\144\141\x74\x65\x20\x64\151\147\x65\x73\164\72\x20\x55\x6e\x73\x75\x70\160\157\x72\x74\145\x64\x20\x41\x6c\147\157\162\151\x74\x68\155\x20\74{$Jy}\76");
        }
        FU:
        xW:
        $s6 = hash($hL, $h6, true);
        if (!$SU) {
            goto OO;
        }
        $s6 = base64_encode($s6);
        OO:
        return $s6;
    }
    public function validateDigest($d4, $h6)
    {
        $eR = new DOMXPath($d4->ownerDocument);
        $eR->registerNamespace("\163\x65\143\144\x73\151\147", self::XMLDSIGNS);
        $k0 = "\x73\x74\162\x69\x6e\x67\50\56\x2f\163\x65\x63\144\163\x69\x67\72\x44\151\147\x65\x73\x74\x4d\x65\x74\x68\157\x64\x2f\100\101\154\147\157\162\151\x74\150\155\x29";
        $Jy = $eR->evaluate($k0, $d4);
        $kY = $this->calculateDigest($Jy, $h6, false);
        $k0 = "\163\x74\162\151\x6e\x67\50\x2e\57\163\145\143\x64\163\151\x67\72\x44\x69\147\145\163\x74\x56\x61\x6c\x75\x65\x29";
        $lZ = $eR->evaluate($k0, $d4);
        return $kY === base64_decode($lZ);
    }
    public function processTransforms($d4, $TM, $Sz = true)
    {
        $h6 = $TM;
        $eR = new DOMXPath($d4->ownerDocument);
        $eR->registerNamespace("\x73\x65\x63\x64\163\151\x67", self::XMLDSIGNS);
        $k0 = "\56\57\x73\x65\x63\144\x73\151\147\x3a\124\162\x61\x6e\163\x66\157\x72\155\x73\57\163\x65\x63\x64\163\x69\x67\x3a\x54\162\x61\156\163\x66\x6f\x72\155";
        $zD = $eR->query($k0, $d4);
        $Te = "\150\164\164\x70\72\x2f\57\x77\x77\x77\x2e\x77\x33\x2e\157\x72\147\x2f\124\x52\57\x32\x30\60\61\57\122\x45\x43\55\170\x6d\x6c\x2d\143\61\x34\x6e\55\x32\60\x30\61\x30\x33\61\65";
        $as = null;
        $AN = null;
        foreach ($zD as $U2) {
            $q1 = $U2->getAttribute("\x41\154\147\157\x72\x69\164\150\x6d");
            switch ($q1) {
                case "\x68\164\x74\160\72\x2f\57\167\167\167\x2e\x77\x33\x2e\x6f\x72\147\x2f\62\60\60\61\57\x31\60\x2f\170\x6d\x6c\x2d\x65\170\x63\55\143\x31\64\x6e\43":
                case "\x68\164\x74\160\x3a\x2f\57\167\x77\167\56\167\63\56\x6f\x72\147\x2f\x32\60\60\61\57\x31\x30\x2f\170\x6d\154\55\145\x78\x63\55\x63\x31\x34\156\43\127\151\x74\x68\x43\157\x6d\155\x65\x6e\164\x73":
                    if (!$Sz) {
                        goto oc;
                    }
                    $Te = $q1;
                    goto Wq;
                    oc:
                    $Te = "\150\164\x74\x70\x3a\57\57\x77\x77\167\x2e\167\x33\56\x6f\162\147\x2f\x32\x30\x30\x31\57\x31\60\x2f\170\x6d\x6c\55\x65\170\x63\x2d\143\x31\x34\156\x23";
                    Wq:
                    $y5 = $U2->firstChild;
                    x0:
                    if (!$y5) {
                        goto fW;
                    }
                    if (!($y5->localName == "\x49\156\143\x6c\x75\163\151\166\x65\116\141\x6d\x65\x73\160\x61\x63\145\x73")) {
                        goto Ch;
                    }
                    if (!($IQ = $y5->getAttribute("\120\x72\145\146\x69\170\x4c\151\163\164"))) {
                        goto gn;
                    }
                    $FB = array();
                    $tZ = explode("\40", $IQ);
                    foreach ($tZ as $IQ) {
                        $sF = trim($IQ);
                        if (empty($sF)) {
                            goto L8;
                        }
                        $FB[] = $sF;
                        L8:
                        gZ:
                    }
                    vN:
                    if (!(count($FB) > 0)) {
                        goto oA;
                    }
                    $AN = $FB;
                    oA:
                    gn:
                    goto fW;
                    Ch:
                    $y5 = $y5->nextSibling;
                    goto x0;
                    fW:
                    goto Kc;
                case "\150\x74\164\x70\x3a\x2f\x2f\x77\x77\167\56\167\x33\56\x6f\x72\x67\x2f\x54\122\x2f\x32\x30\60\61\57\x52\x45\103\55\x78\155\154\x2d\143\x31\64\156\55\62\60\60\x31\60\63\61\65":
                case "\150\164\164\160\x3a\x2f\x2f\167\x77\167\56\167\x33\56\x6f\162\147\57\x54\122\57\x32\60\x30\x31\x2f\122\x45\x43\55\x78\155\x6c\55\x63\61\x34\156\55\62\x30\x30\61\60\63\x31\x35\x23\127\151\164\x68\x43\157\x6d\155\x65\156\x74\163":
                    if (!$Sz) {
                        goto Z7;
                    }
                    $Te = $q1;
                    goto x3;
                    Z7:
                    $Te = "\x68\x74\x74\160\72\x2f\57\x77\167\167\56\x77\63\56\x6f\162\147\57\124\122\57\x32\60\60\61\x2f\x52\105\x43\55\x78\x6d\x6c\x2d\143\x31\x34\x6e\55\62\x30\x30\x31\x30\63\x31\x35";
                    x3:
                    goto Kc;
                case "\150\x74\164\160\72\x2f\57\x77\x77\x77\x2e\x77\63\x2e\x6f\x72\147\57\x54\122\x2f\61\x39\x39\x39\57\122\x45\x43\x2d\170\x70\141\x74\x68\x2d\x31\x39\71\71\x31\61\x31\66":
                    $y5 = $U2->firstChild;
                    QF:
                    if (!$y5) {
                        goto oY;
                    }
                    if (!($y5->localName == "\130\120\x61\164\150")) {
                        goto Ok;
                    }
                    $as = array();
                    $as["\161\x75\x65\x72\171"] = "\50\56\57\57\x2e\x20\174\x20\56\x2f\x2f\100\x2a\40\174\x20\x2e\x2f\x2f\x6e\141\x6d\x65\x73\x70\141\143\145\x3a\x3a\x2a\51\133" . $y5->nodeValue . "\x5d";
                    $as["\156\x61\155\145\163\x70\x61\x63\x65\x73"] = array();
                    $d6 = $eR->query("\56\57\x6e\x61\x6d\145\x73\x70\x61\x63\x65\x3a\72\52", $y5);
                    foreach ($d6 as $Er) {
                        if (!($Er->localName != "\170\x6d\x6c")) {
                            goto VW;
                        }
                        $as["\156\141\x6d\145\163\160\141\x63\145\x73"][$Er->localName] = $Er->nodeValue;
                        VW:
                        ad:
                    }
                    uf:
                    goto oY;
                    Ok:
                    $y5 = $y5->nextSibling;
                    goto QF;
                    oY:
                    goto Kc;
            }
            CY:
            Kc:
            uP:
        }
        wW:
        if (!$h6 instanceof DOMNode) {
            goto gT;
        }
        $h6 = $this->canonicalizeData($TM, $Te, $as, $AN);
        gT:
        return $h6;
    }
    public function processRefNode($d4)
    {
        $xv = null;
        $Sz = true;
        if ($JE = $d4->getAttribute("\125\x52\x49")) {
            goto mw;
        }
        $Sz = false;
        $xv = $d4->ownerDocument;
        goto yh;
        mw:
        $o2 = parse_url($JE);
        if (!empty($o2["\x70\141\164\x68"])) {
            goto RU;
        }
        if ($Ax = $o2["\x66\162\x61\x67\155\x65\x6e\164"]) {
            goto zh;
        }
        $xv = $d4->ownerDocument;
        goto yC;
        zh:
        $Sz = false;
        $Mu = new DOMXPath($d4->ownerDocument);
        if (!($this->idNS && is_array($this->idNS))) {
            goto ma;
        }
        foreach ($this->idNS as $eb => $fE) {
            $Mu->registerNamespace($eb, $fE);
            S2:
        }
        H2:
        ma:
        $PN = "\100\x49\144\75\x22" . XPath::filterAttrValue($Ax, XPath::DOUBLE_QUOTE) . "\42";
        if (!is_array($this->idKeys)) {
            goto eP;
        }
        foreach ($this->idKeys as $ky) {
            $PN .= "\x20\x6f\x72\40\100" . XPath::filterAttrName($ky) . "\75\x22" . XPath::filterAttrValue($Ax, XPath::DOUBLE_QUOTE) . "\x22";
            jO:
        }
        Ne:
        eP:
        $k0 = "\57\x2f\x2a\x5b" . $PN . "\x5d";
        $xv = $Mu->query($k0)->item(0);
        yC:
        RU:
        yh:
        $h6 = $this->processTransforms($d4, $xv, $Sz);
        if ($this->validateDigest($d4, $h6)) {
            goto qy;
        }
        return false;
        qy:
        if (!$xv instanceof DOMNode) {
            goto G3;
        }
        if (!empty($Ax)) {
            goto qt;
        }
        $this->validatedNodes[] = $xv;
        goto oh;
        qt:
        $this->validatedNodes[$Ax] = $xv;
        oh:
        G3:
        return true;
    }
    public function getRefNodeID($d4)
    {
        if (!($JE = $d4->getAttribute("\x55\x52\111"))) {
            goto y1;
        }
        $o2 = parse_url($JE);
        if (!empty($o2["\x70\141\164\x68"])) {
            goto kK;
        }
        if (!($Ax = $o2["\146\162\x61\147\x6d\145\x6e\x74"])) {
            goto qD;
        }
        return $Ax;
        qD:
        kK:
        y1:
        return null;
    }
    public function getRefIDs()
    {
        $mr = array();
        $eR = $this->getXPathObj();
        $k0 = "\x2e\57\163\x65\143\144\163\x69\x67\x3a\x53\x69\147\x6e\145\x64\111\x6e\x66\x6f\133\61\135\x2f\x73\x65\x63\144\163\x69\x67\x3a\122\145\x66\x65\162\x65\156\143\145";
        $ym = $eR->query($k0, $this->sigNode);
        if (!($ym->length == 0)) {
            goto xd;
        }
        throw new Exception("\x52\145\x66\145\162\145\156\143\x65\40\x6e\x6f\144\145\x73\x20\x6e\x6f\x74\x20\146\x6f\x75\156\x64");
        xd:
        foreach ($ym as $d4) {
            $mr[] = $this->getRefNodeID($d4);
            vK:
        }
        V3:
        return $mr;
    }
    public function validateReference()
    {
        $il = $this->sigNode->ownerDocument->documentElement;
        if ($il->isSameNode($this->sigNode)) {
            goto im;
        }
        if (!($this->sigNode->parentNode != null)) {
            goto TM;
        }
        $this->sigNode->parentNode->removeChild($this->sigNode);
        TM:
        im:
        $eR = $this->getXPathObj();
        $k0 = "\56\57\x73\145\x63\144\x73\151\147\x3a\123\x69\x67\156\x65\144\x49\156\x66\x6f\x5b\x31\x5d\57\163\145\x63\x64\x73\x69\147\x3a\122\145\x66\145\x72\145\156\143\145";
        $ym = $eR->query($k0, $this->sigNode);
        if (!($ym->length == 0)) {
            goto db;
        }
        throw new Exception("\x52\145\146\x65\x72\x65\x6e\143\x65\40\x6e\x6f\x64\145\x73\x20\156\157\x74\40\146\157\165\156\144");
        db:
        $this->validatedNodes = array();
        foreach ($ym as $d4) {
            if ($this->processRefNode($d4)) {
                goto m3;
            }
            $this->validatedNodes = null;
            throw new Exception("\x52\x65\x66\145\x72\x65\156\x63\145\40\x76\x61\154\151\x64\141\x74\151\157\156\40\x66\141\151\154\145\x64");
            m3:
            ZK:
        }
        L4:
        return true;
    }
    private function addRefInternal($O8, $y5, $q1, $qS = null, $CX = null)
    {
        $Kb = null;
        $R_ = null;
        $MG = "\111\144";
        $hn = true;
        $xc = false;
        if (!is_array($CX)) {
            goto At;
        }
        $Kb = empty($CX["\160\162\145\x66\151\x78"]) ? null : $CX["\x70\x72\145\x66\151\170"];
        $R_ = empty($CX["\x70\162\145\146\x69\170\x5f\156\163"]) ? null : $CX["\x70\x72\145\146\x69\170\x5f\x6e\163"];
        $MG = empty($CX["\x69\x64\137\156\141\x6d\145"]) ? "\x49\x64" : $CX["\x69\x64\137\x6e\141\x6d\145"];
        $hn = !isset($CX["\x6f\166\x65\x72\x77\x72\x69\x74\x65"]) ? true : (bool) $CX["\157\x76\x65\x72\167\x72\x69\164\145"];
        $xc = !isset($CX["\x66\x6f\x72\x63\x65\x5f\x75\x72\151"]) ? false : (bool) $CX["\x66\157\162\x63\145\x5f\165\162\151"];
        At:
        $x1 = $MG;
        if (empty($Kb)) {
            goto kS;
        }
        $x1 = $Kb . "\x3a" . $x1;
        kS:
        $d4 = $this->createNewSignNode("\x52\x65\146\x65\162\145\x6e\x63\145");
        $O8->appendChild($d4);
        if (!$y5 instanceof DOMDocument) {
            goto Qr;
        }
        if ($xc) {
            goto gb;
        }
        goto Ky;
        Qr:
        $JE = null;
        if ($hn) {
            goto st;
        }
        $JE = $R_ ? $y5->getAttributeNS($R_, $MG) : $y5->getAttribute($MG);
        st:
        if (!empty($JE)) {
            goto IR;
        }
        $JE = self::generateGUID();
        $y5->setAttributeNS($R_, $x1, $JE);
        IR:
        $d4->setAttribute("\125\122\x49", "\43" . $JE);
        goto Ky;
        gb:
        $d4->setAttribute("\x55\122\x49", '');
        Ky:
        $Hw = $this->createNewSignNode("\x54\162\141\x6e\163\146\x6f\x72\155\163");
        $d4->appendChild($Hw);
        if (is_array($qS)) {
            goto MD;
        }
        if (!empty($this->canonicalMethod)) {
            goto ll;
        }
        goto ws;
        MD:
        foreach ($qS as $U2) {
            $c0 = $this->createNewSignNode("\x54\x72\141\156\x73\146\157\162\x6d");
            $Hw->appendChild($c0);
            if (is_array($U2) && !empty($U2["\150\164\164\160\x3a\57\x2f\x77\x77\x77\56\167\63\x2e\x6f\162\x67\57\124\x52\57\61\x39\71\71\57\x52\105\x43\55\170\160\x61\164\x68\55\x31\71\71\x39\61\61\x31\x36"]) && !empty($U2["\150\x74\164\x70\x3a\57\x2f\x77\167\167\56\167\x33\56\x6f\162\147\x2f\124\x52\x2f\x31\x39\x39\71\x2f\x52\x45\103\55\x78\160\x61\164\x68\x2d\61\71\x39\x39\61\x31\x31\x36"]["\x71\x75\145\162\171"])) {
                goto Mg;
            }
            $c0->setAttribute("\101\154\147\157\162\151\x74\x68\155", $U2);
            goto i9;
            Mg:
            $c0->setAttribute("\x41\154\147\x6f\x72\x69\164\x68\155", "\x68\x74\164\x70\72\57\x2f\167\x77\x77\x2e\167\63\56\157\162\147\57\x54\x52\57\x31\71\x39\x39\x2f\x52\105\x43\55\x78\160\141\164\150\x2d\x31\71\71\x39\x31\x31\x31\66");
            $RU = $this->createNewSignNode("\x58\120\x61\164\x68", $U2["\150\x74\164\x70\x3a\57\x2f\x77\x77\x77\x2e\167\63\56\157\162\x67\57\x54\122\x2f\61\71\x39\x39\x2f\122\105\103\x2d\170\x70\x61\164\x68\x2d\x31\x39\x39\71\x31\x31\61\x36"]["\161\165\x65\162\171"]);
            $c0->appendChild($RU);
            if (empty($U2["\150\x74\164\x70\x3a\x2f\57\167\167\x77\x2e\x77\x33\x2e\x6f\x72\147\x2f\124\122\x2f\x31\71\x39\x39\x2f\122\105\x43\x2d\x78\x70\x61\164\150\x2d\x31\71\x39\x39\x31\x31\x31\66"]["\x6e\x61\155\x65\163\x70\x61\x63\x65\x73"])) {
                goto Dz;
            }
            foreach ($U2["\150\164\x74\x70\x3a\x2f\57\x77\167\x77\x2e\x77\x33\x2e\x6f\x72\147\x2f\124\x52\x2f\x31\71\x39\x39\57\122\105\103\x2d\x78\160\x61\x74\x68\55\61\x39\x39\x39\x31\x31\x31\66"]["\156\141\x6d\x65\x73\x70\x61\143\145\x73"] as $Kb => $uP) {
                $RU->setAttributeNS("\x68\x74\164\x70\72\x2f\57\167\x77\167\x2e\x77\63\x2e\x6f\x72\147\x2f\x32\x30\60\x30\57\170\x6d\x6c\156\163\57", "\x78\x6d\154\156\163\72{$Kb}", $uP);
                hA:
            }
            Zm:
            Dz:
            i9:
            gk:
        }
        it:
        goto ws;
        ll:
        $c0 = $this->createNewSignNode("\x54\162\141\x6e\x73\146\157\162\x6d");
        $Hw->appendChild($c0);
        $c0->setAttribute("\x41\x6c\x67\x6f\x72\151\164\x68\x6d", $this->canonicalMethod);
        ws:
        $aD = $this->processTransforms($d4, $y5);
        $kY = $this->calculateDigest($q1, $aD);
        $Lw = $this->createNewSignNode("\x44\151\147\145\163\x74\115\x65\x74\150\x6f\x64");
        $d4->appendChild($Lw);
        $Lw->setAttribute("\x41\x6c\x67\157\x72\x69\x74\150\x6d", $q1);
        $lZ = $this->createNewSignNode("\x44\x69\147\145\163\x74\126\141\154\165\145", $kY);
        $d4->appendChild($lZ);
    }
    public function addReference($y5, $q1, $qS = null, $CX = null)
    {
        if (!($eR = $this->getXPathObj())) {
            goto J_;
        }
        $k0 = "\56\x2f\x73\145\143\x64\x73\151\147\72\x53\151\147\x6e\145\144\111\156\x66\x6f";
        $ym = $eR->query($k0, $this->sigNode);
        if (!($pN = $ym->item(0))) {
            goto jq;
        }
        $this->addRefInternal($pN, $y5, $q1, $qS, $CX);
        jq:
        J_:
    }
    public function addReferenceList($bj, $q1, $qS = null, $CX = null)
    {
        if (!($eR = $this->getXPathObj())) {
            goto qT;
        }
        $k0 = "\x2e\57\x73\145\143\144\x73\151\x67\72\123\x69\x67\x6e\x65\x64\x49\156\x66\157";
        $ym = $eR->query($k0, $this->sigNode);
        if (!($pN = $ym->item(0))) {
            goto WP;
        }
        foreach ($bj as $y5) {
            $this->addRefInternal($pN, $y5, $q1, $qS, $CX);
            aX:
        }
        vw:
        WP:
        qT:
    }
    public function addObject($h6, $mD = null, $Rm = null)
    {
        $xH = $this->createNewSignNode("\x4f\142\152\x65\x63\x74");
        $this->sigNode->appendChild($xH);
        if (empty($mD)) {
            goto Vg;
        }
        $xH->setAttribute("\115\151\x6d\145\124\x79\x70\145", $mD);
        Vg:
        if (empty($Rm)) {
            goto Ly;
        }
        $xH->setAttribute("\105\x6e\143\x6f\x64\x69\156\147", $Rm);
        Ly:
        if ($h6 instanceof DOMElement) {
            goto Nx;
        }
        $PI = $this->sigNode->ownerDocument->createTextNode($h6);
        goto o7;
        Nx:
        $PI = $this->sigNode->ownerDocument->importNode($h6, true);
        o7:
        $xH->appendChild($PI);
        return $xH;
    }
    public function locateKey($y5 = null)
    {
        if (!empty($y5)) {
            goto Rj;
        }
        $y5 = $this->sigNode;
        Rj:
        if ($y5 instanceof DOMNode) {
            goto c0;
        }
        return null;
        c0:
        if (!($ra = $y5->ownerDocument)) {
            goto ob;
        }
        $eR = new DOMXPath($ra);
        $eR->registerNamespace("\x73\145\x63\x64\163\151\x67", self::XMLDSIGNS);
        $k0 = "\x73\164\x72\151\156\x67\x28\56\x2f\x73\145\x63\144\163\151\x67\72\x53\151\x67\156\145\144\x49\x6e\x66\x6f\x2f\163\145\143\144\163\x69\147\72\x53\151\x67\x6e\x61\x74\165\x72\x65\115\x65\164\x68\157\144\x2f\x40\101\154\147\x6f\162\x69\164\150\x6d\51";
        $q1 = $eR->evaluate($k0, $y5);
        if (!$q1) {
            goto mv;
        }
        try {
            $X6 = new XMLSecurityKey($q1, array("\164\x79\x70\x65" => "\x70\x75\142\x6c\x69\143"));
        } catch (Exception $zg) {
            return null;
        }
        return $X6;
        mv:
        ob:
        return null;
    }
    public function verify($X6)
    {
        $ra = $this->sigNode->ownerDocument;
        $eR = new DOMXPath($ra);
        $eR->registerNamespace("\163\x65\143\x64\x73\x69\x67", self::XMLDSIGNS);
        $k0 = "\163\x74\x72\151\x6e\147\x28\56\x2f\163\x65\143\x64\x73\151\x67\x3a\x53\x69\x67\x6e\x61\164\165\x72\x65\x56\x61\154\x75\x65\51";
        $TY = $eR->evaluate($k0, $this->sigNode);
        if (!empty($TY)) {
            goto Od;
        }
        throw new Exception("\125\x6e\x61\142\x6c\x65\40\x74\157\40\x6c\x6f\x63\x61\x74\145\40\x53\151\147\156\141\x74\165\162\145\126\x61\154\165\x65");
        Od:
        return $X6->verifySignature($this->signedInfo, base64_decode($TY));
    }
    public function signData($X6, $h6)
    {
        return $X6->signData($h6);
    }
    public function sign($X6, $oQ = null)
    {
        if (!($oQ != null)) {
            goto yq;
        }
        $this->resetXPathObj();
        $this->appendSignature($oQ);
        $this->sigNode = $oQ->lastChild;
        yq:
        if (!($eR = $this->getXPathObj())) {
            goto yb;
        }
        $k0 = "\56\57\163\x65\x63\x64\163\151\147\72\x53\x69\147\156\145\x64\111\x6e\x66\x6f";
        $ym = $eR->query($k0, $this->sigNode);
        if (!($pN = $ym->item(0))) {
            goto NA;
        }
        $k0 = "\x2e\x2f\x73\145\x63\x64\x73\151\147\72\x53\151\x67\156\x61\164\165\162\x65\115\145\x74\x68\x6f\x64";
        $ym = $eR->query($k0, $pN);
        $Kq = $ym->item(0);
        $Kq->setAttribute("\101\154\147\x6f\x72\x69\164\150\155", $X6->type);
        $h6 = $this->canonicalizeData($pN, $this->canonicalMethod);
        $TY = base64_encode($this->signData($X6, $h6));
        $Xm = $this->createNewSignNode("\123\151\147\x6e\141\164\165\162\145\x56\141\154\x75\145", $TY);
        if ($A7 = $pN->nextSibling) {
            goto mD;
        }
        $this->sigNode->appendChild($Xm);
        goto ya;
        mD:
        $A7->parentNode->insertBefore($Xm, $A7);
        ya:
        NA:
        yb:
    }
    public function appendCert()
    {
    }
    public function appendKey($X6, $hQ = null)
    {
        $X6->serializeKey($hQ);
    }
    public function insertSignature($y5, $ei = null)
    {
        $Jl = $y5->ownerDocument;
        $e8 = $Jl->importNode($this->sigNode, true);
        if ($ei == null) {
            goto Jj;
        }
        return $y5->insertBefore($e8, $ei);
        goto ms;
        Jj:
        return $y5->insertBefore($e8);
        ms:
    }
    public function appendSignature($XI, $BB = false)
    {
        $ei = $BB ? $XI->firstChild : null;
        return $this->insertSignature($XI, $ei);
    }
    public static function get509XCert($EK, $hH = true)
    {
        $vd = self::staticGet509XCerts($EK, $hH);
        if (empty($vd)) {
            goto sk;
        }
        return $vd[0];
        sk:
        return '';
    }
    public static function staticGet509XCerts($vd, $hH = true)
    {
        if ($hH) {
            goto i7;
        }
        return array($vd);
        goto uY;
        i7:
        $h6 = '';
        $a5 = array();
        $Ei = explode("\12", $vd);
        $FX = false;
        foreach ($Ei as $pa) {
            if (!$FX) {
                goto Db;
            }
            if (!(strncmp($pa, "\x2d\55\55\x2d\55\x45\x4e\x44\x20\103\x45\x52\124\x49\106\111\103\101\x54\x45", 20) == 0)) {
                goto D3;
            }
            $FX = false;
            $a5[] = $h6;
            $h6 = '';
            goto Bd;
            D3:
            $h6 .= trim($pa);
            goto zu;
            Db:
            if (!(strncmp($pa, "\x2d\x2d\x2d\x2d\x2d\x42\105\107\111\x4e\40\103\105\x52\x54\111\x46\111\x43\x41\124\105", 22) == 0)) {
                goto F6;
            }
            $FX = true;
            F6:
            zu:
            Bd:
        }
        nM:
        return $a5;
        uY:
    }
    public static function staticAdd509Cert($gV, $EK, $hH = true, $D7 = false, $eR = null, $CX = null)
    {
        if (!$D7) {
            goto jw;
        }
        $EK = file_get_contents($EK);
        jw:
        if ($gV instanceof DOMElement) {
            goto wP;
        }
        throw new Exception("\111\156\x76\141\154\x69\x64\40\x70\141\x72\x65\156\x74\40\x4e\x6f\x64\x65\x20\x70\141\x72\141\155\145\x74\145\162");
        wP:
        $Y0 = $gV->ownerDocument;
        if (!empty($eR)) {
            goto yi;
        }
        $eR = new DOMXPath($gV->ownerDocument);
        $eR->registerNamespace("\x73\x65\x63\x64\163\x69\147", self::XMLDSIGNS);
        yi:
        $k0 = "\56\57\163\145\x63\x64\x73\x69\x67\72\x4b\145\x79\111\156\146\157";
        $ym = $eR->query($k0, $gV);
        $vC = $ym->item(0);
        $LZ = '';
        if (!$vC) {
            goto Mv;
        }
        $IQ = $vC->lookupPrefix(self::XMLDSIGNS);
        if (empty($IQ)) {
            goto Nr;
        }
        $LZ = $IQ . "\x3a";
        Nr:
        goto JE;
        Mv:
        $IQ = $gV->lookupPrefix(self::XMLDSIGNS);
        if (empty($IQ)) {
            goto nT;
        }
        $LZ = $IQ . "\x3a";
        nT:
        $mR = false;
        $vC = $Y0->createElementNS(self::XMLDSIGNS, $LZ . "\113\145\171\111\x6e\146\x6f");
        $k0 = "\56\x2f\163\x65\143\144\163\x69\x67\72\117\142\x6a\x65\143\164";
        $ym = $eR->query($k0, $gV);
        if (!($Td = $ym->item(0))) {
            goto hy;
        }
        $Td->parentNode->insertBefore($vC, $Td);
        $mR = true;
        hy:
        if ($mR) {
            goto gW;
        }
        $gV->appendChild($vC);
        gW:
        JE:
        $vd = self::staticGet509XCerts($EK, $hH);
        $OU = $Y0->createElementNS(self::XMLDSIGNS, $LZ . "\130\65\x30\x39\104\x61\x74\x61");
        $vC->appendChild($OU);
        $Nv = false;
        $Ii = false;
        if (!is_array($CX)) {
            goto RR;
        }
        if (empty($CX["\151\163\x73\x75\x65\162\123\x65\162\151\x61\154"])) {
            goto zg;
        }
        $Nv = true;
        zg:
        if (empty($CX["\163\x75\x62\152\x65\x63\x74\x4e\141\155\x65"])) {
            goto v3;
        }
        $Ii = true;
        v3:
        RR:
        foreach ($vd as $Xp) {
            if (!($Nv || $Ii)) {
                goto T8;
            }
            if (!($Vu = openssl_x509_parse("\x2d\55\55\x2d\x2d\102\x45\107\x49\x4e\x20\103\x45\122\124\111\106\x49\x43\x41\x54\105\55\55\x2d\55\x2d\xa" . chunk_split($Xp, 64, "\xa") . "\55\x2d\x2d\x2d\x2d\x45\x4e\x44\x20\103\105\122\124\x49\x46\111\103\101\124\105\55\55\x2d\x2d\x2d\xa"))) {
                goto Fh;
            }
            if (!($Ii && !empty($Vu["\163\x75\142\x6a\145\143\x74"]))) {
                goto kG;
            }
            if (is_array($Vu["\x73\x75\x62\x6a\x65\x63\164"])) {
                goto aQ;
            }
            $rF = $Vu["\151\x73\x73\165\145\x72"];
            goto H1;
            aQ:
            $jt = array();
            foreach ($Vu["\163\165\142\152\145\143\164"] as $y9 => $nj) {
                if (is_array($nj)) {
                    goto JG;
                }
                array_unshift($jt, "{$y9}\x3d{$nj}");
                goto Gw;
                JG:
                foreach ($nj as $NC) {
                    array_unshift($jt, "{$y9}\75{$NC}");
                    tA:
                }
                Hu:
                Gw:
                HQ:
            }
            zl:
            $rF = implode("\54", $jt);
            H1:
            $v2 = $Y0->createElementNS(self::XMLDSIGNS, $LZ . "\x58\65\x30\71\123\x75\142\152\x65\143\164\x4e\x61\155\145", $rF);
            $OU->appendChild($v2);
            kG:
            if (!($Nv && !empty($Vu["\x69\x73\x73\x75\x65\162"]) && !empty($Vu["\163\145\162\x69\141\154\116\165\x6d\142\145\162"]))) {
                goto n3;
            }
            if (is_array($Vu["\151\163\163\x75\x65\162"])) {
                goto R8;
            }
            $aL = $Vu["\151\163\x73\165\x65\162"];
            goto D0;
            R8:
            $jt = array();
            foreach ($Vu["\x69\x73\163\165\x65\x72"] as $y9 => $nj) {
                array_unshift($jt, "{$y9}\x3d{$nj}");
                BO:
            }
            Qq:
            $aL = implode("\54", $jt);
            D0:
            $sQ = $Y0->createElementNS(self::XMLDSIGNS, $LZ . "\130\65\x30\71\111\163\x73\165\x65\x72\x53\x65\x72\151\141\154");
            $OU->appendChild($sQ);
            $lI = $Y0->createElementNS(self::XMLDSIGNS, $LZ . "\130\65\60\71\x49\163\163\x75\145\162\116\x61\x6d\145", $aL);
            $sQ->appendChild($lI);
            $lI = $Y0->createElementNS(self::XMLDSIGNS, $LZ . "\x58\x35\60\x39\x53\145\162\151\x61\x6c\116\x75\x6d\142\x65\x72", $Vu["\x73\x65\162\151\141\154\116\x75\x6d\x62\145\162"]);
            $sQ->appendChild($lI);
            n3:
            Fh:
            T8:
            $Gs = $Y0->createElementNS(self::XMLDSIGNS, $LZ . "\x58\65\60\x39\103\145\x72\x74\151\146\x69\143\141\164\145", $Xp);
            $OU->appendChild($Gs);
            zE:
        }
        Iu:
    }
    public function add509Cert($EK, $hH = true, $D7 = false, $CX = null)
    {
        if (!($eR = $this->getXPathObj())) {
            goto qN;
        }
        self::staticAdd509Cert($this->sigNode, $EK, $hH, $D7, $eR, $CX);
        qN:
    }
    public function appendToKeyInfo($y5)
    {
        $gV = $this->sigNode;
        $Y0 = $gV->ownerDocument;
        $eR = $this->getXPathObj();
        if (!empty($eR)) {
            goto br;
        }
        $eR = new DOMXPath($gV->ownerDocument);
        $eR->registerNamespace("\163\145\143\x64\163\151\x67", self::XMLDSIGNS);
        br:
        $k0 = "\56\x2f\163\x65\x63\144\163\151\147\x3a\113\x65\x79\x49\x6e\146\157";
        $ym = $eR->query($k0, $gV);
        $vC = $ym->item(0);
        if ($vC) {
            goto uC;
        }
        $LZ = '';
        $IQ = $gV->lookupPrefix(self::XMLDSIGNS);
        if (empty($IQ)) {
            goto Nt;
        }
        $LZ = $IQ . "\x3a";
        Nt:
        $mR = false;
        $vC = $Y0->createElementNS(self::XMLDSIGNS, $LZ . "\x4b\x65\x79\111\x6e\x66\157");
        $k0 = "\56\x2f\x73\145\143\x64\163\151\x67\72\x4f\142\x6a\145\x63\x74";
        $ym = $eR->query($k0, $gV);
        if (!($Td = $ym->item(0))) {
            goto a8;
        }
        $Td->parentNode->insertBefore($vC, $Td);
        $mR = true;
        a8:
        if ($mR) {
            goto nI;
        }
        $gV->appendChild($vC);
        nI:
        uC:
        $vC->appendChild($y5);
        return $vC;
    }
    public function getValidatedNodes()
    {
        return $this->validatedNodes;
    }
}
