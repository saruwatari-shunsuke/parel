// Other Event
$(function(){

  //Hover effect
  $("#ranking_box, #auto_box, #side_side_feature, #listview_bg span, #written_user_box, #hover_filter, #hover_btn").hover(
    function () {
      $(this).addClass( 'touch_hover_clear' );
    },
    function () {
      $(this).removeClass( 'touch_hover_clear' );
    }
  );

  //Modal close
  $("#close").click(function () {
    $("div#out").fadeOut("fast");
  });

  //Articlepage link motion
  $('a[href^=#]').click(function() {
    var href= $(this).attr("href");
    if(href.match(/section/)){
      var speed = 400;
      var target = $(href == "#" || href == "" ? 'html' : href);
      var headerHeight = 110;
      var position = target.offset().top - headerHeight;
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
    }
  });

  //Loading img
  $(".display-loading").click( function() {
    var message = "処理中...";
    if($("#loading").size() == 0){
      $("body").append("<div id='loading'><div class='loadingMessage'>" + message + "</div></div>");
    }
  });

});
