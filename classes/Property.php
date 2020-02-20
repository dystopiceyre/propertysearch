<?php

/**
 * Class Property
 */
class Property
{
    private $_homeID;
    public $sqFoot;
    public $bathCount;
    public $bedCount;
    public $description;

    /**
     * Property constructor.
     * @param $sqFoot
     * @param $bathCount
     * @param $bedCount
     * @param $description
     */
    function __construct($sqFoot, $bathCount, $bedCount, $description)
    {
        $this->sqFoot = $sqFoot;
        $this->bathCount = $bathCount;
        $this->bedCount = $bedCount;
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