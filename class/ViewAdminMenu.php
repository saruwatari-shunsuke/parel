<?php
/**
* ViewAdminMenu
* 管理画面入口（仮）
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
*/

Class ViewAdminMenu {
	public function __construct() {
		try {
			session_start();

			self::body();
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body() {
		try {
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title><?php echo SITE_TITLE_ADMIN ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
<link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>/css/common/html5reset-1.6.1.css">
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="<?php echo FAVICON ?>">
 
<h1>パルール 管理画面（仮）</h1>
<br>
<h1><a href="/write/"><i class="fa fa-edit" aria-hidden="true"></i> 投稿する</a></h1>
<h1><a href="/view/"><i class="fa fa-book" aria-hidden="true"></i> 記事一覧</a></h1>
<h1><a href="<?php echo MAIN_URL ?>" target="_blank"><img src="<?php echo FAVICON ?>"> パルール</a></h1>

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
