<?php

namespace IntegreConnect\Connection\IncludeHires;
use IntegreConnect\Connection\Envelope\Begining;
use IntegreConnect\Connection\Envelope\Ending;

/**
 * Class ClientHired
 * @package IntegreConnect\Connection\IncludeHires
 */
class ClientHired
{
    /**
     * @param string $action
     * @param string $key
     * @param string $version
     * @param array $data
     * @return string
     */
    public function envelope(string $action, string $key, string $version, array $data)
    {
        return Begining::envelopeBegin($action, $key, $version).
        '<jsonCliente><!CDATA[' . ParseClient::parseClient($data) . ']</jsonCliente>
        <jsonCartao><!CDATA[' . ParseBilling::parseTransaction($data) . ']</jsonCartao>'.
        Ending::envelopeEnd($action);
    }
}