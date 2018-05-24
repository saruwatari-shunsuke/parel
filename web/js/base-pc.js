// Other Event
$(function(){
  //Hover effect
  $('.hover-light').hover(
    function () {
      $(this).addClass('hover-light-on');
    },
    function () {
      $(this).removeClass('hover-light-on');
    }
  );
  //Modal close
  $("#close").click(function () {
    $("div#out").fadeOut("fast");
  });
  //Loading img
  $(".display-loading").click( function() {
    var message = "処理中...";
    if($("#loading").size() == 0){
      $("body").append("<div id='loading'><div class='loadingMessage'>" + message + "</div></div>");
    }
  });
});
