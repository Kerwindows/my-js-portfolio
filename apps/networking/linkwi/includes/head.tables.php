<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="LinkWi">
  <title>LinkWi Digital NFC Business Cards</title>
  <meta property="og:image" content="images/icons/link-icon.jpg" />
  <meta property="og:image:width" content="2000" />
  <meta property="og:image:height" content="1600" />
  <link rel="shortcut icon" type="image/jpg" href="images/icons/link-icon.jpg">
  <!-- <link rel="stylesheet" href="admin/bootstrap-5/css/Team-Boxed.css">
  <link rel="stylesheet" href="admin/bootstrap-5/css/Team-Grid.css"> -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Date Picker -->
  <link href="vendor/library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
  <link href="vendor/library/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="vendor/library/daterangepicker.css" rel="stylesheet" />
  <!-- Select2 -->
  <!-- <link rel="stylesheet" href="admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
 <link rel="stylesheet" href="admin/plugins/toastr/toastr.min.css">
 <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">-->
  <link rel="stylesheet" href="../admin/admin/dist/css/fontawesome.com_releases_v6.4.2_css_all.css" type="text/css">
  <link rel="stylesheet" href="../admin/admin/dist/css/fontawesome.com_releases_v6.4.2_css_sharp-light.css" type="text/css">
  <link rel="stylesheet" href="../admin/admin/dist/css/fontawesome.com_releases_v6.4.2_css_sharp-regular.css" type="text/css">
  <link rel="stylesheet" href="../admin/admin/dist/css/fontawesome.com_releases_v6.4.2_css_sharp-solid.css" type="text/css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="admin/dist/css/linkwi.css">
  <!-- Upload Image -->
  <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js">-->
  <style>
  span#add-user__pass-type {
    position: absolute;
    bottom: 0;
    right: 5px;
    z-index: 9;
    filter: invert(1);
    color: #fdfdfd;
    font-size: 11px;
}

div#add-user__meter {
    background: #fff;
    border-bottom: 1px solid #000;
}

.add-user__input-group-text {
    border: none;
    border-bottom: 1px solid #000;
    border-radius: 0 !important;
}

span.add-user__lock.input-group-addon {
    background: #fff;
}

i.fa.fa-check,
i.fa.fa-times {
    padding-top: 13px;
}

label:not(.form-check-label):not(.custom-file-label) {
    font-weight: 400;
}
   .arrowpopup .tooltiptext {
    visibility: hidden;
    opacity: 0;  /* Set initial opacity to 0 */
    width: 207px;
    background-color: #fff;
    color: black;
    text-align: center;
    border-radius: 10px !important;
    padding: 9px;
    position: absolute;
    bottom: 112%;
    right: 0;
    margin-left: 5px;
    transition: opacity 0.3s, visibility 0.3s;  /* Add transition for opacity */
    box-shadow: rgba(99, 99, 99, 0.2) 1px 1px 21px 0px
}

.arrowpopup .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -12px;
    border-width: 12px;
    border-style: solid;
    border-color: #fff transparent transparent transparent;
}

.arrowpopup:hover .tooltiptext {  /* Show tooltip on hover */
    visibility: visible;
    opacity: 1;  /* Set opacity to 1 to make it fully visible */
}

.display-none {
    display: none;
}

.display-block {
    display: block;
}
  
  </style>
  
</head>