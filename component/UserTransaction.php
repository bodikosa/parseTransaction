<?php
/**
 * Created by PhpStorm.
 * User: mrbsk
 * Date: 16.12.18
 * Time: 20:35
 */
namespace component;

class UserTransaction extends BaseTransaction
{
    public function getUserSumLimit(): array
    {
        $parseData = $this->parseComponent->getData();
        $resultData = $this->parseComponent->parseData($parseData);

        usort($resultData, function ($user, $user2) {
            return $user[0] <=> $user2[0];
        });

        return $resultData;
    }

    public function renderUserTransaction(array $listTransactions)
    {
        foreach ($listTransactions as $listTransaction) {
            echo implode(' ', $listTransaction) . PHP_EOL;
        }
    }

}