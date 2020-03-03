<?php


class PropertyController
{

    private $_f3;
    private $_validator;

    public function __construct($f3)
    {
        $this->_f3 = $f3;
        $this->_validator = new PropertyValidator();
        $this->_f3->set('types', array('House', 'Condo', 'Apartment'));
    }

    public function landingPage()
    {
        $_SESSION['navDark'] = false;
        $view = new Template();
        echo $view->render('views/landing-page.html');
    }

    public function loginPage()
    {
        $_SESSION['navDark'] = true;
        $view = new Template();
        echo $view->render('views/login.html');
    }

    public function registerPage()
    {
        $_SESSION['navDark'] = true;
        $view = new Template();
        echo $view->render('views/register.html');
    }

    public function properties()
    {
        $_SESSION['navDark'] = true;
        $properties = $GLOBALS['db']->getProperties();
        $this->_f3->set('properties', $properties);
        $template = new Template();
        echo $template->render('views/homes.html');
    }

    public function add()
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