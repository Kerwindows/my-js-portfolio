<?php
ob_start();
session_start();

require '../includes/linkwi.php';
//require 'includes/classes/get.siteSettings.php';
// include(LINKWI_FUNCTIONS_PATH . '/custom.toasts.php');
require LINKWI_FUNCTIONS_PATH . '/setMsg.php';
include 'phpqrcode/userQRgenerator.php';
require('includes/functions/sendRegistrationSuccessEmail.php');

$Username = "";
//$f =  new SiteSettings;

if (!empty($_POST["submit"])) {

    $_SESSION['FirstName'] = $_POST['FirstName'];
    $_SESSION['LastName'] = $_POST['LastName'];
    $_SESSION['EmailAddress'] = $_POST['EmailAddress'];
    $_SESSION['Username'] = $_POST['Username'];

    
    if ((empty($_POST['FirstName'])) || (empty($_POST['LastName'])) || (empty($_POST['EmailAddress'])) || (empty($_POST['PasswordConfirm'])) || (empty($_POST['Password'])) || (empty($_POST['Username']))) {
    set_error_msg("Please full out all fields before submitting");
    } elseif ((clean(sanitize($_POST['PasswordConfirm']))) != (clean(sanitize($_POST['Password'])))) {
            set_error_msg("Passwords do not match");
    } else {
        // code for check server side validation
        if (empty($_SESSION['captcha_code']) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0) {
            set_error_msg("Captcha Does Not Match"); // Captcha verification is incorrect.		
        } else { 	
            $FirstName = check_Names($_POST['FirstName']);
            $LastName = check_Names($_POST['LastName']);
            $EmailAddress = check_Email(strtolower($_POST['EmailAddress']));
            $Password = password_hash(clean(sanitize($_POST['Password'])), PASSWORD_DEFAULT);
            $Username = str_replace(' ', '', check_Input($_POST['Username']));
            $u = uniqid();
            $v = uniqid();
            $UniqueID     = "$u$v";
            $role = "Users";
            $pic = "default.png";

            function generateRandomString($characters, $length) {
                return substr(str_shuffle($characters), 0, $length);
            }
            
            $characterSet = '0123456789012345678901234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $numericSet = '0123456789012345678901234567890';
            
            $setCodeInt = generateRandomString($numericSet, 5);
            $setCodeStamp = generateRandomString(strval(strtotime($Dateandtime)), 10);
            
            $MessageID = $setCodeStamp . $setCodeInt;

            $db = new dbase;
            $db->query("SELECT EmailAddress FROM Users WHERE EmailAddress= :EmailAddress ");
            $db->bind(':EmailAddress',$EmailAddress,PDO::PARAM_STR);
            $res_email_check = $db->fetchCount();

            $db->query("SELECT Username FROM Users WHERE Username=:Username");
            $db->bind(':Username',$Username,PDO::PARAM_STR);
            $res_username_check = $db->fetchCount();

            if ($res_email_check > 0) {
                set_error_msg("The email address $EmailAddress is already in use.");
                //echo '<script>alert("Email already in use")</script>'; 
                //exit("<script>window.open('https://linkwi.co/linkwi/register.php','_self')</script>");   
            }
            if ($res_username_check > 0) {
                //echo '<script>alert("Username already in use")</script>'; 
                set_error_msg("The username $Username is already in use. Please use a different username");
                //exit("<script>window.open('https://linkwi.co/public/registration.php','_self')</script>");	
            }
            if (($res_email_check == 0) and ($res_username_check == 0)) {

                if (($res_email_check === 0)) {
                    $query = "INSERT INTO Users (
                        Username, FirstName, LastName, ProfileImage, EmailAddress,
                        bcryptPassword, Date, UniqueID, MessageID, Active, AccountType, Role) 
                      VALUES (
                        :Username,:FirstName, :LastName, :pic, :EmailAddress,
                        :bcryptPassword, :Dateandtime, :UniqueID, :MessageID, :active, :accountype, :role)";
            
                    $params = [
                        ':Username'     => [$Username, PDO::PARAM_STR],
                        ':FirstName'    => [$FirstName, PDO::PARAM_STR],
                        ':LastName'     => [$LastName, PDO::PARAM_STR],
                        ':pic'          => [$pic, PDO::PARAM_STR],
                        ':EmailAddress' => [$EmailAddress, PDO::PARAM_STR],
                        ':bcryptPassword'     => [$Password, PDO::PARAM_STR],  // Assuming $Password is defined
                        ':Dateandtime'  => [$Dateandtime, PDO::PARAM_STR],
                        ':UniqueID'     => [$UniqueID, PDO::PARAM_STR],
                        ':MessageID'    => [$MessageID, PDO::PARAM_STR],
                        ':active'       => ['1', PDO::PARAM_STR],
                        ':accountype'   => ['0', PDO::PARAM_STR],
                        ':role'         => [$role, PDO::PARAM_STR],
                    ];
            
                    $db->query($query);
                    foreach ($params as $param => $value) {
                        $db->bind($param, $value[0], $value[1]);
                    }
                    $db->execute();       

                    GenerateQR($Username);


                    $db->query("INSERT INTO Views (UniqueID) VALUES (:UniqueID)");
                    $db->bind(':UniqueID', $UniqueID, PDO::PARAM_STR);
                    $db->execute();

                    $monthIndex = date("m");
                    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    $values = array_fill(0, 12, "Null"); // Fill an array with 12 'Null' values
                    $values[$monthIndex-1] = "'1'"; // Set the current month value to '1'
                    
                    $queryValues = implode(", ", $values) . "," . date("Y") . ",'$UniqueID'"; // Join the values into a string for the query
                    
                    $query = "INSERT INTO UserMonths (" . implode(", ", $months) . ", year, UniqueID) VALUES ($queryValues)";
                    $db->query($query);
                    $db->execute();

                    set_msg("Your registration was a success. Please check your email for more info.");

                    sendRegistrationSuccessEmail($EmailAddress, $FirstName, $LastName);

                    unset($_SESSION['EmailAddress']);
                    unset($_SESSION['FirstName']);
                    unset($_SESSION['LastName']);
                    unset($_SESSION['Username']);

                    $_SESSION['Userdata'] = array(

                            'EmailAddress' => $EmailAddress,
                            'LoginRole' => $role,
                            'UniqueID' => $UniqueID,
                            'Username' => $Username
                    );
                    if(isset($_GET['viewcart'])){
                    header("Location:../checkout");
                    die;
                    }else{
                    header("Location:index.php?dashboard&year=" . date("Y") . "&month=" . date("m") . "");
                        die;
                    }
                }
            }
        }
    }
} //end of submit



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LinkWi | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="admin/dist/css/linkwi.css" />
    <link rel="shortcut icon" type="image/jpg" href="images/icons/link-icon.jpg">
    <style>
    .card {
        border-radius: 22px;
    }

    .login-box,
    .register-box {
        max-width: 460px;
        width: 100%;
    }

    span#pass_type {
        position: absolute;
        bottom: 0;
        right: 5px;
        z-index: 9;
        filter: invert(1);
        color: #fdfdfd;
        font-size: 11px;
    }

    img#captchaimg {
        width: 160px;
    }

    .form-control {
        border: 0;
        border-bottom: 1px solid black;
        border-radius: 0;
    }

    div#meter {
        background: #fff;
        border-bottom: 1px solid #000;
    }

    .input-group-text {
        border: none;
        border-bottom: 1px solid #000;
        border-radius: 0 !important;
    }

    span.lock.input-group-addon {
        background: #fff;
    }

    i.fa.fa-check,
    i.fa.fa-times {
        padding-top: 13px;
    }

    label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 400;
    }

    .arrowpopup .tooltiptext {
    visibility: hidden;
    opacity: 0;  /* Set initial opacity to 0 */
    width: 207px;
    background-color: #f3f3f3;
    color: black;
    text-align: center;
    border-radius: 10px;
    padding: 9px;
    position: absolute;
    bottom: 112%;
    right: 0;
    margin-left: 5px;
    transition: opacity 0.3s, visibility 0.3s;  /* Add transition for opacity */
}

