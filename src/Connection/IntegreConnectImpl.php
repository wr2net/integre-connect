<?php

namespace IntegreConnect\Connection;

use IntegreConnect\Util\SendExec;

/**
 * Class IntegreConnectImpl
 * @package IntegreConnect\Connection
 */
class IntegreConnectImpl implements IntegreConnect
{
    /**
     * @var string[]
     */
    private $integreData;

    /**
     * @var SendExec
     */
    private $sendExec;

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var string
     */
    private $key;

    /**
     * IntegreConnectImpl constructor.
     * @param $endpoint
     * @param $key
     */
    public function __construct($endpoint, $key)
    {
        $this->endpoint = $endpoint;
        $this->key = $key;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function sendContract($data)
    {
        $this->integreData = $this->dataCompose($data);
        return $this->sendExec->sendExec($this->endpoint, $this->key, $this->integreData);
    }

    /**
     * @param $data
     * @return false|string
     */
    public function dataCompose($data)
    {
        return json_encode(
            [
                'Nome' => $data['name'],
                'Cpf' => $data['document'],
                'DataNascimento' => $data['birth_date'],
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
                'Fid' => $data['fid']
            ]
        );
    }
}