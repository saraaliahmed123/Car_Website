
////////////////////EMPLOYEE///////////////////////////////////
$(document).ready(initialisePage);

function initialisePage()
{
  $( "#sortby" ).change(function() {
    var selection = $('#sortby option:selected').val();
    if (selection != "")
    {
      $.get("getSortBy_service.php?filterEvent="+selection,function(data) {
        $("div.carboxes").empty();
        for (var event of data)
        {
          var event0 = $("<div class='cardCar'></div>");
          event0.html(`
          <div class = "promoImagediv">
              <img class = "carImg" src="../view/itemAssets/events/${event.location}.png">
          </div>
          <div class = "tv">
              <div class = "promocardInfo1">
                  <div class="info">
                      <a href="controllerEvents.php"> ${event.eventName}</a>
                      <div class="infoinner">
                          <div>
                              <p class="eventLocation">${event.location}</p>
                              <p>${event.startDate}</p>
                              <p>${event.startTime}</p>
                          </div>
                          <div>
                              <p>${event.ticketsAvailable}</p>
                              <p>${event.endDate}</p>
                              <p>${event.returnTime}</p>
                          </div>
                      </div>
                      <div class="pricediv1 eventpricediscount">

                          <p class="price">£${event.price} per day</p>
                          ${event.discountedPrice && (event.price !=event.discountedPrice) ? `<p class= "discountedPrice">£${event.discountedPrice} per day</p>` : ''}

                      </div>
                      <div class = "addPromoBasket">
                          <form action="controllerEvents.php" action="get">
                              <input type = "hidden" name = "Id" value = "${event.eventID}"/>
                              <input class = "promoaddButton" type ="submit" name ="addPromo2" value="Add"/>
                          </form>
                      </div>
                  </div>
                  <div class="eventdescription">
                      <p>${event.description}</p>
                  </div>
              </div>
          </div>
          `);
          $("div.carboxes").append(event0);
        }

        var all = document.querySelectorAll(".eventpricediscount");

        for (vehicle of all)
        {
            var price = vehicle.querySelector(".price"); 
            var discountedPrice = vehicle.querySelector(".discountedPrice");
            if (discountedPrice)
            {
                price.classList.add("pricecross");
            }

        }

      })
    }
  })

}

