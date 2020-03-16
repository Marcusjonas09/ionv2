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
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Create class</strong></h3>
                </div>
                <div class="box-body">
                    <div class="form-group col-md-6">
                        <label for="laboratory_code">Course Code:</label>
                        <select disabled class="form-control js-example-basic-single" name="class_code" id="class_course_code">
                            <option value="">--</option>
                            <?php foreach ($courses as $course) : ?>
                                <option <?php if ($course->course_code == $class->class_code) {
                                            echo "selected";
                                        } ?> value="<?= $course->course_code ?>"><?= $course->course_code . ' - ' . $course->course_title ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="lab_code">Lab Code:</label>
                        <input disabled class="form-control lab_code" type="text">
                        <input type="hidden" class="lab_code" name="laboratory_code">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="laboratory_code">Lecture Instructor:</label>
                        <select disabled class="form-control js-example-basic-single" name="lec_instructor" id="lec_instructor">
                            <option value="">--</option>
                            <?php foreach ($faculties as $faculty) : ?>
                                <option <?php if ($faculty->acc_number == $class->class_faculty) {
                                            echo "selected";
                                        } ?> value="<?= $faculty->acc_number ?>"><?= $faculty->acc_lname . ' - ' . $faculty->acc_fname . ' ' . $faculty->acc_mname ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="laboratory_code">Laboratory Instructor:</label>
                        <select disabled class="form-control js-example-basic-single" name="lab_instructor" id="lab_instructor">
                            <option value="">--</option>
                            <?php foreach ($faculties as $faculty) : ?>
                                <option <?php if ($faculty->acc_number == $class->class_lab_faculty) {
                                            echo "selected";
                                        } ?> value="<?= $faculty->acc_number ?>"><?= $faculty->acc_lname . ' - ' . $faculty->acc_fname . ' ' . $faculty->acc_mname ?></option>
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
                        <label for="class_capacity">Max Slots:</label>
                        <input disabled type="number" name="class_capacity" id="class_capacity" placeholder="Slot" class="form-control" value="<?= $class->class_capacity ?>">
                    </div>
                </div>
            </div>
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Class Schedules</strong></h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped text-center" data-page-length='10'>
                        <thead class="bg-success" style="background-color:#00a65a; color:white;">
                            <th class="text-center col-md-2">DAY</th>
                            <th class="text-center col-md-3">TIME</th>
                            <th class="text-center col-md-2">ROOM</th>
                            <th class="text-center col-md-2">TYPE</th>
                        </thead>
                        <tbody id="class_sched_table_body">
                            <?php foreach ($class_scheds as $class_sched) : ?>
                                <tr>
                                    <td><?= $class_sched->class_day ?></td>
                                    <!-- <td><?= $class_sched->class_start_time . ' - ' . $class_sched->class_end_time ?></td> -->

                                    <td><?= date('h:i A', strtotime($class_sched->class_start_time)) . ' - ' . date('h:i A', strtotime($class_sched->class_end_time)) ?></td>
                                    <td><?= $class_sched->class_room ?></td>
                                    <td><?= $class_sched->class_type ?></td>
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