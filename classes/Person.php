<?php

/**
 * Class Person
 */
class Person
{
    private $_phone;
    private $_email;
    private $_name;
    private $_password;

    /**
     * Person constructor.
     * @param $phone
     * @param $email
     * @param $name
     * @param $password
     */
    function __construct($phone, $email, $name, $password)
    {
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_name = $name;
        $this->_password = $password;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param $_phone
     */
    public function setPhone($_phone)
    {
        $this->_phone = $_phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param $_email
     */
    public function setEmail($_email)
    {
        $this->_email = $_email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param $_name
     */
    public function setName($_name)
    {
        $this->_name = $_name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

}