<?php $nav = new Aside; ?>
<!-- Main Sidebar Container -->
<aside class="cuc main-sidebar elevation-1 sidebar-light-fuchsia sidebar-no-expand">
    <!-- Brand Logo -->
    <a href="/" class="brand-link brand-link navbar-light">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-dark"><?php echo "{$infouser['Job']}";?> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img  src="images/profile-images/<?php echo "{$infouser['ProfileImage']}";?>" class="img-circle elevation-2 aside-profileimg"  alt="User Image">
            </div>
            <div class="info">
                <a id='aside-fullname' href="index.php?myprofile" class="d-block">
                    <?php echo "{$infouser['FirstName']} {$infouser['LastName']}";?>
                </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="nav-icon fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              
              <?php 
              //$nav->asideNav("dashboard&year=".date("Y")."&month=".date("m")." ",'Dashboard','fas fa-chart-bar'); 
              
              $nav->asideNav("dashboard",'Dashboard','fas fa-chart-bar'); 
              
              if($infouser['Role'] == 'Corp'){
              $nav->asideNav("user-profiles",'User Profiles','fas fa-user'); 
               $nav->asideNav("add-users",'Add Users','fa-duotone fa-users'); 
              }else{
                $nav->asideNav("myprofile",'Edit Profile','fa-duotone fa-user');
              }
              //$nav->asideNav("edit-canvas",'Edit Canvas','fa fa-mobile'); 
              $nav->asideNav("leads&year=".date("Y")."",'Leads','fas fa-chart-line');              
              $nav->asideNav("archivelinks",'Links',' fas fa-solid fa-link'); 
              $nav->asideNav("QRCode",'QR Code','fas fa-solid fa-qrcode'); 
              $nav->asideNav("my-orders",'Orders','fas fa-table');
              $nav->asideNav("my-subscriptions",'Subscription','fa fa-credit-card');
              $nav->asideNav("edit-info",'Account Info','fas fa-user');
              $nav->asideNav("password",'Change Password','fa-regular fa-unlock-keyhole');
              ?>

                <li class="nav-item">
                    <a href="#" class='nav-link'>
                        <i class="nav-icon far fa-clock"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>