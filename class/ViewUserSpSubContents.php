<?php
/**
* ViewUserSpSubContents
* SP版サブコンテンツ
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.7
*/

Class ViewUserSpSubContents {
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
      <!-- ranking -->
      <div class="subcontents-area">
        <img src="<?php echo MAIN_URL ?>img/common/ranking-title.png" alt="人気の記事" class="subcontents-title">
<?php foreach ($ranking_data as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
          <div class="ranking-wrapper">
            <div class="ranking-img-area">
              <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>">
            </div>
            <div class="ranking-text">
              <div class="ranking-text-left">
                <div class="ranking-text-left-title"><?php echo $key+1 ?></div>
              </div>
              <div class="ranking-text-right">
                <div class="ranking-text-right-title"><?php echo $value['title'] ?></div>
              </div>
            </div>
          </div>
        </a>
<?php } ?>
      </div>
<?php if (count($ranking_data)<=5) { ?>
      <a href="<?php echo MAIN_URL ?>ranking/" class="btn-more">もっとみる</a>
<?php } ?>

      <!-- sponsored -->
      <div class="subcontents-area">
        <img src="<?php echo MAIN_URL ?>img/common/sponsored-title.png" alt="スポンサード" class="subcontents-title">
        <img src="<?php echo MAIN_URL ?>img/common/bnr_tokyoicecreamland_sp.png" class="max-width" alt="東京アイスクリームランド">
      </div>

      <!-- my favolite -->
      <div class="subcontents-area">
        <img src="<?php echo MAIN_URL ?>img/common/myfavolite-title.png" alt="おすすめ記事" class="subcontents-title">
<?php foreach ($myfavolite_data as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
          <div class="article-link">
            <div class="article-link-img">
              <img src="<?php echo MAIN_URL ?>img/common/loading-thumb.gif" data-echo="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" alt="<?php echo $value['title'] ?>">
            </div>
            <div class="article-link-text">
              <p class="article-link-title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
              <span class="article-link-text-left"></span>
              <span class="article-link-text-right"></span>
            </div>
          </div>
        </a>
<?php } ?>
      </div>

      <img src="<?php echo MAIN_URL ?>img/common/dot.png" alt="">

      <!-- go back top -->
      <div class="subcontents-area">
        <a href="#" id="page-top" class="btn btn-lg btn-block btn-default"><span class="glyphicon glyphicon-chevron-up"></span></a>
      </div>

<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
