<?php

namespace IntegreConnect\Actions;

/**
 * Class Action
 * @package IntegreConnect\Actions
 */
abstract class Action
{
    /**
     * @return string
     */
    abstract public function name(): string;

    /**
     * @return string
     */
    abstract public function body(): string;
}