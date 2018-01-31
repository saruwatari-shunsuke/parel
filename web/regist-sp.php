<?php include "header-sp.html"; ?>

                <div class="content_wrapper js-main ">
    		    		<div class="add_border">
	<p class="add_desc">ログインすると、お気に入り機能を利用できるようになります。</p>
</div>
<div class="user_add_sns_wrapper">
	<p class="user_add_getid"> IDを取得（無料）</p><p>
	</p><div class="user_login_sns">
		<a href="#" data-toggle="modal" data-target="#iOS_dwld" class="user_login_iosbtn" data-article-id="" id="article_top_nologin_fav_ios">アプリではじめる</a>
		<a href="http://twitter.com/" class="user_login_twbtn"><img src="img/common/tw_mk.png" alt="twitterログイン" class="user_login_twimg"> twitter</a>
	</div>
</div>
<div>
	<p class="user_login_or">- or -</p>
</div>
<form action="index-sp-login.php" id="UserAddForm" method="post" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div><div class="form-group user_add_email">
	<input name="data[User][email]" class="form-control" placeholder="メールアドレス" maxlength="255" id="UserEmail" required="required" value="" type="email"></div>
<div class="form-group">
	<input name="data[User][password]" class="form-control" placeholder="パスワード（6文字以上）" id="UserPassword" required="required" type="password"></div>
<div>
	<p class="add_doui center">
		<a href="policy-sp.php">利用規約</a>と<a href="policy-sp.php">プライバシーポリシー</a>に同意して
	</p>
</div>
<div class="form-group">
	<input name="data[User][role]" value="author" id="UserRole" type="hidden">	<div class="submit"><input class="btn btn-default btn-lg max-width" value="今すぐはじめる" type="submit"></div></div></form>
<div>
	<hr class="user_add_hr">
</div>
<div class="user_add_login">
	<p class="add_desc"> IDをお持ちの方</p><p>
	<a href="login-sp.php" class="btn btn-default btn-lg user_add_loginkink">ログイン</a>
</p></div>



<div class="modal fade modal_sns" id="iOS_dwld" style="display: none;">
    <div class="modal-content modal_iOS_cdwld mt20">
    	<a href="https://itunes.apple.com/jp/app/">
			<img src="img/common/ios_dl.png" alt="" class="max-width">
		</a>
	    <p class="mb15 mt5 gray666" id="modal_sns_close" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> close</p>
    </div>
</div>

<script type="text/javascript">
  $(function() {
	$('#iOS_dwld').modal('show')
  });
</script>
    	</div>


<?php include "footer-sp.html"; ?>
