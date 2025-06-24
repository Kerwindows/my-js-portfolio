<?php 
session_start();
require ('../includes/linkwi.php');
include (LINKWI_FUNCTIONS_PATH . '/custom.toasts.php');
include 'includes/classes/get.siteSettings.php';
$f =  new SiteSettings;

if(!isset($_GET["reset"])){
exit("Page cannot be found");
}

$reset = $_GET["reset"];
$db = new dbase;
	$db->query("SELECT * FROM password_reset WHERE Token='$reset'");
	


if($db->fetchCount() > 0){
  $get_Person = $db->fetchSingle();
  $email_time = $get_Person['TimeStamp'];
  // Convert datetime to Unix TimeStamp
  $TimeStamp1 = strtotime($email_time);
  // Current date and time is $globaldatetimezome
  // Convert globaldatetime to Unix TimeStamp
  $TimeStamp2 = strtotime(date_time('Y-m-d, H:i:s'));
  // Subtract time from datetime
  $time = $TimeStamp2 - $TimeStamp1;

if($time > 3600){
  $db->query("DELETE FROM password_reset WHERE Token=:reset");
  $db->bind(':reset',$reset,PDO::PARAM_STR);
  $db->execute();
  exit("This link has expired");
  }
}
elseif($db->fetchCount() == 0){
 exit("The page you are looking for <b>no longer exist</b>");
}

if(isset($_POST["update_password"])) {
    
    $pw = clean(sanitize($_POST["user_pass"]));
    $pw_confirm = clean(sanitize($_POST["user_pass_confirm"]));
    
    if($pw != $pw_confirm){
    set_error_msg("Passwords do not match");
}


if($pw == $pw_confirm){
    //Validate password strength
    //$uppercase = preg_match('@[A-Z]@', $pw);
    //$lowercase = preg_match('@[a-z]@', $pw);
    //$number    = preg_match('@[0-9]@', $pw);
    //$specialChars = preg_match('@[^\w]@', $pw);
    
    if(/*!$uppercase || !$lowercase || !$number || !$specialChars ||*/ strlen($pw) < 7) {
      
      set_error_msg("Your Password should be at least 6 characters long");
    
    }else{
    $user_email = $get_Person["EmailAddress"];
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    
    $db->query("UPDATE {$get_Person["LoginTable"]} SET 	bcryptPassword=:pw WHERE EmailAddress=:user_email");
    $db->bind(':pw',$pw,PDO::PARAM_STR);
    $db->bind(':user_email',$user_email,PDO::PARAM_STR);
  
    if($db->execute()){
    $db->query("DELETE FROM password_reset WHERE  EmailAddress=:user_email");
    $db->bind(':user_email',$user_email,PDO::PARAM_STR);
    $db->execute();
    
    set_msg("Password reset successful");
    redirect('login.php');
    exit();    
   
    }
  }}
 
}


    
?>

<!DOCTYPE html>
<html>

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
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page school-login">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card shadow">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b><?php echo $f->getSiteTitle() ?></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Enter your new password</p>

      <form  method="POST">
        <div class="input-group mb-3">
          <input type="password" name="user_pass" class="form-control" placeholder="New Password" Required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="user_pass_confirm" class="form-control" placeholder="Confirm New Password" Required>
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
            <input id="button" class="btn btn-primary btn-block" name="update_password" type="submit" value="Submit"> 
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
<script src="../../admin/plugins/toastr/toastr.min.js"></script>
<script src="../../admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../admin/dist/js/adminlte.min.js"></script>
<script>$(document).ready(function(){$(".fadeout").fadeIn('slow').delay(3000).fadeOut('slow');});</script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    } 
</script>
</body>
</html>