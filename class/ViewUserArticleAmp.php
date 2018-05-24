<?php
/**
* ViewUserArticleAmp
* 単一記事画面（AMP版）
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.4
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="<?php echo $article_data['description'] ?>">
    <meta name="keywords" content="<?php echo $article_data['keyword'] ?>">
    <link rel="canonical" href="<?php echo $article_data['url'] ?>">
    <style amp-custom>
* {
	box-sizing: border-box;
}
html, body, div, span, p, a, h1, ul, li {
	margin: 0;
	padding: 0;
}
body {
	color: #111;
	background:#fff;
	font-size: 16px;
	font-family: Helvetica, Arial, sans-serif;
	line-height: 140%;
}
#main-image {
	width: 100%;
	height: 260px;
	overflow: hidden;
	position: relative;
}
#main-image .main-image {
	position: absolute;
	display: block;
	top: 50%;
	left: 50%;
	margin: auto;
	-webkit-transform: translate(-50%,-50%);
	-ms-transform: translate(-50%,-50%);
	transform: translate(-50%,-50%);
}
#top-author-area {
	position: absolute;
	bottom: 0;
	width: 100%;
	height: 40px;
	color: #666;
	font-size: 12px;
	display: inline-block;
	vertical-align: middle;
	background: rgba(255, 255, 255, 0.7);
}
#top-author-area img {
	margin: 5px;
	float: left;
}
.top-author-text {
	color: #666;
	margin: 12px;
}
.center{
	margin: 0 auto;
	text-align:center;
}
.left{
	float:left;
}
.right{
	float:right;
}
.overflow{
	clear:both;
	overflow:hidden;
}
.clearfix{
	clear :both;
}
.txt-right{
	text-align:right;
}
.bg_coral{
    background: #ffe0f3;
}
.not_auto_br{
	word-break: break-all;
	word-wrap: break-word;
	overflow: hidden;
}
.max-width{
	width:100%;
}
a,
a:hover{
	text-decoration:none;
}
a:hover{
	color:#666;
}
ul{
	margin:0;
	padding:0;
}
p.footer_copyright{
	background:#333;
	color:#ccc;
	padding:3px 0;
	text-align:center;
	font-size:60%;
	font-weight:normal;
	margin:0;
	border-right:1px solid #fff;
}
p.footer_copyright a{
	color: #fff;
}
/* header */
.header_left{
	margin:5px 10px ;
	padding:0;
}
.header_key{
	padding:0px 10px;
	font-size:100%;
}
.article_more {
        display: none;
}
.content-wrapper {
	padding: 10px;
}
/* default */
.mobile_header{
	filter:alpha(opacity=90);
	-moz-opacity:0.90;
	opacity:0.90;
	height:42px;
	padding:0px;
	top:0px;
	width:100%;
	position:fixed;
	z-index:9999;
	border-bottom:0.5px solid #dbd;
}
.left{
	float:left;
}
.right{
	float:right;
}
/* mb_header */
.mobile_header_left{
        float: left;
        margin: 10px;
        font-size: 24px;
        color: #d7a;
}
.mobile_header_center{
	text-align: center;
        margin: 3px;
}
.mobile_header_center img {
	height: 36px;
}
/* mb_boxview */
.boxview_left{
	float:left;
	width:78px;
}
.boxview_leftimg{
	margin:5px -5px 5px 5px;
}
.boxview_right{
	float:right;
	width:100%;
	margin-left:-78px;
	padding-top:9px;
	padding-bottom:7px;
}
.boxview_category{
	text-shadow:none;
	padding:2px 5px;
	background: #dc8791;
	color:#fff;
	border:0;
}
.boxview_title{
	margin: 0 5px 3px 0;
	color: #000;
	font-size: 13px;
}
.boxview_text_left{
    float: left;
    color:#999;
    font-size: 0.8em;
}
.boxview_text_right{
    float: right;
    color: #999;
    font-size: 0.8em;
}
.boxview_writeuser{
	margin-right:10px;
	margin-top:2px;
	font-size:12px;
}
.boxview_writeuser > .boxview_info {
	text-align: right;
}
.boxview_writeuser > .boxview_info > li {
	padding: 0;
	vertical-align: middle;
	height: 20px;
	line-height: 20px;
}
.boxview_writeuser > .boxview_info > li > small,
.boxview_writeuser > .boxview_info > li > span,
.boxview_writeuser > .boxview_info > li > i {
	line-height: 20px;
}
.boxview_writeuser .writer {
	display: inline-block;
	max-width: 120px;
	color: #666;
}
.boxview_nextbtn{
	display: block;
	border: 1px solid #ccc;
	border-radius:5px;
	background: #fff;
	font-size:100%;
	color:#666;
	width: 100%;
	height: 50px;
	text-align: center;
	padding:15px;
	margin-bottom: 20px;
}
.boxview_nextbtn a{
	color:#666;
}
.articles_heading{
	margin-left:-10px;
	margin-right:-10px;
	background:#fff;
	border-top:1px solid #eee;
	border-bottom:1px solid #eee;
	text-align:center;
	padding:5px;
	font-size:90%;
}
.points_text{
	color:#333;
	font-size:11px;
}
/* article boc view */
.box_article_head_photo{
	position:relative;
}
.box_article_head_img{
	width:100%;
	height:215px;
}
.box_carousel_title{
	font-weight:bold;
	margin:5px 10px;
	color: #fff;
	line-height:150%;
	font-size:140%;
	text-shadow: .5px .5px 2px #999, -.5px -.5px 2px #999, .5px -.5px 2px #999, -.5px .5px 2px #999;
}
/* article head */
.article_head_main_img{
	position:relative;
	margin: 30px -10px 0;
}
.article_head_share{
	width: 100%;
	height: 50px;
	text-align: center;
}
.article_head_release{
	color: #666;
	font-size: 0.7em;
	text-align: right;
	margin: 3px;
}
.article_head_text{
	bottom:0;
	padding:5px;
	width:100%;
	position:absolute;
	background:rgba(255, 255, 255, 0.7);
}
.article_head_img{
	width:100%;
	height:260px;
}
.article_head_author_img{
	margin: 0 10px;
	width: 40px;
}
/* mb_footer */
.footer{
	margin-top: 10px;
	padding: 10px 5px;
}
.footer_nav_category,
.footer_nav_link{
	overflow: hidden;
}
.footer_nav_category li,
.footer_nav_link li{
	width:50%;
	float:left;
	padding: 10px 20px;
}
.footer_nav_link li{
	padding: 5px 20px;
}
.footer_nav_category li a,
.footer_nav_link li a{
	display: block;
	color: #999;
	font-size: 13px;
}
.footer_nav_category img{
	height: 11px;
}
.footer_bar{
	border: .5px solid #666;
	margin: 15px;
	padding: 0;
}
.footer_desc{
	text-align: center;
	color: #999;
	font-size: 10px;
	margin: 10px 0;
	line-height: 160%;
}
.footer_desc a{
	color: #999;
}
.footnav_li{
	font-size:90%;
	text-align:center;
	padding:7px;
	float:left;
	width:50%;
	border-bottom:1px solid #fff;
	border-right:1px solid #fff;
	background: #333;
	color: #fff;
}
.footnav_li a{
	color: #fff;
}
.mb_footer{
	margin-top:10px;
}
/* article-> title */
.close{
	font-weight:normal;
	background:none;
	border:0px;
	box-shadow:none;
}
h1 {
	margin: 20px 0;
}
.mobile_article_index_box2{
        width: 100%;
	float:left;
	border-bottom:1px solid #eee;
	background:#fff;
}
div.mobile_article_index_text{
	background:#fff;
	padding:10px 5px;
	margin-left:95px;
}
ul,li{
	list-style:none;
}
/* article->view */
.article_bar{
	/*margin-top:-5px;*/
	margin: -5px -10px 0px;
	height:2px;
	background: #999;
}
.article_view_area{
	/*border-right:1px solid #ccc;*/
	/*border-left:1px solid #ccc;*/
	padding:0 10px;
	margin: 0 -10px 15px;
}
.article_written_user{
	padding:0 0 0 10px;
}
.article_written_box{
	border:1px solid #ddd;
	padding:5px;
	background:#fff;
}
.article_row h3{
	font-weight:bold;
        margin: 50px 0 0;
	text-align: center;
	color:#333;
	line-height:130%;
	font-size:17px;
}
.article_row h4{
	font-weight:bold;
        margin: 30px 0 0;
	text-align: center;
	color:#333;
	line-height:110%;
	font-size:15px;
}
.article_row h5{
	font-weight:bold;
        margin: 25px 0 0;
	text-align: center;
	color:#333;
	line-height:100%;
	font-size:13px;
}
.article_row h6{
	font-weight:bold;
        margin: 20px 0 0;
	text-align: center;
	color:#333;
	line-height:100%;
	font-size:11px;
}
.article_row{
	line-height:180%;
	font-size:15px;
	margin: 0 0 50px;
	padding:0 3px;
	color:#333;
	word-break: break-all;
	word-wrap:break-word;
	overflow:hidden;
}
.article_row_ex{
	margin: 0 0 30px;
	font-size:13px;
	color:#666;
	line-height:180%;
}
.article_more_read_view_desc1{
	font-size:12px;
	line-height:140%;
}
/* policy */
#page_title{
	font-size: 24px;
	margin: 30px 10px;
	color: #666;
}
/* main 1-4 */
.close{
	font-weight:normal; background:none; border:0px; box-shadow:none;
}
/** slidemenu ****************************************************************/
#container {
	z-index: 1;
	margin-top:0px;
}
#container.show {
	-webkit-transform: translate3d(240px, 0px, 1px);
	min-width: 320px;
}
.article_view_title_index_text{
	padding:0 0 0 5px;
	margin-left:68px;
}
.mobile_article_view_title,
.mobile_article_view_title a{
	font-size: 19px;
	font-weight:bold;
	line-height: 160%;
	color: #333;
}
/* item related article */
.item-related-article {
    display: block;
    border: 1px solid #bbb;
    padding: 15px;
    margin: 10px 0;
}
.item-related-article .item-thumbnail {
    float: left;
    margin-right: 20px;
    width: 73px;
    height: 73px;
}
.item-content {
    overflow: hidden;
}
.item-related-article .item-title {
    line-height: 1.4;
    color: #000;
    font-size: 14px;
    font-weight: bold;
}
.item-related-article .item-description {
    line-height: 1.4;
    color: #999;
    font-size: 10px;
    margin-bottom: 0;
}
/* side_ranking */
.subcontents_area {
    margin: 20px 0;
}
.subcontents_title {
    max-width: 90%;
    display: block;
    margin: 10px auto;
}
.ranking_wrapper{
    position: relative;
    cursor:pointer;
}
.ranking_img_area{
    width: 100%;
    height: 70px;
    margin: 0 0 10px;
    overflow: hidden;
}
.ranking_img_area img{
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: auto;
    -webkit-transform: translate(-50%,-50%);
    -ms-transform: translate(-50%,-50%);
    transform: translate(-50%,-50%);
}
.ranking_text{
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    background:rgba(0, 0, 0, 0.3);
}
.ranking_text_left {
    float: left;
    width: 80px;
    height: 100%;
    color: #fff;
    font-size: 4.0em;
    line-height: 100%;
    display:table;
}
.ranking_text_left_title{
    text-align: center;
    display:table-cell;
    vertical-align: middle;
    padding: 5px;
}
.ranking_text_right{
    float: left;
    width: calc(100% - 80px);
    height: 100%;
    color: #fff;
    line-height: 160%;
    display:table;
}
.ranking_text_right_title{
    display:table-cell;
    vertical-align: middle;
    padding: 0 10px 0 0;
}
.side_ranking_left{
    float:left;
    width:30%;
}
.side_ranking_left_image{
    width:60px;
    height:60px;
}
.side_ranking_right{
    float:left; width:65%;
}
/* Pagetitle */
.text-line-1 {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.text-line-2 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
}
/* overlay */
#overlay {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    -webkit-box-shadow: 2px 0 5px 3px rgba(0,0,0,.1);
    box-shadow: 2px 0 5px 3px rgba(0,0,0,.1);
}
.article_row img, .article_row_ex img {
  width: calc(100% - 10px);
  max-height: 500px;
  margin: 20px 5px;
  object-fit: contain;
}
.article_row table, .article_row_ex table {
  font-size: 0.8em;
  border: solid 1px #333;
  border-collapse: collapse;
}
.article_row table th, .article_row table td,
.article_row_ex table th, .article_row_ex table td {
  padding: 5px;
  border: solid 1px #333;
}
.article_row a, .article_row a:hover,
.article_row_ex a, .article_row_ex a:hover{
  text-decoration: underline;
}
video {
  width:100%;
}
.external-link {
  font-size: 0.8em;
  text-decoration: none;
  margin: 0 4px;
}
.btn-social amp-social-share {
  float: left;
  margin: 3px;
  border-radius: 8px;
}
amp-social-share[type=hatena_bookmark] {
  width: 60px;
  height: 44px;
  font-family: Verdana;
  background-color: #00A4DE;
  font-weight: 700;
  color: #fff;
  line-height: 44px;
  text-align: center;
  font-size: 28px;
}
amp-social-share[type=line] {
  width: 60px;
  height: 44px;
  background-color: #00B900;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path fill="#fff" d="M12.91 6.57c.232 0 .42.19.42.42 0 .23-.188.42-.42.42h-1.17v.75h1.17c.232 0 .42.188.42.42 0 .23-.188.42-.42.42h-1.59c-.23 0-.418-.19-.418-.42V5.4c0-.23.188-.42.42-.42h1.59c.23 0 .418.19.418.42 0 .232-.188.42-.42.42h-1.17v.75h1.17zm-2.57 2.01c0 .18-.116.34-.288.398-.043.014-.088.02-.133.02-.136 0-.26-.06-.34-.167L7.95 6.618V8.58c0 .23-.186.42-.42.42-.23 0-.417-.19-.417-.42V5.4c0-.18.115-.34.286-.397.043-.015.09-.022.133-.022.13 0 .256.068.335.17L9.5 7.37V5.4c0-.23.188-.42.42-.42.23 0 .42.19.42.42v3.18zm-3.828 0c0 .23-.188.42-.42.42-.23 0-.418-.19-.418-.42V5.4c0-.23.188-.42.42-.42.23 0 .418.19.418.42v3.18zM4.868 9h-1.59c-.23 0-.42-.19-.42-.42V5.4c0-.23.19-.42.42-.42.232 0 .42.19.42.42v2.76h1.17c.232 0 .42.188.42.42 0 .23-.188.42-.42.42M16 6.87C16 3.29 12.41.376 8 .376S0 3.29 0 6.87c0 3.208 2.846 5.896 6.69 6.405.26.056.615.172.705.394.08.2.053.514.026.72l-.11.683c-.034.203-.16.79.694.432.855-.36 4.608-2.714 6.286-4.646C15.445 9.594 16 8.302 16 6.87"/></svg>');
}
amp-sidebar {
  width: 150px;
  padding: 10px;
}
amp-sidebar li{
  margin-top: 13px;
}
amp-sidebar a{
  color: #666;
}
amp-sidebar amp-img {
  margin-bottom: -8px;
  margin-right: 7px;
}
    </style>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
      "headline": "<?php echo $article_data['title'] ?>",
      "image": {
        "@type": "ImageObject",
        "url": "<?php echo $article_data['url'].IMAGE_MAIN_LARGE ?>",
        "height": 1200,
        "width": 630
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
    <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
    <script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
  </head>
  <body>
    <div class="content-wrapper js-main">
      <div class="article_head_main_img">
        <div id="main-image">
          <amp-img class="main-image" src="../<?php echo IMAGE_MAIN_LARGE ?>" alt="<?php echo $article_data['title'] ?>" width="800" height="800"></amp-img>
          <div id="top-author-area">
            <a href="<?php echo MAIN_URL.'?a='.$article_data['author_id'] ?>">
              <amp-img src="<?php echo $article_data['author_image'] ?>" alt="<?php echo $article_data['author_name'] ?>" width="34" height="34"></amp-img> <span class="top-author-text"><?php echo $article_data['author_name'] ?></span>
            </a>
          </div>
        </div>
      </div>

      <div class="article_view_area">
        <h1 class="mobile_article_view_title not_auto_br"><?php echo $article_data['title'] ?></h1>

        <div class="article_head_share">
          <div class="btn-social">
            <amp-social-share type="facebook" data-param-app_id="140586622674265"></amp-social-share>
            <amp-social-share type="twitter"></amp-social-share>
          </div>
          <div class="btn-social">
            <amp-social-share type="line" layout="container" data-share-endpoint="http://line.me/R/msg/text/?CANONICAL_URL"></amp-social-share>
          </div>
          <div class="btn-social">
            <amp-social-share type="hatena_bookmark" layout="container" data-share-endpoint="http://b.hatena.ne.jp/entry/CANONICAL_URL">B!</amp-social-share>
          </div>
        </div>

        <div class="article_head_release">
          <?php echo $article_data['release_time'] ?>
        </div>

        <div id="article-introduction" class="article_row_ex">

<?php echo $article_data['introduction']; ?>

        </div>

        <hr>

        <div id="article-body" class="article_row">

<?php echo $article_data['body']; ?>

        </div>

        <hr>

        <div id="article-summary" class="article_row_ex">

<?php echo $article_data['summary']; ?>

        </div>

      </div><!-- /article_view_area -->

      <div>
        <p class="articles_heading">関連記事</p>
<?php foreach ($article_data['related'] as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
          <div class="mobile_article_index_box2">
            <div class="boxview_left">
              <div class="boxview_leftimg">
                <amp-img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" width="78" height="78" alt="<?php echo $value['title'] ?>"></amp-img>
              </div>
            </div>
            <div class="boxview_right">
              <div class="mobile_article_index_text">
                <p class="boxview_title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
                <span class="boxview_text_left"><?php echo $value['release_time'] ?></span>
                <span class="boxview_text_right"><?php echo $value['author_name'] ?></span>
              </div>
            </div>
          </div>
        </a>
<?php } ?>
      </div>

<?php new ViewUserAmpSubContents(); ?>

    </div><!-- /content-wrapper -->

    <!-- header -->
    <div class="mobile_header js-header bg_coral">
      <div class="overflow">
        <div class="mobile_header_left">
          <div on="tap:sidebar.toggle" role="button" tabindex="0">≡</div>
        </div>
        <div class="mobile_header_center">
          <a href="<?php echo MAIN_URL ?>"><amp-img src="<?php echo LOGO ?>" alt="パルール" width="150" height="36"></amp-img></a>
        </div>
      </div>
    </div>

    <!-- footer -->
    <div class="js-footer">
      <div class="footer bg_coral">
        <ul class="footer_nav_category">
          <li><a href="<?php echo MAIN_URL ?>">Top</a></li>
          <li><a href="<?php echo MAIN_URL ?>ranking/">Ranking</a></li>
          <li><a href="<?php echo CATEGORY_URL[1] ?>">Food</a></li>
          <li><a href="<?php echo CATEGORY_URL[2] ?>">Exercise</a></li>
          <li><a href="<?php echo CATEGORY_URL[3] ?>">Health</a></li>
          <li><a href="<?php echo CATEGORY_URL[4] ?>">Fashion</a></li>
          <li><a href="<?php echo CATEGORY_URL[5] ?>">Feature</a></li>
          <li><a href="//twitter.com/parel_beauty">Twitter</a></li>
        </ul>
        <hr class="footer_bar">

        <ul class="footer_nav_link">
          <li><a href="<?php echo MAIN_URL ?>terms/">利用規約</a></li>
          <li><a href="//www.agentgate.jp/company.html" target="_blank">運営会社</a></li>
          <li><a href="//www.agentgate.jp/privacy.html" target="_blank">プライバシーポリシー</a></li>
          <li><a href="//www.agentgate.jp/contact.html" target="_blank">お問い合わせ</a></li>
          <li><a href="//hito-shigoto.jp/" target="_blank">ヒトシゴト</a></li>
        </ul>
        <p class="footer_desc">このサイトに掲載された記事の無断転載を禁じます。<br>PAREL(パルール) &copy; 2017. All Rights Reserved.</p>
      </div>
    </div>

<amp-sidebar id="sidebar" layout="nodisplay" side="left">
  <ul>
    <li>
      <a href="<?php echo MAIN_URL ?>">
      <amp-img class="amp-sidebar-image"
        src="<?php echo MAIN_URL ?>img/common/icon-curtain.png"
        width="30"
        height="30"
        alt=""></amp-img>
        Top
    </li>
    <li>
      <a href="<?php echo CATEGORY_URL[1] ?>">
      <amp-img class="amp-sidebar-image"
        src="<?php echo MAIN_URL ?>img/common/icon-meal.png"
        width="30"
        height="30"
        alt=""></amp-img>
        Food
    </li>
    <li>
      <a href="<?php echo CATEGORY_URL[2] ?>">
      <amp-img class="amp-sidebar-image"
        src="<?php echo MAIN_URL ?>img/common/icon-fitnes.png"
        width="30"
        height="30"
        alt=""></amp-img>
        Exercise
    </li>
    <li>
      <a href="<?php echo CATEGORY_URL[3] ?>">
      <amp-img class="amp-sidebar-image"
        src="<?php echo MAIN_URL ?>img/common/icon-pill.png"
        width="30"
        height="30"
        alt=""></amp-img>
        Health
    </li>
    <li>
      <a href="<?php echo CATEGORY_URL[4] ?>">
      <amp-img class="amp-sidebar-image"
        src="<?php echo MAIN_URL ?>img/common/icon-jacket.png"
        width="30"
        height="30"
        alt=""></amp-img>
        Fashion
    </li>
    <li>
      <a href="<?php echo CATEGORY_URL[5] ?>">
      <amp-img class="amp-sidebar-image"
        src="<?php echo MAIN_URL ?>img/common/icon-present.png"
        width="30"
        height="30"
        alt=""></amp-img>
        Feature
    </li>
    <li>
      <a href="<?php echo MAIN_URL ?>ranking/">
      <amp-img class="amp-sidebar-image"
        src="<?php echo MAIN_URL ?>img/common/icon-top.png"
        width="30"
        height="30"
        alt=""></amp-img>
        Ranking
    </li>
  </ul>
</amp-sidebar>

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
}
