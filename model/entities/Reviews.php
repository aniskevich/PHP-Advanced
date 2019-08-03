<?php


namespace app\model\entities;


use app\engine\App;

class Reviews extends DataEntity
{
    public $id;
    public $user_id;
    public $review_date;
    public $text;
    public $likes;
    public $dislikes;
    public $is_approved;

    /**
     * Reviews constructor.
     * @param $text
     */
    public function __construct($text = null)
    {
        $this->user_id = App::call()->session->getUserId();
        $this->review_date = date(DATE_RFC822);
        $this->text = $text;
        $this->likes = 0;
        $this->dislikes = 0;
        $this->is_approved = 'false';
    }


}