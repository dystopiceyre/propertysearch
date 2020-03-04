<?php

class PropertyDatabase
{
    //PDO object
    private $_db;

    function __construct()
    {
        require('/home/joshicgr/config.php');
        try {
            $this->_db = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
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

    function addPerson() {

        // 1. Define the query
        $sql = "INSERT INTO users (user_first, user_last, user_email, user_password, user_phone, user_admin)
                    VALUES (:fname, :lname, :email, :password, :phone, :admin)";

        // 2. Prepare the statement
        $statement = $this->_db->prepare($sql);

        // 3.Bind the parameters
        $statement->bindParam(':fname', $_SESSION['person']->getFName());
        $statement->bindParam(':lname', $_SESSION['person']->getLName());
        $statement->bindParam(':email', $_SESSION['person']->getEmail());
        $statement->bindParam(':password', $_SESSION['person']->getEmail());
        $statement->bindParam(':phone', $_SESSION['person']->getPhone());
        $statement->bindParam(':admin', $_SESSION['person']->getAdmin());

        // 4. Execute the statement
        $statement->execute();

        echo "New user added!<br>";
        return $user = $this->_db->lastInsertId();
    }

    function addProperty($property, $price, $type)
    {
        //1. Define the query
        $sql = "INSERT INTO property(sq_Foot, bath_Count, bed_Count, description, price, type)
                VALUES (:sqFoot, :bathCount, :bedCount, :description, :price, :type)";

        //2. Prepare the statement
        $statement = $this->_db->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':sqFoot', $property->getSqFoot(), PDO::PARAM_INT);
        $statement->bindParam(':bathCount', $property->getBathCount());
        $statement->bindParam(':bedCount', $property->getBedCount(), PDO::PARAM_INT);
        $statement->bindParam(':description', $property->getDescription(), PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_INT);
        $statement->bindParam(':type', $type, PDO::PARAM_STR);

        //4. Execute the statement
        $statement->execute();
        echo "New property added!<br>";
        return $id = $this->_db->lastInsertId();
    }

    function addHouse($house, $id)
    {
        $sql = "INSERT INTO house(prop_id, rent) VALUES (:prop_id, :rent)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':rent', $house->getRentBuy());
        $statement->bindParam(':prop_id', $id);
        $statement->execute();
        echo "new house added!<br>";
    }

    function addApartment($id)
    {
        $sql = "INSERT INTO apartment(prop_id) VALUE (:prop_id)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':prop_id', $id);
        $statement->execute();
        echo "New apartment added!<br>";
    }

    function addCondo($id)
    {
        $sql = "INSERT INTO condo(prop_id) VALUE (:prop_id)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':prop_id', $id, PDO::PARAM_INT);
        $statement->execute();
        echo "New condo added!<br>";
    }
}