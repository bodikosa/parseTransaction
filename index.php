<?php
require_once("config/settings.php");
require_once("config/autoloader.php");

use \component\parseMethod\{FileParse, SqlParse};
use \component\parseHelper\PrepareParams;
use \component\UserTransaction;

$startTime = microtime(true);

$paramsClass = new PrepareParams($argv ?? []);
$parseMethod = new FileParse($paramsClass);
$transaction = new UserTransaction($parseMethod);

$listUsers = $transaction->getUserSumLimit();
$transaction->renderUserTransaction($listUsers);

echo "Result time: " . (microtime(true) - $startTime) . PHP_EOL;
