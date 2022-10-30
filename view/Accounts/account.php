<!DOCTYPE html>
<html>

<head>
    <title>Car Hire Ltd.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="../view/Accounts/js.js" defer> </script>

    <link rel="stylesheet" href="../view/Accounts/account.css">
    
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

    <div class="accountpage">
        <div class="accounttitle">
            <h1> Account details </h1>
        </div>

        <div class="content">
            <div class="sidebuttons">
                <div class = "buttonone">
                    <button id ="dashboardbut"> Dashboard</button>
                    <box-icon color="rgb(73, 187, 203, 0.9)" type='solid' name='dashboard'></box-icon> 
                </div>
                <div class = "buttonrest">
                    <button id ="orders"> Orders </button>
                    <box-icon name='basket' color="rgb(73, 187, 203, 0.9)" type='solid' ></box-icon>
                </div>
                <div class = "buttonrest">
                    <button id ="accountdetails"> Account details </button>
                    <box-icon color="rgb(73, 187, 203, 0.9)" type='solid' name='user'></box-icon>
                </div>
                <div class = "buttonrest">
                    <a href="controllerHomePage.php?signout"> <button id ="logout"> Logout </button> </a>
                    <box-icon color="rgb(73, 187, 203, 0.9)" name='log-in'></box-icon>
                </div>
            </div>
            <div class="innercontent">
                <div class="dashboard">

                    <p> Hello <?= $user->firstName ." ". $user->lastName ?> </p>

                    <p> This is your dashboard, you can view your orders and account details through the menu.  </p>

                </div>

                <div class="orders">
                    <table class="accountBookingTable">
                        <th> Order </th>
                        <th> Start Date </th>
                        <th> End Date </th>
                        <th> Destination </th>
                        <th> Total Paid </th>
                        <th> Booking Type </th>
                        <th> Tickets Bought </th>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td id="ordernum">#<?=$booking->bookingReference?></td>
                                <td><?=$booking->startDate?></td>    
                                <td><?=$booking->endDate?></td> 
                                <td><?=$booking->destination?></td>  
                                <td>£<?=$booking->totalPaid?></td>   
                                <td><?=$booking->bookingType?></td>
                                <td><?=$booking->ticketsBought?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>

                    <p class="ptag"> You have <?= count($bookings) ?></p>

                </div>

                <div class="accountdetails">

                    <form class="form"action="controllerAccount.php" method="post">
                        <div class="titleuser">
                            <p> Title </p>
                            <input name="title" value ="<?= $user->title?>"  disabled/>
                        </div>
                        <div class="firstandlast">
                            <div class="first">
                                <p> First name </p>
                                <input name="firstName" value ="<?= $user->firstName?>" disabled/>
                            </div>
                            <div class="last">
                                <p> Last name </p>
                                <input name="lastName" value ="<?= $user->lastName?>" disabled/>
                            </div>
                        </div>
                        <div class="email">
                            <p> Email </p>
                            <input name="email" value ="<?= $user->email?>" disabled/>
                        </div>
                        <div class="contact">
                            <p> Contact number </p>
                            <input name="contactNumber" value ="<?= $user->contactNumber?>" disabled/>
                        </div>
                        <div class="userandpass">
                            <div class="user">
                                <p> Username </p>
                                <input name="username" value ="<?= $user->username?>" disabled/>
                            </div>
                            <div class="pass">
                                <p> Password </p>
                                <input name="password" value ="<?= $user->password?>" disabled/>
                            </div>
                        </div>
                        <!-- <input class="buttonlogsign" type="submit" value="Sing Up"/> -->
                    </form>

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