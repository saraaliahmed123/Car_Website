<?php
class Event implements JsonSerializable{
    private $eventID;
    private $eventName;
    private $description;
    private $startDate;
    private $endDate;
    private $capacity; 
    private $ticketsAvailable;
    private $location;
    private $price;
    private $discountedPrice;
    private $promoCode;
    private $startTime;
    private $returnTime;

    // private $customer;
  
    function __get($name) {
      return $this->$name;
    }
  
    function __set($name,$value) {
      $this->$name = $value;
    } 
    
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
?>