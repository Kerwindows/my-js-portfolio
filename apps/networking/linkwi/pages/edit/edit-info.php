<?php
//prevent external access
if (!defined('PROJECT_PATH')) {

    exit("<script>window.open('https://linkwi.co/we-see-you.php','_self')</script>");
}

display_msg();

if (isset($_POST["profile_submit"])) {

    $firstname           = check_Names($_POST['firstname']);
    $lastname            = check_Names($_POST['lastname']);
    $bemail              = check_Input($_POST['bemail']);
    $bcontact            = check_Input($_POST['bcontact']);
    $address             = check_Input($_POST['address']);
    $city                = check_Input($_POST['city']);

    $sql = new dbase;
    $sql->query("UPDATE Users SET 
    FirstName = :firstname,
    LastName = :lastname,
    BusinessEmailAddress = :bemail,
    BusinessContact = :bcontact,
    Address = :address,
    City = :city
    WHERE UserID='" . $infouser['UserID'] . "' ");

    $sql->bind(':firstname', $firstname, PDO::PARAM_STR);
    $sql->bind(':lastname', $lastname, PDO::PARAM_STR);
    $sql->bind(':bemail', $bemail, PDO::PARAM_STR);
    $sql->bind(':bcontact', $bcontact, PDO::PARAM_STR);
    $sql->bind(':address', $address, PDO::PARAM_STR);
    $sql->bind(':city', $city, PDO::PARAM_STR);

    if ($sql->execute()) {
        $sql->closeConnection();
        set_msg('Profile Saved');
        header("location: ?edit-info");
        exit();
    } else {
        $sql->closeConnection();
        set_msg('Error Saving Profile');
        header("location: ?edit-info");
        exit();
    }
}

?>


<!-- Main content -->
<section class="content-header">
    <div class="container">
        <!--start of header row-->
        <div class='row mb-2'>
            <div class='col-sm-6'>
                <h1 class='m-0'>Edit Your Profile</h1>
            </div>
            <!-- /.col -->
            <div class='col-sm-6'>
                <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item'> <a href='?dashboard'>Dashboard</a> </li>
                    <li class='breadcrumb-item active'>Contact Info</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="card">
                    <div class="card-body box-profile">
                        <form method='POST' enctype='multipart/form-data'>

                            <main class="row">


                                <article class="col-md-6">
                                    <div class="form-group">
                                        <label><strong for="fileupload">First Name</strong></label>
                                        <div class="input-group mb-3 form-group">
                                            <input class="form-control text-muted" type="text" name="firstname" value='<?php echo $infouser['FirstName']; ?>' required />
                                        </div>
                                    </div>
                                </article>

                                <article class="col-md-6">
                                    <div class="form-group">
                                        <label><strong for="fileupload">Last Name</strong></label>
                                        <div class="input-group mb-3 form-group">
                                            <input class="form-control text-muted" type="text" name="lastname" value='<?php echo $infouser['LastName']; ?>' required />
                                        </div>
                                    </div>
                                </article>

                                <article class="col-md-6">
                                    <div class="form-group">
                                        <label><strong for="fileupload">Business Email</strong></label>
                                        <div class="input-group mb-3 form-group">
                                            <input class="form-control" type="text" name="bemail" value='<?php echo $infouser['BusinessEmailAddress']; ?>' />
                                        </div>
                                    </div>
                                </article>

                                <article class="col-md-6">
                                    <div class="form-group">
                                        <label><strong for="fileupload">Business Contact</strong></label>
                                        <div class="input-group mb-3 form-group">
                                            <input class="form-control text-muted" type="num" name="bcontact" value='<?php echo $infouser['BusinessContact']; ?>' />
                                        </div>
                                    </div>
                                </article>

                                <article class="col-md-6">
                                    <div class="form-group">
                                        <label><strong for="fileupload">Username</strong></label>
                                        <div class="input-group mb-3 form-group">
                                            <p><?php echo $infouser['Username']; ?></p>
                                        </div>
                                    </div>
                                </article>

                                <article class="col-md-6">
                                    <div class="form-group">
                                        <label><strong for="fileupload">Account Email</strong></label>
                                        <div class="input-group mb-3 form-group">
                                            <p><?php echo $infouser['EmailAddress']; ?></p>
                                        </div>
                                    </div>
                                </article>



                                <article class="col-md-6">
                                    <div class="form-group">
                                        <label><strong for="fileupload">Address</strong></label>
                                        <div class="input-group mb-3 form-group">
                                            <input class="form-control text-muted" type="text" name="address" value='<?php echo $infouser['Address']; ?>' />
                                        </div>
                                    </div>
                                </article>

                                <article class="col-md-6">
                                    <div class="form-group">
                                        <label><strong for="fileupload">Address 2</strong></label>
                                        <div class="input-group mb-3 form-group">
                                            <input class="form-control text-muted" type="text" name="city" value='<?php echo $infouser['City']; ?>' />
                                        </div>
                                    </div>
                                </article>

                               
                            </main>
                            <button name="profile_submit" type="submit" class="btn btn-primary float-right">Update</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>