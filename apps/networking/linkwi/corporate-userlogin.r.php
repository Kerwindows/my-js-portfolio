<?php
session_start();
require_once 'includes/classes/get.siteSettings.php';
include(LINKWI_FUNCTIONS_PATH . '/custom.toasts.php');
$f =  new SiteSettings;
display_msg();
$purchaseMode = false;

if (isset($_GET['vewcart'])) {
    $purchaseMode = true;
}
if (isset($_SESSION['Userdata']['EmailAddress'])) {
    header("Location: /linkwi/?dashboard");
}

if (isset($_POST["submit"])) {

    $loginrole = clean(sanitize($_POST["loginrole"]));
    $corporateUsername  = clean(sanitize($_POST["Username"]));
    $Username  = clean(sanitize($_POST["Company"]));
    $oldPassword  = sha1(clean(sanitize($_POST["Password"])));
    $newPassword  = clean(sanitize($_POST["Password"]));

    $db        = new dbase;
    $db->query("SELECT `UniqueID`, `EmailAddress`,`Username`,`Password`,`bcryptPassword`,`passwordUpgraded`,corporateUsername FROM $loginrole WHERE (Username =:Username || EmailAddress =:Username ) AND corporateUsername = :corporateUsername LIMIT 1");
    $db->bind(':Username', $Username, PDO::PARAM_STR);
    $db->bind(':corporateUsername', $corporateUsername, PDO::PARAM_STR);    
    $get_info = $db->fetchSingle();
    if ($get_info && password_verify($newPassword, $get_info['bcryptPassword'])) {
        $_SESSION['Userdata']      = array(
            'EmailAddress' => $get_info["EmailAddress"],
            'LoginRole' => $loginrole,
            'UniqueID' => $get_info["UniqueID"],
            'Username' => $get_info["Username"]
        );
        if (isset($_SESSION['newPasswordSet'])) {
            unset($_SESSION['newPasswordSet']);
        }
        /* --------------------------- check subscription --------------------------- */
        $db->query('SELECT * FROM subscriptions WHERE UniqueID=:UniqueID');
        $db->bind(':UniqueID',$get_info["UniqueID"],PDO::PARAM_STR);
        $getSub = $db->fetchSingle();

        //echo "<pre>";
       // print_r($getSub);
        //echo "</pre>";
        
        if (!empty($getSub)) {

            $start_date     = new DateTime($getSub['Start']);
            $end_date       = new DateTime($getSub['End']);
            $today_date     = new DateTime();

            /* ------------------- check if user subscription expired ------------------- */
            if ($start_date <= $today_date && $today_date <= $end_date) {
            //do nothing
            } else {

                $db->query('UPDATE ' . $loginrole . ' SET  `AccountType` =  "0" WHERE UniqueID = :UniqueID ');
                $db->bind(':UniqueID',$get_info["UniqueID"],PDO::PARAM_STR);
                $db->execute();
            }

            $db->closeConnection();
            if ($purchaseMode) {
                redirect("/checkout");
                exit();
            } else {
                redirect("/linkwi/?dashboard&year=" . date("Y") . "&month=" . date("m"));
                exit();
            }
        }else{
        redirect("/linkwi/?dashboard&year=" . date("Y") . "&month=" . date("m"));
                exit();
        }
    } else {
        if ($get_info['passwordUpgraded'] == 1) {

            if ($oldPassword == $get_info['Password']) {
                //send to upgrade
                $_SESSION['newPasswordSet'] = true;
                $_SESSION['Userdata']      = array(
                    'EmailAddress' => $get_info["EmailAddress"],
                    'LoginRole' => $loginrole,
                    'UniqueID' => $get_info["UniqueID"],
                    'Username' => $get_info["Username"]
                );
                header("Location:/linkwi/index.php?password");
            } else {
                set_error_msg("Incorrect Username/Password");
                redirect($_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            set_error_msg("Incorrect Username/Password");
            redirect('corporate-userlogin');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <title>Linkwi Digital Business Card ®</title>
    <meta
      name="description"
      content="Linkwi is an online business card solution that allows you to easily create and share your professional online presence. With Linkwi, you can create a customizable, interactive business card that includes your contact information, work history, and social media profiles. You can also add multimedia elements, such as photos, videos, and documents, to enhance your digital business card and showcase your skills and achievements. Whether you are a freelancer, small business owner, or corporate professional, Linkwi helps you connect with potential clients and partners in a modern and efficient way using NFC technology, QR Code scanning or Vcard download."
    />
    <meta charset="utf-8" />
    <meta name="Linkwi Digital Business Card ®" content="https://linkwi.co/" />
    <!--[if IE
      ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"
    /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:url" content="https://linkwi.co/linkwi/corporate-userlogin.php" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Linkwi Digital Business Card ®" />
    <meta
      property="og:description"
      content="Linkwi is an online business card solution that allows you to easily create and share your professional online presence. With Linkwi, you can create a customizable, interactive business card that includes your contact information, work history, and social media profiles. You can also add multimedia elements, such as photos, videos, and documents, to enhance your digital business card and showcase your skills and achievements. Whether you are a freelancer, small business owner, or corporate professional, Linkwi helps you connect with potential clients and partners in a modern and efficient way using NFC technology, QR Code scanning or Vcard download."
    />
    <meta
      property="og:image"
      content="https://linkwi.co/linkwi/images/frontpage-pics/frontpageimg.jpg"
    />
    <meta
      property="og:image:url"
      content="https://linkwi.co/linkwi/images/frontpage-pics/frontpageimg.jpg"
    />
    <meta property="og:image:width" content="715px" />
    <meta property="og:image:width" content="899px" />
    <meta
      property="twitter:image"
      content="https://linkwi.co/linkwi/images/frontpage-pics/frontpageimg.jpg"
    />
    <!-- Favicons -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/linkwi/admin/plugins/fontawesome-free/css/all.min.css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/linkwi/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <link rel="stylesheet" href="/linkwi/admin/plugins/toastr/toastr.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="/linkwi/admin/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="/linkwi/admin/dist/css/linkwi.css" />
</head>

<body class="hold-transition login-page school-login">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card shadow">
            <div class="card-header text-center">
                <img width="100%" src="https://linkwi.co/images/linkwi-og.webp" onerror="this.onerror=null; this.src='http://linkwi.co/images/linkwi-og.jpg'" alt="logo" />
                <span class="badge badge-info">Corporate User Login</span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="POST">
                    <div class="input-group mb-3">
                        <select hidden class="custom-select form-control-border" name="loginrole" id="Role">
                            <option value="Users">CardHolder</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="Company" class="form-control" placeholder="Company" autocomplete="false" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="Username" class="form-control" placeholder="Email/ Username" autocomplete="false" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="Password" class="form-control" placeholder="Password" autocomplete="false" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="mb-4">
                                <a class="text-dark" href="reset-password.php">I forgot my password</a>
                            </p>
                            <p class="mb-4">
                                <a class="text-dark" href="https://linkwi.co/linkwi/register.php<?php if ($purchaseMode == true) {
                                                                                                    echo "?viewcart=1";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>">Register
                                    Here</a>
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-12">
                            <input id="button" type="submit" name="submit" class="btn btn-dark btn-block pt-3 pb-3" value="Login" />
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
    <script src="/linkwi/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/linkwi/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/linkwi/admin/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fadeout").fadeIn("slow").delay(3000).fadeOut("slow");
        });
    </script>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    } 
</script>
</body>

</html>