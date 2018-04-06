<?php
/**
* ControllerAuthor
* 著者関連処理
* @package Controller
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.0
*/
Class ControllerAuthor extends CommonBase{
	/*
	* データ追加
	*
	* @param array
	* @access public
	* @return boolean
	*/
	private function add(){
		try{
			$insert_data = array();
			$insert_data['name'] = '';
			$insert_data['login_id'] = '';
			$insert_data['login_pass'] = '';
			$insert_data['login_auth'] = '';
			$insert_data['profile'] = '';

			$object_mdau = new ModelDataAuthors();
			if(!$author_id = $object_mdau->insert($insert_data)){
				throw new Exception();
			}

			//ファイル作成
			$sample_path = ROOT_DIRECTORY.'web/img/author/1.jpg';
			$full_path = ROOT_DIRECTORY.'web/img/author/'.$author_id.'.jpg';
			exec('cp '.$sample_path.' '.$full_path);

			header('location: /author/edit/?id='.$author_id);
			exit();
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* データ削除
	*
	* @param
	* @access public
	* @return boolean
	*/
	private function delete($article_id){
		try{
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->select1ById($article_id)){
				throw new Exception();
			}

			if(!$object_mdar->delete($article_id)){
				throw new Exception();
			}

			header('location: /view/');
			exit();
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			header('location: /view/');
			exit();
		}
	}

	/*
	* 1著者表示管理用
	*
	* @param
	* @access public
	* @return array
	*/
	public function show1DataByAdmin(){
		try{
			//値なし
			if(empty($_GET['id'])) {
				$this->add();
				exit();
			}

			$object_mdau = new ModelDataAuthors();
			if(!$author_data = $object_mdau->select1ById($_GET['id'])){
				throw new Exception();
			}
/*
			if(!empty($_GET['delete'])) {
				$this->delete($_GET['id']);
				exit();
			}
*/
			if (empty($_POST)) {
				return $author_data;
			}

			$update_data['author_id'] = $author_data['author_id'];
			$update_data['name'] = $_POST['name'];
			$update_data['profile'] = $_POST['profile'];

			if(empty($update_data['name'])) {
				$update_data['error'] = "名前を入力してください。";
				return $update_data;
			}

			if(!$object_mdau->update($update_data)){
				$update_data['error'] = "保存に失敗しました。";
				return $update_data;
			}

			header('location: /author/');
			exit();
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}


	/*
	* 全著者表示管理用
	*
	* @param
	* @access public
	* @return array
	*/
	public function showAllByAdmin(){
		try{
			$object_mdau = new ModelDataAuthors();
			if(!$author_data = $object_mdau->selectAll()){
				throw new Exception();
			}
			return $author_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* 公開状態切替
	*
	* @param
	* @access public
	* @return boolean
	*/
	public function switchStatus(){
		try{
			if(!$_GET['i'] || !$_GET['r']) {
				return false;
			}
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->select1ById($_GET['i'])){
				return false;
			}
			if($article_data['status']!=1 && $_GET['r']==1) {
				$status=1; // 下書き、非公開=>公開
			} else if($article_data['status']==1 && $_GET['r']==2) {
				$status=2; // 公開=>非公開
			} else {
				return false; //変わらない
			}
			if(!$object_mdar->switchStatus($article_data['article_id'], $status, $release_time)){
				return false;
			}

			return true;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* 画像アップロード後のディレクトリ移動
	*
	* @param
	* @access public
	* @return
	*/
	public function moveFile(){
		try{
			if(empty($old_name=$_GET['oldname']) || empty($new_name=$_GET['newname'])) {
				return false;
			}

			if(strpos($oldname,' ') !== false){
				// 作成したファイル名内にスペースがあったらlinuxコマンドが実行できない
				return false;
			}

			$old_path = ROOT_DIRECTORY.'admin/jquery_file_upload/server/php/files/'.$old_name;
			$new_path = ROOT_DIRECTORY.'web/img/author/'.$new_name;
			exec('mv '.$old_path.' '.$new_path);
	
			return true;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

}
