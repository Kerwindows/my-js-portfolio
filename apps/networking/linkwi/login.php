<?php
ob_start();
session_start();
require_once '../includes/linkwi.php';
include(LINKWI_FUNCTIONS_PATH . '/custom.toasts.php');
display_msg();
$purchaseMode = false;

if (isset($_GET['vewcart'])) {
    $purchaseMode = true;
}
if (isset($_SESSION['Userdata']['EmailAddress'])) {
    header("Location: linkwi/?dashboard");
}

if (isset($_POST["submit"])) {

    $loginrole = clean(sanitize($_POST["loginrole"]));
    $Username  = clean(sanitize($_POST["Username"]));
    $oldPassword  = sha1(clean(sanitize($_POST["Password"])));
    $newPassword  = clean(sanitize($_POST["Password"]));

    $db        = new dbase;
    $db->query("SELECT `UniqueID`, `EmailAddress`,`Username`,`Password`,`bcryptPassword`,`passwordUpgraded` FROM $loginrole WHERE (Username =:Username || EmailAddress =:Username ) LIMIT 1");
    $db->bind(':Username', $Username, PDO::PARAM_STR);
    $get_info = $db->fetchSingle();
if (!$get_info) {
    error_log('Database query failed: ' . print_r($db->errorInfo(), true));
    die('An error occurred while processing your request.');
}
    
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
        $db->query('SELECT * FROM subscriptions WHERE UniqueID="' . $get_info["UniqueID"] . '" ');
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

                $db->query('UPDATE ' . $loginrole . ' SET  `AccountType` =  "0" WHERE UniqueID = ::UniqueID ');
                $db->bind(':UniqueID',clean(sanitize($get_info["UniqueID"])),PDO::PARAM_STR);
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
            redirect($_SERVER['PHP_SELF']);
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Linkwi Dev" />
    <title>Linkwi Dev</title>
    <meta property="og:image" content="images/icons/link-icon.jpg" />
    <meta property="og:image:width" content="2000" />
    <meta property="og:image:height" content="1600" />
    <link rel="shortcut icon" type="image/jpg" href="images/icons/link-icon.jpg">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <link rel="stylesheet" href="admin/plugins/toastr/toastr.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="admin/dist/css/linkwi.css" />
</head>
<body class="hold-transition login-page school-login">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card shadow">
            <div class="card-header text-center">
                <img width="100%" src="<?php echo base_url() ?>/images/linkwi-og.webp" onerror="this.onerror=null; this.src='<?php echo base_url() ?>/images/linkwi-og.jpg'" alt="logo" />
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
    <script src="admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admin/dist/js/adminlte.min.js"></script>
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