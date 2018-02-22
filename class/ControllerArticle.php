<?php
/**
* ControllerArticle
* 記事関連処理
* @package Controller
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 0.1
*/
Class ControllerArticle extends CommonBase{
	/*
	* データ追加
	*
	* @param array
	* @access public
	* @return boolean
	*/
	public function add(){
		try{
			//値なし
			if(!$_POST) {
				return "";
			}

			if(empty($_POST['path'])) {
				return "URLを入力してください。";
			}
			if($path_error = $this->isPathAvairable($_POST['path'])) {
				return $path_error;
			}
			if(empty($_POST['category'])) {
				return "カテゴリを選択してください。";
			}
			if(empty($_POST['author'])) {
				return "著者を選択してください。";
			}
			if(empty($_POST['release'])) {
				return "公開日時を入力してください。";
			}

			$insert_data = array();
			$insert_data['path'] = $_POST['path'];
			$insert_data['category_id'] = $_POST['category'];
			$insert_data['author_id'] = $_POST['author'];
			$insert_data['release_time'] = $_POST['release'];
			$insert_data['title'] = $_POST['title'];
			$insert_data['keyword'] = $_POST['keyword'];

			$insert_data['introduction'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['introduction']);
			$insert_data['body'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['body']);
			$insert_data['summary'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['summary']);

			$insert_data['status'] = $_POST['status'];

			$object_mdar = new ModelDataArticles();
			if(!$article_id = $object_mdar->insert($insert_data)){
				throw new Exception();
			}

			//ファイル作成
			$full_path = ROOT_DIRECTORY.'web/'.$insert_data['path'];
			exec('mkdir '.$full_path);
			$fp = fopen($full_path.'/index.php', "a");
			$code = "<?php\n".
				"require_once(dirname(__FILE__).'/../../conf/ini.php');\n".
				"new ViewUserArticle($article_id);";
			fwrite($fp, $code);
			fclose($fp);

			header('location: /admin/view/');
			exit();

		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return "投稿に失敗しました。";
		}
	}

	/*
	* 1記事表示
	*
	* @param int
	* @access public
	* @return array
	*/
	public function show1DataByUser($article_id){
		try{
			//値なし
			if(empty($article_id)) {
				return false;
			}
	
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->select1ById($article_id)){
				throw new Exception();
			}
			if(!$article_data['status']) {//非公開
				return false;
			}

			$object_mdau = new ModelDataAuthors();
			if(!$author_data = $object_mdau->select1ById($article_data['author_id'])){
				throw new Exception();
			}

			$article_data['author_name'] = $author_data['name'];
			$article_data['author_image'] = '/img/common/'.$author_data['image'];
			$article_data['author_profile'] = $author_data['profile'];

			$object_mmca = new ModelMasterCategories();
			if(!$category_data = $object_mmca->select1ById($article_data['category_id'])){
				throw new Exception();
			}
			$article_data['category_name'] = $category_data['name'];

			$article_data['description'] = strip_tags($article_data['introduction']); //タグ外し
			$article_data['description'] = str_replace("\n", "", $article_data['description']); //改行除去

			$article_data['introduction'] = nl2br($article_data['introduction']);
			$article_data['body'] = nl2br($article_data['body']);
			$article_data['summary'] = nl2br($article_data['summary']);

			$article_data['url'] = MAIN_URL.$article_data['path'].'/';
			$article_data['related'] = $this->getRelated($article_data['article_id'], $article_data['category_id']);

			return $article_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}


	/*
	* 1記事表示管理用
	*
	* @param
	* @access public
	* @return array
	*/
	public function show1DataByAdmin(){
		try{
			//値なし
			if(empty($_GET['id'])) {
				header('location: /admin/view/');
				exit();
			}

			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->select1ById($_GET['id'])){
				throw new Exception();
			}
	
			if (empty($_POST)) {
				return $article_data;
			}

			$update_data['article_id'] = $article_data['article_id'];
			$update_data['path'] = $_POST['path'];
			$update_data['category_id'] = $_POST['category'];
			$update_data['author_id'] = $_POST['author'];
			$update_data['release_time'] = $_POST['release'];
			$update_data['title'] = $_POST['title'];
			$update_data['keyword'] = $_POST['keyword'];

			$update_data['introduction'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['introduction']);
			$update_data['body'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['body']);
			$update_data['summary'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['summary']);

			$update_data['status'] = $_POST['status'];

			if(empty($update_data['path'])) {
				$update_data['error'] = "URLを入力してください。";
				return $update_data;
			}
			if($update_data['path']!=$article_data['path']) {//path変更時
				if($path_error = $this->isPathAvairable($_POST['path'])) {
					$update_data['error'] = $path_error;
					return $update_data;
				}
			}
			if(empty($update_data['category_id'])) {
				$update_data['error'] = "カテゴリを選択してください。";
				return $update_data;
			}
			if(empty($update_data['author_id'])) {
				$update_data['error'] = "著者を選択してください。";
				return $update_data;
			}
			if(empty($update_data['release_time'])) {
				$update_data['error'] = "公開日時を入力してください。";
				return $update_data;
			}

			if(!$object_mdar->update($update_data)){
				$update_data['error'] = "保存に失敗しました。";
				return $update_data;
			}

			if($update_data['path']!=$article_data['path']) {//path変更時
				//ファイル移動
				$old_path = ROOT_DIRECTORY.'web/'.$article_data['path'];
				$new_path = ROOT_DIRECTORY.'web/'.$update_data['path'];
				exec('mv '.$old_path.' '.$new_path);
			}

			header('location: /admin/view/');
			exit();
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}


	/*
	* 全記事表示管理用
	*
	* @param
	* @access public
	* @return array
	*/
	public function showAllByAdmin(){
		try{
			$object_mdar = new ModelDataArticles();

			if(!$article_data = $object_mdar->selectAll()){
				throw new Exception();
			}

			foreach ($article_data as $key => $value) {
				$article_data[$key]['introduction'] = mb_substr($value['introduction'], 0, 5);
				$article_data[$key]['body'] = mb_substr($value['body'], 0, 5);
				$article_data[$key]['summary'] = mb_substr($value['summary'], 0, 5);
			}

			return $article_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* 全記事表示ユーザ用
	*
	* @param
	* @access public
	* @return array
	*/
	public function showAllByUser(){
		try{
			if($search=$_GET['s']) {
				CreateLog::putDebugLog('search word :'.$search);
				$object_mdar = new ModelDataArticles();
				if(!$article_data = $object_mdar->selectSomeByWord($search)){
					throw new Exception();
				}
				return $article_data;
			}
			

			if($category_id=$_GET['c']) {
				$where = 'AND dar.status=1 AND dar.category_id='.$category_id.' ORDER BY dar.release_time DESC';
			} else {
				$where = 'AND dar.status=1 ORDER BY dar.release_time DESC';
			}

			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->selectSome($where)){
				throw new Exception();
			}

			return $article_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* レコメンド記事
	*
	* @param
	* @access public
	* @return array
	*/
	public function getRecommend(){
		try{
			$setting_data = parse_ini_file(SETTING_DIRECTORY.'recommend.ini');
			$where = 'AND dar.status=1 AND dar.article_id IN ('.$setting_data['recommend'].')';
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->selectSome($where)){
				return false;
			}
			return $article_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* 編集部おすすめ記事
	*
	* @param
	* @access public
	* @return array
	*/
	public function getMyFavolite(){
		try{
			$setting_data = parse_ini_file(SETTING_DIRECTORY.'myfavolite.ini');
			$where = 'AND dar.status=1 AND dar.article_id IN ('.$setting_data['my_favolite'].') ORDER BY dar.release_time DESC';
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->selectSome($where)){
				return false;
			}
			return $article_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* 関連記事
	*
	* @param int
	* @access private
	* @return array
	*/
	private function getRelated($article_id, $category_id){
		try{
			$setting_data = parse_ini_file(SETTING_DIRECTORY.'related.ini');
			$object_mdar = new ModelDataArticles();

			//最新記事XX件
			$where = 'AND dar.status=1 AND dar.article_id<>'.$article_id.' ORDER BY dar.release_time DESC LIMIT '.$setting_data['related_latest_posted_quantity'];
			$article_data[$setting_data['related_latest_posted_priority']] = $object_mdar->selectSome($where);

			//被らないようにする
			$where_not = '';
			foreach ($article_data[$setting_data['related_latest_posted_priority']] as $key => $value) {
				$where_not .= 'AND dar.article_id<>'.$value['article_id'].' ';
			}

			//同カテゴリランダムXX件
			$where = $where_not.'AND dar.status=1 AND dar.article_id<>'.$article_id.' AND dar.category_id='.$category_id.' ORDER BY RAND() LIMIT '.$setting_data['related_same_category_quantity'];
			$article_data[$setting_data['related_same_category_priority']] = $object_mdar->selectSome($where);

			//別カテゴリランダムXX件
			$where = $where_not.'AND dar.status=1 AND dar.category_id<>'.$category_id.' ORDER BY RAND() LIMIT '.$setting_data['related_different_category_quantity'];
			$article_data[$setting_data['related_different_category_priority']] = $object_mdar->selectSome($where);

			//article_idだけをORDER BY RAND()で検索して、後で他カラムをID指定で取得するとさらに検索が速くなるらしい

			$num = 0;
			for ($i=1; $i<=3; $i++) {
				foreach ($article_data[$i] as $key2 => $value2) {
					$related_data[$num] = $value2;
					$tmp = strip_tags($value2['introduction']); //タグ外し
                                        $related_data[$num]['description'] = str_replace("\n", "", $tmp); //改行除去
                                        $related_data[$num]['release_time'] = date('Y年n月j日', strtotime($value2['release_time']));
					$num++;
				}
			}

			return $related_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* path確認
	*
	* @param string
	* @access private
	* @return string
	*/
	private function isPathAvairable($path){
		try{
			if(empty($path)){
				return 'URLを入力してください。';
			}
			$ng_symbols = array('!', '"', '#', '$', '%', '&', '\'', '(', ')', '=', '~', '^', '|', '\\', '{', '}', '[', ']', ':', '*', ';', '+', '<', '>', '?', ',', '.', '/');
			foreach($ng_symbols as $key => $value) {
				if(strpos($path, $value) !== false){
					return 'URLに不正な文字があります。';
				}
			}
			$ng_directories = array('admin', 'css', 'img', 'js', 'ranking', 'terms');
			foreach($ng_directories as $key => $value) {
				if($value==$path){
					return 'そのURLは利用できません。';
				}
			}
			$object_mdar = new ModelDataArticles();
			if(!$object_mdar->isNewPath($path)){
				return 'そのURLは既に利用されています。';
			}
	
			return '';
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return 'そのURLは利用できません。';
		}
	}



}
