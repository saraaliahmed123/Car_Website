<?php

require_once("../model/DataAccess.php");
session_start();

$da = DataAccess::getInstance();

//not logged in
$isnotloggedin = "";
$user = false;

//Search bar
$searchinput = "";
if (isset($_GET["searchinput"]) && $_GET["searchinput"] != "")
{
  $search = $da->getSearch($_GET["searchinput"]);
  if ($search[0] instanceof Vehicle)
  {
    $vehicles = $search;
    //filters vehicle
    $vehicleType = $da->getVehicleType();
    $vehicleCategory = $da->getVehicleCategory();
    $vehicleMake = $da->getVehicleMake();
    $vehicleTransmission = $da->getVehicleTransmission();
    $vehicleLocation = $da->getVehicleLocation();
    //popular vehicle
    $popular = $da->getPopularRentals();
    require_once ("../view/Rentals/rentalhtml.php");
  }
  else
  {
    $EventLocation = $da->getEventLocation();
    //popular
    $popular = $da->getPopularEvents();
    $events = $search;
    require_once ("../view/Events/eventhtml.php");
  }
}


?>