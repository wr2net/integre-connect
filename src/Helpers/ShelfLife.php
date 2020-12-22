<?php

namespace IntegreConnect\Helpers;

/**
 * Class ShelfLife
 * @package IntegreConnect\Helpers
 */
class ShelfLife
{
    /**
     * @param $date
     * @return string
     */
    public static function fourYear($date)
    {
        return str_replace("/", "/20", $date);
    }

    /**
     * @param $date
     * @return string
     */
    public static function twoYear($date)
    {
        return str_replace("/20", "/", $date);
    }
}