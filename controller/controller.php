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
            $description = $_POST['description'];
            if ($this->_validator->validDescription($description)) {
                $_SESSION['description'] = $description;
            }
            //Instantiate a property object
            $property = new Property($sqFoot, $bathCount, $bedCount, $description);

            //Write property to the database and grab last insert ID
            $id = $GLOBALS['db']->addProperty($property, $price, $type);

            if ($type == 'house') {
                $rentbuy = $_POST['rentbuy'];
                $house = new House($sqFoot, $bathCount, $bedCount, $description, $rentbuy, $price);
                $GLOBALS['db']->addHouse($house, $id);
            }
            if ($type == 'apartment') {
                $GLOBALS['db']->addApartment($id);
            }
            if ($type == 'condo') {
                $GLOBALS['db']->addCondo($id);
            }

        } else {
            //Data was not valid
            //Get errors from Validator and add to f3 hive
            $this->_f3->set('errors', $this->_validator->getErrors());
            echo "data is not valid!";
            //Add POST array data to f3 hive for "sticky" form
            $this->_f3->set('property', $_POST);
        }

        $template = new Template();
        echo $template->render('views/new-property.html');
    }
}