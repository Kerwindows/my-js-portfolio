<?php
//prevent external access
if (!defined('PROJECT_PATH')) {
    exit("<script>window.open('https://linkwi.co/we-see-you.php','_self')</script>");
}

display_msg();

if (isset($_POST["background_banner_submit"])) {
    $background_banner = clean(sanitize(($_POST['background_banner'])));

    $sql = new dbase;
    $sql->query("UPDATE Users SET User_Banner_Image = :background_banner WHERE UserID=:userid");

    $sql->bind(':background_banner', $background_banner ?: null, PDO::PARAM_STR);
    $sql->bind(':userid', $infouser['UserID'], PDO::PARAM_INT);

    if ($sql->execute()) {
        $sql->closeConnection();
        set_msg('Profile Saved');
        header("location: ?edit-canvas");
        exit();
    } else {
        $sql->closeConnection();
        set_msg('Error Saving Profile');
        header("location: ?edit-info");
        exit();
    }
}

if (isset($_POST["background_banner_url_submit"])) {
    $background_banner_url = clean(sanitize($_POST['background_banner_url']));

    // Validate the URL format
    if (!filter_var($background_banner_url, FILTER_VALIDATE_URL)) {
        // Invalid URL
        set_msg('Invalid URL');
        header("location: ?edit-info");
        exit();
    }

    // Validate if the URL points to an image
    $image_info = getimagesize($background_banner_url);
    if (!$image_info || !in_array($image_info[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF])) {
        // URL does not point to a valid image
        set_msg('URL is not a valid image');
        header("location: ?edit-info");
        exit();
    }

    $sql = new dbase;
    $sql->query("UPDATE Users SET User_Banner_Image = :background_banner_url WHERE UserID=:userid");

    $sql->bind(':background_banner_url', $background_banner_url ?: null, PDO::PARAM_STR);
    $sql->bind(':userid', $infouser['UserID'], PDO::PARAM_INT);

    if ($sql->execute()) {
        $sql->closeConnection();
        set_msg('Profile Saved');
        header("location: ?edit-canvas");
        exit();
    } else {
        $sql->closeConnection();
        set_msg('Error Saving Profile');
        header("location: ?edit-canvas");
        exit();
    }
}

?>

<style>
.custom-dropdown {
    position: relative;
    width: 100%;
    /* Adjust width as needed */
}

.dropdown-select {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    border: 1px solid #ccc;
    border-top: 0px;
    border-left: 0px;
    border-right: 0px;
    cursor: pointer;
}

.dropdown-options {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    max-height: 400px;
    /* Adjust max height as needed */
    overflow-y: auto;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top: none;
    display: none;
    padding-left: 0;
    list-style: none;
}

.dropdown-options li {
    padding: 10px;
    cursor: pointer;
}

.dropdown-options li:hover {
    background-color: #f5f5f5;
}

.dropdown-options li img {
    max-width: 100%;
    height: auto;
}

.custom-dropdown.open .dropdown-options {
    display: block;
}

.background-image {
    width: 100%;
}

.mobile__container {
    position: relative;
    max-width: 600px;
    margin-left: 30px;
    transition: 0.3s;
}

.mobile__img {
    position: relative;
    width: 100%;
    height: 1059px;
    right: 0;
    left: 0;
    top: 0;
    bottom: 0;
    margin: auto;
}

.mobile__iframe {
    position: absolute;
    width: 88%;
    height: 1000px;
    z-index: 2;
    border: none;
    border-radius: 7%;
    right: 0;
    left: 0;
    top: 0px;
    bottom: 0;
    margin: auto;
}

.frontend-editbtn {
    margin: 0 auto 0 30px;
    transition: 0.3s;
    border-radius: 15px;
    padding: 15px;
}

@media only screen and (max-width: 660px) {
    .mobile__container {
        margin-left: 0px;
    }

    .frontend-editbtn {
        margin: 0 auto 0 0;
    }
}
</style>



<section class="content-header">
    <div class="container-fluid">
        <!--start of header row-->
        <div class='row mb-2'>
            <div class='col-sm-6'>
                <h1 class='m-0'>Edit Your Canvas</h1>
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

                <main class="row">
                    <article class="col-md-6">
                        <section style="position:relative;max-width:600px;margin-left: 3px;">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <a class="frontend-editbtn btn btn-dark shadow"
                                        href="../card/<?php echo $Username ?>" target="_self">Click here to edit
                                        on the Front-end</a>

                                </div>
                            </div>
                        </section>
                        <!--content-header-->

                        <div class="mobile__container">
                            <img class="mobile__img iframe-phone" src="images/frontpage-pics/iphone.png" />
                            <iframe class="mobile__iframe"
                                src="https://linkwi.co/card/<?php echo $Username ?>"></iframe>


                        </div>
                    </article>
                    <article class="col-md-6">
                        <div class="card">
                            <div class="card-body box-profile">

                                <form method='POST' enctype='multipart/form-data'>
                                    <label for="fileupload">Upload Image URL</label>
                                    <div class="background-image_url"></div>
                                    <input class="form-control" type="url" name="background_banner_url" value=""
                                        required>
                                    <button name="background_banner_url_submit" type="submit"
                                        class="btn btn-primary float-right mt-4">Update</button>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body box-profile">
                                <form method='POST' enctype='multipart/form-data'>

                                    <label for="fileupload">Background images</label>
                                    <div class="custom-dropdown">
                                        <div class="dropdown-select">
                                            <span>Select an image</span>
                                            <i class="fa fa-chevron-down"></i>
                                        </div>
                                        <ul class="dropdown-options">
                                            <?php for ($i = 0; $i <= 8; $i++) : ?>
                                            <li data-value="background-<?php echo $i; ?>.jpg">
                                                <img width="100%"
                                                    src="./images/profile-backgrounds/background-<?php echo $i; ?>.jpg"
                                                    alt="Image <?php echo $i; ?>">
                                            </li>
                                            <?php endfor; ?>
                                        </ul>
                                    </div>
                                    <div class="background-image"></div>
                                    <input type="hidden" name="background_banner" value="">
                                    <button name="background_banner_submit" type="submit"
                                        class="btn btn-primary float-right mt-4">Update</button>
                                </form>
                            </div>
                        </div>
                    </article>
                </main>

            </div>

        </div>
    </div>
</section>









<script>
// Toggle dropdown options
const dropdownSelect = document.querySelector('.dropdown-select');
dropdownSelect.addEventListener('click', function() {
    this.parentNode.classList.toggle('open');
});

// Select an option
const dropdownOptions = document.querySelectorAll('.dropdown-options li');
dropdownOptions.forEach(function(option) {
    option.addEventListener('click', function() {
        const selectedValue = this.getAttribute('data-value');
        const selectedText = this.innerHTML;
        document.querySelector('.background-image').innerHTML = selectedText;
        document.querySelector('input[name="background_banner"]').value = selectedValue || '';
        dropdownSelect.parentNode.classList.remove('open');
        // Use selectedValue as needed
    });
});

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdownContainer = document.querySelector('.custom-dropdown');
    if (!dropdownContainer.contains(event.target)) {
        dropdownContainer.classList.remove('open');
    }
});
</script>