<?php

namespace IntegreConnect\Connection\Envelope;

class Begining
{
    public static function envelopeBegin(string $action, string $key, string $version)
    {
        return '<s:Envelope xmlns.s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body>
        <' . $action . ' xmlns="http://tempuri.org/">
        <chaveSeguranca>' . $key . '</chaveSeguranca>
        <versaoIntegraco>' . $version . '</versaoIntegraco>';
    }
}