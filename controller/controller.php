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
        $_SESSION['navColor'] = "text-white";
        $view = new Template();
        echo $view->render('views/landing-page.html');
    }

    public function loginPage()
    {
        $_SESSION['navColor'] = "text-dark";
        $view = new Template();
        echo $view->render('views/login.html');
    }

    public function registerPage()
    {
        $_SESSION['navColor'] = "text-dark";
        $view = new Template();
        echo $view->render('views/register.html');
    }

    public function properties()
    {
        $_SESSION['navColor'] = "text-dark";
        $properties = $GLOBALS['db']->getProperties();
        $this->_f3->set('properties', $properties);
        $template = new Template();
        echo $template->render('views/homes.html');
    }

    public function add()
    {
        $_SESSION['navColor'] = "text-dark";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = $_POST['type'];
            if ($this->_validator->validType($type, $this->_f3)) {
                $_SESSION['type'] = $type;
            }
            $sqFoot = $_POST['sqFoot'];
            if ($this->_validator->validSqFoot($sqFoot)) {
                $_SESSION['sqFoot'] = $sqFoot;
            }
            $bathCount = $_POST['bathCount'];
            if ($this->_validator->validBath($bathCount)) {
                $_SESSION['bathCount'] = $bathCount;
            }
            $bedCount = $_POST['bedCount'];
            if ($this->_validator->validBed($bedCount)) {
                $_SESSION['bedCount'] = $bedCount;
            }
            $price = $_POST['price'];
            if ($this->_validator->validPrice($price)) {
                $_SESSION['price'] = $price;
            }
            $yearBuilt = $_POST['yearBuilt'];
            if ($this->_validator->validYearBuilt($yearBuilt)) {
                $_SESSION['yearBuilt'] = $yearBuilt;
            }
            $location = $_POST['location'];
            if ($this->_validator->validLocation($location)) {
                $_SESSION['location'] = $location;
            }
            $description = $_POST['description'];
            if ($this->_validator->validDescription($description)) {
                $_SESSION['description'] = $description;
            }
            //Instantiate a property object
            $property = new Property($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description);

            //Write property to the database and grab last insert ID
            $id = $GLOBALS['db']->addProperty($property, $price, $type);

            if ($type == 'house') {
                if ($_POST['rentbuy'] == 'rent') {
                    $rent = true;
                }
                else {
                    $rent = false;
                }
                $house = new House($sqFoot, $bathCount, $bedCount, $yearBuilt, $location, $description, $rent, $price);
                $GLOBALS['db']->addHouse($house, $id);
            } else {
                $floorLevel = $_POST['floor'];
                if ($this->_validator->validFloor($floorLevel)) {
                    $_SESSION['floor'] = $floorLevel;
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
            echo "errors!";
            //Add POST array data to f3 hive for "sticky" form
            $this->_f3->set('property', $_POST);
        }

        $template = new Template();
        echo $template->render('views/new-property.html');
    }
}