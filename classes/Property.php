<?php

class Property
{
    private $_homeID;
    public $sqFoot;
    public $bathCount;
    public $bedCount;
    public $description;

    function __construct($sqFoot, $bathCount, $bedCount, $description)
    {
        $this->sqFoot = $sqFoot;
        $this->bathCount = $bathCount;
        $this->bedCount = $bedCount;
        $this->description = $description;
    }

    public function getHomeID()
    {
        return $this->_homeID;
    }

    public function getSqFoot()
    {
        return $this->sqFoot;
    }

    public function setSqFoot($sqFoot)
    {
        $this->sqFoot = $sqFoot;
    }

    public function getBathCount()
    {
        return $this->bathCount;
    }

    public function setBathCount($bathCount)
    {
        $this->bathCount = $bathCount;
    }

    public function getBedCount()
    {
        return $this->bedCount;
    }

    public function setBedCount($bedCount)
    {
        $this->bedCount = $bedCount;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

}