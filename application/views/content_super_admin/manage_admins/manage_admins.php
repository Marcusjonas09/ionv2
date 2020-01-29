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
                        <a class="btn btn-success pull-right" href="<?= base_url() ?>SuperAdmin/create_admin">Add Account</a>
                    </div>
                </div>
                <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->