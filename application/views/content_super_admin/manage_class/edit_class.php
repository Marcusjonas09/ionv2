<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/classes"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($message)) : ?>
            <?php echo $message; ?>
        <?php endif; ?>
        <div class="container-fluid col-md-8" style="padding-left:0px; padding-right:0px;">
            <form action="<?= base_url() ?>SuperAdmin/edit_class_function" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Class : <?= $class->class_code . ' - ' . $class->class_section ?></strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="laboratory_code">Course Code:</label>
                                <select disabled class="form-control js-example-basic-single" name="course_code" id="class_course_code">
                                    <option value="">--</option>
                                    <?php foreach ($courses as $course) : ?>
                                        <option <?php if ($course->course_code == $class->class_code) {
                                                    echo "selected";
                                                } ?> value="<?= $course->course_code ?>"><?= $course->course_code . ' - ' . $course->course_title ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="laboratory_code">Section:</label>
                                <select disabled class="form-control js-example-basic-single" name="section_code" id="class_section_code">
                                    <option value="">--</option>
                                    <?php foreach ($sections as $section) : ?>
                                        <option <?php if ($section->section_code == $class->class_section) {
                                                    echo "selected";
                                                } ?> value="<?= $section->section_code ?>"><?= $section->section_code ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="laboratory_code">Faculty:</label>
                                <select class="form-control js-example-basic-single" name="faculty_id" id="class_faculty_id">
                                    <option value="0">--</option>
                                    <?php foreach ($faculties as $faculty) : ?>
                                        <option <?php if ($faculty->acc_number == $class->class_faculty) {
                                                    echo "selected";
                                                } ?> value="<?= $faculty->acc_number ?>"><?= $faculty->acc_lname . ', ' . $faculty->acc_fname . ' ' . $faculty->acc_mname ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="class_capacity">Max Slots:</label>
                                <input type="number" value="<?= $class->class_capacity ?>" name="class_capacity" id="class_capacity" placeholder="Slot" class="form-control">
                            </div>

                            <input type="hidden" name="class_id" id="class_id" value="<?= $class->class_id ?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <!-- <input class="btn btn-success pull-right col-md-2" type="submit" value="Apply" /> -->
                        <!-- <button type="button" class="btn btn-success pull-right col-md-2" onclick="edit_class()">Apply</button> -->
                        <button type="submit" class="btn btn-success pull-right col-md-2">Apply</button>
                    </div>
                </div>
            </form>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Class Schedules</strong></h3>
                    <button class="btn btn-success pull-right col-md-2" data-toggle="modal" data-target="#addSchedModal">Add Schedule</button>
                </div>
                <div class="box-body">
                    <table class="table table-striped text-center" data-page-length='10'>
                        <thead class="bg-success" style="background-color:#00a65a; color:white;">
                            <th class="text-center col-md-3">DAY</th>
                            <th class="text-center col-md-3">TIME</th>
                            <th class="text-center col-md-3">ROOM</th>
                            <th class="text-center col-md-3">ACTION</th>
                        </thead>
                        <tbody id="class_sched_table_body">
                            <?php foreach ($class_scheds as $class_sched) : ?>
                                <tr>
                                    <td><?= $class_sched->class_day ?></td>
                                    <!-- <td><?= $class_sched->class_start_time . ' - ' . $class_sched->class_end_time ?></td> -->

                                    <td><?= date('h:i A', strtotime($class_sched->class_start_time)) . ' - ' . date('h:i A', strtotime($class_sched->class_end_time)) ?></td>
                                    <td><?= $class_sched->class_room ?></td>
                                    <td><button class="btn btn-danger" onclick="delete_sched('<?= $class->class_id ?>','<?= $class_sched->cs_id ?>')"><i class="fa fa-trash"></i></button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
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
            <form action="<?= base_url() ?>SuperAdmin/add_sched" method="post">
                <div class="modal-body">
                    <div class="form-group col-md-6">
                        <label for="laboratory_code">Day:</label>
                        <select class="form-control" name="class_day" id="class_sched_day">
                            <option value="">--</option>
                            <option value="M">Monday</option>
                            <option value="T">Tuesday</option>
                            <option value="W">Wednesday</option>
                            <option value="TH">Thursday</option>
                            <option value="F">Friday</option>
                            <option value="S">Saturday</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Room:</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="class_room" id="class_room">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Start Time:</label>
                        <div class="input-group">
                            <input type="text" class="form-control timepicker" name="class_start_time" id="class_start_time">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>End Time:</label>
                        <div class="input-group">
                            <input type="text" class="form-control timepicker" name="class_end_time" id="class_end_time">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="class_id" value="<?= $class->class_id ?>">
                    <input type="hidden" name="class_sched" value="<?= $class->class_sched ?>">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success col-md-2 pull-right">Submit</button>
                    <button type="button" class="btn btn-default col-md-2 pull-right" style="margin-right:10px;" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>