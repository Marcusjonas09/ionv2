<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a class="navi" href="<?= base_url() ?>Admin/course_petitions"><span class="fa fa-chevron-left"></span></a>&nbsp&nbsp<strong>Petition Form</strong>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>Admin/course_petitions"><i class="fa fa-dashboard"></i>Course Petitions</a></li>
            <li class="active">Petition</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header">
                    <h4><strong id='petition_status_badge'>Petition Status:
                            <?php if ($petition->petition_status == 1) {
                                echo "<span class='label label-success'>Approved</span>";
                            } elseif ($petition->petition_status == 2) {
                                echo "<span class='label label-warning'>Pending</span>";
                            } else {
                                echo "<span class='label label-danger'>Denied</span>";
                            } ?></strong></h4>
                </div>
                <div class="box-body">
                    <div class="container-fluid col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Course Code: </label>
                                    <input id="offering_course_code" readonly type="text" class="form-control" value="<?= $petition->course_code ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date submitted: </label>
                                    <input type="text" class="form-control" readonly value="<?= date("F j, Y, g:i a", $petition->date_submitted) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Section</label>
                                    <input id="offering_course_section" readonly type="text" class="form-control" placeholder="Course section">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date processed: </label>
                                    <input type="text" class="form-control" readonly value="<?php if ($petition->date_processed) {
                                                                                                echo date("F j, Y, g:i a", $petition->date_processed);
                                                                                            } else {
                                                                                                echo "Pending";
                                                                                            } ?>">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Course Description</label>
                                    <?php foreach ($courses as $course) : ?>
                                        <?php if ($petition->course_code == $course->course_code) : ?>
                                            <input readonly type="text" class="form-control" placeholder="Course description" value="<?= $course->course_title ?>">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?= $petition->petition_ID ?>" id="petition_ID">
                        <input type="hidden" value="<?= $petition->petition_unique ?>" id="petition_unique">
                        <button class="btn btn-success pull-right col-md-3" id="approve_petition">Approve</button>
                        <button class="btn btn-danger pull-right col-md-3" id="decline_petition" style="margin-right:10px;">Decline</button>
                        <!-- <a href="<?= base_url() ?>Admin/approve_petition/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-success btn-sm rounded pull-right col-md-3 <?php if ($petition->petition_status != 2) {
                                                                                                                                                                                                                echo "disabled";
                                                                                                                                                                                                            } ?>"><span class="fa fa-check"></span>&nbsp Approve</a>
                        <a href="<?= base_url() ?>Admin/decline_petition/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-danger btn-sm rounded pull-right col-md-3 <?php if ($petition->petition_status != 2) {
                                                                                                                                                                                                        echo "disabled";
                                                                                                                                                                                                    } ?>" style="margin-right:10px;"><span class="fa fa-ban"></span>&nbsp Decline</a> -->
                    </div>
                </div>
            </div>

            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><strong>Petitioners</strong></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Student Number</th>
                            <th>Student Name</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($petitioners as $petitioner) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $petitioner->stud_number ?></td>
                                    <td><?= $petitioner->acc_fname . ' ' . $petitioner->acc_lname ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-6">
            <div class="box box-success">

                <div class="box-header">
                    <h3 class="box-title"><strong>Schedule</strong></h3>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Faculty</label>
                                <input <?php if ($petition->petition_status == 1 || $petition->petition_status == 0) {
                                            echo "readonly";
                                        } ?> type="text" class="form-control" placeholder="Faculty" value="TBA">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead style="background-color:#00a65a; color:white;">
                            <th class="text-center col-md-2">Day</th>
                            <th class="col-md-7">Time</th>
                            <th class="col-md-3">Room</th>
                        </thead>
                        <tbody id="sched_table_body">
                        </tbody>
                    </table>
                    <?php if ($petition->petition_status == 2) : ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Day</label>
                                    <select id="sched_day" id="" class="form-control">
                                        <option value="M">Monday</option>
                                        <option value="T">Tuesday</option>
                                        <option value="W">Wednesday</option>
                                        <option value="TH">Thursday</option>
                                        <option value="F">Friday</option>
                                        <option value="S">Saturday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Time</label>
                                    <div class="input-group">
                                        <input id="start_time" type="text" value="" class="form-control timepicker">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Room</label>
                                    <input id="room" type="text" class="form-control" placeholder="Room" value="TBA">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Time</label>
                                    <div class="input-group">
                                        <input id="end_time" type="text" value="" class="form-control timepicker">
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group pull-right">
                                    <button id="save_sched" class="btn btn-success">Save Schedule</button>
                                </div>
                                <div class="form-group pull-right">
                                    <button id="add_sched" style="margin-right:10px;" class="btn btn-primary">Add Schedule</button>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->