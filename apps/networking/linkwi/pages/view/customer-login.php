<!-- box-header Starts -->
<p class="text-center lead">Already our Customer?</p>
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card shadow">
        <div class="card-header text-center">
            <img src="http://linkwi.co/images/linkwi-og.webp" alt="" width="50%">
        </div>
        <div class="card-body">


            <form method="POST">


                <div class="input-group mb-3">

                    <p class="login-box-msg">Sign in</p>
                </div>


                <div class="input-group mb-3">
                    <input type="text" name="c_user" class="form-control" placeholder="Email/ Username"
                        autocomplete="false">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="c_pass" class="form-control" placeholder="Password"
                        autocomplete="false">
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
                        <input id="button" type="submit" name="login" class="btn btn-dark btn-block" value="Login">
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="row">
                <div class="col-12 text-center ">                   
                    <a class="button button-info mt-2" href="https://linkwi.co/linkwi/register.php">
                        Register
                    </a>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->





<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;







function clientIpAddress()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$address = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$address = $_SERVER['REMOTE_ADDR'];
	}
	return $address;
}

$ipaqddress = clientIpAddress();


//set time zone stamp
$tz = 'America/Port_of_Spain';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string //
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$Dateandtime =  $dt->format('d.m.Y, H:i:s');




if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$UserCredentials = $_POST['c_user'];

	$Password = sha1($_POST['c_pass']);


	if (!empty($UserCredentials) && !empty($Password)) {
		$conn  = new dbase;
		//read from database
		$conn->query("select * from Users where EmailAddress = '$UserCredentials' OR Username = '$UserCredentials' limit 1");
		$user_data = $conn->fetchSingle();

		if (!empty($user_data)) {
			if ($user_data['Password'] === $Password) {

				echo "logged in";
				$_SESSION['UniqueID']			= $user_data['UniqueID'];
				$_SESSION['Username']			= $user_data['Username'];
				$_SESSION['EmailAddress']		= $user_data['EmailAddress'];
				$_SESSION['FirstName']			= $user_data['FirstName'];
				$_SESSION['LastName'] 			= $user_data['LastName'];
				$_SESSION['Gender'] 			= $user_data['Gender'];
				$_SESSION['Contact'] 			= $user_data['Contact'];
				$_SESSION['Address'] 			= $user_data['Address'];
				$_SESSION['City'] 			= $user_data['City'];
				$_SESSION['Date']			= $user_data['Date'];
				$_SESSION['ProfileImage'] 		= $user_data['ProfileImage'];
				$_SESSION['Image_one'] 			= $user_data['Image_one'];
				$_SESSION['Skills'] 			= $user_data['Skills'];
				$_SESSION['Education']			= $user_data['Education'];
				$_SESSION['Experience']			= $user_data['Experience'];
				$_SESSION['Facebook'] 			= $user_data['Facebook'];
				$_SESSION['Instagram']			= $user_data['Instagram'];
				$_SESSION['YouTube']			= $user_data['YouTube'];
				$_SESSION['LinkedIn']			= $user_data['LinkedIn'];
				$_SESSION['Website'] 			= $user_data['Website'];
				$_SESSION['Bio'] 			= $user_data['Bio'];
				$_SESSION['Job'] 			= $user_data['Job'];
				$_SESSION['User_Banner_Image'] 		= $user_data['User_Banner_Image'];
				$_SESSION['User_Banner_Name'] 		= $user_data['User_Banner_Name'];
				$_SESSION['AccountType'] 		= $user_data['AccountType'];
				echo $_SESSION['Active'] 		= $user_data['Active'];


				if (!isset($_SESSION['Rurl'])) {
					//header("Location: ../public/?my-orders");
					header("Location: checkout");
				} else {
					$Rurl = $_SESSION['Rurl'];
					header("Location:" . $Rurl);
					die;
				}
			}
		}
	} //if
} //if
?>