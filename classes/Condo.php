<?php

/**
 * Class Condo
 */
class Condo extends Property
{
    private $_buyPrice;
    private $_floorLevel;

    /**
     * Condo constructor.
     * @param $sqFoot
     * @param $bathCount
     * @param $bedCount
     * @param $yearBuilt
     * @param $location
     * @param $description
     * @param $floorLevel
     * @param $buyPrice
     */
    function __construct($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description,$floorLevel, $buyPrice) {
        parent::__construct($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description);
        $this->_buyPrice = $buyPrice;
        $this->_floorLevel = $floorLevel;
    }

    /**
     * @return mixed
     */
    public function getBuyPrice()
    {
        return $this->_buyPrice;
    }

    /**
     * @param $_buyPrice
     */
    public function setBuyPrice($_buyPrice)
    {
        $this->_buyPrice = $_buyPrice;
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