<?php

namespace IntegreConnect\Actions;
use IntegreConnect\Helpers\Mask;

/**
 * Class CheckClientList
 * @package IntegreConnect\Actions
 */
class CheckClientList extends Action
{
    const ACTION_NAME = 'NomeDaActionADefinir';

    /**
     * @var array
     */
    private $data;

    /**
     * CheckClients constructor.
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
        $format = '<jsonCliente><!CDATA[%s]</jsonCliente>';
        return sprintf($format, $this->parseClients());
    }

    /**
     * @param bool $outputAsJson
     * @return array|false|string
     */
    private function parseClients(bool $outputAsJson = true)
    {
        $clients = [
            "Clientes" => $this->maskDocuments($this->data)
        ];

        if ($outputAsJson) {
            return json_encode($clients);
        }

        return $clients;
    }

    /**
     * @param $docs
     * @return array
     */
    private function maskDocuments($docs)
    {
        $transformeds = [];
        foreach ($docs as $val) {
            $transformeds[] = Mask::maskDocumentCpf($val);
        }
        return $transformeds;
    }
}