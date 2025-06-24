<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      <?php echo "$FirstName $LastName"; ?> | LinkWi Digital Business Card ®
    </title>
    <meta charset="UTF-8" />
    <meta charset="ISO-8859-1" />
    <meta
      name="viewport"
      content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
    />
    <meta
      name="description"
      content="<?php echo $job  ?> @ <?php echo $organization  ?>"
    />
    <meta name="author" content="
    <?php echo "$FirstName $LastName"; ?>
    | LinkWi Digital Business Card ®" >
    <meta
      property="og:url"
      content="https://linkwi.co/card/<?php echo $Username; ?>"
    />
    <meta property="og:title" content="
    <?php echo "$FirstName $LastName"; ?>
    | LinkWi Digital Business Card ®" />
    <meta
      property="og:description"
      content="<?php echo $job  ?> @ <?php echo $organization  ?>"
    />
    <meta
      property="og:image"
      content="https://linkwi.co/<?php echo $profile_pic ?>"
    />
    <meta
      property="og:image:url"
      content="https://linkwi.co/<?php echo $profile_pic ?>"
    />
    <meta
      property="twitter:image"
      content="https://linkwi.co/<?php echo $profile_pic ?>"
    />

    <!-- Favicons -->
    <link rel="shortcut icon" href="../../../../images/favicon.ico" />

    <!-- CSS -->
    <link rel="stylesheet" href="../../../../css/fontawesome.com_releases_v6.4.2_css_all.css">
	<link rel="stylesheet" href="../../../../css/fontawesome.com_releases_v6.4.2_css_sharp-light.css">
	<link rel="stylesheet" href="../../../../css/fontawesome.com_releases_v6.4.2_css_sharp-regular.css">
	<link rel="stylesheet" href="../../../../css/fontawesome.com_releases_v6.4.2_css_sharp-solid.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../../css/style.linkwi.user.css" />
    <link rel="stylesheet" href="../../../../css/style-responsive.css" />
    <link rel="stylesheet" href="../../../../css/vertical-rhythm.min.css" />
    <link rel="stylesheet" href="../../../../css/magnific-popup.css" />
    <link rel="stylesheet" href="../../../../css/owl.carousel.css" />
    <link rel="stylesheet" href="../../../../css/animate.min.css" />
    <link rel="stylesheet" href="../../../../css/splitting.css" />
    <link
      href="https://unpkg.com/cropperjs/dist/cropper.css"
      rel="stylesheet"
      type="text/css"
    />
    <style>
      .rotate-text {
  transform: rotate(450deg);
}

form.popup__edit-social-form.popup-form {
  max-height: 80vh;
  overflow-y: auto;
  margin-right: -10px;
}

.container {
  max-width: 1024px;
}

.image_area {
  position: relative;
  width: 425px;
}

.preview {
  overflow: hidden;
  width: 160px;
  height: 160px;
  margin: 10px;
  border: 1px solid red;
}

.modal-lg {
  max-width: 1000px !important;
}

.modal-content {
  border-radius: 20px;
}

.bg-dark-alfa-50:before {
  background: transparent;
}

padding-left: 0;
padding-right: 0;

.overlay {
  position: absolute;
  top: 121px;
  max-height: 188px;
  left: 133px;
  background-color: rgba(255, 255, 255, 0.5);
  overflow: hidden;
  height: 188px;
  transition: 0.5s ease;
  width: 183.33px;
  z-index: 1;
  opacity: 0;
  border-radius: 50%;
}

.image_area:hover .overlay {
  cursor: pointer;
  width: 204px;
  top: 119px;
  min-height: 206px;
  left: 121px;
  border-radius: 50%;
  opacity: 1;
}

