<?php
/**
* ViewUserArticle
* 単一記事画面
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.4
*/

Class ViewUserArticle {
	public function __construct($article_id) {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$article_data = $object_car->show1DataByUser($article_id);

			$object_cvi = new ControllerView();
			$object_cvi->add($article_id);
			$object_cvi->addSearchLog($article_id);

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
	* 記事PC版
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
    <title><?php echo $article_data['title'] ?></title>

    <meta name="description" content="<?php echo $article_data['description'] ?>">
    <meta name="keywords" content="<?php echo $article_data['keyword'] ?>">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="<?php echo $article_data['title'] ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo $article_data['url'] ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $article_data['description'] ?>">
    <meta property="og:image" content="<?php echo $article_data['url'].IMAGE_MAIN_LARGE ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo $article_data['url'] ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/article.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo $article_data['url'] ?>">
    <link rel="amphtml" href="<?php echo $article_data['url'] ?>amp/">
  </head>
  <body>
    <div class="container">
      <div class="overflow">
        <div class="main_bar">
          <ol class="breadcrumb">
            <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
              <a itemprop="url" href="<?php echo MAIN_URL ?>"><span itemprop="title"><?php echo $setting_data['site_name_short'] ?></span></a>
            </li>
            <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
              <a itemprop="url" href="<?php echo CATEGORY_URL[$article_data['category_id']] ?>"><span itemprop="title"><?php echo $article_data['category_name']; ?></span></a>
            </li>
            <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" class="active">
              <span itemprop="title"><?php echo $article_data['title']; ?></span>
            </li>
          </ol>
          <div class="article_view">
            <div class="article_row_head"><!-- Start of Article head -->
              <div class="col-md-4 col-sm-4"><img class="img-circle max-width" src="<?php echo IMAGE_MAIN_LARGE; ?>" alt=""></div>
              <div class="col-md-8 col-sm-8">
                <h1 id="article_title"><?php echo $article_data['title']; ?></h1>
                <div class="addthis_inline_share_toolbox center"></div>
              </div>
            </div><!-- End of Article head -->

            <div id="article-introduction" class="article_row_ex">
<?php echo $article_data['introduction']; ?>
            </div>

            <hr>

            <div id="toc"><!-- 目次 --></div>

            <div id="article-body" class="article_row">
<?php echo $article_data['body']; ?>
            </div>

            <hr>

            <div id="article-summary" class="article_row_ex">
<?php echo $article_data['summary']; ?>
            </div>

            <div>
<?php foreach ($article_data['related'] as $key => $value) { ?>
              <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>" class="item-related-article overflow hover-light">
                <div class="item-thumbnail"><img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>"></div>
                <div class="item-content">
                  <p class="item-title"><?php echo $value['title'] ?></p>
                  <p class="item-description trunk3"><?php echo $value['description'] ?></p>
                </div>
              </a>
<?php } ?>
            </div>

            <div class="addthis_inline_share_toolbox_ribm"></div>

            <!-- Author-->
            <a href="<?php echo MAIN_URL.'?a='.$article_data['author_id'] ?>" class="hover-light">
              <div class="overflow article_written_box">
                <div class="article_written_box_left">
                  <img src="<?php echo $article_data['author_image'] ?>" alt="<?php echo $article_data['author_name'] ?>">
                </div>
                <div class="article_written_box_right">
                  <p>written by</p>
                  <p class="article_written_username"><?php echo $article_data['author_name'] ?></p>
                  <p><?php echo $article_data['author_profile'] ?></p>
                </div>
              </div>
            </a>
            <!-- End of Author -->

          </div> <!-- article_view -->
        </div> <!-- left main_bar -->

<?php new ViewUserPcRightSideBar(5, $article_data); ?>
            
      </div> <!-- /overflow -->
    </div> <!-- /container -->

<?php new ViewUserPcFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<?php ViewBootstrap::js(); ?>
<?php if($article_data['status']){ new ViewAnalytics(); } ?>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-pc.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/trunk8.min.js"></script>
    <script>
      $(function(){
          $('.trunk2').trunk8({lines:2});
          $('.trunk3').trunk8({lines:3});
      });
    </script>

    <script src="<?php echo MAIN_URL ?>js/jquery.toc.js"></script>
    <script>
        $(function(){
            $("body").toc({
                startLevel: 'h3',
                listType: 'ol',
                target: 'toc'
            });
        });
    </script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a72acc8d1428d19"></script>

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* 記事SP版
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
    <title><?php echo $article_data['title'] ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="description" content="<?php echo $article_data['description'] ?>">
    <meta name="keywords" content="<?php echo $article_data['keyword'] ?>">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="<?php echo $article_data['title'] ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo $article_data['url'] ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $article_data['description'] ?>">
    <meta property="og:image" content="<?php echo $article_data['url'].IMAGE_MAIN_LARGE ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo $article_data['url'] ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-sp.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/article.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo $article_data['url'] ?>">
    <link rel="amphtml" href="<?php echo $article_data['url'] ?>amp/">
  </head>
  <body>

    <div class="content-wrapper js-main">

      <div class="article_head_main_img">
        <div class="article_head_img" style="background-image:url('<?php echo IMAGE_MAIN_LARGE ?>');"></div>
        <div class="article_head_text">
          <a class="article_head_author"  href="<?php echo MAIN_URL.'?a='.$article_data['author_id'] ?>">
            <img src="<?php echo $article_data['author_image'] ?>" class="img-circle article_head_author_img" alt="<?php echo $article_data['author_name'] ?>"> <?php echo $article_data['author_name'] ?>
          </a>
        </div>
      </div>

      <div class="article_view_area">
        <h1 class="mobile_article_view_title not_auto_br"><?php echo $article_data['title'] ?></h1>

        <div class="article_head_share">
          <div class="addthis_inline_share_toolbox"></div>
        </div>
	<div class="article_head_release"><?php echo $article_data['release_time'] ?></div>

        <div id="article-introduction" class="article_row_ex">

<?php echo $article_data['introduction']; ?>

        </div>

        <hr>

        <div id="toc"><!-- 目次 --></div>

        <div id="article-body" class="article_row">

<?php echo $article_data['body']; ?>

        </div>

        <hr>

        <div id="article-summary" class="article_row_ex">

<?php echo $article_data['summary']; ?>

        </div>

        <div class="addthis_inline_share_toolbox_ribm"></div>
      </div><!-- /article_view_area -->

      <div>
        <p class="articles_heading">関連記事</p>
<?php foreach ($article_data['related'] as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
          <div class="mobile_article_index_box2">
            <div class="boxview_left">
              <div class="boxview_leftimg">
                <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" width="70" height="70" alt="<?php echo $value['title'] ?>">
              </div>
            </div>
            <div class="boxview_right">
              <div class="mobile_article_index_text">
                <p class="boxview_title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
                <span class="boxview_text_left"><?php echo $value['release_time'] ?></span>
                <span class="boxview_text_right"><?php echo $value['author_name'] ?></span>
              </div>
            </div>
          </div>
        </a>
<?php } ?>
      </div>

<?php new ViewUserSpSubContents(5, $article_data); ?>

    </div><!-- /content-wrapper -->

<?php new ViewUserSpFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><!-- for wideslider.js & slidemenu.js -->
<?php ViewBootstrap::js(); ?>
<?php if($article_data['status']){ new ViewAnalytics(); } ?>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-sp.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/slidemenu.js"></script>

    <script src="<?php echo MAIN_URL ?>js/jquery.toc.js"></script>
    <script>
        $(function(){
            $("body").toc({
                startLevel: 'h3',
                listType: 'ol',
                target: 'toc'
            });
        });
    </script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a72acc8d1428d19"></script>

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
