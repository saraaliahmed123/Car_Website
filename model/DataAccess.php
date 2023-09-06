<?php

require_once("account.php");
require_once("vehicle.php");
require_once("booking.php");
require_once("event.php");
require_once("promotion.php");
require_once("eventBooking.php");
require_once("vehicleBooking.php");

final class DataAccess
{
    private static $pdo;
    private static $instance;

    private function __construct()
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=db_yam", "yam", "ohphiuph", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DataAccess();
        }
        return self::$instance;
    }

    function getDiscount($results)
    {
        foreach ($results as $r) {
            if ($r->promoCode) {
                $r->promoCode = self::getPromotionByPromoCode($r->promoCode);
                if ($r->promoCode->endDate >= date("Y-m-d")) {
                    $r->discountedPrice = $r->price - (($r->price / 100) * ($r->promoCode->discount));
                }
            }
        }
        return $results;
    }


    //HomePage

    //Search Bar

    function getSearchByStartOfMake($partialMake)
    {
        $statement = self::$pdo->prepare('SELECT DISTINCT make FROM Vehicle
                                    WHERE make like ?');
        $statement->execute(["$partialMake%"]);
        $makes = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

        $statement2 = self::$pdo->prepare('SELECT DISTINCT eventName FROM Event
                                WHERE eventName like ?');
        $statement2->execute(["$partialMake%"]);
        $makes2 = $statement2->fetchAll(PDO::FETCH_COLUMN, 0);


        return array_merge($makes2, $makes);
    }

    //Rental box search 
    function getRentalSearchLocation($partialMake)
    {
        $statement = self::$pdo->prepare('SELECT DISTINCT location FROM Vehicle
                                    WHERE location like ?');
        $statement->execute(["$partialMake%"]);
        $location = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

        return $location;
    }

    //Event box search 
    function getEventSearchLocation($partialMake)
    {
        $statement = self::$pdo->prepare('SELECT DISTINCT location FROM Event
                                    WHERE location like ?');
        $statement->execute(["$partialMake%"]);
        $location = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

        return $location;
    }

    //Employee Promotions

    function getPromotions()
    {
        $statement1 = self::$pdo->prepare("SELECT * FROM Event WHERE promoCode IS NOT NULL");
        $statement1->execute();
        $results1 = $statement1->fetchAll(PDO::FETCH_CLASS, "Event");

        $statement2 = self::$pdo->prepare("SELECT * FROM Vehicle WHERE promoCode IS NOT NULL");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_CLASS, "Vehicle");

        $results = array_merge($results1, $results2);

        $results = self::getDiscount($results);

        return $results;
    }

    function getAllPromotions()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Promotion WHERE endDate >= ?");
        $statement->execute([date("Y-m-d")]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Promotion");
        return $results;
    }

    function getEventByName($eventName)
    {
        $statement = self::$pdo->prepare("SELECT * FROM Event WHERE eventName = ?");
        $statement->execute([$eventName]);
        $result = $statement->fetchAll(PDO::FETCH_CLASS, "Event");
        $result[0]->promoCode = self::getPromotionByPromoCode($result[0]->promoCode);
        return $result[0];
    }

    function updateEventPromoCode($event, $promoCode)
    {
        $statement = self::$pdo->prepare("UPDATE Event SET promoCode = ? WHERE eventID = ?");
        $statement->execute([$promoCode, $event]);
    }

    function updateVehiclePromoCode($vehicle, $promoCode)
    {
        $statement = self::$pdo->prepare("UPDATE Vehicle SET promoCode = ? WHERE registrationNumber = ?");
        $statement->execute([$promoCode, $vehicle]);
    }

    function addNewPromotion($promoCode, $startDate, $endDate, $discount, $type)
    {
        $statement = self::$pdo->prepare("INSERT INTO Promotion (promoCode, startDate, endDate, discount, type) VALUES (?,?,?,?,?)");
        $statement->execute([$promoCode, $startDate, $endDate, $discount, $type]);
    }

    function getPromotionByPromoCode($promoCode)
    {
        $statement = self::$pdo->prepare("SELECT * FROM Promotion WHERE promoCode = ?");
        $statement->execute([$promoCode]);
        $result = $statement->fetchAll(PDO::FETCH_CLASS, "Promotion");
        return $result[0];
    }

    function deletePromotion($promoCode)
    {
        $statement = self::$pdo->prepare("UPDATE Vehicle SET promoCode = ? WHERE promoCode = ?");
        $statement->execute([NULL, $promoCode]);

        $statement = self::$pdo->prepare("UPDATE Event SET promoCode = ? WHERE promoCode = ?");
        $statement->execute([NULL, $promoCode]);

        $statement = self::$pdo->prepare("DELETE FROM Promotion WHERE promoCode = ?");
        $statement->execute([$promoCode]);
    }

    function editPromotion($epc, $esd, $eed, $edc, $etp)
    {
        $statement = self::$pdo->prepare("UPDATE Promotion SET startDate = ?, endDate = ?, discount = ?, type = ? WHERE promoCode = ?");
        $statement->execute([$esd, $eed, $edc, $etp, $epc]);
    }

    //Rentals

    //Sort By 
    function getRentalFilterByLowAndHigh()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Vehicle ORDER BY price");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        $results = self::getDiscount($results);
        foreach ($results as $r) {
            if (!$r->discountedPrice) {
                $r->discountedPrice = $r->price;
            }
        }
        usort($results, function ($a, $b) {
            return strcmp($a->discountedPrice, $b->discountedPrice);
        });
        return $results;
    }

    function getRentalFilterByHighAndLow()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Vehicle ORDER BY price DESC");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        $results = self::getDiscount($results);
        foreach ($results as $r) {
            if (!$r->discountedPrice) {
                $r->discountedPrice = $r->price;
            }
        }
        usort($results, function ($a, $b) {
            return strcmp($b->discountedPrice, $a->discountedPrice);
        });
        return $results;
    }

    function getRentalFilterByOldest()
    {
        $statement = self::$pdo->prepare("SELECT * FROM `Vehicle` ORDER BY dateEntered DESC");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        $results = self::getDiscount($results);

        return $results;
    }

    function getRentalFilterByNewest()
    {
        $statement = self::$pdo->prepare("SELECT * FROM `Vehicle` ORDER BY dateEntered ");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");

        $results = self::getDiscount($results);

        return $results;
    }

    //Employee
    function addVehicle($registrationNumber, $make, $model, $colour, $year, $type, $transmission, $location, $category, $price, $promoCode, $numofpass)
    {
        $statement = self::$pdo->prepare("INSERT INTO Vehicle(dateEntered, registrationNumber, make, model, colour, year, type, transmission, location, category, price, promoCode, numOfPassengers) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute([date("Y-m-d"), $registrationNumber, $make, $model, $colour, $year, $type, $transmission, $location, $category, $price, $promoCode, $numofpass]);
    }

    function deleteVehicle($rn)
    {
        $statement = self::$pdo->prepare("DELETE FROM Vehicle WHERE registrationNumber = ? ");
        $statement->execute([$rn]);
    }

    function editVehicle($make, $model, $colour, $year, $type, $transmission, $location, $category, $price, $promoCode, $numofpass, $Id)
    {
        $statement = self::$pdo->prepare("UPDATE Vehicle SET dateEntered = ?, make = ?, model = ?, colour = ?, year = ?, type = ?, transmission = ?, location = ?, category = ?, price = ?, promoCode = ?, numOfPassengers = ? WHERE registrationNumber = ?");
        $statement->execute([date("Y-m-d"), $make, $model, $colour, $year, $type, $transmission, $location, $category, $price, $promoCode, $numofpass, $Id]);
    }

    function getAvailableRentals($vehicles, $dateAvailable, $dateUnAvailable)
    {

        $arr = [$dateUnAvailable, $dateAvailable];

        $statement2 = self::$pdo->prepare("SELECT registrationNumber FROM Booking WHERE bookingType = 'vehicle' AND NOT (? <= Booking.startDate AND Booking.endDate <= ?)");

        $statement2->execute($arr);
        $results2 = $statement2->fetchAll(PDO::FETCH_CLASS, "Vehicle");


        foreach ($vehicles as $key => $vehcile) {
            foreach ($results2 as $res) {
                // print_r($res);
                if ($res->registrationNumber == $vehcile->registrationNumber) {
                    unset($vehicles[$key]);
                }
            }
        }
        return $vehicles;
    }

    function getVehicles()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Vehicle");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");

        $results = self::getDiscount($results);

        return $results;
    }

    function getVehicleById($Id)
    {
        $statement = self::$pdo->prepare("SELECT * FROM Vehicle WHERE registrationNumber = ?");
        $statement->execute([$Id]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");

        $results = self::getDiscount($results);

        return $results[0];
    }

    //get promo percentage
    function getPromoAmount($id)
    {
        $statement = self::$pdo->prepare("SELECT discount FROM Promotion WHERE promoCode = ?");
        $statement->execute([$id]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Promotion");
        return $results[0];
    }

    function getRentalSearch($location, $dateAvailable, $dateUnAvailable, $type)
    {
        $typeAmount = str_pad("?", count($type) * 2 - 1, ",?");

        $sql = "SELECT * FROM Vehicle WHERE type IN ($typeAmount) AND location = ?";

        $arrA = [$location];

        $statement = self::$pdo->prepare($sql);
        $statement->execute(array_merge($type, $arrA));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");

        $arr = self::getAvailableRentals($results, $dateAvailable, $dateUnAvailable);

        $arr = self::getDiscount($arr);

        return $arr;
    }

    //Rental filters

    function getVehicleType()
    {
        $statement = self::$pdo->prepare("SELECT type FROM Vehicle");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        $arr = [];
        foreach ($results as $type) {
            $arr[] = $type->type;
        }
        return array_unique($arr);
    }

    function getVehicleCategory()
    {
        $statement = self::$pdo->prepare("SELECT category FROM Vehicle");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        $arr = [];
        foreach ($results as $type) {
            $arr[] = $type->category;
        }
        return array_unique($arr);
    }

    function getVehicleMake()
    {
        $statement = self::$pdo->prepare("SELECT make FROM Vehicle");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        $arr = [];
        foreach ($results as $type) {
            $arr[] = $type->make;
        }
        return array_unique($arr);
    }

    function getVehicleTransmission()
    {
        $statement = self::$pdo->prepare("SELECT transmission FROM Vehicle");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        $arr = [];
        foreach ($results as $type) {
            $arr[] = $type->transmission;
        }
        return array_unique($arr);
    }

    function getVehicleLocation()
    {
        $statement = self::$pdo->prepare("SELECT location FROM Vehicle");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        $arr = [];
        foreach ($results as $type) {
            $arr[] = $type->location;
        }
        return array_unique($arr);
    }


    function getRentalFilter($type, $category, $make, $transmission, $location, $minprice, $maxprice, $dateAvailable, $dateUnAvailable)
    {
        $typeAmount = str_pad("?", count($type) * 2 - 1, ",?");
        // 0         ?     1*2=2-1=1    ?
        // 0 1       ?     2*2=4-1=3    ? ,?
        // 0 1 2     ?     3*2=6-1=5    ? ,?,?
        // 0 1 2 3   ?     4*2=8-1=7    ? ,?,?,?
        $categoryAmount = str_pad("?", count($category) * 2 - 1, ",?");
        $makeAmount = str_pad("?", count($make) * 2 - 1, ",?");
        $transmissionAmount = str_pad("?", count($transmission) * 2 - 1, ",?");
        $locationAmount = str_pad("?", count($location) * 2 - 1, ",?");
        $sql = "SELECT * FROM Vehicle WHERE type IN ($typeAmount) AND category IN ($categoryAmount) AND make IN ($makeAmount) AND transmission IN ($transmissionAmount) AND location IN ($locationAmount) AND price BETWEEN ? AND ?";
        $arrA = [$minprice, $maxprice];
        $filters = [$type, $category, $make, $transmission, $location];
        $arr = [];
        foreach ($filters as $filter) {
            $arr = array_merge($arr, $filter);
        }
        $statement = self::$pdo->prepare($sql);
        $statement->execute(array_merge($arr, $arrA));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");
        if ($dateAvailable && $dateUnAvailable) {
            $results = self::getAvailableRentals($results, $dateAvailable, $dateUnAvailable);
        }
        $results = self::getDiscount($results);
        return $results;
    }

    function getRecentVehciles()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Vehicle ORDER BY dateEntered DESC LIMIT 4");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");

        $results = self::getDiscount($results);

        return $results;
    }

    function getPopularRentals()
    {
        $statement = self::$pdo->prepare("SELECT * From Booking WHERE Booking.bookingType = 'vehicle' LIMIT 8");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleBooking");
        $a = [];
        foreach ($results as $re) {
            $a[] = self::getVehicleById($re->registrationNumber);
        }
        $arr = [];
        foreach ($a as $r) {
            $arr[] = $r->make;
        }
        $results = array_count_values($arr);
        return $results;
    }

    function getPopularEvents()
    {
        $statement = self::$pdo->prepare("SELECT * From Booking WHERE Booking.bookingType = 'event' LIMIT 8");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "EventBooking");
        $a = [];
        foreach ($results as $re) {
            $a[] = self::getEventById($re->eventID);
        }
        $arr = [];
        foreach ($a as $r) {
            $arr[] = $r->location;
        }
        $results = array_count_values($arr);
        return $results;
    }

    //search bar on nav
    function getSearch($search)
    {
        $statement = self::$pdo->prepare("SELECT * FROM Vehicle WHERE make = ?");
        $statement->execute([$search]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Vehicle");

        if (!$results) {
            $statement = self::$pdo->prepare("SELECT * FROM Event WHERE eventName = ?");
            $statement->execute([$search]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");
        }

        $results = self::getDiscount($results);

        return $results;
    }

    //Events

    //Employee

    function addEvent($eventName, $description, $startDate, $endDate, $capacity, $ticketsAvailable, $location, $price, $promoCode, $startTime, $returnTime)
    {
        $statement = self::$pdo->prepare("INSERT INTO Event (eventName, description, startDate, endDate, capacity, ticketsAvailable, location, price, promoCode, startTime, returnTime) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute([$eventName, $description, $startDate, $endDate, $capacity, $ticketsAvailable, $location, $price, $promoCode, $startTime, $returnTime]);
    }

    function deleteEvent($previousEventName)
    {
        $statement = self::$pdo->prepare("DELETE FROM Event WHERE eventName = ?");
        $statement->execute([$previousEventName]);
    }

    function editEvent($eventName, $description, $startDate, $startTime, $endDate, $returnTime, $capacity, $ticketsAvailable, $location, $price, $promoCode, $oldEventName)
    {
        $statement = self::$pdo->prepare("UPDATE Event SET eventName = ?, description = ?, startDate = ?, startTime = ?, endDate = ?, returnTime = ?, capacity = ?, ticketsAvailable = ?, location = ?, price = ?, promoCode = ? WHERE eventName = ?");
        $statement->execute([$eventName, $description, $startDate, $startTime, $endDate, $returnTime, $capacity, $ticketsAvailable, $location, $price, $promoCode, $oldEventName]);
    }

    //Sort By 
    function getEventFilterByLowAndHigh()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Event WHERE ticketsAvailable != ? AND endDate >= ? ORDER BY price");
        $statement->execute([0, date("Y-m-d")]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        foreach ($results as $r) {
            if (!$r->discountedPrice) {
                $r->discountedPrice = $r->price;
            }
        }

        usort($results, function ($a, $b) {
            return strcmp($a->discountedPrice, $b->discountedPrice);
        });

        return $results;
    }

    function getEventFilterByHighAndLow()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Event WHERE ticketsAvailable != ? AND endDate >= ? ORDER BY price DESC");
        $statement->execute([0, date("Y-m-d")]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        foreach ($results as $r) {
            if (!$r->discountedPrice) {
                $r->discountedPrice = $r->price;
            }
        }

        usort($results, function ($a, $b) {
            return strcmp($b->discountedPrice, $a->discountedPrice);
        });

        return $results;
    }

    function getEventFilterByOldest()
    {
        $statement = self::$pdo->prepare("SELECT * FROM `Event` WHERE ticketsAvailable != ? AND endDate >= ? ORDER BY startDate DESC");
        $statement->execute([0, date("Y-m-d")]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        return $results;
    }

    function getEventFilterByNewest()
    {
        $statement = self::$pdo->prepare("SELECT * FROM `Event` WHERE ticketsAvailable != ? AND endDate >= ? ORDER BY startDate");
        $statement->execute([0, date("Y-m-d")]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        return $results;
    }

    function getRecentEvents()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Event WHERE ticketsAvailable != ? AND endDate >= ? ORDER BY eventID DESC LIMIT 4 ");
        $statement->execute([0, date("Y-m-d")]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        return $results;
    }

    function getEventById($Id)
    {
        $statement = self::$pdo->prepare("SELECT * FROM Event WHERE eventID = ?");
        $statement->execute([$Id]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        return $results[0];
    }

    function getEvents()
    {
        $statement = self::$pdo->prepare("SELECT * FROM Event WHERE ticketsAvailable != ? AND endDate >= ?");
        $statement->execute([0, date("Y-m-d")]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        return $results;
    }

    function getEventLocation()
    {
        $statement = self::$pdo->prepare("SELECT location FROM Event");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");
        $arr = [];
        foreach ($results as $type) {
            $arr[] = $type->location;
        }
        return array_unique($arr);
    }

    function getEventFilter($location, $capacity, $minprice, $maxprice, $dateAvailable, $dateUnAvailable)
    {
        $locationAmount = str_pad("?", count($location) * 2 - 1, ",?");

        $sql = "SELECT * FROM Event WHERE location IN ($locationAmount) AND capacity <= ? AND price BETWEEN ? AND ? AND startDate >= ? AND endDate <= ?";

        $arrA = [$capacity, $minprice, $maxprice, $dateAvailable, $dateUnAvailable];

        $statement = self::$pdo->prepare($sql);
        $statement->execute(array_merge($location, $arrA));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        return $results;
    }

    function getEventSearch($location, $dateAvailable, $dateUnAvailable)
    {
        $statement = self::$pdo->prepare("SELECT * FROM Event WHERE location = ? AND startDate >= ? AND endDate <= ?");
        $statement->execute([$location, $dateAvailable, $dateUnAvailable]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Event");

        $results = self::getDiscount($results);

        return $results;
    }

    //Basket
    function getAllBookings()
    {
        $statement = self::$pdo->prepare("SELECT * From Booking WHERE Booking.bookingType = 'vehicle'");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleBooking");

        $statement2 = self::$pdo->prepare("SELECT * From Booking WHERE Booking.bookingType = 'event'");
        $statement2->execute();
        $results2 = $statement->fetchAll(PDO::FETCH_CLASS, "EventBooking");

        foreach ($results as $r1) {
            $r1->registrationNumber = self::getVehicleById($r1->registrationNumber);
        }

        foreach ($results2 as $r2) {
            $r2->eventID = self::getEventById($r2->promoCode);
        }

        $together = array_merge($results2, $results);

        foreach ($together as $r) {
            if ($r->customerID) {
                $r->customerID = self::getAccount($r->customerID);
            }
            if ($r->promoCode) {
                $r->promoCode = self::getPromotionByPromoCode($r->promoCode);
            }
        }
        return $together;
    }

    function ticketsAvailable($id)
    {
        $statement = self::$pdo->prepare("UPDATE Event SET ticketsAvailable=? WHERE eventID=?");
        $statement->execute([($id->ticketsAvailable - 1), $id->eventID]);
    }

    function checkout(
        $date,
        $customerID,
        $destination,
        $totalPaid,
        $promoCode,
        $bookingType,
        $eventID,
        $ticketsBought,
        $registrationNumber,
        $startDate,
        $endDate
    ) {
        $statement = self::$pdo->prepare("INSERT INTO Booking(date, customerID, destination, totalPaid, 
        promoCode, bookingType, eventID, ticketsBought, registrationNumber, startDate, endDate) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute([
            $date, $customerID, $destination, $totalPaid, $promoCode, $bookingType, $eventID,
            $ticketsBought, $registrationNumber, $startDate, $endDate
        ]);
    }

    //Account
    function getAccount($customerID)
    {
        $statement = self::$pdo->prepare("SELECT * FROM Account WHERE customerID = ?");
        $statement->execute([$customerID]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Account");
        return $results[0];
    }

    function addUser($account)
    {
        $statement = self::$pdo->prepare("INSERT INTO Account (firstName, lastName, email, contactNumber, username, password, title, licenceNumber, licenceExpiryDate, role) values(?,?,?,?,?,?,?, ?)");
        $statement->execute([$account->firstName, $account->lastName, $account->email, $account->contactNumber, $account->username, $account->password, $account->title, $account->licenceNumber, $account->licenceExpiryDate, "customer"]);
        return $account;
    }

    function getUserByLogIn($usernameLog, $passwordLog)
    {
        $statement = self::$pdo->prepare("SELECT * FROM Account WHERE username = ? AND password = ?");
        $statement->execute([$usernameLog, $passwordLog]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "Account");
        return $results;
    }

    function getBookings($Id)
    {
        $statement = self::$pdo->prepare("SELECT * From Booking WHERE customerID = ? AND bookingType = ?");

        $statement->execute([$Id, "vehicle"]);
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "VehicleBooking");

        foreach ($results as $r) {
            if ($r->registrationNumber) {
                $r->registrationNumber = self::getVehicleById($r->registrationNumber);
            }
        }

        $statement2 = self::$pdo->prepare("SELECT * From Booking WHERE customerID = ? AND bookingType = ?");

        $statement2->execute([$Id, "event"]);
        $results2 = $statement2->fetchAll(PDO::FETCH_CLASS, "EventBooking");

        foreach ($results2 as $r) {
            if ($r->eventID) {
                $r->eventID = self::getEventById($r->eventID);
            }
        }

        $together = array_merge($results2, $results);

        foreach ($together as $r) {
            if ($r->customerID) {
                $r->customerID = self::getAccount($r->customerID);
            }
            if ($r->promoCode) {
                $r->promoCode = self::getPromotionByPromoCode($r->promoCode);
            }
        }

        return $together;
    }
}
