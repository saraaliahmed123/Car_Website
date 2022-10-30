<!DOCTYPE html>
<html>

<head>
    <title>Car Hire Ltd.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="../view/Events/js.js" defer> </script>
    <script type="text/javascript" src="../view/Events/clientcode.js"></script>

    <link rel="stylesheet" href="../view/Events/event.css">
    
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
        
    <div class ="main">
        <div class = "filterbox">
            <h2>Filter:</h2>
            <form class="formone" method="get" action="controllerEvents.php">
                <div>
                    <p>Date Available</p>
                            <label for="dateAvailable">Start Date</label>
                            <input type="date" name="dateAvailable" id="dateAvailable" value="">
                        <br>
                            <label for="dateUnAvailable">End Date</label>
                            <input type="date" name="dateUnAvailable" id="dateUnAvailable" value="">
                        <br>
                </div>
                <div>
                    <p>Number of Tickets</p>
                        <input class="numoftickets" name="capacity" id="ticketsavailable" placeholder = "0">
                    <br>
                </div>
                <div class="locationfilterdiv">
                    <p>Location</p>
                        <?php foreach ($EventLocation as $location): ?>
                            <div class="locationfilterdivinside">
                                <input type="checkbox" id="<?=$location?>" name="location[]" value="<?=$location?>">
                                <label for="<?=$location?>"><?=$location?></label>
                            </div>
                        <?php endforeach ?>
                </div>
                <div>
                <p>Price</p>
                    <label for="minprice">Min Price &pound;</label>
                    <input name="minprice" id="minprice" value="0.00">
                <br>
                    <label for="maxprice">Max Price &pound;</label>
                    <input name="maxprice" id="maxprice" value="1000.00">
                <br>
                </div>
                    <input type="submit" name = "filterButton" id="filterbutton" value="Filter">
                </form>
                <form method="get" action= "controllerEvents.php">
                        <input type="submit" name ="resetButton" id="resetbutton" value="Reset">
                </form>
        </div>

    <div class="filterandcars">

        <div class="topfilter">
            <div class="minicarsandbox">
                <div class="box">
                    <p> <box-icon name='info-circle'></box-icon> </p>
                    <p> In the last 24 hours, over 20 customers have booked an event </p>
                </div>
                <div class="minicars">
                    <h3> Popular Events Booked </h3>
                    <div class="minicarsdiv">
                        <?php foreach ($popular as $key => $popularevent): ?>
                            <div class="mini">
                                <div class = "promoImagedivpopular">
                                    <img class = "carpopular" src="../view/itemAssets/events/<?=$key?>.png" alt="image of event in <?=$location?>">
                                </div>
                                <p> <?= $key ?>  </p>
                                <p> <?= $popularevent ?>  </p>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <div class="filtertop">
                <div class = "filterbar">
                    <form class="rentalsortby" action="controllerRentals.php" method="get">
                        <label for="sortby">Sort By:</label>
                        <select name="sortby" id="sortby">
                            <option selected hidden disabled>Sort</option>
                            <option value="lowandhigh">Price: Low to High</option>
                            <option value="hightolow">Price: High to Low</option>
                            <option value="oldest">Oldest</option>
                            <option value="newest">Newest</option>
                        </select>
                    </form>
                </div>
                <p class="titlerentals"> Events: </p>
                <div class="num">
                    <p> Num of Event: </p>
                    <p class="bold"> <?= count($events) ?> </p>
                </div>
            </div>
        </div>

        <?php if (($user) && ($user->role == "employee")): ?>
            <div class="controllerRentalButton">

                <button id="addBtn">Add Event</button>
                <div id="addModal" class="modal">
                    <div class="addEvent">
                        <div class="topmodal">
                            <p>Add New Event</p>
                            <span class="close">&times;</span>
                        </div>
                        <form method="post" action="controllerEvents.php">
                            <div class="field">
                                <label for="addEventName">Event Name</label>
                                <input name="eventName" id="addEventName" value="">
                            </div>
                            <div class="field">
                                <label for="addDescription">Description</label>
                                <textarea id="addDescription" name="description" rows="2" cols="25"></textarea>
                            </div>
                            <div class="field">
                                <label for="addStartDate">Start Date</label>
                                <input type="date" name="startDate" id="addStartDate" value="<?= date('Y-m-d'); ?>">
                            </div>
                            <div class="field">
                                <label for="addStartTime">Start Time</label>
                                <input type="time" name="startTime" id="addStartTime" value="<?= date('H:i'); ?>">
                            </div>
                            <div class="field">
                                <label for="addEndDate">End Date</label>
                                <input type="date" name="endDate" id="addEndDate" value="<?= date('Y-m-d', strtotime('+1 day')); ?>">
                            </div>
                            <div class="field">
                                <label for="addReturnTime">Return Time</label>
                                <input type="time" name="returnTime" id="addReturnTime" value="<?= date('H:i'); ?>">
                            </div>
                            <div class="field">
                                <label for="addCapacity">Capacity</label>
                                <input type="number" name="capacity" id="addCapacity" value="0">
                            </div>
                            <div class="field">
                                <label for="addTicketsAvailable">Tickets Available</label>
                                <input type="number" name="ticketsAvailable" id="addTicketsAvailable" value="0">
                            </div>
                            <div class="field">
                                <label for="addLocation">Location</label>
                                <select required id="addLocation" name="location">
                                    <?php foreach ($EventLocation as $eventloca): ?>
                                        <option><?=$eventloca?></option>
                                    <?php endforeach ?>
                                </select> <br> 
                            </div>
                            <div class="field">
                                <label for="addPrice">Price &pound;</label>
                                <input name="price" id="addPrice" value="00.00">
                            </div>
                            <div class="field">
                                <label for="addPromoCode">Promo Code</label>
                                <select id="addPromoCode" name="promoCode">
                                    <option disabled selected value> -- select an option -- </option>
                                    <?php foreach ($promosword as $promo): ?>
                                        <option><?=$promo->promoCode?></option>
                                    <?php endforeach ?>
                                </select><br><br>
                            </div>
                                <input type="submit" name ="addEvent" id="addButton" value="Add Event">
                        </form>`
                    </div>
                </div>

                <button id="editBtn">Edit Event</button>
                <div id="editModal" class="modal">
                    <div class="editEvent">
                        <div class="topmodal">
                            <p>Edit Event</p>
                            <span class="close">&times;</span>
                        </div>
                        <form action="controllerEvents.php" method="post">
                            <div class="field">
                                <label for="oldEventName">Existing Event Name</label>
                                <select name="oldEventName" id="oldEventName">
                                    <?php foreach ($eventsResults as $eventn): ?>
                                        <option><?= $eventn->eventName ?></option>
                                    <?php endforeach ?>
                                </select>

                            </div>    

                            <div class="field">
                                <label for="editEventName">Event Name</label>
                                <input name="eventName" id="editEventName">
                            </div>
                            <div class="field">
                                <label for="editDescription">Description</label>
                                <textarea id="editDescription" name="description" rows="2" cols="25"></textarea>
                            </div>
                            <div class="field">
                                <label for="editStartDate">Start Date</label>
                                <input type="date" name="startDate" id="editStartDate">
                            </div>
                            <div class="field">
                                <label for="editStartTime">Start Time</label>
                                <input type="time" name="startTime" id="editStartTime">
                            </div>
                            <div class="field">
                                <label for="editEndDate">End Date</label>
                                <input type="date" name="endDate" id="editEndDate">
                            </div>
                            <div class="field">
                                <label for="editReturnTime">Return Time</label>
                                <input type="time" name="returnTime" id="editReturnTime">
                            </div>
                            <div class="field">
                                <label for="editCapacity">Capacity</label>
                                <input type="number" name="capacity" id="editCapacity">
                            </div>
                            <div class="field">
                                <label for="editTicketsAvailable">Tickets Available</label>
                                <input type="number" name="ticketsAvailable" id="editTicketsAvailable">
                            </div>
                            <div class="field">
                                <label for="editLocation">Location</label>
                                <select required id="editLocation" name="location">
                                    <?php foreach ($EventLocation as $eventloca): ?>
                                        <option><?=$eventloca?></option>
                                    <?php endforeach ?>
                                </select> <br> 
                            </div>
                            <div class="field">
                                <label for="editPrice">Price &pound;</label>
                                <input type="text" name="price" id="editPrice">
                            </div>
                            <div class="field">
                                <label for="editPromoCode">Promo Code</label>
                                <select id="editPromoCode" name="promoCode">
                                    <option disabled selected value> -- select an option -- </option>
                                    <?php foreach ($promosword as $promo): ?>
                                        <option> <?=$promo->promoCode?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                                <input type="submit" name ="editevent" id="editButton" value="Edit Event">
                        </form>
                    </div>
                </div>

                <button id="deleteBtn">Delete Event</button>
                <div id="deleteModal" class="modal">
                    <div class="deleteEvent">
                        <div class="topmodal">
                            <p>Delete Event</p>
                            <span class="close">&times;</span>
                        </div>
                        <form action="controllerEvents.php" method="post">
                            <div class="field">
                                <label for="eventName">Event Name</label>

                                <select name="eventName" id="eventName">
                                    <?php foreach ($eventsResults as $event): ?>
                                        <option><?= $event->eventName ?></option>
                                    <?php endforeach ?>
                                </select>

                            </div>
                            <input type="submit" name="deletevent" id="deleteButton" value="Delete Event"/>
                        </form>
                    </div>
                </div>
                
            </div>
        <?php endif ?> 




        <div class = "carboxes"> 
            <?php foreach ($events as $event): ?>
                <div class="cardCar"> 
                    <div class = "promoImagediv">
                        <img class = "carImg" src="../view/itemAssets/events/<?=$event->location?>.png" alt="image of event in <?=$location?>">
                    </div>
                    <div class = "tv">
                        <div class = "promocardInfo1">
                            <div class="info">
                                <a href="controllerEvents.php"> <?=$event->eventName?></a>
                                <div class="infoinner">
                                    <div>
                                        <p class="eventLocation"><?=$event->location?></p>
                                        <p><?=$event->startDate?></p>
                                        <p><?=$event->startTime?></p>
                                    </div>
                                    <div>
                                        <p><?=$event->ticketsAvailable?></p>
                                        <p><?=$event->endDate?></p>
                                        <p><?=$event->returnTime?></p>
                                    </div>
                                </div>
                                <div class="pricediv1 eventpricediscount">
                                    <p class="price">£<?=$event->price?></p>
                                    <?php if($event->discountedPrice):?>
                                        <p class= "discountedPrice">£<?=$event->discountedPrice?> per day</p>
                                    <?php endif?>
                                </div>
                                <div class = "addPromoBasket">
                                    <form action="controllerEvents.php" action="get">
                                        <input type = "hidden" name = "Id" value = "<?=$event->eventID?>"/>
                                        <input class = "promoaddButton" type ="submit" name ="addPromo2" value="Add"/>
                                        <label style="display:none" for="eventSearch">Add event to basket button</label>
                                    </form>
                                </div>
                            </div>
                            <div class="eventdescription">
                                <p><?=$event->description?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</main>

<?php 
require_once("../view/footer/footer.php");    

?>

</body>
</html>