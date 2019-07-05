<?php


namespace app\models;


use app\models\entities\DataEntity;

class Order extends DataEntity
{
    protected $id;
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