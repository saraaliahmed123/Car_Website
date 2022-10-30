<?php
class Promotion implements JsonSerializable {
    private $promoCode;
    private $startDate;
    private $endDate;
    private $discount;
    private $type;

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

}?>