<?php
/**
* Input class
* heory is when you know everything but nothing works. Practical is when everything works but no one knows why.
*/
class Input {

	public static function exists($type = 'post'){
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? true : false;
				break;
			case 'get':
				return (!empty($_POST)) ? true : false;
				break;

			default:
				return false;
				break;
		}
	}
	
	public static function get($item){
		if (isset($_POST[$item])) {
			return $_POST[$item];
		} else if (isset($_GET[$item])) {
			return  $_GET[$item];
		} 

		return '';
	}
}
?>