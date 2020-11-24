<?php

namespace IntegreConnect\Connection;

/**
 * Interface IntegreConnect
 * @package IntegreConnect\Connection
 */
interface IntegreConnectInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function send($data);
}