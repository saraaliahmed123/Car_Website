<?php

require_once("../model/DataAccess.php");
session_start();

$da = DataAccess::getInstance();

//not logged in
$isnotloggedin = "";
$user = false;

if (!isset($_SESSION["basket"]))
{
    $_SESSION["basket"] = array(
        'object' => [],
        'startDate' => [],
        'endDate' => []
    );
}

//promotional event/vehicle add - homepage
if (isset($_REQUEST["addPromo"]))
{
    $Id = $_REQUEST["Id1"];
    $vehicle = $da->getVehicleById($Id);
    array_push($_SESSION["basket"]['object'], $vehicle);
    array_push($_SESSION["basket"]['startDate'], $_REQUEST["startDate"]);
    array_push($_SESSION["basket"]['endDate'], $_REQUEST["endDate"]);

    $datetime1 = date_create($_GET["endDate"]);
    $datetime2 = date_create($_GET["startDate"]);

    $interval = date_diff($datetime1, $datetime2);

    if ($vehicle->discountedPrice)
    {
        $vehicle->totalPrice = $vehicle->discountedPrice * $interval->d;
    }
    else
    {
        $vehicle->totalPrice = $vehicle->price * $interval->d;
    }
    header("Location: controllerBasket.php");
}

if (isset($_REQUEST["addPromo2"]))
{
    $Id = $_REQUEST["Id2"];
    $event = $da->getEventById($Id);
    array_push($_SESSION["basket"]['object'], $event);
    array_push($_SESSION["basket"]['startDate'], $event->startDate);
    array_push($_SESSION["basket"]['endDate'], $event->endDate);
    header("Location: controllerBasket.php");
}

//user
if (isset($_SESSION["user"]))
{
    $user = $_SESSION["user"];
}

if (isset($_GET["signout"]))
{
    session_unset();
    session_destroy();
    header("Location: controllerBasket.php");
}

//getBookings()
//Check if vehicle already in table  
//grab all bookings
//compare basket item to bookings and see if can use checkout method
$total = 0;

$bookings = $da->getAllBookings();
//print_r($bookings[0]);
$signin = "";
$vehiclealreadybooked = false;
$done = false;

//checkout
if (isset($_REQUEST["checkout"]))
{
    if (isset($_SESSION["user"]))
    {
        for ($i = 0; $i<count($_SESSION["basket"]['object']); $i++)
        {
            foreach ($bookings as $check)
            {
               if (($_SESSION["basket"]['object'][$i] instanceof Vehicle) && ($check->registrationNumber->registrationNumber == $_SESSION["basket"]['object'][$i]->registrationNumber))
                {
                    if (($check->startDate <= $_SESSION["basket"]['startDate'][$i]) && ($check->endDate >= $_SESSION["basket"]['endDate'][$i]))
                    {
                        if (($check->endDate >= $_SESSION["basket"]['startDate'][$i]) && ($check->startDate <= $_SESSION["basket"]['endDate'][$i]))
                        {
                            $vehiclealreadybooked = true;
                        }
                   }
                }
            }
        }
        if ($vehiclealreadybooked == false) 
        {
            $done = true;
            //if payment details entered in or already from database
            for ($j = 0; $j<count($_SESSION["basket"]['object']); $j++)
            {
                if ($_SESSION["basket"]['object'][$j] instanceof Vehicle)
                {
                    $v = "vehicle";
                    $id = NULL;
                    $reg = $_SESSION["basket"]['object'][$j]->registrationNumber;
                    $price = $_SESSION["basket"]['object'][$j]->totalPrice;
                }
                elseif ($_SESSION["basket"]['object'][$j] instanceof Event)
                {
                    $v = "event";
                    $id = $_SESSION["basket"]['object'][$j]->eventID;
                    $reg = NULL;
                    $da->ticketsAvailable($_SESSION["basket"]['object'][$j]);
                    if ($_SESSION["basket"]['object'][$j]->discountedPrice)
                    {
                        $price = $_SESSION["basket"]['object'][$j]->discountedPrice;
                    }
                    else
                    {
                        $price = $_SESSION["basket"]['object'][$j]->price;
                    }
                }
                if ($_SESSION["basket"]['object'][$j]->promoCode)
                {
                    $promoCode = $_SESSION["basket"]['object'][$j]->promoCode->promoCode;
                }
                else
                {
                    $promoCode = NULL;
                }
                $da->checkout(date("Y-m-d"), $_SESSION["user"]->customerID, $_SESSION["basket"]['object'][$j]->location , $price, $promoCode, $v , $id, 1, $reg, $_SESSION["basket"]['startDate'][$j], $_SESSION["basket"]['endDate'][$j]);
            }
            unset($_SESSION['basket']);
           // header("Location: controllerBasket.php");
        }
    }
    else
    {
        $signin = "signin";
    }
}

if (isset($_GET["eventid"]))
{
    $event = $da->getEventById($_GET["eventid"]);
    $key = array_search($event, $_SESSION['basket']['object']);

    unset($_SESSION['basket']['object'][$key]);
    unset($_SESSION['basket']['startDate'][$key]);
    unset($_SESSION['basket']['endDate'][$key]);

    $_SESSION['basket']['object'] = array_values($_SESSION['basket']['object']);
    $_SESSION['basket']['startDate'] = array_values($_SESSION['basket']['startDate']);
    $_SESSION['basket']['endDate'] = array_values($_SESSION['basket']['endDate']);

    header("Location: controllerBasket.php");

}


//removing from basket
if (isset($_GET["vehicleid"]))
{   
    $vehicle = $da->getVehicleById($_GET["vehicleid"]);
    $key = array_search($vehicle, $_SESSION['basket']['object']);

    unset($_SESSION['basket']['object'][$key]);
    unset($_SESSION['basket']['startDate'][$key]);
    unset($_SESSION['basket']['endDate'][$key]);

    $_SESSION['basket']['object'] = array_values($_SESSION['basket']['object']);
    $_SESSION['basket']['startDate'] = array_values($_SESSION['basket']['startDate']);
    $_SESSION['basket']['endDate'] = array_values($_SESSION['basket']['endDate']);
        
    header("Location: controllerBasket.php");
}

if (isset($_SESSION["basket"]))
{
    foreach($_SESSION["basket"]['object'] as $key => $b)
    {
        if ($b instanceof Vehicle)
        {
            $total += $b->totalPrice;
        }
        else
        {
            if ($b->discountedPrice)
            {
                $total += $b->discountedPrice;
            }
            else
            {
                $total += $b->price;
            }
        }
    }
}

$basket = isset($_SESSION["basket"]) ? $_SESSION['basket'] :     $_SESSION["basket"] = array(
    'object' => [],
    'startDate' => [],
    'endDate' => []
);;





require_once("../view/BasketCheckout/baskethtml.php");


?>