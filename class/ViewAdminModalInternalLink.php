<?php
/**
* ViewAdminModalInternalLink
* モーダル用記事一覧
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
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
<?php foreach ($article_data as $key => $value) { ?>
  <a class="btn btn-sm btn-default btn-block" href="javascript:void(0);" onclick="surroundHTML(['a','in','<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>','<?php echo $value['title'] ?>'],'text_body');" data-dismiss="modal">
    <div class="col-md-2"><?php if($value['status']){ echo $value['release_time']; } ?></div>
    <div class="col-md-10"><img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" height="20"> <?php echo $value['title'] ?></div>
  </a>
<?php } ?>
</div>

<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
