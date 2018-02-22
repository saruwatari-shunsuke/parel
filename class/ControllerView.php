<?php
/**
* ControllerView
* 閲覧数処理
* @package Controller
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 0.1
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
