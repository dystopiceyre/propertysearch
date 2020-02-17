<?php

class Condo extends Property
{
    public $buyPrice;

    function __construct($sqFoot, $bathCount, $bedCount, $description, $buyPrice) {
        parent::__construct($sqFoot, $bathCount, $bedCount, $description);
        $this->buyPrice = $buyPrice;
    }

    public function getBuyPrice()
    {
        return $this->buyPrice;
    }

    public function setBuyPrice($buyPrice)
    {
        $this->buyPrice = $buyPrice;
    }


}