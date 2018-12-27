<?php
/**
 * Created by PhpStorm.
 * User: mrbsk
 * Date: 17.12.18
 * Time: 21:47
 */
namespace component\parseHelper;

use SebastianBergmann\ObjectReflector\Exception;

class PrepareParams
{
    private $inputParams;

    public function __construct(?array $inputParams)
    {
        $this->inputParams = $inputParams;
    }

    public function prepareConsoleParams(): array
    {
        if(!$this->inputParams && count($this->inputParams) != 3){
            throw new \Exception('Not fount require params!');
        }

        if(!is_numeric($this->inputParams[2])){
            throw new \Exception('value must be numeric');
        }

        return [
            'fileName' => $this->inputParams[1],
            'value' => $this->inputParams[2],
        ];
    }
}