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
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Administrator Accounts</h3>
                        <!-- <a class="btn btn-success pull-right" href="<?= base_url() ?>SuperAdmin/create_admin">Add Account</a> -->

                        <button class="btn btn-success pull-right" data-toggle="modal" data-target="#add_admin">Add Account</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-stripedadmin">
                            <thead class="bg-success">
                                <th>Faculty ID</th>
                                <th>Full Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <?php foreach ($admins as $admin) : ?>
                                <tr>
                                    <td><?= $admin->acc_number ?></td>
                                    <td><?= $admin->acc_lname . ', ' . $admin->acc_fname ?></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>SuperAdmin/edit_admin/<?= $admin->acc_number ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-pencil"></i></a>
                                        <a href="<?= base_url() ?>SuperAdmin/view_admin/<?= $admin->acc_number ?>" class="btn btn-primary btn-sm rounded"><i class="fa fa-eye"></i></a>
                                        <?php if ($admin->acc_status) {
                                            echo '<a href="' . base_url() . 'SuperAdmin/block_admin/' . $admin->acc_number . '" class="btn btn-danger btn-sm rounded"><i class="fa fa-ban"></i></a>';
                                        } else {
                                            echo '<a href="' . base_url() . 'SuperAdmin/block_admin/' . $admin->acc_number . '" class="btn btn-success btn-sm rounded"><i class="fa fa-check"></i></a>';
                                        }; ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="col-md-6 pull-right"><?= $this->pagination->create_links(); ?></div>
                    <div class="box-footer">

                    </div>
                </div>
                <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="add_admin_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="add_admin_label">Account Details</h4>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-4">
                    <label for="curr_code">Faculty:</label>
                    <select class="form-control js-example-basic-single" name="Faculty" id="Faculty">
                        <option value="">none</option>
                        <?php foreach ($colleges as $college) : ?>
                            <option value="<?= $college->college_code ?>"><?= $college->college_code . ' - ' . $college->college_description ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>