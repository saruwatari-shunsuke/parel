<?php
/**
* ViewUserArticle
* 単一記事画面
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 0.1
*/

Class ViewUserArticle {
	public function __construct($article_id) {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$article_data = $object_car->show1DataByUser($article_id);

			$object_cvi = new ControllerView();
			$object_cvi->add($article_id);

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
    <title><?php echo $article_data['title'] ?> | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="description" content="<?php echo $article_data['description'] ?>">
    <meta name="keywords" content="<?php echo $article_data['keyword'] ?>">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="<?php echo $article_data['title'] ?> | <?php echo $setting_data['site_name_short'] ?>">
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
 
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/article.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="alternate" type="application/rss+xml" title="" href="">

    <link rel="canonical" href="<?php echo $article_data['url'] ?>">
    <link rel="next" href="">
 
  </head>
  <body>
    <div class="container">
      <div class="overflow">
        <div class="left main_bar">
          <div class="article_view">
            <div class="sitemap">
              <a href="/"><?php echo $setting_data['site_name_short'] ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="/"><?php echo $article_data['category_name']; ?></a> <i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $article_data['title']; ?>
            </div>
            <div class="article_row mt30"><!-- Start of Article head -->
              <div class="col-md-3 col-sm-3" id="center"><img id="thumb_1" class="img-circle" src="<?php echo IMAGE_MAIN_LARGE; ?>" alt=""></div>
              <div class="col-md-9 col-sm-9">
                <h1 class="article_text_title"><?php echo $article_data['title']; ?></h1>
                <div class="addthis_inline_share_toolbox"></div>
              </div>
            </div><!-- End of Article head -->

            <div class="article_row_ex">
<?php echo $article_data['introduction']; ?>
            </div>

            <hr>

            <div id="toc"><!-- 目次 --></div>

            <div class="article_row mb30">
              <div class="col-md-12 col-xs-12">
<?php echo $article_data['body']; ?>
              </div>
            </div>

            <hr>

            <div class="article_row_ex mb30">
<?php echo $article_data['summary']; ?>
            </div>

            <div>
<?php foreach ($article_data['related'] as $key => $value) { ?>
              <a href="/<?php echo $value['path'] ?>/" class="item-related-article overflow">
                <div class="item-thumbnail"><img src="/<?php echo $value['path'].'/'.IMAGE_MAIN_SMALL ?>"></div>
                <div class="item-content">
                  <p class="item-title"><?php echo $value['title'] ?></p>
                  <p class="item-description trunk3"><?php echo $value['description'] ?></p>
                </div>
              </a>
<?php } ?>
            </div>

            <div class="addthis_inline_share_toolbox_ribm"></div>

            <!-- Author-->
            <a href="/?a=<?php echo $article_data['author_id'] ?>">
              <div class="overflow article_written_box">
                <div class="article_written_box_left">
                  <img src="<?php echo $article_data['author_image'] ?>">
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

<?php new ViewUserPcRightSideBar(); ?>
            
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
    <title><?php echo $article_data['title'] ?> | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="description" content="<?php echo $article_data['description'] ?>">
    <meta name="keywords" content="<?php echo $article_data['keyword'] ?>">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="<?php echo $article_data['title'] ?> | <?php echo $setting_data['site_name_short'] ?>">
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
 
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-sp.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/article.css">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
    <link rel="alternate" type="application/rss+xml" title="" href="">

    <link rel="canonical" href="<?php echo $article_data['url'] ?>">
    <link rel="next" href="">
 
  </head>
  <body>

    <div class="content_wrapper js-main">

      <div class="mt-15 ml-10 mr-10">
        <div class="article_head_photo">
          <div id="article_head_imgliq">
            <div class="article_head_img imgLiquid_bgSize imgLiquid_ready" style="background-image: url('<?php echo IMAGE_MAIN_SMALL ?>'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
              <img src="<?php echo IMAGE_MAIN_LARGE ?>" class="max-width" style="display: none;">
            </div>
          </div>
          <div class="article_head_text">
            <div class="overflow">
<a href="/?a=<?php echo $article_data['author_id'] ?>">
              <div class="left gray gray666">
                <img src="<?php echo $article_data['author_image'] ?>" class="img-circle article_head_usericon"> <?php echo $article_data['author_name'] ?>
              </div>
</a>
            </div>
          </div>
        </div>
      </div>

      <div class="article_view_area">

        <h1 class="mobile_article_view_title not_auto_br"><?php echo $article_data['title'] ?></h1>

        <div class="article_head_sns mt10">
          <div class="max-width overflow center">
            <div class="addthis_inline_share_toolbox"></div>
            <div class="right mt3 mr5">
              <span class="gray"><small><?php echo $article_data['release_time'] ?></small></span>
            </div>
          </div>
        </div>

        <div class="article_row_ex">
<?php echo $article_data['introduction']; ?>
        </div>

        <hr>

        <div id="toc"><!-- 目次 --></div>

        <div class="article_row">
<?php echo $article_data['body']; ?>
        </div>

      </div>

      <hr>

      <div class="article_row_ex">
<?php echo $article_data['summary']; ?>
      </div>

      <div class="mb30"></div>
 
      <div class="addthis_inline_share_toolbox_ribm"></div>
    
    </div>

<script type="text/javascript">
    $("#article_head_imgliq div").each(function(i){
      $(this).imgLiquid();
    });
    $("#article_fb_imgliq div").each(function(i){
      $(this).imgLiquid();
    });
</script>


    <div class="article_view_suggest mt30">
      <p class="articles_heading">関連記事</p>

    <div class="boxview_wraper">
      <div class="boxview_box" id="auto_box">

<?php foreach ($article_data['related'] as $key => $value) { ?>
        <a href="/<?php echo $value['path'] ?>/">
          <div class="mobile_article_index_box2 max-width">
            <div class="boxview_left">
              <div class="boxview_leftimg">
                <img src="/<?php echo $value['path'].'/'.IMAGE_MAIN_SMALL ?>" width="78" height="78">
              </div>
            </div>
            <div class="boxview_right">
              <div class="mobile_article_index_text" id="boxview_righttext">
                <p class="boxview_title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
                <div class="overflow">
                  <div class="left">
                    <small><span class="points_text"><?php echo $value['release_time'] ?></span></small>
                  </div>
                  <div class="right boxview_writeuser">
                    <ul class="list-inline boxview_info">
                      <li><span class="gray333 text-line-1 writer"><?php echo $value['author_name'] ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
<?php } ?>

      </div><!-- boxview_box -->
    </div><!-- boxview_wraper -->

<?php new ViewUserSpSubContents(); ?>

<?php new ViewUserSpFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-sp.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/imgLiquid.js"></script>
    <style type="text/css">.imgLiquid img {visibility:hidden}</style>
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
