<?php include "header-sp.html"; ?>

                <div class="content_wrapper js-main ">
    		    		<div class="tag_wrapper">
	<p class="articles_heading login_heading">ログイン</p>
</div>
<div class="user_login_sns">
	<a href="#" data-toggle="modal" data-target="#iOS_dwld" class="user_login_iosbtn" data-article-id="" id="article_top_nologin_fav_ios">アプリでログイン</a>
	<a href="http://twitter.com/" class="user_login_twbtn"><img src="img/common/tw_mk.png" alt="twitterログイン" class="user_login_twimg"> twitter</a>
</div>
<div>
	<p class="user_login_or">- or -</p>
	<div class="form-group">
		<form action="index-sp-login.php" id="UserLoginForm" method="post" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>		<input name="data[User][email]" placeholder="メールアドレス" class="form-control" maxlength="255" id="UserEmail" required="required" value="" type="email">	</form></div>
	<div class="form-group">
		<input name="data[User][password]" placeholder="パスワード" class="form-control" id="UserPassword" required="required" type="password">	</div>
	<div class="form-group">
		<input name="data[User][role]" value="author" id="UserRole" type="hidden">
<?php if(false) { ?>
		<div class="submit"><input class="btn btn-default btn-lg max-width" value="ログイン" type="submit"></div></div>
<?php } ?>
		<div class="submit"><a href="index-sp-login.php" class="btn btn-default btn-lg max-width">ログイン</a></div>
	<p class="user_login_addlink">
		<a href="regist-sp.php" class="btn btn-link"><u>ID取得はこちら</u></a>
		<a href="forget-sp.php" class="btn btn-link"><u>パスワードを忘れた方はこちら</u></a>
	</p><p>
</p></div>
<div class="height50"></div>



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
