<?php
require_once('core/init.php');
$login = new User();

if ($login->isLoggedIn()) {
	Redirect::to('index.php');
	exit();
}
if (Session::exists('logerr')) {
	$message = Session::flash('logerr');
	$alert = 'danger';
} elseif (Session::exists('success')) {
	$message = Session::flash('success');
	$alert = 'success';
}
if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		$username = escape(Input::get('username'));
		$validate = new Validate();

		$validation = $validate->check($_POST, array(
				'username' => array('required' => true), 
				'password' => array('required' =>true)
			));
		if ($validation->passed()) {

			$user = new User();
			$remember = (Input::get('remember') == 'on') ? true : false ;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if ($login) {
				Redirect::to('index.php');
			} else {
				Session::flash('logerr', 'Login failed! The username and password do not match');
				
				Redirect::to('login.php');
			}
			
			
		} else {
			$errors = $validation->errors();
			foreach ($errors as $error) {
				print($error);
			}
		}
		
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE-edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User login - Egerton Campus Life </title>
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="http://localhost/userlr/assets/bootstrap/css/bootstrap.min.css">
<style type="text/css">
	#login-panel {
		position: relative;
		top: 70px;
	}
</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div id="login-panel" class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-4 col-xs-8 col-xs-offset-2 col-xs-12 panel well">
				<div class="text-info"><span><?php print( (isset($message)) ? $message : '' );?></span></div>
				<form class="form" id="login-form" role="form" action="<?php print(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="post"> 
					<div class="form-group">
						<label class="text-info control-label" for="user-username">Username</label>
						<input class="form-control" type="text" id="user-username" name="username" value="<?php if (!empty($username)) print($username); ?>" placeholder="Enter Username" maxlength="20" autofocus>
					</div>
					<div class="form-group">
						<label class="text-info control-label" for="user-password">Password</label>
						<input class="form-control" type="password" id="user-password" name="password" value="" placeholder="Enter password" maxlength="20">
					</div>
					<div class="form-group">
                        <input type="hidden" name="token" value="<?php print(Token::generate()); ?>" >
                    </div>
                    <div class="checkbox">
                    	<label for="remember"><input type="checkbox" name="remember" id="remember" checked>Remember me</label>
                    </div>
					<div class="form-group">
                        <input type="submit" class="btn btn-lg btn-success btn-block" name="login" id="login" value="Log in">
                    </div>
				</form>
				<div class="text-center"><span><a class="text-primary" href="help.php">Need help or forgot password?</a></span></div>
				<div class="text-center"><span><a href="register.php">Create account</a></span></div>
			</div>
		</div>
	</div>
</body>

</html>
