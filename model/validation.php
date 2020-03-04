<?php

class PropertyValidator
{
    private $_f3;

    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    function validRegister()
    {
        $isValid = true;

        if (!$this->validName($this->_f3->get('fname'))) {
            $isValid = false;
            $this->_f3->set("errors['fname']", "Please enter a valid first name");
        }

        if (!$this->validName($this->_f3->get('lname'))) {
            $isValid = false;
            $this->_f3->set("errors['lname']", "Please enter a valid last name");
        }

        if (!$this->_f3->get('email')) {
            $isValid = false;
            $this->_f3->set("errors['email']", "Please enter a valid email");
        }

        if (!$this->validPhone($this->_f3->get('phone'))) {
            $isValid = false;
            $this->_f3->set("errors['phone']", "Please enter a 10 digit number");
        }

        return $isValid;
    }

    /* Function to validate if the variable passed in complies with the rules for what a name can have
     * @return boolean
     */
    function validName($name)
    {
        return preg_match('/^[a-zA-Z]/', $name);
    }

    /* Function to validate the phone number by checking length and what characters were put in
     * @return boolean
     */
    function validPhone($PN)
    {
        return preg_match('/^[0-9]{9}/', $PN);
    }

    // ----------------------------- Home validation below -----------------------------

    function validSqFoot($sqFoot)
    {
        return !empty($sqFoot) && ctype_digit($sqFoot) && $sqFoot >= 250;
    }

    function validBath($bathCount)
    {
        return !empty($bathCount) && preg_match('/\d(\.5)?/') && $bathCount > 0;
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

    public function validType($type)
    {
        //TODO: use F3 array of type
        return in_array($type, array('house', 'apartment', 'condo'));
    }

    function validLocation($location)
    {
        return !empty($location) && ctype_digit($location) && preg_match('/\d{5}/', $location);
    }

    function validFloor($floor) {
        return ctype_digit($floor) && $floor >= 1;
    }

    public function getErrors()
    {
        return $this->_errors;
    }
}
