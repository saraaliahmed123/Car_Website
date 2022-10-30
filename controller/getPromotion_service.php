<?php

header('Content-Type: application/json');
require_once("../model/DataAccess.php");

$da = DataAccess::getInstance();

if (!isset($_GET["promoCode"]))
{
    echo json_encode([]);
}
else
{
    $promotionEdit = $da->getPromotionByPromoCode($_GET["promoCode"]);
    echo json_encode($promotionEdit);
}

?>