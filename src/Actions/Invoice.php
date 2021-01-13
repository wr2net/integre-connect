<?php

namespace IntegreConnect\Actions;
use IntegreConnect\Helpers\Mask;

/**
 * Class Invoice
 * @package IntegreConnect\Actions
 */
class Invoice extends Action
{
    const ACTION_NAME = 'NomeDaActionADefinir2';

    /**
     * @var array
     */
    private $data;

    /**
     * Discount constructor.
     * @param array $data
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
        $format = '<jsonClientes><!CDATA[%]</jsonClientes>';
        return sprintf($format, $this->parseClients());
    }

    /**
     * @param bool $outputAsJson
     * @return array
     */
    private function parseClients(bool $outputAsJson = true)
    {
        $new_data = [];
        foreach ($this->data as $values) {
            $new_data[] = [
                'Cpf' => Mask::maskDocumentCpf($values->doc),
                'Desconto' => $values->discount,
                'Indicacoes' => [
                    $this->resolveIndications($values->indicados)
                ]
            ];
        }

        $clients = [
            "Clientes" => $new_data,
        ];

        if ($outputAsJson) {
            return json_encode($clients);
        }

        return $clients;
    }

    /**
     * @param array $indications
     * @return array
     */
    private function resolveIndications(array $indications)
    {
        $solved = [];
        foreach ($indications as $clients) {
            $solved[] = Mask::maskDocumentCpf($clients);
        }

        return $solved;
    }
}