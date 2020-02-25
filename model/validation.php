<?php

class PropertyValidator
{
    function validSqFoot($sqFoot)
    {
        return ctype_digit($sqFoot);
    }

    function validBath($bathCount)
    {
        return ctype_digit($bathCount);
    }

    function validBed($bedCount)
    {
        return ctype_digit($bedCount);
    }

    function validDescription($description)
    {
        return preg_match('/^[A-Za-z ,.]*$/', $description);
    }

    public function getErrors()
    {
        return $this->_errors;
    }
}
