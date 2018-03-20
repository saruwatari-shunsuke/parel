<?php
/**
* ViewAdminArticleEdit
* 記事編集（仮）
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.1
*/

Class ViewAdminArticleEdit {
	public function __construct() {
		try {
			session_start();
			$object_car = new ControllerArticle();
			$article_data = $object_car->show1DataByAdmin();

			self::body($article_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($article_data) {
		try {
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
    <meta name="twitter:site" content="@parel_beauty">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
 
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>/css/common/html5reset-1.6.1.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" href="/jquery_file_upload/css/style.css">
    <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="/jquery_file_upload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/jquery_file_upload/css/jquery.fileupload-ui.css">
    <link rel="shortcut icon" href="/img/adm-parel.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGE_SITE_MAIN ?>">
    <link rel="alternate" type="application/rss+xml" title="" href="">

    <link rel="canonical" href="<?php echo ADMIN_URL ?>">
    <link rel="next" href="">
 
  </head>
  <body>
    <div class="container-fruid">
      <div class="row">

        <h1 class="col-md-12">記事の編集</h1>

<?php if($article_data['error']) { ?>
        <div class="col-md-12">
          <div class="panel panel-danger">
            <div class="panel-heading">エラー</div>
            <div class="panel-body"><?php echo $article_data['error']; ?></div>
          </div>
        </div>
<?php } ?>


          <div class="col-md-12">
            <div class="panel panel-default form-group">
              <div class="panel-heading">画像</div>
              <div class="panel-body">

    <blockquote>
        <p>File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery.<br>
        Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
        Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.</p>
    </blockquote>
    <br>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="/edit/jquery_file_upload/" method="POST" enctype="multipart/form-data">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" accept="image/png,image/jpeg,image/gif" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>

            <ul>
                <li>The maximum file size for uploads in this demo is <strong>999 KB</strong> (default file size is unlimited).</li>
                <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
                <li>Uploaded files will be deleted automatically after <strong>5 minutes or less</strong> (demo files are stored in memory).</li>
                <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">Browser support</a>).</li>
                <li>Please refer to the <a href="https://github.com/blueimp/jQuery-File-Upload">project website</a> and <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">documentation</a> for more information.</li>
                <li>Built with the <a href="http://getbootstrap.com/">Bootstrap</a> CSS framework and Icons from <a href="http://glyphicons.com/">Glyphicons</a>.</li>
            </ul>


              </div>
            </div>
          </div>



        <form action="/edit/?id=<?php echo $_GET['id'] ?>#noback" method="POST">

          <div class="col-md-3">
            <div class="panel panel-default form-group">
              <div class="panel-heading">キャッチ画像</div>
              <div class="panel-body center">
                <img src="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_LARGE; ?>" width=150>
              </div>
            </div>
          </div>

          <div class="col-md-7">
<?php $c[$article_data['category_id']]=" checked" ?>
            <div class="panel panel-default form-group">
              <div class="panel-heading">カテゴリ</div>
              <div class="panel-body">
                <div class="radio-inline">
                  <input type="radio" name="category" value="1" id="food" onclick="setCategoryUrl('food')"<?php echo $c[1] ?>><label for="food">Food</label>
                </div>
                <div class="radio-inline">
                  <input type="radio" name="category" value="2" id="exercise" onclick="setCategoryUrl('exercise')"<?php echo $c[2] ?>><label for="exercise">Exercise</label>
                </div>
                <div class="radio-inline">
                  <input type="radio" name="category" value="3" id="health" onclick="setCategoryUrl('health')"<?php echo $c[3] ?>><label for="health">Health</label>
                </div>
                <div class="radio-inline">
                  <input type="radio" name="category" value="4" id="fashion" onclick="setCategoryUrl('fashion')"<?php echo $c[4] ?>><label for="fashion">Fashion</label>
                </div>
                <div class="radio-inline">
                  <input type="radio" name="category" value="5" id="feature" onclick="setCategoryUrl('feature')"<?php echo $c[5] ?>><label for="feature">特集</label>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-7">
            <div class="panel panel-default form-group">
              <div class="panel-heading">URL</div>
              <div class="panel-body">
                <span id="category_url"><?php echo CATEGORY_URL[$article_data['category_id']] ?></span> <input class="form-controll" name="path" type="text" placeholder="" value="<?php echo $article_data['path']; ?>"> /
              </div>
            </div>
          </div>

          <div class="col-md-5">
<?php $a[$article_data['author_id']]=" selected" ?>
            <div class="panel panel-default form-group">
              <div class="panel-heading">著者</div>
              <div class="panel-body">
                <select name="author">
                  <option value="2"<?php echo $a[2] ?>>いっこだにこださんこだ</option>
                  <option value="3"<?php echo $a[3] ?>>スポーツマンシップりな</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-10">
            <div class="panel panel-default form-group">
              <div class="panel-heading">タイトル</div>
              <div class="panel-body">
                <input name="title" class="form-controll max-width" type="text" placeholder="" value="<?php echo $article_data['title']; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-default form-group">
              <div class="panel-heading">ディスクリプション</div>
              <div class="panel-body">
                <textarea name="description" rows="5" class="form-controll max-width" placeholder=""><?php echo $article_data['description']; ?></textarea>
              </div>
              <div class="panel-footer">改行は入れないでください</div>
            </div>
          </div>

          <div class="col-md-10">
            <div class="panel panel-default form-group">
              <div class="panel-heading">メタキーワード</div>
              <div class="panel-body">
                <input name="keyword" class="form-controll max-width" type="text" placeholder="ダイエット,食事,..." value="<?php echo $article_data['keyword']; ?>">
              </div>
              <div class="panel-footer">カンマ区切りで入力してください</div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-default form-group">
              <div class="panel-heading">導入文</div>
              <div class="panel-body">
                <textarea name="introduction" rows="10" class="form-controll max-width" placeholder=""><?php echo $article_data['introduction']; ?></textarea>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-default form-group">
              <div class="panel-heading">本文</div>
              <div class="panel-body">
                <textarea name="body" rows="100" class="form-controll max-width" placeholder=""><?php echo $article_data['body']; ?></textarea>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-default form-group">
              <div class="panel-heading">まとめ文</div>
              <div class="panel-body">
                <textarea name="summary" rows="10" class="form-controll max-width" placeholder=""><?php echo $article_data['summary']; ?></textarea>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <a href="/view/" class="btn btn-lg btn-default">キャンセル</a>
            <button type="submit" class="btn btn-lg btn-primary">保存</button>
          </div>

        </form>

      </div><!-- /row -->
    </div><!-- /container-fruid -->

<?php new ViewAdminFooter(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/base-pc.js"></script>
    <script type="text/javascript" src="/js/editor.js"></script>
 
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
    <script src="/jquery_file_upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="/jquery_file_upload/js/jquery.iframe-transport.js"></script>
    <script src="/jquery_file_upload/js/jquery.fileupload.js"></script>
    <script src="/jquery_file_upload/js/jquery.fileupload-process.js"></script>
    <script src="/jquery_file_upload/js/jquery.fileupload-image.js"></script>
    <script src="/jquery_file_upload/js/jquery.fileupload-audio.js"></script>
    <script src="/jquery_file_upload/js/jquery.fileupload-video.js"></script>
    <script src="/jquery_file_upload/js/jquery.fileupload-validate.js"></script>
    <script src="/jquery_file_upload/js/jquery.fileupload-ui.js"></script>
    <script src="/jquery_file_upload/js/main.js"></script>
    <script type="text/javascript" src="<?php echo MAIN_URL ?>js/trunk8.min.js"></script>
    <script>
      $(function(){
          $('.trunk2').trunk8({lines:2});
          $('.trunk3').trunk8({lines:3});
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
