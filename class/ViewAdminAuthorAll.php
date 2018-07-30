<?php
/**
* ViewAdminAuthorAll
* 著者一覧
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.2
*/

Class ViewAdminAuthorAll {
	public function __construct() {
		try {
			session_start();

			$object_cau = new ControllerAuthor();
			//$object_cau->switchStatus();
			$author_data = $object_cau->showAllByAdmin();

			self::body($author_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($author_data) {
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
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/simplePagination.css">
    <link rel="shortcut icon" href="/img/adm-parel.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo ADMIN_URL ?>">
 
  </head>
  <body>
    <div class="container-fruid">
      <div class="row">

        <h1 class="col-md-3">著者一覧</h1>
<a href="/author/edit/" class="col-md-2 col-md-offset-6 btn btn-lg btn-warning"><span class="glyphicon glyphicon-plus"></span> 追加</a>

<?php if($author_data['error']) { ?>
        <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading">エラー</div>
            <div class="panel-body"><?php echo $author_data['error']; ?></div>
          </div>
        </div>
<?php } ?>

        <div class="col-md-12">
<?php foreach ($author_data as $key => $value) { ?>
        <p class="mb20"><a class="btn btn-lg btn-default" href="/author/edit/?id=<?php echo $value['author_id'] ?>#noback">
          <img src="<?php echo MAIN_URL.'img/author/'.$value['author_id'] ?>.jpg" height="40">
          <?php echo $value['name'] ?>
        </a><p>
<?php } ?>
        </div>
            </tbody>
          </table>
        </div>
      </div><!-- /row -->
    </div><!-- /container-fruid -->

<?php new ViewAdminFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
