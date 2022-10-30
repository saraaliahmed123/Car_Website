<?php

require_once("../model/DataAccess.php");
session_start();

$da = DataAccess::getInstance();

//not logged in
$isnotloggedin = "";
$user = false;



require_once ("../view/Aboutus/aboutus.php");


?>