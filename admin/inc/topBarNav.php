<style>
  .user-img {
    position: absolute;
    height: 27px;
    width: 27px;
    object-fit: cover;
    left: -7%;
    top: -12%;
  }

  .btn-rounded {
    border-radius: 50px;
  }
</style>
<!-- Navbar -->
<nav
  class="main-header navbar navbar-expand navbar-dark border border-light border-top-0  border-left-0 border-right-0 navbar-light text-sm ">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-dark" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li style="display: flex;" class="nav-item  ">
    <span style="font-size:20px;color:gray;font-weight:bold;padding-top:-20px !important;">STOKIFY</span>  
      <a href="<?php echo base_url ?>"
        class="nav-link text-dark"><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?> -
        Admin</a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item d-flex">
      <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
            </a> -->
      <div class="d-flex navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <!-- <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                    </button> -->
            </div>
          </div>
        </form>
      </div>
    </li>
    <a href="http://localhost:8080/sms/admin/?page=Notification/Notification">
    <li style="position: relative;" class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="http://localhost:8080/sms/admin/?page=Notification/Notification" role="button">
        <i style="font-size:20px; " class="fas fa-bell text-dark"></i>

      </a>
      <p style="background:red;display:inline-block;border-radius:100px;font-size:10;padding-inline:7px;position:absolute;top:0;right:0;color:white;">1</p>
    </li></a>
    <!-- Messages Dropdown Menu -->
    <li class="nav-item">

      <div class="btn-group nav-link">
        <button type="button" class="btn btn-rounded badge  text-dark dropdown-toggle dropdown-icon"
          data-toggle="dropdown">
          <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>"
              class="img-circle elevation-2 user-img" alt="User Image"></span>
          <span
            class="ml-3"><?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')) ?></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>

        <div class="dropdown-menu theUSERbutton" role="menu">

          <div class='d-flex'>
            <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle Drop-image"
              alt="User Image">
            <div>
              <span style="font-weight: bold;font-size:18px;"
                class="ml-3 fw-bold fs-3"><?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')) ?>
              </span>
              <p style="margin-block:0;padding-block:0" class='ml-3'><?php echo   $_settings->info('short_name'); ?></p>
              <p style="padding-top: -15px !important; color:green;" class='ml-3 p-0'>Users:  <?php
                            echo $conn->query("SELECT * FROM `users` where id != 1 ")->num_rows;
                            ?></p>
            </div>

          </div>
          <a style="padding-block:0 !important;margin:0; " class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="fas fa-address-card	"></span> My
            Account</a>
          <div  class="dropdown-divider"></div>

          <a style="padding-block:0 !important;margin-block:0;" class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="	fas fa-align-left"></span>
            My Design</a>
          <div class="dropdown-divider"></div>

          <a style="padding-block:0;margin:0; "  class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="fas fa-book	  "></span>
            Software news</a>
          <div class="dropdown-divider"></div>

          <a style="padding-block:0;margin:0; "  class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="fa fa-newspaper-o	"></span>
            Need help ?</a>


          <div class="dropdown-divider"></div>
          <p class="Product">A product of Switchiify Inc, 2024</p>
          <a style="padding-block:0;margin:0; "  class="dropdown-item" href="<?php echo base_url . '/classes/Login.php?f=logout' ?>"><span
              class="fas fa-sign-out-alt"></span> Logout</a>
        </div>
      </div>
    </li>
    <li class="nav-item">

    </li>

  </ul>
</nav>
<!-- /.navbar -->