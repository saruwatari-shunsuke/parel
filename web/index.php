<?php include "header.html"; ?>

<div class="overflow mb10">
    <div class="left carousel_bar">

        <div class="left width33p">
            <div class="carousel_body" id="hover_filter">
                <div class="">
                    <a href="topic.php" class="push-click" id="topbtn-left" data-article-id="#">
                        <img class="carousel_item_img" src="img/article/large_87096_0.jpg">
                        <div class="carousel_logo_wrapper">
                            <p class="carousel_category_tag">ライフスタイル</p>
                            <p class="carousel_text">2,000円以下で買える♪2018年注目のバレンタインチョコ10選</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="left width33p">
            <div class="carousel_body" id="hover_filter">
                <div class="">
                    <a href="topic.php" class="push-click" id="topbtn-center" data-article-id="#">
                        <img class="carousel_item_img" src="img/article/large_106408_0.jpg">
                        <div class="carousel_logo_wrapper">
                            <p class="carousel_category_tag">ビューティー</p>
                            <p class="carousel_text">神崎恵さんも心地良さを実感！オーガニックスキンケアアイテムとは？</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="left width33p">
            <div class="carousel_body" id="hover_filter">
                <div class="">
                    <a href="topic.php" class="push-click" id="topbtn-right" data-article-id="#">
                        <img class="carousel_item_img" src="img/article/large_343521_0.jpg">
                        <div class="carousel_logo_wrapper">
                            <p class="carousel_category_tag">恋愛</p>
                            <p class="carousel_text">仕事が忙しくて余裕がない彼に、振り回されない方法3つ</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overflow">
    <div class="left main_bar">

<?php include 'contents.html'; ?>

    </div>
    </div>

<?php include 'rightsidebar.html'; ?>
            
    </div> <!-- /row -->

  <script>
    $(function(){
        $('.boxview_text_title a').trunk8({lines:2});
    });
  </script>

<?php include 'footer.html'; ?>
