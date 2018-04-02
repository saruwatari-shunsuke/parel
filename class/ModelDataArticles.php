<?php
/**
* ModelDataArticles
* 記事データ操作
* @package Model
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.1
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
					'description = "'.$data_array['description'].'", '.
					'keyword = "'.$data_array['keyword'].'", '.
					'introduction = "'.$data_array['introduction'].'", '.
					'body = "'.$data_array['body'].'", '.
					'summary = "'.$data_array['summary'].'", '.
					'status = "'.$data_array['status'].'" '.
				';';
			if(!mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			$article_id = mysqli_insert_id($this->getDatabaseLink());
			return $article_id;
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
					'data_articles '.
				'SET '.
					'path = "'.$data_array['path'].'", '.
					'category_id = "'.$data_array['category_id'].'", '.
					'author_id = "'.$data_array['author_id'].'", '.
					'title = "'.$data_array['title'].'", '.
					'description = "'.$data_array['description'].'", '.
					'keyword = "'.$data_array['keyword'].'", '.
					'introduction = "'.$data_array['introduction'].'", '.
					'body = "'.$data_array['body'].'", '.
					'summary = "'.$data_array['summary'].'" '.
				'WHERE '.
					'deleted=0 '.
				'AND	article_id = "'.$data_array['article_id'].'" '.
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
	* 削除
	*
	* @param int
	* @access public
	* @return boolean
	*/
	public function delete($article_id){
		try{
			$article_id = $this->escapeSql($article_id);

			$sql = 'UPDATE '.
					'data_articles '.
				'SET '.
					"deleted=1 ".
				'WHERE '.
					'deleted=0 '.
				'AND    article_id = "'.$article_id.'" '.
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
	* 公開状態切替
	*
	* @param int, int
	* @access public
	* @return boolean
	*/
	public function switchStatus($article_id, $status, $release_time){
		try{
			$article_id = $this->escapeSql($article_id);
			$status = $this->escapeSql($status);
			$release_time = $this->escapeSql($release_time);
			$now = date("Y-m-d H:i:s");

			$sql = 'UPDATE '.
					'data_articles '.
				'SET '.
					"release_time='".$release_time."',".
					"updated='".$now."',".
					'status = "'.$status.'" '.
				'WHERE '.
					'deleted=0 '.
				'AND    article_id = "'.$article_id.'" '.
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
					'dar.category_id, '.
					'dar.release_time, '.
					'dar.title, '.
					'dar.description, '.
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
	public function selectSomeByWord($words){
        	try {
			$words = $this->escapeSql($words);
			$where = '';
			foreach ($words as $key => $value) {
				if($value) {
					$where .= 'AND (dar.title like "%'.$value.'%" '.
							'OR dar.introduction like "%'.$value.'%" '.
							'OR dar.body like "%'.$value.'%" '.
							'OR dar.summary like "%'.$value.'%") ';
				}
			}

            		$sql = 'SELECT '.
					'dar.article_id, '.
					'dar.path, '.
					'dar.category_id, '.
					'dar.release_time, '.
					'dar.title, '.
					'dar.description, '.
					'dau.name author_name, '.
					'mca.name_domain sub_domain, '.
					'mca.name category_name '.
				'FROM '.
					'data_articles dar, '.
					'master_categories mca, '.
					'data_authors dau '.
				'WHERE '.
					'dar.deleted=0 '.
				'AND dar.status=1 '.
				'AND dar.author_id=dau.author_id '.
				'AND dar.category_id=mca.category_id '.
				$where.
				'ORDER BY release_time DESC;';
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
	* URL重複確認
	*
	* @param string
	* @access public
	* @return boolean
	*/
	public function isNewPath($path){
        	try {
			if(empty($path)){
				return false;
			}
			$path = $this->escapeSql($path);
            		$sql = 'SELECT '.
					'article_id '.
				'FROM '.
					'data_articles '.
				'WHERE '.
					'deleted=0 '.
				'AND path="'.$path.'" '.
				'LIMIT 1;';
			if(!$result = mysqli_query($this->getDatabaseLink(), $sql)){
				throw new Exception(mysqli_error($this->getDatabaseLink()).$sql);
			}
			if(mysqli_num_rows($result)){
				return false;
			}
			return true;
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
	public function selectAllByAdmin($words){
		try{
			$words = $this->escapeSql($words);
			$where = '';
			foreach ($words as $key => $value) {
				if($value) {
					$where .= 'AND (dar.title like "%'.$value.'%" '.
							'OR dar.introduction like "%'.$value.'%" '.
							'OR dar.body like "%'.$value.'%" '.
							'OR dar.summary like "%'.$value.'%") ';
				}
			}

			$sql = 'SELECT * FROM data_articles dar WHERE dar.deleted=0 '.$where.'ORDER BY dar.release_time DESC;';
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
