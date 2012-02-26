<?php

	$str_debug = "";
	include(ROOTDIR . "lib/smarty/Smarty.class.php");

	function tt_connect($tt_dir="", $tt_cdir="", $cache_dir="", $config_dir="") {
		global $template;
		
		$tt_dir=($tt_dir=="" ? "tt/templates/" : $tt_dir);
		$tt_cdir=($tt_cdir=="" ? "tt/templates_c/" : $tt_cdir);
		$cache_dir=($cache_dir=="" ? "tt/cache/" : $cache_dir);
		$config_dir=($config_dir=="" ? "tt/configs/" : $config_dir);
		
		$template = new Smarty();
		$template->template_dir=ROOTDIR . $tt_dir;
		$template->compile_dir=ROOTDIR . $tt_cdir;
		$template->cache_dir=ROOTDIR . $cache_dir;
		$template->config_dir=ROOTDIR . $config_dir;
	}
	
	function gen_uniq($rnd=0,$length=12) {
		srand((double)microtime()*10000000+$rnd);
		$Pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890';
		$sid = '';
		for($index = 0; $index < $length; $index++) {
			$sid .= substr($Pool, (rand()%(strlen($Pool))), 1);
		}
		return($sid);
	}

	//	добавя параметри в гет
	function addGet($ArrayOrString){
		if(is_array($ArrayOrString)) return http_build_query(array_merge($GLOBALS['_GET'], $ArrayOrString)); 
		parse_str($ArrayOrString, $output); 
		return http_build_query(array_merge($GLOBALS['_GET'], $output)); 
	}
	function addPost($ArrayOrString){
		if(is_array($ArrayOrString)) return http_build_query(array_merge($GLOBALS['_POST'], $ArrayOrString)); 
		parse_str($ArrayOrString, $output); 
		return http_build_query(array_merge($GLOBALS['_POST'], $output)); 
	}
	
	function url_params($set=array()) {
		$url_params=array();
	        $url_params_data=get_data();
		unset($url_params_data["uri"]);	//	махам uri от масива, защото взима номера на категорията
	        foreach ($set as $key => $value) {
	                $url_params_data[$key]=$value;
	        }
		foreach ($url_params_data as $key => $value) {
		        $url_params[]=$key."=".$value;
		}
		return "?".implode("&amp;", $url_params);
	}
	
	function get_data($key='') {
		if ($key=='') {
			foreach ($_GET as $key => $value) {
				$data[$key] = $value;
			}
		} else {
		        $data=(isset($_GET[$key]) ? clean_input($_GET[$key]) : false);
		}
		return $data;
	}
	
	function array_debug($array) {
		print "<pre>";
		print_r($array);
		print "</pre>";
	}
	
?>