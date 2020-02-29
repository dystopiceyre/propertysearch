<?php

class PropertyValidator
{
    
    function validSqFoot($sqFoot)
    {
        return !empty($sqFoot) && ctype_digit($sqFoot) && $sqFoot >= 250;
    }

    function validBath($bathCount)
    {
        return !empty($bathCount) && ctype_digit($bathCount) && $bathCount > 0;
    }

    function validBed($bedCount)
    {
        return !empty($bedCount) && ctype_digit($bedCount) && $bedCount > 0;
    }

    function validDescription($description)
    {
        return preg_match('/^[A-Za-z ,.]*$/', $description);
    }

    function validPrice($price)
    {
        return !empty($price) && ctype_digit($price) && $price > 500;
    }

    function validYearBuilt($yearBuilt)
    {
        return ctype_digit($yearBuilt) && $yearBuilt >= 1600 && $yearBuilt <= 2020;
    }

    function validLocation($location)
    {
        return !empty($location) && ctype_digit($location) && preg_match('/\d{5}/', $location);
    }

    function validFloor($floor) {
        return ctype_digit($floor) && $floor > 0;
    }

     function validType($type, $f3)
     {
         return in_array($type, $f3->get('types'));
     }
}
