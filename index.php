<?php
include_once 'core/init.php';

 $user = new User();

 if ($user->isLoggedIn()) {
 	if (Session::exists('upsuc')) {
		print(Session::flash('upsuc'));
	} elseif (Session::exists('passuc')) {
		print(Session::flash('passuc'));
	} 
 ?>
 <p>Hello <?php print(escape($user->data()->username)); ?>!</p>
 <ul>
 	<li><a href="logout.php">Logout</a></li>
 	<li><a href="profile.php">Edit profile</a></li>
 	<li><a href="changepassword.php">Change password</a></li>
 </ul>
 <?php

	 if ($user->hasPermission('admin')) {	
	 	echo('You are an administrator');
	 }
 }else  {
 ?>
 <p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>
 <?php
 }

?>