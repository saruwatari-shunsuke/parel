<?php include "header-sp.html"; ?>
<?php
$title = array('','ファッション', 'ビューティー', '恋愛', 'ライフスタイル', '特集一覧');
$title_descript = array('',
			'ファッションについて書かれた記事一覧です。女子たるもの、流行りのファッションや最新のスタイルを知っておかなきゃ！トレンドアイテムや、憧れの芸能人・読者モデルのコーデを参考にしたり…&#9825;きっとあなたにぴったりの『可愛い』が見つかるはず♪',
			'美容について書かれた記事一覧です。メイク、ヘアスタイル、ネイル、ダイエット、スキンケア、ボディ…美容法やメイク方法、新発売の最新コスメやブランド情報をチェックして、もっと可愛くなろう&#9825;',
			'恋愛について書かれた記事一覧です。恋愛の悩みや、彼を振り向かせるテクニック、デートや、失恋や浮気などディープな内容も。好きな人や運命の人と出会い、付き合うための方法をお勉強しましょ&#9825;',
			'',
			'');
?>

                <div class="content_wrapper js-main ">
    		    		<div class="tag_wrapper">
  <p class="tags_heading"><?php echo $title[$_GET['c']] ?></p>
</div>

<?php include "content-sp.php"; ?>


<?php include "content-ranking-sp.html"; ?>
<?php include "content-push-sp.html"; ?>
	
    	</div>

<?php include "footer-sp.html"; ?>
