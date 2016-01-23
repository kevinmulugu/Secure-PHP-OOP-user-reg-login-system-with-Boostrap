
<?php
require_once('core/init.php');

$user = new User();

if (!$user->isLoggedIn()) {
	Session::flash('logerr', 'Error! Log in is required');
	Redirect::to('login.php');
	exit();
}

if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'currentpassword' => array(
				'required' => true,
				'min' => 6
				),
			'newpassword' => array(
				'required' => true,
				'min' => 6
				),
			'newpasswordagain' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'newpassword'
				)
		));
		
		if ($validation->passed()) {
			if (Hash::make(Input::get('currentpassword'), $user->data()->salt) !== $user->data()->password) {
				print('Your current password is incorrect');
			} else {
				$salt = Hash::salt(32);
				$user->update(array(
						'password' => Hash::make(Input::get('newpassword'), $salt),
						'salt' => $salt
				));

				Session::flash('passuc', 'Your password was changed successfully');
				Redirect::to('index.php');
				exit();
			}
		} else {
			foreach ($validation->errors() as $error) {
				echo $error . '<br>';
			}
		}
		
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit your profile - Egerton Campus Life</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/userlr/assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<form class="form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<div class="form-group">
				<label class="text-info" for="currentpassword">Current password</label>
				<input class="form-control" type="password" id="currentpassword" name="currentpassword" value="" placeholder="Enter current password" required autofocus>
			</div>
			<div class="form-group">
				<label class="text-info" for="newpassword">New password</label>
				<input class="form-control" type="password" id="newpassword" name="newpassword" value="" placeholder="Enter new password" required>
			</div>
			<div class="form-group">
				<label class="text-info" for="newpasswordagain">New password again</label>
				<input class="form-control" type="password" id="newpasswordagain" name="newpasswordagain" value="" placeholder="Enter new password again" required>
			</div>
			<input type="hidden" name="token" value="<?php print(Token::generate()); ?>" >
			<input type="submit" class="btn btn-lg btn-block btn-success" name="changepassword" value="save changes">	
			</form>
		</div>
	</div>

</body>
</html>