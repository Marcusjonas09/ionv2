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

            <form action="<?= base_url() ?>SuperAdmin/create_class" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Create class</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="laboratory_code">Course Code:</label>
                                <select class="form-control js-example-basic-single" name="class_code" id="class_course_code">
                                    <option value="">--</option>
                                    <?php foreach ($courses as $course) : ?>
                                        <option value="<?= $course->course_code ?>"><?= $course->course_code . ' - ' . $course->course_title ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="laboratory_code">Section:</label>
                                <select class="form-control js-example-basic-single" name="section_code" id="class_section_code">
                                    <option value="">--</option>
                                    <?php foreach ($sections as $section) : ?>
                                        <option value="<?= $section->section_code ?>"><?= $section->section_code ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="laboratory_code">Faculty:</label>
                                <select class="form-control js-example-basic-single" name="faculty_id" id="class_faculty_id">
                                    <option value="">--</option>
                                    <?php foreach ($faculties as $faculty) : ?>
                                        <option value="<?= $faculty->acc_number ?>"><?= $faculty->acc_lname . ', ' . $faculty->acc_fname . ' ' . $faculty->acc_mname ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="class_capacity">Max Slots:</label>
                                <input type="number" name="class_capacity" id="class_capacity" placeholder="Slot" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" value="Create" />
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->