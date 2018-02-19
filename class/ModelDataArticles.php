<?php
/**
* ModelDataArticles
* 記事データ操作
* @package Model
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 0.1
*/
Class ModelDataArticles extends CommonBase{
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
					'data_articles '.
				'SET '.
					'path = "'.$data_array['path'].'", '.
					'category_id = "'.$data_array['category_id'].'", '.
					'author_id = "'.$data_array['author_id'].'", '.
					'release_time = "'.$data_array['release_time'].'", '.
					'title = "'.$data_array['title'].'", '.
					'keyword = "'.$data_array['keyword'].'", '.
					'introduction = "'.$data_array['introduction'].'", '.
					'body = "'.$data_array['body'].'", '.
					'summary = "'.$data_array['summary'].'", '.
					'status = "'.$data_array['status'].'" '.
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
	public function select1ById($article_id){
        	try {
			if(!$article_id) {
				return false;
			}
			$article_id = $this->escapeSql($article_id);
            		$sql = 'SELECT * FROM data_articles WHERE deleted=0 AND article_id="'.$article_id.'" LIMIT 1;';
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
	* 複数データ取得
	*
	* @param string
	* @access public
	* @return array
	*/
	public function selectSome($where){
        	try {
			$where = $this->escapeSql($where);
            		$sql = 'SELECT '.
					'dar.article_id, '.
					'dar.path, '.
					'dar.release_time, '.
					'dar.title, '.
					'dar.introduction, '.
					'dau.name author_name, '.
					'mca.name_domain sub_domain, '.
					'mca.name category_name '.
				'FROM '.
					'data_articles dar, '.
					'master_categories mca, '.
					'data_authors dau '.
				'WHERE '.
					'dar.deleted=0 '.
				'AND dar.author_id=dau.author_id '.
				'AND dar.category_id=mca.category_id '.
				$where.';';
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
	* ワード検索
	*
	* @param string
	* @access public
	* @return array
	*/
	public function selectSomeByWord($word){
        	try {
			$word = $this->escapeSql($word);
            		$sql = 'SELECT '.
					'dar.article_id, '.
					'dar.path, '.
					'dar.release_time, '.
					'dar.title, '.
					'dar.introduction, '.
					'dau.name author_name, '.
					'mca.name_domain sub_domain, '.
					'mca.name category_name '.
				'FROM '.
					'data_articles dar, '.
					'master_categories mca, '.
					'data_authors dau '.
				'WHERE '.
					'dar.deleted=0 '.
				'AND dar.author_id=dau.author_id '.
				'AND dar.category_id=mca.category_id '.
				'AND dar.title like "%'.$word.'%" ;';
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
	* 全データ取得
	*
	* @param
	* @access public
	* @return array
	*/
	public function selectAll(){
		try{
			$sql = 'SELECT * FROM data_articles WHERE deleted=0;';
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
