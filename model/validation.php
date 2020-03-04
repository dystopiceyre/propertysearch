<?php

class PropertyValidator
{
    private $_f3;

    public function __construct($_f3) {
        $this->_f3 = $_f3;
    }

    function validRegister() {
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
    function validName($name) {
        return preg_match('/^[a-zA-Z]/', $name);
    }

    /* Function to validate the phone number by checking length and what characters were put in
     * @return boolean
     */
    function validPhone($PN) {
        return preg_match('/^[0-9]{9}/', $PN);
    }

    // ----------------------------- Home validation below -----------------------------

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

    public function validPrice($price)
    {
        return ctype_digit($price) && $price > 500;
    }

    public function validType($type)
    {
        //TODO: use F3 array of type
        return in_array($type, array('house','apartment','condo'));
    }

    public function getErrors()
    {
        return $this->_errors;
    }
}
