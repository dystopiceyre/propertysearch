<?php

class Agent extends Person
{
    private $_agentID;

    /* TODO: find out if SQL's auto-increment feature
    works when adding items to a database from PHP */

    function __construct($phone, $email, $name, $_password)
    {
        parent::__construct($phone, $email, $name, $_password);
    }
}