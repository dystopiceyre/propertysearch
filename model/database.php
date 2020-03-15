<?php

class PropertyDatabase
{
    //PDO object
    private $_db;

    /**
     * PropertyDatabase constructor.
     */
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

    /**
     * Retrieves properties of all types from db
     * @return array
     */
    function getProperties()
    {
        $sql = "SELECT * FROM property ORDER BY prop_id";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves properties of house type from db
     * @return array
     */
    function getHouses()
    {
        $sql = "SELECT * FROM property INNER JOIN house ON property.prop_id = house.prop_id ORDER BY property.prop_id";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves properties of condo type from db
     * @return array
     */
    function getCondos()
    {
        $sql = "SELECT * FROM property INNER JOIN condo ON property.prop_id = condo.prop_id ORDER BY property.prop_id";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves properties of apartment type from db
     * @return array
     */
    function getApartments()
    {
        $sql = "SELECT * FROM property INNER JOIN apartment ON property.prop_id = apartment.prop_id ORDER BY property.prop_id";
        $statement = $this->_db->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves agents from db
     */
    function getAgents()
    {
        //TODO
    }

    /**
     * Retrieves users (buyers) from db
     */
    function getUsers()
    {
        //TODO
    }

    /**
     * Checks if the login information provided exists in the database
     * @param $username
     * @param $password
     * @return bool
     */
    function loginCheck($username, $password)
    {
        $sql = "SELECT * FROM users
                WHERE user_email = :username
                AND user_password = :password";

        $statement = $this->_db->prepare($sql);

        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Edits a persons info based on information
     * gathered from the profile edit page,
     * inserts into db.
     */
    function editProfile()
    {

        // 1. Define the query
        $sql = "UPDATE users SET users.user_first = :fname, users.user_last = :lname, users.user_email = :email,
                            users.user_password = :password, users.user_phone = :phone, users.user_admin = :admin
                WHERE users.user_email = :oldEmail";

        // 2. Prepare the statement
        $statement = $this->_db->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':fname', $_SESSION['person']->getFName());
        $statement->bindParam(':lname', $_SESSION['person']->getLName());
        $statement->bindParam(':email', $_SESSION['person']->getEmail());
        $statement->bindParam(':oldEmail', $_SESSION['oldEmail']);
        $statement->bindParam(':password', $_SESSION['person']->getPassword());
        $statement->bindParam(':phone', $_SESSION['person']->getPhone());
        $statement->bindParam(':admin', $_SESSION['person']->getAdmin());

        // 4. Execute the statement
        $statement->execute();

        return $user = $this->_db->lastInsertId();
    }

    /**
     * Adds a person (agent or buyer) to db
     * Returns the person's id
     * @return string
     */
    function addPerson()
    {

        // 1. Define the query
        $sql = "INSERT INTO users (user_first, user_last, user_email, user_password, user_phone, user_admin)
                    VALUES (:fname, :lname, :email, :password, :phone, :admin)";

        // 2. Prepare the statement
        $statement = $this->_db->prepare($sql);

        // 3.Bind the parameters
        $statement->bindParam(':fname', $_SESSION['person']->getFName());
        $statement->bindParam(':lname', $_SESSION['person']->getLName());
        $statement->bindParam(':email', $_SESSION['person']->getEmail());
        $statement->bindParam(':password', $_SESSION['person']->getPassword());
        $statement->bindParam(':phone', $_SESSION['person']->getPhone());
        $statement->bindParam(':admin', $_SESSION['person']->getAdmin());

        // 4. Execute the statement
        $statement->execute();

        return $user = $this->_db->lastInsertId();
    }

    /**
     * Adds a property of a specified type to the db
     * Returns the property's id
     * @param $property
     * @param $price
     * @param $type
     * @return string
     */
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

    /**
     * Adds house info to a previously created property
     * @param $house
     * @param $id
     */
    function addHouse($house, $id)
    {
        $sql = "INSERT INTO house(prop_id, rent) VALUES (:prop_id, :rent)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':rent', $house->getRentBuy());
        $statement->bindParam(':prop_id', $id);
        $statement->execute();
        echo "new house added!<br>";
    }

    /** Adds apartment info to a previously created property
     * @param $id
     */
    function addApartment($id)
    {
        $sql = "INSERT INTO apartment(prop_id) VALUE (:prop_id)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':prop_id', $id);
        $statement->execute();
        echo "New apartment added!<br>";
    }

    /** Adds condo info to a previously created property
     * @param $id
     */
    function addCondo($id)
    {
        $sql = "INSERT INTO condo(prop_id) VALUE (:prop_id)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':prop_id', $id, PDO::PARAM_INT);
        $statement->execute();
        echo "New condo added!<br>";
    }
}