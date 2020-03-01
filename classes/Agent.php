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
     * @param $password
     */
    function __construct($phone, $email, $name, $password, $agentID)
    {
        parent::__construct($phone, $email, $name, $password);
        $this->_agentID = $agentID;
    }
}