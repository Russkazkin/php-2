<?php

namespace app\model;

class Product extends DbModel
{
    public $id;
    public $category_id;
    public $manufacturer_id;
    public $name;
    public $description;
    public $price;
    public $img;
    public $created;
    public $modified;

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
    }
}