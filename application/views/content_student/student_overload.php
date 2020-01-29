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
            <strong>Overload Request</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <h4><strong>School Year: <?= $this->session->curr_year ?> Term: <?= $this->session->curr_term ?></strong>&nbsp&nbsp
                                <?php if ($overload) {
                                    if ($overload->ou_status == 1) {
                                        echo "<span class='label label-success'>Approved</span>";
                                    } else if ($overload->ou_status == 2) {
                                        echo "<span class='label label-warning'>Pending</span>";
                                    } else {
                                        echo "<span class='label label-danger'>Declined</span>";
                                    }
                                } ?>
                            </h4>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive">
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
                                                                        } else { } ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Required Units:</strong> 12
                                    </td>
                                    <td>
                                        <?php if ($overload) : ?>
                                            <?php if ($overload->ou_date_posted) : ?>
                                                <strong>Date posted:</strong> <?= date("F j, Y, g:i a", $overload->ou_date_posted) ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php $totalunits = 0;
                                        foreach ($cor as $record) : ?>
                                            <?php if (strtoupper($record->cc_course) == strtoupper($record->course_code)) {
                                                    $totalunits += $record->course_units;
                                                } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                                    $totalunits += $record->laboratory_units;
                                                } else {
                                                    echo '';
                                                } ?>
                                        <?php endforeach; ?>
                                        <strong>Enrolled Units:</strong> <?= $totalunits ?>
                                    </td>
                                    <td>
                                        <?php if ($overload) : ?>
                                            <?php if ($overload->ou_date_processed) : ?>
                                                <strong>Date Processed:</strong> <?= date("F j, Y, g:i a", $overload->ou_date_processed) ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <?php if ($cor) : ?>

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
                            <?php foreach ($cor as $record) : ?>
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
                                                } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                                    echo strtoupper($record->laboratory_units);
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
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <div class="container-fluid">
                    <a href="<?= base_url() ?>/Student/submit_overload" class="btn btn-success pull-right col-md-1 <?php if ($overload) {
                                                                                                                        if ($overload->ou_stud_number == $this->session->acc_number) echo "disabled";
                                                                                                                    } ?>">Submit</a>
                    <a href="<?= base_url() ?>/Student" class="btn btn-default pull-right col-md-1 <?php if ($overload) {
                                                                                                        if ($overload->ou_stud_number == $this->session->acc_number) echo "disabled";
                                                                                                    } ?>" style="margin-right:10px;">Cancel</a>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->