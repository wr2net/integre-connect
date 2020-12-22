<?php

namespace IntegreConnect\Actions;
use IntegreConnect\Helpers\ShelfLife;
use IntegreConnect\Helpers\CardFlags;
use IntegreConnect\Helpers\SliceCard;
use IntegreConnect\Helpers\Mask;
use Carbon\Carbon;

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
            'Cpf' => Mask::maskDocumentCpf($this->data['document']),
            'DataNascimento' => Carbon::parse($this->data['birth_date'])->format('d/m/Y'),
            'TelefoneFixo' => Mask::maskPhone($this->data['telephone']),
            'TelefoneMovel' => Mask::maskPhone($this->data['telephone']),
            'Email' => $this->data['email'],
            'NomeMae' => $this->data['mother_name'],
            'EstadoCivil' => $this->data['civil_state'],
            'EnderecoCep' => Mask::maskCep($this->data['zip_code']),
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
            'Bandeira' => CardFlags::changeCardFlags(strtoupper($this->data['flag'])),
            'NumeroPrefixo' => SliceCard::prefix($this->data['card_number']),
            'NumeroSufixo' => SliceCard::sufix($this->data['card_number']),
            'Validade' => ShelfLife::fourYear($this->data['shelf_life']),
            'Nome' => $this->data['client_name']
        ];

        if ($outputAsJson) {
            return json_encode($transaction);
        }

        return $transaction;
    }

}