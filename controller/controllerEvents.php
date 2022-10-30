<?php

require_once("../model/DataAccess.php");
session_start();

$da = DataAccess::getInstance();

$events = $da->getEvents();

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
if (isset($_GET["addPromo2"]))
{
    $Id = $_GET["Id"];
    $event = $da->getEventById($Id);
    if ($event->ticketsAvailable > 0)
    {
        array_push($_SESSION["basket"]['object'], $event);
        array_push($_SESSION["basket"]['startDate'], $event->startDate);
        array_push($_SESSION["basket"]['endDate'], $event->endDate);
    }
}

$EventLocation = $da->getEventLocation();

//filter button
if (isset($_GET["filterButton"]))
{
    $location = $_GET["location"] ?? $da->getEventLocation();
    $capacity = $_GET["capacity"];
    $minprice = $_GET["minprice"];
    $maxprice = $_GET["maxprice"];
    if (!$capacity)
    {
        $capacity = 1000;
    }
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
    if (!$dateAvailable)
    {
        $dateAvailable = date("Y-m-d");
    }
    if (!$dateUnAvailable)
    {
        $dateUnAvailable = date("Y-m-d", strtotime("+2 Years"));
    }
    $events = $da->getEventFilter($location, $capacity, $minprice, $maxprice, $dateAvailable, $dateUnAvailable);

}


if (isset($_REQUEST["eventSearch"]))
{
    $events = $da->getEventSearch($_REQUEST["location2"], $_REQUEST["dateAvailable2"], $_REQUEST["dateUnAvailable2"]);
}


if (isset($_SESSION["user"]))
{
    $user = $_SESSION["user"];
}

if (isset($_GET["signout"]))
{
    session_unset();
    session_destroy();
    header("Location: controllerEvents.php");
}

//popular
$popular = $da->getPopularEvents();

//get all event names 
$eventsResults = $da->getEvents();

//reset button
if (isset($_GET["resetButton"]))
{
    $events = $da->getEvents();
    header("Location: controllerEvents.php");
}

#Employee 

#add event
if (isset($_REQUEST["addEvent"]))
{
    if ($_REQUEST["promoCode"] = "-- select an option --")
    {
        $_REQUEST["promoCode"] = NULL;
    }
    print_r("hey");
    $da->addEvent($_REQUEST["eventName"], $_REQUEST["description"], $_REQUEST["startDate"], $_REQUEST["endDate"], $_REQUEST["capacity"], $_REQUEST["ticketsAvailable"], $_REQUEST["location"], $_REQUEST["price"], $_REQUEST["promoCode"], $_REQUEST["startTime"], $_REQUEST["returnTime"]);
    header("Location: controllerEvents.php");
}

#edit event
if (isset($_REQUEST["editevent"]))
{
    if ($_REQUEST["promoCode"] = "-- select an option --")
    {
        $_REQUEST["promoCode"] = NULL;
    }
    $da->editEvent($_REQUEST["eventName"], $_REQUEST["description"], $_REQUEST["startDate"] , $_REQUEST["startTime"] , $_REQUEST["endDate"], $_REQUEST["returnTime"], $_REQUEST["capacity"], $_REQUEST["ticketsAvailable"], $_REQUEST["location"], $_REQUEST["price"], $_REQUEST["promoCode"], $_REQUEST["oldEventName"]);
    header("Location: controllerEvents.php");
}

#delete event
if (isset($_REQUEST["deletevent"])) 
{
    $da->deleteEvent($_REQUEST["eventName"]);
    header("Location: controllerEvents.php");
}


//get all promocodes
$promosword = $da->getAllPromotions();


require_once ("../view/Events/eventhtml.php");


?>