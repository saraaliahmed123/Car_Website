
////////////////////EMPLOYEE///////////////////////////////////
$(document).ready(initialisePage);

function initialisePage()
{
  $(".searchinput").keyup(handleNiceAutoComplete);
}

function handleNiceAutoComplete()
{
  var search = $(".searchinput").val().trim();
  if (search != "")
  {
      console.log(search);
      console.log($.get("getSearch_service.php?searchinput="+search));
    $.get("getSearch_service.php?searchinput="+search,niceAutoCompleteCallback);
  }
  else 
  {
    $("div.results").hide();
  }
}

function niceAutoCompleteCallback(results)
{
    console.log(results);
    $("div.results").empty();
    for (var i = 0; i < results.length; i++)
    {
      var result = $('<div class="result">'+results[i]+'</div>');
      result.click(function(){
        $("div.results").hide();
        $("input[name=searchinput]").val($(this).text());
        $("form").get(0).submit();
      });
      $("div.results").append(result);
    }
    if (results.length == 0)
    {
      $("div.results").hide();
    }
    else {
      $("div.results").show();
    }
}