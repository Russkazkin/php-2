<?php

namespace app\models;

class Product extends DbModel
{
    protected $category_id;
    protected $manufacturer_id;
    protected $name;
    protected $description;
    protected $price;
    protected $img;

    public function __construct($category_id = null,
                                $manufacturer_id = null,
                                $name = null,
                                $description = null,
                                $price = null,
                                $img = 'placeholder.png')
    {
        $this->category_id = $category_id;
        $this->manufacturer_id = $manufacturer_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img = $img;

        foreach ($this as $key => $value) {
            $this->updateFlags[$key] = false;
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