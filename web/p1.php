<?php include "header.html"; ?>
<?php
$title = array('','ファッション', 'ビューティー', '恋愛', 'ライフスタイル', '特集一覧');
$title_descript = array('',
			'ファッションについて書かれた記事一覧です。女子たるもの、流行りのファッションや最新のスタイルを知っておかなきゃ！トレンドアイテムや、憧れの芸能人・読者モデルのコーデを参考にしたり…&#9825;きっとあなたにぴったりの『可愛い』が見つかるはず♪',
			'美容について書かれた記事一覧です。メイク、ヘアスタイル、ネイル、ダイエット、スキンケア、ボディ…美容法やメイク方法、新発売の最新コスメやブランド情報をチェックして、もっと可愛くなろう&#9825;',
			'恋愛について書かれた記事一覧です。恋愛の悩みや、彼を振り向かせるテクニック、デートや、失恋や浮気などディープな内容も。好きな人や運命の人と出会い、付き合うための方法をお勉強しましょ&#9825;',
			'',
			'');
?>

                <div class="overflow">
                            <div class="left main_bar">
                                                    
<ul class="breadcrumb_ul">
	<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<a href="/" itemprop="url"><span itemprop="title" class="gray"><small>site</small></span></a>　&gt;
	</li>
	<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
		<span itemprop="title" class="gray"><small><?php echo $title[$_GET['c']]; ?></small></span>
	</li>
</ul>

<h1 class="pagetitle_text"><?php echo $title[$_GET['c']]; ?></h1>

	<div class="selections_view_desc">
		<div class="select_article_view_desc"><?php echo $title_descript[$_GET['c']]; ?></div>
	</div>

<?php include 'contents.html'; ?>

                            </div>
                            </div>

<?php include 'rightsidebar.html'; ?>
            
        </div> <!-- /row -->

<?php include 'footer.html'; ?>