.arrowpopup .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #f3f3f3 transparent transparent transparent;
}

.arrowpopup:hover .tooltiptext {  /* Show tooltip on hover */
    visibility: visible;
    opacity: 1;  /* Set opacity to 1 to make it fully visible */
}


    .display-none {
        display: none;
    }

    .display-block {
        display: block;
    }
    </style>

    <script type='text/javascript'>
    function refreshCaptcha() {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
    }
    </script>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>Link</b>Wi</a>
        </div>
        <?php display_msg(); ?>

        <div class="card shadow">
            <div style="border-radius:20px" class="card-body register-card-body">
                <p class="login-box-msg">Create your free account</p>

                <form id="registerForm" action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="FirstName" placeholder="FirstName" value="<?php if (isset($_SESSION['FirstName'])) {
                                                                                                                    echo $_SESSION['FirstName'];
                                                                                                                } ?>"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="LastName" placeholder="LastName" value="<?php if (isset($_SESSION['LastName'])) {
                                                                                                                    echo $_SESSION['LastName'];
                                                                                                                } ?>"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="arrowpopup mt-3" onmouseenter="toolTip('tooltipEmail')"
                        onmouseleave="toolTip('tooltipEmail')">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="EmailAddress" placeholder="Email"
                                value="<?php if (isset($_SESSION['EmailAddress'])) {
                                                                                                                        echo $_SESSION['EmailAddress'];
                                                                                                                    } ?>" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <span class="tooltiptext" id="tooltipEmail">This will be your primary contact email. It
                                cannot be changed</span>
                        </div>
                    </div>
                    <div class="arrowpopup mt-3" onmouseenter="toolTip('tooltipUsername')"
                        onmouseleave="toolTip('tooltipUsername')">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="Username" placeholder="Username"
                                value="<?php if (isset($_SESSION['Username'])) {
                                                                                                                        echo $_SESSION['Username'];
                                                                                                                    } ?>" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <span class="tooltiptext" id="tooltipUsername">Your username will be used as part of your
                                unique url. It cannot be changed</span>
                        </div>
                    </div>


                    <div style="background-color: #f8f8f8;" class="mt-3 form-group">
                        <!-- form-group Starts -->
                        <div class="form-wrap form-wrap_icon linear-icon-lock">
                            <div class="input-group mb-3">
                                <!-- input-group Starts -->
                                <span class="lock input-group-addon">
                                    <!-- input-group-addon Starts -->
                                    <i class="fa fa-check tick shared-tick-class display-none"> </i>
                                    <i class="fa fa-times cross shared-cross-class"> </i>
                                </span><!-- input-group-addon Ends -->
                                <input type="password" class="form-control" id="pass" name="Password"
                                    placeholder="Password">
                                <span class="meter input-group-addon">
                                    <!-- input-group-addon Starts -->
                                    <div id="meter_wrapper">
                                        <!-- meter_wrapper Starts -->
                                        <div id="meter" style="height:38px"> <span id="pass_type"> </span> </div>
                                    </div><!-- meter_wrapper Ends -->
                                </span><!-- input-group-addon Ends -->
                            </div><!-- input-group Ends -->
                        </div><!-- form-group Ends -->
                    </div>


                    <div class="form-group">
                        <!-- form-group Starts -->
                        <div class="form-wrap form-wrap_icon linear-icon-lock">
                            <div class="input-group mb-3">
                                <!-- input-group Starts -->
                                <span class="lock input-group-addon">
                                    <!-- input-group-addon Starts -->
                                    <i class="fa fa-check tick shared-tick-class display-none"> </i>
                                    <i class="fa fa-times cross shared-cross-class"> </i>
                                </span><!-- input-group-addon Ends -->
                                <input type="password" class=" form-control confirm" id="con_pass"
                                    name="PasswordConfirm" placeholder="Confirm Password">
                            </div><!-- input-group Ends -->
                        </div><!-- form-group Ends -->

                    </div>
                    <div class="row">
                        <div class="col-12">

                            <!-- Captcha starts here  -->
                            <div>
                                <div class="text-center">
                                    <div>
                                        <!-- <label>Prove you're human</label> -->
                                        <p>
                                            <img src="captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'>
                                            <br><br>
                                            <input class="form-control" id="captcha_code" name="captcha_code"
                                                type="text" placeholder="Enter the code above here">
                                            <br><a class="text-dark" href='javascript: refreshCaptcha();'>Refresh
                                                image</a>
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms">
                                    I agree to the <u><a class="text-dark" href="https://linkwi.co/terms-of-use">terms
                                            of this platfom</a></u>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12">
                            <button id="submitButton" type="button" name="submit" value="SUBMIT"
                                class="btn btn-dark btn-block pt-3 pb-3 mt-3 mb-3" disabled>Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a class="text-dark" href="./login.php" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

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


    <script>
    $(document).ready(function() {
        var no = 0;
        $("#pass").keyup(function() {
            check_pass();
        });

    });

    check_pass = () => {
        let val = document.getElementById("pass").value;
        let meter = document.getElementById("meter");
        if (val != "") {
            // If the password length is less than or equal to 6
            if (val.length <= 6) no = 1;

            // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
            if (val.length > 6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(
                    /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))) no = 2;

            // If the password length is greater than 6 and contain alphabet,number,special character respectively
            if (val.length > 6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(
                    /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(
                    /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))) no = 3;

            // If the password length is greater than 6 and must contain alphabets,numbers and special characters
            if (val.length > 6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(
                    /.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))
                no = 4;

            if (no == 1) {
                $("#meter").animate({
                    width: '25px'
                }, 300);
                meter.style.backgroundColor = "#f16d9a";
                document.getElementById("pass_type").innerHTML = "Very Weak";
            }

            if (no == 2) {
                $("#meter").animate({
                    width: '50px'
                }, 300);
                meter.style.backgroundColor = "#F5BCA9";
                document.getElementById("pass_type").innerHTML = "Weak";
            }

            if (no == 3) {
                $("#meter").animate({
                    width: '70px'
                }, 300);
                meter.style.backgroundColor = "#FF8000";
                document.getElementById("pass_type").innerHTML = "Good";
            }

            if (no == 4) {
                $("#meter").animate({
                    width: '90px'
                }, 300);
                meter.style.backgroundColor = "#28a745";
                document.getElementById("pass_type").innerHTML = "Strong";
            }
            return no
        } else {
            meter.style.backgroundColor = "";
            document.getElementById("pass_type").innerHTML = "";
            return no
        }
    }
    </script>
    <script>
    function toolTip(tooltipName) {
        var tt = document.getElementById(tooltipName);
        tt.classList.toggle("show");
    }
    </script>


    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const passwordInput = document.getElementById('pass');
        const confirmPasswordInput = document.getElementById('con_pass');
        const submitButton = document.getElementById('submitButton');

        function updateCheckMarks() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            const isPasswordEmpty = !password || !confirmPassword;
            const isPasswordMatch = password === confirmPassword && password.length > 2;

            document.querySelectorAll('.shared-tick-class').forEach(tick => {
                tick.classList.toggle('display-block', isPasswordMatch && !isPasswordEmpty);
                tick.classList.toggle('display-none', !isPasswordMatch || isPasswordEmpty);
            });

            document.querySelectorAll('.shared-cross-class').forEach(cross => {
                cross.classList.toggle('display-block', !isPasswordMatch || isPasswordEmpty);
                cross.classList.toggle('display-none', isPasswordMatch && !isPasswordEmpty);
            });

            // Enable or disable the submit button
            submitButton.disabled = !(isPasswordMatch && !isPasswordEmpty);
        }

        // Event listeners
        passwordInput.addEventListener('keyup', updateCheckMarks);
        confirmPasswordInput.addEventListener('keyup', updateCheckMarks);

        // Convert button to submit type when clicked and valid
        submitButton.addEventListener('click', () => {
            if (!submitButton.disabled) {
                submitButton.type = 'submit';
                document.getElementById('registerForm').submit();
            }
        });
    });
    </script>
</body>

</html>