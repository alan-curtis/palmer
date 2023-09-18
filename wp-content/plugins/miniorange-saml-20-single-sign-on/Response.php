<?php


include "\101\x73\x73\x65\x72\x74\151\157\x6e\56\160\150\160";
class SAML2SPResponse
{
    private $assertions;
    private $destination;
    private $certificates;
    private $signatureData;
    public function __construct(DOMElement $tW = NULL, $pW)
    {
        $this->assertions = array();
        $this->certificates = array();
        if (!($tW === NULL)) {
            goto tvH;
        }
        return;
        tvH:
        $la = SAMLSPUtilities::validateElement($tW);
        if (!($la !== FALSE)) {
            goto oLs;
        }
        $this->certificates = $la["\103\145\x72\x74\x69\146\x69\143\141\164\145\163"];
        $this->signatureData = $la;
        oLs:
        if (!$tW->hasAttribute("\104\x65\x73\x74\151\156\x61\x74\x69\x6f\x6e")) {
            goto ZmO;
        }
        $this->destination = $tW->getAttribute("\x44\145\x73\164\x69\156\141\x74\151\x6f\x6e");
        ZmO:
        $y5 = $tW->firstChild;
        LOI:
        if (!($y5 !== NULL)) {
            goto Z8f;
        }
        if (!($y5->namespaceURI !== "\165\162\156\x3a\157\141\x73\x69\163\x3a\x6e\141\x6d\x65\163\x3a\164\x63\72\x53\x41\x4d\x4c\72\x32\x2e\60\x3a\141\x73\x73\x65\x72\x74\151\x6f\156")) {
            goto VAV;
        }
        goto eUO;
        VAV:
        if (!($y5->localName === "\x41\x73\x73\145\162\x74\151\x6f\156" || $y5->localName === "\x45\156\143\162\171\160\164\145\144\x41\x73\x73\x65\162\164\x69\157\156")) {
            goto BMh;
        }
        $this->assertions[] = new SAML2SPAssertion($y5, $pW);
        BMh:
        eUO:
        $y5 = $y5->nextSibling;
        goto LOI;
        Z8f:
    }
    public function getAssertions()
    {
        return $this->assertions;
    }
    public function setAssertions(array $qF)
    {
        $this->assertions = $qF;
    }
    public function getDestination()
    {
        return $this->destination;
    }
    public function getCertificates()
    {
        return $this->certificates;
    }
    public function getSignatureData()
    {
        return $this->signatureData;
    }
}
