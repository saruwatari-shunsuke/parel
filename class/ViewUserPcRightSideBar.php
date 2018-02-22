<?php
/**
* ViewUserPcRightSideBar
* PC版右サイドバー
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 0.1
*/

Class ViewUserPcRightSideBar {
	public function __construct($rank=5) {
		try {
			$object_cvi = new ControllerView();
			$ranking_data = $object_cvi->getDailyRanking($rank);
			$object_car = new ControllerArticle();
			$myfavolite_data = $object_car->getMyFavolite();

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
        <div class="right side_bar">
          <!-- ranking -->
          <div class="mb10">
            <img src="/img/common/ranking-title.png" alt="人気の記事" class="max-width mt10 mb10">
<?php foreach ($ranking_data as $key => $value) { ?>
            <a href="/<?php echo $value['path'] ?>/">
              <div class="ranking_wrapper" id="hover_filter">
                <div class="ranking_img_area">
                  <img src="/<?php echo $value['path'].'/'.IMAGE_MAIN_SMALL ?>">
                </div>
                <div class="ranking_text">
                  <div class="ranking_text_left">
                    <img src="/img/common/rank-<?php echo $key+1 ?>.png" alt="<?php echo $key+1 ?>位" class="max-width">
                  </div>
                  <div class="ranking_text_right">
                    <div class="ranking_text_right_title"><div class="trunk3"><?php echo $value['title'] ?></div></div>
                  </div>
                </div>
              </div>
            </a>
<?php } ?>
          </div>

          <!-- my favolite -->
          <div class="mb10">
            <img src="/img/common/myfavolite-title.png" alt="おすすめ記事" class="max-width mt10 mb10">
<?php foreach ($myfavolite_data as $key => $value) { ?>
            <a href="/<?php echo $value['path'] ?>/">
              <div class="overflow" id="auto_box">
                <div class="mobile_article_index_box2 max-width relative">
                  <div class="boxview_left">
                    <div class="boxview_leftimg">
                      <img src="/<?php echo $value['path'].'/'.IMAGE_MAIN_SMALL ?>" class="img_flame" alt="<?php echo $value['title'] ?>" width="60" height="60">
                    </div>
                  </div>
                  <div class="boxview_right">
                    <div class="mobile_article_index_text">
                      <div class="ranking_text_box not_auto_br">
                        <span class="trunk3"><?php echo $value['title'] ?></span>
                        <p class="txt-right mb0 mt-3"><small><span class="points_text"></span></small></p>
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
