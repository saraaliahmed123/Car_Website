<?php
header('Content-Type: application/json');
require_once("../model/DataAccess.php");

$da = DataAccess::getInstance();

//Rentals page

if (isset($_GET["filter"])) {
if ($_GET["filter"] == "lowandhigh")
{
  $filter = $da->getRentalFilterByLowAndHigh();
  echo json_encode($filter);
}
elseif ($_GET["filter"] == "hightolow")
{
  $filter = $da->getRentalFilterByHighAndLow();
  echo json_encode($filter);
}
elseif ($_GET["filter"] == "oldest")
{
  $filter = $da->getRentalFilterByOldest();
  echo json_encode($filter);
}
elseif ($_GET["filter"] == "newest")
{
  $filter = $da->getRentalFilterByNewest();
  echo json_encode($filter);
}
}
//Events page
if (isset($_GET["filterEvent"])) {
if ($_GET["filterEvent"] == "lowandhigh")
{
  $filter = $da->getEventFilterByLowAndHigh();
  echo json_encode($filter);
}
elseif ($_GET["filterEvent"] == "hightolow")
{
  $filter = $da->getEventFilterByHighAndLow();
  echo json_encode($filter);
}
elseif ($_GET["filterEvent"] == "oldest")
{
  $filter = $da->getEventFilterByOldest();
  echo json_encode($filter);
}
elseif ($_GET["filterEvent"] == "newest")
{
  $filter = $da->getEventFilterByNewest();
  echo json_encode($filter);
}
}

?>