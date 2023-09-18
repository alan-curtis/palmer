<?php


abstract class BasicEnum
{
    private static $constCacheArray = NULL;
    public static function getConstants()
    {
        if (!(self::$constCacheArray == NULL)) {
            goto vY;
        }
        self::$constCacheArray = [];
        vY:
        $id = get_called_class();
        if (array_key_exists($id, self::$constCacheArray)) {
            goto Rm;
        }
        $Ow = new ReflectionClass($id);
        self::$constCacheArray[$id] = $Ow->getConstants();
        Rm:
        return self::$constCacheArray[$id];
    }
    public static function isValidName($Jh, $Kr = false)
    {
        $h7 = self::getConstants();
        if (!$Kr) {
            goto PY;
        }
        return array_key_exists($Jh, $h7);
        PY:
        $WI = array_map("\163\x74\x72\x74\x6f\x6c\157\x77\x65\x72", array_keys($h7));
        return in_array(strtolower($Jh), $WI);
    }
    public static function isValidValue($nj, $Kr = true)
    {
        $JZ = array_values(self::getConstants());
        return in_array($nj, $JZ, $Kr);
    }
}
