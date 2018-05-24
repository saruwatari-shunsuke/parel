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
    <title>フォトジェニックリツイートキャンペーン | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="description" content="100名につき1名様にパンフォーユー500円割引クーポンがアタル!!">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="フォトジェニックリツイートキャンペーン | <?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://feature.parel.site/tokyoicl2018cp/">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="100名につき1名様にパンフォーユー500円割引クーポンがアタル!!">
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
<!--    <link rel="stylesheet" href="css/animate.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:600,700,800">
<!--    <link rel="stylesheet" href="css/fontawesome-all.css"> -->
<!--    <link rel="stylesheet" href="css/common.css"> -->
    <link rel="stylesheet" href="css/index.css">
<!--    <link rel="stylesheet" href="css/campaign.css"> -->
    <link rel="stylesheet" type="text/css" href="css/parel-base-pc.css">

    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="http://feature.parel.site/tokyoicl2018cp/">
  </head>
  <body>

<?php self::text(); ?>

<?php new ViewUserPcFooter(); ?>

  <!-- tokyo icl -->
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="js/html5shiv-printshiv.min.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/selectivizr.js"></script>
<!--  <script src="js/jquery.inview.min.js"></script>
  <script src="js/index.js"></script>
-->

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
    <title>フォトジェニックリツイートキャンペーン | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="description" content="100名につき1名様にパンフォーユー500円割引クーポンがアタル!!">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="フォトジェニックリツイートキャンペーン | <?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://feature.parel.site/tokyoicl2018cp/">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="100名につき1名様にパンフォーユー500円割引クーポンがアタル!!">
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
<!--    <link rel="stylesheet" href="css/animate.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:600,700,800">
<!--    <link rel="stylesheet" href="css/fontawesome-all.css"> -->
<!--    <link rel="stylesheet" href="css/common.css"> -->
    <link rel="stylesheet" href="css/index.css">
<!--    <link rel="stylesheet" href="css/campaign.css"> -->
    <link rel="stylesheet" type="text/css" href="css/parel-base-sp.css">

    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="http://feature.parel.site/tokyoicl2018cp/">
  </head>
  <body>

<?php self::text(); ?>

<?php new ViewUserSpFooter(); ?>

  <!-- tokyo icl -->
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
  <script src="js/html5shiv-printshiv.min.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/selectivizr.js"></script>
<!--  <script src="js/jquery.inview.min.js"></script>
  <script src="js/index.js"></script>
