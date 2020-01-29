<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Faculty Management</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">

            <div class="box-header with-border">
                <h3 class="box-title"><strong>Create New Department</strong></h3>
            </div>
            <!-- /.box-header -->

            <form action="<?= base_url() ?>Student/changepass" method="post">
                <div class="box-body">

                    <div class="form-group col-md-4">
                        <label>School Year</label>
                        <input type="text" class="form-control" name="schoolyear" placeholder="School Year">
                    </div>
                    <div class="form-group col-md-4">
                        <label>School Term</label>
                        <input type="text" class="form-control" name="schoolterm" placeholder="School Term">
                    </div>

                </div>
                <div class="box-footer">
                    <button id="change_pass" class="btn btn-success pull-right col-md-2">Save</button>
                </div>
            </form>

            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->