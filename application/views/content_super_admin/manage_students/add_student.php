<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Insert Student Details</strong>
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
                        <h3 class="box-title">Student Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url() ?>SuperAdmin/create_student" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">STUD NUMBER</label>

                                <div class="col-sm-8">
                                    <input name="acc_number" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">FIRST NAME</label>

                                <div class="col-sm-8">
                                    <input name="acc_fname" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">MIDDLE NAME</label>

                                <div class="col-sm-8">
                                    <input name="acc_mname" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">LAST NAME</label>

                                <div class="col-sm-8">
                                    <input name="acc_lname" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">CITIZENSHIP</label>

                                <div class="col-sm-8">
                                    <input name="acc_citizenship" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">COLLEGE</label>

                                <div class="col-sm-8">
                                    <select name="acc_college" class="form-control js-example-basic-single">
                                        <option value="COMPUTER STUDIES">COMPUTER STUDIES</option>
                                        <option value="ENGINEERING">ENGINEERING</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">PROGRAM</label>

                                <div class="col-sm-8">
                                    <select name="acc_program" class="form-control js-example-basic-single">
                                        <option value="BSITWMA">BSIT-Web and Mobile Application Development</option>
                                        <option value="BSITDA">BSIT-Digital Arts</option>
                                        <option value="BSITAGD">BSIT-Animation and Game Development</option>
                                        <option value="BSITSMBA">BSIT-Service Management and/or Business Analytics</option>

                                        <!-- <option value="">BSCS-Software Engineering</option>
                                    <option value="">BSCS-Business Analytics</option>

                                    <option value="">BSEMC-Digital Arts</option>
                                    <option value="">BSEMC-Animation and Game Development</option>

                                    <option value="">BSCE-StructuralE</option>
                                    <option value="">BSCE-WRE</option>

                                    <option value="">BSCpE</option>

                                    <option value="">BCSEE-PSP</option>
                                    <option value="">BCSEE-EE</option> -->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">CURRICULUM CODE</label>

                                <div class="col-sm-8">
                                    <input name="curriculum_code" type="text" class="form-control">
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