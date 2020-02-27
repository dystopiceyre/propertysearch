<?php

class PropertyDatabase
{
    //PDO object
    private $_dbh;

    function __construct()
    {
        try {
            //Create a new PDO connection
            $this->_dbh = new PDO(DB_DPROP_SN, DB_PROP_USERNAME, DB_PROP_PASSWORD);
            //echo "Connected!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

//    function getHomeID() {
//        //1. Define the query
//        $sql = "SELECT property_id FROM property";
//        //2. Prepare the statement
//        //3. Bind the parameters
//        //4. Execute the statement
//        //5. Get the result
//    }

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
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Get the result
    }

    function getCondos()
    {
        //TODO
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Get the result
    }

    function getApartments()
    {
        //TODO
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Get the result
    }

    function getAgents()
    {
        //TODO
        //1. Define the query
        //2. Prepare the statement
        //3. Bind the parameters
        //4. Execute the statement
        //5. Get the result
    }

    function getUsers()
    {
        //TODO
    }

    function addProperty($property)
    {
        //1. Define the query
        $sql = "INSERT INTO property(sqFoot, type, bathCount, bedCount, description)
                VALUES (:sqFoot, :type, :bathCount, :bedCount, :description)";

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