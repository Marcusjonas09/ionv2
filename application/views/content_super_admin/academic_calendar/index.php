<?php
if (!$this->session->login) {
  session_destroy();
  redirect('Admin');
}
if ($this->session->access == 'admin') {
} else if ($this->session->access == 'student') {
  redirect('Student/dashboard');
} else if ($this->session->access == 'superadmin') {
  redirect('SuperAdmin/school_parameters');
} else {
  redirect('Admin/dashboard');
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FEUTECH iON</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url() ?>bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>folder/jquery-ui.css">
  <link rel="stylesheet" href="<?= base_url() ?>folder/style.css">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.js">
  <link rel="stylesheet" href="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">


  <link rel="stylesheet" href="<?= base_url() ?>dist/css/skins/skin-green.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    a.navi:link {
      color: black;
    }

    /* visited link */
    a.navi:visited {
      color: black;
    }

    /* mouse over link */
    a.navi:hover {
      color: gray;
    }

    /* selected link */
    a.navi:active {
      color: gray;
    }
  </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-green fixed sidebar-mini">
  <div class="wrapper">



    <!---->

    <!---->


    <!-- Main Header -->
    <header class="main-header">
      <!-- Logo -->
      <a href="<?= base_url() ?>Admin" class="logo">
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
            <!-- User Account Menu -->

            <li class="dropdown messages-menu">
              <a id="notif_active" href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell"></i>
                <span id="notif_badge" class="label label-warning"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- <li class="header"></li> -->
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul id="notif_container" class="menu">
                  </ul>
                </li>
                <li class="footer">
                  <a id="total_notif_count" href="#">See all notifications</a>
                </li>
              </ul>
            </li>

            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="<?= base_url() ?>Admin/profile">

                <img src="<?= base_url() ?>dist/img/default_avatar.png" class="user-image" alt="User Image">

                <span class="hidden-xs"><?= $this->session->Firstname . ' ' . $this->session->Lastname ?></span>
              </a>

            </li>

            <li>
              <!-- Menu Toggle Button -->
              <a href="<?= base_url() ?>Admin/logout"><span class="fa fa-sign-out"></span></a>
            </li>

            <!-- Control Sidebar Toggle Button -->
            <!-- <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-calendar"></i></a>
        </li> -->
          </ul>
        </div>
      </nav>
    </header>


    <!---->

    <!---->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-calendar"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Calendar</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3>
          <ul class="control-sidebar-menu">
            <li>
              <a href="javascript:;">
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                </h4>

                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>
              </a>
            </li>
          </ul>
          <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>

            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked>
              </label>

              <p>
                Some information about this general settings option
              </p>
            </div>
            <!-- /.form-group -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

    <!---->

    <!---->



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
          <li><a href="<?= base_url() ?>Admin/student_accounts"><i class="fa fa-user"></i> <span>Student Accounts</span></a></li>
          <li><a href="<?= base_url() ?>Admin/school_announcements"><i class="fa fa-bullhorn"></i><span>School Announcements</span>
          <li><a href="<?= base_url() ?>Admin/academic_calendar"><i class="fa fa-bullhorn"></i><span>School Calendar</span></a></li>
          <li><a href="<?= base_url() ?>Admin/curricula"><i class="fa fa-file-text-o"></i><span>All Curricula</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Academics</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url() ?>Admin/parallel"><i class="fa fa-file-text-o"></i> <span>Parallel Courses</span></a></li>
              <li><a href="<?= base_url() ?>Admin/offerings"><i class="fa fa-file-text-o"></i> <span>Course Offerings</span></a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Services</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?= base_url() ?>Admin/course_petitions"><i class="fa fa-file-text-o"></i><span>Course Petitions</span></a></li>
              <li><a href="<?= base_url() ?>Admin/faculty_evaluation"><i class="fa fa-file-text-o"></i><span>Faculty Evaluation</span></a></li>
              <li><a href="<?= base_url() ?>Admin/underload"><i class="fa fa-file-text-o"></i><span>Underload Requests</span></a></li>
              <li><a href="<?= base_url() ?>Admin/overload"><i class="fa fa-file-text-o"></i><span>Overload Requests</span></a></li>
              <li><a href="<?= base_url() ?>Admin/simul"><i class="fa fa-file-text-o"></i><span>Simul Requests</span></a></li>
            </ul>
          </li>

        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>



    <!---->

    <!---->





    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <strong>School Calendar</strong>
          <small>Administrator</small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
        <!-- /.col -->
        <div class="col-md-12">
          <!-- THE CALENDAR -->
          <div class="col-md-8">
            <div class="box box-solid">
              <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->


          <div class="col-md-4">
            <div class="box box-solid">
              <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <h1>All Events</h1>
                <table class="table table-hover">
                  <tr>
                    <th>Event</th>
                    <th>Description</th>
                    <th>Start</th>
                    <th>End</th>
                  </tr>

                  <?php foreach ($events as $event) : ?>
                    <tr>
                      <td><?= $event->title ?></td>
                      <td><?= $event->description ?></td>
                      <td><?= $event->start ?></td>
                      <td><?= $event->end ?></td>
                    </tr>
                  <?php endforeach ?>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->



        </div>
        <!-- /.col -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Calendar Event</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open(site_url("Admin/add_event"), array("class" => "form-horizontal")) ?>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Event Name</label>
              <div class="col-md-8 ui-front">
                <input required type="text" class="form-control" name="name" id="name">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Description</label>
              <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="description" id="description">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Start Date</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="start_date" id="add_start_date" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">End Date</label>
              <div class="col-md-8">
                <input required type="text" class="form-control" name="end_date" id="add_end_date">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Add Event" id="add_calendar_event">
            <?php echo form_close() ?>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Update Calendar Event</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open(site_url("Admin/edit_event"), array("class" => "form-horizontal")) ?>


            <!-- <textarea id="myTextarea" rows="5" cols="60" placeholder="Type something here..."></textarea> -->

            <div class="output"></div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Event Name</label>
              <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="name" id="editname">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Description</label>
              <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="description" id="editdescription">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Start Date</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="start_date" id="start_date">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">End Date</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="end_date" id="end_date">
              </div>
            </div>
            <div class="form-group">
              <label for="p-in" class="col-md-4 label-heading">Delete Event</label>
              <div class="col-md-8">
                <input type="checkbox" name="delete" value="1">
              </div>
            </div>
            <input type="hidden" name="eventid" id="event_id" value="0" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Update Event">
            <?php echo form_close() ?>
          </div>
        </div>
      </div>
    </div>








    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        <!-- Anything you want -->
      </div>
      <!-- Default to the left -->
      <!-- <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved. -->
    </footer>




  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->
  <!-- jQuery 3 -->
  <script src="<?= base_url() ?>folder/jquery-1.12.4.js.download"></script>
  <script src="<?= base_url() ?>folder/jquery-ui.js.download"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?= base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url() ?>bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
  <!-- Pusher JS -->
  <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <!-- Full Calendar JS -->
  <script src="<?= base_url() ?>bower_components/moment/moment.js"></script>
  <script src="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {

      var date_last_clicked = null;

      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,listMonth'
        },

        eventSources: [{
          events: function(start, end, timezone, callback) {
            $.ajax({
              url: '<?php echo base_url() ?>Admin/get_events',
              dataType: 'json',
              data: {
                // our hypothetical feed requires UNIX timestamps
                start: start.unix(),
                end: end.unix()
              },
              success: function(msg) {
                var events = msg.events;
                callback(events);
              }
            });
          }
        }, ],
        dayClick: function(date, jsEvent, view) {
          date_last_clicked = $(this);
          var now = new Date();
          var selected_date = new Date(date);


          if (now.getTime() > selected_date.getTime()) {
            Swal.fire({
              icon: 'warning',
              title: 'TRY AGAIN ',
              text: 'YOU CLICKED A PAST DATE!',
            })
          } else {
            var add_selected_date = date.format('YYYY/MM/DD')
            $('#add_start_date').val(add_selected_date);

            $('#add_end_date').datepicker({
              dateFormat: "yy/mm/dd",
              autoclose: true,
              minDate: add_selected_date
            })

            $('#addModal').modal(
              $('#add_calendar_event').click(function(e) {
                var valid = this.form.checkValidity();
                if (valid) {
                  Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                  )
                } else {

                }
              })
            );

          }



        },
        eventClick: function(event, jsEvent, view) {
          var now = new Date();
          $('#editname').val(event.title);
          $('#editdescription').val(event.description);
          $('#start_date').val(moment(event.start).format('YYYY/MM/DD'));
          if (event.end) {
            $('#end_date').val(moment(event.end).format('YYYY/MM/DD'));
          } else {
            $('#end_date').val(moment(event.start).format('YYYY/MM/DD'));
          }
          $('#event_id').val(event.id);

          var dateFormat = "yy/mm/dd",
            from = $("#start_date")
            .datepicker({
              defaultDate: "+1w",
              changeMonth: true,

            })
            .on("change", function() {
              to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#end_date").datepicker({
              defaultDate: "+1w",
              changeMonth: true,
            })
            .on("change", function() {
              from.datepicker("option", "maxDate", getDate(this));
            });

          function getDate(element) {
            var date;
            try {
              date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
              date = null;
            }

            return date;
          }


          // $("#end_date").keyup(function(){
          //     // Getting the current value of textarea
          //     var currentText = $(this).val();

          //     // Setting the Div content
          //     $(".output").text(currentText);
          // });


          // $('#start_date').datepicker({
          //         dateFormat: "yy/mm/dd",
          //         autoclose: true,
          //         minDate: now
          // })
          // $('#end_date').datepicker({
          //         dateFormat: "yy/mm/dd",
          //         autoclose: true,
          //         minDate: now
          // })



          $('#editModal').modal();
        },
      });
    });
  </script>

</body>

</html>