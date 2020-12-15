<?php

namespace IntegreConnect\Connection;

use IntegreConnect\Actions\Action;

/**
 * Interface IntegreConnect
 * @package IntegreConnect\Connection
 */
interface IntegreConnectInterface
{
    /**
     * @param  Action  $object
     * @return mixed
     */
    public function send(Action $object);
}