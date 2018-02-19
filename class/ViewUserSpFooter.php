<?php
/**
* ViewUserSpFooter
* SP版フッター
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 0.1
*/

Class ViewUserSpFooter {
	public function __construct() {
		try {
			self::body();
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* 表示
	*
	* @param
	* @access private
	* @return
	*/
	private function body() {
		try {
?>
    <!-- header -->
    <div class="mobile_header js-header">
      <div class="overflow">
        <div class="mobile_header_left js-menu-trigger" id="triggerMenu_open">
          <img src="/img/common/menu.png" class="mobile_header_left_img">
        </div>
        <div class="left" id="mobile_header_center">
          <h1 class="mobile_header_title"><a href="/"><img src="/img/common/logo_2.png" class="titlerogo"></a></h1>
        </div>
        <a href="#" class="header_search_btn" data-toggle="modal" data-target="#ModalSearch" id="mobile_header_right">
          <div class="mobile_header_right">
            <img src="/img/common/search.png" class="mobile_header_right_img">
          </div>
        </a>
      </div>
    </div>

    <!-- search box -->
    <div class="modal fade" id="ModalSearch" style="z-index: 9999;">
      <div class="modal-dialog">
        <div class="modal-content" id="modal_search_content">
          <div id="overflow">
            <form action="/" controller="articles" class="form-inline header_left" id="ArticleSearchForm" method="GET" accept-charset="utf-8">
              <input name="s" class="form-control header_key max-width" placeholder="検索したいキーワード" id="ArticleKeyword" type="text">
              <input class="btn btn-default max-width" id="header_search_submit" value="検索" type="submit">
            </form>
          </div>
          <div id="overflow">
            <div class="right" id="header_search_box_close">
              <p id="modal_sns_close" data-dismiss="modal" class="btn btn-default gray999">× とじる</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- footer -->
    <div class="js-footer">
      <div class="footer">
        <ul class="footer_nav_category">
          <li><a href="/">Top</a></li>
<!--          <li><a href="/ranking-sp.php">Ranking</a></li> -->
          <li><a href="/?c=4">Food</a></li>
          <li><a href="/?c=1">Excercise</a></li>
          <li><a href="/?c=2">Health</a></li>
          <li><a href="/?c=5">Fashion</a></li>
          <li><a href="/?c=3">Pick Up</a></li>
        </ul>
        <hr class="footer_bar">
        <ul class="footer_nav_link">
          <li><a href="/terms-sp.php">利用規約</a></li>
          <li><a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a></li>
          <li><a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a></li>
          <li><a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a></li>
        </ul>
        <hr class="footer_bar">
        <ul class="footer_nav_sns">
<!--          <li><a href="https://www.facebook.com/" target="_blank"><img class="fb_gray" src="/img/common/fb_mk_g.png"></a></li> -->
          <li><a href="//twitter.com/parel_beauty" target="_blank"><img class="fb_gray" src="/img/common/tw_mk_g.png"></a></li>
<!--          <li><a href="https://www.instagram.com/" target="_blank"><img class="fb_gray ml5" src="/img/common/inst_mk_g.png"></a></li> -->
        </ul>
        <p class="footer_desc">このサイトに掲載された記事の無断転載を禁じます。<br>PAREL(パルール) &copy; 2017. All Rights Reserved.</p>
      </div>
    </div>

    <!-- slide menu -->
    <div id="mobile_side_down_menu" class="is_browser js-panel" style="display: none;">
      <ul class="left_menu_ul">
        <li class="top"><a href="/" class="gray666">Top<br><span class="font60 gray333">トップ</span></a></li>
        <li class="food"><a href="/?c=1" class="gray666">Food<br><span class="font60 gray333">食事</span></a></li>
        <li class="excercise"><a href="/?c=2" class="gray666">Excercise<br><span class="font60 gray333">運動</span></a></li>
        <li class="health"><a href="/?c=3" class="gray666">Health<br><span class="font60 gray333">健康</span></a></li>
        <li class="fashion"><a href="/?c=4" class="gray666">Fashion<br><span class="font60 gray333">ファッション</span></a></li>
        <li class="pickup"><a href="/?c=5" class="gray666">Pick Up<br><span class="font60 gray333">特集</span></a></li>
<!--        <li class="ranking"><a href="/ranking-sp.php" class="gray666">Ranking<br><span class="font60 gray333">デイリーランキング</span></a></li> -->
      </ul>
    </div>
    <div id="overlay" style="display: none;"></div>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
