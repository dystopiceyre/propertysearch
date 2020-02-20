<?php

/**
 * Class Person
 */
class Person
{
    public $phone;
    public $email;
    public $name;
    private $_password;

    /**
     * Person constructor.
     * @param $phone
     * @param $email
     * @param $name
     * @param $_password
     */
    function __construct($phone, $email, $name, $_password)
    {
        $this->phone = $phone;
        $this->email = $email;
        $this->name = $name;
        $this->_password = $_password;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
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