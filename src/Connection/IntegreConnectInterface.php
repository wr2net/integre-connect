<?php

namespace IntegreConnect\Connection;

/**
 * Interface IntegreConnect
 * @package IntegreConnect\Connection
 */
interface IntegreConnectInterface
{
    /**
     * @param $action
     * @param $object
     * @return mixed
     */
    public function send($action, $object);
}