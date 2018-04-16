<?php
$url = $_GET['url'];
if(substr($url, 0, 4)!='http'){
  if(substr($url, 0, 2)=='//'){
    $url = 'http:'.$url;
  } else {
    $url = 'http://'.$url;
  }
}

$source = @file_get_contents($url);
if (preg_match('/<title>(.*?)<\/title>/i', mb_convert_encoding($source, 'UTF-8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS'), $result)) {
    $title = $result[1];
} else {
    $title = $url;
}
echo $title;

