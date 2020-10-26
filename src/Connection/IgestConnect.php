<?php

namespace IgestConnect\Connection;

/**
 * Interface IgestConnect
 * @package IgestConnect\Connection
 */
interface IgestConnect
{
    /**
     * @param $data
     * @return mixed
     */
    public function sendContract($data);
}