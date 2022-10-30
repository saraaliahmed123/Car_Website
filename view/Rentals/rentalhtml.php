<!DOCTYPE html>
<html>

<head>
    <title>Car Hire Ltd.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="../view/Rentals/rentals.js" defer> </script>
    <script type="text/javascript" src="../view/Rentals/clientcode.js"></script>

    <link rel="stylesheet" href="../view/Rentals/rental.css">
    
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
            <form class="formone" method="get" action= "controllerRentals.php">
                <div class="filterbig">
                    <p>Type</p>
                        <?php foreach ($vehicleType as $type): ?>
                            <div class="filter">
                                <input type="checkbox" id="<?=$type?>" name="type[]" value="<?=$type?>">
                                <label for="<?=$type?>"><?=$type?></label>
                            </div>
                        <?php endforeach ?>
                </div>
                <div class="filterbig">
                    <p>Category</p>
                        <?php foreach ($vehicleCategory as $category): ?>
                            <div class="filter">
                                <input type="checkbox" id="<?=$category?>" name="category[]" value="<?=$category?>">
                                <label for="<?=$category?>"><?=$category?></label>
                            </div>
                        <?php endforeach ?>
                </div>
                <div class="filterbig">
                    <p>Make</p>
                        <?php foreach ($vehicleMake as $make): ?>
                            <div class="filter">
                                <input type="checkbox" id="<?=$make?>" name="make[]" value="<?=$make?>">
                                <label for="<?=$make?>"><?=$make?></label>
                            </div>
                        <?php endforeach ?>
                </div>
                <div class="filterbig">
                    <p>Transmission Type</p>
                        <?php foreach ($vehicleTransmission as $transmission): ?>
                            <div class="filter">
                                <input type="checkbox" id="<?=$transmission?>" name="transmission[]" value="<?=$transmission?>">
                                <label for="<?=$transmission?>"><?=$transmission?></label>
                            </div>
                        <?php endforeach ?>
                </div>
                <div class="filterbig">
                    <p>Location</p>
                        <?php foreach ($vehicleLocation as $location): ?>
                            <div class="filter">
                                <input type="checkbox" id="<?=$location?>" name="location[]" value="<?=$location?>">
                                <label for="<?=$location?>"><?=$location?></label>
                            </div>
                        <?php endforeach ?>
                </div>
                <div>
                    <p>Price</p>
                    <div class="pricedivfilter">
                        <label for="minprice">Min Price &pound;</label>
                        <input name="minprice" id="minprice" value="0.00">
                    <br>
                        <label for="maxprice">Max Price &pound;</label>
                        <input name="maxprice" id="maxprice" value="1000.00">
                    <br>
                    </div>
                </div>
                <div>
                    <p>Date Available</p>
                    <div class="datesfilter">
                        <label for="dateAvailable">Start Date</label>
                        <input type="date" name="dateAvailable" id="dateAvailable" value="">
                    <br>
                        <label for="dateUnAvailable">End Date</label>
                        <input type="date" name="dateUnAvailable" id="dateUnAvailable" value="">
                    <br>
                    </div>
                </div>
                        <input type="submit" name ="filterButton" id="filterbutton" value="Filter">
                </form>
                <form method="get" action= "controllerRentals.php">
                        <input type="submit" name ="resetButton" id="resetbutton" value="Reset">
                </form>
        </div>

    <div class="filterandcars">

        <div class="topfilter">
            <div class="minicarsandbox">
                <div class="box">
                    <p> <box-icon name='info-circle'></box-icon> </p>
                    <p> In the last 24 hours, over 20 customers have booked a vehicle </p>
                </div>
                <div class="minicars">
                    <h3> Popular Cars Booked </h3>
                    <div class="minicarsdiv">
                        <?php foreach ($popular as $key => $popularvehcile): ?>
                            <div class="mini">
                                <div class = "promoImagedivpopular">
                                    <img class = "carpopular" src="../view/itemAssets/rentals/<?=$key?>/<?=$key?>.png" alt="image of a <?=$make?>">
                                </div>
                                <p class="vehicletypemini"> <?= $key ?>  </p>
                                <p> <?= $popularvehcile ?>  </p>
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
                <p class="titlerentals"> Rentals: </p>
                <div class="num">
                    <p> Num of vehicles: </p>
                    <p class="bold"> <?= count($vehicles) ?> </p>
                </div>
            </div>

            <?php if (($user) && ($user->role == "employee")): ?>
                <div class="controllerRentalButton">
                    <button id="myBtn">Create new vehicle</button>
                    <div id="myModal" class="modal">
                        <div class = newVehicle>
                            <div class="topmodal">
                                <p>Enter the details of the new rental:</p>
                                <span class="close">&times;</span>
                            </div>
                        <form action="controllerRentals.php" method="post">
                            <div class="field">
                                <label for="registrationNumber">Registration number:</label>
                                    <input required type="text" id="rn" name="rn"><br><br>
                            </div>
                            <div class="field">
                                <label for="make">Make:</label>
                                    <select required id="make" name="make">
                                        <?php foreach ($vehicleMake as $make): ?>
                                            <option><?=$make?></option>
                                        <?php endforeach ?>
                                    </select><br><br> 
                            </div>
                            <div class="field">
                                <label for="model">Model:</label>
                                    <input required type="text" id="model" name="model"><br><br>
                            </div>
                            <div class="field">
                                <label for="colour">Colour:</label>
                                    <input required type="text" id="colour" name="colour"><br><br>
                            </div>
                            <div class="field">
                                <label for="year">Year:</label>
                                    <input required type="text" id="year" name="year"><br><br>
                            </div>
                            <div class="field">
                                <label for="type">Type:</label>
                                    <select required id="type" name="type">
                                        <option value="Car">Car</option>
                                        <option value="Coach">Coach</option>
                                        <option value="Van">Van</option>
                                        <option value="Bike">Bike</option>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="transmission">Transmission:</label>
                                    <select required id="transmission" name="transmission">
                                        <?php foreach ($vehicleTransmission as $transmission): ?>
                                            <option><?=$transmission?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="location">Location:</label>
                                <select required id="location" name="location">
                                        <?php foreach ($vehicleLocation as $location): ?>
                                            <option><?=$location?></option>
                                        <?php endforeach ?>
                                </select><br><br>
                            </div>
                            <div class="field">
                                <label for="category">Category:</label>
                                <select required id="type" name="category">
                                        <?php foreach ($vehicleCategory as $category): ?>
                                            <option><?=$category?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="price">Price:</label>
                                    <input required type="number" name="price" min="1" max="100000" step="any"><br><br>
                            </div>
                            <div class="field">
                                <label for="promoCode">Promocode:</label>
                                    <select id="promoCode" name="promoCode">
                                        <option default>-- select an option --</option>
                                        <?php foreach ($promosword as $promo): ?>
                                            <option><?=$promo?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="numofpass">Num Of Passengers:</label>
                                    <input required type="number" name="numofpass" min="1" max="100000" step="any"><br><br>
                            </div>
                            <input type="submit" id="submitBtn" name="addvehicle">
                        </form>
                        </div>
                    </div>

                    <button id="editBtn">Edit vehicle</button>
                    <div id="editBtnModal" class="modal">
                        <div class = editVehicle>
                            <div class="topmodal">
                                <p>Select the Registration Number to edit</p>
                                <span class="close">&times;</span>
                            </div>
                            <form action="controllerRentals.php" method="post">
                            <div class="field">
                                <label for="registrationNumber">Registration number:</label>
                                    <select required id="rn" name="rn">
                                        <?php foreach ($registrationNumbers as $rgnum): ?>
                                            <option><?=$rgnum?></option>
                                        <?php endforeach ?>
                                    </select> <br> 
                            </div>
                            <div class="field">
                                <label for="make">Make:</label>
                                    <select required id="make" name="make">
                                        <?php foreach ($vehicleMake as $make): ?>
                                            <option><?=$make?></option>
                                        <?php endforeach ?>
                                    </select><br><br> 
                            </div>
                            <div class="field">
                                <label for="model">Model:</label>
                                    <input required type="text" id="model" name="model"><br><br>
                            </div>
                            <div class="field">
                                <label for="colour">Colour:</label>
                                    <input required type="text" id="colour" name="colour"><br><br>
                            </div>
                            <div class="field">
                                <label for="year">Year:</label>
                                    <input required type="text" id="year" name="year"><br><br>
                            </div>
                            <div class="field">
                                <label for="type">Type:</label>
                                    <select required id="type" name="type">
                                        <?php foreach ($vehicleType as $type): ?>
                                            <option><?=$type?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="transmission">Transmission:</label>
                                    <select required id="transmission" name="transmission">
                                        <?php foreach ($vehicleTransmission as $transmission): ?>
                                            <option><?=$transmission?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="location">Location:</label>
                                    <select required id="location" name="location">
                                        <?php foreach ($vehicleLocation as $location): ?>
                                            <option><?=$location?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="category">Category:</label>
                                    <select required id="category" name="category">
                                        <?php foreach ($vehicleCategory as $category): ?>
                                            <option><?=$category?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="price">Price:</label>
                                    <input required type="number" name="price" min="1" max="1000" step="any"><br><br>
                            </div>
                            <div class="field">
                                <label for="promoCode">Promocode:</label>
                                    <select id="promoCode" name="promoCode">
                                        <option disabled selected value> -- select an option -- </option>
                                        <?php foreach ($promosword as $promo): ?>
                                            <option><?=$promo?></option>
                                        <?php endforeach ?>
                                    </select><br><br>
                            </div>
                            <div class="field">
                                <label for="numofpass">Num Of Passengers:</label>
                                    <input required type="number" name="numofpass" min="1" max="100000" step="any"><br><br>
                            </div>
                            <input type="submit" id="submitEditBtn" name="editvehicle">
                            </form>
                        </div>
                    </div>

                    <button id="delBtn">Delete vehicle</button>
                    <!-- create form, will only ask for the registration number as for vehicle identification. --> 
                    <div id="delBtnModal" class="modal">
                        <div class = deleteVehicle>
                            <div class="topmodal">
                            <p>Select the Registration Number to delete:</p>
                                <span class="close">&times;</span>
                            </div>
                            <form action="controllerRentals.php" method="post">
                                <div class="field">
                                    <label for="registrationNumber">Registration number:</label>
                                        <select required id="rn" name="rn">
                                            <?php foreach ($registrationNumbers as $rgnum): ?>
                                                <option><?=$rgnum?></option>
                                            <?php endforeach ?>
                                        </select> <br> 
                                </div>
                                <input type="submit" id = "submitDelBtn" name = "deletevehicle"/>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif ?> 


        <div class = "carboxes">                 
            <?php foreach ($vehicles as $vehicle): $make = $vehicle->make ?> 
                    <div class="cardCar"> 
                        <div class = "promoImagediv">
                            <img class = "carImg" src="../view/itemAssets/rentals/<?=$make?>/<?=$make?>.png" alt="image of a <?=$make?>">
                        </div>
                        <div class = "tv">
                            <div class = "promocardInfo">
                                <a class="atag" href="controllerRentals.php">  <?=$vehicle->registrationNumber?> </a>
                                <div class="info">
                                    <div class="info1">
                                        <p class="locationp"> <?=$vehicle->location?> </p>
                                        <p class="category" ><?=$vehicle->category?></p>
                                        <p class="makevehicles"> <?=$vehicle->make?> </p>
                                        <p class="modelp"> <?=$vehicle->model?> </p>
                                        <p class="colourp"> <?=$vehicle->colour?> </p>
                                    </div>
                                    <div class="info2">
                                        <p class="yearp"> <?=$vehicle->year?> </p>
                                        <p class="typep"> <?=$vehicle->type?> </p>
                                        <p class="transp"> <?=$vehicle->transmission?> </p>
                                        <p class="datep"> <?=$vehicle->dateEntered?> </p>
                                        <div class="numofpassengers">
                                            <box-icon type='solid' name='car'></box-icon>
                                            <p class="nump"> <?=$vehicle->numOfPassengers?> </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="pricediv allPrice">
                                    <p class="price">£<?=$vehicle->price?> per day</p>
                                    <?php if($vehicle->discountedPrice):?>
                                        <p class= "discountedPrice">£<?=$vehicle->discountedPrice?> per day</p>
                                    <?php endif?>
                                </div>
                            </div>
                            <div class = "addPromoBasket">
                                <form action="controllerRentals.php" action="get">
                                    <input class="addidbasket" type = "hidden" name = "regid" value = "<?=$vehicle->registrationNumber?>"/>
                                    <input type = "date" name = "startDatevehicle" required/>
                                    <label style="display:none" for="startDatevehicle">Enter start Date</label>
                                    <input type = "date" name = "endDatevehicle" required/>
                                    <label style="display:none" for="endDatevehicle">Enter end date</label>
                                    <input type ="submit" name="addtobasket"value="Add"/>
                                    <label style="display:none" for="eventSearch">Add vehicle to basket button</label>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php endforeach ?>


        </div>

    </div>
    </div>
    </main>


    <?php 
        require_once("../view/footer/footer.php");
    ?>

</body>
</html>