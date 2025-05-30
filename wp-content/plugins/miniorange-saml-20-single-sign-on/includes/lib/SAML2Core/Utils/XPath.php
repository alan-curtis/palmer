<?php


namespace RobRichards\XMLSecLibs\Utils;

class XPath
{
    const ALPHANUMERIC = "\x5c\x77\134\144";
    const NUMERIC = "\x5c\x64";
    const LETTERS = "\134\167";
    const EXTENDED_ALPHANUMERIC = "\x5c\x77\x5c\144\134\x73\134\x2d\x5f\72\x5c\x2e";
    const SINGLE_QUOTE = "\47";
    const DOUBLE_QUOTE = "\42";
    const ALL_QUOTES = "\133\47\42\135";
    public static function filterAttrValue($nj, $Bw = self::ALL_QUOTES)
    {
        return preg_replace("\x23" . $Bw . "\43", '', $nj);
    }
    public static function filterAttrName($Jh, $o1 = self::EXTENDED_ALPHANUMERIC)
    {
        return preg_replace("\x23\x5b\136" . $o1 . "\x5d\x23", '', $Jh);
    }
}
