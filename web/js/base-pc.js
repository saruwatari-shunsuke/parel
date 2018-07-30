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
// 画面スクロールに合わせてツールバー移動（先にjquery.exflexfixed-0.3.0.jsを読み込むこと）
  $('#sub-contents-inner').exFlexFixed({
    container : '.container',
    fixedHeader : '#header2',
  });
});


