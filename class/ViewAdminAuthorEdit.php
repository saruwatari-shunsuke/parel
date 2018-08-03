<?php
/**
* ViewAdminAuthorEdit
* 著者編集
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.3
*/

Class ViewAdminAuthorEdit {
	public function __construct() {
		try {
			session_start();
			$object_cau = new ControllerAuthor();
			$author_data = $object_cau->show1DataByAdmin();

			self::body($author_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($author_data) {
		try {
			global $setting_data;
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITE_TITLE_ADMIN ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
    <meta name="description" content="<?php echo $setting_data['site_description'] ?>">
    <meta name="keywords" content="">
    <meta name="robots" content="index,follow">

    <meta property="og:title" content="<?php echo SITE_TITLE_ADMIN ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo ADMIN_URL ?>">
    <meta property="og:site_name" content="<?php echo $setting_data['site_name_short'] ?>">
    <meta property="og:description" content="<?php echo $setting_data['site_description'] ?>">
    <meta property="og:image" content="<?php echo IMAGE_SITE_MAIN ?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="al:web:url" content="<?php echo ADMIN_URL ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@<?php echo $setting_data['twitter'] ?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
<?php ViewBootstrap::css(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" href="/jquery_file_upload/css/style.css">
    <link rel="stylesheet" href="/jquery_file_upload/css/jquery.fileupload.css">
    <link rel="shortcut icon" href="/img/adm-parel.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="canonical" href="<?php echo ADMIN_URL ?>">
 
  </head>
  <body>
    <div class="container-fruid">
      <div class="row">

        <h1 class="col-md-12">著者の編集</h1>

<?php if($author_data['error']) { ?>
        <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading">エラー</div>
            <div class="panel-body"><?php echo $author_data['error']; ?></div>
          </div>
        </div>
<?php } ?>

        <form action="/author/edit/?id=<?php echo $_GET['id'] ?>#noback" method="POST">

          <div class="col-md-12 mb20">
            <a href="/author/" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-ban-circle"></span> 編集を破棄して戻る</a>
            <button type="submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-ok-sign"></span> 編集を保存して戻る</button>
          </div>

          <div class="col-md-3">
            <div class="panel panel-info form-group" id="dropzone">
              <div class="panel-heading"><span class="glyphicon glyphicon-picture"></span> アイコン画像</div>
              <div class="panel-body center">
                <div>
                  <img id="main-image" src="<?php echo MAIN_URL.'img/author/'.$author_data['author_id'].'.jpg?time='.date('YmdHis'); ?>" width=100>
                </div>
                <input class="hidden" id="fileupload" type="file" name="files[]" multiple>
                <br>
                画像をドラッグ＆ドロップしてください。
                <!-- The global progress bar -->
                <div id="progress" class="progress">
                  <div class="progress-bar progress-bar-success"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-9">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> 名前</div>
              <div class="panel-body">
                <input name="name" class="form-controll max-width" type="text" placeholder="" value="<?php echo $author_data['name']; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-9">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> プロフィール</div>
              <div class="panel-body">
                <textarea name="profile" rows="5" class="form-controll max-width" placeholder=""><?php echo $author_data['profile']; ?></textarea>
              </div>
            </div>
          </div>

        </form>

      </div><!-- /row -->
    </div><!-- /container-fruid -->

<?php new ViewAdminFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php ViewBootstrap::js(); ?>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script> 

    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="/jquery_file_upload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/jquery_file_upload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/jquery_file_upload/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="/jquery_file_upload/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="/jquery_file_upload/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="/jquery_file_upload/js/jquery.fileupload-validate.js"></script>

<script>
// ドロップゾーン外へのドラッグ＆ドロップ防止
$(function () {
  $(document).on('drop dragover', function (e) {
    e.stopPropagation();
    e.preventDefault();
  });
});

$(function () {
    'use strict';
    $('#fileupload').fileupload({
        url: '/jquery_file_upload/server/php/',
        dataType: 'json',
        imageMaxWidth: 100,
        imageMaxHeight: 100,
        imageCrop: true,
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        dropZone: $('#dropzone')
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            $.get("/author/edit/move-file.php", {
                oldname: file.name,
                newname: "<?php echo $author_data['author_id'] ?>.jpg"});
            setTimeout(function(){
                $('#main-image').attr('src', '<?php echo MAIN_URL.'img/author/'.$author_data['author_id'].'.jpg?time='; ?>' + new Date().getTime());
            },10);//0.01秒待機してmvコマンド完了待ち
            setTimeout(function(){
                $('#progress .progress-bar').css('width','0%');
            },2000);
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

});
</script>

  </body>
</html>
<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
