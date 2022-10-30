var latlng = new google.maps.LatLng(51.5, -0.10);
var typeId = google.maps.MapTypeId.ROADMAP;
var mapOptions = 
        {
            center: latlng,
            zoom: 8,
            mapTypeId: typeId
};

var map;
function initiaize()
{
    var mapDiv = document.getElementById('map');
    map = new google.maps.Map(mapDiv, mapOptions);
};


google.maps.event.addDomListener(window, 'load', initiaize);



const container = document.querySelector(".container")
const prev = document.querySelector(".prev")
const next = document.querySelector(".next")


next.addEventListener('click', () => {
  plusSlides()
})

prev.addEventListener('click', () => {
  prev2()
})

function prev2() {
  let pos1 = Math.abs(parseInt(container.style.getPropertyValue("--pos")))
  if (pos1 === 0) {
    // 0 + 99 = 66 - 33
    pos1 += 100 //99
  }
  // 66 = -33
  container.style.setProperty("--pos", `-${pos1 - 25}%` ) // -33
}

function plusSlides()
{
  let pos1 = Math.abs(parseInt(container.style.getPropertyValue("--pos")))
  if (pos1 == 75) { //66
    pos1 -=100 //-33
  }
  container.style.setProperty("--pos", `-${pos1 + 25}%` ) // + 33

}
setInterval(() => {
  plusSlides();
}, 3500)



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
    p.querySelector(".carImg").classList.add("Toyotamove");
  }

  var searchToyota = text.search("Jaguar");
  if (searchToyota >=0)
  {
    p.querySelector(".carImg").classList.add("Jaguar");
  }
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

var all2 = document.querySelectorAll(".allPrice2");

for (vehicle of all2)
{
    var price = vehicle.querySelector(".price"); 
    var discountedPrice = vehicle.querySelector(".discountedPrice");
    if (discountedPrice)
    {
        price.classList.add("othercross");
    }

}



$(document).ready(function(){
  $(".rental").click(function(){
    // alert("The paragraph was clicked.");
    $(".content").show();
    $(".content2").hide();
    $(".rental").css("opacity", "1.0");
    $(".rental").css("border-bottom", "2px solid rgb(73, 187, 203)");
    $(".events").css("border-bottom", "0px solid rgb(73, 187, 203)");
    $(".events").css("opacity", "0.5");
  });
});

$(document).ready(function(){
  $(".events").click(function(){
    // alert("The paragraph was clicked.");
    $(".content2").css("display", "flex");
    $(".content").hide();
    $(".events").css("opacity", "1.0");
    $(".events").css("border-bottom", "2px solid rgb(73, 187, 203)");
    $(".rental").css("border-bottom", "0px solid rgb(73, 187, 203)");
    $(".rental").css("opacity", "0.5");
  });
});

var clk
var p

$(".toggle").click(function(){
  clk = $(this).attr("id");
  p = "#"+clk 
  clk = p+"C"
  if($(clk).css('display') == 'none')
  {
    $(clk).slideDown();
    $(p).css("border-bottom", "0px");

  }
  else
  {
    $(clk).slideUp();
    if ((p !== "#four") && (p !== "#eight"))
    {
      $(p).css("border-bottom", "1px solid rgba(0,0,0,0.2)");
    }

  }
});


//modal set promo
document.getElementById("toggleSetPromotion").onclick = function() {
  document.getElementById("setPromotion").style.display = "block";
  document.getElementById("addPromotion").style.display = "none";
  document.getElementById("editPromotion").style.display = "none";
  document.getElementById("deletePromotion").style.display = "none";
}

document.getElementsByClassName("close")[0].onclick = function() {
  document.getElementById("setPromotion").style.display = "none";
}

//modal add edit delete
document.getElementById("toggleAddPromotion").onclick = function() {
  document.getElementById("addPromotion").style.display = "block";
  document.getElementById("editPromotion").style.display = "none";
  document.getElementById("deletePromotion").style.display = "none";
  document.getElementById("setPromotion").style.display = "none";
}

document.getElementsByClassName("closeAdd")[0].onclick = function() {
  document.getElementById("addPromotion").style.display = "none";
}

document.getElementById("toggleEditPromotion").onclick = function() {
  document.getElementById("addPromotion").style.display = "none";
  document.getElementById("editPromotion").style.display = "block";
  document.getElementById("deletePromotion").style.display = "none";
  document.getElementById("setPromotion").style.display = "none";
}

document.getElementsByClassName("closeEdit")[0].onclick = function() {
  document.getElementById("editPromotion").style.display = "none";
}

document.getElementById("toggleDeletePromotion").onclick = function() {
  document.getElementById("addPromotion").style.display = "none";
  document.getElementById("editPromotion").style.display = "none";
  document.getElementById("deletePromotion").style.display = "block"; 
  document.getElementById("setPromotion").style.display = "none";   
}

document.getElementsByClassName("closeDelete")[0].onclick = function() {
  document.getElementById("deletePromotion").style.display = "none";
}


