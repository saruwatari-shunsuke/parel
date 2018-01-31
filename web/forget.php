<?php include "header.html"; ?>

                <div class="overflow">
                                                    <div class="add_space">
  <div class="row">
  	<div class="col-md-2 col-xs-0">
  	</div>
	<div class="col-md-8 col-xs-12">
	  <div class="well bg_white">
		<p class="add_title">パスワードの再発行</p>
		<div class="form-group mt20" align="center">
            <form action="#" onsubmit="return confirm(&quot;パスワードを再発行します。よろしいですか？&quot;);" id="UserReissueForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"/></div><div class="input  required"><input name="data[User][email]" class="form-control user_login_mail" placeholder="登録したメールアドレス" type="" id="UserEmail" required="required"/></div><div class="submit"><input  class="btn btn-default user_login_fblogin mt10 max-width" type="submit" value="パスワードを再発行する"/></div></form>		</div>
		<div class="mb10">
			<p align="center" class="add_link">
				<a href="login.php" class="btn btn-link">ログインはこちら</a>
				<br>
				<a href="regist.php" class="btn btn-link">新規ID取得はこちら</a>
			</p>
		</div>
	  </div>
	</div>
	<div class="col-md-2 col-xs-0">
	</div>
  </div>
</div>
            
        </div> <!-- /row -->


<?php include 'footer.html'; ?>
