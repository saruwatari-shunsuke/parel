<?php
/**
* ControllerArticle
* 記事関連処理
* @package Controller
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.4
*/
Class ControllerArticle extends CommonBase{
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
			$insert_data['path'] = date('YmdHis');
			$insert_data['category_id'] = 6;
			$insert_data['author_id'] = 1;
			$insert_data['release_time'] = date('Y-m-d H:i:s');
			$insert_data['title'] = '';
			$insert_data['description'] = '';
			$insert_data['keyword'] = '';
			$insert_data['introduction'] = '';
			$insert_data['body'] = '';
			$insert_data['summary'] = '';
			$insert_data['status'] = 0;

			$object_mdar = new ModelDataArticles();
			if(!$article_id = $object_mdar->insert($insert_data)){
				throw new Exception();
			}

			//ファイル作成
			$sample_path = ROOT_DIRECTORY.'admin/default_article';
			$full_path = ROOT_DIRECTORY.'admin/'.$insert_data['path'];
			exec('cp -a '.$sample_path.' '.$full_path);

			$fp1 = fopen($full_path.'/index.php', "a");
			fwrite($fp1, "new ViewUserArticle($article_id);");
			fclose($fp1);

			$fp2 = fopen($full_path.'/amp/index.php', "a");
			fwrite($fp2, "new ViewUserArticleAmp($article_id);");
			fclose($fp2);

			header('location: /edit/?id='.$article_id);
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

			//ファイル移動
			if($article_data['category_id']==6){
				$old_path = ROOT_DIRECTORY.'admin/'.$article_data['path'];
			} else {
				$old_path = ROOT_DIRECTORY.'category'.$article_data['category_id'].'/'.$article_data['path'];
			}
			$new_path = ROOT_DIRECTORY.'admin/trash/'.$article_id;
			exec('mv '.$old_path.' '.$new_path);
	
			header('location: /view/');
			exit();
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			header('location: /view/');
			exit();
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

			$object_mdau = new ModelDataAuthors();
			if(!$author_data = $object_mdau->select1ById($article_data['author_id'])){
				throw new Exception();
			}

			$article_data['author_name'] = $author_data['name'];
			$article_data['author_image'] = MAIN_URL.'img/author/'.$author_data['author_id'].'.jpg';
			$article_data['author_profile'] = $author_data['profile'];

			$object_mmca = new ModelMasterCategories();
			if(!$category_data = $object_mmca->select1ById($article_data['category_id'])){
				throw new Exception();
			}
			$article_data['category_name'] = $category_data['name'];

			$article_data['introduction'] = nl2br($article_data['introduction']);
			$article_data['introduction'] = str_replace('<img ', '<img alt="'.$article_data['title'].'" ', $article_data['introduction']);
			$article_data['body'] = preg_replace('/(<table.*?>|<tr.*?>|<\/tr>|<\/th>|<\/td>)\s*\n*/', '$1', $article_data['body']);
			$article_data['body'] = nl2br($article_data['body']);
			$article_data['body'] = str_replace('<img ', '<img alt="'.$article_data['title'].'" ', $article_data['body']);
			$article_data['summary'] = nl2br($article_data['summary']);
			$article_data['summary'] = str_replace('<img ', '<img alt="'.$article_data['title'].'" ', $article_data['summary']);

			$article_data['url'] = CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/';
			$article_data['related'] = $this->getRelated($article_data['article_id'], $article_data['category_id']);

			return $article_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			header('location: '.MAIN_URL.'404/');
			exit();
		}
	}

	/*
	* 1記事表示（AMP版）
	*
	* @param int
	* @access public
	* @return array
	*/
	public function show1DataAmpByUser($article_id){
		try{
			//値なし
			if(empty($article_id)) {
				return false;
			}
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->select1ById($article_id)){
				throw new Exception();
			}

			$object_mdau = new ModelDataAuthors();
			if(!$author_data = $object_mdau->select1ById($article_data['author_id'])){
				throw new Exception();
			}

			$article_data['author_name'] = $author_data['name'];
			$article_data['author_image'] = MAIN_URL.'img/author/'.$author_data['author_id'].'.jpg';
			$article_data['author_profile'] = $author_data['profile'];

			$object_mmca = new ModelMasterCategories();
			if(!$category_data = $object_mmca->select1ById($article_data['category_id'])){
				throw new Exception();
			}
			$article_data['category_name'] = $category_data['name'];

			$article_data['introduction'] = $this->replaceAmpText($article_data['introduction']);
			$article_data['body'] = $this->replaceAmpText($article_data['body']);
			$article_data['summary'] = $this->replaceAmpText($article_data['summary']);

			$article_data['url'] = CATEGORY_URL[$article_data['category_id']].$article_data['path'].'/';
			$article_data['related'] = $this->getRelated($article_data['article_id'], $article_data['category_id']);

			return $article_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			header('location: '.MAIN_URL.'404/');
			exit();
		}
	}

	/*
	* 1記事表示（AMP版）
	*
	* @param int
	* @access public
	* @return array
	*/
	private function replaceAmpText($text){
		try{
			// instagramのamp化
			$text = preg_replace('/<blockquote class="instagram-media".+?"https:\/\/www\.instagram\.com\/p\/(.+?)\/".+?<\/blockquote>/is',
						'<amp-instagram layout="responsive" data-shortcode="$1" width="400" height="400" ></amp-instagram>',
						$text);

			// youtubeのamp化
			$text = preg_replace('/<iframe[^>]+?src="https:\/\/www\.youtube\.com\/embed\/(.+?)(\?feature=oembed)?".*?><\/iframe>/is',
						'<amp-youtube layout="responsive" data-videoid="$1" width="480" height="270"></amp-youtube>',
						$text);

			// タグを消す
			$text = strip_tags($text, '<a><img><h3><h4><h5><h6><strong><table><tr><th><td><amp-instagram><amp-youtube>');

			// table内改行除去
			$text = preg_replace('/(<table.*?>|<tr.*?>|<\/tr>|<\/th>|<\/td>)\s*\n*/', '$1', $text);

			// imgのamp化
			$text = preg_replace('/<img\s(.*?)\/?>/', '<amp-img $1 layout="fixed-height" height="500"></amp-img>', $text);

			// レシピサイト「Nadia」埋め込みパーツのamp化
			// コメント吹き出し画像の縮小
			$text = preg_replace('/<amp-img .*?src="https:\/\/cdn.oceans-nadia.com\/images\/user_data\/packages\/default\/add\/img\/detail\/blogParts\/comment_icon\.gif".*?><\/amp-img>/',
						'<amp-img src="https://cdn.oceans-nadia.com/images/user_data/packages/default/add/img/detail/blogParts/comment_icon.gif" width="12" height="11"></amp-img>',
						$text);
			// 料理以外の画像削除
			$text = preg_replace('/(?!<a .*?href="https:\/\/oceans-nadia.com\/.*?".*?>.*save_image.*<\/a>)<a .*?href="https:\/\/oceans-nadia.com\/.*?">.*?<\/a>/', '', $text);

			// style削除
			$text = preg_replace('/style=".+?"/', '', $text);

			// ampサイトのURLの都合上、画像の相対パスを1階層上へ
			$text = preg_replace('/src="(?!\/)(?!http:\/\/)(?!https:\/\/)(.+?)"/', 'src="../$1"', $text);

			// ampサイトのURLの都合上、URLの相対パスを1階層上へ
			$text = preg_replace('/href="(?!\/)(?!http:\/\/)(?!https:\/\/)(.+?)"/', 'href="../$1"', $text);

			// 改行を<br>に変換
			$text = nl2br($text);

			return $text;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			exit();
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
				$this->add();
				exit();
			}

			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->select1ById($_GET['id'])){
				throw new Exception();
			}

			if(!empty($_GET['delete'])) {
				$this->delete($_GET['id']);
				exit();
			}

			if (empty($_POST)) {
				return $article_data;
			}

			$update_data['article_id'] = $article_data['article_id'];
			$update_data['path'] = $_POST['path'];
			$update_data['category_id'] = ($_POST['category']) ? $_POST['category'] : 6;
			$update_data['author_id'] = $_POST['author'];
			$update_data['title'] = h($_POST['title']);
			$update_data['description'] = h($_POST['description']);
			$update_data['keyword'] = h($_POST['keyword']);

			$update_data['introduction'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['introduction']);
			$update_data['body'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['body']);
			$update_data['summary'] = str_replace(array("\r\n","\r","\n"), "\n", $_POST['summary']);

			if(empty($update_data['path'])) {
				$update_data['error'] = "URLを入力してください。";
				return $update_data;
			}
			if($update_data['category_id']!=$article_data['category_id'] || $update_data['path']!=$article_data['path']) {//URL変更時
				if($path_error = $this->isPathAvairable($update_data['category_id'], $update_data['path'])) {
					$update_data['error'] = $path_error;
					return $update_data;
				}
			}
			if(empty($update_data['category_id'])) {
				$update_data['error'] = "カテゴリを選択してください。";
				return $update_data;
			}

			if(!$object_mdar->update($update_data)){
				$update_data['error'] = "保存に失敗しました。";
				return $update_data;
			}

			if($update_data['category_id']!=$article_data['category_id'] || $update_data['path']!=$article_data['path']) {//URL変更時
				//ファイル移動
				if($article_data['category_id']==6){
					$old_path = ROOT_DIRECTORY.'admin/'.$article_data['path'];
				} else {
					$old_path = ROOT_DIRECTORY.'category'.$article_data['category_id'].'/'.$article_data['path'];
				}
				if($update_data['category_id']==6){
					$new_path = ROOT_DIRECTORY.'admin/'.$update_data['path'];
				} else {
					$new_path = ROOT_DIRECTORY.'category'.$update_data['category_id'].'/'.$update_data['path'];
				}
				exec('mv '.$old_path.' '.$new_path);
			}

			$this->exportSitemaps();

			header('location: /view/');
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
			if($search=$_GET['s']) {
				$search = mb_convert_kana($search, 's');
				$object_mdar = new ModelDataArticles();
				$search_array = explode(' ', $search);
				if(!$article_data = $object_mdar->selectAllByAdmin($search_array)){
					throw new Exception();
				}
				return $article_data;
			}

			$object_mdar = new ModelDataArticles();

			if(!$article_data = $object_mdar->selectAllByAdmin()){
				throw new Exception();
			}

			foreach ($article_data as $key => $value) {
				if($value['release_time']<date('Y-01-01')) {
					$article_data[$key]['release_time'] = date('Y/n/j', strtotime($value['release_time']));
				} else {
					$article_data[$key]['release_time'] = date('n月j日', strtotime($value['release_time']));
				}
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
	public function showAllByUser($category_id){
		try{
			if($search=$_GET['s']) {
				CreateLog::putDebugLog('search word :'.$search);
				$search = mb_convert_kana($search, 's');
				$object_mdar = new ModelDataArticles();
				$search_array = explode(' ', $search);
				if(!$article_data = $object_mdar->selectSomeByWord($search_array)){
					throw new Exception();
				}
				return $article_data;
			}

			if($category_id) {
				$where = 'AND dar.status=1 AND dar.category_id='.$category_id.' ORDER BY dar.release_time DESC';
			} else if($author_id=$_GET['a']) {
				$where = 'AND dar.status=1 AND dar.author_id='.$author_id.' ORDER BY dar.release_time DESC';
			} else  {
				//$setting_data = parse_ini_file(SETTING_DIRECTORY.'recommend.ini');
				$where = 'AND dar.status=1 ORDER BY dar.release_time DESC LIMIT 1000 OFFSET 3';
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
			//$setting_data = parse_ini_file(SETTING_DIRECTORY.'recommend.ini');
			//$where = 'AND dar.status=1 AND dar.article_id IN ('.$setting_data['recommend'].') ORDER BY release_time DESC';
			$where = 'AND dar.status=1 ORDER BY release_time DESC LIMIT 3';

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
	public function getMyFavolite($eject_data){
		try{
			$where_not = '';
			if($eject_data) {
				$where_not .= 'AND article_id<>'.$eject_data['article_id'].' ';
				foreach($eject_data['related'] as $key => $value) {
					$where_not .= 'AND article_id<>'.$value['article_id'].' ';
				}
			}
			//被らないようにする
			$object_cvi = new ControllerView();
			$ranking_data = $object_cvi->getDailyRanking(5);
			foreach ($ranking_data as $key2 => $value2) {
				$where_not .= 'AND dar.article_id<>'.$value2['article_id'].' ';
			}

			$setting_data = parse_ini_file(SETTING_DIRECTORY.'myfavolite.ini');
			$where = 'AND dar.status=1 AND dar.article_id IN ('.$setting_data['my_favolite'].') '.$where_not.'ORDER BY dar.release_time DESC LIMIT 6';
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
	public function getMyFavoliteForAdmin(){
		try{
			if($_POST['myfavolite']) {
				$text = "[setting]\n".
					"my_favolite = ".implode(',', $_POST['myfavolite'])."\n";
				$handle = fopen(SETTING_DIRECTORY.'myfavolite.ini', "w");
				@fwrite($handle, $text);
				fclose($handle);
			}

			$myfavolite = parse_ini_file(SETTING_DIRECTORY.'myfavolite.ini');
			$myfavolite_data = explode(',', $myfavolite['my_favolite']);
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->selectAllByAdmin()){
				throw new Exception();
			}

			foreach ($article_data as $key => $value) {
				if($value['release_time']<date('Y-01-01')) {
					$article_data[$key]['release_time'] = date('Y/n/j', strtotime($value['release_time']));
				} else {
					$article_data[$key]['release_time'] = date('n月j日', strtotime($value['release_time']));
				}

				foreach($myfavolite_data as $key2 => $value2){
					if ($value2==$value['article_id']) {
						$article_data[$key]['myfavolite'] = 1;
					}
				}
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

			//被らないようにする
			$object_cvi = new ControllerView();
			$ranking_data = $object_cvi->getDailyRanking(5);
			$where_not = '';
			foreach ($ranking_data as $key => $value) {
				$where_not .= 'AND dar.article_id<>'.$value['article_id'].' ';
			}

			//最新記事XX件
			$where = $where_not.'AND dar.status=1 AND dar.article_id<>'.$article_id.' ORDER BY dar.release_time DESC LIMIT '.$setting_data['related_latest_posted_quantity'];
			$article_data[$setting_data['related_latest_posted_priority']] = $object_mdar->selectSome($where);

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
			if($article_data['status']==0){ // 初公開
				$release_time = date('Y-m-d H:i:s');
			} else {
				$release_time = $article_data['release_time'];
			}
			if(!$object_mdar->switchStatus($article_data['article_id'], $status, $release_time)){
				return false;
			}

			$this->exportSitemaps();

			return true;
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
	private function isPathAvairable($category_id, $path){
		try{
			if(empty($category_id) || empty($path)){
				return 'URLを入力してください。';
			}
			$ng_symbols = array(' ', '!', '"', '#', '$', '%', '&', '\'', '(', ')', '=', '~', '^', '|', '\\', '@', '{', '}', '[', ']', ':', '*', ';', '+', '<', '>', '?', ',', '.', '/');
			foreach($ng_symbols as $key => $value) {
				if(strpos($path, $value) !== false){
					return 'URLに不正な文字があります。';
				}
			}
			$ng_directories = array('author', 'css', 'default_article', 'edit', 'img', 'jquery_file_upload', 'js', 'log', 'myfavolite', 'trash', 'view');
			foreach($ng_directories as $key => $value) {
				if($value==$path){
					return 'そのURLは利用できません。';
				}
			}
			$object_mdar = new ModelDataArticles();
			if(!$object_mdar->isNewPath($category_id, $path)){
				return 'そのURLは既に利用されています。';
			}
	
			return '';
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return 'そのURLは利用できません。';
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
			if(empty($category=$_GET['category']) || empty($path=$_GET['path']) || empty($old_name=$_GET['oldname']) || empty($new_name=$_GET['newname'])) {
				return false;
			}

			if(strpos($oldname,' ') !== false){
				// 作成したファイル名内にスペースがあったらlinuxコマンドが実行できない
				return false;
			}

			$old_path = ROOT_DIRECTORY.'admin/jquery_file_upload/server/php/files/'.$old_name;
			if($category==6){
				$new_path = ROOT_DIRECTORY.'admin/'.$path.'/'.$new_name;
			} else {
				$new_path = ROOT_DIRECTORY.'category'.$category.'/'.$path.'/'.$new_name;
			}
			exec('mv '.$old_path.' '.$new_path);
	
			return true;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* XMLサイトマップ作成
	*
	* @param
	* @access public
	* @return boolean
	*/
	private function exportSitemaps(){
		try{
			$object_mdar = new ModelDataArticles();
			for($category_id=1; $category_id<=5; $category_id++){
				$where = 'AND dar.status=1 AND dar.category_id='.$category_id;

				if(!$article_data = $object_mdar->selectSome($where)){
					return false;
				}

				$fp = fopen(ROOT_DIRECTORY.'category'.$category_id.'/sitemap.xml', "w");
				fwrite($fp, '<?xml version="1.0" encoding="UTF-8"?>'."\n");
				fwrite($fp, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">'."\n");
				fwrite($fp, "<url>\n  <loc>".CATEGORY_URL[$category_id]."</loc>\n  <priority>1.0</priority>\n  <changefreq>daily</changefreq>\n  </url>\n");

				foreach ($article_data as $key => $value) {
					$code = "<url>\n  <loc>".CATEGORY_URL[$category_id].$value['path']."/</loc>\n  <priority>0.8</priority>\n  <changefreq>daily</changefreq>\n  </url>\n";
					fwrite($fp, $code);
				}
				fwrite($fp, '</urlset>'."\n");
				fclose($fp);
			}
			return true;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* 全記事アーカイブ作成（終了）
	*
	* @param
	* @access public
	* @return boolean
	*/
	public function makeArchives(){
		try{
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->selectAllByAdmin()){
				throw new Exception();
			}

			foreach ($article_data as $key => $value) {
				$full_path = ROOT_DIRECTORY.'web/archives/'.$value['path'];
				exec('mkdir '.$full_path);
				$fp = fopen($full_path.'/index.php', "a");
				$code = "<?php\n".
					"require_once(dirname(__FILE__).'/../../../conf/ini.php');\n".
					"new ViewUserArchives(".$value['article_id'].");";
				fwrite($fp, $code);
				fclose($fp);
				echo $value['article_id'].' '.$value['path'].'\n';
			}

			return true;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* 全記事AMP作成（終了）
	*
	* @param
	* @access public
	* @return boolean
	*/
	public function makeAmp(){
		try{
			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->selectAllByAdmin()){
				throw new Exception();
			}

			foreach ($article_data as $key => $value) {
				$full_path = ROOT_DIRECTORY.'category'.$value['category_id'].'/'.$value['path'].'/amp';

				exec('mkdir '.$full_path);
				$fp = fopen($full_path.'/index.php', "a");
				$code = "<?php\n".
					"require_once(dirname(__FILE__).'/../../../conf/ini.php');\n".
					"new ViewUserArticleAmp(".$value['article_id'].");";
				fwrite($fp, $code);
				fclose($fp);
				echo $value['article_id'].' '.$value['path'].'\n';
			}

			return true;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

}
