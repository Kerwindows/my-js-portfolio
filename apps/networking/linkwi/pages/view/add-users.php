<?php
display_msg();
include 'phpqrcode/userQRgenerator.php';


if (!empty($_POST["submit"])) {


    if ((empty($_POST['FirstName'])) || (empty($_POST['LastName'])) || (empty($_POST['EmailAddress'])) || (empty($_POST['PasswordConfirm'])) || (empty($_POST['Password'])) || (empty($_POST['Username']))) {
        set_error_msg("Please full out all fields before submitting");
    } elseif ((clean(sanitize($_POST['PasswordConfirm']))) != (clean(sanitize($_POST['Password'])))) {
        set_error_msg("Passwords do not match");
    } else {


        $FirstName = check_Names($_POST['FirstName']);
        $LastName = check_Names($_POST['LastName']);
        $_EmailAddress = check_Email(strtolower($_POST['EmailAddress']));
        $Password = password_hash(clean(sanitize($_POST['Password'])), PASSWORD_DEFAULT);
        $corporateUsername = str_replace(' ', '', check_Input($_POST['Username']));
        $u = uniqid();
        $v = uniqid();
        $UniqueID     = $u . strtotime("now");


        $role = "Users";
        $pic = "default.png";

        function generateRandomString($characters, $length)
        {
            return substr(str_shuffle($characters), 0, $length);
        }

        $characterSet = '0123456789012345678901234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numericSet = '0123456789012345678901234567890';

        $setCodeInt = generateRandomString($numericSet, 5);
        $setCodeStamp = generateRandomString(strval(strtotime($Dateandtime)), 10);

        $MessageID = $setCodeStamp . $setCodeInt;


        $db = new dbase;
        $db->query("SELECT EmailAddress FROM Users WHERE EmailAddress= :EmailAddress ");
        $db->bind(':EmailAddress', $_EmailAddress, PDO::PARAM_STR);
        $res_email_check = $db->fetchCount();

        $db->query("SELECT corporateUsername FROM Users WHERE corporateUsername= :corporateUsername ");
        $db->bind(':corporateUsername', $corporateUsername, PDO::PARAM_STR);
        $res_corporateUsername_check = $db->fetchCount();

        if ($res_email_check > 0) {
            set_error_msg("The email address $_EmailAddress is already in use.");
            redirect('?add-users');
            exit();
        }

        if ($res_corporateUsername_check > 0) {
            set_error_msg("The username $corporateUsername is already in use.");
            redirect('?add-users');
            exit();
        }

        if (($res_email_check === 0)) {
            $query = "INSERT INTO Users (
                    Username, corporateUsername, FirstName, LastName, ProfileImage, EmailAddress,
                    bcryptPassword, Date, UniqueID, MessageID, Active, AccountType, Role) 
                  VALUES (
                    :Username,:corporateUsername, :FirstName, :LastName, :pic, :EmailAddress,
                    :bcryptPassword, :Dateandtime, :UniqueID, :MessageID, :active, :accountype, :role)";

            $params = [
                ':Username'     => [$Username, PDO::PARAM_STR],
                ':corporateUsername' => [$corporateUsername, PDO::PARAM_STR],
                ':FirstName'    => [$FirstName, PDO::PARAM_STR],
                ':LastName'     => [$LastName, PDO::PARAM_STR],
                ':pic'          => [$pic, PDO::PARAM_STR],
                ':EmailAddress' => [$_EmailAddress, PDO::PARAM_STR],
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

            $db->query("INSERT INTO Views (UniqueID) VALUES (:UniqueID)");
            $db->bind(':UniqueID', $UniqueID, PDO::PARAM_STR);
            $db->execute();

            $monthIndex = date("m");
            $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            $values = array_fill(0, 12, "Null"); // Fill an array with 12 'Null' values
            $values[$monthIndex - 1] = "'1'"; // Set the current month value to '1'

            $queryValues = implode(", ", $values) . "," . date("Y") . ",'$UniqueID'"; // Join the values into a string for the query

            $query = "INSERT INTO UserMonths (" . implode(", ", $months) . ", year, UniqueID) VALUES ($queryValues)";
            $db->query($query);
            $db->execute();
            GenerateQR($Username, $corporateUsername, 'Corp');
            // put some if statement here 
            set_msg("New user added");
            redirect($_SERVER['PHP_SELF']);
            exit();
            //sendRegistrationSuccessEmail($_EmailAddress, $FirstName, $LastName); 
        }
    }
} //end of submit



?>



