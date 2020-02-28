<?php

/**
 * Class Property
 */
class Property
{
    private $_homeID;
    private $sqFoot;
    private $bathCount;
    private $bedCount;
    private $description;
    private $yearBuilt;
    private $location;

    /**
     * Property constructor.
     * @param $sqFoot
     * @param $bathCount
     * @param $bedCount
     * @param $yearBuilt
     * @param $location
     * @param $description
     */
    function __construct($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description)
    {
        $this->sqFoot = $sqFoot;
        $this->bathCount = $bathCount;
        $this->bedCount = $bedCount;
        $this->yearBuilt = $yearBuilt;
        $this->location = $location;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getHomeID()
    {
        return $this->_homeID;
    }

    /**
     * @return mixed
     */
    public function getSqFoot()
    {
        return $this->sqFoot;
    }

    /**
     * @param $sqFoot
     */
    public function setSqFoot($sqFoot)
    {
        $this->sqFoot = $sqFoot;
    }

    /**
     * @return mixed
     */
    public function getBathCount()
    {
        return $this->bathCount;
    }

    /**
     * @param $bathCount
     */
    public function setBathCount($bathCount)
    {
        $this->bathCount = $bathCount;
    }

    /**
     * @return mixed
     */
    public function getBedCount()
    {
        return $this->bedCount;
    }

    /**
     * @param $bedCount
     */
    public function setBedCount($bedCount)
    {
        $this->bedCount = $bedCount;
    }

    /**
     * @return mixed
     */
    public function getYearBuilt()
    {
        return $this->yearBuilt;
    }

    /**
     * @param mixed $yearBuilt
     */
    public function setYearBuilt($yearBuilt)
    {
        $this->yearBuilt = $yearBuilt;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}