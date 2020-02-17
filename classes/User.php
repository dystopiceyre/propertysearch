<?php

class User extends Person
{
    private $_userID;

    function __construct($phone, $email, $name, $_password)
    {
        parent::__construct($phone, $email, $name, $_password);
    }
}