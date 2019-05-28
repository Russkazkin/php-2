<?php


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

    public function getPromotionInfo( bool $html=false)
    {
        $render = '<h3>' . $this->title . '</h3>' .
            '<p>Время проведения с ' . $this->dateStart . ' по ' . $this->dateEnd . '</p>' .
            '<p>'. $this->description  .'</p>';
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
}