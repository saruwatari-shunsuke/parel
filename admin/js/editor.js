//カテゴリとURLが連動
function setCategoryUrl(category){
  document.getElementById("category_url").innerHTML="http://"+category+".parel.site/";
}

//編集中にbackspaceをうっかり押してブラウザバック防止
window.location.hash="#noback";
window.onhashchange=function(){
    window.location.hash="#noback";
}

// テキストエリアの高さを自動調節（うまく動かない）
/*
jQuery.each(jQuery('textarea'), function() {
    var offset = this.offsetHeight - this.clientHeight;
    var resizeTextarea = function(el) {
        jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
    };
    jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr();
});
*/
