
<!DOCTYPE html>
<html>

<head>
    <title>Car Hire Ltd.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="../view/BasketCheckout/js.js" defer> </script>

    <link rel="stylesheet" href="../view/BasketCheckout/basket.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../view/assets/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <main>     
        <?php 
            require_once("../view/nav/nav.php");

        ?>

        <div class="shoppingall">
            <div class="shoppingcart" >
                <h1> Shopping Cart </h1>
                <div class="basketcontainer">
                    <p class="carttitle size"> TOTAL </p>
                    <?php foreach($basket['object'] as $key => $stuff):?>
                        <div class="item">
                            <?php if($stuff instanceof Vehicle): $make = $stuff->make ?>
                                <p><a href="controllerBasket.php?vehicleid=<?=$stuff->registrationNumber?>"> <box-icon class="link" name='x'></box-icon></a></p>
                                <img class = "carImg" src="../view/itemAssets/rentals/<?=$make?>/<?=$make?>.png" alt="image of a <?=$make?>">
                                <div class="vehicleinfo">
                                    <div class="rgyear">
                                        <p class="reg"><?= $stuff->registrationNumber ?></p>
                                        <p><?= $stuff->year ?></p>
                                    </div>
                                    <div class="tmc">
                                        <p><?= $stuff->type ?></p>
                                        <p><?= $stuff->make ?></p>
                                        <p><?= $stuff->colour ?></p>
                                    </div>
                                    <div class="startandend">
                                        <div class="start">
                                            <box-icon type='solid' name='hourglass-top'></box-icon>
                                            <p> <?= $basket['startDate'][$key] ?></p>
                                        </div>
                                        <div class="end">
                                            <box-icon type='solid' name='hourglass-bottom'></box-icon>
                                            <p> <?= $basket['endDate'][$key] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class ="initial itemsprice">
                                    <p class="price" >£<?=$stuff->price?>/ per day</p>
                                    <?php if($stuff->discountedPrice):?>
                                        <p class= "discountedPrice">£<?=$stuff->discountedPrice?>/ per day</p>
                                    <?php endif?>
                                </div>
                            <?php endif ?>
                            <?php if($stuff instanceof Event): $location = $stuff->location?>
                                    <p><a href="controllerBasket.php?eventid=<?=$stuff->eventID?>"> <box-icon name='x'></box-icon></a> </p>
                                    <img class = "carImg" src="../view/itemAssets/events/<?=$location?>.png">
                                    <div class="nameanddes">
                                        <div class="nameandlocat">
                                            <p><?=$stuff->eventName?></p>
                                            <p><?=$stuff->location?></p>
                                        </div>
                                        <p class="desp"><?=$stuff->description?></p>
                                    </div>
                                    <div class ="initial2 itemsprice">
                                        <p class="price" >£<?=$stuff->price?></p>
                                        <?php if($stuff->discountedPrice):?>
                                            <p class= "discountedPrice">£<?=$stuff->discountedPrice?></p>
                                        <?php endif?>
                                    </div>
                            <?php endif ?>


                            <div class="priceinfodiv">
                                <?php if($stuff instanceof Vehicle):?>
                                    <div class="totalwanttobook">
                                    <p class="totalp">£<?= $stuff->totalPrice ?>  </p>
                                    </div>
                                <?php endif ?>
                            </div>


                            
                        </div>
                    <?php endforeach?>

                </div>
            </div>

            <div class="checkout">
                <p class="carttitle"> CART TOTALS </p>
                <div class="total">
                    <p>Total:</p>
                    <p> £<?=$total?> </p>
                </div>
                <form onsubmit="checkloginfunction();return false" method="post" action="controllerBasket.php">
                    <div class="dropdown">
                        <div id="one"class = "sectiontitle">
                            <p> Order Details </p>
                            <button id="one"class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                        </div>
                        <div id="oneC" class= "sectioncontent">
                            <div class="addressdiv">
                                <p> Address </p>
                                <input name="address" required/>
                                <label style="display:none" for="address">Add Address</label>
                            </div>
                            <div class="cityandpostcode">
                                <div class="citydiv">
                                    <p> City </p>
                                    <input name="city" required/>
                                    <label style="display:none" for="city">Add City</label>
                                </div>
                                <div class="postcodediv">
                                    <p> Postal Code </p>
                                    <input name="postcode" required/>
                                    <label style="display:none" for="postcode">Add Postal Code</label>
                                </div>
                            </div>
                            <div class="namediv">
                                <p> Cardholder name  </p>
                                <input name="nameOnCard" required/>
                                <label style="display:none" for="nameOnCard">Add Cardholder name</label>
                            </div>
                            <div class="cardnodiv">
                                <p> Card number </p>
                                <input name="cardno" required/>
                                <label style="display:none" for="cardno">Add Card number</label>
                            </div>
                            <div class="expandccv">
                                <div class="expdiv">
                                    <p> EXP </p>
                                    <input name="exp" type="date"required/>
                                    <label style="display:none" for="exp">Add EXP</label>
                                </div>
                                <div class="ccvdiv">
                                    <p> CVC </p>
                                    <input name="ccv" required/>  
                                    <label style="display:none" for="ccv">Add CVC</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkoutbut">
                        <input class="checkoutbutbut" name ="checkout" type ="submit" value="checkout"/>
                        <label style="display:none" for="checkoutbutbut">Checkout button</label>
                    </div>
                </form>

                <?php if (!isset($_SESSION["user"])): ?>
                    <p class="signin"><?= $signin?></p>
                <?php endif ?>

                <?php if ($vehiclealreadybooked == true): ?>
                    <div class = "popup">
                        <button class="closepopup"> <box-icon name='x'></box-icon> </button>
                        <p> One of your vehicles has already been booked at the time specified </p>
                    </div>
                <?php endif ?>

                <?php if ($done == true): ?>
                    <div class = "popup2">
                        <button class="closepopup2"> <box-icon name='x'></box-icon> </button>
                        <p> Order placed </p>
                    </div>
                <?php endif ?>


            </div>
        </div>

    </main>

<?php 
    require_once("../view/footer/footer.php");  

?>
</body>
</html>