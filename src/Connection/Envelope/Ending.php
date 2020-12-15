<?php

namespace IntegreConnect\Connection\Envelope;

class Ending
{
    public static function envelopeEnd($action)
    {
        return '</' . $action . '></s:Body></s:Envelope>';
    }
}