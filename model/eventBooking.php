<?php
class EventBooking extends Booking{
    private $eventID;

    function __get($name) {
        return $this->$name;
      }
    
      function __set($name,$value) {
        $this->$name = $value;
      }
        
}?>