<?php


namespace app\models\entities;


use app\models\entities\DataEntity;

class Order extends DataEntity
{
    protected $status;
    /**
     * Order constructor.
     * @param $status
     */
    public function __construct($status = null)
    {
        $this->status = $status;

        parent::__construct();
    }


}