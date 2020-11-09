<?php

namespace IntegreConnect\Connection;

/**
 * Class IntegreConnectImpl
 * @package IntegreConnect\Connection
 */
class IntegreConnectImpl implements IntegreConnect
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
     * IntegreConnectImpl constructor.
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
     * @param $data
     * @return mixed
     */
    public function send($data)
    {
        return $this->sendRequest($data['action'], $this->parseBody($data));
    }

    /**
     * @param  string  $action
     * @param  array  $data
     * @return bool|string
     */
    private function sendRequest(string $action, array $data)
    {
        $header = [
            'Content-Type: text/xml',
            'SoapAction: '.$action,
            'Host: '.$this->host,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host.$this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->envelopeBody($action, $data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * @param  string  $action
     * @param  string  $data
     * @return string
     */
    private function envelopeBody(string $action, string $data)
    {
        return '<s:Envelope xmlns.s="http://schemas.xmlsoap.org/soap/envelope/"><s:Body>
        <'.$action.' xmlns="http://tempuri.org/">
        <chaveSeguranca>'.$this->key.'</chaveSeguranca>
        <versaoIntegraco>'.$this->version.'</versaoIntegraco>
        <jsonContrato><!CDATA['.$data.']</jsonContrato>
        </'.$action.'></s:Body></s:Envelope>';
    }

    /**
     * @param  array  $data
     * @param  bool  $outputAsJson
     * @return array|false|string
     */
    private function parseBody(array $data, bool $outputAsJson = true)
    {
        $body = [
            'Nome' => $data['name'],
            'Cpf' => $data['document'],
            'DataNascimento' => $data['birth_date'],
            'EstadoCivil' => $data['civil_id'],
            'TelefoneFixo' => $data['telephone'],
            'TelefoneMovel' => $data['cellphone'],
            'Email' => $data['email'],
            'NomeMae' => $data['mother_name'],
            'EstadoCivil' => $data['marital_status'],
            'EnderecoCep' => $data['zip_code'],
            'EnderecoDescricao' => $data['public_place'],
            'EnderecoNumero' => $data['number'],
            'EnderecoComplemento' => $data['complement'],
            'EnderecoBairro' => $data['neighborhood'],
            'EnderecoCidadeNome' => $data['city'],
            'EnderecoCidadeEstado' => $data['state'],
            'Produto' => $data['product_reference'],
            'Fid' => $data['fid'],
        ];

        if ($outputAsJson) {
            return json_encode($body);
        }

        return $body;
    }
}