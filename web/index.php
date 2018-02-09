<?php
	$ua = $_SERVER['HTTP_USER_AGENT'];
	if ((strpos($ua,'iPhone')!==false) || (strpos($ua,'iPad')!==false) || (strpos($ua,'Android')!==false)) {
		include 'index-sp.php';
	} else {
		include 'index-pc.php';
	}

