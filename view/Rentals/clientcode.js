
////////////////////EMPLOYEE///////////////////////////////////
$(document).ready(initialisePage);

function initialisePage()
{
  $( "#sortby" ).change(function() {
    var selection = $('#sortby option:selected').val();
    if (selection != "")
    {
      $.get("getSortBy_service.php?filter="+selection,function(data) {
        $("div.carboxes").empty();
        for (var car of data)
        {
          var card = $("<div class='cardCar'></div>");
          card.html(`
          <div class = "promoImagediv">
              <img class = "carImg" src="../view/itemAssets/rentals/${car.make}/${car.make}.png">
          </div>
          <div class = "tv">
              <div class = "promocardInfo">
                  <a class="atag" href="controllerRentals.php">  ${car.registrationNumber} </a>
                  <div class="info">
                      <div class="info1">
                          <p class="locationp"> ${car.location} </p>
                          <p class="category" >${car.category}</p>
                          <p class="makevehicles"> ${car.make} </p>
                          <p class="modelp"> ${car.model} </p>
                          <p class="colourp"> ${car.colour} </p>
                      </div>
                      <div class="info2">
                          <p class="yearp"> ${car.year} </p>
                          <p class="typep"> ${car.type} </p>
                          <p class="transp"> ${car.transmission} </p>
                          <p class="datep"> ${car.dateEntered} </p>
                          <div class="numofpassengers">
                              <box-icon type='solid' name='car'></box-icon>
                              <p class="nump"> ${car.numOfPassengers} </p>
                          </div>
                      </div>
                  </div>
                  <div class="pricediv allPrice">
                      <p class="price">£${car.price} per day</p>
                      ${car.discountedPrice && (car.price !=car.discountedPrice) ? `<p class= "discountedPrice">£${car.discountedPrice} per day</p>` : ''}
                  </div>
              </div>
              <div class = "addPromoBasket">
                  <form action="controllerRentals.php" action="get">
                      <input class="addidbasket" type = "hidden" name = "regid" value = "${car.registrationNumber}"/>
                      <input type = "date" name = "startDatevehicle" required/>
                      <input type = "date" name = "endDatevehicle" required/>
                      <input type ="submit" name="addtobasket"value="Add"/>
                  </form>
              </div>
          </div>
          `);
          $("div.carboxes").append(card);
        }

        var all = document.querySelectorAll(".allPrice");

        for (vehicle of all)
        {
            var price = vehicle.querySelector(".price"); 
            var discountedPrice = vehicle.querySelector(".discountedPrice");
            if (discountedPrice)
            {
                price.classList.add("pricecross");
            }

        }

        var m = document.querySelectorAll(".promoImagediv"); 
        for (p of m)
        {
          var text = p.querySelector(".carImg").getAttribute("src")
          var search = text.search("Suzuki");
          if (search >=0)
          {
            p.querySelector(".carImg").classList.add("imagesuziki");
            p.classList.add("movesuziki");
          }
          var searchAudi = text.search("Audi");
          if (searchAudi >=0)
          {
            p.querySelector(".carImg").classList.add("imageaudi");
            p.classList.add("moveaudi");
          }

          var searchToyota = text.search("Toyota");
          if (searchToyota >=0)
          {
            p.querySelector(".carImg").classList.add("Toyota");
          }

          var searchToyota = text.search("Jaguar");
          if (searchToyota >=0)
          {
            p.querySelector(".carImg").classList.add("Jaguar");
          }
        }

      })
    }
  })

}

