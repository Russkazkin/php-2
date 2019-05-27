<?php


class Promotion
{
    private $dateStart;
    private $dateEnd;
    private $title;
    private $description;

    /**
     * Promotion constructor.
     * @param $dateStart
     * @param $dateEnd
     * @param $title
     * @param $description
     */
    public function __construct(string $title, string $description, string $dateStart = null, string $dateEnd = null)
    {
        $this->dateStart = $dateStart ?? date('d-m-Y');
        $this->dateEnd = $dateEnd ?? date('d-m-Y');
        $this->title = $title;
        $this->description = $description;
    }


}