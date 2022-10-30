<?php
class VehicleBooking extends Booking{
    // Attribute Declarations
    private $registrationNumber;
    private $startDate;
    private $endDate;

    // Magic Getter and Setter    
    function __get($name) {
        return $this->$name;
    }

    function __set($name,$value) {
        $this->$name = $value;
    }
}?>