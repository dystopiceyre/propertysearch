<?php

/**
 * Class Person
 */
class Person
{

    public $fname;
    public $lname;
    public $email;
    private $_password;
    public $phone;
    public $admin;

    /**
     * Person constructor.
     * @param $phone
     * @param $email
     * @param $name
     * @param $_password
     */
    function __construct($fname, $lname, $email, $password, $phone, $admin)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->_password = $password;
        $this->phone = $phone;
        $this->admin = $admin;
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
    public function getFName()
    {
        return $this->fname;
    }

    /**
     * @param $name
     */
    public function setFName($name)
    {
        $this->fname = $name;
    }

    /**
     * @return mixed
     */
    public function getLName()
    {
        return $this->lname;
    }

    /**
     * @param $name
     */
    public function setLName($name)
    {
        $this->lname = $name;
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

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

}