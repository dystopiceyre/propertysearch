<?php

/**
 * Class Agent
 */
class Agent extends Person
{
    private $_agentID;

    /**
     * Agent constructor.
     * @param $fname
     * @param $lname
     * @param $email
     * @param $password
     * @param $phone
     */
    function __construct($fname, $lname, $email, $password, $phone)
    {
        parent::__construct($fname, $lname, $email, $password, $phone, 1);
    }
}