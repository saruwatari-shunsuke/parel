<?php
/**
* ViewAdminMyFavolite
* おすすめ記事設定
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.3
*/

Class ViewAdminMyFavolite {
	public function __construct() {
		try {
			session_start();

			$object_car = new ControllerArticle();
			$article_data = $object_car->getMyFavoliteForAdmin();

			self::body($article_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($article_data) {
		try {
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
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>/css/html5reset-1.6.1.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="shortcut icon" href="/img/adm-parel.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo ADMIN_URL ?>">
 
  </head>
  <body>
    <div class="container-fruid">
      <div class="row">

        <h1 class="col-md-12">おすすめ記事</h1>

<?php if($setting_data['error']) { ?>
        <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading">エラー</div>
            <div class="panel-body"><?php echo $setting_data['error'] ?></div>
          </div>
        </div>
<?php } ?>

        <form action="/myfavolite/" method="POST">

          <div class="col-md-12">
            <div class="panel panel-info form-group">
              <div class="panel-heading">記事を選択してください（複数可）</div>
              <div class="panel-body">
                <button type="submit" class="col-md-12 btn btn-lg btn-success btn-block mb20"><span class="glyphicon glyphicon-ok-sign"></span> 変更を反映する</button>
                <div class="col-md-12 btn-group" data-toggle="buttons">
<?php foreach($article_data as $key => $value) { ?>
                  <label class="btn btn-sm btn-default btn-block overflow<?php if($value['myfavolite']){ echo ' active'; } ?>" style="text-align:left;">
                    <input type="checkbox" name="myfavolite[]" value="<?php echo $value['article_id'] ?>" autocomplete="off"<?php if($value['myfavolite']){ echo ' checked'; } ?>>
                      <div class="col-md-2"><?php if($value['status']){ echo $value['release_time']; } ?></div>
                      <div class="col-md-10"><img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" height="20"> <?php echo $value['title'] ?></div>
                  </label>
<?php } ?>
                </div>
              </div>
            </div>
          </div>

        </form>

        <div class="col-md-12">
          <a href="#"id="page-top" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-chevron-up"></span> ページトップに戻る</a>
        </div>

      </div><!-- /row -->
    </div><!-- /container-fruid -->

<?php new ViewAdminFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-pc.js"></script>

    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/trunk8.min.js"></script>
    <script>
      $(function() {
        $("#page-top").click(function() {
          $('html,body').animate({
            scrollTop: 0
          }, 'fast');
          return false;
        });
      });
      $(function(){
          $('.trunk2').trunk8({lines:2});
          $('.trunk3').trunk8({lines:3});
      });
    </script>

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
