<?php
/**
* ViewUserArticle
* 単一記事画面
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.8
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
    <meta name="twitter:site" content="@<?php echo $setting_data['twitter'] ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/pc/common.css?x=1">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/pc/article.css?x=1">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo $article_data['url'] ?>">
    <link rel="amphtml" href="<?php echo $article_data['url'] ?>amp/">
<?php ViewGoogletag::pcHeader(); ?>
  </head>
  <body>
    <div class="container">
      <div class="overflow">
        <div id="main-contents">
          <ol class="breadcrumb">
            <li itemscope="itemscope" itemtype="https://developers.google.com/structured-data/breadcrumbs">
              <a itemprop="url" href="<?php echo MAIN_URL ?>"><span itemprop="title"><?php echo $setting_data['site_name_short'] ?></span></a>
            </li>
            <li itemscope="itemscope" itemtype="https://developers.google.com/structured-data/breadcrumbs">
              <a itemprop="url" href="<?php echo CATEGORY_URL[$article_data['category_id']] ?>"><span itemprop="title"><?php echo $article_data['category_name']; ?></span></a>
            </li>
            <li itemscope="itemscope" itemtype="https://developers.google.com/structured-data/breadcrumbs" class="active">
              <span itemprop="title"><?php echo $article_data['title']; ?></span>
            </li>
          </ol>
          <div id="article-overview-area">
            <div class="col-md-4 col-sm-4"><img class="img-circle max-width" src="<?php echo IMAGE_MAIN_LARGE; ?>" alt=""></div>
            <div class="col-md-8 col-sm-8">
              <h1 id="article-title"><?php echo $article_data['title']; ?></h1>
              <div class="article-views"><?php echo $article_data['views'] ?> view</div>
              <div class="addthis_inline_share_toolbox center"></div>
            </div>
          </div>

          <div id="article-introduction">
<?php echo $article_data['introduction']; ?>
          </div>

          <div id="toc"><!-- 目次 --></div>

          <div id="article-body">
<?php echo $article_data['body']; ?>
          </div>

          <div id="article-summary">
            <hr>
<?php echo $article_data['summary']; ?>
          </div>

          <div>
<?php foreach ($article_data['related'] as $key => $value) { ?>
            <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>" class="related-article hover-light">
              <div class="item-thumbnail"><img src="<?php echo MAIN_URL ?>img/common/loading-thumb.gif" data-echo="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>"></div>
              <div class="item-content">
                <p class="item-title"><?php echo $value['title'] ?></p>
                <p class="item-description trunk3"><?php echo $value['description'] ?></p>
              </div>
            </a>
<?php } ?>
          </div>

          <div class="addthis_inline_share_toolbox_ribm"></div>

          <a href="<?php echo MAIN_URL.'?a='.$article_data['author_id'] ?>">
            <div class="article-writer hover-light">
              <div class="article-writer-img">
                <img src="<?php echo $article_data['author_image'] ?>" alt="<?php echo $article_data['author_name'] ?>">
              </div>
              <div class="article-writer-text">
                <p>written by</p>
                <p class="article-writer-name"><?php echo $article_data['author_name'] ?></p>
                <p><?php echo $article_data['author_profile'] ?></p>
              </div>
            </div>
          </a>

        </div> <!-- main-contents -->

<?php new ViewUserPcRightSideBar(5, $article_data); ?>

      </div> <!-- /overflow -->
    </div> <!-- /container -->

<?php new ViewUserPcFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<?php ViewBootstrap::js(); ?>
<?php if($article_data['status']){ new ViewAnalytics(); } ?>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/jquery.exflexfixed-0.3.0.js"></script><!-- sidebar move -->
    <script>
      $(function(){
        $('#sub-contents-inner').exFlexFixed({
          container : '.container',
          fixedHeader : '#header2',
        });
      });
    </script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/common.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/echo.min.js"></script><!-- image async load  -->
    <script>
      echo.init();
    </script>
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
    <meta name="twitter:site" content="@<?php echo $setting_data['twitter'] ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/sp/common.css?x=1">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/sp/article.css?x=1">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo $article_data['url'] ?>">
    <link rel="amphtml" href="<?php echo $article_data['url'] ?>amp/">
    <style type="text/css">
    <!--
    #article-head-eyecatch {
      background-image:url('./<?php echo IMAGE_MAIN_LARGE ?>');
    }
    -->
    </style>
<?php ViewGoogletag::spHeader(); ?>
  </head>
  <body>

    <div class="content-wrapper js-main">

      <div id="article-head-area1">
        <div id="article-head-eyecatch"></div>
      </div>

      <a href="<?php echo MAIN_URL.'?a='.$article_data['author_id'] ?>">
        <div id="article-head-area2">
          <img src="<?php echo $article_data['author_image'] ?>" class="img-circle article-writer-img" alt="<?php echo $article_data['author_name'] ?>"> <?php echo $article_data['author_name'] ?>
          <div class="article-views"><?php echo $article_data['views'] ?> view</div>
        </div>
      </a>

      <div id="article-head-cover">
      </div>

      <h1 id="article-title" class="not_auto_br"><?php echo $article_data['title'] ?></h1>

      <div id="article-head-share">
        <div class="addthis_inline_share_toolbox"></div>
      </div>
      <div id="article-head-release"><?php echo $article_data['release_time'] ?></div>

      <div id="article-introduction">
<?php echo $article_data['introduction']; ?>
      </div>

      <hr>

      <div id="toc"></div>

      <div id="article-body">
<?php echo $article_data['body']; ?>
      </div>

      <hr>

      <div id="article-summary">
<?php echo $article_data['summary']; ?>
      </div>

      <div id="article-share">
        <div class="addthis_inline_share_toolbox_ribm"></div>
      </div>

<?php ViewGoogletag::spBody(); ?>

      <div class="subcontents-area">
        <p id="related-articles-title">関連記事</p>
<?php foreach ($article_data['related'] as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
          <div class="article-link">
            <div class="article-link-img">
              <img src="<?php echo MAIN_URL ?>img/common/loading-thumb.gif" data-echo="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>">
            </div>
            <div class="article-link-text">
              <p class="article-link-title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
              <span class="article-link-text-left"><?php echo $value['release_time'] ?></span>
              <span class="article-link-text-right"><?php echo $value['views'] ?> view</span>
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
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/slidemenu.js" defer></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/echo.min.js"></script>
    <script>
      echo.init();
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

}
