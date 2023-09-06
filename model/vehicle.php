<?php
class Vehicle implements JsonSerializable
{
    // Attribute Declarations
    private $registrationNumber;
    private $make;
    private $model;
    private $colour;
    private $year;
    private $type;
    private $transmission;
    private $location;
    private $category;
    private $price;
    private $discountedPrice;
    private $promoCode;
    private $numOfPassengers;
    private $totalPrice;

    // Magic Getter and Setter    
    function __get($name)
    {
        return $this->$name;
    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function jsonSerialize(): mixed 
    {
        return get_object_vars($this);
    }
}
