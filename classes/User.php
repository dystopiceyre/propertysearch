<?php

/**
 * Class User
 */
class User extends Person
{
    private $_userID;

    /**
     * User constructor.
     * @param $phone
     * @param $email
     * @param $name
     * @param $password
     * @param $userID
     */
    function __construct($phone, $email, $name, $password, $userID)
    {
        parent::__construct($phone, $email, $name, $password);
        $this->_userID = $userID;
    }
}