<?php 

require ('../includes/linkwi.php');
include LINKWI_FUNCTIONS_PATH . '/custom.toasts.php';
include LINKWI_CLASSES_PATH.'/get.siteSettings.php';
require LINKWI_FUNCTIONS_PATH . '/sendResetPasswordEmail.php';


if(isset($_POST['EmailReset'])){
set_error_msg("Blah blah blah");
	$email = check_Email($_POST['email']);
	$logintable = check_Email($_POST['logintable']);
	$db = new dbase;
	$db->query("SELECT `EmailAddress`,`FirstName`,`LastName` FROM Users WHERE EmailAddress = :email");
	$db->bind(':email',$email,PDO::PARAM_STR);
	$get_Person = $db->fetchSingle();
	
	
	if(empty($get_Person)){
		set_error_msg("Email does not exist");
		redirect($_SERVER['REQUEST_URI']);
		exit();
		
	}
	else{
	
		$u = uniqid(true);
		$v = uniqid(true);
		$token = "$u$v";
		
		$db->query("INSERT INTO `password_reset` (`Token`, `EmailAddress`,`TimeStamp`, `LoginTable`) VALUES(:token,:email,:datetime,:logintable)");
		$db->bind(':token',$token,PDO::PARAM_STR);
		$db->bind(':email',$email,PDO::PARAM_STR);
		$db->bind(':datetime',date_time('Y-m-d, H:i:s'),PDO::PARAM_STR);
		$db->bind(':logintable',$logintable,PDO::PARAM_STR);
		$db->execute();
		set_msg("Password reset link was sent to $email.");
		sendResetPasswordEmail($email, $get_Person['FirstName'], $get_Person['LastName'],$token);		
		
	}//else
	
}

$f =  new SiteSettings;    
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $f->getSiteTitle() ?>Linkwi">
	<title><?php echo $f->getSiteTitle() ?> Linkwi</title>
	<meta property="og:image" content="images/icons/link-icon.jpg">
	<meta property="og:image:width" content="2000">
	<meta property="og:image:height" content="1600">
	<link rel="shortcut icon" type="image/jpg" href="images/icons/link-icon.jpg">
	
   <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Toast -->
   <link rel="stylesheet" href="admin/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="admin/dist/css/linkwi.css" />
</head>
<?php display_msg();  ?>
<body class="hold-transition login-page school-login">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card shadow">
    <div class="card-header text-center">
      <a href="#" title="title" class="h1"><b><?php echo $f->getSiteTitle() ?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Please select the correct account and enter your email address to get the code to reset your password.</p>

      <form  method="POST" >
      <div class="input-group mb-3">
      
                                    <select title="Select user" class="custom-select form-control-border" name="logintable" id="Role">
                                      <option value ="Users">CARD HOLDER</option>                                      
                                    </select>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-6">
              <a href="login.php" class="btn btn-default btn-block" class="login-btn"><b>Login</b></a>
           
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button id="button" class="btn btn-dark btn-block" name="EmailReset" type="submit" value='1'>Reset Password</button> 
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
<!-- Toast -->
<script src="admin/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/adminlte.min.js"></script>

<script>$(document).ready(function(){$(".fadeout").fadeIn('slow').delay(3000).fadeOut('slow');});</script>
<script>
   $(document).ready(function(){
   window.history.replaceState('','',window.location.href)
   });
</script>
</body>
</html>