<?php
/**
* ModelMasterCategories
* カテゴリデータ操作
* @package Model
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.0
*/
Class ModelMasterCategories extends CommonBase{
	/*
	* データ取得
	*
	* @param int
	* @access public
	* @return array
	*/
	public function select1ById($category_id){
        	try {
			if(!$category_id) {
				return false;
			}
			$category_id = $this->escapeSql($category_id);
            		$sql = 'SELECT * FROM master_categories WHERE category_id="'.$category_id.'" LIMIT 1;';
			if(!$result = mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			if(!mysqli_num_rows($result)){
				return false;
			}
			$row = mysqli_fetch_assoc($result);
			return $row;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	/*
	* 全データ取得
	*
	* @param
	* @access public
	* @return array
	*/
	public function selectAll(){
		try{
			$sql = 'SELECT * FROM data_ WHERE deleted=0;';
			if(!$result = mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			if(!mysqli_num_rows($result)){
				return false;
			}
			while($row = mysqli_fetch_assoc($result)){
				$data[] = $row;
			}
			return $data;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
}
