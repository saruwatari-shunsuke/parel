<?php
/**
* ViewUserSpFooter
* SP版フッター
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.3
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
    <div class="mobile_header js-header bg_coral">
      <div class="overflow">
        <div class="mobile_header_left js-menu-trigger">
          ≡
        </div>
        <div class="left mobile_header_center">
          <a href="<?php echo MAIN_URL ?>"><img src="<?php echo LOGO ?>" alt="パルール"></a>
        </div>
        <a href="#" data-toggle="modal" data-target="#ModalSearch">
          <div class="mobile_header_right">
            <span class="glyphicon glyphicon-search"></span>
          </div>
        </a>
      </div>
    </div>

    <!-- search box -->
    <div class="modal fade" id="ModalSearch">
      <div class="modal-dialog">
        <div class="modal-content" id="modal_search_content">
          <p class="modal_search_close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></p>
          <form action="<?php echo MAIN_URL ?>" controller="articles" class="form-inline header_left" id="ArticleSearchForm" method="GET" accept-charset="utf-8">
            <input name="s" class="form-control header_key max-width" placeholder="気になるワードを入れてみましょう" id="ArticleKeyword" type="text" value="<?php echo $_GET['s'] ?>">
            <input class="btn btn-default btn-block" id="header_search_submit" value="検索" type="submit">
          </form>
        </div>
      </div>
    </div>

    <!-- footer -->
    <div class="js-footer">
      <div class="footer bg_coral">
        <ul class="footer_nav_category">
          <li><a href="<?php echo MAIN_URL ?>">Top</a></li>
          <li><a href="<?php echo MAIN_URL ?>ranking/">Ranking</a></li>
          <li><a href="<?php echo CATEGORY_URL[1] ?>">Food</a></li>
          <li><a href="<?php echo CATEGORY_URL[2] ?>">Exercise</a></li>
          <li><a href="<?php echo CATEGORY_URL[3] ?>">Health</a></li>
          <li><a href="<?php echo CATEGORY_URL[4] ?>">Fashion</a></li>
          <li><a href="<?php echo CATEGORY_URL[5] ?>">Feature</a></li>
          <li><a href="//twitter.com/parel_beauty">Twitter</a></li>
        </ul>
        <hr class="footer_bar">
        <ul class="footer_nav_link">
          <li><a href="<?php echo MAIN_URL ?>terms/">利用規約</a></li>
          <li><a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a></li>
          <li><a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a></li>
          <li><a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a></li>
          <li><a href="//hito-shigoto.jp/" target="_blank">ヒトシゴト</a></li>
        </ul>
        <p class="footer_desc">このサイトに掲載された記事の無断転載を禁じます。<br>PAREL(パルール) &copy; 2017. All Rights Reserved.</p>
      </div>
    </div>

    <!-- slide menu -->
    <div id="mobile_side_down_menu" class="is_browser js-panel">
      <ul class="left_menu_ul">
        <li class="top"><a href="<?php echo MAIN_URL ?>">Top<br><span class="menu-text">トップ</span></a></li>
        <li class="food"><a href="<?php echo CATEGORY_URL[1] ?>">Food<br><span class="menu-text">食事</span></a></li>
        <li class="excercise"><a href="<?php echo CATEGORY_URL[2] ?>">Exercise<br><span class="menu-text">運動</span></a></li>
        <li class="health"><a href="<?php echo CATEGORY_URL[3] ?>">Health<br><span class="menu-text">健康</span></a></li>
        <li class="fashion"><a href="<?php echo CATEGORY_URL[4] ?>">Fashion<br><span class="menu-text">ファッション</span></a></li>
        <li class="feature"><a href="<?php echo CATEGORY_URL[5] ?>">Feature<br><span class="menu-text">特集</span></a></li>
        <li class="ranking"><a href="<?php echo MAIN_URL ?>ranking/">Ranking<br><span class="menu-text">人気の記事</span></a></li>
      </ul>
    </div>
    <div id="overlay" style="display:none;"></div>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
