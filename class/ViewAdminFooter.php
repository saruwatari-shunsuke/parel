<?php
/**
* ViewAdminFooter
* 管理画面フッター
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.1
*/

Class ViewAdminFooter {
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
    <nav class="navbar navbar-default navbar-fixed-top header_bar bg_cyan opacity85" role="navigation"id="header">
      <div class="nav_bar_wrapper">
        <div class="container-fluid">
          <div class="collapse navbar-collapse">
            <div class="navbar-header">
              <div class="header_logo">
                <a href="<?php echo ADMIN_URL ?>"><img src="http://parel.site/img/common/logo_9.png"></a>
              </div>
            </div>
            <ul class="nav navbar-nav navbar-left mt-45">
              <li>
                <form action="/view/" controller="articles" class="form-inline" id="head_nav_search" method="GET" accept-charset="utf-8">
                  <input name="s" class="form-control navbar_search_form_input" placeholder="気になるワードを入れてみましょう" type="text" value="<?php echo $_GET['s'] ?>">
                  <input class="btn btn-default btn-sm navbar_search_submit" value="検索" style="" type="submit">
                </form>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right mt-45">
              <li><a class="btn btn-sm" href="/view/"><span class="glyphicon glyphicon-file"></span> 記事</a></li>
              <li><a class="btn btn-sm" href="/author/"><span class="glyphicon glyphicon-user"></span> ライター</a></li>
              <li><a class="btn btn-sm" href="/myfavolite/"><span class="glyphicon glyphicon-star-empty"></span> おすすめ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- footer -->
    <footer class="navbar navbar-default bg_cyan" role="banner" id="footer_wrapper">
      <div class="container">
        <div class="row">
          <div class="col-xs-4">
            <p class="footer_text"><a href="<?php echo ADMIN_URL ?>"><img class="footer_logo" src="<?php echo LOGO ?>"></a></p>
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
