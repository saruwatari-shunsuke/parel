<?php
/**
* ViewGoogletag
* Googletag
* @package View
* @author Shunsuke Saruwatari
* @since PHP 7.0
* @version 1.0
*/

Class ViewGoogletag {
	public function __construct() {
		try {
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* PC版ヘッダー用
	*
	* @param
	* @access public
	* @return
	*/
	public function pcHeader() {
		try {
?>

    <script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
    <script>
      var googletag = googletag || {};
      googletag.cmd = googletag.cmd || [];
    </script>

    <script>
      googletag.cmd.push(function() {
        googletag.defineSlot('/9176203/1579606', [[247, 247], [228, 228],'fluid'], 'div-gpt-ad-1535010831240-0').
        defineSizeMapping(googletag.sizeMapping().
        addSize([1200, 0], [[247, 247],'fluid']).
        addSize([0, 0], [[228, 228],'fluid']).
        build()).
        addService(googletag.pubads());
        googletag.pubads().enableSingleRequest();
        googletag.enableServices();
      });
    </script>

<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* PC版本文用
	*
	* @param
	* @access public
	* @return
	*/
	public function pcBody() {
		try {
?>
    <!-- /9176203/1579606 -->

    <div id='div-gpt-ad-1535010831240-0'>
      <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1535010831240-0'); });
      </script>
    </div>

    <style>
      #div-gpt-ad-1535010831240-0 {
        width: 247px;
        height: 247px;
        margin: 0 1% 10px 0;
        float: left;
        -webkit-box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
        box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
        border-radius: 1px 1px 1px 1px;
        overflow: hidden;
      }

      @media screen and (max-width: 1199px) {
        #div-gpt-ad-1535010831240-0 {
          width: 228px;
          height: 228px;
        }
      }
    </style>

<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* SP版ヘッダー用
	*
	* @param
	* @access public
	* @return
	*/
	public function spHeader() {
		try {
?>

<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>

<script>
  googletag.cmd.push(function() {
    googletag.defineSlot('/9176203/1579604', [[300, 250],'fluid'], 'div-gpt-ad-1535009616990-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>

<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

	/*
	* SP版本文用
	*
	* @param
	* @access public
	* @return
	*/
	public function spBody() {
		try {
?>
<!-- /9176203/1579604 -->

<div id='div-gpt-ad-1535009616990-0' style="width:300px;height:250px;margin:auto;">
<script>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1535009616990-0'); });
</script>
</div>

<?php
		} catch(Exception $e) {
			CreateLog::putErrorLog(get_class()." ".$e->getMessage());
		}
	}

}
