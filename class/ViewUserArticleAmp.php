<?php
/**
* ViewUserArticleAmp
* 単一記事画面（AMP版）
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.1
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
      .bg_coral{
         background: #ffe0f3;
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
.ovewflow{
	overflow: hidden;
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
.block{
	display:block;
}
.relative{
	position:relative;
}
.ad_wrapper{
	margin: 0 -10px 5px;
	text-align: center;
}
.pt5{
	padding-top: 5px;
}
.pd10{
    padding: 10px;
}
.mt0{
	margin-top: 0;
}
.mt3{
	margin-top:3px;
}
.mt-3{
	margin-top:-3px;
}
.mt-5{
	margin-top:-5px;
}
.mt-10{
	margin-top:-10px;
}
.mt-15{
	margin-top:-16px;
}
.mt-20{
	margin-top:-20px;
}
.mt-25{
	margin-top:-25px;
}
.mt-30{
	margin-top:-30px;
}
.mt5{
	margin-top:5px;
}
.mt10{
	margin-top:10px;
}
.mt15{
	margin-top:15px;
}
.mt20{
	margin-top:20px;
}
.mt25{
	margin-top:25px;
}
.mt30{
	margin-top:30px;
}
.mt35{
	margin-top:35px;
}
.mt40{
	margin-top:40px;
}
.height15{
	height:15px;
}
.height30{
	height:30px;
}
.height50{
	height:50px;
}
.width80p{
	width:80%;
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
.max-height{
	height:100%;
}
.bold{
	font-weight:bold;
}
.relative{
	position:relative;
}
.pt10{
	padding-top: 10px;
}
.pb5{
	padding-bottom: 5px;
}
.pb10{
	padding-bottom: 10px;
}
.pt15{
	padding-top: 15px;
}
.pb15{
	padding-bottom: 15px;
}
.mb0{
	margin-bottom:0px;
}
.mb-5{
	margin-bottom:-5px;
}
.mb5{
	margin-bottom:5px;
}
.mb10{
	margin-bottom:10px;
}
.mb15{
	margin-bottom:15px;
}
.mb20{
	margin-bottom:20px;
}
.mb25{
	margin-bottom:25px;
}
.mb30{
	margin-bottom:30px;
}
.mb40{
	margin-bottom:40px;
}
.mb50{
	margin-bottom:50px;
}
.mb-10{
	margin-bottom:-10px;
}
.mb-20{
	margin-bottom:-20px;
}
.mt-5{
	margin-top: -7px;
}
.mt-15{
	margin-top: -17px;
}
.mt15{
	margin-top:15px;
}
.ml5{
	margin-left:5px;
}
.ml10{
	margin-left:10px;
}
.ml20{
	margin-left:20px;
}
.ml-10{
	margin-left:-10px;
}
.ml25{
	margin-left:25px;
}
.ml30{
	margin-left:30px;
}
.ml-20{
	margin-left:-20px;
}
.mr-10{
	margin-right:-10px;
}
.mr3{
	margin-right:3px;
}
.mr10{
	margin-right: 10px;
}
.mr15{
	margin-right:17px;
}
.mr20{
	margin-right: 20px;
}
.no-display{
	display:none;
}
.gray999{
	color: #999;
}
.gray666{
	color: #666;
}
.gray333{
	color: #333;
}
.mr5{
	margin-right:5px;
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
/*	width:200px;
*/	font-size:100%;
}
.article_more {
        display: none;
}
.maxwidth,
#maxwidth{
	width: 100%;
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
/* mobile_footmenu */
div#mobile_footmenu{
	height:45px;
	padding:0px;
	background:#fff;
	border-bottom:1px
	solid #eee;
	bottom:0px;
	width:100%;
	position:fixed;
	z-index:9999;
}
.left{
	float:left;
}
.right{
	float:right;
}
#overflow{
	overflow:hidden;
}
#headermenu{
	margin:9px 15px 0 0;
	text-align:right;
}
#headermenu a{
	color:#fff;
	font-size:80%;
}
.gray{
	color:#999;
	font-size:80%;
}
/* mb_header */
.mobile_header_center{
	text-align: center;
        margin: 3px;
}
.mobile_header_center img {
	height: 36px;
}
.header_bottom_border{
	margin:-28px 0 0 0;
	height: 10px;
	border: 0;
	box-shadow: inset 0 10px 10px -10px rgba(0,0,0,0.5);
}
/* mb_menu */
.mb_menu_header{
	border:none;
	background:#999;
	text-shadow:none;
}
/* mb_boxview */
.mb_box_top_border{
	margin:-11px -10px 10px;
	height:1px;
	background-color: #ccc;
	border:none;
}
.boxview_wraper{
	margin:-10px 0 0;
}
.top_border{
	border-top:1px solid #ccc;
}
.bottom_border{
	border-top:1px solid #ccc;
	margin-right: -10px;
	margin-left: -10px;
}
.boxview_box{
	overflow:hidden;
}
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
.txt_white{
	color: #fff;
}
#boxview_righttext{
	padding:2px 0px 0 0px;
}
.boxview_category{
	text-shadow:none;
	padding:2px 5px;
	background: #dc8791;
	color:#fff;
	border:0;
}
.boxview_title{
	margin:0 5px 3px 0;
	color:#000;
	font-size:13px;
}
.boxview_title_mbranking{
	color:#666;
	font-size:13px;
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
}
.boxview_out{
	clear:both;
	margin:10px;
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
.articles_ranking_heading{
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
.box_article_head_text{
	bottom:0;
	padding:5px;
	width:100%;
	position:absolute;
}
.box_carousel_ja_user{
	color: #fff;
	text-shadow: 1px 1px 2px #999, -1px -1px 2px #999, 1px -1px 2px #999, -1px 1px 2px #999;
}
/* article head */
.article_head_photo{
	position:relative;
}
.article_head_sns{
	padding:0;
	width:100%;
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
.article_head_usericon{
	width:40px;
}
/* mb_ranking */
.articles_footer{
	background:#fff;
	border-bottom:1px solid #ccc;
	text-align:center;
	padding:10px;
	margin:0 -10px 10px;
}
/* mb_ranking */
.read_more_link{
	color:#333;
	display:block;
	text-decoration:none;
	font-weight:normal;
}
/* listview */
.listview_area{
	margin-top:30px;
}
.listview_title{
	margin-top:-20px;
	margin-bottom:5px;
	border-bottom:1px solid #ccc;
}
.listview_box{
	margin:-16px -10px 0;
}
.listview_left{
	float:left;
	width:90px;
}
.listview_leftimg{
	width:80px;
	height:80px;
}
.listview_right{
/*	float:left;
	width:75%;*/
	float:right;
	width:100%;
	margin-left:-90px;
}
.listview_txt{
	padding:9px 10px 2px;
}
.listview_out{
	clear:both;
	margin:10px;
}
/* mb_category */
.category_list_title{
	border-top:1px solid #ccc;
	border-bottom:1px solid #ccc;
	padding:7px 10px;
	background:#999;
	color:#fff;
}
.category_list{
	border-bottom:1px solid #ccc;
	padding:10px;
	font-weight:bold;
}
.category_ul{
	margin-top:0px;
}
.category_li{
	font-weight:bold;
	font-size:90%;
	border-right:1px solid #ccc;
	padding:10px;
	float:left;
	width:50%;
	border-bottom:1px solid #ccc;
}
#category_li{
	font-weight:bold;
	font-size:90%;
	border-right:1px solid #ccc;
	padding:10px;
	float:left;
	width:50%;
	border-bottom:1px solid #ccc;
}
.touch_hover_clear{
	filter:alpha(opacity=85);
	-moz-opacity:0.85;
	opacity:0.85;
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
.like-wrapper{
	width:50px;
	height:30px;
	position:relative;
	z-index:1;
}
.under_like_box{
	position: relative;
	z-index:2;
}
.form_oneline{
	height:30px;
	padding:3px;
}
.close{
	font-weight:normal;
	background:none;
	border:0px;
	box-shadow:none;
}
.article_like_box{
	border-left:2px solid #dc8791;
	border-right:2px solid #dc8791;
	padding:5px;
}
/* mb_reccomand */
.recommand_title{
	margin-bottom:-5px;
}
.recommand_area{
	margin-bottom:-21px;
}
/* carousel */
.carousel{
	margin:-17px -10px 0;
}
#carousel_inner_wrapper{
	position:relative;
	height:160px;
}
.carousel_img{
	width:100%;
	margin:0 auto;
}
#carousel_item{
	padding:0;
	width:100%;
}
.carousel_title{
	margin:5px 20px 0;
	font-size:90%;
	text-align:center;
	color: #dc8791;
	font-weight:bold;
	line-height:120%;
}
h1 {
	margin: 20px 0;
}
div.mobile_article_index_box{
	float:left;
	border-bottom:1px solid #ccc;
	border-right:1px solid #ccc;
	background:#fff;
}
.mobile_article_index_box2{
	float:left;
	border-bottom:1px solid #eee;
	background:#fff;
}
.border_top{
	border-top:1px solid #eee;
}
div#mobile_article_index_box2{
	float:left;
	border-bottom:1px solid #ccc;
	background:#fff;
}
div.mobile_article_index_text{
	background:#fff;
	padding:10px 5px;
	margin-left:95px;
}
.mobile_article_listview_text{
	background:#fff;
	padding:5px 0px;
	font-size:13px;
	color:#666;

	margin-left:90px;
}
ul,li{
	list-style:none;
}
#form_submit{
	width:100%;
	margin:10px 0;
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
	padding:0 3px;
	color:#333;
	word-break: break-all;
	word-wrap:break-word;
	overflow:hidden;
}
.article_row_ex{
	font-size:13px;
	color:#666;
	line-height:180%;
}
.article_more_read_view_desc1{
	font-size:12px;
	line-height:140%;
}
/* article->edit */
/* サムネイル設定 */
#thumbnail{
	margin:20px 0;
}
.thumbnail_title{
	font-size:18px;
	font-weight:bold;
	color:#666;
}
.thumbnail_select{
	overflow:hidden;
}
.thumbnail_select input{
	display: none;
}
.thumbnail_select label{
	display: block;
	float: left;
	cursor: pointer;
	width: 57px;
	margin: 0;
	padding: 12px 5px;
	border-right: 1px solid #abb2b7;
	background: #bdc3c7;
	color: #555e64;
	font-size: 14px;
	text-align: center;
	line-height: 1;
	transition: .2s;
}
.thumbnail_select label:first-of-type{
	border-radius: 3px 0 0 3px;
}
.thumbnail_select label:last-of-type{
	border-right: 0px;
	border-radius: 0 3px 3px 0;
}
.thumbnail_select input[type="radio"]:checked + label {
	background-color: #a1b91d;
	color: #fff;
}
/* user->edit */
.profile_edit_form{
	margin:10px 0 -5px;
	font-size:80%;
	line-height:150%;
}
/* user->profile */
.user_profile{
	padding:0 0 10px;
}
/* about */
.article_about_hr{
	margin: 10px -10px;
}
/* policy */
.page_title{
	font-size:24px;
	margin:0;
	color:#666;
}
/* checkbox */
div.check-group input {
	display: none;
}
div.check-group label {
	font-size:90%;
	text-shadow:none;
	font-weight:bold;
	text-align:center;
	cursor: pointer;
	padding:8px 10px;
	border: solid 1px #4cae4c;
	margin: 10px 0px 10px -20px;
	background: #5cb85c;
	width: 107%;
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	color: #fff;
}
div.check-group input:checked+label {
	color: #333;
	background: #eee;
	border: solid 1px #999;
}
/* main 1-4 */
.close{
	font-weight:normal; background:none; border:0px; box-shadow:none;
}
/* article -> about */
#about_wrapper{
	margin:-5px 0 10px;
}
.search_wrapper{
	margin:-10px 0 10px;
}
.viewport {
  position:fixed;
  z-index:9999;
  background:#666;
  width: 100%;
  overflow: hidden;
  margin: 40px auto 0;
  padding: 0px 0;
  -webkit-transform: translateZ(0);
}
.sample p {
  text-align: center;
}
.sample pre {
  display: none;
}
/* category */
.mb_category_icon{
	margin-right:3px;
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
.ranking_title{
    max-width: 90%;
    display: block;
    margin: 0 auto;
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
/* Article Pagination */
.article_pagination_area{
    text-align: center;
}
.article_pagination_area ul>li{
}
.article_pagination_area .pagination .disabled,
.article_pagination_area .pagination .disabled a,
.article_pagination_area .pagination  a {
    padding: 10px 15px;
    color:#dc8791;
    font-size: 110%;
}
.article_pagination_area .pagination .active a {
    color:#fff;
    background:#dc8791;
    border:1px solid #dc8791;
    border:1px solid #dc8791;
}
.article_pagination_area .pagination .not-active a {
    color:#ccc;
}
.article_pagination_guid{
    font-size: 90%;
    margin-top: -10px;
    color: #999;
}

.article_pagination_area .pagination .btn-disabled {
    cursor: default;
    text-decoration: none;
    color: #ccc;
}
.article_pagination_area .pagination .btn-disabled:focus {
    background-color: #fff;
}
.article_pagination_area .pagination .btn-current {
    color:#fff;
    background:#dc8791;
    border: 1px solid #dc8791;
}

/* Pagetitle */
.formtitle_text{
    font-size: 20px;
    line-height: 1.4em;
    margin: 0 0 10px;
}

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
.sp-head {
        width: 100%;
        height: 100px;
        object-fit: cover;
}
.article_row img, .article_row_ex img {
  width: calc(100% - 10px);
  max-height: 500px;
  margin: 20px 5px;
  object-fit: contain;
}
.article_row table, .article_row_ex table {
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
    <script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
  </head>
  <body>
    <div class="content-wrapper js-main">
      <div class="article_head_photo ml-10 mr-10 mt30">
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

        <div class="article_head_sns mt10">
          <div class="max-width overflow center">
            <div class="right mt3 mr5">
              <span class="gray"><small><?php echo $article_data['release_time'] ?></small></span>
            </div>
          </div>
        </div>

        <div class="article_row_ex">

<?php echo $article_data['introduction']; ?>

        </div>

        <hr>

        <div class="article_row mb50">

<?php echo $article_data['body']; ?>

        </div>

        <hr>

        <div class="article_row_ex mb30">

<?php echo $article_data['summary']; ?>

        </div>

      </div><!-- /article_view_area -->

      <div>
        <p class="articles_heading">関連記事</p>
<?php foreach ($article_data['related'] as $key => $value) { ?>
        <a href="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/' ?>">
          <div class="mobile_article_index_box2 max-width">
            <div class="boxview_left">
              <div class="boxview_leftimg">
                <amp-img src="<?php echo CATEGORY_URL[$value['category_id']].$value['path'].'/'.IMAGE_MAIN_SMALL ?>" width="78" height="78" alt="<?php echo $value['title'] ?>"></amp-img>
              </div>
            </div>
            <div class="boxview_right">
              <div class="mobile_article_index_text" id="boxview_righttext">
                <p class="boxview_title not_auto_br text-line-2"><?php echo $value['title'] ?></p>
                <div class="overflow">
                  <div class="left">
                    <small><span class="points_text"><?php echo $value['release_time'] ?></span></small>
                  </div>
                  <div class="right boxview_writeuser">
                    <ul class="list-inline boxview_info">
                      <li><span class="gray333 text-line-1 writer"><?php echo $value['author_name'] ?></span></li>
                    </ul>
                  </div>
                </div>
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

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
}
