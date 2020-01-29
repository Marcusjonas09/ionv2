<?php
$totalunits = 0.0;
$totalunitspassed = 0.0;
$course_units = 0.0;
$lab_units = 0.0;
$coursepassed = 0.0;
$labpassed = 0.0;
?>

<?php foreach ($curr as $unit) {
    $course_units += $unit->course_units;
    $lab_units += $unit->laboratory_units;
    foreach ($grades as $grade) {
        if ($unit->course_code == $grade->cc_course && ($grade->cc_status == "finished" || $grade->cc_status == "credited") && $grade->cc_final >= 1.0) {
            $coursepassed += $unit->course_units;
        }
        if (strtoupper($unit->laboratory_code) == strtoupper($grade->cc_course) && ($grade->cc_final > 1.0 && $grade->cc_final <= 4.0)) {
            $labpassed += $unit->laboratory_units;
        }
    }
}
$totalunits = $course_units + $lab_units;
$totalunitspassed = $coursepassed + $labpassed;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Student Profile</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <?php if (isset($error)) : ?>
                    <p><?php echo $error; ?></p>
                <?php endif; ?>
                <p><?php echo validation_errors(); ?></p>
                <p><?php echo "Click on this box to dismiss."; ?></p>
            </div>
        <?php endif; ?>
        <?php if (isset($success)) : ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <p><?php echo $success; ?></p>
                <p><?php echo "Click on this box to dismiss."; ?></p>
            </div>
        <?php endif; ?>

        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-success">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?= base_url() ?>dist/img/default_avatar.png" style="width:200px; height:200px;" alt="User profile picture">
                    <br />
                    <h3 class="profile-username text-center"><strong><?= $account->acc_fname . ' ' . $account->acc_mname . ' ' . $account->acc_lname ?></strong></h3>

                    <p class="text-muted text-center"><?= $account->acc_program ?></p>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#COR" data-toggle="tab"><strong>Certificate of Registration</strong></a></li>
                    <li><a href="#Academics" data-toggle="tab"><strong>Curriculum</strong></a></li>
                    <li><a href="#settings" data-toggle="tab"><strong>Account Settings</strong></a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="COR">
                        <div class="container-fluid">
                            <?php if ($cor) : ?>
                                <table class="table">
                                    <tr>
                                        <td><strong>Student #: </strong><?= $this->session->acc_number ?></td>
                                        <td><strong>College: </strong> <?= $this->session->College ?></td>
                                        <td><strong>Program: </strong><?= $this->session->Program ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name: </strong><?= $this->session->Lastname . ', ' . $this->session->Firstname . ' ' . $this->session->Middlename ?></td>
                                        <td><strong>Year Level: </strong><?php if ($totalunitspassed >= 3 && $totalunitspassed <= 56) {
                                                                                echo "1";
                                                                            } else if ($totalunitspassed >= 57 && $totalunitspassed <= 116) {
                                                                                echo "2";
                                                                            } else if ($totalunitspassed >= 117 && $totalunitspassed <= 173) {
                                                                                echo "3";
                                                                            } else if ($totalunitspassed >= 174 && $totalunitspassed <= ($totalunits - 18)) {
                                                                                echo "4";
                                                                            } else if (($totalunits - $totalunitspassed) <= 18) {
                                                                                echo "GRADUATING";
                                                                            } else {
                                                                            } ?></td>
                                    </tr>
                                </table>
                                <table class="table table-striped table-bordered    ">
                                    <tr class="bg-success" style="background-color:#00a65a; color:white;">
                                        <th class="text-center col-md-1">COURSES</th>
                                        <th class="text-center col-md-4">TITLE</th>
                                        <th class="text-center col-md-1">SECTION</th>
                                        <th class="text-center col-md-1">UNITS</th>
                                        <th class="text-center col-md-1">DAYS</th>
                                        <th class="text-center col-md-3">TIME</th>
                                        <th class="text-center col-md-1">ROOM</th>
                                    </tr>
                                    <tbody>
                                        <?php $total = 0;
                                        foreach ($cor as $record) : ?>
                                            <?php if ($record->cc_status != "credited") : ?>
                                                <tr>
                                                    <td><?= strtoupper($record->cc_course) ?></td>
                                                    <td>
                                                        <?php if (strtoupper($record->cc_course) == strtoupper($record->course_code)) {
                                                            echo strtoupper($record->course_title);
                                                        } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                                            echo strtoupper($record->laboratory_title);
                                                        } else {
                                                            echo '';
                                                        } ?>
                                                    </td>
                                                    <td><?= strtoupper($record->cc_section) ?></td>
                                                    <td class="text-center">
                                                        <?php if (strtoupper($record->cc_course) == strtoupper($record->course_code)) {
                                                            echo strtoupper($record->course_units);
                                                            $total += $record->course_units;
                                                        } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                                            echo strtoupper($record->laboratory_units);
                                                            $total += $record->laboratory_units;
                                                        } else {
                                                            echo '';
                                                        } ?>
                                                    </td>
                                                    <?php foreach ($offerings as $offering) : ?>
                                                        <?php if ($record->cc_course == $offering->offering_course_code && $record->cc_section == $offering->offering_course_section) : ?>
                                                            <td><?= $offering->offering_course_day ?></td>
                                                            <td><?= $offering->offering_course_time ?></td>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <td></td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td><strong>Total:</strong></td>
                                            <td class="text-center">
                                                <strong><?= $total ?></strong>
                                            </td>
                                            <td colspan="3"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="tab-pane" id="Academics">
                        <div class="container-fluid">
                            <!-- <h3><strong>Remaining Courses</strong></h3>
                            <table class="table table-bordered table-responsive">
                                <thead class=" bg-success" style="background-color:#00a65a; color:white;">
                                    <th class="text-center">COURSE</th>
                                    <th class="text-center">COURSE TITLE</th>
                                    <th class="text-center">UNITS</th>
                                    <th class="text-center">LABORATORY</th>
                                    <th class="text-center">UNITS</th>
                                    <th class="text-center">PREREQUISITE</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table> -->
                            <table class="table table-bordered table-responsive">
                                <thead class=" bg-success" style="background-color:#00a65a; color:white;">
                                    <th class="text-center">COURSE</th>
                                    <th class="text-center">COURSE TITLE</th>
                                    <th class="text-center">UNITS</th>
                                    <th class="text-center">LABORATORY</th>
                                    <th class="text-center">UNITS</th>
                                    <th class="text-center">PREREQUISITE</th>
                                </thead>

                                <?php for ($y = 1; $y < 5; $y++) : ?>
                                    <tr>
                                        <th class="text-center" style="background-color:#00a65a; color:white;" colspan="7"><?= 'YEAR: ' . $y ?></th>
                                    </tr>
                                    <?php for ($t = 1; $t < 4; $t++) : ?>
                                        <tr>
                                            <th style="background-color:#ccc;" colspan="7"><?= 'Term: ' . $t ?></th>
                                        </tr>

                                        <?php foreach ($curr as $cur) : ?>
                                            <?php if ($cur->Year == $y && $cur->Term == $t) : ?>
                                                <tr class="<?php foreach ($grades as $grade) {
                                                                if ($grade->cc_course == $cur->course_code) {
                                                                    echo "bg-success";
                                                                    break;
                                                                }
                                                            } ?>">
                                                    <td><?= $cur->course_code ?></td>
                                                    <td><?= $cur->course_title ?></td>
                                                    <td class="text-center"><?= $cur->course_units ?></td>
                                                    <td><?= $cur->laboratory_code ?></td>
                                                    <td class="text-center"><?= $cur->laboratory_units ?></td>
                                                    <td><?= $cur->pr_requisite ?></td>
                                                </tr>
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    <?php endfor; ?>
                                <?php endfor; ?>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="settings">
                        <div class="container-fluid">

                            <form action="<?= base_url() ?>Student/changepass" method="post">
                                <h3><strong>Change Password</strong></h3>
                                <div class="form-group col-md-4">
                                    <label>Old password</label>
                                    <input type="password" class="form-control" name="oldpassword" placeholder="Enter old password">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>New password</label>
                                    <input type="password" class="form-control" name="newpassword" placeholder="Enter new password">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Retype new password</label>
                                    <input type="password" class="form-control" name="renewpassword" placeholder="Retype new password">
                                </div>
                                <button id="change_pass" class="btn btn-success pull-right col-md-2">Save</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->