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
                                 $id,
                                 $category_id,
                                 $manufacturer_id,
                                 $name,
                                 $description,
                                 $price,
                                 $created,
                                 $modified)
    {
        parent::__construct();
        $this->id = $id;
        $this->category_id = $category_id;
        $this->manufacturer_id = $manufacturer_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->created = $created;
        $this->modified = $modified;

        /*if(is_int($param)){
            echo "Передан id <br>";

        }elseif(is_array($param)){
            echo "Переданы данные для создания объекта<br>";
        }else{
            throw new \Exception("При создании объекта необходимо передать id объекта или данные для создания нового в массиве");
        }*/
   }

}