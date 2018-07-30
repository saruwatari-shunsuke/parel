// ポップオーバー
$(function () {
  $('[data-toggle="popover"]').popover();
});

// ドロップゾーン外へのドラッグ＆ドロップ防止
$(function () {
  $(document).on('drop dragover', function (e) {
    e.stopPropagation();
    e.preventDefault();
  });
});

// 改行無効
$(function(){
  $(".no-enter"). keydown(function(e) {
    if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
      return false;
    } else {
      return true;
    }
  });
});

//カテゴリとURLが連動
function setCategoryUrl(category, color){
  if (color==0) {
    document.getElementById("category_url").innerHTML='http://'+category+'.parel.site/';
  } else {
    document.getElementById("category_url").innerHTML='http://<span class="url-change">' + category + '</span>.parel.site/';
  }
}

//編集中にbackspaceをうっかり押してブラウザバック防止
window.location.hash="#noback";
window.onhashchange=function(){
  window.location.hash="#noback";
}

/*
// テキストエリアの高さを自動調節（重い）
jQuery.each(jQuery('textarea'), function() {
  var offset = this.offsetHeight - this.clientHeight;
  jQuery(this).css('height', this.scrollHeight + offset);

  var resizeTextarea = function(e) {
    var position = $(window).scrollTop();
    jQuery(e).css('height', e.scrollHeight + offset);
    $(window).scrollTop(position); //スクロール位置がおかしくなるので修正
  };

  jQuery(this).keyup(function(e) {
    if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
      resizeTextarea(this);
    }
  }).removeAttr();
});
*/

// 画面スクロールに合わせてツールバー移動（先にjquery.exflexfixed-0.3.0.jsを読み込むこと）
$(function() {
  $('#toolbar').exFlexFixed({
    container : '#text_body',
    fixedHeader : '#header',
  });
});

// ツールバー各ボタンの説明ふきだし
$(function() {
  $('[data-toggle="tooltip"]').tooltip();
});

// 内部リンクボタンのモーダル内容表示
$('#modal-internallink').on('show.bs.modal', function (e) {
    var loadurl = $(e.relatedTarget).data('load-url');
    $(this).find('.modal-body').load(loadurl);
});

// ページトップに戻る
$(function() {
  $("#page-top").click(function() {
    $('html,body').animate({
      scrollTop: 0
    }, 'fast');
    return false;
  });
});
 
