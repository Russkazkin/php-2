<?php


/**
 * Class Promotion
 * Базовый класс для акций магазина. Получает название акции, описания, дату начала и конца. Выводит информацию в соответствие со свойствами
 */
class Promotion
{
    protected $dateStart;
    protected $dateEnd;
    protected $title;
    protected $description;


    /**
     * Promotion constructor.
     * @param string $title
     * @param string $description
     * @param string|null $dateStart
     * @param string|null $dateEnd
     */
    public function __construct(string $title, string $description = null, string $dateStart = null, string $dateEnd = null)
    {
        $this->dateStart = $dateStart ?? date('d-m-Y');
        $this->dateEnd = $dateEnd ?? date('d-m-Y');
        $this->title = $title;
        $this->description = $description;
    }
    public function getPromotionRender() : void
    {
        echo '<h3>' . $this->title . '</h3>' .
            '<p>Время проведения с ' . $this->dateStart . ' по ' . $this->dateEnd . '</p>' .
            '<p>'. $this->description  .'</p>';
    }

    public function getPromotionArr() : array
    {
        $promoArr = [];
        $promoArr['dateStart'] = $this->dateStart;
        $promoArr['dateEnd'] = $this->dateEnd;
        $promoArr['title'] = $this->title;
        $promoArr['description'] = $this->description;
        return $promoArr;
    }
}