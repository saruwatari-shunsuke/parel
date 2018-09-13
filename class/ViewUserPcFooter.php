<?php
/**
* ViewUserPcFooter
* PC版フッター
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.6
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
			global $setting_data;
?>
    <!-- header1 -->
    <nav id="header1" class="navbar navbar-default navbar-fixed-top bg_coral" role="banner">
      <div class="navbar_wrapper">
        <div class="container-fluid">
          <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <form action="<?php echo MAIN_URL ?>" controller="articles" class="form-inline" id="keyword-search-form" method="GET" accept-charset="utf-8">
                  <input name="s" class="form-control keyword-search-input" placeholder="気になるワードを入れてみましょう" type="text" value="<?php echo $_GET['s'] ?>">
                  <input class="btn btn-default btn-sm keyword-search-submit" value="検索" style="" type="submit">
                </form>
              </li>
            </ul>
            <div id="header-logo">
              <a href="<?php echo MAIN_URL ?>"><img src="<?php echo LOGO ?>" alt="パルール"></a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- header2 -->
    <nav id="header2" class="navbar-default navbar-fixed-top" role="navigation">
      <div class="navbar_wrapper">
        <ul>
          <li class="hover-light"><a href="<?php echo MAIN_URL ?>">Home</a></li>
          <li class="hover-light"><a href="<?php echo CATEGORY_URL[1] ?>">Food</a></li>
          <li class="hover-light"><a href="<?php echo CATEGORY_URL[2] ?>">Exercise</a></li>
          <li class="hover-light"><a href="<?php echo CATEGORY_URL[3] ?>">Health</a></li>
          <li class="hover-light"><a href="<?php echo CATEGORY_URL[4] ?>">Fashion</a></li>
          <li class="hover-light"><a href="<?php echo CATEGORY_URL[5] ?>">特集</a></li>
        </ul>
      </div>
    </nav>

    <!-- footer -->
    <footer id="footer" class="navbar navbar-default bg_coral" role="contentinfo">
      <div class="container">
        <div class="row">
          <div class="col-xs-3">
            <p><a href="<?php echo MAIN_URL ?>"><img class="max-width" src="<?php echo LOGO ?>" alt="パルール"></a></p>
          </div>
          <div class="col-xs-3">
            <p><a href="//twitter.com/<?php echo $setting_data['twitter'] ?>" target="_blank">Twitter</a></p>
            <p><a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a></p>
          </div>
          <div class="col-xs-3">
            <p><a href="<?php echo MAIN_URL ?>terms/">利用規約</a></p>
            <p><a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a></p>
            <p><a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a></p>
          </div>
          <div class="col-xs-3">
            <p><a href="//hito-shigoto.jp/" target="_blank">ヒトシゴト</a></p>
          </div>
        </div>
        <div class="copyright">
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
