<?php
/**
* ViewUserTop
* トップ画面
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
*/

Class ViewUserTop {
	public function __construct($category_id=0) {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$recommend_data = $object_car->getRecommend();
			$article_data = $object_car->showAllByUser($category_id);

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
    <meta property="og:image" content="<?php echo IMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo CATEGORY_URL[$category_id] ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/simplePagination.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="alternate" type="application/rss+xml" title="" href="">

    <link rel="canonical" href="<?php echo CATEGORY_URL[$category_id] ?>">
    <link rel="next" href="">
 
  </head>
  <body>
    <div class="container">

<?php if(!$category_id && !$_GET['a'] && !$_GET['s']) { ?>
      <div class="overflow mb10">
        <div class="left carousel_bar">
<?php foreach ($recommend_data as $key => $value) { ?>
          <div class="left width33p">
            <div class="carousel_body" id="hover_filter">
              <div class="">
                <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>" class="push-click" id="topbtn-left" data-article-id="#">
                  <img class="carousel_item_img" src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_LARGE ?>">
                  <div class="carousel_logo_wrapper">
                    <p class="carousel_category"><img src="<?php echo MAIN_URL ?>img/common/category-<?php echo $value['category_id'] ?>.png"></p>
                    <p class="carousel_text trunk2"><?php echo $value['title'] ?></p>
                  </div>
                </a>
              </div>
            </div>
          </div>
<?php } ?>
        </div>
      </div>
<?php } ?>

      <div class="overflow">
        <div class="left main_bar">

          <div id="article_list" class="overflow mb20">
<?php foreach ($article_data as $key => $value) { ?>
            <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>" class="article_box_list article_box-<?php echo floor($key/$page_items) ?>">
              <div class="boxview_box" id="hover_filter">
                <div class="boxview_img_area">
                  <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>">
                </div>
                <div class="boxview_text">
                  <p class="boxview_text_title trunk2"><?php echo $value['title'] ?></p>
                  <ul class="article_list_info list-inline overflow">
                    <li class="not_auto_br left">
                      <div class="article_list_point"></div>
                    </li>
                    <li class="not_auto_br right">
                      <div class="overflow">
                        <div class="spvs_name">
                          <i class="gray999 font12"><?php echo $value['author_name'] ?></i>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </a>
<?php } ?>
          </div>

<?php if($sum_items>$page_items){ ?>
          <div id="article_list" class="pagination-holder clearfix text-center mb10">
            <div id="light-pagination" class="pagination"></div>
          </div>
<?php } ?>

<!--
          <div id="article_list">
            <div class="center">
              <ul class="pagination">
                <li class="active"><a>1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#">6</a></li>
                  <li><a href="#">7</a></li>
                  <li><a href="#">8</a></li>
                  <li><a href="#">9</a></li>
                </ul>
              </div>
            </div>
-->

          </div>

<?php new ViewUserPcRightSideBar(); ?>
            
      </div> <!-- /overflow -->
    </div> <!-- /container -->

<?php new ViewUserPcFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-pc.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/jquery.simplePagination.js"></script>
<script type="text/javascript">
  $(function(){
    $('.article_box-0').show();//1ページ目を表示
    $(".pagination").pagination({//ページ基本設定
        items: <?php echo $sum_items ?>,
        displayedPages: 2,
        itemsOnPage: <?php echo $page_items ?>,
        cssStyle: 'light-theme',
        onPageClick: function(currentPageNumber){
            showArticle(currentPageNumber-1);// mem-(ページ数-1)を表示
        }
    })
  });
function showArticle(num) {
  $('.article_box_list').hide();
  $('.article_box-'+num).show();
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
    <meta property="og:image" content="<?php echo IMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo CATEGORY_URL[$category_id] ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-sp.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/wideslider.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="alternate" type="application/rss+xml" title="" href="">

    <link rel="canonical" href="<?php echo CATEGORY_URL[$category_id] ?>">
    <link rel="next" href="">
 
  </head>
  <body>

    <div class="content_wrapper js-main">
      <div class="mt-15"></div>

      <div class="boxview_wraper">
        <div class="boxview_box" id="auto_box">

<?php if(!$category_id && !$_GET['a'] && !$_GET['s']) { ?>
          <div class="wideslider">
            <ul class="slides">
<?php foreach ($recommend_data as $key => $value) { ?>
              <li>
                <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>" class="gray gray666">
                  <div class="box_article_head_photo">
                    <div id="article_head_imgliq">
                      <img class="sp-head" src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_LARGE ?>">
                    </div>
                    <div class="box_article_head_text blackgrd">
                      <p class="box_carousel_title text-line-2"><?php echo $value['title'] ?></p>
                      <div class="row mt-5">
                        <div class="left ml25">
                          <span class="box_carousel_ja_user"><?php echo $value['author_name'] ?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
<?php } ?>
            </ul>
          </div><!-- /wideslider -->
<?php } ?>

<?php foreach ($article_data as $key => $value) { ?>
          <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
            <div class="mobile_article_index_box2 max-width border_top">
              <div class="boxview_left">
                <div class="boxview_leftimg"><img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" width="78" height="78"></div>
              </div>
              <div class="boxview_right">
                <div class="mobile_article_index_text" id="boxview_righttext">
                  <p class="boxview_title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
                  <div class="overflow">
                    <div class="left">
                      <small><span class="points_text"></span></small>
                    </div>
                    <div class="right boxview_writeuser">
                      <span class="gray999 text-line-1 writer"><?php echo $value['author_name'] ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
<?php } ?>

        </div><!-- /boxview -->
      </div><!-- /boxview_wrapper -->
<!--
      <div class="mt15 mb10 center max-width" id="hover_btn">
        <a href="#" class="boxview_nextbtn">もっとみる</a>
      </div>
-->
<?php new ViewUserSpSubContents(); ?>

    </div><!-- /content_wrapper -->

<?php new ViewUserSpFooter(); ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><!-- for wideslider.js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-sp.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/jquery.easing.1.3.js"></script><!-- for wideslider.js -->
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/slidemenu.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/wideslider.js"></script>

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
