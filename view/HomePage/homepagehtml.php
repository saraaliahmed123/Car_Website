<!DOCTYPE html>
<html>

<head>
    <title>Car Hire Ltd.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="../view/HomePage/javascript.js" defer> </script>
    <script type="text/javascript" src="../view/HomePage/clientcode.js"></script>

    <link rel="stylesheet" href="../view/HomePage/homepagecss.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../view/assets/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAy6THN8bti_fmZ679zo925wc1ta7sL8uc&sensor=false"> </script>

</head>

<body>

    <main>     
    <?php 
        require_once("../view/nav/nav.php");

    ?>

    <div class ="promotions">

            <div class = "slideshow-container">
                <div class="container" style="--pos: 0%;">

                    <div class="mySlides">
                        <img class = "image1" src="../view/assets/car1b&w.jpg" alt="car image in carousel"> 
                    </div>
                    <div class="mySlides">
                        <img class = "image1" src="../view/assets/car4.jpg" alt="car image in carousel"> 
                    </div>

                    <div class="mySlides">
                        <img class = "image1" src="../view/assets/car2.jpg" alt="car image in carousel"> 
                    </div>

                    <div class="mySlides">
                        <img class = "image1" src="../view/assets/car3.jpg" alt="car image in carousel"> 
                    </div>

                </div> 

                <a class="prev">&#10094;</a>
                <a class="next">&#10095;</a>
            </div>
            
    </div>

    <div class = "searchCarAndRental">
            <div class="RentalandEvents">

                <div class = "buttons">
                    <button class = "rental">Rentals</button>
                    <button class = "events">Event</button>
                </div>

                <div class="content">
                    <form class = "form" method="get" action="controllerRentals.php">
                        <div class = "locationdiv">
                            <box-icon class="navigation"name='navigation'></box-icon>
                            <input class="locationinput" name="location" id = "location" placeholder="Location" required/>
                            <label style="display:none" for="location">Enter Location</label>
                            <div class="results2">
                                <div class="result2"></div>
                            </div>
                        </div>
                        <div class = "dateAndTime">
                            <input name="dateAvailable" id="dateofbirth" type ="date" placeholder="Location" required/>
                            <label style="display:none" for="dateAvailable">Enter start date</label>
                            <input name="dateUnAvailable" id="dateofbirth" type ="date" placeholder="Location" required/>
                            <label style="display:none" for="dateUnAvailable">Enter end date</label>
                        </div>
                        <div class = "vehcileTypeAndCapacity"> 
                            <input type="checkbox" name="type[]" value="car"/> <label class = "vehicleTickBox" for="checkbox">Car</label> <br/>
                            <input type="checkbox" name="type[]" value="coach"/> <label class = "vehicleTickBox" for="checkbox">Coach</label> <br/>
                            <input type="checkbox" name="type[]" value="van"/> <label class = "vehicleTickBox" for="checkbox">Van</label> <br/>
                        </div>
                        <div class = "rentalSearch">
                            <input type="submit" name="rentalSearch" value="Search"/>
                            <label style="display:none" for="rentalSearch">Search button for rentals page</label>
                        </div>
                    </form>
                </div>
               
                <div class="content2">
                    <form method="post" action="controllerEvents.php">
                        <div class = "locationdiv">
                            <box-icon class="navigation"name='navigation'></box-icon>
                            <input class="locationinput3" name="location2" id = "location" placeholder="Location" required/>
                            <label style="display:none" for="location">Enter Location</label>
                            <div class="results3">
                                <div class="result3"></div>
                            </div>
                        </div>
                        <div class = "dateAndTime">
                            <input name="dateAvailable2" id="dateofbirth" type ="date" placeholder="Location" required/>
                            <label style="display:none" for="dateAvailable">Enter start date</label>
                            <input name="dateUnAvailable2" id="dateofbirth" type ="date" placeholder="Location" required/>
                            <label style="display:none" for="dateUnAvailable">Enter end date</label>
                        </div>
                        <div class = "rentalSearch">
                            <input type="submit" name="eventSearch" value="Search"/>
                            <label style="display:none" for="eventSearch">Search button for events page</label>
                        </div>
                    </form>
                </div>

            </div>
       
        

        <div class = "map">
            <!--<p> map </p>-->
            
            <div id = 'map'> Google Map </div>

        </div>
    </div>


    <div>
        <h1 class="PromoCars">Promotions</h1>
        <?php if (($user) && ($user->role == "employee")): ?>
            <button id="toggleSetPromotion">Set Promotion</button>
            <div class="modal" id="setPromotion">
                <div class="topofmodal">
                    <p class="title">Set Promotion</p>
                    <span class="close">&times;</span>
                </div>
                <div class="EventsPromotion">
                    <form class="formemployee"action="controllerHomePage.php" method="post" >
                        <label class="label">Select Event</label>
                        <select name="event" id="event">
                            <?php foreach ($eventsResults as $event): ?>
                                <option><?= $event->eventName ?></option>
                            <?php endforeach ?>
                        </select>
                        
                        <label class="label">Select Promotion</label>
                        <select name="epromotion" id="epromotion">
                            <?php foreach ($promotionsResults as $promotion): ?>
                                <option><?= $promotion->promoCode ?></option>
                            <?php endforeach ?>
                        </select>
                        
                        <input id="setsubmit" class="submit" type="submit" name="seteventpromo" value="Set Event Promotion"/>
                    </form>
                </div>
                
                <div class="VehiclesPromotion">
                    <form class="formemployee" action="controllerHomePage.php" method="post">
                        <label class="label">Select Vehicle</label>
                        <select name="vehicle" id="vehicle">
                            <?php foreach ($vehiclesResults as $vehicle): ?>
                                <option><?= $vehicle->registrationNumber ?></option>
                            <?php endforeach ?>
                        </select>
                        
                        <label class="label">Select Promotion</label>
                        <select name="vpromotion" id="vpromotion">
                            <?php foreach ($promotionsResults as $promotion): ?>
                                <option><?= $promotion->promoCode ?></option>
                            <?php endforeach ?>
                        </select>
                        
                        <input id="setsubmit"class="submit" type="submit" name="setvehiclepromo" value="Set Vehicle Promotion"/>
                    </form>
                </div>
            </div>

            <button id="toggleAddPromotion">Add Promotion</button>
            <div class="modal2" id="addPromotion">
                <div class="topofmodal">
                    <p class="title">Add Promotion</p>
                    <span class="closeAdd">&times;</span>
                </div>
                <form class="formemployee" method="post" action="controllerHomePage.php">
                    <label class="label">Promotion Code</label><br/>
                    <input name="promoCode" required/><br/><br/>
                    <label class="label">Start Date</label><br/>
                    <input type="date" name="startDate" required><br/><br/>
                    <label class="label">End Date</label><br/>
                    <input type="date" name="endDate" required><br/><br/>
                    <label class="label">Discount</label><br/>
                    <input name="discount" required/><br/><br/>
                    <label class="label">Type</label><br/>
                    <input name="type" required/><br/><br/>
                    <input class="submit" type="submit" name = "submitAdd" value="Add Promotion"/>
                </form>
            </div>

            <button id="toggleEditPromotion">Edit Promotion</button>
            <div class="modal3" id="editPromotion">
                <div id="selectPromotion">
                    <div class="topofmodal">
                        <p class="title">Edit Promotion</p>
                        <span class="closeEdit">&times;</span>
                    </div>
                    <div class="formemployee">
                        <label class="label" >Select Promotion</label>
                        <select name="promotionSelect" id="promotionSelect">
                            <?php foreach ($promotionsResults as $promotion): ?>
                                <option><?= $promotion->promoCode ?></option>
                            <?php endforeach ?>
                        </select>
                        <input id = "editsubmit" class="submit" type="submit" name="submitSelect" value="Select Promotion"/>
                    </div>
                </div>
                <div id="editFoundPromotion">
                    <form class="formemployee" action="controllerHomePage.php" method="post" >
                        <label class="label" >Promotion Code</label><br/>
                        <input type="text" name="ePromoCode" readonly/><br/><br/>
                        <label class="label" >Start Date</label><br/>
                        <input type="date" name="eStartDate" required><br/><br/>
                        <label class="label" >End Date</label><br/>
                        <input type="date" name="eEndDate" required><br/><br/>
                        <label class="label" >Discount</label><br/>
                        <input name="eDiscount" required/><br/><br/>
                        <label class="label" >Type</label><br/>
                        <input name="eType" required/><br/><br/>
                        <input class="submit" type="submit" name="submitEdit" value="Save Changes"/>
                    </form>
                </div>
            </div>

            <button id="toggleDeletePromotion">Delete Promotion</button>
            <div class="modal4" id="deletePromotion">
                <div class="topofmodal">
                    <p class="title">Delete Promotion</p>
                    <span class="closeDelete">&times;</span>
                </div>
                <form class="formemployee" action="controllerHomePage.php" method="post">
                    <label class="label">Select Promotion</label>
                    <select name="promotionDelete" id="promotionDelete">
                        <?php foreach ($promotionsResults as $promotion): ?>
                            <option><?= $promotion->promoCode ?></option>
                        <?php endforeach ?>
                    </select>
                    <input class="submit" type="submit" name="submitDelete" value="Delete Promotion"/>
                </form>
            </div>
        <?php endif ?>

        <div class = "cardCarSet">
                    <!-- for each loop over promotions -->
                <?php foreach ($promotions as $promotion): ?>
                    <?php if($promotion instanceof Vehicle): $make = $promotion->make?>
                        <div class="cardCar">
                            <div class = "promoImagediv">
                                <img class = "carImg" src="../view/itemAssets/rentals/<?=$make?>/<?=$make?>.png" alt="image of a <?=$make?>">
                            </div>
                            <div class = "tv">
                                <div class = "promocardInfo1">
                                    <p class="category"><?= $promotion->category ?></p>
                                    <a class="atag"href="controllerRentals.php"> <?= $promotion->make ?></a>
                                    <div class="pricediv1 allPrice">
                                        <p class="price">&pound<?=$promotion->price?> per day</p>
                                        <?php if($promotion->discountedPrice):?>
                                            <p class= "discountedPrice">&pound<?=$promotion->discountedPrice?> per day</p>
                                        <?php endif?>
                                    </div>
                                </div>
                                <div class = "addPromoBasket">
                                    <form action="controllerBasket.php" action="get">
                                        <input type = "hidden" name = "Id1" value = "<?=$promotion->registrationNumber?>"/>
                                        <input type = "date" name = "startDate" required/>
                                        <label style="display:none" for="startDate">Enter start Date</label>
                                        <input type = "date" name = "endDate" required/>
                                        <label style="display:none" for="startDate">Enter end date</label>
                                        <input class = "promoaddButton" type ="submit" name ="addPromo" value="Add"/>
                                        <label style="display:none" for="eventSearch">Add promotional vehicle in basket button</label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if($promotion instanceof Event): $location = $promotion->location?>
                        <div class="cardCar">
                            <div class = "promoImagediv">
                                <img class = "carImg" src="../view/itemAssets/events/<?=$location?>.png" alt="image of event in <?=$location?>">
                            </div>
                            <div id ="eventTv" class = "tv">
                                <div class = "promocardInfo1">
                                    <p class="eventLocation"><?=$promotion->location?></p>
                                    <a href="controllerEvents.php"> <?=$promotion->eventName?></a>
                                    <div class="pricediv1 allPrice2">
                                        <p class="price">&pound<?=$promotion->price?></p>
                                        <?php if($promotion->discountedPrice):?>
                                            <p class= "discountedPrice">&pound<?=$promotion->discountedPrice?> per day</p>
                                        <?php endif?>
                                    </div>
                                </div>
                                <div class = "addPromoBasket">
                                    <form action="controllerBasket.php" action="get">
                                        <input type = "hidden" name = "Id2" value = "<?=$promotion->eventID?>"/>
                                        <input class = "promoaddButton" type ="submit" name ="addPromo2" value="Add"/>
                                        <label style="display:none" for="promoaddButton">Add promotional event in basket button</label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
         </div>
    </div>

    <div class = "newRentalsdiv">
        <h1> New Rentals </h1>
        <div class = "newRentals">
            <?php foreach ($recentVehciles as $recent): $make = $recent->make?>
                <div class="cardCar"> 
                    <div class = "promoImagediv">
                        <img class = "carImg" src="../view/itemAssets/rentals/<?=$make?>/<?=$make?>.png" alt="image of a <?=$make?>">
                    </div>
                    <div class = "tv">
                        <div class = "promocardInfo">
                            <p class="category" ><?=$recent->category?></p>
                            <a class="atag" href="controllerRentals.php"> <?=$recent->make?> </a>
                            <div class="pricediv allPrice">
                                <p class="price">£<?=$recent->price?> per day</p>
                                <?php if($recent->discountedPrice):?>
                                    <p class= "discountedPrice">£<?=$recent->discountedPrice?> per day</p>
                                <?php endif?>
                            </div>
                        </div>
                        <div class = "addPromoBasket">
                            <form action="controllerBasket.php" action="get">
                                <input type = "hidden" name = "Id1" value = "<?=$recent->registrationNumber?>"/>
                                <input type = "date" name = "startDate" required/>
                                <label style="display:none" for="startDate">Enter start Date</label>
                                <input type = "date" name = "endDate" required/>
                                <label style="display:none" for="endDate">Enter end Date</label>
                                <input class = "promoaddButton2" type ="submit" name ="addPromo" value="Add"/>
                                <label style="display:none" for="promoaddButton2">Add new vehicle in basket button</label>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class = "newEventsdiv linelastevent">
        <h1> New Events </h1>
        <div class = "newEvents">
            <?php foreach ($recentEvents as $recent): $location = $recent->location ?>
                <div class="cardCar"> 
                    <div class = "promoImagediv">
                        <img class = "carImg" src="../view/itemAssets/events/<?=$location?>.png" alt="image of event in <?=$location?>">
                    </div>
                    <div id ="eventTv" class = "tv">
                        <div class = "promocardInfo1">
                            <p class="eventLocation"><?=$recent->location?></p>
                            <a href="controllerEvents.php"> <?=$recent->eventName?> </a>
                            <div class="pricediv1 allPrice2">
                                <p class="price">£<?=$recent->price?></p>
                                <?php if($recent->discountedPrice):?>
                                    <p class= "discountedPrice">£<?=$recent->discountedPrice?></td>
                                <?php endif?>
                            </div>
                        </div>
                        <div class = "addPromoBasket">
                            <form action="controllerBasket.php" action="get">
                                <input type = "hidden" name = "Id2" value = "<?=$recent->eventID?>"/>
                                <input class = "promoaddButton" type ="submit" name ="addPromo2" value="Add"/>
                                <label style="display:none" for="promoaddButton2">Add new event in basket button</label>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class = "FAQInfoSub">
            <div class = "faq">
                <div class = "faqTitle">
                    <p> Frequently Asked Questions </p>
                </div>
                <div class = "section">
                    <div id="one"class = "sectiontitle">
                        <p> What do I need to hire a car? </p>
                        <button id="one"class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                    </div>
                    <div id="oneC" class= "sectioncontent">
                        <p> To book your car, all you need is a credit or debit card. When you pick the car up, you'll need: </p>
                        <ul> 
                            <li> Your voucher / eVoucher, to show that you've paid for the car.</li>
                            <li> The main driver's credit / debit card, with enough available funds for the car's deposit.</li>
                            <li> Each driver's full, valid driving licence, which they've held for at least 12 months (often 24).</li>
                            <li> Your passport and any other ID the car hire company needs to see.</li>
                        </ul>
                    </div>
                </div>
                <div class = "section">
                    <div id="two" class = "sectiontitle">
                        <p> How old do I have to be to rent a car? </p>
                        <button id="two" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                    </div>
                    <div id="twoC" class= "sectioncontent">
                        <p> For most car hire companies, the age requirement is between 21 and 70 years old. If you're under 25 or over 70, you might have to pay an additional fee </p>
                    </div>
                </div>
                <div class = "section">
                    <div id="three" class = "sectiontitle">
                        <p> Can I book a hire car for someone else? </p>
                        <button id="three" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                    </div>
                    <div id="threeC" class= "sectioncontent">
                        <p> Yes, as long as they meet these requirements. Just fill in their details while you're making the reservation. </p>
                    </div>
                </div>
                <div class = "section">
                    <div id="four" class = "sectiontitleLast">
                        <p> How do I find the cheapest car hire deal? </p>
                        <button id="four" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                    </div>
                    <div id="fourC" class= "sectioncontent">
                        <p> We work with all the major international car hire brands (and lots of smaller local companies) to bring you a huge choice of cars at the very best prices. That's how we can find you cheap car hire deals at over 60,000 locations worldwide. To compare prices and find your ideal car at an unbeatable price, just use our search form. </p>
                    </div>
                </div>
            </div>

            <div class = "addinfo">
                <div class = "faqTitle">
                    <p> Additional Information </p>
                </div>
                <div class = "section">
                    <div id="five" class = "sectiontitle">
                        <p> Related Searches </p>
                        <button id="five" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                    </div>
                    <div id="fiveC" class= "sectioncontent">
                       <ul> 
                            <li> Luxury Car Hire </li>
                            <li> Convertible Car Hire </li>
                            <li> 7 & 9 Seater Car Hire </li>
                            <li> One-Way Car Hire </li>
                            <li> Popular Airports </li>
                        </ul>
                    </div>
                </div>
                <div class = "section">
                    <div id="six" class = "sectiontitle">
                        <p> Popular Destinations </p>
                        <button id="six" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                    </div>
                    <div id="sixC" class= "sectioncontent">
                       <ul> 
                            <li> Glasgow car hire </li>
                            <li> Birmingham car hire </li>
                            <li> Pisa car hire </li>
                            <li> Milan car hire </li>
                            </ul>
                    </div>
                </div>
                <div class = "section">
                    <div id="seven" class = "sectiontitle">
                        <p> Airports </p>
                        <button id="seven" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                    </div>
                    <div id="sevenC" class= "sectioncontent">
                        <ul> 
                            <li> Gatwick Airport car hire </li>
                            <li> Birmingham Airport car hire </li>
                            <li> Pisa Airport car hire </li>
                            <li> Barcelona Airport car hire</li>
                        </ul>
                    </div>
                </div>
                <div class = "section">
                    <div id="eight" class = "sectiontitleLast">
                        <p> Car Hire Companies </p>
                        <button id="eight" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                    </div>
                    <div id="eightC" class= "sectioncontent">
                       <ul> 
                            <li> Budget car hire </li>
                            <li> Europcar car hire </li>
                            <li> Hertz car hire </li>
                            <li> Sixt car hire</li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
        
    </main>

    <?php 
        require_once("../view/footer/footer.php");  

    ?>

        
    
 </body>

</html>