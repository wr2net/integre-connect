<?php

namespace IntegreConnect\Helpers;

/**
 * Class Mask
 * @package IntegreConnect\Helpers
 */
class Mask
{
    /**
     * @param $val
     * @return string
     */
    public static function maskDocumentCpf($val)
    {
        $doc = preg_replace("/[^0-9]/", "", $val);
        return substr($doc, 0, 3) . '.' .
            substr($doc, 3, 3) . '.' .
            substr($doc, 6, 3) . '.' .
            substr($doc, 9, 2);
    }

    /**
     * @param $val
     * @return string
     */
    public static function maskDocumentCnpj($val)
    {
        $doc = preg_replace("/[^0-9]/", "", $val);
        return substr($doc, 0, 2) . '.' .
            substr($doc, 2, 3) . '.' .
            substr($doc, 5, 3) . '/' .
            substr($doc, 8, 4) . '-' .
            substr($doc, 12, 2);
    }

    /**
     * @param $cep
     * @return string
     */
    public static function maskCep($cep)
    {
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }

    /**
     * @param $phone
     * @return string
     */
    public static function maskPhone($phone)
    {
        $format = "(s%)s%-s%";
        if (strlen($phone) === 10) {
            $ddd = substr($phone, 0, 2);
            $prefix = substr($phone, 2, 4);
            $suffix = substr($phone, 6);
            return sprintf($format, $ddd, $prefix, $suffix);
        }

        if (strlen($phone) === 11) {
            $ddd = substr($phone, 0, 2);
            $prefix = substr($phone, 2, 5);
            $suffix = substr($phone, 7);
            return sprintf($format, $ddd, $prefix, $suffix);
        }

        return phone;
    }
}