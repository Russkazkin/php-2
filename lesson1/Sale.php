<?php


/**
 * Class Sale
 * Класс-наследник базового класса Promotion. Добавлен функционал скидок
 */
class Sale extends Promotion
{
    private $discount;
    private $category;


    /**
     * Sale constructor.
     * @param int $discount Размер скидки
     * @param string $category Категория товара со скидкой
     * @param string $title
     * @param string|null $description
     * @param string|null $dateStart
     * @param string|null $dateEnd
     */
    public function __construct(int $discount, string $category, string $title, string $description = null, string $dateStart = null, string $dateEnd = null)
    {
        $this->discount = $discount;
        $this->category = $category;
        parent::__construct($title, $dateStart, $dateEnd);
        $this->description = $description ?? "Скидка {$this->discount}% на категорию {$this->category}";
    }

    /**
     * В базовый метод добавлены новые свойства
     * @return array
     */
    public function getPromotionArr(): array
    {
        $promoArr = parent::getPromotionArr();
        $promoArr['discount'] = $this->discount;
        $promoArr['category'] = $this->category;
        return $promoArr;
    }


    /**
     * Метод для получения цены со скидкой
     * @param int $priceValue
     * @return int
     */
    public function priceDiscount(int $priceValue) : int
    {
        return $priceValue - $priceValue * $this->discount / 100;
    }
}
//TODO: Задать вопрос: как быть, если обязательное своийство в родителе должно быть необязательным в наследнике?