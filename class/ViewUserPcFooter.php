<?php
/**
* ViewUserPcFooter
* PC版フッター
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
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
    <nav class="navbar navbar-default navbar-fixed-top header_bar bg_coral opacity85" role="navigation">
      <div class="nav_bar_wrapper">
        <div class="container-fluid">
          <div class="collapse navbar-collapse">
            <div class="navbar-header">
              <div class="header_logo mt10">
                <a href="<?php echo MAIN_URL ?>"><img src="<?php echo LOGO ?>"></a>
              </div>
            </div>
            <ul class="nav navbar-nav navbar-right mt-30">
              <li>
                <form action="<?php echo MAIN_URL ?>" controller="articles" class="form-inline" id="head_nav_search" method="GET" accept-charset="utf-8">
                  <input name="s" class="form-control navbar_search_form_input" placeholder="気になるワードを入れてみましょう" type="text" value="<?php echo $_GET['s'] ?>">
                  <input class="btn btn-default btn-sm navbar_search_submit" value="検索" style="" type="submit">
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- header2 -->
    <nav class="navbar-default navbar-fixed-top opacity85 category_nav" role="navigation">
      <div class="nav_bar_wrapper">
        <div class="overflow">
          <ul>
            <li class="left hover" style="width:18%;"><a href="<?php echo MAIN_URL ?>"><div class="gray666 font90">Top</div></a></li>
            <li class="left hover" style="width:18%;"><a href="<?php echo CATEGORY_URL[1] ?>"><div class="gray666 font90">Food</div></a></li>
            <li class="left hover" style="width:18%;"><a href="<?php echo CATEGORY_URL[2] ?>"><div class="gray666 font90">Exercise</div></a></li>
            <li class="left hover" style="width:18%;"><a href="<?php echo CATEGORY_URL[3] ?>"><div class="gray666 font90">Health</div></a></li>
            <li class="left hover" style="width:18%;"><a href="<?php echo CATEGORY_URL[4] ?>"><div class="gray666 font90">Fashion</div></a></li>
            <li class="left hover" style="width:10%;"><a href="<?php echo CATEGORY_URL[5] ?>"><div class="gray666 font90">特集</div></a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- footer -->
    <footer class="navbar navbar-default bg_coral" role="banner" id="footer_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-xs-3">
            <p class="footer_text"><a href="<?php echo MAIN_URL ?>"><img class="footer_logo" src="<?php echo LOGO ?>"></a></p>
          </div>
          <div class="col-xs-4">
            <p class="footer_text"><a href="//twitter.com/parel_beauty" target="_blank">Twitter</a></p>
            <p class="footer_text"><a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a></p>
          </div>
          <div class="col-xs-4">
            <p class="footer_text"><a href="<?php echo MAIN_URL ?>terms/">利用規約</a></p>
            <p class="footer_text"><a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a></p>
            <p class="footer_text"><a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a></p>
          </div>
        </div>
        <div class="row mt10">
          <div class="overflow">
            <p class="text-muted left" id="copyright"><small>このサイトに掲載された記事の無断転載を禁じます。</small></p>
            <p class="text-muted right" id="copyright"><small>PAREL(パルール) &copy; 2017. All Rights Reserved.</small></p>
          </div>
        </div>
      </div>
    </footer>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
