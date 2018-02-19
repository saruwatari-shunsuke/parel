<?php
/**
* ViewUserSpSubContents
* SP版おまけ
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 0.1
*/

Class ViewUserSpSubContents {
	public function __construct() {
		try {
			$object_cvi = new ControllerView();
			$ranking_data = $object_cvi->getDailyRanking();
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
        <div class="">
          <img src="/img/common/ranking.png" alt="デイリーランキング" class="ranking_title">
<?php foreach ($ranking_data as $key => $value) { ?>
          <a href="/<?php echo $value['path'] ?>/">
            <div class="ranking_wrapper" id="hover_filter">
              <div class="ranking_img_area">
                <img src="/<?php echo $value['path'].'/'.IMAGE_MAIN_SMALL ?>">
              </div>
              <div class="ranking_text">
                <div class="ranking_text_left">
                  <img src="/img/common/ranking_<?php echo $key+1 ?>.png" alt="<?php echo $key+1 ?>位" class="max-width">
                </div>
                <div class="ranking_text_right">
                  <div class="ranking_text_right_title"><?php echo $value['title'] ?></div>
                </div>
              </div>
            </div>
          </a>
<?php } ?>
        </div>

        <p class="articles_heading">編集部おすすめ記事</p>

        <!-- my favolite -->
        <div class="boxview_wraper">
          <div class="boxview_box" id="auto_box">
<?php foreach ($myfavolite_data as $key => $value) { ?>
            <a href="/<?php echo $value['path'] ?>/">
              <div class="mobile_article_index_box2 max-width ">
                <div class="boxview_left">
                  <div class="boxview_leftimg">
                    <img src="/<?php echo $value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>" width="78" height="78">
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
          </div>
        </div>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}