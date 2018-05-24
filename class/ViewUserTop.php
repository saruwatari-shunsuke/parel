<?php
/**
* ViewUserTop
* トップ画面
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.4
*/

Class ViewUserTop {
	public function __construct($category_id=0) {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$recommend_data = $object_car->getRecommend();
			$article_data = $object_car->showAllByUser($category_id);
//echo $_COOKIE["TestCookie"];
			if (UserAgent::getOsId()) {
				self::bodySp($article_data, $recommend_data, $category_id);
			} else {
				self::bodyPc($article_data, $recommend_data, $category_id);
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
	private function bodyPc($article_data, $recommend_data, $category_id) {
		try {
			global $setting_data;
			$sum_items = count($article_data);//全体数
			$page_items = 9;//1ページあたりの表示数
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title><?php echo $setting_data['site_name_full'] ?></title>

    <meta name="description" content="<?php echo $setting_data['site_description'] ?>">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="<?php echo $setting_data['site_name_full'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo CATEGORY_URL[$category_id] ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo OGIMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo CATEGORY_URL[$category_id] ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/simplePagination.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo CATEGORY_URL[$category_id] ?>">
  </head>
  <body>
    <div class="container">

<?php if(!$category_id && !$_GET['a'] && !$_GET['s']) { ?>
      <div class="recommend_area">
<?php foreach ($recommend_data as $key => $value) { ?>
        <div class="recommend_item hover-light">
          <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>" class="push-click" id="topbtn-left" data-article-id="#">
            <img class="carousel_item_img" src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_LARGE ?>" alt="<?php echo $value['title'] ?>">
            <div class="carousel_logo_wrapper">
              <p class="carousel_category"><img src="<?php echo MAIN_URL ?>img/common/category-<?php echo $value['category_id'] ?>.png" alt="<?php echo $value['category_name'] ?>"></p>
              <p class="carousel_text trunk2"><?php echo $value['title'] ?></p>
            </div>
          </a>
        </div>
<?php } ?>
      </div>
<?php } ?>

      <div class="overflow">
        <div class="main_bar">

<?php if($category_id || $_GET['a'] || $_GET['s']) { ?>
      <ol class="breadcrumb">
        <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb">
          <a itemprop="url" href="<?php echo MAIN_URL ?>"><span itemprop="title"><?php echo $setting_data['site_name_short'] ?></span></a>
        </li>
        <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" class="active">
          <span itemprop="title"><?php echo CATEGORY_NAME[$category_id]; ?></span>
        </li>
      </ol>
<?php } ?>

          <div id="article_area">
<?php foreach ($article_data as $key => $value) { ?>
            <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?><?php if($_GET['s']){ echo '?s='.urlencode($_GET['s']); } ?>" class="article_box_list article_box-<?php echo floor($key/$page_items) ?>">
              <div class="boxview_box hover-light">
                <div class="boxview_img_area">
                  <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>">
                </div>
                <div class="boxview_text">
                  <p class="boxview_text_title trunk2"><?php echo $value['title'] ?></p>
                  <ul class="article_list_info list-inline overflow">
                    <li class="not_auto_br left">
                      <div class="article_list_point"></div>
                    </li>
                    <li class="not_auto_br right">
                      <div class="boxview_text_author">
                        <em><?php echo $value['author_name'] ?></em>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </a>
<?php } ?>
<?php while($key++ % $page_items) { ?>
            <a class="article_box_list article_box-<?php echo floor($key/$page_items) ?> transparent">
              <div class="boxview_box">
                <div class="boxview_img_area">
                  <img src="<?php echo MAIN_URL ?>img/common/thumb-blank.png" alt="">
                </div>
              </div>
            </a>
<?php } ?>
          </div>
<?php if($sum_items>$page_items){ ?>
          <div class="pagination"></div>
<?php } ?>

        </div> <!-- /main_bar -->

<?php new ViewUserPcRightSideBar(5); ?>
            
      </div> <!-- /overflow -->
    </div> <!-- /container -->

<?php new ViewUserPcFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<?php ViewBootstrap::js(); ?>
<?php new ViewAnalytics(); ?>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-pc.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/jquery.simplePagination.js"></script>
    <script type="text/javascript">
      $(function(){
        $('.article_box-0').show();//1ページ目を表示
        $(".pagination").pagination({//ページ基本設定
          items: <?php echo $sum_items ?>,
          displayedPages: 4,
          itemsOnPage: <?php echo $page_items ?>,
          cssStyle: 'parel-theme',
          prevText: '&lsaquo;<br>前へ',
          nextText: '&rsaquo;<br>後へ',
          onPageClick: function(currentPageNumber){
            showArticle(currentPageNumber-1);// mem-(ページ数-1)を表示
          }
        })
      });
      function showArticle(num) {
        $('.article_box_list').hide();
        $('.article_box-'+num).show();
        $('.trunk2').trunk8({lines:2});
      }
    </script>
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
	private function bodySp($article_data, $recommend_data, $category_id) {
		try {
			global $setting_data;
			$sum_items = count($article_data);//全体数
			$page_items = 12;//最初の表示数
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title><?php echo $setting_data['site_name_full'] ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="description" content="<?php echo $setting_data['site_description'] ?>">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="<?php echo $setting_data['site_name_full'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo CATEGORY_URL[$category_id] ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo OGIMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo CATEGORY_URL[$category_id] ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-sp.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/wideslider.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo CATEGORY_URL[$category_id] ?>">
  </head>
  <body>

    <div class="content-wrapper js-main">

      <div class="boxview_wrapper">
<?php if(!$category_id && !$_GET['a'] && !$_GET['s']) { ?>
        <div class="boxview_wideslider">
          <div class="wideslider">
            <ul class="slides">
<?php foreach ($recommend_data as $key => $value) { ?>
              <li>
                <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
                  <div class="box_article_head_photo">
                    <img class="sp-head" src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_LARGE ?>" alt="<?php echo $value['title'] ?>">
                    <div class="box_article_head_text">
                      <p class="box_carousel_title text-line-2"><?php echo $value['title'] ?></p>
                      <span class="box_carousel_user"><?php echo $value['author_name'] ?></span>
                    </div>
                  </div>
                </a>
              </li>
<?php } ?>
            </ul>
          </div><!-- /wideslider -->
        </div><!-- /boxview -->
<?php } ?>

<?php foreach ($article_data as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?><?php if($_GET['s']){ echo '?s='.urlencode($_GET['s']); } ?>" <?php if($key>=$page_items){ echo ' class="article_more"'; } ?>>
          <div class="mobile_article_index_box2">
            <div class="boxview_left">
              <div class="boxview_leftimg"><img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" width="78" height="78" alt="<?php echo $value['title'] ?>"></div>
            </div>
            <div class="boxview_right">
              <div class="mobile_article_index_text">
                <p class="boxview_title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
                <span class="boxview_text_left"></span>
                <span class="boxview_text_right"><?php echo $value['author_name'] ?></span>
              </div>
            </div>
          </div>
        </a>
<?php } ?>

      </div><!-- /boxview_wrapper -->

<?php if($sum_items>$page_items){ ?>
      <button class="boxview_nextbtn" onclick="showArticle()">もっとみる</button>
<?php } ?>

<?php new ViewUserSpSubContents(); ?>

    </div><!-- /content-wrapper -->

<?php new ViewUserSpFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><!-- for wideslider.js & slidemenu.js -->
<?php ViewBootstrap::js(); ?>
<?php new ViewAnalytics(); ?>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-sp.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/jquery.easing.1.3.js"></script><!-- for wideslider.js -->
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/slidemenu.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/wideslider.js"></script>
    <script>
      function showArticle() {
        $('.article_more').show();
        $('#article_more').hide();
      }
    </script>
  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
}
