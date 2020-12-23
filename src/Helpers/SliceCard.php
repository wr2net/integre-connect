<?php

namespace IntegreConnect\Helpers;

/**
 * Class SliceCard
 * @package IntegreConnect\Helpers
 */
class SliceCard
{
    /**
     * @param $number
     * @return string
     */
    public static function prefix($number)
    {
        return substr($number, 0, 6);
    }

    /**
     * @param $number
     * @return string
     */
    public static function suffix($number)
    {
        return substr($number, -4, 4);
    }
}