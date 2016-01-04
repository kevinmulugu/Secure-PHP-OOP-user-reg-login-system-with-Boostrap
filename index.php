<?php
include_once 'core/init.php';

$user = DB::getInstance()->update('users', 5, array('username' => 'warren', 'password' => 'pswd', 'salt' => 'salt', 'name' => 'Warren Peter', 'joined' => 'NOW()'));

echo $message = ($user) ? "success!" : "fail!";

?>