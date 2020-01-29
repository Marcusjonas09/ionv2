<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Insert Course Card Details</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-success" href="<?= base_url() ?>SuperAdmin/add_student">ADD STUDENT DETAILS</a>
                <a class="btn btn-success" href="<?= base_url() ?>SuperAdmin/course_card">ADD COURSE CARD DETAILS</a>
                <a class="btn btn-success" href="<?= base_url() ?>SuperAdmin/balance">ADD BALANCE DETAILS</a>
                <a class="btn btn-success" href="<?= base_url() ?>SuperAdmin/payment">ADD PAYMENT DETAILS</a>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Course Card Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url() ?>SuperAdmin/submit_course_card" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">STUD NUMBER</label>

                                <div class="col-sm-9">
                                    <input name="cc_stud_number" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">COURSE_CODE</label>

                                <div class="col-sm-9">
                                    <input name="cc_course" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SECTION</label>

                                <div class="col-sm-9">
                                    <input name="cc_section" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">MIDTERM GRADE</label>

                                <div class="col-sm-9">
                                    <input name="cc_midterm" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">FINAL GRADE</label>

                                <div class="col-sm-9">
                                    <input name="cc_final" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SCHOOL YEAR</label>

                                <div class="col-sm-9">
                                    <input name="cc_year" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">SCHOOL TERM</label>

                                <div class="col-sm-9">
                                    <input name="cc_term" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">STATUS</label>

                                <div class="col-sm-9">
                                    <select name="cc_status" class="form-control js-example-basic-single">
                                        <option value="finished">FINISHED</option>
                                        <option value="unfinished">UNFINISHED</option>
                                        <option value="credited">CREDITED</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right">SAVE</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-4">
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        <?php echo validation_errors(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->