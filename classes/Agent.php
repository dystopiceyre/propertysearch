<?php

/**
 * Class Agent
 */
class Agent extends Person
{
    private $_agentID;

    /**
     * Agent constructor.
     * @param $phone
     * @param $email
     * @param $name
     * @param $_password
     */
    function __construct($fname, $lname, $email, $password, $phone)
    {
        parent::__construct($fname, $lname, $email, $password, $phone, 1);
    }
}