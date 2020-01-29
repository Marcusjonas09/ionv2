<?php
if (!$this->session->login) {
    session_destroy();
    redirect('UserAuth');
}
if ($this->session->access == 'admin') {
    redirect('Admin');
} else if ($this->session->access == 'student') {
} else if ($this->session->access == 'superadmin') {
    redirect('SuperAdmin');
} else {
    redirect('UserAuth');
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
    <!-- jQuery 3 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="<?= base_url() ?>dist/js/timestamp-tag.js"></script> -->
    <link rel="stylesheet" href="<?= base_url() ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url() ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/AdminLTE.min.css">
    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

    <!-- fullCalendar -->
    <link rel="stylesheet" href="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

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

<body>
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"><i class="fa fa-warning text-yellow"></i> SITE MAINTENANCE</h2>
            <div>
                <h3> We are currently fixing some glitches.</h3>
                <p>
                    Meanwhile, you may <a href="<?= base_url() ?>">return to dashboard</a>
                </p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->

</body>
<script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>dist/js/demo.js"></script>

</html>