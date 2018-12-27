<?php
/**
 * Created by PhpStorm.
 * User: mrbsk
 * Date: 16.12.18
 * Time: 20:27
 */

namespace component\parseMethod;


class FileParse extends BaseParse
{
    private static $FILE_PATH = 'source/transactionFiles/';

    public function getData(): array
    {
        $this->params['fileName'] = self::$FILE_PATH . $this->params['fileName'];

        if (!file_exists($this->params['fileName'])) {
            throw new \Exception("File {$this->params['fileName']} not exist");
        }

        $currentFile = fopen($this->params['fileName'], 'r');

        $headerData = fgetcsv($currentFile);

        $userTransaction = [];
        while(($data = fgetcsv($currentFile)) !== false) {
                $userTransaction[] = $data;
        }

        fclose($currentFile);

        return $userTransaction;
    }

    public function parseData(array $userTransactions): array
    {
        $userTrans = $this->quickSort($userTransactions);

        $userData = [];
        $userPrice = [];
        foreach ($userTrans  as $key => $userTran) {

            $userId = $userTran[0];
            $userValue = $userPrice[$userId] ?? 0;
            $userPrice[$userId] = $userValue + $userTran[2];

            if($userPrice[$userId] > $this->params['value'] && !isset($userData[$userId])){
                $userData[$userId] = [
                    $userId,
                    $userTran[1],
                ];
            }

        }

        return $userData;
    }

    //Realisation "quick sort" method for sort array
    //https://www.w3resource.com/php-exercises/searching-and-sorting-algorithm/searching-and-sorting-algorithm-exercise-1.php
    //https://kukuruku.co/post/benchmarks-14-sorting-algorithms-and-php-arrays/

    private function quickSort(array $userTransactions) : array
    {

        if(count($userTransactions) <= 1){
            return $userTransactions;
        }

        $gt = $lt = [];
        $dataMark = array_shift($userTransactions);
        $benchMark = $dataMark[0];


        foreach ($userTransactions as $singleTransaction){
            if($singleTransaction[0] >= $benchMark) {
                $gt[] = $singleTransaction;
            } else {
                $lt[] = $singleTransaction;
            }
        }

        return array_merge($this->quickSort($lt), [$dataMark], $this->quickSort($gt));
    }

}