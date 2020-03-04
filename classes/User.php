<?php

/**
 * Class User
 */
class User extends Person
{
    private $_userID;

    /**
     * User constructor.
     * @param $fname
     * @param $lname
     * @param $email
     * @param $_password
     * @param $phone
     */
    function __construct($fname, $lname, $email, $password, $phone)
    {
        parent::__construct($fname, $lname, $email, $password, $phone, 0);
    }
}