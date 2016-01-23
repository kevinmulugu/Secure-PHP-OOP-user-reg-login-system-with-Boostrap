<?php
include_once('core/init.php');
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$name = escape(Input::get('name'));
			$username = escape(Input::get('username'));
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min' => 2,
					'max' => 20,
					'unique' => 'users' 
				),
				'password' => array(
					'required' => true,
					'min' => 6
				),
				'r_password' => array(
					'required' => true,
					'matches' => 'password'
				),
				'name' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
				)
			));

			if ($validation->passed()) {
				$user = new User();
				$salt = Hash::salt(32);
				try {
					$user->create(array(
						'username' => Input::get('username'),
						'password' => Hash::make(Input::get('password'), $salt), 
						'salt' => $salt, 
						'name' => Input::get('name'),
						'joined' => date('Y-m-d H:i:s'), 
						'user_group' => 1 
						));
				} catch (Exception $e) {
					print("Something went wrong!");
				}
				Session::flash('success', 'Congratulations! Registration successfully. Log in to proceed to the system');
				Redirect::to('login.php');
			} else {
				foreach ($validate->errors() as $error) {
					echo "$error <br>";
				}
			}
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>User Registration | Egerton Campus Life</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.css">
	<style type="text/css">
	#register-panel {
		position: relative;
		top: 70px;
	}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div id="register-panel" class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-4 col-xs-8 col-xs-offset-2  panel well">
				<form class="form" role="form" action="<?php print(htmlspecialchars($_SERVER['PHP_SELF'])); ?>" method="post"> 
					<div class="form-group">
						<label class="text-info" for="user-username">Username</label>
						<input class="form-control" type="text" id="user-username" name="username" value="<?php if (!empty($username)) print($username); ?>" placeholder="Enter Username" maxlength="20" autofocus required>
					</div>
					<div class="form-group">
						<label class="text-info" for="user-password">Password</label>
						<input class="form-control" type="password" id="user-password" name="password" value="" placeholder="Enter password" maxlength="20" required>
					</div>
					<div class="form-group">
						<label class="text-info" for="user-re-password">Confirm Password</label>
						<input class="form-control" type="password" id="user-re-password" name="r_password" value="" placeholder="Re-enter password" maxlength="20" required>
					</div>
					<div class="form-group">
						<label class="text-info" for="user-name">Name</label>
						<input class="form-control" type="text" id="user-name" name="name" value="<?php if (!empty($name)) print($name); ?>" placeholder="Enter your name" maxlength="20" autofocus required>
					</div>
					<div class="form-group">
                        <input type="hidden" name="token" value="<?php print(Token::generate()); ?>" >
                    </div>
					<div class="form-group">
                        <input type="submit" class="btn btn-lg btn-success btn-block" name="register" value="Register">
                    </div>
				</form>
				<div class="text-center"><span><a href="login.php">Log in</a></span></div>
			</div>
		</div>
	</div>

</body>
</html>