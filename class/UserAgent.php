<?php
/**
* UserAgent
* UserAgentを判定する
* @package UserAgent
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.0
*/
Class UserAgent{
	/*
	* iOSの場合1, Androidの場合2, その他の場合0を返す
	*
	* @param
	* @access public
	* @return int
	*/
	public static function getOsid(){
		try {
			$ua = $_SERVER['HTTP_USER_AGENT'];
			if ((strpos($ua, 'iPhone') !== false) || (strpos($ua, 'iPad') !== false)) {
				return 1;
			} else if (strpos($ua, 'Android') !== false) {
				return 2;
			}
			return 0;
		} catch(Exception $e) {
			return 0;
		}
	}
	/*
	* PCの場合第一引数、SPの場合第二引数を返す
	*
	* @param
	* @access public
	* @return int
	*/
	public static function switch($item_pc, $item_sp) {
		if(self::getOsid()){
			return $item_sp;
		} else {
			return $item_pc;
		}
	}
}
