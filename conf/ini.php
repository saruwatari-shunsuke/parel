<?php
	date_default_timezone_set('Asia/Tokyo');
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");
	define('ROOT_DIRECTORY', '/var/www/html/');

	// debug.ini参照 1:本番環境 0:開発環境
	define('PRODUCT', file_get_contents(ROOT_DIRECTORY."conf/setting/env.ini")[0]);

	//DB設定
	if(PRODUCT) {
		define('DB_HOST', '?????.????.ap-northeast-1.rds.amazonaws.com:3306');
	} else {
		define('DB_HOST', 'localhost');
	}
	define('DB_USER', 'www');
	define('DB_PASS', '6zwse384');
	define('DB_NAME', 'parel');
	
	//ディレクトリ設定
	define('SETTING_DIRECTORY', ROOT_DIRECTORY.'conf/setting/');
	define('LOG_DIRECTORY_PATH', ROOT_DIRECTORY.'logs/');


	//URL設定
	if(PRODUCT) {
		define('MAIN_URL', 'http://parel.site/');
	} else {
		define('MAIN_URL', 'http://ec2-52-199-5-120.ap-northeast-1.compute.amazonaws.com/');
	}

	define('COMPANY_URL', 'https://www.agentgate.jp/');
	define('SITE_TITLE_ADMIN', 'パルール管理画面');
	define('FAVICON', '/img/common/parel.ico');
	define('IMAGE_MAIN_LARGE', 'main.jpg');
	define('IMAGE_MAIN_SMALL', 'thumb.jpg');
	define('DEBUG_LOG_FLG', '1');//デバッグログフラグ 1:ログ出力 0:ログ未出力

	$setting_data = parse_ini_file(ROOT_DIRECTORY.'conf/setting/common.ini');

	/* Classのオートロード */
	spl_autoload_register(function($class) {
		require_once(dirname(__FILE__).'/../class/' . $class . '.php');
	});
	//サニタイズショートカット
	function h($string){
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
	/*
	*フォールバック
	*指定のページへリダイレクトする
	*error.php=なんかエラーページ
	*/
	function fallback($location='error.php'){
		header('Location: '.$location);
		exit();
	}

