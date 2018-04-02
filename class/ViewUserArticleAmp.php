<?php
/**
* ViewUserArticleAmp
* 単一記事画面AMP版
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
*/

Class ViewUserArticleAmp {
	public function __construct($article_id) {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$article_data = $object_car->show1DataAmpByUser($article_id);

			$object_cvi = new ControllerView();
			$object_cvi->add($article_id);

			self::body($article_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* 記事AMP版
	*
	* @param array
	* @access private
	* @return
	*/
	private function body($article_data) {
		try {
			global $setting_data;
?>
<!doctype html>
<html amp lang="ja">
  <head>
    <meta charset="utf-8">
    <title><?php echo $article_data['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="canonical" href="<?php echo $article_data['url'] ?>">
    <style amp-custom>
      h1 {color: red}
    </style>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
      "headline": "<?php echo $article_data['title'] ?>",
      "image": {
        "@type": "ImageObject",
        "url": "<?php echo $article_data['url'].IMAGE_MAIN_LARGE ?>",
        "height": 400,
        "width": 400
      },
      "datePublished": "<?php echo date('c', strtotime($article_data['release_time'])) ?>",
      "dateModified": "<?php echo date('c', strtotime($article_data['release_time'])) ?>",
      "mainEntityOfPage": "<?php echo $article_data['url'] ?>",
      "author": {
        "@type": "Person",
        "name": "<?php echo $article_data['author_name'] ?>"
      },
      "publisher": {
        "@type": "Organization",
        "name": "<?php echo $setting_data['site_name_short'] ?>",
        "logo": {
          "@type": "ImageObject",
          "url": "<?php echo LOGO ?>",
          "width": 600,
          "height": 60
        }
      },
      "description": "<?php echo $article_data['description'] ?>"
    }
    </script>
    <script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
  </head>
  <body>
    <h1><?php echo $article_data['title'] ?></h1>

    <?php echo $article_data['release_time'] ?><br>
    <amp-img src="../<?php echo IMAGE_MAIN_SMALL ?>" width=250 height=250></amp-img><br>

<?php echo $article_data['introduction']; ?>
<br><br>
<?php echo $article_data['body']; ?>
<br><br>
<?php echo $article_data['summary']; ?>
<br><br>

書いた人<br>
<a href="<?php echo MAIN_URL.'?a='.$article_data['author_id'] ?>"><img src="<?php echo $article_data['author_image'] ?>" width="60" height="60"> <?php echo $article_data['author_name'] ?></a><br>
<br>

関連記事<br>
<?php foreach ($article_data['related'] as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
          <img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" width="60" height="60"><br>
          <?php echo $value['title'] ?><br>
          <?php echo $value['release_time'] ?>
        </a><br>
<?php } ?>
<br>
            <a href="<?php echo MAIN_URL ?>"><img src="<?php echo LOGO ?>" width="200" height="40"></a><br>
            <a href="<?php echo MAIN_URL ?>">Top</a><br>
            <a href="<?php echo CATEGORY_URL[1] ?>">Food</a><br>
            <a href="<?php echo CATEGORY_URL[2] ?>">Exercise</a><br>
            <a href="<?php echo CATEGORY_URL[3] ?>">Health</a><br>
            <a href="<?php echo CATEGORY_URL[4] ?>">Fashion</a><br>
            <a href="<?php echo CATEGORY_URL[5] ?>">特集</a><br><br>

            <a href="//twitter.com/parel_beauty" target="_blank">Twitter</a><br>
            <a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a><br>
            <a href="<?php echo MAIN_URL ?>terms/">利用規約</a><br>
            <a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a><br>
            <a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a><br>
            <a href="//hito-shigoto.jp/" target="_blank">ヒトシゴト</a><br><br>
            このサイトに掲載された記事の無断転載を禁じます。<br>
            PAREL(パルール) &copy; 2017. All Rights Reserved.<br>
  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
