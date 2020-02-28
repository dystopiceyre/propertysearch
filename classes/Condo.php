<?php

/**
 * Class Condo
 */
class Condo extends Property
{
    private $buyPrice;
    private $floorLevel;

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
        $this->buyPrice = $buyPrice;
        $this->floorLevel = $floorLevel;
    }

    /**
     * @return mixed
     */
    public function getBuyPrice()
    {
        return $this->buyPrice;
    }

    /**
     * @param $buyPrice
     */
    public function setBuyPrice($buyPrice)
    {
        $this->buyPrice = $buyPrice;
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