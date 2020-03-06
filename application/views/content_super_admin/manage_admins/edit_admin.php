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
        <?php if (isset($message)) : ?>
            <?php echo $message; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Administrator Account</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <form action="<?= base_url() ?>SuperAdmin/edit_admin_function" method="post">
                                <div class="box-body">
                                    <div class="form-group col-md-4">
                                        <label for="faculty">Faculty</label>
                                        <select disabled class="form-control js-example-basic-single" name="faculty" id="faculty">
                                            <option value="">--</option>
                                            <?php foreach ($faculties as $faculty) : ?>
                                                <option <?php if ($faculty->acc_number == $acc_details->acc_number) {
                                                            echo "selected";
                                                        } ?> value="<?= $faculty->acc_number ?>"><?= $faculty->acc_lname . ', ' . $faculty->acc_fname . ' ' . $faculty->acc_mname ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="acc_id" value="<?= $acc_details->acc_id ?>">
                                    </div>

                                    <div class="form-group col-md-8">
                                        <div class="row">
                                            <label class="col-md-12">Modules</label><br>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesCollege) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesCollege" name="UsesCollege"> College/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesDepartment) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesDepartment" name="UsesDepartment"> Department/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesProgram) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesProgram" name="UsesProgram"> Program/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesSpec) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesSpec" name="UsesSpec"> Specialization/s
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesCourse) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesCourse" name="UsesCourse"> Course/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesLab) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesLab" name="UsesLab"> Laboratory
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesSection) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesSection" name="UsesSection"> Section
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesCurriculum) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesCurriculum" name="UsesCurriculum"> Curriculum
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesParallel) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesParallel" name="UsesParallel"> Parallel Course/s
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesFaculty) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesFaculty" name="UsesFaculty"> Faculty
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesStudent) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesStudent" name="UsesStudent"> Student
                                                </label>
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesClass) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesClass" name="UsesClass"> Class Schedule/s
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="checkbox-inline col-md-12" style="margin:0px;">
                                                    <input <?php if ($acc_details->UsesFinance) {
                                                                echo "checked";
                                                            } ?> value="1" type="checkbox" id="UsesFinance" name="UsesFinance"> Finance/s
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