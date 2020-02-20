<?php

/**
 * Class Apartment
 */
class Apartment extends Property
{
    public $rentPrice;

    /**
     * Apartment constructor.
     * @param $sqFoot
     * @param $bathCount
     * @param $bedCount
     * @param $description
     * @param $rentPrice
     */
    function __construct($sqFoot, $bathCount, $bedCount, $description, $rentPrice) {
        parent::__construct($sqFoot, $bathCount, $bedCount, $description);
        $this->rentPrice = $rentPrice;
    }

    /**
     * @return mixed
     */
    public function getRentPrice()
    {
        return $this->rentPrice;
    }

    /**
     * @param $rentPrice
     */
    public function setRentPrice($rentPrice)
    {
        $this->rentPrice = $rentPrice;
    }


}