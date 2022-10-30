$(document).ready(function(){
  $(".searchbutnav").click(function(){
    $(".search").show();
    $(".searchinput").show();
      $(".fa").css("background", "rgb(73, 187, 203)");
      $(".search").css("color", "white");
      $(".search").css("width", "200px");
    });

});

$(document).ready(function(){
    $(".burgermenu").click(function(){
        $(".navside").stop(true).fadeToggle();
      });
});

$(document).ready(function(){
  $("#signinbutton").click(function(){
    $(".login").show();
    $(".signup").hide();
    });
});

$(document).ready(function(){
  $("#signupbutton").click(function(){
    $(".signup").show();
    $(".login").hide();
    });
});

$(document).ready(function(){
  $("#signinbuttonside").click(function(){
    $(".login").show();
    $(".signup").hide();
    });
});

$(document).ready(function(){
  $("#signupbuttonside").click(function(){
    $(".signup").show();
    $(".login").hide();
    });
});

$(document).ready(function(){
  $(".closelogin").click(function(){
    $(".login").hide();
    });
});

$(document).ready(function(){
  $(".closesignup").click(function(){
    $(".signup").hide();
    });
});

$(document).ready(function(){
  $(".closepopup2").click(function(){
    $(".popup2").hide();
    });
});




