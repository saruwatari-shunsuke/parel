<?php
/**
* ViewUserArchives
* 旧URLで誘導
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.5
*/

Class ViewUserArchives {
	public function __construct($article_id) {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$article_data = $object_car->show1DataByUser($article_id);

			if (UserAgent::getOsId()) {
				self::bodySp($article_data);
			} else {
				self::bodyPc($article_data);
			}
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* PC版
	*
	* @param array
	* @access private
	* @return
	*/
	private function bodyPc($article_data) {
		try {
			global $setting_data;
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>このページは移動しました | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="description" content="<?php echo $setting_data['site_description'] ?>">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="このページは移動しました | <?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo MAIN_URL.'archives/'.$article_data['path'].'/' ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo OGIMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo MAIN_URL.'archives/'.$article_data['path'].'/' ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@<?php echo $setting_data['twitter'] ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/pc/common.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/pc/article.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo MAIN_URL.'archives/'.$article_data['path'].'/' ?>">
  </head>
  <body>
    <div class="container">
      <div class="overflow">
        <div id="information-form">
          <h1>このページは移動しました。</h1>
          <a href="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/' ?>" class="related-article">
            <div class="item-thumbnail"><img src="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_SMALL ?>"></div>
            <div class="item-content">
              <p class="item-title"><?php echo $article_data['title'] ?></p>
              <p class="item-description trunk3"><?php echo $article_data['description'] ?></p>
            </div>
          </a>
        </div> <!-- /information-form -->
      </div> <!-- /overflow -->
    </div> <!-- /container -->

<?php new ViewUserPcFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<?php ViewBootstrap::js(); ?>
<?php new ViewAnalytics(); ?>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/common.js"></script>
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

	/*
	* SP版
	*
	* @param array
	* @access private
	* @return
	*/
	private function bodySp($article_data) {
		try {
			global $setting_data;
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>このページは移動しました | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="description" content="<?php echo $setting_data['site_description'] ?>">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="このページは移動しました | <?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo MAIN_URL.'archives/'.$article_data['path'].'/' ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo OGIMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo MAIN_URL.'archives/'.$article_data['path'].'/' ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@<?php echo $setting_data['twitter'] ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/sp/common.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo MAIN_URL.'archives/'.$article_data['path'].'/' ?>">
  </head>
  <body>

    <div class="content-wrapper js-main">
      <div id="information-form">
        <h1>このページは移動しました。</h1>

        <a href="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/' ?>">
          <div class="article-link">
            <div class="article-link-img">
              <img src="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_SMALL ?>">
            </div>
            <div class="article-link-text">
              <p class="article-link-title not_auto_br text-line-2"><?php echo $article_data['title'] ?></p>
              <span class="article-link-text-left"><?php echo $article_data['release_time'] ?></span>
              <span class="article-link-text-right"><?php echo $article_data['author_name'] ?></span>
            </div>
          </div>
        </a>

      <img src="<?php echo MAIN_URL ?>img/common/dot.png">
      </div> <!-- /information-form -->
    </div><!-- /content-wrapper -->

<?php new ViewUserSpFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><!-- for wideslider.js & slidemenu.js -->
<?php ViewBootstrap::js(); ?>
<?php new ViewAnalytics(); ?>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/slidemenu.js" defer></script>

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
}
