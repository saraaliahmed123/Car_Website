

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


var m = document.querySelectorAll(".promoImagedivpopular"); 
for (p of m)
{
  var text = p.querySelector(".carpopular").getAttribute("src")
  var searchAudi = text.search("Audi");
  if (searchAudi >=0)
  {
    p.querySelector(".carpopular").classList.add("miniaudi");
  }
}





//price low

//modal 


var modal = document.getElementById("myModal");
var editBtnModal = document.getElementById("editBtnModal");
var delBtnModal = document.getElementById("delBtnModal");

var btn = document.getElementById("myBtn");
var editBtn = document.getElementById("editBtn");
var delBtn = document.getElementById("delBtn");

var span = document.getElementsByClassName("close")[0];
var editSpan = document.getElementsByClassName("close")[1];
var delSpan = document.getElementsByClassName("close")[2];

btn.onclick = function() {
  modal.style.display = "block";
  editBtnModal.style.display = "none";
  delBtnModal.style.display = "none";
}

editBtn.onclick = function() {
  editBtnModal.style.display = "block"
  modal.style.display = "none";
  delBtnModal.style.display = "none";
}

delBtn.onclick = function() {
  delBtnModal.style.display = "block";
  modal.style.display = "none";
  editBtnModal.style.display = "none";
}

span.onclick = function() {
  modal.style.display = "none";
}

editSpan.onclick = function() {
  editBtnModal.style.display = "none";
}

delSpan.onclick = function() {
  delBtnModal.style.display = "none";
}

