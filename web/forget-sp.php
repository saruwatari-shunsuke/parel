<?php include "header-sp.html"; ?>


                <div class="content_wrapper js-main ">
    		    		<div class="add_space">
  <div class="row">
  	<div class="col-md-2 col-xs-0">
  	</div>
	<div class="col-md-8 col-xs-12">
	  <div class="well bg_white">
		<p class="add_title">パスワードの再発行</p>
		<div class="form-group mt20" align="center">
            <form action="forget-sp.php" onsubmit='return confirm("パスワードを再発行します。よろしいですか？");' id="UserReissueForm" method="post" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div><div class="input  required"><input name="data[User][email]" class="form-control user_login_mail" placeholder="登録したメールアドレス" id="UserEmail" required="required" type=""></div><div class="submit"><input class="btn btn-default user_login_fblogin mt10 max-width" value="パスワードを再発行する" type="submit"></div></form>		</div>
		<div class="mb10">
			<p class="add_link" align="center">
				<a href="login-sp.php" class="btn btn-link">ログインはこちら</a>
				<br>
				<a href="regist-sp.php" class="btn btn-link">新規ID取得はこちら</a>
			</p>
		</div>
	  </div>
	</div>
	<div class="col-md-2 col-xs-0">
	</div>
  </div>
</div>
    	</div>



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
