<?php
/**
* ViewAdminArticleEdit
* 記事編集
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

			$object_mmca = new ModelMasterCategories();
			$category_data = $object_mmca->selectAll();

			$object_mdau = new ModelDataAuthors();
			$author_data = $object_mdau->selectAll();

			self::body($article_data, $category_data, $author_data);
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}
	private function body($article_data, $category_data, $author_data) {
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
 
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>/css/html5reset-1.6.1.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo MAIN_URL ?>css/base-pc.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <!-- Generic page styles -->
    <link rel="stylesheet" href="/jquery_file_upload/css/style.css">
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="/jquery_file_upload/css/jquery.fileupload.css">

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

        <form action="/edit/?id=<?php echo $_GET['id'] ?>#noback" method="POST">

          <div class="col-md-9 mb20">
            <a href="/view/" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-ban-circle"></span> 編集を破棄して戻る</a>
            <button type="submit" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-ok-sign"></span> 編集を保存して戻る</button>
          </div>
          <div class="col-md-3 mb20">
            <a data-toggle="modal" data-target="#ModalDelete" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-trash"></span> 記事の削除</a>
          </div>

          <div class="modal fade" id="ModalDelete" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                  <h4 class="modal-title">記事の削除</h4>
                </div>
                <div class="modal-body">
                  <img src="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_SMALL; ?>" width=60>
                  <p><?php echo ($article_data['title']) ? '記事「'.$article_data['title'].'」' : 'この記事' ; ?>を削除します。</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">削除しない</button>
                  <a data-toggle="modal" data-target="#ModalDelete2" class="btn btn-lg btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-trash"></span> 削除する</a>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="ModalDelete2" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
                  <h4 class="modal-title">記事の削除</h4>
                </div>
                <div class="modal-body">
                  <p>削除してしまうと元には戻せません。本当に削除しますか？</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">やめる</button>
                  <a class="btn btn-lg btn-danger" href="/edit/?id=<?php echo $_GET['id'] ?>&delete=1#noback"><span class="glyphicon glyphicon-trash"></span> 本当に削除する</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="panel panel-info form-group" id="dropzone-mainimage">
              <div class="panel-heading"><span class="glyphicon glyphicon-picture"></span> キャッチ画像</div>
              <div class="panel-body center">
                <div>
                  <img id="main-image" src="<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_SMALL.'?time='.date('YmdHis'); ?>" width=150>
                </div>
                <input class="hidden" id="fileupload1" type="file" name="files[]" multiple>
                <input class="hidden" id="fileupload2" type="file" name="files[]" multiple>
                <br>
                画像をドラッグ＆ドロップしてください。
                <!-- The global progress bar -->
                <div id="progress1" class="progress">
                  <div class="progress-bar progress-bar-success"></div>
                </div>
                <div id="progress2" class="progress">
                  <div class="progress-bar progress-bar-success"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-7">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-ok"></span> カテゴリ</div>
              <div class="panel-body">
                <div class="btn-group btn-group-justified" data-toggle="buttons">
<?php foreach ($category_data as $key => $value) { ?>
<?php if($article_data['category_id']==$value['category_id']) { ?>
                  <label class="btn btn-default active" onclick="setCategoryUrl('<?php echo $value['name_domain'] ?>', 0)">
                    <input type="radio" name="category" value="<?php echo $value['category_id'] ?>" autocomplete="off" checked> <?php echo $value['name'] ?>
                  </label>
<?php } else { ?>
                  <label class="btn btn-default" onclick="setCategoryUrl('<?php echo $value['name_domain'] ?>', 1)">
                    <input type="radio" name="category" value="<?php echo $value['category_id'] ?>" autocomplete="off"> <?php echo $value['name'] ?>
                  </label>
<?php }} ?>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-7">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> URL</div>
              <div class="panel-body">
                <span id="category_url"><?php echo CATEGORY_URL[$article_data['category_id']] ?></span> <input class="form-controll" name="path" type="text" placeholder="" value="<?php echo $article_data['path']; ?>"> /
              </div>
            </div>
          </div>

          <div class="col-md-7">
<?php $a[$article_data['author_id']]=" selected" ?>
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-ok"></span> この記事を書いた人</div>
              <div class="panel-body">
                <select name="author" class="selectpicker form-control">
<?php foreach ($author_data as $key => $value) {
                   echo '<option value="'.$value['author_id'].'"'.$a[$value['author_id']].'>'.$value['name'].'</option>';
} ?>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-10">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> タイトル</div>
              <div class="panel-body">
                <input name="title" class="form-controll max-width no-enter" type="text" placeholder="" value="<?php echo $article_data['title']; ?>">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> ディスクリプション</div>
              <div class="panel-body">
                <textarea name="description" rows="3" class="form-controll max-width no-enter" placeholder=""><?php echo $article_data['description']; ?></textarea>
              </div>
              <div class="panel-footer">検索時に出てくる120文字前後の説明文です。</div>
            </div>
          </div>

          <div class="col-md-10">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> メタキーワード</div>
              <div class="panel-body">
                <input name="keyword" class="form-controll max-width no-enter" type="text" placeholder="ダイエット,食事,..." value="<?php echo $article_data['keyword']; ?>">
              </div>
              <div class="panel-footer">カンマ区切りで入力してください。</div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> 導入文</div>
              <div class="panel-body">
                <div class="toolbar">
                  <a class="btn btn-sm btn-default" href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['strong'],'text_introduction');" data-toggle="tooltip" data-placement="right" data-original-title="本文中の太字にしたい部分を囲って、このボタンを押してください。"><strong>太字</strong> <code>&lt;strong&gt;</code></a>
                </div>
                <textarea id="text_introduction" name="introduction" rows="5" class="form-controll max-width" placeholder=""><?php echo $article_data['introduction']; ?></textarea>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> 本文</div>
              <div class="panel-body">
                <div id="toolbar" class="toolbar">
                  <span class="dropdown" data-toggle="tooltip" data-placement="right" data-original-title="本文中の色をつけたい部分を囲って、このボタンを押してください。">
                    <a href="#" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"><span class="colored">マーカー</span> <code>&lt;span&gt;</code><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline #f69 dashed;'],'text_body');"><span style="text-decoration:underline #f69 dashed;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline #c00 dashed;'],'text_body');"><span style="text-decoration:underline #c00 dashed;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline dashed;'],'text_body');"><span style="text-decoration:underline dashed;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline #f69 wavy;'],'text_body');"><span style="text-decoration:underline #f69 wavy;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline #c00 wavy;'],'text_body');"><span style="text-decoration:underline #c00 wavy;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline wavy;'],'text_body');"><span style="text-decoration:underline wavy;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline #f69;'],'text_body');"><span style="text-decoration:underline #f69;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline #c00;'],'text_body');"><span style="text-decoration:underline #c00;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','text-decoration:underline;'],'text_body');"><span style="text-decoration:underline;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','background:linear-gradient(transparent 80%, #fce 0%);'],'text_body');"><span style="background:linear-gradient(transparent 80%, #fce 0%);">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','background:linear-gradient(transparent 80%, #f69 0%);'],'text_body');"><span style="background:linear-gradient(transparent 80%, #f69 0%);">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','background:linear-gradient(transparent 80%, #c00 0%);'],'text_body');"><span style="background:linear-gradient(transparent 80%, #c00 0%);">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','background:linear-gradient(transparent 60%, #fce 0%);'],'text_body');"><span style="background:linear-gradient(transparent 60%, #fce 0%);">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','background:linear-gradient(transparent 60%, #f69 0%);'],'text_body');"><span style="background:linear-gradient(transparent 60%, #f69 0%);">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','background:#fce;'],'text_body');"><span style="background:#fce;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['span','background:#f69;'],'text_body');"><span style="background:#f69;">パルールは美も健康も両立したい欲張りな20代女性のためのダイエットメディアです。</span></a></li>
                    </ul>
                  </span>
                  <span class="dropdown" data-toggle="tooltip" data-placement="right" data-original-title="本文中の色をつけたい部分を囲って、このボタンを押してください。">
                    <a href="#" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"><span class="frame">枠</span> <code>&lt;div&gt;</code><span class="caret"></span></a>
                    <ul id="toolbar-frame" class="dropdown-menu" role="menu">
                      <li role="presentation"><a  href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','border:solid #333 1px;padding:5px 15px;'],'text_body');"><div style="border:solid #333 1px;margin:2px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','border:dotted #f69 3px;border-radius:10px;padding:5px 15px;'],'text_body');"><div style="border:dotted #f69 3px;border-radius:10px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','background:#ffc;border-radius:10px;padding:5px 15px;'],'text_body');"><div style="background:#ffc;border-radius:10px;margin:3px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                      <li role="presentation"><a  href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','border:solid #f69 1px;padding:5px 15px;'],'text_body');"><div style="border:solid #f69 1px;margin:2px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','border:dashed #f69 3px;border-radius:10px;padding:5px 15px;'],'text_body');"><div style="border:dashed #f69 3px;border-radius:10px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','background:#fce;border-radius:10px;padding:5px 15px;'],'text_body');"><div style="background:#fce;border-radius:10px;margin:3px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','border:double #f69 3px;border-radius:10px;padding:5px 15px;'],'text_body');"><div style="border:double #f69 3px;border-radius:10px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','border:solid #f69 3px;border-radius:10px;padding:5px 15px;'],'text_body');"><div style="border:solid #f69 3px;border-radius:10px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                      <li role="presentation"><a href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['div','background:#cef;border-radius:10px;padding:5px 15px;'],'text_body');"><div style="background:#cef;border-radius:10px;margin:3px;padding:5px 15px;">・リスト1<br>・リスト2<br>・リスト3</div></a></li>
                    </ul>
                  </span>
                  <a class="btn btn-sm btn-default" href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['strong'],'text_body');" data-toggle="tooltip" data-placement="right" data-original-title="本文中の太字にしたい部分を囲って、このボタンを押してください。"><strong>太字</strong> <code>&lt;strong&gt;</code></a>
                  <a class="btn btn-sm btn-default" href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['h3'],'text_body');" data-toggle="tooltip" data-placement="right" data-original-title="本文中の見出しにしたい一行を囲って、このボタンを押してください。"><span class="heading">●見出し</span> <code>&lt;h3&gt;</code></a>
                  <a class="btn btn-sm btn-default" href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['h4'],'text_body');" data-toggle="tooltip" data-placement="right" data-original-title="本文中の小見出しにしたい一行を囲って、このボタンを押してください。"><strong>小見出し</strong> <code>&lt;h4&gt;</code></a>
                  <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#ModalInternalLink" data-load-url="/edit/internal-links.php"><span class="link">内部リンク</span> <code>&lt;a&gt;</code></a>
                  <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#ModalExternalLink"><span class="link">外部リンク</span> <code>&lt;a&gt;</code></a>
                  <span class="dropdown" data-toggle="tooltip" data-placement="bottom" data-original-title="本文中の挿入したい部分をクリックした後、テキストエリアに画像をドラッグ＆ドロップしてください。">
                    <a class="btn btn-sm btn-default"><span class="graphic"><span class="glyphicon glyphicon-picture"></span> 画像</span> <code>&lt;img&gt;</code></a>
                  </span>
                  <span class="toolbar_text">ツールバー</span>
                </div>

                <textarea id="text_body" name="body" rows="500" class="form-controll max-width" placeholder=""><?php echo $article_data['body']; ?></textarea>
                <input class="hidden" id="fileupload3" type="file" name="files[]" multiple>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="panel panel-info form-group">
              <div class="panel-heading"><span class="glyphicon glyphicon-pencil"></span> まとめ文</div>
              <div class="panel-body">
                <div class="toolbar">
                  <a class="btn btn-sm btn-default" href="javascript:void(0);" onFocus="this.blur()" onclick="surroundHTML(['strong'],'text_summary');" data-toggle="tooltip" data-placement="right" data-original-title="まとめ文中の太字にしたい部分を囲って、このボタンを押してください。"><strong>太字</strong> <code>&lt;strong&gt;</code></a>
                </div>
                <textarea id="text_summary" name="summary" rows="5" class="form-controll max-width" placeholder=""><?php echo $article_data['summary']; ?></textarea>
              </div>
            </div>
          </div>

        </form>

          <div class="modal fade" id="ModalInternalLink" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
                  <h4 class="modal-title"><span class="glyphicon glyphicon-link"></span> 記事へのリンクを張る</h4>
                </div>
                <div class="modal-body">
                  <p>Loading...</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">キャンセル</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="ModalExternalLink" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
                  <h4 class="modal-title"><span class="glyphicon glyphicon-link"></span> 外部サイトへのリンクを張る</h4>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="url" class="control-label">URL:</label>
                    <input type="text" class="form-control" id="modal_external_url" placeholder="http://">
                  </div>
                  <div class="form-group">
                    <label for="title" class="control-label">タイトル:</label>
                    <input type="text" class="form-control" id="modal_external_title">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">キャンセル</button>
                  <a href="javascript:void(0);" onclick="surroundHTML(['a','ex'],'text_body');" class="btn btn-lg btn-info" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span> OK</a>
                </div>
              </div>
            </div>
          </div>

        <div class="col-md-12 mb30">
          <a href="#"id="page-top" class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-chevron-up"></span> ページトップに戻る</a>
        </div>

      </div><!-- /row -->
    </div><!-- /container-fruid -->

<?php new ViewAdminFooter(); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.0.1/js/bootstrap-switch.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/js/jquery.exflexfixed-0.3.0.js"></script><!-- toolbar move -->
    <script type="text/javascript" src="/js/editor.js"></script>

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
$(function () {
    'use strict';

    //キャッチ画像（大）
    $('#fileupload1').fileupload({
        url: '/jquery_file_upload/server/php/',
        dataType: 'json',
        imageMaxWidth: 600,
        imageMaxHeight: 600,
        imageCrop: true,
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        dropZone: $('#dropzone-mainimage')
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
        $('#progress1 .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            $.get("/edit/move-file.php", {
                category: "<?php echo $article_data['category_id'] ?>",
                path: "<?php echo $article_data['path'] ?>",
                oldname: file.name,
                newname: "<?php echo IMAGE_MAIN_LARGE; ?>"});
            setTimeout(function(){
                $('#progress1 .progress-bar').css('width','0%');
            },2000);
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    //キャッチ画像（小）
    $('#fileupload2').fileupload({
        url: '/jquery_file_upload/server/php/',
        dataType: 'json',
        imageMaxWidth: 250,
        imageMaxHeight: 250,
        imageCrop: true,
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        dropZone: $('#dropzone-mainimage')
    }).on('fileuploadsubmit', function (e, data) {
        $('#progress2 .progress-bar').css('width','0%');
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
    }).on('fileuploadprogress', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress2 .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            $.get("/edit/move-file.php", {
                category: "<?php echo $article_data['category_id'] ?>",
                path: "<?php echo $article_data['path'] ?>",
                oldname: file.name,
                newname: "<?php echo IMAGE_MAIN_SMALL; ?>"});
            setTimeout(function(){
                $('#main-image').attr('src', '<?php echo CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/'.IMAGE_MAIN_SMALL.'?time='; ?>' + new Date().getTime());
            },10);//0.01秒待機してmvコマンド完了待ち
            setTimeout(function(){
                $('#progress2 .progress-bar').css('width','0%');
            },2000);
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    //本文中の画像
    $('#fileupload3').fileupload({
        url: '/jquery_file_upload/server/php/',
        dataType: 'json',
        imageMaxWidth: 800,
        imageMaxHeight: 600,
        imageCrop: false,
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        dropZone: $('#text_body')
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var c = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            var newName = "";
            for(var i=0; i<4; i++){
              newName += c[Math.floor(Math.random()*c.length)];
            }
            newName += '.jpg';
            $.get("/edit/move-file.php", {
                category: "<?php echo $article_data['category_id'] ?>",
                path: "<?php echo $article_data['path'] ?>",
                oldname: file.name,
                newname: newName
            });
            surroundHTML(['img',newName],'text_body');
        });
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
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
