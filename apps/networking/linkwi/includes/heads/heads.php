<?php

function head($Role){

	if($Role == "superadmin"){ ?>
	
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Contact Tracing.">
  <title>CUC HR Database</title>
  <meta property="og:image" content="img/files/cuc-logo.png" />
  <meta property="og:image:width" content="2000" />
  <meta property="og:image:height" content="1600" />
  <link rel="shortcut icon" type="image/jpg" href="img/files/cuc-logo.png"/>
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../admin/plugins/fontawesome-free/css/all.min.css">
  
  <?php
  if(getSlug()=="population"){ ?>
  <link rel="stylesheet" href="../../admin/bootstrap-5/css/Team-Boxed.css">
  <link rel="stylesheet" href="../../admin/bootstrap-5/css/Team-Grid.css">
  <?php } ?>
  
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../../admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <?php
  if(getSlug()=="staffprofile"){ ?>
    <!-- Select2 -->
  <link rel="stylesheet" href="../../admin/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <?php } ?>
  

  <link rel="stylesheet" href="../../admin/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  
  <!-- Upload Image -->
  <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
	
	
<?php	} 
	if($Role == "student"){ ?>
	<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Contact Tracing.">
  <title>CUC HR Database</title>
  <meta property="og:image" content="img/files/cuc-logo.png" />
  <meta property="og:image:width" content="2000" />
  <meta property="og:image:height" content="1600" />
  <link rel="shortcut icon" type="image/jpg" href="img/files/cuc-logo.png"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Toast -->
  <link rel="stylesheet" href="../../admin/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- Upload Image -->
  <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<?php	} 	
	
	


}