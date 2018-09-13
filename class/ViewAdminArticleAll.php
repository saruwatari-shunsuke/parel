<?php
/**
* ViewAdminArticleAll
* 記事一覧
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.7
*/

Class ViewAdminArticleAll {
	public function __construct() {
		try {
			session_start();

			$object_car = new ControllerArticle();
			$object_car->switchStatus();
			$article_data = $object_car->showAllByAdmin();

/*
setcookie('LoginAuth', "aaaaa", time() + 60*60*24, "/", ".parel.site");
echo $_COOKIE['LoginAuth'];
*/

			self::body($article_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($article_data) {
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
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/pc/common.css?x=1">
    <link rel="stylesheet" type="text/css" href="/css/style.css?x=1">
    <link rel="shortcut icon" href="/img/adm-parel.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo ADMIN_URL ?>">
 
  </head>
  <body>
    <div class="container-fruid">
      <div class="row">

        <h1 class="col-xs-6">記事一覧</h1>
        <div class="col-xs-6">
          <div class="right">
            <a href="/edit/" class="btn btn-lg btn-success">_<span class="glyphicon glyphicon-pencil"></span> 記事を書く</a>
          </div>
        </div>

<?php if($article_data['error']) { ?>
        <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading">エラー</div>
            <div class="panel-body"><?php echo $article_data['error']; ?></div>
          </div>
        </div>
<?php } ?>

        <div class="col-md-12">
          <table class="table table-hover table-condensed article-table">
            <tbody>
<?php foreach ($article_data as $key => $value) { ?>
              <tr>
                <td class="article-release"><?php if($value['status']){ echo $value['release_time']; } ?></td>
                <td class="article-header"><img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" height="20"> <?php echo $value['title'] ?></td>
                <td class="article-keyword"><span class="glyphicon glyphicon-tags"></span> <?php echo $value['keyword']; ?></td>
                <td class="article-tool">
                  <a class="btn btn-xs btn-parel" href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'] ?>/" target="_blank"><img src="<?php echo MAIN_URL ?>img/common/logo_8.png" height=15> <span class="glyphicon glyphicon-new-window"></span></a>
                  <a class="btn btn-xs btn-success" href="/edit/?id=<?php echo $value['article_id'] ?>#noback"><span class="glyphicon glyphicon-pencil"></span> 編集</a>
<?php if($value['status']==1){ ?>
                  <a class="btn btn-xs btn-primary" href="/view/?i=<?php echo $value['article_id'] ?>&r=2"><span class="glyphicon glyphicon-eye-open"></span> 公開中</a>
<?php } else if($value['status']==2){ ?>
                  <a class="btn btn-xs btn-default" href="/view/?i=<?php echo $value['article_id'] ?>&r=1"><span class="glyphicon glyphicon-eye-close"></span> 非公開</a>
<?php } else { ?>
                  <a class="btn btn-xs btn-default" href="/view/?i=<?php echo $value['article_id'] ?>&r=1"><span class="glyphicon glyphicon-edit"></span> 下書き</a>
<?php } ?>
                </td>
              </tr>
<?php } ?>
            </tbody>
          </table>
        </div>

      </div><!-- /row -->
    </div><!-- /container-fruid -->

<?php new ViewAdminFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php ViewBootstrap::js(); ?>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/trunk8.min.js"></script>
    <script>
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
