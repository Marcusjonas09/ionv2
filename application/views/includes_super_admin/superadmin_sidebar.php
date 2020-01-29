 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

     <!-- Sidebar user panel (optional) -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="<?= base_url() ?>dist/img/default_avatar.png" class="img-circle">
       </div>
       <div class="pull-left info">
         <p><?= $this->session->Firstname . ' ' . $this->session->Lastname ?></p>
         <!-- Status -->
         <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>
       <!-- Optionally, you can add icons to the links -->
       <li class="active"><a href="<?= base_url() ?>Admin/"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
       <li><a href="<?= base_url() ?>SuperAdmin/school_parameters"><i class="fa fa-user"></i> <span>School Parameters</span></a></li>
       <li><a href="<?= base_url() ?>SuperAdmin/admin"><i class="fa fa-user"></i> <span>Admin Accounts</span></a></li>
       <!-- <li><a href="<?= base_url() ?>SuperAdmin/faculty"><i class="fa fa-user"></i> <span>Faculty</span></a></li>
       <li><a href="<?= base_url() ?>SuperAdmin/student"><i class="fa fa-user"></i> <span>Student</span></a></li>
       <li><a href="<?= base_url() ?>SuperAdmin/course"><i class="fa fa-user"></i> <span>Course</span></a></li>
       <li><a href="<?= base_url() ?>SuperAdmin/laboratory"><i class="fa fa-user"></i> <span>Laboratory</span></a></li> -->
       <li><a href="<?= base_url() ?>SuperAdmin/database"><i class="fa fa-user"></i> <span>Database</span></a></li>
     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>