<?php

class PropertyController
{

    private $_f3;
    private $_validator;

    public function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->_validator = new PropertyValidator($this->_f3);
        $this->_f3->set('types', array('House', 'Condo', 'Apartment'));
    }

    public function landingPage()
    {
        $_SESSION['navDark'] = false;
        $view = new Template();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = $_POST['typeSelect'];
            $_SESSION['type'] = $type;
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

        if ($_SESSION['username']) {
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

    public function logout()
    {
        $this->_f3->reroute('/login');
    }

    public function registerPage()
    {
        $_SESSION['navDark'] = true;

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
            }
        }

        $view = new Template();
        echo $view->render('views/register.html');
    }

    public function profilePage()
    {
        $_SESSION['navDark'] = true;

        $_SESSION['successProf'] = "";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fname = $_POST['newFName'];
            $lname = $_POST['newLName'];
            $email = $_POST['newEmail'];
            if (empty($_POST['newPassword']) && empty($_POST['newPassRepeat'])) {
                $password = $_SESSION['person']->getPassword();
                $passRepeat = $password;
            }
            else {
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

    public
    function showWelcome()
    {
        $view = new Template();
        echo $view->render('views/welcome.html');
    }

    public
    function properties()
    {
        $type = $_SESSION['type'];
        $_SESSION['navDark'] = true;
        if ($type == 'House') {
            $houses = $GLOBALS['db']->getHouses();
            $this->_f3->set('properties', $houses);
        } else if ($type == 'Condo') {
            $condos = $GLOBALS['db']->getCondos();
            $this->_f3->set('properties', $condos);
        } else if ($type == 'Apartment') {
            $apartments = $GLOBALS['db']->getApartments();
            $this->_f3->set('properties', $apartments);
        } else {
            //show all types
            $properties = $GLOBALS['db']->getProperties();
            $this->_f3->set('properties', $properties);
        }
        $template = new Template();
        echo $template->render('views/homes.html');
    }

    public
    function add()
    {
        $_SESSION['navDark'] = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = $_POST['type'];
            if (!$this->_validator->validType($type, $this->_f3)) {
                $this->_f3->set("errors['type']", "Enter a valid type of property.");
            }
            $sqFoot = $_POST['sqFoot'];
            if (!$this->_validator->validSqFoot($sqFoot)) {
                $this->_f3->set("errors['sqFoot']", "Enter a value of 250 square feet or greater.");
            }
            $bathCount = $_POST['bathCount'];
            if (!$this->_validator->validBath($bathCount)) {
                $this->_f3->set("errors['bathCount']", "Enter only whole and half numbers for the bath count.");
            }
            $bedCount = $_POST['bedCount'];
            if (!$this->_validator->validBed($bedCount)) {
                $this->_f3->set("errors['bedCount']", "Enter only whole for the bedroom count.");
            }
            $price = $_POST['price'];
            if (!$this->_validator->validPrice($price)) {
                $this->_f3->set("errors['price']", "Enter a whole dollar amount of $500 or greater for the price.");
            }
            $yearBuilt = $_POST['yearBuilt'];
            if (!$this->_validator->validYearBuilt($yearBuilt)) {
                $this->_f3->set("errors['yearBuilt']", "Enter a year between 1600 and 2020, inclusive.");
            }
            $location = $_POST['location'];
            if (!$this->_validator->validLocation($location)) {
                $this->_f3->set("errors['location']", "Enter a valid 5 digit zip code.");
            }
            $description = $_POST['description'];
            if (!$this->_validator->validDescription($description)) {
                $this->_f3->set("errors['description']", "Enter only alphanumeric characters and the following punctuation: ,.!-()");
            }
            //Instantiate a property object
            $property = new Property($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description);

            //Write property to the database and grab last insert ID
            $id = $GLOBALS['db']->addProperty($property, $price, $type);

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
        } else {
            //Add POST array data to f3 hive for "sticky" form
            $this->_f3->set('property', $_POST);
        }

        $template = new Template();
        echo $template->render('views/new-property.html');
    }
}