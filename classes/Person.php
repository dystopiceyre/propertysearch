<?php

class Person
{
    public $phone;
    public $email;
    public $name;
    private $_password;

    function __construct($phone, $email, $name, $_password)
    {
        $this->phone = $phone;
        $this->email = $email;
        $this->name = $name;
        $this->_password = $_password;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

}