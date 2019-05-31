<?php

class Good
{
    protected $name;
    protected $type;
    protected $price;
    protected $quantity;

    private static $discount =
        [
        'digital' => 0.5,
        'common' => 1,
        'weight' => 0.001
        ];

    static protected $sum = 0;

    public function __construct($name, $type, $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }

    public function sell($quantity)
    {
        self::$sum += $this->getCost($quantity);
        echo "Товар {$this->name} продан в количестве {$quantity}";
        echo "</br>";
    }

    protected function getCost($quantity)
    {
        return ($quantity * $this->price * self::$discount[$this->type]);
    }

    public static function getSum()
    {
        echo "Доход: " . self::$sum;
    }

}

(new Good('Digital product', 'digital', 100))->sell(3);
(new Good('Common product', 'common', 100))->sell(3);
(new Good('Weight product', 'weight', 100))->sell(3);
Good::getSum();