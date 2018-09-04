<?php
/**
* ControllerSeearch
* Google Custome Search API
* @package Controller
* @author Saruwatari Shunsuke
* @since PHP 7.0
* @version 1.0
*/
Class ControllerSearch extends CommonBase{
	/*
	* 検索
	*
	* @param array
	* @access public
	* @return boolean
	*/
	public function searchAPI(){
		try{
			if(empty($_GET['q'])) {
				return false;
			}
			if(!is_numeric($_GET['r']) || $_GET['r']<0) {
				$limit_rank = 0;
			} else if($_GET['r']>30) {
				$limit_rank = 30;
			} else {
				$limit_rank = $_GET['r'];
			}

			$query = $_GET['q'];
			$apiKey = "AIzaSyCc8Bh2llMNHfnD2oZUkygFPpqNWNo4IVs";
			$searchEngineId = "003905035378358247527:sfvznypisgs";
			$baseUrl = "https://www.googleapis.com/customsearch/v1?";


			$filename = 'search'.date('YmdHis').'.csv';
			$file = ROOT_DIRECTORY.'admin/log/'.$filename;
			$handle = fopen($file, 'w');

			if(is_writable($file)){
				if(!$handle){
					echo "Cannot open file ($file)";
					exit;
				}
			}else{
				echo "Cannot write file ($file)";
				exit;
			}

			$file_title = array("「".$query."」の検索結果");
			mb_convert_variables('SJIS', 'UTF-8', $file_title);
			fputcsv($handle, $file_title);

			$header = array("順位","サイト名","URL","ディスクリプション");
			mb_convert_variables('SJIS', 'UTF-8', $header);
			fputcsv($handle, $header);

			for($i=0;$i<3;$i++){
				$startNum = $i*10+1;

				$paramAry = array(
						'q' => $query,
						'key' => $apiKey,
						'cx' => $searchEngineId,
						'alt' => 'json',
						'start' => $startNum
						);
				$param = http_build_query($paramAry);
				$reqUrl = $baseUrl . $param;
				$retJson = file_get_contents($reqUrl, true);
				$ret = json_decode($retJson, true);

				foreach($ret['items'] as $key => $value){
					$rank = $startNum + $key;
					$urls[$rank] = $value['link'];
					$export_line = array($rank, $value['title'], $value['link'], $value['snippet']);
					mb_convert_variables('SJIS', 'UTF-8', $export_line);
					fputcsv($handle, $export_line);
				}
			}
			foreach($urls as $key => $value) {
				fputcsv($handle, array());
				if($key<=$limit_rank){
					fputcsv($handle, array($key, $value));
					$scraping_data = $this->scraping($value);
					foreach($scraping_data as $key2 => $value2) {
						$scraping_array = explode("\n", $value2);
						foreach($scraping_array as $key3 => $value3) {
							fputcsv($handle, array($key2, $value3));
						}
					}
				}
			}
	
			fclose($handle);

			return $filename;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

	/*
	* WEBスクレイピング
	*
	* @param array
	* @access private
	* @return array
	*/
	private function scraping($url){
		try{
			require_once('phpQuery-onefile.php');
			$html = file_get_contents($url);
			$doc = phpQuery::newDocument($html);

			$scraping_data['title'] = $doc["title"]->text();
			$scraping_data['h1'] = $doc["h1"]->text();
			$scraping_data['h2'] = $doc["h2"]->text();
			$scraping_data['h3'] = $doc["h3"]->text();
			$scraping_data['h4'] = $doc["h4"]->text();
			$scraping_data['h5'] = $doc["h5"]->text();
			$scraping_data['h6'] = $doc["h6"]->text();
			mb_convert_variables('SJIS', 'UTF-8', $scraping_data);

			return $scraping_data;
		} catch (Exception $e){
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
			return false;
		}
	}

}
