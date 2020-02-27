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
    function __construct($phone, $email, $name, $_password)
    {
        parent::__construct($phone, $email, $name, $_password);
    }
}