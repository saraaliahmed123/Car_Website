<?php

require_once("../model/DataAccess.php");
session_start();

$da = DataAccess::getInstance();

//not logged in
$isnotloggedin = "";

if (!$_SESSION["user"])
{
    $isnotloggedin = "notloggedin";
}

if (isset($_SESSION["user"]))
{
    $user = $_SESSION["user"];
    $bookings = $da->getBookings($user->customerID);
}

if (isset($_SESSION["user"]))
{
    $user = $_SESSION["user"];
}

if (isset($_GET["signout"]))
{
    session_unset();
    session_destroy();
    header("Location: controllerAccount.php");
}




require_once("../view/Accounts/account.php");


?>