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
  }
});