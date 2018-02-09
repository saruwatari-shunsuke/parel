<?php
	$ua = $_SERVER['HTTP_USER_AGENT'];
	if ((strpos($ua,'iPhone')!==false) || (strpos($ua,'iPad')!==false) || (strpos($ua,'Android')!==false)) {
		include 'topic-sp.php';
	} else {
		include 'topic-pc.php';
	}

