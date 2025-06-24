<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-6 sidebar-light-indigo">
  <!-- Brand Logo -->
  <a href="/" class="brand-link"> <img src="../../images/voila-circle-392x392.png" alt="CheckIN TT" class="brand-image img-circle elevation-3" style="opacity: .8"> <span class="brand-text font-weight-light">Voila
    </span> </a>
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex"> <a href="profile">
        <div id='' class='<?php echo $noimageaside ?>'  data-toggle='tooltip' data-placement='top' title='View Profile' >
          <div class='panel-image' style='background:url("../images/logo-130x130.png");'>
          </div>
        </div>
      </a>
      <div class="info">
        <a href="?profile" class="d-block">
          Adminitrator
        </a>
      </div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="?dashboard" class="nav-link <?php echo $dactive ?>"> <i class="linear-icon-home">
            </i>
            <p>Dashboard </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="?orders" class="nav-link <?php echo $pre_orders_active ?>"> <i class="linear-icon-cart">
            </i>
            <p>Pre-Orders </p>
          </a>
        </li>
         <li class="nav-item">
          <a href="?pending-orders" class="nav-link <?php echo $pen_orders_active ?>"> <i class="linear-icon-cart">
            </i>
            <p>Orders </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="?remove-images" class="nav-link <?php echo $ractive ?>"> <i class="linear-icon-picture">
            </i>
            <p>Remove Images</p>
          </a>
        </li>
        
        
        <li class="nav-item">
          <a href="logout.php" class="nav-link"> <i class="linear-icon-enter-left">
            </i>
            <p>Logout </p>
          </a>
        </li>
        
      </ul>
    </nav>
</aside>