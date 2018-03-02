<?php
/**
* ViewUserArchives
* 旧URLで誘導
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
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
    <meta property="og:url" content="<?php echo MAIN_URL ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo IMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo MAIN_URL ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="alternate" type="application/rss+xml" title="" href="">

    <link rel="canonical" href="<?php echo MAIN_URL ?>">
    <link rel="next" href="">
 
  </head>
  <body>
    <div class="container">
      <div class="overflow">
        <div class="policy_view">
          <h1 class="page_title mb30">このページは移動しました。</h1>

          <a href="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/' ?>" class="item-related-article overflow">
            <div class="item-thumbnail"><img src="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_SMALL ?>"></div>
            <div class="item-content">
              <p class="item-title"><?php echo $article_data['title'] ?></p>
              <p class="item-description trunk3"><?php echo $article_data['description'] ?></p>
            </div>
          </a>

        </div> <!-- /policy_view -->
      </div> <!-- /overflow -->
    </div> <!-- /container -->

<?php new ViewUserPcFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-pc.js"></script>
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
    <meta property="og:url" content="<?php echo MAIN_URL ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo IMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo MAIN_URL ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-sp.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="alternate" type="application/rss+xml" title="" href="">

    <link rel="canonical" href="<?php echo MAIN_URL ?>">
    <link rel="next" href="">
 
  </head>
  <body>

    <div class="content-wrapper js-main">
      <div class="policy_view">
        <h1 class="page_title mb30">このページは移動しました。</h1>

        <a href="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/' ?>">
          <div class="mobile_article_index_box2 max-width">
            <div class="boxview_left">
              <div class="boxview_leftimg">
                <img src="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_SMALL ?>" width="78" height="78">
              </div>
            </div>
            <div class="boxview_right">
              <div class="mobile_article_index_text" id="boxview_righttext">
                <p class="boxview_title not_auto_br text-line-2"><?php echo $article_data['title'] ?></p>
                <div class="overflow">
                  <div class="left">
                    <small><span class="points_text"><?php echo $article_data['release_time'] ?></span></small>
                  </div>
                  <div class="right boxview_writeuser">
                    <ul class="list-inline boxview_info">
                      <li><span class="gray333 text-line-1 writer"><?php echo $article_data['author_name'] ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>

      <img src="<?php echo MAIN_URL ?>img/common/dot.png">
      </div> <!-- /policy_view -->
    </div><!-- /content-wrapper -->

<?php new ViewUserSpFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-sp.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/slidemenu.js"></script>

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
}
