<?php

/*
 * controller.php
 * Handles all user requests, passes data to the model, and returns views
 * Sets Fat Free Framework routes for the project
 * @author     Joshua Kristiansen jkristiansen@mail.greenriver.edu
 * @author     Olivia Ringhiser oringhiser@mail.greenriver.edu
 */
class PropertyController
{

    private $_f3;
    private $_validator;

    public function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->_validator = new PropertyValidator($this->_f3);
        $this->_f3->set('types', array('house', 'condo', 'apartment'));
    }

    public function landingPage()
    {
        $_SESSION['navDark'] = false;
        $view = new Template();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = strtolower($_POST['typeSelect']);
            $zip = substr(trim($_POST['zip']), 0, 2);
            $_SESSION['type'] = $type;
            $_SESSION['location'] = $zip;
            $this->_f3->reroute('/homes');
        }

        echo $view->render('views/landing-page.html');
    }

    /**
     * Displays the login page
     * Checks to see if user is already logged, redirects to /home if true.
     *
     * SESSION VARIABLES ADDED IN VALIDATION
     */
    public function loginPage()
    {
        $_SESSION['navDark'] = true;

        if (!(empty($_SESSION['fname']))) {
            $this->_f3->reroute('/homes');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $_POST['email'];
            $password = $_POST['password'];

            $this->_f3->set('username', $username);
            $this->_f3->set('password', $password);

            $sqlPerson = $GLOBALS['db']->loginCheck($this->_f3->get('username'), $this->_f3->get('password'));

            if ($this->_validator->validLogin($sqlPerson)) {

                // Write to variables
                $fname = $sqlPerson['user_first'];
                $lname = $sqlPerson['user_last'];
                $email = $sqlPerson['user_email'];
                $password = $sqlPerson['user_password'];
                $phone = $sqlPerson['user_phone'];;
                $admin = $sqlPerson['user_admin'];

                // Write user info to SESSION variable
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['phone'] = $phone;
                $_SESSION['admin'] = $admin;

                if ($_SESSION['admin'] == 1) {
                    $person = new Agent($fname, $lname, $email, $password, $phone);
                } else {
                    $person = new User($fname, $lname, $email, $password, $phone);
                }

                $_SESSION['person'] = $person;

                $this->_f3->reroute('/homes');
            }

        }

        $view = new Template();
        echo $view->render('views/login.html');
    }

    /**
     * Once called, this function reroutes to login
     * Checks to see if user is already logged, redirects to /home if true.
     */
    public function logout()
    {
        $this->_f3->reroute('/login');
    }

    /**
     * Displays the register page
     * POST takes in all input info and creates a new person class,
     * also
     */
    public function registerPage()
    {
        $_SESSION['navDark'] = true;

        if (!(empty($_SESSION['fname']))) {
            $this->_f3->reroute('/homes');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passRepeat = $_POST['passRepeat'];
            $phone = $_POST['phone'];
            $admin = $_POST['admin'];

            $this->_f3->set('fname', $fname);
            $this->_f3->set('lname', $lname);
            $this->_f3->set('email', $email);
            $this->_f3->set('password', $password);
            $this->_f3->set('passRepeat', $passRepeat);
            $this->_f3->set('phone', $phone);
            $this->_f3->set('admin', $admin);

            if ($this->_validator->validProfile()) {

                // Write data to Session
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['passRepeat'] = $passRepeat;
                $_SESSION['phone'] = $phone;
                $_SESSION['admin'] = $admin;

                if ($admin == 1) {
                    $person = new Agent($fname, $lname, $email, $password, $phone);
                } else {
                    $person = new User($fname, $lname, $email, $password, $phone);
                }

                $_SESSION['person'] = $person;
                $GLOBALS['db']->addPerson();

                $this->_f3->reroute('/homes');
            }
        }

        $view = new Template();
        echo $view->render('views/register.html');
    }

    /*
    * Displays profile page
    * All info editable, which when saved runs the update function
    * in database.php.
    * If user deletes their profile it reroutes to the login route
    */
    public function profilePage()
    {
        $_SESSION['navDark'] = true;
        $_SESSION['successProf'] = "";

        if (empty($_SESSION['fname'])) {
            $this->_f3->reroute('/login');
        }

        if(isset($_POST['delete'])) {
            $GLOBALS['db']->deletePerson();
            $this->_f3->reroute('/logout');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fname = $_POST['newFName'];
            $lname = $_POST['newLName'];
            $email = $_POST['newEmail'];
            if (empty($_POST['newPassword']) && empty($_POST['newPassRepeat'])) {
                $password = $_SESSION['person']->getPassword();
                $passRepeat = $password;
            } else {
                $password = $_POST['newPassword'];
                $passRepeat = $_POST['newPassRepeat'];
            }
            $phone = $_POST['newPhone'];
            $admin = $_POST['admin'];

            $this->_f3->set('fname', $fname);
            $this->_f3->set('lname', $lname);
            $this->_f3->set('email', $email);
            $this->_f3->set('password', $password);
            $this->_f3->set('passRepeat', $passRepeat);
            $this->_f3->set('phone', $phone);
            $this->_f3->set('admin', $admin);

            if ($this->_validator->validProfile()) {

                // Write data to Session
                $_SESSION['successProf'] = "Profile updated successfully!";
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['oldEmail'] = $_SESSION['email'];
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['passRepeat'] = $passRepeat;
                $_SESSION['phone'] = $phone;
                $_SESSION['admin'] = $admin;

                if ($admin == 1) {
                    $person = new Agent($fname, $lname, $email, $password, $phone);
                } else {
                    $person = new User($fname, $lname, $email, $password, $phone);
                }

                $_SESSION['person'] = $person;

                $GLOBALS['db']->editProfile();
            }
        }

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    /**
     * Displays the About Us page
     */
    public function aboutUsPage()
    {
        $_SESSION['navDark'] = true;

        $view = new Template();
        echo $view->render('views/aboutus.html');
    }

    public function showWelcome()
    {
        $view = new Template();
        echo $view->render('views/welcome.html');
    }

    /*
    * Displays the home listing page
    * Displays all property information that fit the filters
    */
    public function properties()
    {
        $_SESSION['navDark'] = true;
        $_SESSION['noResult'] = "";

        //if redirected from landing page
        if (isset($_SESSION['type'])) {
            $type = $_SESSION['type'];
            $location = $_SESSION['location'];
            if ($type == 'house') {
                $houses = $GLOBALS['db']->getHouses($location);
                $this->_f3->set('properties', $houses);
            } else if ($type == 'condo') {
                $condos = $GLOBALS['db']->getCondos($location);
                $this->_f3->set('properties', $condos);
            } else if ($type == 'apartment') {
                $apartments = $GLOBALS['db']->getApartments($location);
                $this->_f3->set('properties', $apartments);
            } else {
                //show all types
                $properties = $GLOBALS['db']->getProperties($location);
                $this->_f3->set('properties', $properties);
            }
            unset($_SESSION['type']);
        } else {
            //if using filters on page
            $type = strtolower($_GET['typeSelect']);
            $zip = substr(trim($_GET['zip']), 0, 2);
            $beds = explode("-", $_GET['beds']);
            $bedMin = trim($beds[0]);
            $bedMax = trim($beds[1]);
            $baths = explode("-", $_GET['baths']);
            $bathMin = trim($baths[0]);
            $bathMax = trim($baths[1]);
            $noSign = str_replace("$", "", $_GET['price']);
            $price = explode("-", $noSign);
            $priceMin = trim($price[0]);
            $priceMax = trim($price[1]);
            $properties = $GLOBALS['db']->filter($type, $zip, $bedMin, $bedMax, $bathMin, $bathMax, $priceMin, $priceMax);
            $this->_f3->set('properties', $properties);
        }
        $template = new Template();
        echo $template->render('views/homes.html');
    }

    /*
     * Displays the add home property page
     * On post it adds the property (if valid)
     */
    public function add()
    {
        $_SESSION['navDark'] = true;
        $isValid = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = strtolower($_POST['type']);
            if (!$this->_validator->validType($type, $this->_f3)) {
                $this->_f3->set("errors['type']", "Enter a valid type of property.");
                $isValid = false;
            }
            $sqFoot = $_POST['sqFoot'];
            if (!$this->_validator->validSqFoot($sqFoot)) {
                $this->_f3->set("errors['sqFoot']", "Enter a value of 250 square feet or greater.");
                $isValid = false;
            }
            $bathCount = $_POST['bathCount'];
            if (!$this->_validator->validBath($bathCount)) {
                $this->_f3->set("errors['bathCount']", "Enter only whole and half numbers 10 or less for the bath count.");
                $isValid = false;
            }
            $bedCount = $_POST['bedCount'];
            if (!$this->_validator->validBed($bedCount)) {
                $this->_f3->set("errors['bedCount']", "Enter only whole numbers between 1 and 10 for the bedroom count.");
                $isValid = false;
            }
            $price = $_POST['price'];
            if (!$this->_validator->validPrice($price)) {
                $this->_f3->set("errors['price']", "Enter a whole dollar amount of $500 or greater for the price.");
                $isValid = false;
            }
            $yearBuilt = $_POST['yearBuilt'];
            if (!$this->_validator->validYearBuilt($yearBuilt)) {
                $this->_f3->set("errors['yearBuilt']", "Enter a year between 1600 and 2020, inclusive.");
                $isValid = false;
            }
            $location = $_POST['location'];
            if (!$this->_validator->validLocation($location)) {
                $this->_f3->set("errors['location']", "Enter a valid 5 digit zip code.");
                $isValid = false;
            }
            $description = $_POST['description'];
            if (!$this->_validator->validDescription($description)) {
                $this->_f3->set("errors['description']", "Enter only alphanumeric characters and the following punctuation: ,.!-()");
                $isValid = false;
            }

            //Instantiate a property object
            $property = new Property($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description);

            //Write property to the database and grab last insert ID
            $id = $GLOBALS['db']->addProperty($property, $price, $type);

            if (isset($_FILES['imageUploader'])) {
                $image = $_FILES['imageUploader'];
                $validTypes = array('image/jpeg', 'image/jpg', 'image/png');
                if ($_SERVER['CONTENT_LENGTH'] > 3000000) {
                    echo "<p class='error'>File is too large. Maximum file size is 3MB.</p>";
                } else if (in_array($image['type'], $validTypes)) {
                    if ($image['error'] > 0) {
                        echo "<p class='error'>Return Code: {$image['error']}</p>";
                    }
                    if (file_exists('images/' . $image['name'])) {
                        echo "<p class='error'>Error uploading: ";
                        echo $image['name'] . " already exists.</p>";
                    } else {
                        move_uploaded_file($image['tmp_name'], 'images/' . $image['name']);
                        $GLOBALS['db']->addImage($image, $id);
                    }
                } else {
                    echo "<p class='error'>Invalid file type. Allowed types: png, jpg</p>";
                }
            }

            if ($isValid) {
                if ($type == 'house') {
                    if ($_POST['rentbuy'] == 'rent') {
                        $rent = true;
                    } else {
                        $rent = false;
                    }
                    $house = new House($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description, $rent, $price);
                    $GLOBALS['db']->addHouse($house, $id);
                } else {
                    $floorLevel = $_POST['floor'];
                    if (!$this->_validator->validFloor($floorLevel)) {
                        $this->_f3->set("errors['floor']", "Enter a number one or greater.");
                        $isValid = false;
                    }
                    if ($type == 'apartment') {
                        $apartment = new Apartment($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description, $price, $floorLevel);
                        $GLOBALS['db']->addApartment($apartment, $id);
                    }
                    if ($type == 'condo') {
                        $condo = new Condo($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description, $price, $floorLevel);
                        $GLOBALS['db']->addCondo($condo, $id);
                    }
                }

                $this->_f3->reroute('/homes');
            }
        } else {
            //Add POST array data to f3 hive for "sticky" form
            $this->_f3->set('property', $_POST);
        }

        $template = new Template();
        echo $template->render('views/new-property.html');
    }

}