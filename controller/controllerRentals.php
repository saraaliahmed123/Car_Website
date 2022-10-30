<?php

require_once("../model/DataAccess.php");
session_start();

$da = DataAccess::getInstance();

$vehicles = $da->getVehicles();

//not logged in
$isnotloggedin = "";
$user = false;

//basket
if (!isset($_SESSION["basket"]))
{
    $_SESSION["basket"] = array(
        'object' => [],
        'startDate' => [],
        'endDate' => []
    );
    
}

//adding to basket
if (isset($_GET["addtobasket"]))
{
    $Id = $_GET["regid"];
    $vehicle = $da->getVehicleById($Id);
    array_push($_SESSION["basket"]['object'], $vehicle);
    array_push($_SESSION["basket"]['startDate'], $_GET["startDatevehicle"]);
    array_push($_SESSION["basket"]['endDate'], $_GET["endDatevehicle"]);

    $datetime1 = date_create($_GET["endDatevehicle"]);
    $datetime2 = date_create($_GET["startDatevehicle"]);

    $interval = date_diff($datetime1, $datetime2);

    if ($vehicle->discountedPrice)
    {
        $vehicle->totalPrice = $vehicle->discountedPrice * $interval->d;
    }
    else
    {
        $vehicle->totalPrice = $vehicle->price * $interval->d;
    }

}

//Sort by filter 
if (isset($_GET["vehiclessortbyfilter"]))
{
    $vehicles = $_REQUEST["vehiclessortbyfilter"];
}

//homepage search
if (isset($_GET["rentalSearch"]) && isset($_GET["type"]))
{ 
    $vehicles = $da->getRentalSearch($_GET["location"], $_GET["dateAvailable"], $_GET["dateUnAvailable"], $_GET["type"]);
}


//filters
$vehicleType = $da->getVehicleType();

$vehicleCategory = $da->getVehicleCategory();

$vehicleMake = $da->getVehicleMake();

$vehicleTransmission = $da->getVehicleTransmission();

$vehicleLocation = $da->getVehicleLocation();

//filter button
if (isset($_GET["filterButton"]))
{
    $types = $_GET["type"] ?? $da->getVehicleType(); 
    $category = $_GET["category"] ?? $da->getVehicleCategory();
    $make = $_GET["make"] ?? $da->getVehicleMake();
    $transmission = $_GET["transmission"] ?? $da->getVehicleTransmission();
    $location = $_GET["location"] ?? $da->getVehicleLocation();
    $minprice = $_GET["minprice"];
    $maxprice = $_GET["maxprice"];
    if (!$minprice)
    {
        $minprice = 0;
    }
    if (!$maxprice)
    {
        $maxprice = 10000;
    }
    $dateAvailable = $_GET["dateAvailable"];
    $dateUnAvailable = $_GET["dateUnAvailable"];
    $vehicles = $da->getRentalFilter($types, $category, $make, $transmission, $location, $minprice, $maxprice, $dateAvailable, $dateUnAvailable);
}
else if (isset($_GET["resetButton"]))
{
    $vehicles = $da->getVehicles();
    header("Location: controllerRentals.php");
}

//user log in
if (isset($_SESSION["user"]))
{
    $user = $_SESSION["user"];
}

if (isset($_GET["signout"]))
{
    session_unset();
    session_destroy();
    header("Location: controllerRentals.php");
}

//popular
$popular = $da->getPopularRentals();

//reset button
if (isset($_GET["resetButton"]))
{
    $vehicles = $da->getVehicles();
    header("Location: controllerRentals.php");
}

//Employee

//get all registrationumbers
foreach ($vehicles as $rg)
{
    $registrationNumbers[] = $rg->registrationNumber;
}

//get all promocodes
$promos = $da->getAllPromotions();

foreach ($promos as $p)
{
    $promosword[] = $p->promoCode;
}

//add vehicle
if (isset($_REQUEST["addvehicle"]))
{
    if ($_REQUEST["promoCode"] = "-- select an option --")
    {
        $_REQUEST["promoCode"] = NULL;
    }
    $da->addVehicle($_REQUEST["rn"], $_REQUEST["make"], $_REQUEST["model"], $_REQUEST["colour"], $_REQUEST["year"], $_REQUEST["type"], $_REQUEST["transmission"], $_REQUEST["location"], $_REQUEST["category"], $_REQUEST["price"], $_REQUEST["promoCode"], $_REQUEST["numofpass"]);
    header("Location: controllerRentals.php");
}

//edit vehicle
if (isset($_REQUEST["editvehicle"]))
{
    if ($_REQUEST["promoCode"] = "-- select an option --")
    {
        $_REQUEST["promoCode"] = NULL;
    }
    $da->editVehicle($_REQUEST["make"], $_REQUEST["model"], $_REQUEST["colour"] , $_REQUEST["year"] , $_REQUEST["type"], $_REQUEST["transmission"], $_REQUEST["location"], $_REQUEST["category"], $_REQUEST["price"], $_REQUEST["promoCode"], $_REQUEST["numofpass"], $_REQUEST["rn"]);
    header("Location: controllerRentals.php");
}

//delete vehicle
if (isset($_REQUEST["deletevehicle"]))
{
    $da->deleteVehicle($_REQUEST["rn"]);
    header("Location: controllerRentals.php");
}

require_once ("../view/Rentals/rentalhtml.php");


?>