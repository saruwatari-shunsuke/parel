<?php
/**
* ViewAdminArticleNew
* 記事投稿（仮）
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 0.1
*/

Class ViewAdminArticleNew {
	public function __construct() {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$error = $object_car->add();

			self::body($error);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($error) {
		try {
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title><?php echo SITE_TITLE_ADMIN ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
<link rel="stylesheet" type="text/css" href="/css/common/html5reset-1.6.1.css">

<a href="/" target="_blank">パルール</a>
<a href="/admin/">パルール管理画面</a>
<h1>記事投稿フォーム（仮）</h1>
<a href="/admin/view/">記事一覧</a>
<p style="color:#ff0000"><?php echo $error; ?></p>
<form action="/admin/write/" method="POST">

URL
　http://parel.site/<input name="path" style="width:200px" type="text" placeholder="" value="<?php echo $_POST['path']; ?>">/
<br>

<?php $c[$_POST['category']]=" selected" ?>
カテゴリ
<select name="category">
  <option value="0">選択してください</option>
  <option value="1"<?php echo $c[1] ?>>Food</option>
  <option value="2"<?php echo $c[2] ?>>Exercise</option>
  <option value="3"<?php echo $c[3] ?>>Health</option>
  <option value="4"<?php echo $c[4] ?>>Fashion</option>
  <option value="5"<?php echo $c[5] ?>>特集</option>
</select>
<br>

<?php $a[$_POST['author']]=" selected" ?>
著者
<select name="author">
  <option value="1"<?php echo $a[1] ?>>いっこだにこださんこだ</option>
  <option value="2"<?php echo $a[2] ?>>スポーツマンシップりな</option>
</select>
<br>

公開日時
<input name="release" style="width:200px" type="text" placeholder="<?php echo date('Y-m-d H:i:s') ?>" value="<?php echo $_POST['release']; ?>">
<br>

タイトル
<input name="title" style="width:700px" type="text" placeholder="" value="<?php echo $_POST['title']; ?>">
<br>

メタキーワード（カンマ区切りで記述してください）
<input name="keyword" style="width:700px" type="text" placeholder="ダイエット,食事,..." value="<?php echo $_POST['keyword']; ?>">
<br>

導入文<br>
<textarea name="introduction" rows="5" style="width:1000px" placeholder=""><?php echo $_POST['introduction']; ?></textarea>
<br>

本文<br>
<textarea name="body" rows="50" style="width:1000px" placeholder=""><?php echo $_POST['body']; ?></textarea>
<br>

まとめ<br>
<textarea name="summary" rows="3" style="width:1000px" placeholder=""><?php echo $_POST['summary']; ?></textarea>
<br>

ステータス
<select name="status">
  <option value="1">公開</option>
  <option value="0">下書き</option>
</select>

<button type="submit" class="btn btn-lg btn-primary"><h1>この内容で投稿する</h1></button>
</form>



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
