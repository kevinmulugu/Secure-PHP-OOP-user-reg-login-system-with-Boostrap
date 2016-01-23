<?php
require_once 'core/init.php';
$conn = DB::getInstance()->update('users', 6, array('usrername' => 'Cyril', 'name' => 'Aguvasu Cyril', 'password' => 'new password', 'joined' => 'date()'));
if($conn){
	print('Records updated successfully!');
} else{
	print('An error occurred while updating your records. Try again later');
}
?>