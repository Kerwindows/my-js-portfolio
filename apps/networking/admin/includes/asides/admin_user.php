<?php $nav = new Aside; ?>
<!-- Main Sidebar Container -->
<aside class="cuc main-sidebar elevation-1 sidebar-light-black">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-dark">Administrator </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                
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
              $nav->asideNav("dashboard",'Dashboard','fas fa-chart-bar'); 
              
             // $nav->asideNav("orders",'Orders ','fas fa-user'); 
              $nav->asideNav("pending-orders",'Orders','fas fa-chart-line');
              //$nav->asideNav("confirm-order",'Confirm Order',' fas fa-solid fa-link'); 
              //$nav->asideNav("client-order",'Client Order','fas fa-lock');
              $nav->asideNav("remove-images",'Remove Ununsed Images','fas fa-image');
              ?>
              
                

                <li class="nav-item">
                    <a href="logout.php" class='nav-link'>
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