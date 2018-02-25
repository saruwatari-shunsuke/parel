<?php
/**
* ViewAdminArticleAll
* 記事一覧（仮）
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 0.1
*/

Class ViewAdminArticleAll {
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
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title><?php echo SITE_TITLE_ADMIN ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
<link rel="stylesheet" type="text/css" href="/css/common/html5reset-1.6.1.css">
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<a href="/" target="_blank">パルール</a>
<a href="/admin/">パルール管理画面</a>
<h1>記事一覧（仮）</h1>
<h1><a href="/admin/write/"><i class="fa fa-edit" aria-hidden="true"></i> 投稿する</a></h1>
<table border=1>
<?php foreach ($article_data as $key => $value) { ?>
  <tr>
    <td><a class="btn" href="/<?php echo $value['path'] ?>/" target="_blank"><i class="fa fa-external-link"></i></a><a class="btn" href="/admin/edit/?id=<?php echo $value['article_id'] ?>"><i class="fa fa-pencil"></i></a></td>
    <td><?php echo $value['article_id'] ?></td>
    <td><?php echo $value['author_id'] ?></td>
    <td><?php echo $value['release_time'] ?></td>
    <td><?php echo $value['path'] ?></td>
    <td><img src="/<?php echo $value['path'].'/'.IMAGE_MAIN_SMALL ?>" width="30" height="30"><?php echo $value['title'] ?></td>
  </tr>
<?php } ?>
</table>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>
</body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}


}
