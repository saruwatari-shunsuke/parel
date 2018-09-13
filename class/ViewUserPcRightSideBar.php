<?php
/**
* ViewUserPcRightSideBar
* PC版右サイドバー
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.7
*/

Class ViewUserPcRightSideBar {
	public function __construct($rank=5, $article_data) {
		try {
			$object_cvi = new ControllerView();
			$ranking_data = $object_cvi->getDailyRanking($rank);
			$object_car = new ControllerArticle();
			$myfavolite_data = $object_car->getMyFavolite($article_data);

			self::body($ranking_data, $myfavolite_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* 表示
	*
	* @param array, array
	* @access private
	* @return
	*/
	private function body($ranking_data, $myfavolite_data) {
		try {
?>
        <div id="sub-contents">
          <div id="sub-contents-inner">

<?php ViewGoogletag::pcBody(); ?>

            <!-- ranking -->
            <div class="subcontents-area">
              <img src="<?php echo MAIN_URL ?>img/common/ranking-title.png" alt="人気の記事" class="subcontents-title">
<?php foreach ($ranking_data as $key => $value) { ?>
              <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
                <div class="ranking-wrapper hover-light">
                  <div class="ranking-img-area">
                    <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>">
                  </div>
                  <div class="ranking-text">
                    <div class="ranking-text-left">
                      <?php echo $key+1; ?>
                    </div>
                    <div class="ranking-text-right">
                      <div class="ranking-text-right-title"><span class="trunk3"><?php echo $value['title'] ?></span></div>
                    </div>
                  </div>
                </div>
              </a>
<?php } ?>
            </div>

            <!-- sponsored -->
            <div class="subcontents-area">
              <img src="<?php echo MAIN_URL ?>img/common/sponsored-title.png" alt="スポンサード" class="subcontents-title">
              <div class="overflow">
                <img src="<?php echo MAIN_URL ?>img/common/bnr_tokyoicecreamland_pc.png" alt="東京アイスクリームランド">
              </div>
            </div>

            <!-- my favolite -->
            <div class="subcontents-area">
              <img src="<?php echo MAIN_URL ?>img/common/myfavolite-title.png" alt="おすすめ記事" class="subcontents-title">
<?php foreach ($myfavolite_data as $key => $value) { ?>
              <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
                <div class="myfavolite-article hover-light">
                  <div class="myfavolite-left">
                    <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>">
                  </div>
                  <div class="myfavolite-right">
                    <!--<span class="trunk3"><?php echo $value['title'] ?></span>-->
                    <?php echo $value['title'] ?>
                  </div>
                </div>
              </a>
<?php } ?>
            </div>

<?php /*
            <!-- keyword -->
            <div class="subcontents-area">
<!--              <img src="<?php echo MAIN_URL ?>img/common/myfavolite-title.png" alt="キーワード" class="subcontents-title">-->
              <div class="keyword-area">
<?php foreach ($keyword_data as $key => $value) { ?>
                <a href="<?php echo MAIN_URL.'?s='.$value; ?>">
                  <span class="hover-light"><?php echo $value ?></span>
                </a>
<?php } ?>
              </div>
            </div>
*/ ?>

            <!-- go back top -->
            <div class="subcontents-area">
              <a href="#" id="page-top" class="btn btn-lg btn-block btn-default"><span class="glyphicon glyphicon-chevron-up"></span></a>
            </div>

          </div><!-- sub-contents-inner -->
        </div><!-- sub-contents -->
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
