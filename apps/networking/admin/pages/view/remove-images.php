<?php
//prevent external access
if (!defined('PROJECT_PATH')) {
    exit("<script>window.open('https://linkwi.co/we-see-you.php','_self')</script>");
}


if (isset($_POST["delete_unused_images"])) {

    $get = new dbase;
    $get->query("SELECT ProfileImage FROM Users WHERE ProfileImage != 'default.png'");
    $showImages = $get->fetchMultiple();
    foreach ($showImages as $showImage) {
        $image[] = $showImage['ProfileImage'];
    }

    $filespath = (LINKWI_IMG_PATH . "/profile-images/");
    // (A) GET ALL FILES + FOLDERS
    $contents = scandir($filespath);

    // PASS IN A SECOND PARAMETER TO SORT
    //$contents = scandir($target, SCANDIR_SORT_DESCENDING);
    //$contents = scandir($target, SCANDIR_SORT_NONE);

    // (B) LOOP THROUGH ALL FILES + FOLDERS
    foreach ($contents as $c) {
        if ($c != "." && $c != ".." && $c != 'default.png') {
            // echo is_dir($c) ? "DIR" : "FILE" ;
            //echo " - $c<br>";

            if (!in_array($c, $image) && $c != 'default.png') {
                unlink(LINKWI_IMG_PATH . "/profile-images/" . $c);
            }
        }
    }
    redirect("?remove-images");
    $get = NULL;
}


if (isset($_POST["delete_unused_logos"])) {

    $get = new dbase;
    $get->query("SELECT Image_one FROM Users");
    $showImages = $get->fetchMultiple();
    foreach ($showImages as $showImage) {
        $image[] = $showImage['Image_one'];
    }

    $filespath = (LINKWI_IMG_PATH . "/profile-logos/");
    // (A) GET ALL FILES + FOLDERS
    $contents = scandir($filespath);

    // PASS IN A SECOND PARAMETER TO SORT
    //$contents = scandir($target, SCANDIR_SORT_DESCENDING);
    //$contents = scandir($target, SCANDIR_SORT_NONE);

    // (B) LOOP THROUGH ALL FILES + FOLDERS
    foreach ($contents as $c) {
        if ($c != "." && $c != ".." && $c != 'sampleLogo.jpg') {
            // echo is_dir($c) ? "DIR" : "FILE" ;
            //echo " - $c<br>";

            if (!in_array($c, $image) && $c != 'sampleLogo.jpg') {
                unlink(LINKWI_IMG_PATH . "/profile-logos/" . $c);
            }
        }
    }
    redirect("?remove-images");
    $get = NULL;
}

if (isset($_POST["delete_unused_card_images"])) {

    $get = new dbase;
    $get->query("SELECT pro_logo_image FROM customer_orders");
    $showImages = $get->fetchMultiple();
    foreach ($showImages as $showImage) {
        $image[] = $showImage['pro_logo_image'];
    }

    $filespath = ("../images/card-images/");
    // (A) GET ALL FILES + FOLDERS
    $contents = scandir($filespath);

    // PASS IN A SECOND PARAMETER TO SORT
    //$contents = scandir($target, SCANDIR_SORT_DESCENDING);
    //$contents = scandir($target, SCANDIR_SORT_NONE);

    // (B) LOOP THROUGH ALL FILES + FOLDERS
    foreach ($contents as $c) {
        if ($c != "." && $c != ".." && $c != 'linkwi-logo.jpg') {
            // echo is_dir($c) ? "DIR" : "FILE" ;
            //echo " - $c<br>";

            if (!in_array($c, $image) && $c != 'linkwi-logo.jpg') {
                unlink("../images/card-images/" . $c);
            }
        }
    }
    redirect("?remove-images");
    $get = NULL;
}

if (isset($_POST["delete_links_images"])) {

    $get = new dbase;
    $get->query("SELECT link_img FROM links");
    $showImages = $get->fetchMultiple();
    foreach ($showImages as $showImage) {
        $image[] = $showImage['link_img'];
    }

    $filespath = (LINKWI_IMG_PATH . "/profile-links/");
    // (A) GET ALL FILES + FOLDERS
    $contents = scandir($filespath);

    // PASS IN A SECOND PARAMETER TO SORT
    //$contents = scandir($target, SCANDIR_SORT_DESCENDING);
    //$contents = scandir($target, SCANDIR_SORT_NONE);

    // (B) LOOP THROUGH ALL FILES + FOLDERS
    foreach ($contents as $c) {
        if ($c != "." && $c != ".." && $c != 'default.png') {
            // echo is_dir($c) ? "DIR" : "FILE" ;
            //echo " - $c<br>";

            if (!in_array($c, $image) && $c != 'default.png') {
                unlink(LINKWI_IMG_PATH . "/profile-links/" . $c);
            }
        }
    }
    redirect("?remove-images");
    $get = NULL;
}
?>


