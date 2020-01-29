<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Account Management</strong>
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
                        <div class="col-md-4">
                            <img class="col-md-12" src="<?= base_url() ?>dist/img/default_avatar.png">
                        </div>
                        <div class="col-md-8">
                            <form action="<?= base_url() ?>SuperAdmin/create_admin_function" method="post">
                                <div class="box-body">
                                    <div class="form-group col-md-12">
                                        <label for="emp_fname">First Name</label>
                                        <input type="text" class="form-control" placeholder="Enter firstname">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="emp_mname">Middle Name</label>
                                        <input type="text" class="form-control" placeholder="Enter firstname">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="emp_lname">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Enter firstname">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="emp_no">Employee No.</label>
                                        <input type="email" class="form-control" placeholder="Enter employee number">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="emp_dept">Department</label>
                                        <input type="text" class="form-control" placeholder="Enter firstname">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="emp_desig">Designation</label>
                                        <input type="text" class="form-control" placeholder="Enter firstname">
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