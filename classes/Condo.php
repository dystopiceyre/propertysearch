<?php

/**
 * Class Condo
 */
class Condo extends Property
{
    public $buyPrice;

    /**
     * Condo constructor.
     * @param $sqFoot
     * @param $bathCount
     * @param $bedCount
     * @param $description
     * @param $buyPrice
     */
    function __construct($sqFoot, $bathCount, $bedCount, $description, $buyPrice) {
        parent::__construct($sqFoot, $bathCount, $bedCount, $description);
        $this->buyPrice = $buyPrice;
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


}