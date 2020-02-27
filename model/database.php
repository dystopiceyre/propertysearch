<?php

class PropertyDatabase
{
    //PDO object
    private $_db;

    function __construct()
    {
        require('/home/oringhis/propertyConfig.php');
        try {
            $this->_db = new PDO(DB_PROP_DSN, DB_PROP_USERNAME, DB_PROP_PASSWORD);
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
        //1. Define the query
        $sql = "SELECT * FROM property";
        //2. Prepare the statement
        $statement = $this->_db->prepare($sql);
        //3. Bind the parameters
        //4. Execute the statement
        $statement->execute();
        //5. Get the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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
        $statement = $this->_db->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':sqFoot', $property->getSqFoot());
        $statement->bindParam(':bathCount', $property->getBathCount());
        $statement->bindParam(':bedCount', $property->getBedCount());
        $statement->bindParam(':description', $property->getDescription());

        //4. Execute the statement
        $statement->execute();

        //Get the key of the last inserted row
        $id = $this->_db->lastInsertId();
    }
}