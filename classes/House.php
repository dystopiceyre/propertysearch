<?php

class House extends Property
{
    public $rentBuy;
    public $price;

    function __construct($sqFoot, $bathCount, $bedCount, $description, $rentBuy, $price)
    {
        parent::__construct($sqFoot, $bathCount, $bedCount, $description);
        $this->rentBuy = $rentBuy;
        $this->price = $price;
    }

    public function getRentBuy()
    {
        return $this->rentBuy;
    }

    public function setRentBuy($rentBuy)
    {
        $this->rentBuy = $rentBuy;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

}