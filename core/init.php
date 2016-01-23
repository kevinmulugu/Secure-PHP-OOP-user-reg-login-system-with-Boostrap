<?php 
session_start();

//Declare and initialize a config superglobal
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'dbname' => 'userlr'
	),
	'remember' => array(
		'cookie_name' => 'harsh',
		'cookie_expiry' => 2592000
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	)
);


//Create an auto function for classes
spl_autoload_register (function ($class) {
	
	require_once "classes/$class.php";
});

//Include the sanitize function
require_once 'functions/sanitize.php';

if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_sessions', array('hash', '=', $hash));
	if ($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);

		$user->login();
	}
	
}

?>