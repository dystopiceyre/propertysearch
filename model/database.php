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

    /**
     * Retrieves properties of all types from db
     * @param $location
     * @return array
     */
    function getProperties($location)
    {
        $sql = "SELECT * FROM property WHERE location LIKE CONCAT(:location, '___%') ORDER BY prop_id";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves properties of house type from db
     * @param $location
     * @return array
     */
    function getHouses($location)
    {
        $sql = "SELECT * FROM property INNER JOIN house ON property.prop_id = house.prop_id 
        WHERE location LIKE CONCAT(:location, '___%') ORDER BY property.prop_id";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves properties of condo type from db
     * @param $location
     * @return array
     */
    function getCondos($location)
    {
        $sql = "SELECT * FROM property INNER JOIN condo ON property.prop_id = condo.prop_id 
        WHERE location LIKE CONCAT(:location, '___%') ORDER BY property.prop_id";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves properties of apartment type from db
     * @param $location
     * @return array
     */
    function getApartments($location)
    {
        $sql = "SELECT * FROM property INNER JOIN apartment ON property.prop_id = apartment.prop_id 
        WHERE location LIKE CONCAT(:location, '___%') ORDER BY property.prop_id";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a property of a given type with certain parameters from db
     * @param $type
     * @param $zip
     * @param $bedMin
     * @param $bedMax
     * @param $bathMin
     * @param $bathMax
     * @param $priceMin
     * @param $priceMax
     * @return array
     */
    function filter($type, $zip, $bedMin, $bedMax, $bathMin, $bathMax, $priceMin, $priceMax)
    {
        if ($type == 'House') {
            $sql = "SELECT * FROM property INNER JOIN house ON property.prop_id = house.prop_id WHERE location 
        LIKE CONCAT(:location, '___%') AND bed_count BETWEEN :bedMin AND :bedMax AND bath_count BETWEEN :bathMin AND 
        :bathMax AND price BETWEEN :priceMin AND :priceMax";
        } else if ($type == 'Apartment') {
            $sql = "SELECT * FROM property INNER JOIN apartment ON property.prop_id = apartment.prop_id
        WHERE location LIKE CONCAT(:location, '___%') AND bed_count BETWEEN :bedMin AND :bedMax AND bath_count
        BETWEEN :bathMin AND :bathMax AND price BETWEEN :priceMin AND :priceMax";
        } else if ($type == 'Condo') {
            $sql = "SELECT * FROM property INNER JOIN condo ON property.prop_id = condo.prop_id
        WHERE location LIKE CONCAT(:location, '___%') AND bed_count BETWEEN :bedMin AND :bedMax AND
        bath_count BETWEEN :bathMin AND :bathMax AND price BETWEEN :priceMin AND :priceMax";
        } else {
            $sql = "SELECT * FROM property WHERE location LIKE CONCAT(:location, '___%')
        AND bed_count BETWEEN :bedMin AND :bedMax AND bath_count BETWEEN :bathMin AND :bathMax 
        AND price BETWEEN :priceMin AND :priceMax";
        }
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':location', $zip);
        $statement->bindParam(':bedMin', $bedMin, PDO::PARAM_INT);
        $statement->bindParam(':bedMax', $bedMax, PDO::PARAM_INT);
        $statement->bindParam(':bathMin', $bathMin, PDO::PARAM_INT);
        $statement->bindParam(':bathMax', $bathMax, PDO::PARAM_INT);
        $statement->bindParam(':priceMin', $priceMin, PDO::PARAM_INT);
        $statement->bindParam(':priceMax', $priceMax, PDO::PARAM_INT);
        $statement->execute();

        if ($statement->rowCount() == 0) {
            $_SESSION['noResult'] = "No results";
        }
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
        $sql = "INSERT INTO users (user_first, user_last, user_email, user_password, user_phone, user_admin)
                    VALUES (:fname, :lname, :email, :password, :phone, :admin)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':fname', $_SESSION['person']->getFName());
        $statement->bindParam(':lname', $_SESSION['person']->getLName());
        $statement->bindParam(':email', $_SESSION['person']->getEmail());
        $statement->bindParam(':password', $_SESSION['person']->getPassword());
        $statement->bindParam(':phone', $_SESSION['person']->getPhone());
        $statement->bindParam(':admin', $_SESSION['person']->getAdmin());
        $statement->execute();
        echo "New user added!<br>";
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
        $sql = "INSERT INTO property(sq_Foot, bath_Count, bed_Count, description, price, type, location)
                VALUES (:sqFoot, :bathCount, :bedCount, :description, :price, :type, :location)";
        $statement = $this->_db->prepare($sql);
        $statement->bindParam(':sqFoot', $property->getSqFoot(), PDO::PARAM_INT);
        $statement->bindParam(':bathCount', $property->getBathCount());
        $statement->bindParam(':bedCount', $property->getBedCount(), PDO::PARAM_INT);
        $statement->bindParam(':description', $property->getDescription(), PDO::PARAM_STR);
        $statement->bindParam(':price', $price, PDO::PARAM_INT);
        $statement->bindParam(':type', $type, PDO::PARAM_STR);
        $statement->bindParam(':location', $property->getLocation(), PDO::PARAM_INT);
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
        echo "New house added!<br>";
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