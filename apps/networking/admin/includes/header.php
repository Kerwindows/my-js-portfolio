<?php
if (!defined('PROJECT_PATH')) {
 header("Location: ../../../404.html");
 exit();
}
?>
<body class="sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Support</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <?php if($infouser['Role'] == "teacher" || $infouser['Role'] == 'secretary' || $infouser['Role'] == 'auxstaff' || $infouser['Role'] == "admin" || $infouser['Role'] == "superadmin"){ ?>
    <form class="form-inline ml-3" action='' method='GET'>
      <div class="input-group input-group-sm">
        <input id='mySearch' class="form-control form-control-navbar"  type="search" value='<?php if(!empty($_GET['user-query'])){echo $_GET['user-query'];}  ?>' name='user-query' placeholder="User Search" aria-label="Search">
        <div class="input-group-append">
          <button id="submit" class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
   <?php } ?>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"><li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
   </ul>
  </nav>
  
  
  
  <!-- Preloader -->
 <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="img/files/cuc-logo.png" alt="AdminLTELogo" height="auto" width="60">
  </div>-->
  <script>
$('#submit').click(function(){
   if($('#mySearch').val() == ''){
      toastr.error('Search can not be left blank');
      return false;
   }
   if($('#mySearch').val().length < 3){
      toastr.error('Search must be more that 2 characters');
      return false;
   }
});
</script>
  <!-- /.navbar -->