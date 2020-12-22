<?php

namespace IntegreConnect\Helpers;

/**
 * Class CardFlags
 * @package IntegreConnect\Helpers
 */
class CardFlags
{
    /**
     * @var array
     */
    public static $flagList = [
        'VISA' => 0,
        'MASTER' => 1,
        'ELO' => 2,
        'PLENO' => 3,
        'HIPER' => 4,
        'JCB' => 5,
        'DISCOVER' => 6,
        'DINERSCLUB' => 7,
        'AURA' => 8,
        'AMEX' => 9
    ];

    /**
     * @param $flag
     * @return int|mixed
     */
    public static function changeCardFlags($flag)
    {
        return self::$flagList[$flag];
    }
}