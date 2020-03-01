<?php

/**
 * Class House
 */
class House extends Property
{
    private $_rentBuy;
    private $_price;

    /**
     * House constructor.
     * @param $sqFoot
     * @param $bathCount
     * @param $bedCount
     * @param $yearBuilt
     * @param $location
     * @param $description
     * @param $rentBuy
     * @param $price
     */
    function __construct($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description, $rentBuy, $price)
    {
        parent::__construct($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description);
        $this->_rentBuy = $rentBuy;
        $this->_price = $price;
    }

    /**
     * @return mixed
     */
    public function getRentBuy()
    {
        return $this->_rentBuy;
    }

    /**
     * @param $_rentBuy
     */
    public function setRentBuy($_rentBuy)
    {
        $this->_rentBuy = $_rentBuy;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param $_price
     */
    public function setPrice($_price)
    {
        $this->_price = $_price;
    }

}