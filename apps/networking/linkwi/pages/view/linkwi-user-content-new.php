<body class="appear-animate">
    <!-- Page Loader -->
    <div class="page-loader">
        <div class="loader">Loading...</div>
    </div>
    <!-- End Page Loader -->

    <!-- Page Wrap -->
    <div class="page" id="top">
        <main id="main" class="main">
            <!-- Navigation panel -->
            <nav class="main-nav dark transparent js-transparent wow-menubar">
                <div class="full-wrapper relative">

                    <!-- Logo ( * your text or image into link tag *) -->
                    <div class="nav-logo-wrap local-scroll">
                        <a href="<?php echo base_url() ?>" class="logo">
                            <h3 class="nav__logo-text mt-20">LinkWi</h3>
                            <!--<img src="../linkwi/images/logo-white.png" alt="Company logo" width="188" height="37" />-->
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="mobile-nav" role="button" tabindex="0">
                        <?php if ($check) { ?>
                        <a href="../linkwi/?myprofile" class="nav__cta_big btn btn-mod btn-border btn-round btn-medium"
                            target="_blank">DASHBOARD</a>
                        <?php } else { ?>
                        <a href="https://linkwi.co/#buy-now"
                            class="nav__cta_big btn btn-mod btn-border btn-round btn-medium" target="_self">GET
                            YOUR CARD</a>
                        <?php } ?>
                    </div>
                </div>
            </nav>
            <!-- End Navigation panel -->


            <!-- Home Section -->
            <section class="profile__banner small-section bg-dark-alfa-50 bg-scroll light-content"
                data-background="<?php echo $profile_background ?>" id="home">
                <div class="profile__container container">
                    <div class="profile__header wow  fadeInUpShort">

                        <article class="profile__image-container"
                            style="background-image: url(../<?php echo $profile_pic ?>);"></article>
                        <article class="profile__text-content">
                            <div class="">
                                <div class="wow fadeInUpShort" data-wow-delay=".1s">
                                    <div class="profile__name hs-line-7 mb-20 mb-xs-10">
                                        <h1 class='profile__firstname'>
                                            <?php echo $FirstName ?>
                                        </h1>
                                        <h1 class='profile__lastname'>
                                            <?php echo $LastName ?>
                                        </h1>
                                    </div>
                                </div>
                                <div class="wow fadeInUpShort" data-wow-delay=".2s">
                                    <p class="profile__title hs-line-6 opacity-075 mb-20 mb-xs-0">
                                        <?php echo $job ?>
                                    </p>
                                </div>
                            </div>

                            <div class=" mt-10 wow fadeInUpShort" data-wow-delay=".1s">
                                <div class="mod-breadcrumbs profile__location">
                                    <!--<img class='profile__badge' src='../linkwi/images/icons/icon_pin.svg' alt='pin'>-->
                                    <i class="profile__badge fa fa-user-circle-o" aria-hidden="true"></i><span
                                        class='profile__organization'>
                                        <?php echo $organization ?>
                                    </span><span class="profile__breadcrumbs-dot mod-breadcrumbs-slash"><br /><i
                                            class="profile__badge fa fa-certificate" aria-hidden="true"></i>
                                    </span><span class='profile__city'>
                                        <?php echo $industry_type ?>
                                    </span>
                                </div>
                            </div>
                        </article>
                        <?php if ($check) { ?>
                        <div class="profile__edit_light profile__edit-btn"><img src="../linkwi/images/icons/edit.svg"
                                alt="Edit" title="Edit Profile">
                        </div>
                        <?php } ?>
                    </div>
                    <!-----profile logo was here----->
                </div>
            </section>
            <!-- End Home Section -->

            <!-- Section -->
            <section class="buttons__container page-section">
                <div class="container relative">
                    <div class="row wow fadeInUpShort">
                        <div class="buttons__share">
                            <a href="../card-download/<?php echo $Username ?>"
                                class="buttons__share_md btn btn-mod btn-border btn-light btn-round btn-medium"
                                target="_self">Save Contact</a>
                            <a href="#"
                                class="buttons__share_big buttons__share_orange btn btn-mod btn-border btn-round btn-medium"
                                target="_blank">Exchange Contact</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Section -->

            <!-- Section -->
            <section class="page-section pt-30 pb-10">
                <div class="container relative">
                    <div class="row wow fadeInUpShort">
                        <div class="col-md-7 mb-sm-20">
                            <!-- About Project -->
                            <div>
                                <div class='about__title'>
                                    <h4 class="mb-30 mb-xxs-10 lightbox-gallery-5 mfp-inline about-title">About</h4>
                                    <?php if ($check) { ?>
                                    <div class="about__edit_dark about__edit-btn"><img
                                            src="../linkwi/images/icons/edit.svg" alt="Edit" title="Edit Profile"></div>
                                    <?php } ?>
                                </div>
                                <p id="about-text" class="about__me d-inline"><?php echo $bio; ?></p>
                                <small class="pull-right"><span id="read-more" class="gray read__more">Read
                                        more</span></small>


                            </div>
                            <!-- End About Project -->

                        </div>

                        <div class="col-md-5 col-lg-4 offset-lg-1">
                            <div class='social__title'>

                                <h4 class="mb-30 mb-xxs-10">Socials</h4>

                                <?php if ($check) { ?>
                                <div class="social__edit_dark social__edit-btn2"><img
                                        src="../linkwi/images/icons/edit.svg" alt="Edit" title="Edit Profile"></div>
                                <?php } ?>
                            </div>
                            <!-- Social Links -->
                            <div id="display_socials" class="social-links mb-xs-20">

                                <!-- user social -->

                            </div>
                            <!-- End Social Links -->

                        </div>

                    </div>

                </div>
            </section>
            <!-- End Section -->





            <!-- Section -->
            <section class="page-section pt-30 pb-0">
                <div class="container relative">

                    <div id="linkData" class="links__list row">

                    </div>
                </div>
            </section>
            <!-- End Section -->

            <!-- Section -->
            <section class="page-section pt-30 pb-0">
                <div class="container relative">

                    <div id="display_file_uploads" class="files__list row">

                    </div>
                </div>
            </section>
            <!-- End Section -->



            <?php if ($corporateRole == "Corp") { ?>
            <!-- Section -->
            <section class="page-section pt-0">
                <div class="container relative">

                    <div class="row section-text">



                        <div class="col-md-12 mb-sm-20">

                            <!-- Toggle -->
                            <dl class="toggle border-0">

                                <dt>
                                    <a class="border-0" href="">Organization</a>
                                </dt>
                                <dd class="members">
                                    <div class="item-carousel owl-carousel">

                                        <?php echo $members ?>
                                    </div>
                                </dd>
                            </dl>
                            <!-- End Toggle -->

                        </div>

                    </div>

                </div>
            </section>
            <!-- End Section -->
            <?php } ?>





        </main>



        <!-- Footer -->

        <footer class="page-section footer bg-gray-lighter ">
            <div class="container">
                <div class="footer__text">
                    <div class="footer__copyright">
                        <a href="index.html">© LinkWi
                            <?php echo Date('Y') ?>
                        </a>.
                    </div>
                    <div class="footer__made">Imagination driven</div>
                </div>
            </div>
            <div class="profile-logo wow  fadeInUpShort"></div>
        </footer>
        <!-- End Footer -->


        <div class="sticky-footer">
            <div><button id="sticky__telephone" class="btn p-0"
                    onclick="window.open('tel:<?php echo $contact ?>','_blank');"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true" focusable="false"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M6.176 1.322l2.844-1.322 4.041 7.89-2.724 1.341c-.538 1.259 2.159 6.289 3.297 6.372.09-.058 2.671-1.328 2.671-1.328l4.11 7.932s-2.764 1.354-2.854 1.396c-7.862 3.591-19.103-18.258-11.385-22.281zm1.929 1.274l-1.023.504c-5.294 2.762 4.177 21.185 9.648 18.686l.971-.474-2.271-4.383-1.026.5c-3.163 1.547-8.262-8.219-5.055-9.938l1.007-.497-2.251-4.398z" />
                    </svg></button></div>
            <div><button id="sticky__email" class="btn p-0"
                    onclick="window.open('mailto:<?php echo $emailaddress ?>?subject=LinkWi email contact&body=Hi <?php echo $FirstName ?>, I am writing this email ...','_blank');">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true" focusable="false"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M0 3v18h24v-18h-24zm21.518 2l-9.518 7.713-9.518-7.713h19.036zm-19.518 14v-11.817l10 8.104 10-8.104v11.817h-20z" />
                    </svg></button></div>


            <?php if ($check) { ?>
            <div class='sticky-footer__colour-icon'><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    aria-hidden="true" focusable="false" width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M18.58 0c-1.234 0-2.377.616-3.056 1.649-.897 1.37-.854 3.261-1.368 4.444-.741 1.708-3.873.343-5.532-.524-2.909 5.647-5.025 8.211-6.845 10.448 6.579 4.318 1.823 1.193 12.19 7.983 2.075-3.991 4.334-7.367 6.825-10.46-1.539-1.241-4.019-3.546-2.614-4.945 1-1 2.545-1.578 3.442-2.95 1.589-2.426-.174-5.645-3.042-5.645zm-5.348 21.138l-1.201-.763c0-.656.157-1.298.422-1.874-.609.202-1.074.482-1.618 1.043l-3.355-2.231c.531-.703.934-1.55.859-2.688-.482.824-1.521 1.621-2.331 1.745l-1.302-.815c1.136-1.467 2.241-3.086 3.257-4.728l8.299 5.462c-1.099 1.614-2.197 3.363-3.03 4.849zm6.724-16.584c-.457.7-2.445 1.894-3.184 2.632-.681.68-1.014 1.561-.961 2.548.071 1.354.852 2.781 2.218 4.085-.201.265-.408.543-.618.833l-8.428-5.548.504-.883c1.065.445 2.1.678 3.032.678 1.646 0 2.908-.733 3.464-2.012.459-1.058.751-3.448 1.206-4.145 1.206-1.833 3.964-.017 2.767 1.812zm-.644-.424c-.265.41-.813.523-1.22.257-.409-.267-.522-.814-.255-1.223.267-.409.813-.524 1.222-.257.408.266.521.817.253 1.223z" />
                </svg></div>
            <?php } ?>
            <div class="share-button"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" aria-hidden="true"
                    focusable="false" width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M5 9c1.654 0 3 1.346 3 3s-1.346 3-3 3-3-1.346-3-3 1.346-3 3-3zm0-2c-2.762 0-5 2.239-5 5s2.238 5 5 5 5-2.239 5-5-2.238-5-5-5zm15 9c-1.165 0-2.204.506-2.935 1.301l-5.488-2.927c-.23.636-.549 1.229-.944 1.764l5.488 2.927c-.072.301-.121.611-.121.935 0 2.209 1.791 4 4 4s4-1.791 4-4-1.791-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zm0-22c-2.209 0-4 1.791-4 4 0 .324.049.634.121.935l-5.488 2.927c.395.536.713 1.128.944 1.764l5.488-2.927c.731.795 1.77 1.301 2.935 1.301 2.209 0 4-1.791 4-4s-1.791-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z" />
                </svg></div>
            <?php if ($check) { ?>
            <div class='sticky-footer__userinfo-icon'><svg fill="currentColor" aria-hidden="true" focusable="false"
                    width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                    <path
                        d="M12 16c1.656 0 3 1.344 3 3s-1.344 3-3 3-3-1.344-3-3 1.344-3 3-3zm0 1c1.104 0 2 .896 2 2s-.896 2-2 2-2-.896-2-2 .896-2 2-2zm0-8c1.656 0 3 1.344 3 3s-1.344 3-3 3-3-1.344-3-3 1.344-3 3-3zm0 1c1.104 0 2 .896 2 2s-.896 2-2 2-2-.896-2-2 .896-2 2-2zm0-8c1.656 0 3 1.344 3 3s-1.344 3-3 3-3-1.344-3-3 1.344-3 3-3zm0 1c1.104 0 2 .896 2 2s-.896 2-2 2-2-.896-2-2 .896-2 2-2z" />
                </svg></div>
            <?php } ?>
        </div>
    </div>
    <!-- End Page Wrap -->








    <div id="share__profile" class='popup'>
        <div class="popup__overlay"></div>
        <section id='share' class='colour'>
            <h2 class="colour__popup__form-label">Share this card</h2>
            <button class="colour__popup-close-btn popup__color-social-close-btn" type="button"><img
                    class="popup__close-icon" src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <div class='colour__selection'>
                <p class='colour__text'>Make a selection below</p>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="share__button-container">
                            <button type="button"
                                onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=https://linkwi.co/card/<?php echo $Username; ?>', '_blank' ); return false;\"
                                class='mt-3 share__button'>
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button"
                                onclick="window.open('https://twitter.com/share?text=https://linkwi.co/card/<?php echo $Username; ?>', '_blank'); return false;"
                                class="mt-3 share__button">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button type="button"
                                onclick="window.open('whatsapp://send?text=https://linkwi.co/card/<?php echo $Username; ?>', '_blank'); return false;"
                                class="mt-3 share__button">
                                <i class="fab fa-whatsapp"></i>
                            </button>

                            <button type="button"
                                onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=https://linkwi.co/card/<?php echo $Username; ?>', '_blank'); return false;"
                                class="mt-3 share__button ">
                                <i class="fab fa-linkedin"></i>
                            </button>

                            <button type="button"
                                onclick="window.open('mailto:?body=true&url=https://linkwi.co/card/<?php echo $Username; ?>', '_blank'); return false;"
                                class="mt-3 share__button">
                                <i class="fas fa-envelope"></i>
                            </button>
                            <button type="button" onclick="myFunction()" class="mt-3 share__button "><i
                                    class="fas fa-copy"></i></button>
                        </div>
                        <!--share__button-container-->
                        <div class='share__link'>
                            <input id="myInput" class="form-control form-control-addon share__link-input" type="text"
                                value='https://linkwi.co/card/<?php echo "$Username"; ?>'>
                        </div>
                    </div>
                    <!--col-sm-12-->
                </div>
                <!--row-->


            </div>
        </section>
    </div>




    <div id="edit__colour" class='popup'>
        <div class="popup__overlay"></div>
        <section id='colour' class='colour'>
            <h2 class="colour__popup__form-label">Theme selection</h2>
            <button class="colour__popup-close-btn popup__footer-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <div class='colour__selection'>
                <p class='colour__text'>Customize your LinkWi app</p>
                <p class='colour__text'>Please choose a color</p>

                <div class='colour__column'>
                    <div class='colour__circle colour__cyan' data-id="00bcd4"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__dodgerblue' data-id="2196f3"><span class='colour__name'></span>
                    </div>
                    <div class='colour__circle colour__blue' data-id="0d6efd"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__indigo' data-id="6610f2"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__purple' data-id="6f42c1"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__pink' data-id="d63384"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__red' data-id="dc3545"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__orange' data-id="fd7e14"><span class='colour__name'></span></div>
                </div>
                <div class='colour__column'>

                    <div class='colour__circle colour__yellow' data-id="ffc107"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__gold' data-id="f6bb42"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__green' data-id="4caf50"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__darkgreen' data-id="198754"><span class='colour__name'></span>
                    </div>
                    <div class='colour__circle colour__teal' data-id="20c997"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__grey' data-id="9e9e9e"><span class='colour__name'></span></div>
                    <div class='colour__circle colour__secondary' data-id="607d8b"><span class='colour__name'></span>
                    </div>
                    <div class='colour__circle colour__brown' data-id="795548"><span class='colour__name'></span></div>
                </div>
            </div>
        </section>
    </div>


    <div id="edit__userinfo" class='popup'>
        <div class="popup__overlay"></div>
        <section id='userinfo' class='colour'>
            <h2 class="colour__popup__form-label">Edit Business Info</h2>
            <button class="userinfo__popup-close-btn popup__footer-close-btn" type="button"><img
                    class="popup__close-icon" src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <div class='colour__selection'>

                <form method='POST' accept-charset="UTF-8" class="popup__edit-userinfo popup-form" name="UserInfo">
                    <img id="uploaded_image" class='userinfo_output_image mb-3' data-toggle='tooltip'
                        data-placement='top' title='User image' width="100px" src="../linkwi/images/icons/link-icon.jpg"
                        alt="link icon" />
                    <input id='userinfo-image-input' class="image popup__form-input" name="userinfo_img" type="file"
                        accept="image/png, image/gif, image/jpeg" /><br><span
                        class="input_error userinfo-image-input-error"></span>
                    <input id='email-input' class="mb-0 popup__form-input" name="email" type="email"
                        placeholder="Business Email" value='<?php echo $emailaddress ?>' required /><br><span
                        class="input_error email-input-error"></span><br>
                    <input id='contact-input' class="popup__form-input" name="contact" type="tel"
                        placeholder="Business phone contact (optional)" value='<?php echo $contact ?>' /><br><span
                        class="input_error contact-input-error"></span><br>

                    <button class="popup__save-btn userinfo__save-btn mt-0" type="submit">Save</button>
                </form>



            </div>
        </section>
    </div>




    <!-- image Popup -->
    <div id='view__image' class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form popup__form_image">
            <button class="popup__close-btn popup__image-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <img class="popup__card-image-preview" src="../linkwi/images/icons/loading.png" alt="Photo of place" />

        </div>
    </div>
    <!-- Form Popup -->
    <div id="edit__profile" class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form">
            <button class="popup__close-btn popup__edit-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <form method='POST' accept-charset="UTF-8" class="popup__edit-profile popup-form" name="ProfileForm">
                <h2 class="popup__form-label">Edit Profile</h2>
                <img class='profile_output_image mb-3' data-toggle='tooltip' data-placement='top' title='User image'
                    width="100px" src="../linkwi/images/icons/link-icon.jpg" alt="link icon" />
                <input id='image-input' class="image-profile popup__form-input" name="profile_img" type="file"
                    accept="image/png, image/gif, image/jpeg" /><span class="input_error image-input-error"></span>
                <input id='firstname-input' minlength='2' class="popup__form-input" name="firstname" type="text"
                    placeholder="First name" value='<?php echo $FirstName ?>' required /><span
                    class="input_error firstname-input-error"></span>
                <input id='lastname-input' minlength='2' class="popup__form-input" name="lastname" type="text"
                    placeholder="Last Name" value='<?php echo $LastName ?>' required /><span
                    class="input_error lastname-input-error"></span>
                <input id='title-input' class="popup__form-input" minlength='2' maxlength='22' name="title" type="text"
                    placeholder="Job title" value='<?php echo $job  ?>' required /><span
                    class="input_error title-input-error"></span>
                <input id='organization-input' class="popup__form-input" minlength='2' maxlength='20'
                    name="organization" type="text" placeholder="Organization" value='<?php echo $organization ?>'
                    required /><span class="input_error organization-input-error"></span>
                <input id='industry-input' class="popup__form-input" minlength='2' maxlength='20' name="industrytype"
                    type="text" placeholder="Industry Type" value='<?php echo $industry_type ?>' required /><span
                    class="input_error industry-input-error"></span>
                <button class="popup__save-btn profile__save-btn " type="submit">Save</button>
            </form>
        </div>
    </div>

    <!-- Form Popup -->
    <div id="edit__about" class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form">
            <button class="popup__close-btn popup__edit-about-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <form method='POST' class="popup__edit-about-form popup-form" name="EditAbout">
                <h2 class="popup__form-label">About me</h2>
                <textarea id='bio-input' class="popup__form-input popup__form-textarea" name="bio" type="text"
                    placeholder="About me" required />
                <?php echo $bio ?>'</textarea><span class="input_error bio-input-error"></span>
                <button class="popup__save-btn about__save-btn" type="submit">Save</button>
            </form>
        </div>
    </div>



    <!-- Form Popup -->
    <div id="edit__links" class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form">
            <button class="popup__close-btn popup__edit-links-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <form method='POST' class="popup__edit-links-form popup-form" name="EditLinkForm"
                enctype="multipart/form-data">
                <h2 class="popup__form-label">Edit Link</h2>
                <img class='links__output_image_edit mb-3' data-toggle='tooltip' data-placement='top' title='User image'
                    width="100px" src="../linkwi/images/icons/link-icon.jpg" alt="link icon" />
                <div class="custom-input-button">
                    <input type="file" id='image_edit-input'
                        onchange="popupImagePreview(event,popupLinksEditImage,popupLinksEditPreviewImage)"
                        class="popup__form-input popup__form-input_type_link_file" name="link_file" type="file"
                        accept="image/png, image/gif, image/jpeg" />
                    <label for="image_edit-input" class="custom-button">Upload Image (Optional)</label>
                </div><span class="input_error image_edit-input-error"></span>
                <input id='title_edit-input' class="popup__form-input popup__form-input_type_link_title"
                    name="link_title" type="text" placeholder="Link title" required /><span
                    class="input_error title_edit-input-error"></span>
                <input id='url_edit-input' class="popup__form-input popup__form-input_type_link_url" name="link_url"
                    type="url" placeholder="url" required /><span class="input_error url_edit-input-error"></span>
                <input class="popup__form-input popup__form-input_type_link_id" name="link_id" type="text" hidden />
                <button class="popup__save-btn linkEdit__save-btn" type="submit">Save</button>
            </form>
        </div>
    </div>


    <!-- Form Popup -->
    <div id="add__links" class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form">
            <button class="popup__close-btn popup__add-links-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <form method='POST' class="popup__add-links-form popup-form" name="AddLinksForm"
                enctype="multipart/form-data">
                <h2 class="popup__form-label">Add Link</h2>
                <img class='links__output_image_add' data-toggle='tooltip' data-placement='top' title='User image'
                    width="100px" src="../linkwi/images/icons/link-icon.jpg" alt="link icon" />
                <div class="custom-input-button">
                    <input type="file" id="image_add-input"
                        onchange="popupImagePreview(event,popupLinksAddPreviewImage,popupLinksAddPreviewImage)"
                        class="popup__form-input popup__form-input_type_link_file" name="link_file" type="file"
                        accept="image/png, image/gif, image/jpeg" />
                    <label for="image_add-input" class="custom-button">Upload Image (Optional)</label>
                </div><span class="input_error image_add-input-error"></span>
                <input id='title_add-input' class="popup__form-input popup__form-input_type_link_title"
                    name="link_title" type="text" placeholder="Link title" required /><span
                    class="input_error title_add-input-error"></span>
                <input id='url_add-input' class="popup__form-input popup__form-input_type_link_url" name="link_url"
                    type="url" placeholder="url" required /><span class="input_error url_add-input-error"></span>
                <button class="popup__save-btn linkAdd__save-btn popup__save-btn-disabled" type="submit"
                    disabled="true">Save</button>
            </form>
        </div>
    </div>


    <!-- Form Popup -->
    <div id="edit__file" class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form">
            <button class="popup__close-btn popup__edit-file-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <form method='POST' class="popup__edit-files-form popup-form" name="EditFileForm"
                enctype="multipart/form-data">
                <h2 class="popup__form-label">Edit File Name</h2>

                <input id='file-title_edit-input' class="popup__form-input popup__form-input_type_file_title"
                    name="filename" type="text" placeholder="File title" required /><span
                    class="input_error file-title_edit-input-error"></span>

                <input class="popup__form-input popup__form-input_type_file_id" name="file_id" type="text" hidden />
                <button class="popup__save-btn fileEdit__save-btn" type="submit">Save</button>
            </form>
        </div>
    </div>



    <!-- Form Popup -->
    <div id="add__file" class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form">
            <button class="popup__close-btn popup__add-file-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <form id="uploadFile" method="POST" enctype="multipart/form-data" class="popup__add-file-form popup-form"
                name="AddFile">
                <h2 class="popup__form-label">Upload File</h2>
                <input id="file-input" type="file" name='fileupload' id='fileupload'
                    class="popup__form-input file-input" required><span class="input_error file-input-error"></span>
                <input id="name-input" class="popup__form-input popup__form-input_type_file-name" name="filename"
                    type="text" placeholder="File name" required /><span class="input_error name-input-error"></span>
                <button class="popup__save-btn file__save-btn popup__save-btn-disabled" type="submit"
                    disabled="true">Save</button>
            </form>
        </div>
    </div>

    <!-- Form Popup -->
    <div id="edit__social2" class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form">
            <div class="popup__form-container_lg">
                <button class="popup__close-btn popup__edit-social-close-btn" type="button"><img
                        class="popup__close-icon" src="../linkwi/images/icons/close-icon.svg" alt=""></button>
                <form method='POST' class="popup__edit-social-form2 popup-form" name="SocialForm">
                    <div class="d-flex flex-row mb-2">
                        <h2 class="popup__form-label m-0">Social Links</h2> <button id="add-social-btn"
                            style="margin-left:auto" class="btn btn-sm popup_add-social-btn"><span>+</span></button>
                    </div>
                    <div class="add-social-btns hide">
                        <button id="add-facebook" class="btn btn-sm popup_add-social-btn mb-2">Facebook</button>
                        <button id="add-instagram" class="btn btn-sm popup_add-social-btn mb-2">Instagram</button>
                        <button id="add-twitter" class="btn btn-sm popup_add-social-btn mb-2">Twitter</button>
                        <button id="add-linkedin" class="btn btn-sm popup_add-social-btn mb-2">LinkedIn</button>
                        <button id="add-youtube" class="btn btn-sm popup_add-social-btn mb-2">YouTube</button>
                        <button id="add-whatsapp" class="btn btn-sm popup_add-social-btn mb-2">WhatsApp</button>
                        <button id="add-tiktok" class="btn btn-sm popup_add-social-btn mb-2">TikTok</button>
                        <button id="add-snapchat" class="btn btn-sm popup_add-social-btn mb-2">SnapChat</button>
                        <button id="add-telegram" class="btn btn-sm popup_add-social-btn mb-2">Telegram</button>
                        <button id="add-discord" class="btn btn-sm popup_add-social-btn mb-2">Discord</button>
                        <button id="add-twitch" class="btn btn-sm popup_add-social-btn mb-2">Twitch</button>
                        <button id="add-pinterest" class="btn btn-sm popup_add-social-btn mb-2">Pinterest</button>
                    </div>
                    <div id="display-socials">
                        <p>Loading...</p>
                    </div>
                    <button class="popup__save-btn social__save-btn" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>



    <!-- Form Popup -->
    <div id="exchange_contact" class="popup">
        <div class="popup__overlay"></div>
        <div class="popup__form">
            <button class="popup__close-btn popup__exchange-close-btn" type="button"><img class="popup__close-icon"
                    src="../linkwi/images/icons/close-icon.svg" alt=""></button>
            <form method='POST' class="popup__exchange-form popup-form" name="ExchangeForm">
                <h2 class="popup__form-label">Exchange Contact</h2>
                <p>Do you have a LinkWi profile?</p>
                <input class='exchange_yes' type="radio" name="exchange_yes_no" value="yes" checked> Yes
                <input class='exchange_no' type="radio" name="exchange_yes_no" value="no"> No
                <div class="exchange__linkwi-user_yes">
                    <input id='exchange_username_input' maxlength='50'
                        class="popup__form-input popup__form-input_type_linkwi_username" name="exchange_username"
                        type="text" placeholder="LinkWi username" required /><span
                        class="input_error exchange_username_input-error"></span>
                </div>
                <div class="exchange__linkwi-user_no hide">
                    <input id='exchange-firstname-input' minlength='2' maxlength='50' class="popup__form-input"
                        name="exchange_firstname" type="text" placeholder="First name" /><span
                        class="input_error exchange-firstname-input-error"></span>
                    <input id='exchange-lastname-input' minlength='2' maxlength='50' class="popup__form-input"
                        name="exchange_lastname" type="text" placeholder="Last Name" /><span
                        class="input_error exchange-lastname-input-error"></span>
                    <input id='exchange-email-input' minlength='2' maxlength='50' class="popup__form-input"
                        name="exchange_email" type="email" placeholder="Email address" /><span
                        class="input_error exchange-email-input-error"></span>
                    <input id='exchange-contact-input' minlength='2' maxlength='12' class="popup__form-input"
                        name="exchange_contact" type="tel" placeholder="Contact Number" /><span
                        class="input_error exchange-contact-input-error"></span>
                    <input id='exchange-met_at-input' maxlength='50' class="popup__form-input" name="exchange_met_at"
                        type="text" placeholder="Where did you meet?" /><span
                        class="input_error exchange-met_at-input-error"></span>
                </div>
                <button class="popup__save-btn exchange__save-btn" type="submit">Save</button>
            </form>
        </div>
    </div>



    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop image
                    </h5>
                    <button class="logo__cropper-close-btn popup__footer-close-btn" type="button"><img
                            class="popup__close-icon" src="../linkwi/images/icons/close-icon.svg" alt=""></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div style="max-height:80vh !important" class="modal-row col-md-8">
                                <!--  default image where we will set the src via jquery -->
                                <img id="image">
                            </div>
                            <div class="col-md-4">
                                <div class="preview">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-mod btn-border btn-round btn-medium" id="crop">Crop
                    </button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="modalProfileLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPeofileLabel">Crop image
                    </h5>
                    <button class="profile__cropper-close-btn popup__footer-close-btn" type="button"><img
                            class="popup__close-icon" src="../linkwi/images/icons/close-icon.svg" alt=""></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div style="max-height:80vh !important" class="modal-row col-md-8">
                                <!--  default image where we will set the src via jquery-->
                                <img id="image-profile">
                            </div>
                            <div class="col-md-4">
                                <div class="preview">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark btn-mod btn-border btn-round btn-medium"
                        id="crop-profile">Crop</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/cropperjs" type="text/javascript"></script>
    <script>
    const userid = '<?php echo custom_encrypt($get_user[0]['UniqueID'], SECRET_KEY, SECRET_IV); ?>';
    const chk = '<?php echo custom_encrypt($check, SECRET_KEY, SECRET_IV); ?>';
    const rle = '<?php echo $get_user[0]['AccountType']; ?>';
    </script>