// Other Event
$(function(){
  //Hover effect
  $("#hover_filter, #hover_btn").hover(
    function () {
      $(this).addClass('touch_hover_clear');
    },
    function () {
      $(this).removeClass('touch_hover_clear');
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
