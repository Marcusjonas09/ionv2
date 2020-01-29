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
                                } ?></h4>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Required Units: 12</h4>
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
                            <h4>Enrolled Units: <?= $totalunits ?></h4>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <?php if ($overload) : ?>
                                <?php if ($overload->ou_date_posted) : ?>
                                    <h4><strong>Date posted:</strong> <?= date("F j, Y, g:i a", $overload->ou_date_posted) ?></h4>
                                <?php endif; ?>
                                <?php if ($overload->ou_date_processed) : ?>
                                    <h4><strong>Date Processed:</strong> <?= date("F j, Y, g:i a", $overload->ou_date_processed) ?></h4>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ($cor) : ?>
                    <table class="table">
                        <tr>
                            <td><strong>Student #: </strong><?= $student->acc_number ?></td>
                            <td><strong>College: </strong> <?= $student->acc_college ?></td>
                            <td><strong>Program: </strong><?= $student->acc_program ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name: </strong><?= $student->acc_lname . ', ' . $student->acc_fname . ' ' . $student->acc_mname ?></td>
                            <td><strong>Year Level: </strong></td>
                            <td></td>
                        </tr>
                    </table>
                    <table class="table">
                        <tr style="background-color:#00a65a; color:white;">
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
                    <a href="<?= base_url() ?>/Admin/approve_overload/<?= $overload->ou_id ?>/<?= $student->acc_number ?>" type="submit" class="btn btn-success pull-right col-md-1">Approve</a>
                    <a href="<?= base_url() ?>/Admin/decline_overload/<?= $overload->ou_id ?>/<?= $student->acc_number ?>" class="btn btn-danger pull-right col-md-1" style="margin-right:10px;">Decline</a>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->