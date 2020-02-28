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
        $view = new Template();
        echo $view->render('views/landing-page.html');
    }

    public function properties()
    {
        $properties = $GLOBALS['db']->getProperties();
        $this->_f3->set('properties', $properties);
        $template = new Template();
        echo $template->render('views/homes.html');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sqFoot = $_POST['sqFoot'];
            if ($this->_validator->validSqFoot($sqFoot)) {
                $_SESSION['sqFoot'] = $sqFoot;
            }
            $type = $_POST['type'];
            if ($this->_validator->validType($type)) {
                $_SESSION['type'] = $type;
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