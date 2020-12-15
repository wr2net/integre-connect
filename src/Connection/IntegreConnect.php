<?php

namespace IntegreConnect\Connection;

use IntegreConnect\Actions\Action;

/**
 * Class IntegreConnect
 * @package IntegreConnect\Connection
 */
class IntegreConnect implements IntegreConnectInterface
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $version = '1';

    /**
     * IntegreConnect constructor.
     * @param  string  $host
     * @param  string  $endpoint
     * @param  string  $key
     * @param  string|null  $version
     */
    public function __construct(string $host, string $endpoint, string $key, string $version = null)
    {
        $this->host = $host;
        $this->endpoint = $endpoint;
        $this->key = $key;

        if (!is_null($version)) {
            $this->version = $version;
        }
    }

    /**
     * @param  Action  $action
     * @return bool|mixed|string
     */
    public function send(Action $action)
    {
        $header = [
            'Content-Type: text/xml',
            'SoapAction: '.$action->name(),
            'Host: '.$this->host,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host.$this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->serialize($action));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * @param  Action  $action
     * @return string
     */
    private function serialize(Action $action): string
    {
        $actionName = $action->name();

        $format = '%s%s%s';
        return sprintf(
            $format,
            $this->envelopeBegin($actionName),
            $action->body(),
            $this->envelopeEnd($actionName)
        );
    }

    /**
     * @param  string  $actionName
     * @return string
     */
    private function envelopeBegin(string $actionName): string
    {
        $format = '<s:Envelope xmlns.s="http://schemas.xmlsoap.org/soap/envelope/">';
        $format .= '<s:Body>';
        $format .= '<%s xmlns="http://tempuri.org/">';
        $format .= '<chaveSeguranca>%s</chaveSeguranca>';
        $format .= '<versaoIntegraco>%s</versaoIntegraco>';
        return sprintf($format, $actionName, $this->key, $this->version);
    }

    /**
     * @param  string  $actionName
     * @return string
     */
    private function envelopeEnd(string $actionName): string
    {
        $format = '</%s>';
        $format .= '</s:Body>';
        $format .= '</s:Envelope>';
        return sprintf($format, $actionName);
    }
}