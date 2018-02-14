<?php
	//ini_set('display_errors',1);
	require_once(dirname(__FILE__).'/../conf/ini.php');

//new ViewTop();

	$ua = $_SERVER['HTTP_USER_AGENT'];
	if ((strpos($ua,'iPhone')!==false) || (strpos($ua,'iPad')!==false) || (strpos($ua,'Android')!==false)) {
		include 'index-sp.php';
	} else {
		include 'index-pc.php';
	}

