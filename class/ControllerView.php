<?php
/**
* ControllerView
* 閲覧数処理
* @package Controller
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.1
*/
Class ControllerView extends CommonBase{
	/*
	* データ追加
	*
	* @param int
	* @access public
	* @return boolean
	*/
	public function add($article_id){
		try{
			$object_mdvi = new ModelDataViews();
			$term = date('Y-m-d');
			if(!$object_mdvi->select1ById($article_id, $term)){
				// 閲覧0回
				if(!$object_mdvi->insert($article_id, $term)){
					throw new Exception("閲覧数カウント失敗 id:".$article_id);
				}
			} else {
				// 閲覧1回以上
				if(!$object_mdvi->update($article_id, $term)){
					throw new Exception("閲覧数カウント失敗 id:".$article_id);
				}
			}

			return true;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* 検索ワード＆ページをログ出し 
	*
	* @param 
	* @access public
	* @return boolean
	*/
	public function addSearchLog($article_id){
		try{
			if(!$search = $_GET['s']) {
				return false;
			}

			$object_mdar = new ModelDataArticles();
			if(!$article_data = $object_mdar->select1ById($article_id)){
				throw new Exception();
			}
			$url = CATEGORY_URL[$article_data['category_id']].$article_data['path'];

			$text = date('Y-m-d H:i:s')." 検索ワード「".$search."」 URL:".$url."\n";
			$fp = fopen(ROOT_DIRECTORY.'admin/log/search.log', "a");
			fwrite($fp, $text);
			fclose($fp);

			return true;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}
	
	/*
	* デイリーランキング
	*
	* @param int
	* @access public
	* @return array
	*/
	public function getDailyRanking($rank){
		try{
			$object_mdvi = new ModelDataViews();
			$term = date('Y-m-d', strtotime('-1 day'));
			if(!$ranking_data = $object_mdvi->getRankingForUser($term, $rank)){
				return false;
			}
			return $ranking_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}


}
