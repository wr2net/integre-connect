<?php

namespace IntegreConnect\Connection;

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
     * @param $action
     * @param $object
     * @return bool|mixed|string
     */
    public function send($action, $object)
    {
        $header = [
            'Content-Type: text/xml',
            'SoapAction: '.$action,
            'Host: '.$this->host,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host . $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $object);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}