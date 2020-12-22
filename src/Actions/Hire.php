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
    public function __construct(object $data)
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
            'Nome' => $this->data->lead->name,
            'Cpf' => Mask::maskDocumentCpf($this->data->lead->doc),
            'DataNascimento' => Carbon::parse($this->data->lead->birth_date)->format('d/m/Y'),
            'TelefoneFixo' => Mask::maskPhone($this->data->lead->phone),
            'TelefoneMovel' => Mask::maskPhone($this->data->lead->phone),
            'Email' => $this->data->lead->email,
            'NomeMae' => $this->data->lead->mothers_name,
            'EstadoCivil' => $this->data->lead->civil_state,
            'EnderecoCep' => Mask::maskCep($this->data->lead->zip_code),
            'EnderecoDescricao' => $this->data->lead->address,
            'EnderecoNumero' => $this->data->lead->number,
            'EnderecoComplemento' => $this->data->lead->complement,
            'EnderecoBairro' => $this->data->lead->neighborhood,
            'EnderecoCidadeNome' => $this->data->lead->city,
            'EnderecoCidadeEstado' => $this->data->lead->state,
            'Produto' => $this->data->tier->code,
            'Fid' => $this->data->transaction->key,
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
            'Token' => $this->data->card_token,
            'Bandeira' => CardFlags::changeCardFlags(strtoupper($this->data->payment->flag)),
            'NumeroPrefixo' => SliceCard::prefix($this->data->payment->card_number),
            'NumeroSufixo' => SliceCard::sufix($this->data->payment->card_number),
            'Validade' => ShelfLife::fourYear($this->data->payment->shelf_life),
            'Nome' => $this->data->payment->client_name
        ];

        if ($outputAsJson) {
            return json_encode($transaction);
        }

        return $transaction;
    }

}