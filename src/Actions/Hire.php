<?php

namespace IntegreConnect\Actions;

/**
 * Class Hire
 * @package IntegreConnect\Connection\IncludeHires
 */
class Hire extends Action
{
    const ACTION_NAME = 'IncluirContratoCartaoCreditoAppJson';

    /**
     * @var array
     */
    private $data;

    /**
     * Hire constructor.
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return self::ACTION_NAME;
    }

    /**
     * @return string
     */
    public function body(): string
    {
        $format = '<jsonCliente><!CDATA[%s]</jsonCliente>';
        $format .= '<jsonCartao><!CDATA[%s]</jsonCartao>';
        return sprintf($format, $this->parseClient(), $this->parseTransaction());
    }

    /**
     * @param  bool  $outputAsJson
     * @return array|false|string
     */
    private function parseClient(bool $outputAsJson = true)
    {
        $client = [
            'Nome' => $this->data['name'],
            'Cpf' => $this->data['document'],
            'DataNascimento' => $this->data['birth_date'],
            'TelefoneFixo' => $this->data['telephone'],
            'TelefoneMovel' => $this->data['cellphone'],
            'Email' => $this->data['email'],
            'NomeMae' => $this->data['mother_name'],
            'EstadoCivil' => $this->data['civil_state'],
            'EnderecoCep' => $this->data['zip_code'],
            'EnderecoDescricao' => $this->data['address'],
            'EnderecoNumero' => $this->data['number'],
            'EnderecoComplemento' => $this->data['complement'],
            'EnderecoBairro' => $this->data['neighborhood'],
            'EnderecoCidadeNome' => $this->data['city'],
            'EnderecoCidadeEstado' => $this->data['state'],
            'Produto' => $this->data['product'],
            'Fid' => $this->data['fid'],
        ];

        if ($outputAsJson) {
            return json_encode($client);
        }

        return $client;
    }

    /**
     * @param  bool  $outputAsJson
     * @return array|false|string
     */
    private function parseTransaction(bool $outputAsJson = true)
    {
        $transaction = [
            'Token' => $this->data['ds_cartao_token'],
            'Bandeira' => $this->data['flag'],
            'NumeroPrefixo' => $this->data['prefix'],
            'NumeroSufixo' => $this->data['sufix'],
            'Validade' => $this->data['shelf_life'],
            'Nome' => $this->data['client_name'],
        ];

        if ($outputAsJson) {
            return json_encode($transaction);
        }

        return $transaction;
    }

}