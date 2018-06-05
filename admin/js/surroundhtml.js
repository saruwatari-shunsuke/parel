// async function is supported from Google Chrome v55 or Firefox v52
// ツールバー内タグ挿入ボタン
function getAreaRange(obj) {
  var pos = new Object();
  var isIE = (navigator.appName.toLowerCase().indexOf('internet explorer')+1?1:0);

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
function makeNode(tag, range) {
  if (tag[0]=='a') {
    if (tag[1]=='in') {
      var url = tag[2];
      var title = tag[3];
      return '<a href="' + url + '" title="' + title + '">' + title + '</a>';
    } else if (tag[1]=='ex') {
      var url = document.getElementById('modal_external_url').value;
      var title = document.getElementById('modal_external_title').value;
      if(url.substring(0,4)!='http' && url.substring(0,1)!='/') {
        url = '//' + url;
      }
      document.getElementById('modal_external_url').value = '';
      document.getElementById('modal_external_title').value = '';
      document.getElementById("modal_external_geturl").innerHTML = '';
      return '<a href="' + url + '" title="' + title + '" target="_blank">' + title + '<span class="glyphicon glyphicon-new-window external-link"></span></a>';
    } else if (tag[1]=='ma') {
      return range + ' <a href="https://www.google.com/maps/place/' + encodeURIComponent(range) + '" title="' + range + ' | Google マップ"><span class="glyphicon glyphicon-map-marker"></span>地図</a>';
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

// URLからタイトルを自動取得
function getUrl() {
  document.getElementById("modal_external_geturl").innerHTML = '検索しています。';
  var url = document.getElementById('modal_external_url').value;
  if(url.substring(0,4)!='http' && url.substring(0,1)!='/') {
    url = '//' + url;
  }
  $.get('/edit/get-title.php?url='+url, function(data){
    if(data==''){
      document.getElementById("modal_external_geturl").innerHTML = '失敗しました。直接入力してください。';
    } else {
      document.getElementById('modal_external_title').value = data;
      document.getElementById("modal_external_geturl").innerHTML = 'サイト名が見つかりました。';
    }
  });
}
