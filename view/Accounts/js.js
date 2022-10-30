$(document).ready(function(){
    $("#dashboardbut").click(function(){
      $("#dashboardbut").css("color", "black");
      $("#orders").css("color", "rgb(73, 187, 203, 0.9)");
      $("#accountdetails").css("color", "rgb(73, 187, 203, 0.9)");
      $(".dashboard").show();
      $(".orders").hide();
      $(".accountdetails").hide();
      });
  });

  $(document).ready(function(){
    $("#orders").click(function(){
      $("#orders").css("color", "black");
      $("#dashboardbut").css("color", "rgb(73, 187, 203, 0.9)");
      $("#accountdetails").css("color", "rgb(73, 187, 203, 0.9)");
      $(".dashboard").hide();
      $(".orders").show();
      $(".accountdetails").hide();
      });
  });

  $(document).ready(function(){
    $("#accountdetails").click(function(){
      $("#accountdetails").css("color", "black");
      $("#dashboardbut").css("color", "rgb(73, 187, 203, 0.9)");
      $("#orders").css("color", "rgb(73, 187, 203, 0.9)");
      $(".dashboard").hide();
      $(".orders").hide();
      $(".accountdetails").show();
      $(".form").show();
      });
  });

var m = document.querySelector(".ptag"); 
var inner = m.innerHTML
if (inner == "You have 1")
{
    document.querySelector(".ptag").innerHTML = "You have 1 order"
    document.querySelector(".ptag").classList.add("ptag2");
}
else if (inner == "You have 0")
{
    document.querySelector(".ptag").innerHTML = inner+" orders"
}
else
{
    document.querySelector(".ptag").innerHTML = inner+" orders"
    document.querySelector(".ptag").classList.add("ptag2");
}
