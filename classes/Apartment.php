<?php

class Apartment extends Property
{
    public $rentPrice;

    function __construct($sqFoot, $bathCount, $bedCount, $description, $rentPrice) {
        parent::__construct($sqFoot, $bathCount, $bedCount, $description);
        $this->rentPrice = $rentPrice;
    }

    public function getRentPrice()
    {
        return $this->rentPrice;
    }

    public function setRentPrice($rentPrice)
    {
        $this->rentPrice = $rentPrice;
    }


}