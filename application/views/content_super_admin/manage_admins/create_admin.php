<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/admin"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create Administrator Account</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <form action="<?= base_url() ?>SuperAdmin/create_admin_function" method="post">
                                <div class="box-body">
                                    <div class="form-group col-md-4">
                                        <label for="faculty">Faculty</label>
                                        <select class="form-control js-example-basic-single" name="faculty" id="faculty">
                                            <option value="">--</option>
                                            <?php foreach ($faculties as $faculty) : ?>
                                                <option value="<?= $faculty->acc_number ?>"><?= $faculty->acc_lname . ', ' . $faculty->acc_fname . ' ' . $faculty->acc_mname ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <div class="row">
                                            <label class="col-md-12" for="faculty">Modules</label><br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesCollege', '1'); ?> type="checkbox" id="UsesCollege" name="UsesCollege" value="1"> College/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesDepartment', '1'); ?> type="checkbox" id="UsesDepartment" name="UsesDepartment" value="1"> Department/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesProgram', '1'); ?> type="checkbox" id="UsesProgram" name="UsesProgram" value="1"> Program/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesSpec', '1'); ?> type="checkbox" id="UsesSpec" name="UsesSpec" value="1"> Specialization/s
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesCourse', '1'); ?> type="checkbox" id="UsesCourse" name="UsesCourse" value="1"> Course/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesLab', '1'); ?> type="checkbox" id="UsesLab" name="UsesLab" value="1"> Laboratory
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesSection', '1'); ?> type="checkbox" id="UsesSection" name="UsesSection" value="1"> Section
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesCurriculum', '1'); ?> type="checkbox" id="UsesCurriculum" name="UsesCurriculum" value="1"> Curriculum
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesParallel', '1'); ?> type="checkbox" id="UsesParallel" name="UsesParallel" value="1"> Parallel Course/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesFaculty', '1'); ?> type="checkbox" id="UsesFaculty" name="UsesFaculty" value="1"> Faculty
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesStudent', '1'); ?> type="checkbox" id="UsesStudent" name="UsesStudent" value="1"> Student
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesClass', '1'); ?> type="checkbox" id="UsesClass" name="UsesClass" value="1"> Class Schedule/s
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php echo set_checkbox('UsesFinance', '1'); ?> type="checkbox" id="UsesFinance" name="UsesFinance" value="1"> Finance/s
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                        </div>


                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->