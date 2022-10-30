
var all = document.querySelectorAll(".itemsprice");

for (vehicle of all)
{
    var price = vehicle.querySelector(".price"); 
    var discountedPrice = vehicle.querySelector(".discountedPrice");
    if (discountedPrice)
    {
        price.classList.add("pricecross");
    }

}

var clk
var p

$(".toggle").click(function(){
  clk = $(this).attr("id");
  p = "#"+clk 
  clk = p+"C"
  if($(clk).css('display') == 'none')
  {
    $(clk).slideDown();
    $(clk).css("display","flex");
    $(p).css("border-bottom", "0px");

  }
  else
  {
    $(clk).slideUp();
    $(p).css("border-bottom", "1px solid rgba(0,0,0,0.2)");
  }
});

var total = document.querySelectorAll(".priceinfodiv");

for (t of total)
{
    if (t.innerHTML == 0)
    {
        t.style.display = "none";
    }
}

var item = document.querySelectorAll(".item");

if (item.length >= 0)
{
    item[0].classList.add("line");
}


function checkloginfunction()
{
    var checksignin = document.querySelector(".signin").innerHTML;
    if (checksignin == "")
    {
        document.querySelector(".login").style.display = "block";
    }
    return false;
}

$(document).ready(function(){
    $(".closepopup").click(function(){
      $(".popup").hide();
      });
  });

  $(document).ready(function(){
    $(".closepopup2").click(function(){
      $(".popup2").hide();
      });
  });