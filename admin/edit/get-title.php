<?php
$url = $_GET['url'];
if(substr($url, 0, 2)=='//'){
  $url = 'http:'.$url;
}

$source = @file_get_contents($url);
if (preg_match('/<title>\s*(.*?)\s*<\/title>/is', mb_convert_encoding($source, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS'), $result)) {
    $title = $result[1];
} else {
    $title = '';
}
echo $title;

