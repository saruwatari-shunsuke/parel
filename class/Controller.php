<?php
/**
* Controller
* コントローラテンプレート
* @package Controller
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.0
*/
Class Controller extends CommonBase{
	/*
	* データ追加
	*
	* @param array
	* @access public
	* @return boolean
	*/
	public function xxxx(){
		try{
			$object_mxx = new Modelxxxx();

			//値なし
			if(!isset($_POST['xxxx'])) {
				return false;
			}
			$xxxx = $_POST['xxxx'];

			if(!$yyyy = $object_mxx->xxx($xxxx)){
				throw new Exception();
			}

			return $yyyy;

		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

}
