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
     * @param $_password
     */
    function __construct($phone, $email, $name, $_password)
    {
        parent::__construct($phone, $email, $name, $_password);
    }
}