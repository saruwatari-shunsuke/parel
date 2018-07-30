<?php
/**
* ViewAdminMenu
* 管理画面入口
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.4
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
			global $setting_data;
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE_ADMIN ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <meta name="description" content="<?php echo $setting_data['site_description'] ?>">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="<?php echo SITE_TITLE_ADMIN ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo ADMIN_URL ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo IMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo ADMIN_URL ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@<?php echo $setting_data['twitter'] ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>/css/html5reset-1.6.1.css">
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" href="/img/adm-parel.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo ADMIN_URL ?>">

     <div class="container-fruid">
      <div class="row">
        <div class="col-md-12 mb20">
          <h1>パルール 管理画面</h1>
          <h2><a href="/edit/"><span class="glyphicon glyphicon-pencil"></span> 記事を書く</a></h2>
          <h2><a href="/view/"><span class="glyphicon glyphicon-file"></span> 記事一覧</a></h2>
          <h2><a href="/author/"><span class="glyphicon glyphicon-user"></span> ライター</a></h2>
          <h2><a href="/myfavolite/"><span class="glyphicon glyphicon-star-empty"></span> おすすめ</a></h2>
          <h2><a href="<?php echo MAIN_URL ?>" target="_blank"><img src="<?php echo FAVICON ?>"> パルール</a></h2>
        </div>
      </div><!-- /row -->
    </div><!-- /container-fruid -->

<?php new ViewAdminFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php ViewBootstrap::js(); ?>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>


  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}


}
