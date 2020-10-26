<?php

namespace IntegreConnect\Util;

/**
 * Class SendExec
 * @package IntegreConnect\Util
 */
class SendExec
{

    /**
     * @var string[]
     */
    private $header;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string[]
     */
    private $data;

    /**
     * @param $endpoint
     * @param $key
     * @param $header
     * @param $data
     * @return bool|string
     */
    public function sendExec($endpoint, $key, $header, $data)
    {
        $this->endpoint = $endpoint;
        $this->key = $key;
        $this->header = $header;
        $this->data = $data;

        return $this->setCurl($this->endpoint, $this->key, $this->header, $this->data);
    }

    /**
     * @param $endpoint
     * @param $key
     * @param $header
     * @param $data
     * @return bool|string
     */
    public function setCurl($endpoint, $key, $header, $data)
    {
        $this->header = [
            'Content-Type: text/xml',
            'SoapAction: ' . $header['action'],
            'Host: ' . $header['host']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->envelopeBody($key, $data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->header);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


    /**
     * @param $key
     * @param $data
     * @return mixed
     */
    public function envelopeBody($key, $data)
    {
        return'<s:Envelope xmlns.s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body>
        <incluirContratoSingleflowCreditoJson xmlns="http://tempuri.org/">
        <chaveSeguranca>' . $key . '</chaveSeguranca>
        <versaoIntegraco>1</versaoIntegraco>
        <jsonContrato><!CDATA[' . $data . ']</jsonContrato>
        </incluirContratoSingleflowCreditoJson></s:Body></s:Envelope>';
    }
}