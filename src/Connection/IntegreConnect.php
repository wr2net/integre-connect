<?php

namespace IntegreConnect\Connection;

use IntegreConnect\Actions\Action;
use IntegreConnect\Helpers\CodeDefinitions;

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
     * @param string $host
     * @param string $endpoint
     * @param string $key
     * @param string|null $version
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
            'SoapAction: ' . $this->endpoint . $action->name(),
            'Host: '.$this->host,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->host);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->serialize($action));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $response = curl_exec($ch);
        $code_response = curl_getinfo($ch)['http_code'];
        curl_close($ch);

        return json_encode([
            "Status" => $code_response,
            "Message" => CodeDefinitions::messageStatus($code_response),
            "Action" => $action->name(),
            "Response" => $response
        ]);
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
        $format .= '<%s xmlns="%s">';
        $format .= '<chaveSeguranca>%s</chaveSeguranca>';
        $format .= '<versaoIntegraco>%s</versaoIntegraco>';
        return sprintf($format, $actionName, $this->endpoint, $this->key, $this->version);
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