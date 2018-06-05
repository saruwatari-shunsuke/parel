<?php
/**
* ViewUserPcFooter
* PC版フッター
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.3
*/

Class ViewUserPcFooter {
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
    <!-- header1 -->
    <nav class="navbar navbar-default navbar-fixed-top header_bar bg_coral" role="navigation">
      <div class="nav_bar_wrapper">
        <div class="container-fluid">
          <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <form action="<?php echo MAIN_URL ?>" controller="articles" class="form-inline" id="head_nav_search" method="GET" accept-charset="utf-8">
                  <input name="s" class="form-control navbar_search_form_input" placeholder="気になるワードを入れてみましょう" type="text" value="<?php echo $_GET['s'] ?>">
                  <input class="btn btn-default btn-sm navbar_search_submit" value="検索" style="" type="submit">
                </form>
              </li>
            </ul>
            <div class="header_logo">
              <a href="<?php echo MAIN_URL ?>"><img src="<?php echo LOGO ?>" alt="パルール"></a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- header2 -->
    <nav class="navbar-default navbar-fixed-top category_nav" role="navigation">
      <div class="nav_bar_wrapper overflow">
        <ul>
          <li class="left hover-light" style="width:18%;"><a href="<?php echo MAIN_URL ?>">Top</a></li>
          <li class="left hover-light" style="width:18%;"><a href="<?php echo CATEGORY_URL[1] ?>">Food</a></li>
          <li class="left hover-light" style="width:18%;"><a href="<?php echo CATEGORY_URL[2] ?>">Exercise</a></li>
          <li class="left hover-light" style="width:18%;"><a href="<?php echo CATEGORY_URL[3] ?>">Health</a></li>
          <li class="left hover-light" style="width:18%;"><a href="<?php echo CATEGORY_URL[4] ?>">Fashion</a></li>
          <li class="left hover-light" style="width:10%;"><a href="<?php echo CATEGORY_URL[5] ?>">特集</a></li>
        </ul>
      </div>
    </nav>

    <!-- footer -->
    <footer class="navbar navbar-default bg_coral" role="banner" id="footer_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-xs-3">
            <p class="footer_text"><a href="<?php echo MAIN_URL ?>"><img class="footer_logo" src="<?php echo LOGO ?>" alt="パルール"></a></p>
          </div>
          <div class="col-xs-3">
            <p class="footer_text"><a href="//twitter.com/parel_beauty" target="_blank">Twitter</a></p>
            <p class="footer_text"><a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a></p>
          </div>
          <div class="col-xs-3">
            <p class="footer_text"><a href="<?php echo MAIN_URL ?>terms/">利用規約</a></p>
            <p class="footer_text"><a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a></p>
            <p class="footer_text"><a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a></p>
          </div>
          <div class="col-xs-3">
            <p class="footer_text"><a href="//hito-shigoto.jp/" target="_blank">ヒトシゴト</a></p>
          </div>
        </div>
        <div id="copyright">
          <p class="left">このサイトに掲載された記事の無断転載を禁じます。</p>
          <p class="right">PAREL(パルール) &copy; 2017. All Rights Reserved.</p>
        </div>
      </div>
    </footer>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
