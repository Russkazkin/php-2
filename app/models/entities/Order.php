<?php


namespace app\models\entities;


class Order extends DataEntity
{
    protected $user_id;
    protected $status;
    /**
     * Order constructor.
     * @param $status
     */
    public function __construct($user_id = null, $status = null)
    {
        $this->user_id = $user_id;
        $this->status = $status;

        parent::__construct();
    }


}