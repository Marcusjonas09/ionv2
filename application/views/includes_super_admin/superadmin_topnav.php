<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="<?= base_url() ?>SuperAdmin" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>FIT</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>FEUTECH</b></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->

        <!--NOTIFICATION SUBMODULE-->

        <!-- User Account Menu -->

        <li class="dropdown user user-menu">

          <!-- Menu Toggle Button -->

          <a href="<?= base_url() ?>SuperAdmin/profile">

            <img src="<?= base_url() ?>dist/img/default_avatar.png" class="user-image" alt="User Image">

            <span class="hidden-xs"><?= $this->session->Firstname . ' ' . $this->session->Lastname ?></span>
          </a>

        </li>

        <li>
          <!-- Menu Toggle Button -->
          <a href="<?= base_url() ?>Superadmin/logout"><span class="fa fa-sign-out"></span></a>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <!-- <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-calendar"></i></a>
        </li> -->
      </ul>
    </div>
  </nav>
</header>