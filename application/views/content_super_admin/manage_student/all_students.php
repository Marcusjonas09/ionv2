<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Students</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid" style="padding:0px;">
            <div class="box box-success">
                <div class="box-body">
                    <table class="datatables table table-striped" data-page-length='10'>
                        <thead class="bg-success text-center" style="background-color:#00a65a; color:white;">
                            <th class="text-center col-md-1">Student No</th>
                            <th class="text-center col-md-3">Full Name</th>
                            <th class="text-center col-md-1">Program</th>
                            <th class="text-center col-md-2">College</th>
                            <th class="text-center col-md-2">Curriculum</th>
                            <th class="text-center col-md-2">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student) : ?>
                                <tr>
                                    <td class="text-center"><?= $student->acc_number ?></td>
                                    <td><?= $student->acc_lname . ', ' . $student->acc_fname . ' ' . $student->acc_mname ?></td>
                                    <td class="text-center"><?= $student->acc_program ?></td>
                                    <td class="text-center"><?= $student->acc_college ?></td>
                                    <td class="text-center"><?= $student->curriculum_code ?></td>
                                    <td>
                                        <button class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <a class="btn btn-success pull-right" href="<?= base_url() ?>Superadmin/add_student">Add New Entry</a>
                </div>
            </div>

            

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->