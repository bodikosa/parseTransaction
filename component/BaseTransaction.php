<?php
/**
 * Created by PhpStorm.
 * User: mrbsk
 * Date: 16.12.18
 * Time: 20:35
 */
namespace component;

use component\parseMethod\BaseParse;

abstract class BaseTransaction
{
    protected $parseComponent;

    public function __construct(BaseParse $parseComponent)
    {
        $this->parseComponent = $parseComponent;
    }

    abstract public function getUserSumLimit(): array;

    abstract public function renderUserTransaction(array $listTransactions);
}