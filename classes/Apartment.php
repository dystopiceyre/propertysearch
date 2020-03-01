<?php

/**
 * Class Apartment
 */
class Apartment extends Property
{
    private $_rentPrice;
    private $_floorLevel;

    /**
     * Apartment constructor.
     * @param $sqFoot
     * @param $bathCount
     * @param $bedCount
     * @param $yearBuilt
     * @param $location
     * @param $description
     * @param $rentPrice
     * @param $floorLevel
     */
    function __construct($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description, $rentPrice, $floorLevel)
    {
        parent::__construct($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description);
        $this->_rentPrice = $rentPrice;
        $this->_floorLevel = $floorLevel;
    }

    /**
     * @return mixed
     */
    public function getRentPrice()
    {
        return $this->_rentPrice;
    }

    /**
     * @param $_rentPrice
     */
    public function setRentPrice($_rentPrice)
    {
        $this->_rentPrice = $_rentPrice;
    }

    /**
     * @return mixed
     */
    public function getFloorLevel()
    {
        return $this->_floorLevel;
    }

    /**
     * @param mixed $_floorLevel
     */
    public function setFloorLevel($_floorLevel)
    {
        $this->_floorLevel = $_floorLevel;
    }


}