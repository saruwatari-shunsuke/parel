<?php
/**
* ViewAdminKeyword
* Googleキーワード検索
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
*/

Class ViewAdminKeyword {
	public function __construct() {
		try {
			session_start();

			$object_cse = new ControllerSearch();
			$search_file = $object_cse->searchAPI();

			self::body($search_file);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($search_file) {
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
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/pc/common.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" href="/img/adm-parel.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo ADMIN_URL ?>">

     <div class="container-fruid">
      <div class="row">

        <h1 class="col-md-12 mb20">Googleキーワード検索</h1>

        <form action="/keyword/" method="GET">
          <div class="col-md-12 mb20">
            <input name="q" class="form-controll" type="text" placeholder="キーワードを入力してください" value="<?php echo $_GET['q'] ?>">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> 検索</button>
          </div>
          <div class="col-md-12 mb20">
            <a class="btn btn-default btn-sm" data-toggle="collapse" href="#collapseExample"><span class="glyphicon glyphicon-plus"></span> 検索オプション</a>
            <div class="collapse" id="collapseExample">
              <div class="well">
                見出しを抽出 … 検索上位<input name="r" class="form-controll" type="number"  min="0" max="30" value="<?php echo ($_GET['r']) ? $_GET['r'] : 3; ?>">位以内 ※0にすると検索が速くなります。
              </div>
            </div>
          </div>
        </form>

<?php if($search_file){ ?>
        <div class="col-md-12 mb20">
          <?php echo $_GET['q'] ?> の検索結果
          <a href="/log/<?php echo $search_file ?>" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-download"></span> ダウンロード</a>
        </div>
<?php } ?>

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
