<?php


namespace app\interfaces;


interface ICart
{
    public function add($id);

    public function removeOne($id);

    public function removeAll($id);
}