<?php


namespace app\model\entities;


class Orders extends DataEntity
{
    public $id;
    public $session_id;
    public $user_id;
    public $user_mail;
    public $payment;
    public $address;
    public $date;
    public $status;

    /**
     * Orders constructor.
     * @param $session_id
     * @param $user_id
     * @param $user_mail
     * @param $payment
     * @param $address
     * @param $date
     * @param $status
     * @param $sum
     */
    public function __construct($user_id = null, $user_mail = null, $payment = null, $address = null)
    {
        $this->session_id = session_id();
        $this->user_id = $user_id;
        $this->user_mail = $user_mail;
        $this->payment = $payment;
        $this->address = $address;
        $this->date = date(DATE_RFC822);
        $this->status = "created";
    }


}