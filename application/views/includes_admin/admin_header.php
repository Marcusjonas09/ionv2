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
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?= base_url() ?>bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="<?= base_url() ?>bower_components/Ionicons/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?= base_url() ?>dist/css/AdminLTE.min.css">
      <!-- CSS -->
      <!-- Bootstrap time Picker -->
      <link rel="stylesheet" href="<?= base_url() ?>plugins/timepicker/bootstrap-timepicker.min.css">
      <!-- fullCalendar -->
      <link rel="stylesheet" href="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
      <link rel="stylesheet" href="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.js">
      <link rel="stylesheet" href="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
      <!-- daterange picker -->
      <link rel="stylesheet" href="<?= base_url() ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
      <!-- bootstrap datepicker -->
      <link rel="stylesheet" href="<?= base_url() ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
      <!-- data tables -->
      <link rel="stylesheet" href="<?= base_url() ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
      <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
      <link rel="stylesheet" href="<?= base_url() ?>dist/css/skins/skin-green.min.css">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

      <link rel="stylesheet" href="<?= base_url() ?>folder/jquery-ui.css">
	<link rel="stylesheet" href="<?= base_url() ?>folder/style.css">
	<script src="<?= base_url() ?>folder/jquery-1.12.4.js.download"></script>
      <script src="<?= base_url() ?>folder/jquery-ui.js.download"></script>
      
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