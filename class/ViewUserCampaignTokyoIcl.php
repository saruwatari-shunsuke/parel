<?php
/**
* ViewUserCampaignTokyoIcl
* 東京アイスクリームランドキャンペーンサイト
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
*/

Class ViewUserCampaignTokyoIcl {
	public function __construct() {
		try {
			session_start();

			if (UserAgent::getOsId()) {
				self::bodySp();
			} else {
				self::bodyPc();
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
	private function bodyPc() {
		try {
			global $setting_data;
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Coming Soon | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="description" content="Coming Soon">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="利用規約 | <?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://feature.parel.site/tokyoicl2018cp/">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="Coming Soon">
    <meta property="og:image" content="http://feature.parel.site/tokyoicl2018cp/img/ogp_img.png">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo MAIN_URL ?>terms/">
    <meta property="al:web:url" content="http://feature.parel.site/tokyoicl2018cp/">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>

    <!-- tokyoicl -->
<!--    <link rel="stylesheet" href="css/reset.css"> -->
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:600,700,800">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/campaign.css">
    <link rel="stylesheet" type="text/css" href="css/parel-base-pc.css">

    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="http://feature.parel.site/tokyoicl2018cp/">
  </head>
  <body>

  <header>
    <div class="header_inner">
      <div class="coming_soon_area">
        <h1><img src="img/logo.png" alt="TOKYO ICE CREAM LAND 2018"></h1>
        <h2>フォトジェニック<br class="sp">キャンペーン</h2>
        <p>Coming soon</p>
        <div class="space space3 animation ani_fadeinup"><button class="btn" onclick="window.open('https://twitter.com/parel_beauty')"></div>
        <p><a href="http://parel.site/"><img src="img/sponsor02.svg" alt="PAREL 美しく痩せる！ダイエット情報メディアパルール"></a></p>
      </div>
    </div>
  </header>

<?php new ViewUserPcFooter(); ?>

  <!-- tokyo icl -->
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="js/html5shiv-printshiv.min.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/selectivizr.js"></script>
  <script src="js/jquery.inview.min.js"></script>
  <script src="js/index.js"></script>

<?php ViewBootstrap::js(); ?>
<?php new ViewAnalytics(); ?>
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
	private function bodySp() {
		try {
			global $setting_data;
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Coming Soon | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="description" content="Coming Soon">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="Coming Soon | <?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://feature.parel.site/tokyoicl2018cp/">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="Coming Soon">
    <meta property="og:image" content="http://feature.parel.site/tokyoicl2018cp/img/ogp_img.png">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="http://feature.parel.site/tokyoicl2018cp/">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">

<?php ViewBootstrap::css(); ?>

    <!-- tokyoicl -->
<!--    <link rel="stylesheet" href="css/reset.css"> -->
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:600,700,800">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/campaign.css">
    <link rel="stylesheet" type="text/css" href="css/parel-base-sp.css">

    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="http://feature.parel.site/tokyoicl2018cp/">
  </head>
  <body>

  <header>
    <div class="header_inner">
      <div class="coming_soon_area">
        <h1><img src="img/logo.png" alt="TOKYO ICE CREAM LAND 2018"></h1>
        <h2>フォトジェニック<br class="sp">キャンペーン</h2>
        <p>Coming soon</p>
        <div class="space space3 animation ani_fadeinup"><button class="btn" onclick="window.open('https://twitter.com/parel_beauty')"></div>
        <p><a href="http://parel.site/"><img src="img/sponsor02.svg" alt="PAREL 美しく痩せる！ダイエット情報メディアパルール"></a></p>
      </div>
    </div>
  </header>

<?php new ViewUserSpFooter(); ?>

  <!-- tokyo icl -->
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="js/html5shiv-printshiv.min.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/selectivizr.js"></script>
  <script src="js/jquery.inview.min.js"></script>
  <script src="js/index.js"></script>

<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--><!-- for wideslider.js & slidemenu.js -->
<?php ViewBootstrap::js(); ?>
<?php new ViewAnalytics(); ?>
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
