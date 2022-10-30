<!DOCTYPE html>
<html>

<head>
    <title>Car Hire Ltd.</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="../view/Aboutus/aboutus.js" defer> </script>

    <link rel="stylesheet" href="../view/Aboutus/aboutus.css">
    
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
    <div class="inside">
        <div class="imagediv">
            <img class="image" src="../view/assets/caraboutus2.jpg" alt="background image of car">
        </div>
        <div class="valuetitlediv">
            <h1> About us </h1>
        </div>
        <div class="valuesbox">
            <div class="valuesinside">
                <!-- <img src="../view/assets/icon-smile-blue.png" > -->
                <box-icon color="rgb(73, 187, 203)" name='smile'></box-icon>
                <h3> We know the service you receive matters </h3>
                <p> So we use real reviews, genuine customer feedback and our own experience to guide you through your best options.</p>
            </div>
            <div class="valuesinside">
                <!-- <img src="../view/assets/icon-globe-blue.png" > -->
                <box-icon color="rgb(73, 187, 203)" name='world'></box-icon>
                <h3> We work with car hire companies all over the world </h3>
                <p> From household names to small local specialists – to bring you the cars, choices and deals that make the difference to your trip. </p>
            </div>
            <div class="valuesinside">
                <!-- <img src="../view/assets/icon-car-blue.png" > -->
                <box-icon color="rgb(73, 187, 203)" name='car' type='solid' ></box-icon>
                <h3> And we stay with you every step of the way </h3>
                <p> Our customer team is here to support you through your trip, wherever and whenever you need extra help.</p>
            </div>
        </div>

        <div class="info">

            <div class = "section">
                <div id="one"class = "sectiontitle">
                    <p> About Wagons Roll</p>
                    <button id="one"class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                </div>
                <div id="oneC" class= "sectioncontent">
                    <p> At Wagons Roll, we know that buying a holiday can be a huge outlay, whether you’re travelling as a family, a couple, with friends or on a solo adventure. And, although planning a break should be fun, the financial aspects can often add unnecessary stress to the booking process.</p>
                        <br>
                    <p> That’s where we can help. Wagons Roll is the UK’s market-leading price-comparison service for package holidays. We compare thousands of individual package holidays from more than 20 leading travel companies, so you can see your travel options side-by-side and save valuable time and cash.</p>
                        <br>
                    <p> Plus, as all of the holiday companies on our site are protected by ATOL, you can book with confidence knowing that they are covered financially should the company cease trading. </p>
                        <br>
                    <p> And we don’t stop there. Wagons Roll is also an online comparison service for car hire, flights, hotels, cruises and holiday extras – including travel insurance, airport parking, airport lounges and car hire excess insurance. </p>
                        <br>
                    <p> We search: </p>
                    <ul> 
                        <li>Thousands of individual package holidays from more than 20 companies </li>
                        <li>Over 650 scheduled, low-cost and charter airlines from more than 100 individual suppliers </li>
                        <li>More than 200,000 individual hotels from over 40 individual hotel suppliers </li>
                        <li>Over 200 individual car hire providers from more than 20 suppliers. </li>
                        <li>This is Wagons Roll. We’re here to provide the nation with super holidays at super prices. </li>
                    </ul>
                </div>
            </div>

            <div class = "section">
                <div id="two" class = "sectiontitle">
                    <p> How does it work? </p>
                    <button id="two" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                </div>
                <div id="twoC" class= "sectioncontent">
                    <p> At Wagons Roll, we pride ourselves on offering you accurate, real-time holiday availability. We take information directly from travel companies such as easyJet, British Airways, First Choice, Jet2holidays, Enterprise, Avis and many more, ensuring you are presented with the best possible price. Once you find the deal you’re happy with, we’ll take you directly to the holiday company’s site to book. </p>
                </div>
            </div>

            <div class = "section">
                <div id="three" class = "sectiontitle">
                    <p> How do we make money? </p>
                    <button id="three" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                </div>
                <div id="threeC" class= "sectioncontent">
                    <p> Our service is free, secure and easy to use and we’re dedicated to saving you money. We don’t charge fees for our comparison services, we earn money from the companies who are on our site. Here’s how it works: </p>
                    <ol>
                        <li>You compare a range of holidays on Wagons Roll to find the deal you want </li>
                        <li>Once you click through to a provider, the company will pay us a fee for that click. In some cases, the fee is only paid once you have completed the purchase of the product from the partner site. Either way, it doesn't impact the price you pay! </li>
                    </ol>
                </div>
            </div>

            <div class = "section">
                <div id="four" class = "sectiontitleLast">
                    <p> How do you contact our customer services team? </p>
                    <button id="four" class = "toggle"><box-icon name='chevron-down'></box-icon> </button>
                </div>
                <div id="fourC" class= "sectioncontent">
                    <p> If you haven’t found the answer to your question on how we work, or you’d like to get in touch about something else, you can email our customer services team at customerservices@icetravelgroup.com. If you’d like to get in touch about how we use your personal data you can contact us at datarequest@icetravelgroup.com.
                        <br>
                        In response to Covid-19, we have closed our offices following government advice. If you have submitted a subject access request (SAR) by post, then please be aware there may be a delay in processing your request. Our contact centre is fully operational.
                        <br>
                        We will always do our best to make sure your experience with us is as quick and easy as it can be, but if you are unhappy with our service then our customer services team are here for you. We will aim to send you a formal acknowledgment of your complaint within 48 hours, and our team will work to resolve the problem as soon as possible. We’ll then send you a final response once we’ve had a chance to look into the issue further.
                    </p>
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