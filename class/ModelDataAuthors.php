<?php
/**
* ModelDataAuthors
* 著者データ操作
* @package Model
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.0
*/
Class ModelDataAuthors extends CommonBase{
	/*
	* データ追加
	*
	* @param array
	* @access public
	* @return boolean
	*/
	public function insert($data_array){
		try{
			$data_array = $this->escapeSql($data_array);
			$sql = 'INSERT INTO '.
					'data_authors '.
				'SET '.
					' = "'.$data_array[''].'", '.
				';';
			if(!mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			return true;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	/*
	* データ更新
	*
	* @param array
	* @access public
	* @return boolean
	*/
	public function update($data_array){
		try{
			$data_array = $this->escapeSql($data_array);
			$sql = 'UPDATE '.
					'data_ '.
				'SET '.
					' = "'.$data_array[''].'", '.
				'WHERE '.
					'deleted=0 '.
				'AND	_id = "'.$data_array['_id'].'" '.
				'LIMIT 1;';
			if(!mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			return true;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	/*
	* データ取得
	*
	* @param int
	* @access public
	* @return array
	*/
	public function select1ById($author_id){
        	try {
			if(empty($author_id)) {
				return false;
			}
			$_id = $this->escapeSql($_id);
            		$sql = 'SELECT * FROM data_authors WHERE deleted=0 AND author_id="'.$author_id.'" LIMIT 1;';
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
			$sql = 'SELECT * FROM data_authors WHERE deleted=0;';
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
