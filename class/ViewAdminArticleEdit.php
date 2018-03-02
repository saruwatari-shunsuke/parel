<?php
/**
* ViewAdminArticleEdit
* 記事編集（仮）
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.1
*/

Class ViewAdminArticleEdit {
	public function __construct() {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$article_data = $object_car->show1DataByAdmin();

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
<link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>/css/common/html5reset-1.6.1.css">

<a href="<?php echo MAIN_URL ?>" target="_blank">パルール</a>
<a href="/">パルール管理画面</a>
<h1>記事投稿フォーム（仮）</h1>
<a href="/view/">記事一覧</a>
<p style="color:#ff0000"><?php echo $article_data['error']; ?></p>
<form action="/edit/?id=<?php echo $_GET['id'] ?>" method="POST">

画像
<img src="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_LARGE; ?>" width=100><br>

<?php $c[$article_data['category_id']]=" checked" ?>
カテゴリ
<input type="radio" name="category" value="1" onclick="setCategoryUrl('food')"<?php echo $c[1] ?>>Food
<input type="radio" name="category" value="2" onclick="setCategoryUrl('exercise')"<?php echo $c[2] ?>>Exercise
<input type="radio" name="category" value="3" onclick="setCategoryUrl('health')"<?php echo $c[3] ?>>Health
<input type="radio" name="category" value="4" onclick="setCategoryUrl('fashion')"<?php echo $c[4] ?>>Fashion
<input type="radio" name="category" value="5" onclick="setCategoryUrl('feature')"<?php echo $c[5] ?>>特集
<br>

URL
  <span id="category_url"><?php echo CATEGORY_URL[$article_data['category_id']] ?></span><input name="path" style="width:200px" type="text" placeholder="" value="<?php echo $article_data['path']; ?>">/
<br>

<?php $a[$article_data['author_id']]=" selected" ?>
著者
<select name="author">
  <option value="1"<?php echo $a[1] ?>>いっこだにこださんこだ</option>
  <option value="2"<?php echo $a[2] ?>>スポーツマンシップりな</option>
</select>
<br>

公開日時
<input name="release" style="width:200px" type="text" placeholder="<?php echo date('Y-m-d H:i:s') ?>" value="<?php echo $article_data['release_time']; ?>">
<br>

タイトル
<input name="title" style="width:700px" type="text" placeholder="" value="<?php echo $article_data['title']; ?>">
<br>

メタキーワード（カンマ区切りで記述してください）
<input name="keyword" style="width:700px" type="text" placeholder="ダイエット,食事,..." value="<?php echo $article_data['keyword']; ?>">
<br>

導入文<br>
<textarea name="introduction" rows="10" style="width:1000px" placeholder=""><?php echo $article_data['introduction']; ?></textarea>
<br>

本文<br>
<textarea name="body" rows="70" style="width:1000px" placeholder=""><?php echo $article_data['body']; ?></textarea>
<br>

まとめ<br>
<textarea name="summary" rows="10" style="width:1000px" placeholder=""><?php echo $article_data['summary']; ?></textarea>
<br>

<?php $s[$article_data['status']]=" selected" ?>

ステータス
<select name="status">
  <option value="1"<?php echo $s[1] ?>>公開</option>
  <option value="0"<?php echo $s[0] ?>>非公開</option>
</select>
<br>

<button type="submit" class="btn btn-lg btn-primary">保存</button>
</form>



    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="/js/write.js"></script>
</body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
