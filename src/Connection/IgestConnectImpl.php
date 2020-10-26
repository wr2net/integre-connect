<?php

namespace IgestConnect\Connection;

use IgestConnect\Util\SendExec;

class IgestConnectImpl implements IgestConnect
{
    /**
     * @var string[]
     */
    private $igestData;

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
     * IgestConnectImpl constructor.
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
        $this->igestData = $this->dataCompose($data);
        return $this->sendExec->sendExec($this->endpoint, $this->key, $this->igestData);
    }

    /**
     * @param $data
     * @return false|string
     */
    public function dataCompose($data)
    {
        return json_encode($this->igestData = [
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
            'Fid' => $data['fid']
        ]);
    }
}