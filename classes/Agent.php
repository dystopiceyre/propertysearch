<?php

/**
 * Class Agent
 */
class Agent extends Person
{
    private $_agentID;

    /* TODO: find out if SQL's auto-increment feature
    works when adding items to a database from PHP */

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