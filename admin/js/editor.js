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
function setCategoryUrl(category,color){
  if (color==0) {
    document.getElementById("category_url").innerHTML='http://'+category+'.parel.site/';
  } else {
    document.getElementById("category_url").innerHTML='http://<span style="color:#f00;">'+category+'</span>.parel.site/';
  }
}

//編集中にbackspaceをうっかり押してブラウザバック防止
window.location.hash="#noback";
window.onhashchange=function(){
    window.location.hash="#noback";
}

// テキストエリアの高さを自動調節（うまく動かない）
jQuery.each(jQuery('textarea'), function() {
    var offset = this.offsetHeight - this.clientHeight;
    var resizeTextarea = function(el) {
        jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
    };
    jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr();
});

// ツールバー内タグ挿入ボタン
function getAreaRange(obj) {
  var pos = new Object();

  if (isIE) {
    obj.focus();
    var range = document.selection.createRange();
    var clone = range.duplicate();
     
    clone.moveToElementText(obj);
    clone.setEndPoint( 'EndToEnd', range );
     
    pos.start = clone.text.length - range.text.length;
    pos.end = clone.text.length - range.text.length + range.text.length;
  } else if(window.getSelection()) {
    pos.start = obj.selectionStart;
    pos.end = obj.selectionEnd;
  }
  return pos;
}
var isIE = (navigator.appName.toLowerCase().indexOf('internet explorer')+1?1:0);

function makeNode(tag, range) {
  if (tag[0]=='a') {
    if (tag[1]=='in') {
      var url = tag[2];
      var title = tag[3];
      return '<a href="' + url + '" title="' + title + '">' + title + '</a>';
    } else if (tag[1]=='ex') {
      var url = document.getElementById('modal_external_url').value;
      var title = document.getElementById('modal_external_title').value;
      document.getElementById('modal_external_url').value = '';
      document.getElementById('modal_external_title').value = '';
      return '<a href="' + url + '" title="' + title + '" target="_blank">' + title + '<span class="glyphicon glyphicon-new-window external-link"></span></a>';
    }
  } else if (tag[0]=='img') {
      return '<img src="' + tag[1] + '">';
  } else {
    if (tag.length==1) {
      return '<' + tag[0] + '>' + range + '</' + tag[0] + '>';
    } else {
      return '<' + tag[0] + ' style="' + tag[1] + '">' + range + '</' + tag[0] + '>';
    }
  }
}
function surroundHTML(tag, obj) {
  var target = document.getElementById(obj);
  var pos = getAreaRange(target);
  var val = target.value;
  var range = val.slice(pos.start, pos.end);
  var beforeNode = val.slice(0, pos.start);
  var afterNode = val.slice(pos.end);
  var insertNode = makeNode(tag, range);
  target.value = beforeNode + insertNode + afterNode;
  var caret = pos.start+insertNode.length;
  target.setSelectionRange(caret, caret);// キャレット移動 firefox
  $(target).trigger("blur").trigger("focus");// キャレット移動 Google Chrome
}

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
$('#ModalInternalLink').on('show.bs.modal', function (e) {
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
 