<section class="content-header">
    <div class="container">
        <div class='row mb-2'>
            <div class='col-sm-6'>
                <h1 class='m-0'>Add New User Profile</h1>
            </div>
            <!-- /.col -->
            <div class='col-sm-6'>
                <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item active'><a href='?dashboard'>Dashboard</a> </li>
                    <li class='breadcrumb-item'><a href='?user-profiles' target='_blank'>View
                            Profile</a> </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /block 1-->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div style="border-radius:20px" class="card-body register-card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Firstname</strong>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="FirstName" value="" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text add-user__input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <strong>Lastname</strong>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="LastName" placeholder="" value="" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text add-user__input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <strong>Email</strong>
                                    <div class="arrowpopup mt-3" onmouseenter="toolTip('tooltipEmail')" onmouseleave="toolTip('tooltipEmail')">
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" name="EmailAddress" value="" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text add-user__input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <span class="tooltiptext" id="tooltipEmail">This will be their primary contact email. It cannot be changed</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <strong>Username</strong>
                                    <div class="arrowpopup mt-3" onmouseenter="toolTip('tooltipUsername')" onmouseleave="toolTip('tooltipUsername')">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="Username" value="" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text add-user__input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            <span class="tooltiptext" id="tooltipUsername">This username will be used as part of
                                                your their unique url. It can be changed.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <strong>Password</strong>
                               
                                        <!-- form-group Starts -->
                                        <div class="form-wrap form-wrap_icon linear-icon-lock">
                                            <div class="input-group mb-3">
                                                <!-- input-group Starts -->
                                                <span class="add-user__lock input-group-addon">
                                                    <!-- input-group-addon Starts -->
                                                    <i class="fa fa-check tick text-success shared-tick-class display-none"> </i>
                                                    <i class="fa fa-times cross text-danger shared-cross-class display-none"> </i>
                                                </span><!-- input-group-addon Ends -->
                                                <input type="password" class="form-control" id="pass" name="Password">
                                                <span class="add-user__meter input-group-addon">
                                                    <!-- input-group-addon Starts -->
                                                    <div id="meter_wrapper">
                                                        <!-- meter_wrapper Starts -->
                                                        <div id="add-user__meter" style="height:38px"> <span id="add-user__pass-type"> </span>
                                                        </div>
                                                    </div><!-- meter_wrapper Ends -->
                                                </span><!-- input-group-addon Ends -->
                                            </div><!-- input-group Ends -->
                                        </div><!-- form-group Ends -->
                                   
                                </div>
                                <div class="col-md-6">
                                    <strong>Confirm Password</strong>
                                    <div class="form-group">
                                        <!-- form-group Starts -->
                                        <div class="form-wrap form-wrap_icon linear-icon-lock">
                                            <div class="input-group mb-3">
                                                <!-- input-group Starts -->
                                                <span class="add-user__lock input-group-addon">
                                                    <!-- input-group-addon Starts -->
                                                    <i class="fa fa-check tick text-success shared-tick-class display-none"> </i>
                                                    <i class="fa fa-times cross text-danger shared-cross-class display-none"> </i>
                                                </span><!-- input-group-addon Ends -->
                                                <input type="password" class=" form-control confirm" id="con_pass" name="PasswordConfirm">
                                            </div><!-- input-group Ends -->
                                        </div><!-- form-group Ends -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button id="submitButton" type="button" name="submit" value="SUBMIT" disabled class="btn btn-dark btn-block pt-3 pb-3 mt-3 mb-3">Register</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
            </div>
</section>



<script>
    $(document).ready(function() {
        var no = 0;
        $("#pass").keyup(function() {
            check_pass();
        });

    });

    check_pass = () => {
        let val = document.getElementById("pass").value;
        let meter = document.getElementById("add-user__meter");
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
            if (val.length > 6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))
                no = 4;

            if (no == 1) {
                $("#add-user__meter").animate({
                    width: '25px'
                }, 300);
                meter.style.backgroundColor = "#f16d9a";
                document.getElementById("add-user__pass-type").innerHTML = "Very Weak";
            }

            if (no == 2) {
                $("#add-user__meter").animate({
                    width: '50px'
                }, 300);
                meter.style.backgroundColor = "#F5BCA9";
                document.getElementById("add-user__pass-type").innerHTML = "Weak";
            }

            if (no == 3) {
                $("#add-user__meter").animate({
                    width: '70px'
                }, 300);
                meter.style.backgroundColor = "#FF8000";
                document.getElementById("add-user__pass-type").innerHTML = "Good";
            }

            if (no == 4) {
                $("#add-user__meter").animate({
                    width: '90px'
                }, 300);
                meter.style.backgroundColor = "#28a745";
                document.getElementById("add-user__pass-type").innerHTML = "Strong";
            }
            return no
        } else {
            meter.style.backgroundColor = "";
            document.getElementById("add-user__pass-type").innerHTML = "";
            return no
        }
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