-->

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


	/*
	* text
	*
	* @param
	* @access private
	* @return
	*/
	private function text() {
		try {
?>
  
  <header>
    <div class="header_inner">
      <p class="period text_shadow_pink">キャンペーン期間：4月28日～5月27日</p>
      <div class="headline_decoration"><h1 class="text_shadow_pink">フォトジェニック<br>リツイートキャンペーン</h1></div>
      <div class="logo">
        <div class="logo_icl"><img src="img/logo_icl.png" alt="TOKYO ICE CREAM LAND"></div>
        <p>×</p>
        <div class="logo_parel"><img src="img/logo_parel.png" alt="PAREL 楽しく痩せる！ダイエット情報メディア"></div>
      </div>
    </div>
    <div class="badge circle">
        <p class="badge_top"><span>100</span>名につき<span>1</span>名様に</p>
        <p class="badge_middle"><span>パンフォーユー</span><br><span>500</span>円<span>割引</span>クーポン</p>
      </div>
  </header>

  <main>
    <section class="section_entry">
      <div class="section_inner">
        <div class="headline_decoration"><h1>応募方法</h1></div>
        <ol>
          <li>
            <p class="entry_step">Step<br class="sp"><span>1</span></p>
            <div class="entry_text">
              <p>@parel_beautyをフォローする</p>
              <p>まずはツイッターの<span>PAREL公式アカウント</span>をフォロー</p>
            </div>
          </li>
          <li>
            <p class="entry_step">Step<br class="sp"><span>2</span></p>
            <div class="entry_text">
              <p>対象ツイートをリツイートして完了</p>
              <p>PAREL公式ツイッターアカウントの対象ツイートをリツイートして完了</p>
            </div>
          </li>
        </ol>
        <a href="https://twitter.com/parel_beauty" class="btn btn2">今すぐフォローする</a>
        <a href="https://twitter.com/parel_beauty/status/998411573411463168" class="btn btn2">リツイート</a>
      </div>
    </section>
    <section class="section_present bg_pink">
      <div class="section_inner">
        <div class="headline_decoration"><h1>プレゼント内容</h1></div>
        <p class="present_coupon">リツイート100名様毎に1名様へ<br><span class="text_red">パンフォーユー500円割引クーポン</span>プレゼント！</p>
        <img src="img/present_coupon.jpg" alt="PAN for YOU">
        <p class="present_retweet_catch"><span class="circle">さらに!!</span><span class="text_shadow_white">リツイート数が増える度に<br class="sp">賞品も増える！</span></p>
        <ul class="present_retweet_list">
          <li class="starbacks">
            <p class="present_retweet_logo"><img src="img/logo_starbacks.png" alt="starbacks"></p>
            <p class="present_retweet_number circle">抽選で20名様</p>
            <div class="present_retweet_detail">
              <p class="present_retweet_detail_condition text_shadow_white"><span>1,000</span>リツイート達成</p>
              <p class="present_retweet_detail_item text_shadow_deeppink">スターバックス<br>コーヒーギフト</p>
            </div>
          </li>
          <li class="krispykreme">
            <p class="present_retweet_logo"><img src="img/logo_krispykreme.png" alt="krispykreme doughnuts"></p>
            <p class="present_retweet_number circle">抽選で20名様</p>
            <div class="present_retweet_detail">
              <p class="present_retweet_detail_condition text_shadow_white"><span>2,000</span>リツイート達成</p>
              <p class="present_retweet_detail_item text_shadow_deeppink">クリスピー･クリーム<br>ドーナツ詰め合わせ</p>
            </div>
          </li>
          <li class="haagen">
            <p class="present_retweet_logo"><img src="img/logo_haagen.png" alt="haagen-dazs"></p>
            <p class="present_retweet_number circle">抽選で50名様</p>
            <div class="present_retweet_detail">
              <p class="present_retweet_detail_condition text_shadow_white"><span>5,000</span>リツイート達成</p>
              <p class="present_retweet_detail_item text_shadow_deeppink">ハーゲンダッツ2個</p>
            </div>
          </li>
        </ul>
        <ul class="present_retweet_special">
          <li>
            <p class="present_retweet_special_condition text_shadow_white"><span>10,000</span>リツイート達成</p>
            <div class="present_retweet_special_detail">
              <span class="circle">抽選で<br>2名3組様</span>
              <div><img src="img/present_buffet.jpg" alt="フォトジェニックスイーツブッフェ"></div>
              <p class="text_shadow_deeppink">フォトジェニックスイーツブッフェご招待</p>
            </div>
          </li>
          <li>
            <p class="present_retweet_special_condition text_shadow_white"><span>20,000</span>リツイート達成</p>
            <div class="present_retweet_special_detail">
              <span class="circle">抽選で<br>2名1組様</span>
              <div><img src="img/present_tour.jpg" alt="フォトジェニックツアー"></div>
              <p class="text_shadow_deeppink">フォトジェニックツアーご招待</p>
            </div>
          </li>
        </ul>
      </div>
    </section>
    <section class="section_twitter">
      <div class="section_inner">
        <a href="https://twitter.com/parel_beauty" class="btn btn2">今すぐフォローする</a>
        <a href="https://twitter.com/parel_beauty/status/998411573411463168" class="btn btn2">リツイート</a>
      </div>
    </section>
    <section class="section_note bg_pink">
      <div class="section_inner">
        <div class="headline_decoration"><h1>応募にあたっての注意事項</h1></div>
        <p>PAREL×東京アイスクリームランドフォトジェニックRTキャンペーン　参加規約（必読）</p>
        <p>■本規約について</p>
        <p>・本規約はキャンペーンに関しての規約となります。</p>
        <p>■キャンペーン期間2018年4月28日(土)10:00~5月27日(日) 23:59</p>
        <p>■参加方法</p>
        <p>手順1:公式Twitterアカウント「@parel_beauty」をフォローする。</p>
        <p>手順2:キャンペーン対象ツイートをリツイートする。</p>
        <p>■景品内容上記参加方法によるキャンペーン期間中のリツイート数に応じてフォトジェニックなプレゼントを差し上げます。<br>
          [特典]<br>
          1,000RT達成特典：スターバックスコーヒーギフト 20名様<br>
          2,000RT達成特典：クリスピー・クリームドーナツ詰め合わせ 20名様<br>
          5,000RT達成特典：ハーゲンダッツ2個 50名様<br>
          10,000RT達成特典：フォトジェニックスイーツビュッフェ 2名様3組<br>
          20,000RT達成特典フォトジェニックツアー 2名様1組</p>
        <p>■特典の受け取り方法について<br>※抽選結果は5月27日以降にtwitterのDMで直接ご連絡いたしますので@parel_beautyをフォローして下さい。<br>※ご案内後、5日以上必要事項をご入力頂けない場合は当選権が失効となりますのでご注意下さい。<br>
        また、ご不在や住所不明によって賞品がお届けできない場合、ご当選を無効とさせていただきます。</p>
        <p>■注意事項</p>
        <p>・本キャンペーンは予告なく中止または変更させていただく場合がございます。</p>
        <p>・本キャンペーンの特典のデザイン・内容は変更になる場合がございます。</p>
        <p>・100RTに達しなかった場合、特典の付与はございませんので、予めご了承ください。</p>
        <p>・本キャンペーンの参加時に発生するインターネット接続料や通信料は、参加者ご本人さまのご負担となります。</p>
        <p>・不正行為があると判断した場合は、該当者の全ての参加ならびに景品受け取りの権利を無効とすることがあります。</p>
        <p>・景品獲得の権利はご本人さまのものとし、他者への譲渡、換金、賞品の変更を行うことはできません。</p>
        <p>・ご自身のTwitterアカウントをお持ちでない場合は、本キャンペーンにご参加いただけませんのであらかじめご了承ください。</p>
        <p>・応募対象Twitterアカウントのフォローを外した場合、また対象となるリツイートを削除した場合、参加が無効となりますのでご注意ください。</p>
        <p>・本キャンペーンに関するご質問、お問い合わせは、お問い合わせフォーム（https://www.agentgate.jp/contact.html）よりご連絡ください。</p>
        <p>・お問い合わせの際には必ず「PAREL×東京アイスクリームランドフォトジェニックRTキャンペーン」と本キャンペーンとわかる文言を本文中にご記載いただくようお願いいたします。</p>
      </div>
    </section>
  </main>

<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}



}
