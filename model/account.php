<?php
class Account {
        private $customerID;
        private $title;
        private $firstName;
        private $lastName;
        private $email;
        private $username;
        private $password;
        private $address;
        private $contactNumber;
        private $licenceNumber;
        private $licenceExpiryDate;
        private $role;

        function __construct() {

        }

        function __get($name) {
                return $this->$name;
            }
        
            function __set($name,$value) {
                $this->$name = $value;
            }

}?>