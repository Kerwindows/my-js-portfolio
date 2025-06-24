<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
	require ('../includes/linkwi.php');
	require '../linkwi/includes/classes/get.siteSettings.php';
	$f =  new SiteSettings;

 if (isset($_SESSION['Username'])) {

        header("Location: /admin/?dashboard");
      }

function clientIpAddress(){
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $address = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
    $address = $_SERVER['REMOTE_ADDR'];
  }
  return $address;
}

$ipaqddress = clientIpAddress();


if($_SERVER['REQUEST_METHOD'] == "POST"){
 	//something was posted
	$EmailAddress = $_POST['EmailAddress'];
	$Password = sha1($_POST['Password']);
	//unset($_SESSION['LoginCount']);
		
	if(!empty($EmailAddress) && !empty($Password)){
		if(isset($_SESSION['LoginCount'])){
		
		$db = new dbase;
		$db->query("SELECT * FROM LoginCapture where EmailAddress = '$EmailAddress' limit 1");
		$check = $db->fetchSingle();

			$first_attempt_time = $check['Timestamp'];
			// Convert datetime to Unix timestamp
			$timestamp1 = strtotime($first_attempt_time);
			// Current date and time is $Dateandtime
			// Convert globaldatetime to Unix timestamp
			$timestamp2 = strtotime($Dateandtime);
			// Subtract time from datetime
			$time = $timestamp2 - $timestamp1;
					
			if($time > 900){ //15 mins is 900secs
				$db->query("DELETE FROM LoginCapture WHERE IP = '$ipaqddress'");
				$db->execute();
				unset($_SESSION['LoginCount']);
			}
			else{
				exit("<div style='
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				text-align: center;
				min-height: 100vh;font-size:1.2em'><img src='http://checkin.cyversify.com/dist/img/security.svg' atl='' width='320px' /><p>We are sorry you had many failed attempts.<br/>If you persist it will only take longer. <br/>Please Try Again Later.</p></div>");
			}
		}else{
			
		}
			
			
		//read from database
		$db = new dbase;
		$db->query("SELECT * from Admin where Email = '$EmailAddress' limit 1");
		$countz = $db->fetchCount();
		
		
			if($countz > 0){
			$user_data = $db->fetchSingle();
			
			
				if($user_data['Password'] === $Password){
					
					
    					 
					
					$_SESSION['Username']			= $user_data['Username'];
					$_SESSION['EmailAddress']		= $user_data['Email'];
					$_SESSION['FirstName']			= $user_data['FirstName'];
					$_SESSION['LastName'] 			= $user_data['LastName'];
					$_SESSION['Role'] 			= $user_data['Role'];
					
					
						
					$db->query("DELETE FROM LoginCapture WHERE IP = '$ipaqddress' || EmailAddress = '$EmailAddress'");	
					$db->execute();
					unset($_SESSION['LoginCount']);
						
					if(!isset($_SESSION['Rurl'])){
						header("Location: ../admin/?dashboard");
					}
					else{
						$Rurl = $_SESSION['Rurl'];
						header("Location:" . $Rurl);
						die;
					}
				   
				}else{ 
					$db->query("SELECT * FROM LoginCapture where EmailAddress = '$EmailAddress' limit 1");
					$Count = $db->fetchCount();
					$result_login_stats = $db->fetchSingle();
	
					if($Count==0){
						$db->query("INSERT INTO LoginCapture (IP,LoginCount,EmailAddress,Timestamp) VALUES ('$ipaqddress','1','$EmailAddress','$Dateandtime')");
						$db->execute();
						
					}
					elseif($Count != 0){
						$Attempts = $result_login_stats['Attempts'];
						$LoginCount = $result_login_stats['LoginCount'];
							
						if($LoginCount == $Attempts){
							$_SESSION['LoginCount'] = $LoginCount;
							exit("<div style='
							display: flex;
							flex-direction: column;
							justify-content: center;
							align-items: center;
							text-align: center;
							min-height: 100vh;font-size:1.2em'><img src='http://checkin.cyversify.com/dist/img/alert.svg' atl='' width='320px' /><p>You've had too many failed attempts.<br/>Please Try Again Later.</p></div>");
						}else{
							$LoginCount = $LoginCount + 1;	
							$db->query("UPDATE LoginCapture SET LoginCount = '$LoginCount',Timestamp = '$Dateandtime' where EmailAddress = '$EmailAddress'");
							$db->execute();
						}
					}
						
				}
			}else{
				$db->query("SELECT * FROM LoginCapture where EmailAddress = '$EmailAddress'");
				$result_login_stats = $db->fetchSingle();
				$Count = $db->fetchCount();
				
				$db->query("SELECT COUNT(IP) AS Count_IP FROM LoginCapture where IP = '$ipaqddress'");
				$result_login_stats_ =$db->fetchSingle();
				
						
				if($Count==0){
					$db->query("INSERT INTO LoginCapture (IP,LoginCount,EmailAddress,Timestamp) VALUES ('$ipaqddress','1','$EmailAddress','$Dateandtime')");
					$db->execute();
					
				}
				elseif($Count != 0){
				
					$Attempts = $result_login_stats['Attempts'];
					$LoginCount = $result_login_stats['LoginCount'];
					$Count_IP = $result_login_stats_['Count_IP'];
					
					if(($LoginCount == $Attempts) || ($Count_IP > 2) ) {
						$_SESSION['LoginCount'] = $LoginCount;
						exit("<div style='
						display: flex;
						flex-direction: column;
						justify-content: center;
						align-items: center;
						text-align: center;
						min-height: 100vh;font-size:1.2em'><img src='http://checkin.cyversify.com/dist/img/security.svg' atl='' width='320px' /><p>You've had too many failed attempts trying to log in.<br/>Please Try Again Later.</p></div>");
					}else{
						$LoginCount = $LoginCount + 1;	
						$db->query("UPDATE LoginCapture SET LoginCount = '$LoginCount',Timestamp = '$Dateandtime' where EmailAddress = '$EmailAddress'");
						$db->execute();
					}
				}//elseif
			}//else
		
			
	}//if
}//if
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="<?php echo $f->getSiteTitle() ?>Scan Checkin">
	<title><?php echo $f->getSiteTitle() ?></title>
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

<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-purple">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h3"><b>Admin</b> Login</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form  method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name ="EmailAddress" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name ="Password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="float-right button button-primary button-shadow">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      
      <!-- .social-auth-links -->
      <!--<div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>-->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="/public/registration.php" class="text-center">Register a new membership</a>
      </p>
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