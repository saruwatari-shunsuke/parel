<?php
/**
* ViewUserSpFooter
* SP版フッター
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.5
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
			global $setting_data;
?>
    <!-- header -->
    <div class="mobile_header js-header bg_coral" role="banner">
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
          <form action="<?php echo MAIN_URL ?>" controller="articles" class="form-inline header_left" method="GET" accept-charset="utf-8">
            <input name="s" class="form-control header_key max-width" placeholder="気になるワードを入れてみましょう" type="text" value="<?php echo $_GET['s'] ?>">
            <input class="btn btn-default btn-block" id="header_search_submit" value="検索" type="submit">
          </form>
        </div>
      </div>
    </div>

    <!-- footer -->
    <div class="js-footer">
      <div class="footer bg_coral" role="contentinfo">
        <ul class="footer_nav_category">
          <li><a href="<?php echo MAIN_URL ?>">Home</a></li>
          <li><a href="<?php echo MAIN_URL ?>ranking/">Ranking</a></li>
          <li><a href="<?php echo CATEGORY_URL[1] ?>">Food</a></li>
          <li><a href="<?php echo CATEGORY_URL[2] ?>">Exercise</a></li>
          <li><a href="<?php echo CATEGORY_URL[3] ?>">Health</a></li>
          <li><a href="<?php echo CATEGORY_URL[4] ?>">Fashion</a></li>
          <li><a href="<?php echo CATEGORY_URL[5] ?>">Feature</a></li>
          <li><a href="//twitter.com/<?php echo $setting_data['twitter'] ?>">Twitter</a></li>
        </ul>
        <hr class="footer_bar">
        <ul class="footer_nav_link">
          <li><a href="<?php echo MAIN_URL ?>terms/">利用規約</a></li>
          <li><a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a></li>
          <li><a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a></li>
          <li><a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a></li>
          <li><a href="//hito-shigoto.jp/" target="_blank">ヒトシゴト</a></li>
        </ul>
        <p class="copyright">このサイトに掲載された記事の無断転載を禁じます。<br>PAREL(パルール) &copy; 2017. All Rights Reserved.</p>
      </div>
    </div>

    <!-- slide menu -->
    <div id="slide-menu" class="js-panel" role="navigation">
      <ul>
        <li class="center">- Menu -</li>
        <li>
          <a href="<?php echo MAIN_URL ?>">
            <div class="menu-icon icon-top"></div>
            <div class="menu-text">
              <p class="menu-text-en">Home</p>
              <p class="menu-text-jp">ホーム</p>
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo CATEGORY_URL[1] ?>">
            <div class="menu-icon icon-food"></div>
            <div class="menu-text">
              <p class="menu-text-en">Food</p>
              <p class="menu-text-jp">食事</p>
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo CATEGORY_URL[2] ?>">
            <div class="menu-icon icon-exercise"></div>
            <div class="menu-text">
              <p class="menu-text-en">Exercise</p>
              <p class="menu-text-jp">運動</p>
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo CATEGORY_URL[3] ?>">
            <div class="menu-icon icon-health"></div>
            <div class="menu-text">
              <p class="menu-text-en">Health</p>
              <p class="menu-text-jp">健康</p>
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo CATEGORY_URL[4] ?>">
            <div class="menu-icon icon-fashion"></div>
            <div class="menu-text">
              <p class="menu-text-en">Fashion</p>
              <p class="menu-text-jp">ファッション</p>
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo CATEGORY_URL[5] ?>">
            <div class="menu-icon icon-feature"></div>
            <div class="menu-text">
              <p class="menu-text-en">Feature</p>
              <p class="menu-text-jp">特集</p>
            </div>
          </a>
        </li>
        <li>
          <a href="<?php echo MAIN_URL ?>ranking/">
            <div class="menu-icon icon-ranking"></div>
            <div class="menu-text">
              <p class="menu-text-en">Ranking</p>
              <p class="menu-text-jp">人気の記事</p>
            </div>
          </a>
        </li>
      </ul>
    </div>
    <div id="overlay" style="display:none;"></div>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
