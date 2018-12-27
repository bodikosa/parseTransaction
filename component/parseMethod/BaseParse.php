<?php
/**
 * Created by PhpStorm.
 * User: mrbsk
 * Date: 16.12.18
 * Time: 20:25
 */

namespace component\parseMethod;

use component\parseHelper\PrepareParams;

abstract class BaseParse
{
    protected $params;

    public function __construct(PrepareParams $params)
    {
        $this->params = $params->prepareConsoleParams();
    }

    abstract public function getData(): array;

    abstract public function parseData(array $parseData): array;

}