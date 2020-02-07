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
        <?php if (isset($success_msg)) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i>Success!</h4>
                <?php echo $success_msg; ?>
            </div>
        <?php endif; ?>
        <div class="container-fluid col-md-8" style="padding-left:0px; padding-right:0px;">
            <form action="<?= base_url() ?>SuperAdmin/edit_course_function" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Create class</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="laboratory_code">Course Code:</label>
                                <select class="form-control js-example-basic-single" name="course_code" id="class_course_code">
                                    <option value="">--</option>
                                    <?php foreach ($courses as $course) : ?>
                                        <option value="<?= $course->course_code ?>"><?= $course->course_code . ' - ' . $course->course_title ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="laboratory_code">Section:</label>
                                <select class="form-control js-example-basic-single" name="section_code" id="class_section_code">
                                    <option value="">--</option>
                                    <?php foreach ($sections as $section) : ?>
                                        <option value="<?= $section->section_code ?>"><?= $section->section_code ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="laboratory_code">Faculty:</label>
                                <select class="form-control js-example-basic-single" name="faculty_id" id="class_faculty_id">
                                    <option value="">--</option>
                                    <option value="1">Roman, De Angel</option>
                                    <option value="2">Tejuco, Hadji Javier</option>
                                    <option value="3">Mansul, Danna May</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" value="Apply" />
                    </div>
                </div>
            </form>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Class Schedules</strong></h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped text-center" data-page-length='10'>
                        <thead class="bg-success" style="background-color:#00a65a; color:white;">
                            <th class="text-center col-md-3">DAY</th>
                            <th class="text-center col-md-6">TIME</th>
                            <th class="text-center col-md-3">ACTION</th>
                        </thead>
                        <tbody id="class_sched_table_body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid col-md-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Add class schedule</strong></h3>
                </div>

                <div class="box-body">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="laboratory_code">Day:</label>
                            <select class="form-control" name="class_day" id="class_sched_day">
                                <option value="">--</option>
                                <option value="M">Monday</option>
                                <option value="T">Tuesday</option>
                                <option value="W">Thursday</option>
                                <option value="TH">Thursday</option>
                                <option value="F">Friday</option>
                                <option value="S">Saturday</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Room:</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="" id="class_room">
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Start Time:</label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" name="" id="class_start_time">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>End Time:</label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker" id="class_end_time">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="box-footer">
                    <div class="form-group pull-right">
                        <button id="save_sched" class="btn btn-success">Save Schedule</button>
                    </div>
                    <div class="form-group pull-right">
                        <button id="add_class_sched" style="margin-right:10px;" class="btn btn-primary">Add Schedule</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->