<!-- Main content -->
<section class="content-header">
    <div class="container-fluid">
        <!--start of header row-->
        <div class='row mb-2'>
            <div class='col-sm-6'>
                <h1 class='m-0'>Remove Unused Images</h1>
            </div>
            <!-- /.col -->
            <div class='col-sm-6'>
                <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item'> <a href='/profile/<?php echo $P_Username ?>' target='_blank'>Visit
                            Page</a> </li>
                    <li class='breadcrumb-item active'> <a href='?dashboard'>Dashboard</a> </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>

        <!-- /block 1-->
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="card card-purple-addon card-outline">
                    <div class="card-body box-profile">Banners<br /><br />
                        <main style="display:flex;align-items:flex-start;flex-wrap:wrap">
                            <?php
                            $all_files = glob("../public/assets/banners/*.*");
                            for ($i = 0; $i < count($all_files); $i++) {
                                $image_name = $all_files[$i];
                                $supported_format = array('gif', 'jpg', 'jpeg', 'png', 'webp');
                                $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                                if (in_array($ext, $supported_format)) {
                                    echo "<div style='display:inline-block;margin: 0 5px 5px 0;position:relative'><img src='$image_name' alt='$image_name' width='96px' style='display:inline-block'/><a href=\"?remove-images&delete=$image_name\" style='position: absolute;right: 5px;top:0;filter: drop-shadow(0 0 0.17rem white););'><i class='fa fa-window-close' aria-hidden='true'></i></a></div>";
                                } else {
                                    continue;
                                }
                                if (isset($_GET['delete'])) {
                                    $image_name = $_GET['delete'];
                                    $file = str_replace("../public/assets/banners/", "", $image_name);

                                    $image_check = "SELECT * FROM Users where User_Banner_Image = '$file' ";

                                    if (count(fetchAll($image_check)) > 0) {
                                        echo "<script>alert('This image is attached to a user')</script>";
                                        echo "<script>window.open('?remove-images','_self')</script>";
                                        exit();
                                    } elseif (($file == "parallax-1.webp") || ($file == "parallax-2.webp") || ($file == "parallax-3.webp") || ($file == "parallax-4.webp") || ($file == "parallax-5.webp") || ($file == "parallax-6.webp") || ($file == "parallax-7.webp") || ($file == "96x96.jpg")) {
                                        echo "<script>alert('This image cannot be deleted')</script>";
                                        echo "<script>window.open('?remove-images','_self')</script>";
                                        exit();
                                    } else {
                                        unlink($_GET['delete']);
                                        echo "<script>window.open('?remove-images','_self')</script>";
                                    }
                                }
                            }

                            ?>




                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-body box-profile">
                        <form method="POST">
                            <button class="btn btn-dark" type="submit" name="delete_unused_logos">Delete Unused Logo
                                Images</button><br>
                            <?php
                            $get = new dbase;
                            $get->query("SELECT Image_one FROM Users");
                            $showImages = $get->fetchMultiple();
                            foreach ($showImages as $showImage) {
                                $image[] = $showImage['Image_one'];
                            }

                            $filespath = (LINKWI_IMG_PATH . "/profile-logos/");
                            // (A) GET ALL FILES + FOLDERS
                            $contents = scandir($filespath, SCANDIR_SORT_DESCENDING);

                            // PASS IN A SECOND PARAMETER TO SORT
                            //$contents = scandir($target, SCANDIR_SORT_DESCENDING);
                            //$contents = scandir($target, SCANDIR_SORT_NONE);

                            // (B) LOOP THROUGH ALL FILES + FOLDERS
                            foreach ($contents as $c) {
                                if ($c != "." && $c != ".." && $c != 'sampleLogo.jpg') {
                                    // echo is_dir($c) ? "DIR" : "FILE" ;
                                    //echo " - $c<br>";

                                    if (in_array($c, $image)) {

                                        echo "<div style='margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;'>
		                 <img  src='../../../linkwi/images/profile-logos/$c' alt='Profile-logo' width='96px' style='display:inline-block' />
	                </div>";
                                    } else {
                                        echo "<div style='position:relative;margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;'>
		      <i style='color: #ff000066;position: absolute;font-size: 79px;top: 11px;left: 21px;' class='fas fa-times'></i>
	                 <img  src='../../../linkwi/images/profile-logos/$c' alt='Profile-logo' width='96px' style='display:inline-block' />
	                </div>";
                                    }
                                }
                            }
                            $get = NULL;
                            ?>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-outline -->


                <div class="card">
                    <div class="card-body box-profile">
                        <form method="POST">
                            <button class="btn btn-dark" type="submit" name="delete_unused_images">Delete Unused Images</button><br>
                            <?php
                            $get = new dbase;
                            $get->query("SELECT ProfileImage FROM Users WHERE ProfileImage != 'default.png'");
                            $showImages = $get->fetchMultiple();
                            foreach ($showImages as $showImage) {
                                $image[] = $showImage['ProfileImage'];
                            }

                            $filespath = (LINKWI_IMG_PATH . "/profile-images/");
                            // (A) GET ALL FILES + FOLDERS
                            $contents = scandir($filespath, SCANDIR_SORT_DESCENDING);

                            // PASS IN A SECOND PARAMETER TO SORT
                            //$contents = scandir($target, SCANDIR_SORT_DESCENDING);
                            //$contents = scandir($target, SCANDIR_SORT_NONE);

                            // (B) LOOP THROUGH ALL FILES + FOLDERS
                            foreach ($contents as $c) {
                                if ($c != "." && $c != ".." && $c != 'default.png') {
                                    // echo is_dir($c) ? "DIR" : "FILE" ;
                                    //echo " - $c<br>";

                                    if (in_array($c, $image)) {

                                        echo "<div style='margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;'>
		                 <img  src='../../../linkwi/images/profile-images/$c' alt='Profile-image' width='96px' style='display:inline-block' />
	                </div>";
                                    } else {
                                        echo "<div style='position:relative;margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;'>
		      <i style='color: #ff000066;position: absolute;font-size: 79px;top: 11px;left: 21px;' class='fas fa-times'></i>
	                 <img  src='../../../linkwi/images/profile-images/$c' alt='Profile-image' width='96px' style='display:inline-block' />
	                </div>";
                                    }
                                }
                            }
                            $get = NULL;
                            ?>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-outline -->







                <div class="card">
                    <div class="card-body box-profile">
                        <form method="POST">
                            <button class="btn btn-dark" type="submit" name="delete_unused_card_images">Delete Unused Card Images</button><br>
                            <?php
                            $get = new dbase;
                            $get->query("SELECT pro_logo_image FROM customer_orders");
                            $showImages = $get->fetchMultiple();
                            foreach ($showImages as $showImage) {
                                $image[] = $showImage['pro_logo_image'];
                            }

                            $filespath = ("../images/card-images/");
                            // (A) GET ALL FILES + FOLDERS
                            $contents = scandir($filespath, SCANDIR_SORT_DESCENDING);

                            // PASS IN A SECOND PARAMETER TO SORT
                            //$contents = scandir($target, SCANDIR_SORT_DESCENDING);
                            //$contents = scandir($target, SCANDIR_SORT_NONE);

                            // (B) LOOP THROUGH ALL FILES + FOLDERS
                            foreach ($contents as $c) {
                                if ($c != "." && $c != ".." && $c) {
                                    // echo is_dir($c) ? "DIR" : "FILE" ;
                                    //echo " - $c<br>";

                                    if (in_array($c, $image)) {

                                        echo "<div style='margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;'>
		                 <img  src='../images/card-images/$c' alt='Profile-logo' width='96px' style='display:inline-block' />
	                </div>";
                                    } else {
                                        echo "<div style='position:relative;margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;'>
		      <i style='color: #ff000066;position: absolute;font-size: 79px;top: 11px;left: 21px;' class='fas fa-times'></i>
	                 <img  src='../images/card-images/$c' alt='card-image' width='96px' style='display:inline-block' />
	                </div>";
                                    }
                                }
                            }
                            $get = NULL;
                            ?>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-outline -->


                <div class="card">
                    <div class="card-body box-profile">
                        <form method="POST">
                            <button class="btn btn-dark" type="submit" name="delete_links_images">Delete Links Images</button><br>
                            <?php
                            $get = new dbase;
                            $get->query("SELECT link_img FROM links");
                            $showImages = $get->fetchMultiple();
                            foreach ($showImages as $showImage) {
                                $image[] = $showImage['link_img'];
                            }
                            $filespath = (LINKWI_IMG_PATH . "/profile-links/");
                            // (A) GET ALL FILES + FOLDERS
                            $contents = scandir($filespath, SCANDIR_SORT_DESCENDING);

                            // PASS IN A SECOND PARAMETER TO SORT
                            //$contents = scandir($target, SCANDIR_SORT_DESCENDING);
                            //$contents = scandir($target, SCANDIR_SORT_NONE);

                            // (B) LOOP THROUGH ALL FILES + FOLDERS
                            foreach ($contents as $c) {
                                if ($c != "." && $c != ".." && $c != 'default.png') {
                                    // echo is_dir($c) ? "DIR" : "FILE" ;
                                    //echo " - $c<br>";

                                    if (in_array($c, $image)) {

                                        echo "<div style='margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;'>
		                 <img  src='../../../linkwi/images/profile-links/$c' alt='Links image' width='96px' style='display:inline-block' />
	                </div>";
                                    } else {
                                        echo "<div style='position:relative;margin:5px;display:inline-block;box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;'>
		      <i style='color: #ff000066;position: absolute;font-size: 79px;top: 11px;left: 21px;' class='fas fa-times'></i>
	                 <img  src='../../../linkwi/images/profile-links/$c' alt='Links Image' width='96px' style='display:inline-block' />
	                </div>";
                                    }
                                }
                            }
                            $get = NULL;
                            ?>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-outline -->

            </div>
        </div>
        <!-- /.row-->
    </div>
    <!-- /.container-fluid-->
</section>