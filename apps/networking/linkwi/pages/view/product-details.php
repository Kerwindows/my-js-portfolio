<?php
session_start();

if (!defined('PROJECT_PATH')) {

    exit("<script>window.open('https://voiladigital.ltd/we-see-you.php','_self')</script>");
}
require LINKWI_FUNCTIONS_PATH . '/functions.php';
require LINKWI_FUNCTIONS_PATH . '/product-details.php';
require LINKWI_FUNCTIONS_PATH . '/setMsg.php';
include LINKWI_INCLUDES_PATH . '/linkwi.shop.head.php';

$P = new ProductDetails($pro_id);

if (isset($_POST['add_cart'])) {
    $ip_add = getRealUserIp();
    $p_id = $P->product_id();
    $product_qty = stripslashes(htmlspecialchars($_POST['product_qty']));
    if (empty($_POST['logo_name'])) {
        set_error_msg('A name is required.');
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {
        $logo_name = stripslashes(htmlspecialchars($_POST['logo_name']));
    }
    if ((!empty($_FILES["logo_file"]["name"]))) {
        //Create The Upload File PHP Script
        $target_file = basename($_FILES["logo_file"]["name"]);
        $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        //Check file size
        if ($_FILES["logo_file"]["size"] > 1500000) {
            set_error_msg('Image too large.');
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
        //Check file type
        if ($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg") {
            set_error_msg('Only jpg, jpeg, png files are allowed.');
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        }
        $logo_file = strtolower(str_replace(' ', '', $logo_name)) . "-" . rand(99999, 9999999) . $FileType;
        $temp_profile_pic = $_FILES['logo_file']['tmp_name'];
        move_uploaded_file($temp_profile_pic, "images/card-images/$logo_file");
    } else {
     /*   $logo_file = NULL;
        set_error_msg('Please upload an image.');
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit(); */
        
       $logo_file = 'linkwi-logo.jpg';
        
    }
    $conn = new dbase;
    $conn->query("SELECT * FROM cart WHERE ip_add='$ip_add' AND p_id='$p_id'");

     if ($conn->fetchCount() > 0) {
         set_error_msg("Card is already added to cart. Delete card first and then make changes. <a href='../cart'>Go to Cart</a>");
         header("Location: " . $_SERVER['REQUEST_URI']);
         exit();
    }

    if ($product_qty == 0) {
        set_error_msg("Please select your product quantity.");
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } else {

        $conn->query("SELECT * FROM products WHERE product_id='$p_id'");
        $row_price = $conn->fetchSingle();
        $pro_price = $row_price['product_price'];
        $pro_psp_price = $row_price['product_psp_price'];
        $pro_label = $row_price['product_label'];
        if ($pro_label == "SALE" or $pro_label == "GIFT") {
            $product_price = $pro_psp_price;
        } else {
            $product_price = $pro_price;
        }

        $conn->query("INSERT INTO `cart` (p_id,ip_add,qty,p_price,pro_logo_name,pro_logo_image) values ('$p_id','$ip_add','$product_qty','$product_price','$logo_name','$logo_file')");
        $conn->execute();
        set_msg("Your Linkwi card was added to the cart. <a href='/cart'>Go to cart</a>");
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}
?>

<main id="main">
    <!-- Section -->
    <section class="page-section">
        <div class="container relative">
            <!-- Product Content -->
            <div class="row mb-60 mb-xs-30">
             <section><div style="height:100px,width:100%;padding:10px;margin-bottom:20px;box-sizingLborder-box;text-align:center;background:#f1273c;color:#fff">Currently available only in Trinidad and Tobago</div></section>
                <!-- Product Images -->
                <div class="col-md-4 mb-md-30">
                    <div class="post-prev-img">
                        <a href="../../../../images/shop/shop-prev/shop-prev-1.jpg" class="lightbox-gallery-3 mfp-image"><img src="../../../../images/shop/shop-prev/shop-prev-1.jpg" alt="" /></a>
                        <div class="intro-label">
                            <span class="badge badge-danger bg-red">Sale</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 post-prev-img">
                            <a href="../../../../images/shop/shop-prev/shop-prev-2.jpg" class="lightbox-gallery-3 mfp-image"><img src="../../../../images/shop/shop-prev/shop-prev-2.jpg" alt="" /></a>
                        </div>
                        <div class="col-3 post-prev-img">
                            <a href="../../../../images/shop/shop-prev/shop-prev-3.jpg" class="lightbox-gallery-3 mfp-image"><img src="../../../../images/shop/shop-prev/shop-prev-3.jpg" alt="" /></a>
                        </div>
                        <div class="col-3 post-prev-img">
                            <a href="../../../../images/shop/shop-prev/shop-prev-4.jpg" class="lightbox-gallery-3 mfp-image"><img src="../../../../images/shop/shop-prev/shop-prev-4.jpg" alt="" /></a>
                        </div>
                        <div class="col-3 post-prev-img">
                            <a href="../../../../images/shop/shop-prev/shop-prev-13.jpg" class="lightbox-gallery-3 mfp-image"><img src="../../../../images/shop/shop-prev/shop-prev-13.jpg" alt="" /></a>
                        </div>
                    </div>
                </div>
                <!-- End Product Images -->
                <!-- Product Description -->
                <div class="col-sm-8 col-md-5 mb-xs-40">

                    <h1 class="h3 mt-0"><?php echo $P->product_title() ?></h1>
                    <?php display_msg(); ?>
                    <hr class="mt-0 mb-30" />
                    <div class="row">
                        <div class="col-6 lead mt-0 mb-20">
                            <del class="gray"><small>$<?php echo $P->pro_price() ?></small></del>
                            <strong>$<?php echo $P->pro_psp_price() ?></strong>
                        </div>
                        <div class="col-6 align-right gray">
                            <!--<div class="d-inline-block" role="img" aria-label="Rating: 4/5">
                                <i class="fa fa-star fa-sm"></i>
                                <i class="fa fa-star fa-sm"></i>
                                <i class="fa fa-star fa-sm"></i>
                                <i class="fa fa-star fa-sm"></i>
                                <i class="fa fa-star fa-sm"></i>
                                <!-- <i class="far fa-star fa-sm"></i>
                            </div>
                            &nbsp;(26 reviews)-->
                        </div>
                    </div>
                    <hr class="mt-0 mb-30" />
                    <div class="gray mb-30">
                        Get your high-quality branded Linkwi card today.
                    </div>
                    <hr class="mt-0 mb-0" />
                    <div class="mb-30">
                        <form method="post" action="#" class="form" name="classicCardSubmit" enctype="multipart/form-data">
                        <? if($noItemsInCart == 0){ ?>
                        
                     
                            <div class="row">
                                <div class="col-sm-9">
                                    <input class='input-lg round mb-2' type="text" name="logo_name" style="width: 100%" placeholder='Name on Card' required />
                                    <div style="height: 60px;">
                                        <label for="logoUpload" style="width:100%;padding-left: 0px;" class="logoUploadBtn btn btn-mod btn-large btn-round">Upload Logo<span style='position:absolute;font-size:9px'> Optional</span></label>
                                        <input id="logoUpload" name="logo_file" style="visibility:hidden;visibility:hidden;height:0;width:0;margin:0;padding:0" type="file" name="logo_file" accept="image/png,image/jpg,image/jpeg">
                                    </div>
                                </div>
                                <div class="col-sm-3"><img src="../linkwi/images/profile-logos/sampleLogo.jpg" id="logoName" style="height:119px;width:100%;object-fit:contain;outline:1px dashed grey" /></div>
                            </div>
                             <?  } ?>
                            <div style="display:flex;gap:10px">
                             <? if($noItemsInCart == 0){ ?>
                                <input type="number" name="product_qty" class="input-lg round" min="1" max="5" value="1" />
                                <button class="btn btn-mod btn-large btn-round" type="submit" name="add_cart">Add to
                                    Cart</button>
                               <?  } ?>     
                                <a class="btn btn-mod btn-large btn-round" href="../cart"><i class="fa fa-eye" aria-hidden="true"></i> View Cart</a>
                            </div>
                        </form>
                    </div>
                    <hr class="mt-0 mb-30" />
                    <div class="gray small">
                        <!-- <div>SKU: 2134</div> -->
                        <div>Category: <a href=""> Linkwi Business Card</a></div>
                        <div>Tags: <a href="">business</a>, <a href="">card</a></div>
                    </div>
                </div>
                <!-- End Product Description -->
                <!-- Features -->
                <div class="col-sm-4 col-md-3 mb-xs-40">
                    <!-- Features Item -->
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="fa fa-truck"></i>
                            </div>
                            <h3 class="alt-services-title">Direct Shipping</h3>
                            <div class="gray">Get your card(s) delivered straight to your door</div>
                        </div>
                    </div>
                    <!-- End Features Item -->
                    <!-- Features Item -->
                    <!-- <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="far fa-clock"></i>
                            </div>
                            <h3 class="alt-services-title">14 Days MoneyBack</h3>
                            <div class="gray">Return card if not satisfied and we will refund your money</div>
                        </div>
                    </div> -->
                    <!-- End Features Item -->
                    <!-- Features Item -->
                    <div class="alt-service-wrap">
                        <div class="alt-service-item">
                            <div class="alt-service-icon">
                                <i class="fa fa-gift"></i>
                            </div>
                            <h3 class="alt-services-title">100% Original</h3>
                            <div class="gray">Quality PVC card</div>
                        </div>
                    </div>
                    <!-- End Features Item -->
                </div>
                <!-- End Features -->
            </div>
            <!-- End Product Content -->
            <!-- Nav Tabs -->
            <div class="align-center mb-40 mb-xxs-30">
                <ul class="nav nav-tabs tpl-tabs animate" id="productItem" role="tablist">
                    <li class="nav-item">
                        <a href="#description" aria-controls="description" class="nav-link active" data-bs-toggle="tab" role="tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a href="#parameters" aria-controls="parameters" class="nav-link" data-bs-toggle="tab" role="tab" aria-selected="false">Parameters</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#reviews" aria-controls="reviews" class="nav-link" data-bs-toggle="tab" role="tab"
                            aria-selected="false">Reviews (3)</a>
                    </li> -->
                </ul>
            </div>
            <!-- End Nav Tabs -->
            <!-- Tab panes -->
            <div class="tab-content tpl-minimal-tabs-cont">
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                <p>This is a top-notch networking tool equipped with NFC and QR technology. It's customised to redirect users to your online profile making it effortless to share all your contact information. Additionally, users are able to download your profile to their phone for added convenience. In case you opt not to personalize your card with your logo, we will automatically include our company logo. The card is compact and wallet-ready, measuring 3 x 2 inches. With the Linkwi Card, you'll be all set to forge valuable connections.</p>
                    <ul><?php echo $P->product_desc() ?></ul>
                </div>
                <div class="tab-pane fade" id="parameters" role="tabpanel">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>
                                Parameter
                            </th>
                            <th>
                                Value
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Size
                            </td>
                            <td>
                                Small, Medium & Large
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Color
                            </td>
                            <td>
                                Black & White
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Waist
                            </td>
                            <td>
                                25cm
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Length
                            </td>
                            <td>
                                50cm
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="mb-60 mb-xs-30">
                        <ul class="media-list text comment-list clearlist">
                            <!-- Comment Item -->
                            <li class="media comment-item">
                                <a class="float-start" href="#"><img class="media-object comment-avatar" src="../../../../images/user-avatar.png" alt=""></a>
                                <div class="media-body">
                                    <div class="comment-item-data">
                                        <div class="comment-author">
                                            <a href="#">Emma Johnson</a>
                                        </div>
                                        Feb 9, 2021, at 10:37<span class="separator">&mdash;</span>
                                        <span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </span>
                                    </div>
                                    <p>
                                        Donec fermentum turpis et finibus commodo. Sed dictum laoreet mi, vitae
                                        dignissim purus interdum at. Sed a est at purus cursus elementum ut sed lectus.
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut
                                        ante eleifend eleifend.
                                    </p>
                                </div>
                            </li>
                            <!-- End Comment Item -->
                            <!-- Comment Item -->
                            <li class="media comment-item">
                                <a class="float-start" href="#"><img class="media-object comment-avatar" src="../../../../images/user-avatar.png" alt=""></a>
                                <div class="media-body">
                                    <div class="comment-item-data">
                                        <div class="comment-author">
                                            <a href="#">John Doe</a>
                                        </div>
                                        Feb 9, 2021, at 10:3<span class="separator">&mdash;</span>
                                        <span>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </span>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at magna ut
                                        ante eleifend eleifend.
                                    </p>
                                </div>
                            </li>
                            <!-- End Comment Item -->
                        </ul>
                    </div>
                    <!-- Add Review -->
                    <div>
                        <h4 class="blog-page-title">Add Review</h4>
                        <!-- Form -->
                        <form method="post" action="#" id="form" class="form">
                            <div class="row mb-30">
                                <div class="col-md-6 mb-sm-30">
                                    <!-- Name -->
                                    <label for="name">Name *</label>
                                    <input type="text" name="name" id="name" class="input-lg round form-control" placeholder="Enter your name*" maxlength="100" required aria-required="true">
                                </div>
                                <div class="col-md-6">
                                    <!-- Email -->
                                    <label for="email">Email *</label>
                                    <input type="email" name="email" id="email" class="input-lg round form-control" placeholder="Enter your email" maxlength="100" required aria-required="true">
                                </div>
                            </div>
                            <div class="mb-30">
                                <!-- Rating -->
                                <label for="rating">Rating *</label>
                                <select class="input-lg round form-control">
                                    <option>-- Select one --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <!-- Comment -->
                            <div class="mb-30">
                                <label for="text">Comment</label>
                                <textarea name="text" id="text" class="input-md round form-control" rows="6" placeholder="Enter your comment" maxlength="400"></textarea>
                            </div>
                            <!-- Send Button -->
                            <button type="submit" class="btn btn-mod btn-large btn-round">
                                Send Review
                            </button>
                        </form>
                        <!-- End Form -->
                    </div>
                    <!-- End Add Review -->
                </div>
            </div>
            <!-- End Tab panes -->
        </div>
    </section>
    <!-- End Section -->
    <!-- Divider -->
    <hr class="mt-0 mb-0" />
    <!-- End Divider -->


    <!-- Section -->

    <!-- <section class="page-section">
        <div class="container relative">

            <div class="text-center mb-80 mb-sm-50">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <h2 class="section-title">Related Products</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-3 mb-md-50">
                    <div class="post-prev-img">
                        <a href="shop-single.html" tabindex="-1"><img src="../../../../images/shop/shop-prev-1.jpg"
                                alt="" class="wow scaleOutIn" data-wow-duration="1.2s" /></a>
                        <div class="intro-label">
                            <span class="badge badge-danger bg-red"><?php echo $P->status() ?></span>
                        </div>
                    </div>
                    <div class="post-prev-title text-center mb-10">
                        <a href="shop-single.html">Polo Applique Jersey</a>
                    </div>
                    <div class="post-prev-text text-center">
                        <del>
                            $150.00
                        </del>
                        &nbsp;<strong>$94.75</strong>
                    </div>
                    <div class="post-prev-more text-center">
                        <a href="#" class="btn btn-mod btn-round"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-md-50">
                    <div class="post-prev-img">
                        <a href="shop-single.html" tabindex="-1"><img src="../../../../images/shop/shop-prev-2.jpg"
                                alt="" class="wow scaleOutIn" data-wow-duration="1.2s" /></a>
                    </div>
                    <div class="post-prev-title text-center mb-10">
                        <a href="shop-single.html">Pique Polo Shirt</a>
                    </div>
                    <div class="post-prev-text text-center">
                        <strong>$28.99</strong>
                    </div>
                    <div class="post-prev-more text-center">
                        <a href="#" class="btn btn-mod btn-round"><i class="fa fa-shopping-cart"></i>
                            cart</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-md-50">
                    <div class="post-prev-img">
                        <a href="shop-single.html" tabindex="-1"><img src="../../../../images/shop/shop-prev-3.jpg"
                                alt="" class="wow scaleOutIn" data-wow-duration="1.2s" /></a>
                    </div>
                    <div class="post-prev-title text-center mb-10">
                        <a href="shop-single.html">Longline Long Sleeve</a>
                    </div>
                    <div class="post-prev-text text-center">
                        <strong>$39.99</strong>
                    </div>
                    <div class="post-prev-more text-center">
                        <a href="#" class="btn btn-mod btn-round"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-3 mb-md-50">
                    <div class="post-prev-img">
                        <a href="shop-single.html" tabindex="-1"><img src="../../../../images/shop/shop-prev-4.jpg"
                                alt="" class="wow scaleOutIn" data-wow-duration="1.2s" /></a>
                    </div>
                    <div class="post-prev-title text-center mb-10">
                        <a href="shop-single.html">Shirt Floral Sleeves</a>
                    </div>
                    <div class="post-prev-text text-center">
                        <strong>$85.99</strong>
                    </div>
                    <div class="post-prev-more text-center">
                        <a href="#" class="btn btn-mod btn-round"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                    </div>
                </div>
            </div>

        </div>
    </section> -->
    <!-- End Section -->

</main>
<script>
    const logoUpload = document.forms.classicCardSubmit.elements.logo_file;
    const logoName = document.querySelector('#logoName');
    const uploadLabel = document.querySelector('label[for="logoUpload"]');

    logoUpload.addEventListener("change", () => {
        if (logoUpload.value !== "") {
            let reader = new FileReader();
            reader.onload = function() {
                logoName.src = reader.result;
                uploadLabel.innerHTML = 'Reupload Image';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php include LINKWI_INCLUDES_PATH . '/linkwi.shop.footer.php'; ?>

</body>

</html>