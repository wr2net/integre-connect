<?php

namespace IntegreConnect\Connection\IncludeHires;

/**
 * Class IncludeHireCredCardAppJson
 * @package IntegreConnect\Connection
 */
class ParseClient
{
    /**
     * @param array $data
     * @param bool $outputAsJson
     * @return array|false|string
     */
    public static function parseClient(array $data, bool $outputAsJson = true)
    {
        $client = [
            'Nome' => $data['name'],
            'Cpf' => $data['document'],
            'DataNascimento' => $data['birth_date'],
            'TelefoneFixo' => $data['telephone'],
            'TelefoneMovel' => $data['cellphone'],
            'Email' => $data['email'],
            'NomeMae' => $data['mother_name'],
            'EstadoCivil' => $data['civil_state'],
            'EnderecoCep' => $data['zip_code'],
            'EnderecoDescricao' => $data['address'],
            'EnderecoNumero' => $data['number'],
            'EnderecoComplemento' => $data['complement'],
            'EnderecoBairro' => $data['neighborhood'],
            'EnderecoCidadeNome' => $data['city'],
            'EnderecoCidadeEstado' => $data['state'],
            'Produto' => $data['product'],
            'Fid' => $data['fid'],
        ];

        if ($outputAsJson) {
            return json_encode($client);
        }

        return $client;
    }
}