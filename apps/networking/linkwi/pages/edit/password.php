<?php
if (!defined('PROJECT_PATH')) {
    header("Location: ../../../we-see-you.php");
    exit();
}
display_msg();
if (isset($_POST["password_submit"])) {
    $new_password = clean(sanitize($_POST["new_password"]));
    $confirm_password = clean(sanitize($_POST["confirm_password"]));

    if ($new_password === $confirm_password) {
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = new dbase;
        $sql->query("UPDATE Users SET bcryptPassword = :new_password,passwordUpgraded = :passwordUpgaraded WHERE UniqueID= :id ");
        $sql->bind(':new_password', $new_password, PDO::PARAM_STR);
        $sql->bind(':passwordUpgaraded', 0, PDO::PARAM_STR);
        $sql->bind(':id', $UniqueID, PDO::PARAM_STR);

        if ($sql->execute()) {
            unset($_SESSION['newPasswordSet']);
            set_msg('Password changed');
            header("location: ?password");
        }
    } else {
        set_error_msg('Passwords do not match');
        header("location: ?password");
        die();
    }
} 

?>
<!-- Main content -->
<section class="content-header">
    <div class="container">
        <!--start of header row-->
        <div class='row mb-2'>
            <div class='col-sm-6'>
                <h1 class='m-0' id="page-title"></h1>
            </div>
            <!-- /.col -->
            <div class='col-sm-6'>
                <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item'>
                        <a href='?dashboard'>Dashboard
                        </a>
                    </li>
                    <li class='breadcrumb-item active'>Edit Profile
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
     <?php if(isset($_SESSION['newPasswordSet'])){  ?> 
     <div class="row">
        <div class="col-md-12">
        <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-info"></i> Enhanced Security Update: Immediate Password Change Required</h5>
                 
                 🔄 Immediate Action: Please Update Your Password<br/><br/>

In order to implement this new security feature and ensure that your account benefits from this enhancement:<br/><br/>

Please change your password immediately using the form below.
Ensure your new password is strong, combining upper and lower case letters, numbers, and special characters.<br/><br/>
🤔 Why is this necessary?

This proactive measure increases the cryptographic strength of stored passwords, rendering them even more resilient against potential future cyber threats. Though we have no indications of any compromise to our previous system, this update further solidifies our defenses.<br/><br/>

🛡️ Committed to Your Digital Safety

Your security and privacy are our top priority. Our team continuously works to adopt and implement the latest security technologies and practices to safeguard your data. Rest assured, these enhancements have been thoroughly tested to ensure a seamless and secure user experience.<br/><br/>
                </div>
            </div>
        </div> 
        <?php } ?>
        <div class="row">
            <div class="col-md-6 ">
                <!-- Profile Image -->
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method='post'>
                            <strong>
                                New Password
                            </strong>
                            <p class="text-muted">
                            <div class="input-group mb-3 form-group">
                                <input class="form-control" type="password" name="new_password" autocomplete='false'
                                    required />
                            </div>
                            </p>
                            <strong>
                                Confirm Password
                            </strong>
                            <p class="text-muted">
                            <div class="input-group mb-3 form-group">
                                <input id="confirm-password" class="form-control" type="password"
                                    name="confirm_password" autocomplete='false' required />
                            </div>
                            </p>
                            <input type="submit" name="password_submit" value="Update"
                                class="btn btn-primary float-right">
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
</section>