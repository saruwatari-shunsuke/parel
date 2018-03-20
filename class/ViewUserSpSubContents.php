<?php
/**
* ViewUserSpSubContents
* SP版サブコンテンツ
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
*/

Class ViewUserSpSubContents {
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
        <!-- ranking -->
        <div class="mt10 mb10">
          <img src="<?php echo MAIN_URL ?>img/common/ranking-title.png" alt="人気の記事" class="ranking_title mt10 mb10">
<?php foreach ($ranking_data as $key => $value) { ?>
          <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
            <div class="ranking_wrapper" id="hover_filter">
              <div class="ranking_img_area">
                <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>">
              </div>
              <div class="ranking_text">
                <div class="ranking_text_left">
                  <div class="ranking_text_left_title"><?php echo $key+1 ?></div>
                </div>
                <div class="ranking_text_right">
                  <div class="ranking_text_right_title"><?php echo $value['title'] ?></div>
                </div>
              </div>
            </div>
          </a>
<?php } ?>
        </div>
<?php if (count($ranking_data)<=5) { ?>
      <div class="mt15 mb10 center max-width" id="hover_btn">
        <a href="<?php echo MAIN_URL ?>ranking/" class="boxview_nextbtn">もっとみる</a>
      </div>
<?php } ?>

      <!-- my favolite -->
      <div class="mt10 mb10">
        <img src="<?php echo MAIN_URL ?>img/common/myfavolite-title.png" alt="おすすめ記事" class="ranking_title mt10 mb10">
<?php foreach ($myfavolite_data as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
          <div class="mobile_article_index_box2 max-width">
            <div class="boxview_left">
              <div class="boxview_leftimg">
                <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>" width="78" height="78">
              </div>
            </div>
            <div class="boxview_right">
              <div class="mobile_article_index_text" id="boxview_righttext">
                <p class="boxview_title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
                <div class="overflow">
                  <div class="left">
                    <small><span class="points_text"></span></small>
                  </div>
                  <div class="right boxview_writeuser">
                    <ul class="list-inline boxview_info">
                      <li><span class="gray333 text-line-1 writer"><?php echo $value['name'] ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
<?php } ?>
      </div><!-- /boxview_wraper -->

      <img src="<?php echo MAIN_URL ?>img/common/dot.png" alt="">

<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
