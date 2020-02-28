<?php

/**
 * Class Apartment
 */
class Apartment extends Property
{
    private $rentPrice;
    private $floorLevel;

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
        $this->rentPrice = $rentPrice;
        $this->floorLevel = $floorLevel;
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

    /**
     * @return mixed
     */
    public function getFloorLevel()
    {
        return $this->floorLevel;
    }

    /**
     * @param mixed $floorLevel
     */
    public function setFloorLevel($floorLevel)
    {
        $this->floorLevel = $floorLevel;
    }



}