<?php include "header.html"; ?>

                <div class="overflow">
                                                    <div class="add_space">
  <div class="row">
  	<div class="col-md-2 col-xs-2">
  	</div>
	<div class="col-md-8 col-xs-8">
		<div class="well bg_white">
			<p class="add_title">会員登録（無料）</p>
			<div class="user_add_formbox">
				<p class="gray999">ログインすると、記事のお気に入り機能を利用できるようになります。</p>
				<form action="index_login.php" id="UserAddForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>				<div class="form-group">
					<input name="data[User][email]" placeholder="メールアドレス" class="form-control" maxlength="255" type="email" id="UserEmail" required="required"/>				</div>
				<div class="form-group">
					<input name="data[User][password]" placeholder="パスワード（6文字以上）" class="form-control" type="password" id="UserPassword" required="required"/>				</div>
				<p class="gray center">
					<a href="policy.html" target="_blank">利用規約</a> と <a href="policy.html" target="_blank">プライバシーポリシー</a> に同意して
				</p>
			</div>
			<div class="form-group">
				<div class="submit"><input  class="btn btn-default btn-lg user_add_submitbtn" type="submit" value="今すぐはじめる"/></div></form>			</div>
			<p class="add_or">- or -</p>
			<div align="center">
				<a href="http://twitter.com/" class="btn btn-info btn-lg user_login_fbloginbtn"><img src="/img/common/tw_mk.png" alt="twitterログイン" class="user_login_fbimg"> twitter</a>
				<p class="login_link">
					<a href="login.php" class="btn btn-link">ログインはこちら</a><br>
				</p>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-xs-2">
	</div>
  </div>
</div>
            
            
        </div> <!-- /row -->

<?php include 'footer.html'; ?>
