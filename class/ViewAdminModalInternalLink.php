<?php
/**
* ViewAdminModalInternalLink
* モーダル用記事一覧
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.2
*/

Class ViewAdminModalInternalLink {
	public function __construct() {
		try {
			session_start();

			$object_car = new ControllerArticle();
			$article_data = $object_car->showAllByAdmin();

			self::body($article_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($article_data) {
		try {
?>

<div class="row">
  <span class="glyphicon glyphicon-search"></span> タイトル検索： <input type="text" id="search-text" class="no-enter">
  <hr>
<?php foreach ($article_data as $key => $value) { ?>
<?php if ($value['status']) { ?>
  <a class="btn btn-sm btn-default btn-block article hidden" href="javascript:void(0);" onclick="surroundHTML(['a','in','<?php echo $value['article_id'] ?>'],'text_body');" data-dismiss="modal">
    <div class="col-md-2"><?php if($value['status']){ echo $value['release_time']; } ?></div>
    <div class="col-md-10"><img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" height="20"> <?php echo $value['title'] ?></div>
  </a>
<?php } ?>
<?php } ?>
</div>
<script>
 var el = document.getElementById("search-text");
 el.focus();
//document.getElementById("search-text").focus();
$(function () {
  searchWord = function(){
    var searchText = $(this).val();
    $('.article').each(function() {
      var targetText = $(this).text();

      // 検索対象となるリストに入力された文字列が存在するかどうかを判断
      if (searchText!='' && targetText.indexOf(searchText)!=-1) {
        $(this).removeClass('hidden');
      } else {
        $(this).addClass('hidden');
      }
    });
  };
  // searchWordの実行
  $('#search-text').on('input', searchWord);
});
</script>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