.text {
  color: #333;
  font-size: 14px;
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.preview {
  overflow: hidden;
  width: 160px;
  height: 160px;
  margin: 10px;
  border: 1px solid red;
}

.default-image {
  display: block;
  max-width: 196.67px;
  position: relative;
  top: 123px;
  left: 123px;
  z-index: -1;
  border-radius: 50%;
}

.btn-dark.btn-mod.btn-round {
  background: #151515;
  color: #fff;
}

.btn-dark.btn-mod.btn-round:hover {
  color: #151515;
  background: #fff;
  border: 2px solid #151515;
}

body::-webkit-scrollbar {
  width: 6px;
  /* width of the entire scrollbar */
}

body::-webkit-scrollbar-track {
  background: white;
  /* color of the tracking area */
}

body::-webkit-scrollbar-thumb {
  background-color: #161616;
  /* color of the scroll thumb */
  border-radius: 20px;
  /* roundness of the scroll thumb */
  border: 0 solid white;
  /* creates padding around scroll thumb */
}

.main {
  background: #fff;
}

.hide {
  display: none !important;
}

/*header*/
.relative {
  position: relative;
}

.mobile-nav {
  display: inline-block;
  padding-left: 15px;
  padding-right: 0;
  vertical-align: middle;
  font-size: 11px;
  font-weight: 400;
  text-transform: uppercase;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
  transition: all 0.2s cubic-bezier(0, 0, 0.58, 1);
  transition-property: background, color, height;
}

.mobile-nav:hover,
.mobile-nav.active {
  opacity: 0.75;
}

.mobile-nav:active {
  box-shadow: 0 0 35px rgba(0, 0, 0, 0.05) inset;
}

.main-nav {
  position: absolute;
  z-index: 1;
  width: 100%;
  height: 85px !important;
  top: 0;
  left: 0;
  height: 70px !important;
  line-height: 85px !important;
  text-align: left;
  background: rgba(255, 255, 255, 0.99);
  box-shadow: 0 3px 15px 0 rgba(0, 0, 0, 0.05);
  z-index: 1030;
  transition: all 0.2s cubic-bezier(0, 0, 0.58, 1);
}

.main-nav.sticky {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}

.main-nav.dark .mobile-nav {
  background-color: transparent;
  border-color: transparent;
  color: rgba(255, 255, 255, 0.9);
}

.main-nav.dark {
  background-color: transparent;
}

.main-nav.dark .logo,
.main-nav.dark a.logo:hover {
  font-size: 18px;
  font-weight: 700;
  text-decoration: none;
  color: rgba(255, 255, 255, 0.9);
}

.main-nav.transparent {
  background: transparent !important;
  box-shadow: none;
}

.main-nav.js-transparent {
  transition: all 0.2s cubic-bezier(0, 0, 0.58, 1);
}

.main-nav.dark {
  background-color: transparent;
  box-shadow: none;
  box-shadow: none;
}

.nav__cta_big.btn-mod.btn-border {
  color: #ffffff;
  border: 2px solid #ffffff;
  background: transparent;
  border-radius: 6px;
  opacity: 0.8;
}

.logo,
a.logo:hover {
  font-size: 18px;
  font-weight: 600 !important;
  text-decoration: none;
  color: rgba(0, 0, 0, 0.9);
}

.full-wrapper {
  margin: 0 2%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

@media only screen and (max-width: 1366px) {
  .full-wrapper {
    margin-left: 30px;
    margin-right: 30px;
  }
}

@media only screen and (max-width: 480px) {
  .full-wrapper {
    margin-left: 20px;
    margin-right: 20px;
  }
}

.nav-logo-wrap {
  float: left;
  margin-right: 20px;
}

.nav-logo-wrap .logo {
  display: flex;
  align-items: center;
  max-width: 188px;
  height: 85px;
  transition: all 0.2s cubic-bezier(0, 0, 0.58, 1);
}

.nav-logo-wrap .logo img {
  max-height: 100%;
}

.nav-logo-wrap .logo:before,
.nav-logo-wrap .logo:after {
  display: none;
}

@media only screen and (max-width: 480px) {
  .nav__logo-text {
    font-size: 26px;
  }

  .nav__cta_big.btn-mod.btn-border {
    padding: 8px 11px 10px 11px;
  }
}

@media only screen and (max-width: 1024px) {
  .main-nav,
  .main-nav.small-height,
  .nav-logo-wrap .logo,
  .nav-logo-wrap .logo.small-height {
    height: 70px !important;
    line-height: 80px !important;
  }
}

@media only screen and (max-width: 767px) {
  .nav-logo-wrap .logo {
    max-width: 150px;
  }
}

/*Profile*/
.profile__banner {
  padding: 0;
  /*background-attachment: fixed !important;*/
  background-position: top;
  background-repeat: no-repeat;
  background-size: cover;
}

.profile__header {
  background-color: #000;
  border-radius: 20px;
  box-shadow: rgb(99 99 99 / 20%) 0px 2px 8px 0px;
  display: flex;
  align-items: center;
  overflow: hidden;
  position: relative;
  transition: 0.03s;
  gap: 40px;
}

.profile__text-content {
  padding: 10px 10px 10px 0;
  width: 48%;
}

.profile__container {
  margin-top: 60px;
  padding: 30px 30px;
  position: relative;
  z-index: 1;
}

.profile__image-container {
  min-width: 48%;
  max-width: 300px;
  background-image: url(../<?php echo $profile_pic ?>);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  transition: 0.03s;
}

.profile__header,
.profile__image-container {
  height: 40vmax;
  min-height: 250px;
  max-height: 600px;
}

.profile__firstname {
  font-size: 52px;
  line-height: 1.4;
  margin: 0;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

.profile__lastname {
  font-size: 52px;
  line-height: 1.4;
  margin: 0;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

.profile__title {
  white-space: -moz-pre-wrap !important;
  /* Mozilla, since 1999 */
  white-space: -pre-wrap;
  /* Opera 4-6 */
  white-space: -o-pre-wrap;
  /* Opera 7 */
  white-space: pre-wrap;
  /* css-3 */
  word-wrap: break-word;
  /* Internet Explorer 5.5+ */
  white-space: -webkit-pre-wrap;
  /* Newer versions of Chrome/Safari*/
  /*word-break: break-all;*/
  white-space: normal;
}

.profile__map-pin {
  width: 16px;
  -webkit-filter: invert(0.5);
  filter: invert(0.5);
  margin-top: -4px;
  margin-right: 7px;
}

.profile__breadcrumbs-dot {
  color: #ffffff87;
}

.profile-logo {
  width: 160px;
  height: 160px;
  background: white;
  border-radius: 50%;
  position: absolute;
  bottom: 97px;
  right: 28px;
  border: 2px solid #fff;
  box-shadow: 0 3px 5px 0 rgb(0 0 0 / 10%);
  background-image: url(../<?php echo $logo  ?>);
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  transition: 0.3s;
}

.profile-logo:hover {
  box-shadow: 0 5px 7px 0 rgb(0 0 0 / 20%);
}

.profile__edit_light {
  position: absolute;
  top: 21px;
  right: 26px;
  color: #000;
  padding: 4px 8px 4px 8px;
  cursor: pointer;
}

.profile_output_image {
  height: 70px !important;
  width: auto;
}

@media only screen and (max-width: 1024px) {
  .page-section {
    padding: 52px 0;
  }

  .profile-logo {
    width: 60px;
    height: 60px;
  }
}

@media only screen and (max-width: 767px) {
  .page {
    font-size: 14px;
    line-height: 1.4;
  }

  .profile__header {
    gap: 20px;
  }

  .profile__header,
  .profile__image-container {
    height: 32vmax;
  }

  .profile__firstname {
    font-size: 42px;
  }

  .profile__lastname {
    font-size: 42px;
  }
}

@media only screen and (max-width: 480px) {
  .profile__header {
    gap: 10px;
  }

  .profile__container {
    padding: 30px 20px;
  }

  .profile__edit_light {
    top: 4px;
    right: 10px;
  }

  .profile__header,
  .profile__image-container {
    height: 28vmax;
    min-height: 200px;
  }

  .profile__image-container {
    min-width: 44%;
  }

  .profile__text-content {
    width: 56%;
  }

  .profile__firstname {
    font-size: 28px;
  }

  .profile__lastname {
    font-size: 28px;
  }

  .profile__title {
    font-size: 16px;
  }

  .profile__location {
    font-size: 14px;
  }

  .profile__map-pin {
    width: 14px;
  }
}

@media only screen and (max-width: 293px) {
  .profile__header {
    width: 100%;
  }
}

.buttons__container {
  padding: 0;
  background: #fff;
  padding-top: 155px;
  margin-top: -140px;
  transition: 0.3s;
}

.buttons__share {
  display: flex;
  justify-content: space-evenly;
  width: 100%;
  flex-direction: row;
  gap: 10px;
}

.buttons__share_big {
  width: 100%;
}

.buttons__share_md {
  width: 80%;
}

.buttons__share_orange.btn-mod {
  color: #fff;
  border: none;
  background: <?php echo $color?>;
}

.buttons__share .btn-mod.btn-round {
  border-radius: 6px;
}

@media only screen and (max-width: 767px) {
  .buttons__share_orange.btn-mod {
    padding: 12px 10px 12px 10px;
  }

  .buttons__container {
    margin-top: -120px;
    padding-top: 135px;
  }
}

.about__title {
  display: flex;
  justify-content: space-between;
}

.about__edit_dark {
  -webkit-filter: invert(0.5);
  filter: invert(0.5);
  padding: 4px 8px 4px 8px;
  cursor: pointer;
}

.social__title {
  display: flex;
  justify-content: space-between;
}

.social__edit_dark {
  -webkit-filter: invert(0.5);
  filter: invert(0.5);
  padding: 4px 8px 4px 8px;
  cursor: pointer;
}

.social-links a {
  width: 54px;
  height: 54px;
  line-height: 54px !important;
  position: relative;
  margin: 0 2px;
  text-align: center;
  display: inline-block;
  color: <?php echo $color?>;
  font-size: 24px;
  opacity: 0.85;
  overflow: hidden;
  transition: all 0.23s cubic-bezier(0.3, 0.1, 0.58, 1);
}

.social-links a:before {
  content: "";
  display: inline-block;
  width: 100%;
  height: 100%;
  position: absolute;
  background: #f8f9fa;
  top: 0;
  left: 0;
  border-radius: 10px;
  transition: all 0.27s cubic-bezier(0.3, 0.1, 0.58, 1);
  z-index: -1;
}

.social-links a:hover:before {
  background: #ced4da;
}

.links {
  display: flex;
  align-items: center;
  gap: 16px;
  border-radius: 6px;
  overflow: hidden;
  background: #f7f7f7;
  /*-webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
  box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;*/
}

.links:hover {
  background: #f8f9fa;
}

.links__image-container {
  width: 60px;
  height: 60px;
}

.links__image-container img:not([draggable]) {
  height: 100%;
}

.links__image {
  width: 100%;
  -o-object-fit: contain;
  object-fit: contain;
}

.links__text {
  color: #000;
  margin: 0;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

.links__title {
  display: flex;
  justify-content: space-between;
}

.links__edit_dark {
  -webkit-filter: invert(0.5);
  filter: invert(0.5);
  padding: 4px 8px 4px 8px;
  cursor: pointer;
}

.files__edit_dark {
  -webkit-filter: invert(0.5);
  filter: invert(0.5);
  padding: 4px 8px 4px 8px;
  cursor: pointer;
}

a.link-to-top {
  bottom: 74px;
}

.links__add {
  padding: 20px 20px 20px 10px;
  cursor: pointer;
  width:50px;
}

.links__right-arrow {
  margin-left: auto;
  padding-right: 20px;
  font-size: 20px;
  cursor: pointer;
  color: <?php echo $color?>;
}

.files__right-arrow {
  margin-left: auto;
  padding-right: 20px;
  font-size: 20px;
  cursor: pointer;
  color: <?php echo $color?>;
}

.links__delete {
  position: absolute;
  left: 0px;
  top: 0px;
  padding: 24px 24px 24px 24px;
  background: #00000066;
  color: white;
  border-radius: 7px;
  cursor: pointer;
}

.links__output_image_add {
  height: 30px;
}

.links__edit-icons {
  position: relative;
  z-index: -1;
}

.links__edit-open,
.links__edit-close {
  position: relative;
  z-index: -1;
}

.links__output_image_edit {
  height: 30px;
}

.client__logo-container {
  width: 100%;
  display: flex;
}

.client__logo {
  width: 140px;
  margin: auto;
}

.sticky-footer {
  position: fixed;
  display: flex;
  justify-content: space-around;
  bottom: 0;
  width: 100%;
  padding: 15px 0 15px 0;
  background: #fff;
  box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
  font-size: 18px;
}

@-webkit-keyframes spin {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(-180deg);
  }
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(-180deg);
  }
}

.popup {
  min-width: 100%;
  min-height: 100vh;
  position: fixed;
  top: 0;
  display: flex;
  flex-direction: column;
  font-family: "Inter", Arial, sans-serif;
  visibility: hidden;
  opacity: 0;
  transition: visibility 0s, opacity 0.2s linear;
  z-index: 9999;
}

.popup_opened {
  visibility: visible;
  opacity: 1;
  z-index: 1;
}

.popup__overlay {
  min-width: 100%;
  min-height: 100%;
  background: rgba(0, 0, 0, 0.5);
  position: absolute;
  top: 0;
}

.popup__form {
  margin: auto auto;
  box-sizing: border-box;
  max-width: 430px;
  width: calc(100% - 38px);
  padding: 34px 36px 36px 36px;
  background-color: #fff;
  position: relative;
  box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.15);
  border-radius: 10px;
}

.popup__close-btn {
  width: 40px;
  height: 40px;
  position: absolute;
  padding: 0;
  border: none;
  right: -40px;
  top: -40px;
  background-color: transparent;
  transition: 0.3s;
}

.popup__close-btn:hover {
  opacity: 0.6;
  cursor: pointer;
}

.popup__close-icon {
  width: 100%;
  height: auto;
}

.popup__form-label {
  font-weight: 900;
  font-size: 24px;
  line-height: 29px;
  margin: 0px 0 15px;
}

.popup__form-input {
  max-width: 358px;
  width: 100%;
  border: none;
  border-bottom: 1px solid rgb(0, 0, 0, 0.2);
  font-weight: 400;
  font-size: 14px;
  line-height: 17px;
  padding: 13px 0;
  margin-bottom: 17px;
  color: #000000;
}

.popup__form-input:hover {
  border-bottom-color: #000;
}

.popup__form-input:focus {
  border-bottom-color: #000;
}

.popup__form-input:valid {
  border-bottom: 1px solid rgb(0, 0, 0, 0.2);
}

.popup__form-input:invalid {
  border-bottom: 1px solid red;
}

.popup__social {
  display: flex;
}

.popup__social-icon {
  margin: 9px 14px 0 0;
}

.popup__form-textarea:hover {
  border-bottom-color: #000;
}

.popup__form-textarea:valid {
  border-bottom: 1px solid rgb(0, 0, 0, 0.2);
}

.popup__form-textarea:invalid {
  border: 1px solid red;
}

.popup__social {
  display: flex;
}

.popup_add-social-btn {
  background: #000;
  color: #fff;
}

.popup_add-social-btn:hover {
  color: #e0e0e0;
}

.popup__social-icon {
  margin: 9px 14px 0 0;
}

.popup__save-btn {
  width: 100%;
  background-color: #000000;
  border: none;
  border-radius: 6px;
  font-weight: 400;
  font-size: 18px;
  line-height: 22px;
  text-align: center;
  color: #fff;
  padding: 14px 0 18px;
  margin: 31px auto 0;
  transition: 0.3s;
}

.popup__save-btn:hover {
  opacity: 0.8;
  cursor: pointer;
}

.popup__save-btn-disabled {
  background-color: #cfcfcf;
}

.popup__form_image {
  background: none;
  max-width: 75vw;
  max-height: 75vh;
  width: auto;
  padding: 0;
  margin: auto;
  box-shadow: none;
}

.popup__form-textarea {
  min-height: 200px;
  max-height: 500px;
  width: 100%;
  max-width: 900px;
  border: 1px solid #eee;
}

.popup__form-textarea::-webkit-input-placeholder {
  font-size: 1rem;
  color: #9c9c9c;
  font-family: "Roboto", sans-serif;
}

.popup__form-textarea::-moz-placeholder {
  font-size: 1rem;
  color: #9c9c9c;
  font-family: "Roboto", sans-serif;
}

.popup__form-textarea:-ms-input-placeholder {
  font-size: 1rem;
  color: #9c9c9c;
  font-family: "Roboto", sans-serif;
}

.popup__form-textarea::-ms-input-placeholder {
  font-size: 1rem;
  color: #9c9c9c;
  font-family: "Roboto", sans-serif;
}

.popup__form-textarea::placeholder {
  font-size: 1rem;
  color: #9c9c9c;
  font-family: "Roboto", sans-serif;
}

.popup__card-image-preview {
  width: 100%;
  max-width: 75vw;
  max-height: 75vh;
}

.popup__card-image-preview-name {
  font-weight: 400;
  font-size: 12px;
  line-height: 14.52px;
  color: #fff;
}

.popup__form-input_type_link_id,
.popup__form-input_type_file_id {
  height: 0;
  padding: 0;
  border: none;
  margin: 0;
  width: 0;
  visibility: hidden;
  opacity: 0;
}

@media screen and (max-width: 540px) {
  .popup__form {
    padding: 25px 22px 25px 22px;
  }

  .popup__form_image {
    padding: 0;
  }

  .popup__close-btn {
    right: -7px;
    top: -40px;
    -webkit-animation: spin 0.3s;
    animation: spin 0.3s;
  }

  .popup__close-icon {
    width: 26px;
    height: 26px;
  }
}

@media screen and (max-height: 753px) {
  .popup__edit-social-form {
    overflow-y: scroll;
    height: 66vh;
  }
}

@media screen and (max-height: 620px) {
  .popup__edit-profile {
    overflow-y: scroll;
    height: 50vh;
  }
}

@media screen and (max-height: 530px) {
  .popup__edit-about-form {
    overflow-y: scroll;
    height: 40vh;
  }

  .popup__edit-social-form {
    overflow-y: scroll;
    height: 40vh;
  }

  .popup__form-label {
    margin: 0 0 17px;
  }
}

.colour {
  background: #fff;
  position: fixed;
  width: 100%;
  height: 0;
  bottom: 0;
  transform: translate(-50%, 0%);
  left: 50%;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
  overflow: hidden;
  transition: 0.3s;
}

.colour_opened {
  height: 400px;
}

.colour__selection {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  flex-direction: column;
  gap: 20px;
  padding: 30px 20px 0;
}

.colour:before {
  content: "";
  background: #fff;
  width: 100%;
  height: 97px;
  position: absolute;
  top: 0;
  border-bottom-left-radius: 50%;
  border-bottom-right-radius: 50%;
}

.colour__popup__form-label {
  font-weight: 900;
  font-size: 24px;
  line-height: 29px;
  text-align: center;
  padding: 40px 40px 0;
  margin: 0;
  color: #000;
  position: relative;
}

.colour__text {
  font-size: 14px;
  text-align: center;
  line-height: 1;
  margin: 0;
}

.colour__column {
  display: flex;
  justify-content: space-around;
  padding-top: 30px;
}

.colour__circle {
  width: 40px;
  height: 40px;
  position: relative;
  border-radius: 60px;
  cursor: pointer;
}

.colour__name {
  font-size: 12px;
  line-height: 1;
  position: absolute;
  bottom: -24px;
  left: 50%;
  transform: translate(-50%, -50%);
}

.popup__footer-close-btn {
  width: 30px;
  height: 30px;
  position: absolute;
  padding: 0;
  border: none;
  right: 14px;
  top: 16px;
  background-color: transparent;
  transition: 0.3s;
}

.popup__footer-close-btn .popup__close-icon {
  -webkit-filter: invert(1);
  filter: invert(1);
}

.colour__blue {
  background: #0d6efd;
}

.colour__indigo {
  background: #6610f2;
}

.colour__purple {
  background: #6f42c1;
}

.colour__pink {
  background: #d63384;
}

.colour__red {
  background: #dc3545;
}

.colour__orange {
  background: #fd7e14;
}

.colour__yellow {
  background: #ffc107;
}

.colour__gold {
  background: #f6bb42;
}

.colour__green {
  background: #198754;
}

.colour__teal {
  background: #20c997;
}

.colour__cyan {
  background: #0dcaf0;
}

.colour__default {
  background: #6c757d;
}

@media screen and (max-width: 540px) {
  .colour_opened {
    height: 368px;
  }
}

@media screen and (max-height: 420px) {
  .colour_opened {
    height: 240px;
    overflow-y: scroll;
  }
}

@media screen and (max-width: 540px) {
  .popup__footer-close-btn {
    right: 13px;
    top: 11px;
    -webkit-animation: spin 0.3s;
    animation: spin 0.3s;
  }
}

.userinfo {
  background: #fff;
  position: fixed;
  width: 100%;
  height: 0;
  bottom: 0;
  transform: translate(-50%, 0%);
  left: 50%;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
  overflow: hidden;
  transition: 0.3s;
}

.userinfo_opened {
  height: 465px;
}

@media screen and (max-width: 540px) {
  .userinfo_opened {
    height: 537px;
  }
}

@media screen and (max-height: 626px) {
  .userinfo_opened {
    height: 368px;
    overflow: scroll;
  }
}

.sticky-footer__colour-icon {
  cursor: pointer;
}

.share__button-container {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  justify-content: center;
}

.share__button {
  border: none;
  width: 46px;
  height: 46px;
  border-radius: 8px;
}

.share__link {
  padding: 10px;
  border-radius: 4px;
  width: 270px;
  margin: 30px auto;
}

.share__link-input {
  background: transparent;
  border: transparent;
  color: #e9ecef;
}

.files {
  display: flex;
  align-items: center;
  gap: 16px;
  border-radius: 6px;
  overflow: hidden;
  background: #f7f7f7;
  /*-webkit-box-shadow: rgb(0 0 0 / 10%) 0px 1px 2px 0px;
  box-shadow: rgb(0 0 0 / 10%) 0px 1px 2px 0px;*/
}

.files__title {
  display: flex;
  justify-content: space-between;
}

.files__text {
  margin: 0;
  text-decoration: none;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

.files__edit-icons {
  position: relative;
  z-index: -1;
}

.files__image-container {
  width: 60px;
  height: 60px;
}

.files__image-container img:not([draggable]) {
  height: 100%;
}

.files__edit-open,
.files__edit-close {
  position: relative;
  z-index: -1;
}

.files__icon {
  position: absolute;
  left: 0px;
  top: 0px;
  padding: 20px 21px 17px 16px;
  border-radius: 7px;
  cursor: pointer;
  font-size: larger;
  color: <?php echo $color?>;
}

.files_right-arrow {
  margin-left: auto;
  padding-right: 20px;
  font-size: 20px;
  cursor: pointer;
  color: <?php echo $color?>;
}

.files__delete {
  position: absolute;
  left: 0px;
  top: 0px;
  padding: 24px 24px 24px 24px;
  border-radius: 7px;
  cursor: pointer;
}
.files__add{
padding:20px 20px 20px 10px;
cursor:pointer;
width: 50px;
}
.files__delete-icon {
  position: relative;
  z-index: -1;
}

.input_error {
  font-size: 12px;
  color: red;
  margin-bottom: 0;
}

.input_error_active {
  opacity: 1;
}

.footer {
  text-align: center;
  font-size: 18px;
  padding-top: 140px;
  padding-bottom: 100px;
}

.footer a {
  text-decoration: none;
  transition: all 0.27s cubic-bezier(0.3, 0.1, 0.58, 1);
}

.footer a:hover {
  color: #111;
  text-decoration: underline;
}

.footer__copyright {
  margin-bottom: 2px;
  font-weight: 600;
  color: #171717;
  opacity: 0.9;
}

.footer__made {
  font-size: 14px;
  font-weight: 400;
  color: #999;
}

.footer__logo {
  width: 160px;
  height: 160px;
  background: white;
  border-radius: 50%;
  position: absolute;
  bottom: 97px;
  right: 30px;
  border: 2px solid #fff;
  box-shadow: 0 3px 5px 0 rgb(0 0 0 / 10%);
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  transition: 0.3s;
}

.footer__logo :hover {
  box-shadow: 0 5px 7px 0 rgb(0 0 0 / 20%);
}

@media only screen and (max-width: 1024px) {
  .footer {
    padding-top: 52px;
  }

  .footer__logo {
    width: 60px;
    height: 60px;
  }
}

@media only screen and (max-width: 388px) {
  .footer__text {
    display: flex;
    flex-direction: column;
    align-content: flex-start;
    flex-wrap: wrap;
  }

  .footer__logo {
    right: 20px;
  }
}

.delete-social {
  position: absolute;
  background: #fff;
  top: 0;
  padding: 4px;
  left: 0;
  display: none;
  cursor: pointer;
}

.popup__social-icon:hover .delete-social {
  display: block;
}
.custom-input-button {
            position: relative;
            display: inline-block;
        }

        .custom-input-button input[type="file"] {
            display: none;
        }

        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #000;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
        }

        .custom-button:hover {
            background-color: #fff;
            color:#000;
        }
    </style>
  </head>
</html>