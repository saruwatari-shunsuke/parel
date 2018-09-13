<?php
/**
* ViewAdminFooter
* 管理画面フッター
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.7
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
    <nav id="header1" class="navbar navbar-default navbar-info navbar-fixed-top bg_cyan" role="navigation">
      <div class="navbar_wrapper">
        <div class="container-fluid">
          <div class="navbar-header">
            <ul class="nav navbar-nav navbar-left">
              <li>
                <form action="/view/" controller="articles" class="form-inline" id="keyword-search-form" method="GET" accept-charset="utf-8">
                  <input name="s" class="form-control keyword-search-input" placeholder="気になるワードを入れてみましょう" type="text" value="<?php echo $_GET['s'] ?>">
                  <input class="btn btn-default btn-sm keyword-search-submit" value="検索" style="" type="submit">
                </form>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a class="btn btn-sm" href="/view/"><span class="glyphicon glyphicon-file"></span> 記事</a></li>
              <li><a class="btn btn-sm" href="/author/"><span class="glyphicon glyphicon-user"></span> ライター</a></li>
              <li><a class="btn btn-sm" href="/myfavolite/"><span class="glyphicon glyphicon-star-empty"></span> おすすめ</a></li>
              <li><a class="btn btn-sm" href="/keyword/"><span class="glyphicon glyphicon-search"></span> Google</a></li>
            </ul>
            <div id="header-logo">
              <a href="<?php echo ADMIN_URL ?>"><img src="<?php echo LOGO ?>"></a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- footer -->
    <footer id="footer" class="navbar navbar-default bg_cyan" role="banner">
      <div class="container">
        <div class="row">
          <div class="col-xs-4">
            <p><a href="/"><img class="max-width" src="<?php echo LOGO ?>"></a></p>
          </div>
          <div class="col-xs-4">
            <p><a href="//twitter.com/<?php echo $setting_data['twitter'] ?>" target="_blank">Twitter</a></p>
            <p><a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a></p>
          </div>
          <div class="col-xs-4">
            <p><a href="<?php echo MAIN_URL ?>terms/">利用規約</a></p>
            <p><a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a></p>
            <p><a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a></p>
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
