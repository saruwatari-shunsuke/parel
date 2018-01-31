<?php include "header.html"; ?>

                <div class="overflow">
                                                    <h1 class="pagetitle_text">
	<a href="setting.php" class="gray">設定</a></h1>
<div class="user_edit_box">

	
<form action="setting.php" id="UserEditForm" enctype="multipart/form-data" method="post" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div><input name="data[User][id]" value="1989764" id="UserId" type="hidden">
	<p class="profile_edit_form" id="profile_headline">プロフィール写真</p>
		  <div class="row">
			<div class="col-md-2">
				<img src="img/common/user_noimage.jpg" alt="preview" id="preview" class="user_edit_realtimeoreview">
			</div>
			<div class="col-md-8">
			<div class="input file"><input name="data[User][photo]" multiple="multiple" id="image" class="user_edit_photoinput" data-role="none" type="file"></div>			</div>
		</div>

	<p class="profile_edit_form" id="profile_headline">ユーザー名</p>
	<div class="input textarea required"><textarea name="data[User][username]" rows="1" class="user_edit_nameinput" data-role="none" placeholder="ユーザー名" maxlength="255" cols="30" id="UserUsername" required="required">なまえ</textarea></div>
	<p class="profile_edit_form" id="profile_headline">プロフィール</p>
	<div class="input textarea"><textarea name="data[User][profile]" rows="7" class="user_edit_nameinput" data-role="none" placeholder="自己紹介をしましょう！" cols="30" id="UserProfile"></textarea></div>


	<div class="submit"><input class="btn btn-default btn-lg user_edit_submit" name="publish" data-role="none" value="変更する" type="submit"></div>
	



</form></div>

<div class="height100"></div>

            
            
        </div> <!-- /row -->


<?php include 'footer_login.html'; ?>
