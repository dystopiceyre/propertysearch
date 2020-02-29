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
//        $sql = "SELECT property_id FROM property";
//        $statement = $this->_db->prepare($sql);
//        $statement->execute();
//        return $statement->fetch(PDO::FETCH_OBJ);
//    }

    function getProperties()
    {
        $sql = "SELECT * FROM property";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getHouses()
    {
        $sql = "SELECT * FROM house";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCondos()
    {
        $sql = "SELECT * FROM condo";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getApartments()
    {
        $sql = "SELECT * FROM apartment";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAgents()
    {
        //TODO
    }

    function getUsers()
    {
        //TODO
    }

    function addProperty($property, $price, $type)
    {

        $sql = "INSERT INTO property(sq_Foot, bath_Count, bed_Count, location, year_built, description, price, type)
               VALUES (:sqFoot, :bathCount, :bedCount, :location, :yearBuilt, :description, :price, :type)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':sqFoot', $property->getSqFoot(), PDO::PARAM_INT);
        $statement->bindParam(':bathCount', $property->getBathCount());
        $statement->bindParam(':bedCount', $property->getBedCount(), PDO::PARAM_INT);
        $statement->bindParam(':location', $property->getLocation());
        $statement->bindParam(':yearBuilt', $property->getYearBuilt(), PDO::PARAM_INT);
        $statement->bindParam(':description', $property->getDescription(), PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_INT);
        $statement->bindParam(':type', $type, PDO::PARAM_STR);
        $statement->execute();
        echo "<h3>New property added!</h3><br>";
        return $id = $this->_db->lastInsertId();
    }

    function addHouse($house, $id)
    {
        $sql = "INSERT INTO house(prop_id, rent) VALUES (:prop_id, :rent)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':rent', $house->getRentBuy());
        $statement->bindParam(':prop_id', $id);
        $statement->execute();
        echo "<h3>New house added!</h3><br>";
    }

    function addApartment($apartment, $id)
    {
        $sql = "INSERT INTO apartment(prop_id, floor_level) VALUE (:prop_id, :floor)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':prop_id', $id, PDO::PARAM_INT);
        $statement->bindParam(':floor', $apartment->getFloorLevel(), PDO::PARAM_INT);
        $statement->execute();
        echo "<h3>New apartment added!</h3><br>";
    }

    function addCondo($condo, $id)
    {
        $sql = "INSERT INTO condo(prop_id, floor_level) VALUE (:prop_id, :floor)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':prop_id', $id, PDO::PARAM_INT);
        $statement->bindParam('floor', $condo->getFloorLevel(), PDO::PARAM_INT);
        $statement->execute();
        echo "<h3>New condo added!</h3><br>";
    }
}