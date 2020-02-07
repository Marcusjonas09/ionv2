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
        <div class="container-fluid col-md-9" style="padding-left:0px; padding-right:0px;">
            <form action="<?= base_url() ?>SuperAdmin/create_section" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Create class</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label>Course:</label>
                            <select class="form-control js-example-basic-single" name="class_code" id="class_code">
                                <option value="">none</option>
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= $course->course_code ?>"><?= $course->course_code . ' - ' . $course->course_title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Section:</label>
                            <select class="form-control js-example-basic-single" name="class_code" id="class_code">
                                <option value="">none</option>
                                <?php foreach ($sections as $section) : ?>
                                    <option value="<?= $section->section_code ?>"><?= $course->course_code ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Faculty:</label>
                            <select class="form-control js-example-basic-single" name="class_code" id="class_code">
                                <option value="">none</option>
                                <?php foreach ($faculty as $faculty) : ?>
                                    <option value="<?= $faculty->acc_id ?>"><?= $faculty->acc_lname . ', ' . $faculty->acc_fname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Day:</label>
                            <select class="form-control js-example-basic-single" name="class_code" id="class_code">
                                <option value="">none</option>
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= $course->course_code ?>"><?= $course->course_code . ' - ' . $course->course_title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Start Time:</label>
                            <div class="input-group">
                                <input type="text" class="form-control timepicker">

                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>End Time:</label>
                            <select class="form-control js-example-basic-single" name="class_code" id="class_code">
                                <option value="">none</option>
                                <?php foreach ($faculty as $faculty) : ?>
                                    <option value="<?= $faculty->acc_id ?>"><?= $faculty->acc_lname . ', ' . $faculty->acc_fname ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" value="Submit" />
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid col-md-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Insert Multiple Entry</strong></h3>
                </div>
                <form action="<?= base_url() ?>SuperAdmin/add_section_csv" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Upload CSV file</label>
                            <input class="form-control btn btn-default" type="file" name="csv_file" />
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" name="import" value="Import" />
                    </div>
                </form>
            </div>
        </div>




    </section>
</div>
<!-- /.content-wrapper -->