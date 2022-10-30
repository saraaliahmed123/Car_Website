<?php
class Booking {
    private $bookingReference;
    private $date;
    private $customerID; 
    private $destination;
    private $totalPaid;
    private $promoCode;
    private $bookingType;
    private $ticketsBought;

    function __get($name) {
        return $this->$name;
      }
    
      function __set($name,$value) {
        $this->$name = $value;
      }
      
}?>