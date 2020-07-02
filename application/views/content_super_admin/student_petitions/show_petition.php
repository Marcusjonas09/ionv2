<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a class="navi" href="<?= base_url() ?>SuperAdmin/course_petitions"><span class="fa fa-chevron-left"></span></a>&nbsp&nbsp<strong>Petition Form</strong>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>SuperAdmin/course_petitions"><i class="fa fa-dashboard"></i>Course Petitions</a></li>
            <li class="active">Petition</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <?php if (validation_errors()) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Warning!</h4>
                        <?= validation_errors() ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['petition_message'])) : ?>
            <div class="row">
                <div class="col-md-12">
                    <?= $_SESSION['petition_message'] ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-8">
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Course Code: </label>
                                    <input id="petition_code" readonly type="text" class="form-control" value="<?= $petition->course_code ?>">
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
                                    <select class="form-control" name="petition_section" id="petition_section">
                                        <?php foreach ($sections as $section) : ?>
                                            <option value="<?= $section->section_code ?>"><?= $section->section_code ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                        <!-- <a href="<?= base_url() ?>SuperAdmin/approve_petition/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-success btn-sm rounded pull-right col-md-3 <?php if ($petition->petition_status != 2) {
                                                                                                                                                                                                                    echo "disabled";
                                                                                                                                                                                                                } ?>"><span class="fa fa-check"></span>&nbsp Approve</a>
                        <a href="<?= base_url() ?>SuperAdmin/decline_petition/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-danger btn-sm rounded pull-right col-md-3 <?php if ($petition->petition_status != 2) {
                                                                                                                                                                                                            echo "disabled";
                                                                                                                                                                                                        } ?>" style="margin-right:10px;"><span class="fa fa-ban"></span>&nbsp Decline</a> -->
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Class Schedules</strong></h3>
                        <button class="btn btn-success pull-right col-md-2" data-toggle="modal" data-target="#addSchedModal">Add Schedule</button>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped text-center" data-page-length='10'>
                            <thead class="bg-success" style="background-color:#00a65a; color:white;">
                                <th class="text-center col-md-2">DAY</th>
                                <th class="text-center col-md-3">TIME</th>
                                <th class="text-center col-md-2">ROOM</th>
                                <th class="text-center col-md-2">TYPE</th>
                                <th class="text-center col-md-3">ACTION</th>
                            </thead>
                            <tbody id="class_sched_table_body">
                                <?php foreach ($class_scheds as $class_sched) : ?>
                                    <tr>
                                        <td><?= $class_sched->class_day ?></td>
                                        <td><?= date('h:i A', strtotime($class_sched->class_start_time)) . ' - ' . date('h:i A', strtotime($class_sched->class_end_time)) ?></td>
                                        <td><?= $class_sched->class_room ?></td>
                                        <td><?= $class_sched->class_type ?></td>
                                        <td><button class="btn btn-danger" onclick="delete_petition_sched('<?= $class_sched->petition_ID ?>','<?= $class_sched->cs_id ?>','<?= $this->uri->segment(4) ?>')"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal -->
<div class="modal fade" id="addSchedModal" tabindex="-1" role="dialog" aria-labelledby="addSchedLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addSchedLabel">Add Schedule</h4>
            </div>
            <form action="<?= base_url() ?>SuperAdmin/add_petition_sched" method="post">
                <div class="modal-body">
                    <div class="form-group col-md-4">
                        <label for="laboratory_code">Day:</label>
                        <select class="form-control" name="class_day" id="class_sched_day">
                            <option value="M" <?= set_select('class_day', 'M', TRUE) ?>>Monday</option>
                            <option value="T" <?= set_select('class_day', 'T') ?>>Tuesday</option>
                            <option value="W" <?= set_select('class_day', 'W') ?>>Wednesday</option>
                            <option value="TH" <?= set_select('class_day', 'TH') ?>>Thursday</option>
                            <option value="F" <?= set_select('class_day', 'F') ?>>Friday</option>
                            <option value="S" <?= set_select('class_day', 'S') ?>>Saturday</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Room:</label>
                        <div class="form-group">
                            <input value="<?= set_value('class_room') ?>" class="form-control" type="text" name="class_room" id="class_room">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Type:</label>
                        <div class="form-group">
                            <select class="form-control" name="class_type" id="class_type">
                                <option <?= set_select('class_type', 'Lecture', TRUE) ?> value="Lecture">Lecture</option>
                                <option <?= set_select('class_type', 'Laboratory') ?> value="Laboratory">Laboratory</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Start Time:</label>
                        <div class="input-group">
                            <input type="text" value="<?= set_value('class_start_time') ?>" class="form-control timepicker" name="class_start_time" id="class_start_time">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>End Time:</label>
                        <div class="input-group">
                            <input type="text" value="<?= set_value('class_end_time') ?>" class="form-control timepicker" name="class_end_time" id="class_end_time">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="class_sched" value="<?= $petition->course_code . $petition->petition_section ?>">
                    <input type="hidden" name="petition_ID" value="<?= $petition->petition_ID ?>">
                    <input type="hidden" name="petition_unique" value="<?= $petition->petition_unique ?>">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success col-md-2 pull-right">Submit</button>
                    <button type="button" class="btn btn-default col-md-2 pull-right" style="margin-right:10px;" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>