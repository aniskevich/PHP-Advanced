<?php

namespace app\model\entities;

class Products extends DataEntity
{
    public $id;
    public $name;
    public $category;
    public $type;
    public $color;
    public $size;
    public $price;
    public $link;
    public $about;

    public $quantity;

    public function __construct($name = null, $category = null, $type = null, $color = null, $size = null, $price = null, $link = null, $about = null)
    {
        $this->name = $name;
        $this->category = $category;
        $this->type = $type;
        $this->color = $color;
        $this->size = $size;
        $this->price = $price;
        $this->link = $link;
        $this->about = $about;
    }
}
