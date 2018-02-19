<?php
/**
* CommonBase
* 共通クラス
* @package CommonBase
* @author Shunsuke Saruwatari
* @since PHP 7
* @version 1.0
*/
Class CommonBase {
	protected $link;//Mysql link Id
	/**
	* コンストラクタ
	*/
	public function __construct() {
		global $_COLLECT_CODE;      //一連の処理をまとめるグローバル関数
		$_COLLECT_CODE = Str::getRandom();
		try {
			//データベース接続
			if(!$this->connectDataBase()) {
				throw new Exception("false");
			}
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			die(); 
		}
	}
	/**
	* DBサーバ接続
	* @accsess protected
	* @return boolean
	*/
	protected function connectDataBase() {
		try {
			global $_LOG_CNT;
			$_LOG_CNT=0;
			if(!$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)) {
				throw new Exception('mysqli_error');
			}
			if(!mysqli_query($link, "SET NAMES 'utf8mb4'")) {
			//if(!mysqli_query($link, "SET NAMES 'utf8'")) {
				throw new Exception('mysqli_error');
			}
			$this->setDatabaseLink($link);
			return true;
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	/**
	* MysqlリンクIDを設定
	* @accsess protected
	* @param resorce $link MysqlリンクID
	*/
	protected function setDatabaseLink($link) {
		$this->link = $link;
	}
	/**
	* MysqlリンクIDを取得
	* @accsess public
	* @return resorce $link MysqlリンクID
	*/
	public function getDatabaseLink() {
		return $this->link;
	}
	/**
	* 配列にmysqli_real_escape_string
	* @accsess public
	* @return string, array
	*/
	protected function escapeSql($data){
		try {
			if(is_array($data)){
				foreach($data as $key => $value){
					$new_data_array[$this->escapeSql($key)] = $this->escapeSql($value);
				}
				return $new_data_array;
	    		} else {
				$new_data = mysqli_real_escape_string($this->getDatabaseLink(), $data);
				return $new_data;
			}
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	protected function begin(){
		try {
			//トランザクション開始
			if(!mysqli_query($this->getDatabaseLink(), 'begin;')){
				throw new Exception("トランザクションBEGIN失敗");
			}
			return true;
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	protected function commit(){
		try {
			//トランザクション完了
			if(!mysqli_query($this->getDatabaseLink(), 'commit;')){
				throw new Exception("トランザクションCOMMIT失敗");
			}
			return true;
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	protected function rollback(){
		try {
			//トランザクション完了
			if(!mysqli_query($this->getDatabaseLink(), 'rollback;')){
				throw new Exception("トランザクションROLLBACK失敗");
			}
			return true;
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
}
