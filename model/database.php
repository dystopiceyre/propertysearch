<?php

require_once("config.php");

class PropertyDatabase
{
    //PDO object
    private $_dbh;

    function __construct()
    {
        try {
            //Create a new PDO connection
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Connected!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getProperties()
    {
        //TODO
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Get the result
    }

    function getHouses()
    {
        //TODO
    }

    function getCondos()
    {
        //TODO
    }

    function getApartments()
    {
        //TODO
    }

    function getAgents()
    {
        //TODO
    }

    function getUsers()
    {
        //TODO
    }

    function addProperty($property)
    {
        //1. Define the query
        $sql = "INSERT INTO property(sqFoot, bathCount, bedCount, description)
                VALUES (:sqFoot, :bathCount, :bedCount, :description)";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':sqFoot', $property->getSqFoot());
        $statement->bindParam(':bathCount', $property->getBathCount());
        $statement->bindParam(':bedCount', $property->getBedCount());
        $statement->bindParam(':description', $property->getDescription());

        //4. Execute the statement
        $statement->execute();

        //Get the key of the last inserted row
        $id = $this->_dbh->lastInsertId();
    }
}