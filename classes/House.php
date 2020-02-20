<?php

/**
 * Class House
 */
class House extends Property
{
    public $rentBuy;
    public $price;

    /**
     * House constructor.
     * @param $sqFoot
     * @param $bathCount
     * @param $bedCount
     * @param $description
     * @param $rentBuy
     * @param $price
     */
    function __construct($sqFoot, $bathCount, $bedCount, $description, $rentBuy, $price)
    {
        parent::__construct($sqFoot, $bathCount, $bedCount, $description);
        $this->rentBuy = $rentBuy;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getRentBuy()
    {
        return $this->rentBuy;
    }

    /**
     * @param $rentBuy
     */
    public function setRentBuy($rentBuy)
    {
        $this->rentBuy = $rentBuy;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}