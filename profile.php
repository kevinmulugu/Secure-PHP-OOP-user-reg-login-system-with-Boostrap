<?php
require_once('core/init.php');
$user = new User();

if (!$user->isLoggedIn()) {
	Session::flash('logerr', 'Error! Log in is required');
	Redirect::to('login.php');
	exit();
}
if (Session::exists('uperr')) {
	print(Session::flash('uperr'));
} 
if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
				'name' => array(
					'required' => true,
					'min' => 2,
					'max' => 20)
				)
		);

		if ($validation->passed()) {
			try {
				$user->update(array(
					'name' => Input::get('name')
				));
				Session::flash('upsuc', 'You profile was updated successfully');
				Redirect::to('index.php');
				exit();
			} catch (Exception $e) {
				Session::flash('uperr', 'We experienced an error while updating your profile');
				Redirect::to('profile.php');
				exit();
			}
		} else {
			foreach ($validation->errors() as $error ) {
				print($error . '<br>');
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
				<label class="control-label" for="name">Change your name</label>
				<input type="text" class="form-control" maxlength="20" max="20" name="name" id="name" value="<?php print($user->data()->name); ?>" required autofocus>		
			</div>
			<input type="hidden" name="token" value="<?php print(Token::generate()); ?>" >
			<input type="submit" class="btn btn-lg btn-block btn-success" name="edit" value="save changes">	
			</form>
		</div>
	</div>

</body>
</html>