<?php

/**
 * Class Property
 */
class Property
{
    private $_homeID;
    private $_sqFoot;
    private $_bathCount;
    private $_bedCount;
    private $_description;
    private $_yearBuilt;
    private $_location;

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
        $this->_sqFoot = $sqFoot;
        $this->_bathCount = $bathCount;
        $this->_bedCount = $bedCount;
        $this->_yearBuilt = $yearBuilt;
        $this->_location = $location;
        $this->_description = $description;
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
        return $this->_sqFoot;
    }

    /**
     * @param $_sqFoot
     */
    public function setSqFoot($_sqFoot)
    {
        $this->_sqFoot = $_sqFoot;
    }

    /**
     * @return mixed
     */
    public function getBathCount()
    {
        return $this->_bathCount;
    }

    /**
     * @param $_bathCount
     */
    public function setBathCount($_bathCount)
    {
        $this->_bathCount = $_bathCount;
    }

    /**
     * @return mixed
     */
    public function getBedCount()
    {
        return $this->_bedCount;
    }

    /**
     * @param $_bedCount
     */
    public function setBedCount($_bedCount)
    {
        $this->_bedCount = $_bedCount;
    }

    /**
     * @return mixed
     */
    public function getYearBuilt()
    {
        return $this->_yearBuilt;
    }

    /**
     * @param mixed $_yearBuilt
     */
    public function setYearBuilt($_yearBuilt)
    {
        $this->_yearBuilt = $_yearBuilt;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->_location;
    }

    /**
     * @param mixed $_location
     */
    public function setLocation($_location)
    {
        $this->_location = $_location;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param $_description
     */
    public function setDescription($_description)
    {
        $this->_description = $_description;
    }

}