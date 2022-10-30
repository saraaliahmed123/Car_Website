
////////////////////EMPLOYEE///////////////////////////////////
$(document).ready(initialisePage);

function initialisePage()
{
  $(".locationinput").keyup(function() {
    var search = $(".locationinput").val().trim();
    console.log(search);
    if (search != "")
    {
      $.get("getSearch_service.php?searchinputboxRental="+search,function(results) {
        $("div.results2").empty();
        for (var r of results)
        {
          var one = $('<div class="result2">'+r+'</div>');
          one.click(function(){
            $("div.results2").hide();
            $("input[name=location]").val($(this).text());
          });
          $("div.results2").append(one);
        }
        if (results.length == 0)
        {
          $("div.results2").hide();
        }
        else {
          $("div.results2").show();
        }
      });
    }
    else
    {
      $("div.results2").hide();
    }

  });


  $(".locationinput3").keyup(function() {
    var search = $(".locationinput3").val().trim();
    console.log(search);
    if (search != "")
    {
      $.get("getSearch_service.php?searchinputboxEvent="+search,function(results) {
        $("div.results3").empty();
        for (var r of results)
        {
          var one = $('<div class="result3">'+r+'</div>');
          one.click(function(){
            $("div.results3").hide();
            $("input[name=location2]").val($(this).text());
          });
          $("div.results3").append(one);
        }
        if (results.length == 0)
        {
          $("div.results3").hide();
        }
        else {
          $("div.results3").show();
        }
      });
    }
    else 
    {
      $("div.results2").hide();
    }
  });

  $("div#selectPromotion input#editsubmit").click(function(){
    var search = $("div#selectPromotion select#promotionSelect").val().trim();
    if (search != "")
    {
        console.log($.get("getPromotion_service.php?promoCode="+search));
        $.get("getPromotion_service.php?promoCode="+search,function(promotionResult) {
            $("input[name=ePromoCode]").val(promotionResult.promoCode);
            $("input[name=eStartDate]").val(promotionResult.startDate);
            $("input[name=eEndDate]").val(promotionResult.endDate);
            $("input[name=eDiscount]").val(promotionResult.discount);
            $("input[name=eType]").val(promotionResult.type);
        });
    }
  });
  
}