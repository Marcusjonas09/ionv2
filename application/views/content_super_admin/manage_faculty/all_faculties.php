<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/school_parameters"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid" style="padding:0px;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <strong>Faculties</strong>
                    </h3>
                    <a class="btn btn-success pull-right" href="<?= base_url() ?>SuperAdmin/add_faculty">Add New Entry</a>
                </div>
                <div class="box-body">
                    <table class="datatables table table-striped" data-page-length='10'>
                        <thead class="bg-success text-center" style="background-color:#00a65a; color:white;">
                            <th class="text-center" style="width:5%;">#</th>
                            <th class="text-center" style="width:10%;">Faculty No</th>
                            <th class="text-center col-md-3">Full Name</th>
                            <th class="text-center col-md-2">College</th>
                            <th class="text-center col-md-2">Department</th>
                            <th class="text-center col-md-2">Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($faculties as $faculty) : ?>
                                <tr>
                                    <td class="text-center"><?= $i++ ?></td>
                                    <td class="text-center"><?= $faculty->acc_number ?></td>
                                    <td class="text-center"><?= $faculty->acc_lname . ', ' . $faculty->acc_fname . ' ' . $faculty->acc_mname ?></td>
                                    <td class="text-center"><?= $faculty->acc_college ?></td>
                                    <td class="text-center"><?= strtoupper($faculty->acc_program) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>SuperAdmin/edit_faculty/<?= $faculty->acc_id ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->