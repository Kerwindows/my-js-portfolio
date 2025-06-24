<?php


function head($array_var = []) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>/assets/img/favicon.png">
    <title><?php echo htmlspecialchars($array_var['site_title'] ?? 'Default Title'); ?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/fontawesome/css/fontawesome.com_releases_v6.4.2_css_all.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/fontawesome/css/fontawesome.com_releases_v6.4.2_css_sharp-light.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/fontawesome/css/fontawesome.com_releases_v6.4.2_css_sharp-regular.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/plugins/fontawesome/css/fontawesome.com_releases_v6.4.2_css_sharp-solid.css">
    <?php cssLoader($array_var['styles'] ?? []); ?>
    <script nonce="<?php echo htmlspecialchars($_SESSION['nonce']) ?>">const base_url = '<?php echo base_url() ?>'; const $time_zone = '<?php echo SiteSettings::getTimeZone() ?>';</script>
    <style>
    .shimmer {
	  position: relative;
	  overflow: hidden;
	  background-color: #f4f6f9; /* Change to your desired light background color */
	  border-radius: 5px;
	}
	
	.shimmer::before {
	  content: "";
	  position: absolute;
	  top: 0;
	  left: -100%;
	  width: 100%;
	  height: 100%;
	  background-image: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.2)); /* Adjust the opacity and color stops as desired */
	  animation: shimmer 1.5s infinite;
	}
	@keyframes shimmer {
	  0% {
	    transform: translateX(0);
	  }
	  100% {
	    transform: translateX(100%);
	  }
	} 
	.dt-buttons .btn.btn-secondary{
	background:#fff;
	border: 0px;
        font-size: 22px;
	}
	.dt-buttons .btn.btn-secondary:hover{
	background:#eee;
	}
	.btn-copy { color: #00d3c7; } /* Green for copy */
.btn-csv { color: #17a2b8; } /* Teal for CSV */
.btn-excel { color: #ffc107; } /* Yellow for Excel */
.btn-pdf { color: #dc3545; } /* Red for PDF */
.btn-print { color: #2e37a4; } /* Blue for Print */
.btn-colvis { color: #6c757d; } /* Dark for Column Visibility */
    </style>
</head>
<body>
<?php
}