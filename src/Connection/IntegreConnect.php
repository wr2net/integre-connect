<?php

namespace IntegreConnect\Connection;

/**
 * Interface IntegreConnect
 * @package IntegreConnect\Connection
 */
interface IntegreConnect
{
    /**
     * @param $data
     * @return mixed
     */
    public function sendContract($data);
}