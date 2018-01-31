//GA event
function trackOutboundLink(link, category, action, label) {
    try {
    _gaq.push(['_trackEvent', category, action, label]);
    } catch(err){}

    setTimeout(function() {
    document.location.href = link.href;
    }, 100);
}

function ecbtn_submit(form) {
　　form.target="newwindow";
　　window.open("","newwindow");
　　document.getElementById("submit").click();
}

//Click Event
$(function(){
  var clickFlag = true;
  $(document).on('click', ".push-click", function() {
      if(clickFlag) {
        clickFlag = false;
        var a = $(this).data('article-id');
        var p = $(this).attr('id');
        var u = $(this).attr('href');
        pushClick(a, p, u).done(function(result) {
          clickFlag = true;
        });
      }
  });
});

function pushClick(article_id, place, url) {

  var data = {
    "article_id": article_id,
    "place": place,
    "url": url,
  };

  $('form').empty();
  var $form = $('form').get(0);
  var formData = new FormData($form);
  formData.append("article_id", data["article_id"]);
  formData.append("place", data["place"]);
  formData.append("url", data["url"]);

  return $.ajax('/articles/countclick', {
    method: 'POST',
    contentType: false,
    processData: false,
    data: formData,
    timeout: 10000,
    crossDomain: true,
    error: function() {
    },
    success: function(data, dataType) {
    }
  });

}


// Other Event
$(function(){

  //Hover effect
  $("#ranking_box, #auto_box, #side_side_feature, #side_sitename_girl, #listview_bg span, #written_user_box, #hover_filter, #hover_btn").hover(
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
