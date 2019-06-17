<?php


namespace app\models\entities;


use app\models\Model;
use Exception;

class DataEntity extends Model
{
    public $updateFlags = [];

    public function __construct()
    {
        foreach ($this as $key => $value) {
            $this->updateFlags[$key] = false;
        }
    }

    public function getProp($prop)
    {
        return $this->$prop;
    }

    public function setProp($prop, $value)
    {
        if(isset($this->$prop)) {
            $this->updateFlags[$prop] = true;
            $this->$prop = $value;
        }else{
            throw new Exception('Свойство не найдено');
        }
    }
}