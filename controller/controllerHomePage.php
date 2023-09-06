<?php

require_once("../model/DataAccess.php");
session_start();

$da = DataAccess::getInstance();

//not logged in
$isnotloggedin = "";

if (isset($_REQUEST["lastName"]) && isset($_REQUEST["firstName"]) && isset($_REQUEST["email"]) && isset($_REQUEST["contactNumber"]) && isset($_REQUEST["username"]) && isset($_REQUEST["password"]) && isset($_REQUEST["title"]))
{
    $account = new Account();
    $account->lastName = htmlentities($_REQUEST["lastName"]);
    $account->firstName = htmlentities($_REQUEST["firstName"]);
    $account->email = htmlentities($_REQUEST["email"]);
    $account->contactNumber = htmlentities($_REQUEST["contactNumber"]);
    $account->username = htmlentities($_REQUEST["username"]);
    $account->password = htmlentities($_REQUEST["password"]);
    $account->title = htmlentities($_REQUEST["title"]);
    $account->licenceNumber = htmlentities($_REQUEST["licenceNumber"]);
    $account->licenceExpiryDate = htmlentities($_REQUEST["licenceExpiryDate"]);
    $_SESSION["user"] = $da->addUser($account);

}
elseif (isset($_REQUEST["usernameLog"]) && isset($_REQUEST["passwordLog"]))
{
    $_SESSION["user"] = $da->getUserByLogIn($_REQUEST["usernameLog"], $_REQUEST["passwordLog"])[0] ?? false;
    if (!$_SESSION["user"])
    {
        $isnotloggedin = "notloggedin";
    }
}

$promotions = $da->getPromotions();

$user = false;
if (isset($_SESSION["user"]))
{
    $user = $_SESSION["user"];
}

if (isset($_GET["signout"]))
{
    session_unset();
    session_destroy();
    header("Location: controllerHomePage.php");
}

//recent vehicles
$recentVehciles = $da->getRecentVehciles();

//recent events
$recentEvents = $da->getRecentEvents();

//Employee 

//set promotion
$eventsResults = $da->getEvents();
$vehiclesResults = $da->getVehicles();
$promotionsResults = $da->getAllPromotions();

//actions for forms

if (isset($_REQUEST["event"]) && ($_REQUEST["epromotion"]))
{
    $event = $da->getEventByName($_REQUEST["event"]);
    $newPromoCode = $_REQUEST["epromotion"];
    $da->updateEventPromoCode($event->eventID, $newPromoCode);
    header("Location: controllerHomePage.php");
}

if (isset($_REQUEST["vehicle"]) && ($_REQUEST["vpromotion"]))
{
    $vehicle = $da->getVehicleById($_REQUEST["vehicle"]);
    $newPromoCode = $_REQUEST["vpromotion"];
    $da->updateVehiclePromoCode($vehicle->registrationNumber, $newPromoCode);
    header("Location: controllerHomePage.php");
}

//create, edit, delete
//add Promotion

if (isset($_REQUEST["submitAdd"]))
{
    $da->addNewPromotion($_REQUEST["promoCode"], $_REQUEST["startDate"], $_REQUEST["endDate"], $_REQUEST["discount"], $_REQUEST["type"]);
    header("Location: controllerHomePage.php");
}

//edit Promotion
$promotionEdit = new Promotion();

if (isset($_REQUEST["submitSelect"]) && isset($_REQUEST["promotionSelect"]))
{
    $promotionEdit =   $da->getPromotionByPromoCode($_REQUEST["promotionSelect"]);
    header("Location: controllerHomePage.php");
}

if (isset($_REQUEST["submitEdit"]))
{
    $epc = $_REQUEST["ePromoCode"];
    $esd = $_REQUEST["eStartDate"];
    $eed = $_REQUEST["eEndDate"];
    $edc = $_REQUEST["eDiscount"];
    $etp = $_REQUEST["eType"];
    $da->editPromotion($epc,$esd,$eed,$edc,$etp);
    header("Location: controllerHomePage.php");
}

//delete Promotion

if (isset($_REQUEST["submitDelete"]) && isset($_REQUEST["promotionDelete"]))
{
    $da->deletePromotion($_REQUEST["promotionDelete"]);
    header("Location: controllerHomePage.php");
}


require_once("../view/HomePage/homepagehtml.php");
