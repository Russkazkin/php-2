<?php


class Sale extends Promotion
{
    private $discount;
    private $category;


    public function __construct(int $discount, string $category, string $title, string $description = null, string $dateStart = null, string $dateEnd = null)
    {
        $this->discount = $discount;
        $this->category = $category;
        parent::__construct($title, $description, $dateStart, $dateEnd);
    }

    public function getPromotionInfo(bool $html = false)
    {
        $render = '<h3>' . $this->title . '</h3>' .
            '<p>Время проведения с ' . $this->dateStart . ' по ' . $this->dateEnd . '</p>';
        if ($this->description) {
            $render .= '<p>'. $this->description  .'</p>';
        }else{
            $render .= '<p>Скидка '. $this->discount  . '% на категорию '. $this->category .'</p>';
        }
        $promoArr = [];
        $promoArr['dateStart'] = $this->dateStart;
        $promoArr['dateEnd'] = $this->dateEnd;
        $promoArr['title'] = $this->title;
        $promoArr['description'] = $this->description;

        if ($html){
            echo $render;
            return null;
        }else{
            return $promoArr;
        }
    }
    public function priceDiscount(int $priceValue) : int
    {
        return $priceValue - $priceValue * $this->discount / 100;
    }
}
//TODO: Задать вопрос: как быть, если обязательное своийство в родителе должно быть необязательным в наследнике?