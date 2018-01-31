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

$(function(){
    $('#prompt_app_modal').modal('show');

	  //close
	  $("#close").click(function () {
	    $("div#out").fadeOut("fast");
	  });

    //SP img-size-fix for boxview large section
    $("#article_head_imgliq div").each(function(i){
      $(this).imgLiquid();
    });

});

$(function(){
    // app
    if ($('.js-header-app').get(0)) {
        var ha_h = 60;
        var h_h = 42;
        var ht_h = ha_h + h_h;
        $('.modal').css({'padding-top': ht_h + 'px' });
    }
});
