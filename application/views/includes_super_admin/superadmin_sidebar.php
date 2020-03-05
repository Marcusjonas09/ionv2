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

       <?php if ($this->session->access == 'superadmin') : ?>

         <li class="<?= in_array($this->uri->segment(2), array('admin', '')) ? ' active' : ''; ?>"><a href="<?= base_url() ?>SuperAdmin/admin"><i class="fa fa-user"></i> <span>Admin Accounts</span></a></li>
         <!-- <li><a href="<?= base_url() ?>SuperAdmin/database"><i class="fa fa-user"></i> <span>Database</span></a></li> -->

       <?php endif; ?>

       <?php if ($this->session->access == 'admin') : ?>

         <li class="<?= in_array($this->uri->segment(2), array('dashboard')) ? ' active' : ''; ?>"><a href="<?= base_url() ?>SuperAdmin/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
         <!-- <li><a href="<?= base_url() ?>SuperAdmin/student_accounts"><i class="fa fa-user"></i> <span>Student Accounts</span></a></li> -->

       <?php endif; ?>

       <li class="<?= in_array($this->uri->segment(2), array('school_announcements')) ? ' active' : ''; ?>"><a href="<?= base_url() ?>SuperAdmin/school_announcements"><i class="fa fa-bullhorn"></i><span>School Announcements</span>
       <li class="<?= in_array($this->uri->segment(2), array('academic_calendar')) ? ' active' : ''; ?>"><a href="<?= base_url() ?>SuperAdmin/academic_calendar"><i class="fa fa-calendar"></i><span>School Calendar</span></a></li>

       <li class="treeview <?= in_array($this->uri->segment(2), array('course_petitions', 'faculty_evaluation', 'underload', 'overload', 'simul')) ? ' active' : ''; ?>">
         <a href="#">
           <i class="fa fa-share"></i> <span>Services</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a style="color:<?= $this->uri->segment(2) == 'course_petitions' ? 'white' : ''; ?>;" href="<?= base_url() ?>SuperAdmin/course_petitions"><i class="fa fa-file-text-o"></i><span>Course Petitions</span></a></li>
           <li><a style="color:<?= $this->uri->segment(2) == 'faculty_evaluation' ? 'white' : ''; ?>;" href="<?= base_url() ?>SuperAdmin/faculty_evaluation"><i class="fa fa-file-text-o"></i><span>Faculty Evaluation</span></a></li>
           <li><a style="color:<?= $this->uri->segment(2) == 'underload' ? 'white' : ''; ?>;" href="<?= base_url() ?>SuperAdmin/underload"><i class="fa fa-file-text-o"></i><span>Underload Requests</span></a></li>
           <li><a style="color:<?= $this->uri->segment(2) == 'overload' ? 'white' : ''; ?>;" href="<?= base_url() ?>SuperAdmin/overload"><i class="fa fa-file-text-o"></i><span>Overload Requests</span></a></li>
           <li><a style="color:<?= $this->uri->segment(2) == 'simul' ? 'white' : ''; ?>;" href="<?= base_url() ?>SuperAdmin/simul"><i class="fa fa-file-text-o"></i><span>Simul Requests</span></a></li>
         </ul>
       </li>
       <?php if ($this->session->has_school_parameters == TRUE) : ?>
         <li class="<?= in_array($this->uri->segment(2), array('school_parameters')) ? ' active' : ''; ?>"><a href="<?= base_url() ?>SuperAdmin/school_parameters"><i class="fa fa-gear"></i> <span>School Parameters</span></a></li>
       <?php endif; ?>
       <!-- <li><a href="<?= base_url() ?>SuperAdmin/faculty"><i class="fa fa-user"></i> <span>Faculty</span></a></li>
       <li><a href="<?= base_url() ?>SuperAdmin/student"><i class="fa fa-user"></i> <span>Student</span></a></li>
       <li><a href="<?= base_url() ?>SuperAdmin/course"><i class="fa fa-user"></i> <span>Course</span></a></li>
       <li><a href="<?= base_url() ?>SuperAdmin/laboratory"><i class="fa fa-user"></i> <span>Laboratory</span></a></li> -->
     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>