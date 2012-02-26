<?php
class controller {
	var $get_array=array();
	var $post_array=array();
	var $params=array();
	function controller($params=array()) {
		$this->params=$params;
		$this->colector();
	}
	
	function colector() {
		$uri_params=explode('/',urldecode($_GET["uri"]));
		foreach ($this->params as $key => $value) $this->get_array[$value]=$this->clean_input($uri_params[$key]);
		$rest_arr=array();
		while (isset($uri_params[$key])) {
			$key++;
			if ($uri_params[$key]!=NULL) $rest_arr[]=(isset($uri_params[$key]) ? $uri_params[$key] : false);
		}
		$this->uri();
		foreach ($_POST as $key => $value) $this->post_array[$key]=$this->clean_input($value);
	}
	
	function uri() {
		$this->uri=false;;
		foreach ($this->get_array as $key => $value) $this->uri.='/'.$value;
	}
	function clean_input($input) {
		return (get_magic_quotes_gpc() ? stripslashes($input) : strip_tags($input));
	}
	
	function get($name) {
		return (isset($this->get_array[$name]) ? $this->get_array[$name] : false);
	}
	
	function post($name) {
		return (isset($this->post_array[$name]) ? $this->post_array[$name] : false);
	}
	
	function get_uri() {
		return 'http://'.$_SERVER["HTTP_HOST"].$this->uri;
	}
	
	function submit() {
		return (isset($this->post_array['submit']) ? true : false);
	}
	
	function add_get($value) {
		$this->uri.= (strlen($value)!=0 ? (substr($this->uri, -1)=='/' ? '' : '/').$value : '');
	}
	
	function change_get($key,$value) {
		if (isset($this->get_array[$key])) $this->get_array[$key]=$value;
		$this->uri();
	}
}
?>