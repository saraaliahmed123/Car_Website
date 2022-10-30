<head>
    <script src="../view/nav/nav.js" defer> </script>
    <script type="text/javascript" src="../view/nav/clientcode.js"></script>

    <link rel="stylesheet" href="../view/nav/nav.css">

</head>
    
    <nav class = "navBar">
        <div class = "logo">
            <div class="burger">
                <button id = "burgermenu" class = "burgermenu" > <box-icon class = "bmenu" name='menu' title="burger button"></box-icon> </button>
            </div>
            <a href="controllerHomePage.php"><img class = "logoCar" src ="../view/assets/carlogo4.jpg" alt="Wagon's Roll logo">
        </div>
        <div class = "navitemsall">     
            <div class = "navitems">
                <a class = "itemsText" href="controllerHomePage.php">Home</a>
                <a class = "itemsText" href="controllerRentals.php">Rentals</a>
                <a class = "itemsText" href="controllerEvents.php">Events</a>
                <a class = "itemsText" href="controllerAboutUs.php">About us</a>
            </div>

            <div class = "navitems2">

                <div class = "navsearchbox">
                    <form class = "search" method="get" action="controllerSearch.php">
                        <input class ="searchinput" name = "searchinput" type="search" required>
                        <label style="display:none" for="searchinput">Search box</label>
                        <div class="results">
                            <div class="result"></div>
                        </div>
                        <button class="searchbutnav"><i class="fa fa-search"></i> </button>
                    </form>   
                </div>

                <div class = "basket">
                    <a class = "basketicon" href="controllerBasket.php"> <img class = "basketimg" src = "../view/assets/shopping-cart.png" alt="shopping cart button"> </a>
                </div>

                <div class="AccountIcon">
                    <button class="Icon"><img class = "imgIcon" src = "../view/assets/user.png" alt="account button"></a></button>
                    <div class="dropdown-content">
                        <?php if (!$user): ?>
                            <button class = "userLog" id="signinbutton">Sign In</button>
                            <button class = "userLog" id = "signupbutton">Sign Up</button>
                        <?php endif ?>
                        <?php if ($user): ?>
                            <a class = "userLog" href="controllerAccount.php">Hi, <?=$user->firstName . ' ' . $user->lastName ?></a>
                            <a href="controllerHomePage.php?signout">Sign Out</a>
                        <?php endif ?>
                    </div>
                </div>

            </div>

        </div>      
    </nav>

    <div id="sidebar" class = "navside side"> 
        <div class = "navitemsside" >
            <a class = "itemsText side" href="controllerHomePage.php">Home</a>
            <a class = "itemsText side" href="controllerRentals.php">Rentals</a>
            <a class = "itemsText side" href="controllerEvents.php">Events</a>
            <a class = "itemsText side" href="controllerAboutUs.php">About us</a>
            <div class = "basket">
                <a class = "itemsText side" class = "basketicon" href="controllerBasket.php" alt="shopping cart button"> Basket </a>
            </div>

            <div class="AccountIcon">
                <button class="Icon side"><img class = "imgIcon" src = "../view/assets/user.png" alt="account button"></a></button>
                <div class="dropdown-content sideposition">
                    <?php if (!($user)): ?>
                        <button class = "userLog side" id="signinbuttonside">Sign In</button>
                        <button class = "userLog side" id = "signupbuttonside">Sign Up</button>
                    <?php endif ?>
                    <?php if ($user): ?>
                        <a class = "userLog side" href="controllerAccount.php">Hi, <?=$user->firstName . ' ' . $user->lastName ?></a>
                        <a href="controllerHomePage.php?signout">Sign Out</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>

    <div class = "login">
        <div class = "top">
            <p> Sign In </p>
            <button class="closelogin"> <box-icon name='x' title="close log in pop up"></box-icon> </button>
        </div>
        <form class ="loginform" method="post" action="controllerHomePage.php">
            <input name="usernameLog" placeholder="Username"/>
            <label style="display:none" for="usernameLog">Enter Username</label>
            <input name="passwordLog" placeholder="Password"/>
            <label style="display:none" for="passwordLog">Enter Password</label>
            <input class="buttonlogsign" type="submit" value="Sign In"/>
            <label style="display:none" for="buttonlogsign">Sign in button</label>
        </form>
    </div>
    
    <div class = "signup">
        <div class = "top">
            <p> Sign Up </p>
            <button class="closesignup"> <box-icon name='x' title="close sign up pop up"></box-icon> </button>
        </div>
        <form class ="signupform" method="post" action="controllerHomePage.php">
            <input name="title" placeholder="Title"/>
            <label style="display:none" for="title">Enter Title</label>
            <input name="firstName" placeholder="First Name"/>
            <label style="display:none" for="firstName">Enter First name</label>
            <input name="lastName" placeholder="Last Name"/>
            <label style="display:none" for="lastName">Enter last name</label>
            <input name="email" placeholder="Email Address"/>
            <label style="display:none" for="email">Enter email address</label>
            <input name="contactNumber" placeholder="Contact Number"/>
            <label style="display:none" for="contactNumber">Enter contact number</label>
            <input name="username" placeholder="Username"/>
            <label style="display:none" for="username">Enter username</label>
            <input name="password" placeholder="Password"/>
            <label style="display:none" for="passwordLog">Enter Password</label>
            
            <input name="licenceNumber" placeholder="licenceNumber"/>
            <label style="display:none" for="licenceNumber">Enter licence Number</label>

            <input name="licenceExpiryDate" placeholder="licenceExpiryDate"/>
            <label style="display:none" for="licenceExpiryDate">Enter licence Expiry Date</label>

            <input class="buttonlogsign" type="submit" value="Sign up"/>
            <label style="display:none" for="buttonlogsign">Sign up button</label>
        </form>
    </div>

    <?php if($isnotloggedin == "notloggedin"): ?>
        <div class = "popup2">
            <button class="closepopup2"> <box-icon name='x' title="close incorrect login popup"></box-icon> </button>
            <p> Incorrect login </p>
        </div>
    <?php endif ?>