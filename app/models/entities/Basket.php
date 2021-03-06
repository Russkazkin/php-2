<?php


namespace app\models\entities;



class Basket extends DataEntity
{
    public $id;
    public $session_id;
    public $product_id;
    public $user_id;

    /**
     * Basket constructor.
     * @param $session_id
     * @param $product_id
     * @param $user_id
     */
    public function __construct($session_id = null, $product_id = null, $user_id = null)
    {
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        $this->user_id = $user_id;

        parent::__construct();
    }
}