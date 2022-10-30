<?php
header('Content-Type: application/json');
require_once("../model/DataAccess.php");

$da = DataAccess::getInstance();

if (isset($_GET["searchinput"])) 
{
  $search = $da->getSearchByStartOfMake($_GET["searchinput"]);
  echo json_encode($search);
}
elseif (isset($_GET["searchinputboxRental"]))
{
  $search = $da->getRentalSearchLocation($_GET["searchinputboxRental"]);
  echo json_encode($search);
}
elseif (isset($_GET["searchinputboxEvent"]))
{
  $search = $da->getEventSearchLocation($_GET["searchinputboxEvent"]);
  echo json_encode($search);
}

?>
