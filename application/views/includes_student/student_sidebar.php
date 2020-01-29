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
         <a href="#"><i class="fa fa-circle text-success"></i><?= $this->session->acc_number ?></a>
       </div>
     </div>

     <!-- Sidebar Menu -->
     <ul id="sidenav" class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>
       <li class="active"><a href="<?= base_url() ?>Student/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       <li><a href="<?= base_url() ?>Student/announcements"><i class="fa fa-bullhorn"></i><span>Announcements</span></a></li>
       <!-- <li><a href="<?= base_url() ?>Student/calendar"><i class="fa fa-calendar"></i><span>Calendar</span></a></li> -->

       <!--=======================================================================================-->
       <!--=======================================================================================-->
       <!--=======================================================================================-->

       <li class="treeview">
         <a href="#">
           <i class="fa fa-share"></i> <span>My Account</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?= base_url() ?>Student/profile/<?= $this->session->acc_number ?>"><i class="fa fa-file-text-o"></i> <span>Profile</span></a></li>
           <li><a href="<?= base_url() ?>Student/curriculum"><i class="fa fa-list-alt"></i><span>Curriculum</span></a></li>
           <li><a href="<?= base_url() ?>Student/course_card"><i class="fa fa-file-text-o"></i> <span>Course Card</span></a></li>
           <li><a href="<?= base_url() ?>Student/cor"><i class="fa fa-file-text-o"></i> <span>COR</span></a></li>
           <li><a href="<?= base_url() ?>Student/assessment/<?= $this->session->curr_term ?>/<?= $this->session->curr_year ?>"><i class="fa fa-file-text-o"></i> <span>Balance Inquiry</span></a></li>
         </ul>
       </li>

       <!--=======================================================================================-->
       <!--=======================================================================================-->
       <!--=======================================================================================-->

       <li class="treeview">
         <a href="#">
           <i class="fa fa-share"></i> <span>Academics</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?= base_url() ?>Student/parallel"><i class="fa fa-file-text-o"></i> <span>Parallel Courses</span></a></li>
           <li><a href="<?= base_url() ?>Student/offerings"><i class="fa fa-file-text-o"></i> <span>Course Offerings</span></a></li>
         </ul>
       </li>

       <!--=======================================================================================-->
       <!--=======================================================================================-->
       <!--=======================================================================================-->

       <li class="treeview">
         <a href="#">
           <i class="fa fa-share"></i> <span>Services</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="http://ofes.feutech.edu.ph/" target="_blank"><i class="fa fa-file-text-o"></i> <span>Online Faculty Evaluation</span></a></li>
           <li><a href="http://opac.feutech.edu.ph/" target="_blank"><i class="fa fa-file-text-o"></i> <span>Online Public Access Catalogue</span></a></li>
           <li><a href="http://fcis.feutech.edu.ph/" target="_blank"><i class="fa fa-file-text-o"></i> <span>Online Fitness Reservation</span></a></li>
           <li><a href="<?= base_url() ?>Student/petitions"><i class="fa fa-file-text-o"></i> <span>Petition Course</span></a></li>
           <li><a href="<?= base_url() ?>Student/maintenance"><i class="fa fa-file-text-o"></i> <span>Load Revision</span></a></li>
           <li><a href="<?= base_url() ?>Student/maintenance"><i class="fa fa-file-text-o"></i> <span>Overload / Underload</span></a></li>
           <li><a href="<?= base_url() ?>Student/maintenance"><i class="fa fa-file-text-o"></i> <span>Request for Simultaneous</span></a></li>

           <!-- <li><a href="<?= base_url() ?>Student/revisions"><i class="fa fa-file-text-o"></i> <span>Load Revision</span></a></li> -->
           <!-- <li><a href="<?= base_url() ?>Student/check_units/<?= $this->session->acc_number ?>/<?= $this->session->curr_year ?>/<?= $this->session->curr_term ?>"><i class="fa fa-file-text-o"></i> <span>Overload / Underload</span></a></li> -->
           <!-- <li><a href="<?= base_url() ?>Student/check_graduating"><i class="fa fa-file-text-o"></i> <span>Request for Simultaneous</span></a></li> -->
         </ul>
       </li>

       <!--=======================================================================================-->
       <!--=======================================================================================-->
       <!--=======================================================================================-->

       <li class="treeview">
         <a href="#">
           <i class="fa fa-share"></i> <span>Others</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="https://students.feutech.edu.ph/_public/downloads/Student%20Handbook%202018%20HD.pdf" target="_blank"><i class="fa fa-file-text-o"></i> <span>Student Handbook</span></a></li>
           <li><a href="https://students.feutech.edu.ph/_public/downloads/CMO_No.104%20S.2017.pdf" target="_blank"><i class="fa fa-file-text-o"></i> <span>CMO Guideline</span></a></li>
         </ul>
       </li>

       <!--=======================================================================================-->
       <!--=======================================================================================-->
       <!--=======================================================================================-->

       <li class="treeview">
         <a href="#">
           <i class="fa fa-share"></i> <span>OSES</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="https://students.feutech.edu.ph/oses/"><i class="fa fa-file-text-o"></i> <span>Enrollment</span></a></li>
           <li><a href="https://www.youtube.com/watch?v=ftKh6_WZupk&feature=youtu.be" target="_blank"><i class="fa fa-file-text-o"></i> <span>Tutorial</span></a></li>
           <li><a href="https://students.feutech.edu.ph/_public/downloads/USERS%20GUIDE%20-%20OSES.pdf" target="_blank"><i class="fa fa-file-text-o"></i> <span>OSES User Guide</span></a></li>
         </ul>
       </li>

       <!--=======================================================================================-->
       <!--=======================================================================================-->
       <!--=======================================================================================-->

     </ul>
     <!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
 </aside>