<?php

session_start();

require '../includes/linkwi.php';
require 'includes/classes/get.siteSettings.php';
include(ADMIN_FUNCTION_PATH . '/custom.toasts.php');

$f =  new SiteSettings;
display_msg();

if (isset($_SESSION['Userdata']['EmailAddress'])) {

	header("Location: index.php?dashboard");
}

if (isset($_POST["submit"])) {

	$loginrole = $_POST["loginrole"];
	$Username  = $_POST["Username"];
	$password  = sha1($_POST["Password"]);

	$db        = new dbase;
	$db->query("SELECT * FROM $loginrole WHERE (Username =:Username || Email =:Username ) AND Password=:password  ");
	// $db->bind(':loginrole', $loginrole, PDO::PARAM_STR);
	$db->bind(':Username', $Username, PDO::PARAM_STR);
	$db->bind(':password', $password, PDO::PARAM_STR);
	$get_info = $db->fetchCount();
	if ($get_info == 0) {

		set_error_msg("Incorrect Username/Password");
		redirect('login.php');
		die;
	} else {

		$load = $db->fetchSingle();
		$_SESSION['Userdata']      = array(

			'EmailAddress' => $load["Email"],
			'LoginRole' => $loginrole,
			'UniqueID' => $load["UniqueID"],
			'Username' => $load["Username"]

		);

		header("Location:index.php?dashboard");
		die;
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $f->getSiteTitle() ?>Scan Checkin">
	<title><?php echo $f->getSiteTitle() ?> Scan Checkin</title>
	<meta property="og:image" content="img/files/school-logo.png">
	<meta property="og:image:width" content="2000">
	<meta property="og:image:height" content="1600">
	<link rel="shortcut icon" type="image/jpg" href="img/files/school-logo.png">

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="admin/plugins/toastr/toastr.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="dist/css/school-login.css">

</head>

<body class="hold-transition login-page school-login">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card shadow">
			<div class="card-header text-center">
				<img src="http://linkwi.co/images/linkwi-og.png" alt="" width="100%">
			</div>
			<div class="card-body">
				<p class="login-box-msg">Sign in to start your session</p>

				<form method="POST">


					<div class="input-group mb-3">

						<select class="custom-select form-control-border" name="loginrole" id="Role">
							<option value="Admin">Administrator</option>

						</select>
					</div>


					<div class="input-group mb-3">
						<input type="text" name="Username" class="form-control" placeholder="Email/ Username" autocomplete="false">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>

					<div class="input-group mb-3">
						<input type="password" name="Password" class="form-control" placeholder="Password" autocomplete="false">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>




					<div class="row">
						<div class="col-12 text-center ">

							<p class="mb-4">
								<a href="reset-password.php">I forgot my password</a>
							</p>
						</div>
						<!-- /.col -->
						<div class="col-12">
							<input id="button" type="submit" name="submit" class="btn btn-dark btn-block" value="Login">
						</div>
						<!-- /.col -->
					</div>
				</form>



			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="admin/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="admin/dist/js/adminlte.min.js"></script>
	<script>
		$(document).ready(function() {
			$(".fadeout").fadeIn('slow').delay(3000).fadeOut('slow');
		});
	</script>
</body>

</html>