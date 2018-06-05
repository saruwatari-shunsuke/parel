<?php
/**
* ViewUserPcRightSideBar
* PC版右サイドバー
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.3
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
        <div class="side_bar">
          <!-- ranking -->
          <div class="subcontents_area">
            <img src="<?php echo MAIN_URL ?>img/common/ranking-title.png" alt="人気の記事" class="subcontents_title">
<?php foreach ($ranking_data as $key => $value) { ?>
            <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
              <div class="ranking_wrapper hover-light">
                <div class="ranking_img_area">
                  <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>">
                </div>
                <div class="ranking_text">
                  <div class="ranking_text_left">
                    <img src="<?php echo MAIN_URL ?>img/common/rank-<?php echo $key+1 ?>.png" alt="<?php echo $key+1 ?>位" class="max-width">
                  </div>
                  <div class="ranking_text_right">
                    <div class="ranking_text_right_title"><div class="trunk3"><?php echo $value['title'] ?></div></div>
                  </div>
                </div>
              </div>
            </a>
<?php } ?>
          </div>

          <!-- sponsored -->
          <div class="subcontents_area">
            <img src="<?php echo MAIN_URL ?>img/common/sponsored-title.png" alt="スポンサード" class="subcontents_title">
            <a href="//tokyophotogenicteam.com/">
              <div class="overflow hover-light">
                <img src="<?php echo MAIN_URL ?>img/common/bnr_tokyoicecreamland_pc.png" alt="東京アイスクリームランド">
              </div>
            </a>
          </div>

          <!-- my favolite -->
          <div class="subcontents_area">
            <img src="<?php echo MAIN_URL ?>img/common/myfavolite-title.png" alt="おすすめ記事" class="subcontents_title">
<?php foreach ($myfavolite_data as $key => $value) { ?>
            <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
              <div class="overflow hover-light">
                <div class="mobile_article_index_box2">
                  <div class="boxview_left">
                    <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>" width="60" height="60">
                  </div>
                  <div class="boxview_right">
                    <div class="mobile_article_index_text">
                      <div class="ranking_text_box not_auto_br">
                        <span class="trunk3"><?php echo $value['title'] ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
<?php } ?>
          </div>

        </div><!-- right side_bar -->
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
