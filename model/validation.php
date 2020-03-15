<?php

class PropertyValidator
{
    private $_f3;
    private $_errors;

    /**
     * PropertyValidator constructor.
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    public function validLogin($sqlPerson)
    {
        $isValid = true;

        if (empty($sqlPerson)) {
            $isValid = false;
            $this->_f3->set("errors['login']", "Invalid login");
        }

        return $isValid;
    }

    /**
     * @return bool
     */
    function validProfile()
    {
        $isValid = true;

        // Checks if first name entered is valid
        if (!$this->validName($this->_f3->get('fname'))) {
            $isValid = false;
            $this->_f3->set("errors['fname']", "Please enter a valid first name");
        }

        // Checks if last name entered is valid
        if (!$this->validName($this->_f3->get('lname'))) {
            $isValid = false;
            $this->_f3->set("errors['lname']", "Please enter a valid last name");
        }

        // Checks if password entered follows guidelines
        if (!$this->validPassword($this->_f3->get('password'))) {
            $isValid = false;
            $this->_f3->set("errors['password']", "Password must be minimum 7 characters!");
        }

        // Checks if the repeated password matches the original
        if ($this->_f3->get('passRepeat') != $this->_f3->get('password')) {
            $isValid = false;
            $this->_f3->set("errors['passRepeat']", "Passwords must match!");
        }

        if (!$this->_f3->get('email')) {
            $isValid = false;
            $this->_f3->set("errors['email']", "Please enter a valid email");
        }

        if (!$this->validPhone($this->_f3->get('phone'))) {
            $isValid = false;
            $this->_f3->set("errors['phone']", "Please enter a 10 digit number");
        }

        if (!$isValid) {
            $this->_f3->set("errors['invalidProf']", "One or more fields not properly set!");
        }

        return $isValid;
    }

    /** Function to validate if the variable passed in complies with the rules for what a name can have
     * @return boolean
     */
    function validName($name)
    {
        return preg_match('/[a-z]/i', $name);
    }

    function validPassword($pass)
    {
        $regex = "/[\w\d]{7}/";
        return preg_match($regex, $pass);
    }

    /** Function to validate the phone number by checking length and what characters were put in
     * @return boolean
     */
    function validPhone($PN)
    {
        return preg_match('/^[0-9]{9}/', $PN);
    }

    // ----------------------------- Home validation below -----------------------------

    /**
     * Ensures square footage is within a valid range
     * @param $sqFoot
     * @return bool
     */
    function validSqFoot($sqFoot)
    {
        return !empty($sqFoot) && ctype_digit($sqFoot) && $sqFoot >= 250 && $sqFoot <= 100000;
    }

    /**
     * Ensures bath count is within a valid range
     * @param $bathCount
     * @return bool
     */
    function validBath($bathCount)
    {
        return !empty($bathCount) && preg_match('/\d+(\.5)?/', $bathCount) && $bathCount > 0 && $bathCount <= 10;
    }

    /**
     * Ensures bed count is within a valid range
     * @param $bedCount
     * @return bool
     */
    function validBed($bedCount)
    {
        return !empty($bedCount) && ctype_digit($bedCount) && $bedCount > 0 && $bedCount <= 10;
    }

    /**
     * Ensures the description only has alphanumeric characters
     * and chosen punctuation marks
     * @param $description
     * @return false|int
     */
    function validDescription($description)
    {
        return preg_match('/^[A-Za-z0-9 ,.]*$/', $description);
    }

    /**
     * Ensures price is within a valid range
     * @param $price
     * @return bool
     */
    function validPrice($price)
    {
        return !empty($price) && ctype_digit($price) && $price > 500 && $price <= 50000000;
    }

    /**
     * Ensures year built is within a valid range
     * @param $yearBuilt
     * @return bool
     */
    function validYearBuilt($yearBuilt)
    {
        return ctype_digit($yearBuilt) && $yearBuilt >= 1600 && $yearBuilt <= 2020;
    }

    /**
     * Ensures chosen type is in F3 type array
     * @param $type
     * @return bool
     */
    public function validType($type)
    {
        //TODO: use F3 array of type
        return in_array($type, array('house', 'apartment', 'condo'));
    }

    /**
     * Ensures zip code matches US 5 digit with optional +4 pattern
     * @param $location
     * @return bool
     */
    function validLocation($location)
    {
        return !empty($location) && preg_match('/\d{5}(-\d{4})?/', $location);
    }

    /**
     * Ensures floor choice is within valid range
     * floor max is tallest residential building
     * @param $floor
     * @return bool
     */
    function validFloor($floor)
    {
        return ctype_digit($floor) && $floor >= 1 && $floor >= 131;
    }

    /**
     * Returns error messages
     * @return mixed
     */
    public function getErrors()
    {
        return $this->_errors;
    }
}
