<?php
/**
* ModelDataViews
* 閲覧データ操作
* @package Model
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.0
*/
Class ModelDataViews extends CommonBase{
	/*
	* データ追加
	*
	* @param int, date
	* @access public
	* @return boolean
	*/
	public function insert($article_id, $term){
		try{
			$article_id = $this->escapeSql($article_id);
			$term = $this->escapeSql($term);
			$sql = 'INSERT INTO '.
					'data_views '.
				'SET '.
					'article_id = "'.$article_id.'", '.
					'view = 1, '.
					'term = "'.$term.'" '.
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
	public function update($article_id, $term){
		try{
			$article_id = $this->escapeSql($article_id);
			$term = $this->escapeSql($term);
			$sql = 'UPDATE '.
					'data_views '.
				'SET '.
					'view = view+1 '.
				'WHERE '.
				'	article_id = "'.$article_id.'" '.
				'AND	term = "'.$term.'" '.
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
	* @return int
	*/
	public function select1ById($article_id, $term){
        	try {
			if(!$article_id || !$term) {
				return 0;
			}
			$article_id = $this->escapeSql($article_id);
			$term = $this->escapeSql($term);
            		$sql = 'SELECT view FROM data_views WHERE article_id="'.$article_id.'" AND term="'.$term.'" LIMIT 1;';
			if(!$result = mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			if(!mysqli_num_rows($result)){
				return 0;
			}
			$row = mysqli_fetch_assoc($result);
			return $row['view'];
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return 0;
		}
	}
	/*
	* 全データ取得（記事指定）
	*
	* @param int
	* @access public
	* @return array
	*/
	public function selectAllById($article_id){
		try{
			$article_id = $this->escapeSql($article_id);
			$sql = 'SELECT term, view FROM data_views WHERE article_id="'.$article_id.'";';
			if(!$result = mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			if(!mysqli_num_rows($result)){
				return false;
			}
			while($row = mysqli_fetch_assoc($result)){
				$data[$row['term']] = $row['view'];
			}
			return $data;
		} catch(Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	/*
	* 全データ取得（日付指定）
	*
	* @param string
	* @access public
	* @return array
	*/
	public function selectAllByTerm($term){
		try{
			$term = $this->escapeSql($term);
			$sql = 'SELECT article_id, view FROM data_views WHERE term="'.$term.'";';
			if(!$result = mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			if(!mysqli_num_rows($result)){
				return false;
			}
			while($row = mysqli_fetch_assoc($result)){
				$data[$row['article_id']] = $row['view'];
			}
			return $data;
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
			$sql = 'SELECT * FROM data_views;';
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

	/*
	* ユーザ向けランキング
	*
	* @param term
	* @access public
	* @return array
	*/
	public function getRankingForUser($term, $num){
		try{
			$term = $this->escapeSql($term);
			$num = $this->escapeSql($num);
			$sql = 'SELECT '.
					'dar.article_id, '.
					'dar.category_id, '.
					'dar.path, '.
					'dar.title '.
				'FROM '.
					'data_views dvi, '.
					'data_articles dar '.
				'WHERE '.
					'dvi.term="'.$term.'" '.
					'AND dar.article_id=dvi.article_id '.
					'AND dar.deleted=0 '.
					'AND dar.status=1 '.
				'ORDER BY dvi.view DESC, dar.release_time DESC LIMIT '.$num.';';
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
