<?php

namespace IntegreConnect\Connection\IncludeHires;

/**
 * Class TransactionInfoHireAppJson
 * @package IntegreConnect\Connection
 */
class ParseBilling
{
    /**
     * @param array $data
     * @param bool $outputAsJson
     * @return array|false|string
     */
    public static function parseTransaction(array $data, bool $outputAsJson = true)
    {
        $transaction = [
            'Token' => $data['ds_cartao_token'],
            'Bandeira' => $data['flag'],
            'NumeroPrefixo' => $data['prefix'],
            'NumeroSufixo' => $data['sufix'],
            'Validade' => $data['shelf_life'],
            'Nome' => $data['client_name']
        ];

        if ($outputAsJson) {
            return json_encode($transaction);
        }

        return $transaction;
    }
}