<?php
/**
* ViewUserTerms
* 利用規約画面
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.5
*/

Class ViewUserTerms {
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
    <title>利用規約 | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="description" content="<?php echo $setting_data['site_description'] ?>">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="利用規約 | <?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo MAIN_URL ?>terms/">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo OGIMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo MAIN_URL ?>terms/">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@<?php echo $setting_data['twitter'] ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/pc/common.css?x=1">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo MAIN_URL ?>terms/">
  </head>
  <body>
    <div class="container">
      <div class="overflow">

        <ol class="breadcrumb">
          <li itemscope="itemscope" itemtype="https://developers.google.com/structured-data/breadcrumbs">
            <a itemprop="url" href="<?php echo MAIN_URL ?>"><span itemprop="title"><?php echo $setting_data['site_name_short'] ?></span></a>
          </li>
          <li itemscope="itemscope" itemtype="https://developers.google.com/structured-data/breadcrumbs" class="active">
            <span itemprop="title">利用規約</span>
          </li>
        </ol>

        <div id="information-form">
<?php self::text(); ?>
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
	private function bodySp() {
		try {
			global $setting_data;
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>利用規約 | <?php echo $setting_data['site_name_short'] ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="description" content="<?php echo $setting_data['site_description'] ?>">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="利用規約 | <?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo MAIN_URL ?>terms/">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo OGIMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo MAIN_URL ?>terms/">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@<?php echo $setting_data['twitter'] ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/sp/common.css?x=1">
    <link rel="shortcut icon" href="<?php echo FAVICON ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo MAIN_URL ?>terms/">
  </head>
  <body>

    <div class="content-wrapper js-main">
      <div id="information-form">
<?php self::text(); ?>
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
<h1>利用規約</h1>
<p>この規約（以下「本規約」といいます。）は、パルール運営事務局（以下「当社」といいます。）がパルールのサービス名で提供するすべてのウェブサイト、ソフトウェア、アプリケーション、プロダクト、ドキュメントその他一切の製品およびサービス（以下「本サービス」といいます。）の利用に関する条件を、本サービスを利用するすべてのお客様（以下「ユーザー」といいます。）と当社との間で定めるものです。</p>
<h2>第１条（利用規約の適用）</h2>
<p>ユーザーは、本規約の定めに従って本サービスを利用するものとします。ユーザーは、本サービスの利用に当たり、本規約に同意したものとみなされます。</p>
<p>ユーザーは、本規約の定めに従って本サービスを利用しなければなりません。ユーザーは、本規約に有効かつ取消不能な同意をしないかぎり本サービスを利用できません。同意頂けない場合、ユーザーは本サービスを利用することは出来ません。その場合は直ちに本サービスの利用を中止して下さい。</p>
<p>ユーザーは、本サービスを実際に利用することによって本規約に有効かつ取消不能な同意をしたものとみなされます。</p>
<h2>第２条（利用規約の変更）</h2>
<p>当社は、本規約を変更することがあります。変更後の利用規約は、本サービスに掲示された時点で効力を生じるものとします。変更後の規約に同意いただけない場合は、直ちに本サービスの利用を中止してください。本規約の変更後に本サービスを利用した場合は、変更後の本規約に有効かつ取消不能な同意したものとみなされます。変更の内容を利用者の皆様に個別に通知することは致しかねますので、本サービスをご利用の際には、随時、最新の本規約をご参照下さい。</p>
<h2>第３条（本サービス内容の変更及び、停止、中止）</h2>
<p>１．当社は、メンテナンスやサービス向上等のために、ユーザーに通知することなく、本サービスの全部または一部の内容を変更し、また、その提供を中止することができるものとします。</p>
<p>２．当社は以下のいずれかに該当する場合には、ユーザーに事前に通知することなく、本サービスの全部または一部の提供を停止または中断することができるものとします。また、当社は下記の事由により本サービスの提供の遅延または中断が発生した場合は、これに起因するユーザーまたは第三者が被った損害について一切の責任を負いません。</p>
<p>（１）本サービスに係るコンピューター・システム（通信回線や電源、それらを収容する建築物等を含む）の保守、点検、修理を定期的にまたは緊急に行う場合</p>
<p>（２）コンピューター・システム（通信回線や電源、それらを収容する建築物等を含む）が事故により停止した場合</p>
<p>（３）地震、落雷、火災、停電などの不可抗力により本サービスが運営できなくなった場合</p>
<p>（４）法令による規制、司法命令等が適用された場合</p>
<p>（５）その他、運用上等当社が停止または一時的な中断を判断した場合</p>
<p>３．当社は業務上の都合により、ユーザーに対して提供している本サービスの全部または一部を廃止する場合があります。当社は本サービスの廃止によりユーザーに生じた損害について、一切の責任を負いません。</p>
<h2>第４条（禁止事項）</h2>
<p>ユーザーは、本サービスの利用にあたり、以下に記述することを行ってはならず、また、以下の記載事項を行わないことを保証します。</p>
<p>（１） 法令、公序良俗に反する行為、またはそのおそれのある行為</p>
<p>（２） 犯罪行為、不法行為、またはそのおそれのある行為</p>
<p>（３） 当社、他のユーザーまたはその他の第三者に不利益を与える行為、またはそのおそれのある行為</p>
<p>（４） 当社または第三者の権利（著作権、商標権、特許権等の知的財産権、プライバシー権、その他の法令上または契約上の権利を広く含みます。）</p>
<p>（５） 当社サービスに関連して、反社会的勢力に直接的または間接的に利益を提供する行為</p>
<p>（６） 当社または他のユーザーの使用するサーバー、ソフトウェアまたはネットワークの機能を破壊したり、妨害したりする行為</p>
<p>（７） 当社のサービス、当社の配信する広告、または当社のサイト上で提供されているサービス、広告を妨害する行為</p>
<p>（８） 許諾なく他のお客様の個人情報や履歴情報などを収集、開示または提供する行為</p>
<p>（９） その他、当社が不適当と判断する行為</p>
<h2>第５条（損害賠償等）</h2>
<p>当社は、ユーザーに対し自身の判断と責任において、以下の項目を承諾した上で利用するものとし、ユーザーに生じた一切の損失または損害についても、当社は一切の責任を負わないものとし、当該損害の賠償をする義務もないものとします。</p>
<p>（１） 当社は本サービスにおける動作保証、使用目的、使用機器への適合性について一切保証しないものとし、サービスの変更、改変等を行う義務を負わないものとします。</p>
<p>（２） 当社は本サービスの利用により取得できた情報またはサービスの内容に関する正確性、妥協性、有用性およびその他一切の事項について保証しないものとします。</p>
<p>（３） 当社はアクセス過多やその他の一切の事項について保証しないものとします。</p>
<p>（４） ユーザーが本サービスを利用することにより、他社に迷惑または損害を与えた場合は当事者間の責任において解決するものとし、当社は一切義務を負わないものとします。</p>
<h2>第６条（広告掲載について）</h2>
<p>当社は、提供するサービスやソフトウェアに当社または当社に掲載依頼をした第三者広告を掲載することができるものとします。</p>
<h2>第７条（準拠法）</h2>
<p>本規約の成立、効力、履行および解決に関する準拠法は日本法が適用されるものとします。</p>
<h2>第８条（管轄裁判所）</h2>
<p>本規約またはサービスに関する一切の紛争関し訴訟を提訴する場合には、東京地方裁判所を第一審の専属の管轄裁判所とします。</p>
<h2>第９条（リンク先の商品について）</h2>
<p>当サイトではアフィリエイトプログラムを利用しています。</p>
<p>リンク先の商品・サービスは当サイトが販売しているのではなく、各リンク先サイトでのサービス・販売となります。購入方法、その他お問い合わせは各サイトにてご確認ください。商品購入・サービスなどに関するトラブルに関しては、当サイトでは一切の責任を負いかねますのでご了承ください。</p>
<p>また、当サイトをご利用になったことにより生じるいかなる損失・損害についても当方では責任を負うものではありませんのでご了承くださいませ。</p>
<p>　</p>
<p>2017年12月15日制定</p>
<p>2018年7月11日改定</p>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
