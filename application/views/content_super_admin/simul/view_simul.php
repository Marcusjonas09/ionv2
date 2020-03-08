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
            <strong>Request for Simultaneous</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Requirements</strong></h3>
                    </div>
                    /.box-header
                    <div class="box-body">
                        <ul>
                            <li>Graduating Student</li>
                            <li>Letter of Intent</li>
                            <li>Photocopy/Scanned copy of COR</li>
                            <li>Letter from the company (for Intern Students)</li>
                            <li>Scholastic Record</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Simul Form</strong>
                    <?php if ($status->IsApproved  == 1) {
                        echo "<span class='label label-success'>Approved</span>";
                    } elseif ($status->IsApproved  == 2) {
                        echo "<span class='label label-warning'>Pending</span>";
                    } else {
                        echo "<span class='label label-danger'>Denied</span>";
                    } ?></h3>
                <!-- <button type="submit" class="btn btn-success pull-right col-md-1">Approve</button>
                <a href="<?= base_url() ?>Student" class="btn btn-danger pull-right col-md-1" style="margin-right:10px;">Decline</a> -->
                <a href="<?= base_url() ?>/SuperAdmin/approve_simul/<?= $pdf->simul_id ?>/<?= $pdf->StudentNumber ?>" type="submit" class="btn btn-success pull-right col-md-1">Approve</a>
                <a href="<?= base_url() ?>/SuperAdmin/decline_simul/<?= $pdf->simul_id ?>/<?= $pdf->StudentNumber ?>" class="btn btn-danger pull-right col-md-1" style="margin-right:10px;">Decline</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if ($cor) : ?>
                    <table class="table">
                        <tr>
                            <td><strong>Student #: </strong><?= $details->acc_number ?></td>
                            <td><strong>College: </strong> <?= $details->acc_college ?></td>
                            <td><strong>Program: </strong><?= $details->acc_program ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name: </strong><?= $details->acc_lname . ', ' . $details->acc_fname . ' ' . $details->acc_mname ?></td>
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
                    <table class="table">
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

                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Total:</strong></td>
                                <td class="text-center">
                                    <strong><?= $total ?></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
                </form>
            </div>
            <!-- /.box-body -->
        </div>


        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Uploaded Requirements</strong></h3>
            </div>
            <!-- /.box-header -->
            <form action="<?= base_url() ?>Student/submit_simul" method="post" enctype="multipart/form-data">
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#LOI" data-toggle="tab">Letter Of Intent</a></li>
                                    <li><a href="#SR" data-toggle="tab">Scholastic Records</a></li>
                                    <li><a href="#LFTC" data-toggle="tab">Letter from the Company</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="LOI">
                                        <iframe width="100%" height="500px" src="<?= base_url() ?>simul_requirements/<?= $pdf->LetterOfIntent ?>" frameborder="0"></iframe>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="SR">
                                        <iframe width="100%" height="500px" src="<?= base_url() ?>simul_requirements/<?= $pdf->ScholasticRecords ?>" frameborder="0"></iframe>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="LFTC">
                                        <iframe width="100%" height="500px" src="<?= base_url() ?>simul_requirements/<?= $pdf->LetterFromCompany ?>" frameborder="0"></iframe>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->