<?php


namespace app\models\entities;


use app\models\Model;
use Exception;

abstract class DataEntity extends Model
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
        if(property_exists(static::class, $prop)) {
            $this->updateFlags[$prop] = true;
            $this->$prop = $value;
        }else{
            throw new Exception('Свойство не найдено');
        }
    }

    public function getTwigArr()
    {
        $propsArr = [];
        foreach ($this->updateFlags as $key => $flag){
            $propsArr[$key] = $this->getProp($key);
        }
        return $propsArr;
    }
}