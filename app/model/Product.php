<?php

namespace app\model;

class Product extends Model {
    public $id;
    public $category_id;
    public $manufacturer_id;
    public $name;
    public $description;
    public $price;
    public $created;
    public $modified;

    public function __construct( $param = null,
                                 $id = null,
                                 $category_id = null,
                                 $manufacturer_id = null,
                                 $name = null,
                                 $description = null,
                                 $price = null,
                                 $created = null,
                                 $modified = null)
    {
        parent::__construct();
        if(is_int($param)){
            $this->getFromDB($param);
        }elseif(is_array($param)){
            echo "Переданы данные для создания объекта<br>";
        }else{
            throw new \Exception("При создании объекта необходимо передать id объекта или данные для создания нового в массиве");
        }

        /*$this->id = $id;
        $this->category_id = $category_id;
        $this->manufacturer_id = $manufacturer_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->created = $created;
        $this->modified = $modified;*/

    }
    public function getFromDB($id){
        $item = $this->getOne($id);
        //var_dump($item);
        foreach ($item as $key=>$value) {
            $this->$key = $value;
        }
    }
}