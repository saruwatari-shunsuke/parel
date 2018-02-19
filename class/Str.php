<?php
/**
* Str
* 文字列いろいろ
* @package Str
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.0
*/
Class Str {
	const SECRET_KEY = 'D[3ve+@oRgjVSUp0]OU$Fb8';
	/*
	* ランダムな文字列を生成する(省略すると20文字)
	*
	* @param int
	* @access public
	* @return string
	*/
	public static function getRandom($length = 20){
		try{
			$char_list = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
			mt_srand();
			$sRes = "";
			for($i = 0; $i < $length; $i++)
				$sRes .= $char_list{mt_rand(0, strlen($char_list) - 1)};
			return $sRes;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	/*
	* 乱数6桁
	*
	* @param
	* @access public
	* @return int
	*/
	public static function getRandomNum6(){
		return random_int(100000, 999999);
	}
	/*
	* 乱数2桁
	*
	* @param
	* @access public
	* @return int
	*/
	public static function getRandomNum2(){
		return random_int(0, 99);
	}
	/*
	* OpenSSL暗号化
	*
	* @param string
	* @access public
	* @return string
	*/
	public static function encrypt($string){
		try{
			$new_string = openssl_encrypt($string, 'AES-128-ECB', self::SECRET_KEY);
			return $new_string;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	/*
	* OpenSSL復号化
	*
	* @param string
	* @access public
	* @return string
	*/
	public static function decrypt($string){
		try{
			$new_string = openssl_decrypt($string, 'AES-128-ECB', self::SECRET_KEY);
			return $new_string;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	/*
	* ライフティDBパスワード暗号化
	*
	* @param string
	* @access public
	* @return string
	*/
	public static function encryptRyfetyPassword($string){
		try{
			$new_string = sha1($string);
			return $new_string;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
}
