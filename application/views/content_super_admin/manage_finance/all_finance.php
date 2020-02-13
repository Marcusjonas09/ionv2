<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <a class="navi" href="<?= base_url() ?>SuperAdmin/school_parameters"><span class="fa fa-chevron-left"></span>&nbsp&nbsp<strong>Back</strong></a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid col-md-12" style="padding:0px;">
            <?php if (isset($success_msg)) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i>Success!</h4>
                    <?php echo $success_msg; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($fail_msg)) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i>Success!</h4>
                    <?php echo $fail_msg; ?>
                </div>
            <?php endif; ?>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <strong>Finance</strong>
                    </h3>

                    <!-- <a class="btn btn-success pull-right" href="<?= base_url() ?>SuperAdmin/add_finance">Add New Entry</a>

                    <a class="btn btn-danger pull-right" style="margin-right:10px;" href="<?= base_url() ?>SuperAdmin/add_finance">Delete Multiple</a> -->

                </div>
                <div class="box-body">
                    <table class="datatables table table-striped text-center" data-page-length='10'>
                        <thead class="bg-success text-center" style="background-color:#00a65a; color:white;">
                            <th class="text-center col-md-2">#</th>
                            <th class="text-center col-md-4">School Year</th>
                            <th class="text-center col-md-4">Term</th>
                            <th class="text-center col-md-2">Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($school_years as $school_year) : ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td>
                                        <?= $school_year->school_year ?>
                                    </td>
                                    <td>
                                        <?= $school_year->school_term ?>
                                    </td>
                                    <td class="text-center">
                                        <a id="edit_finance" href="<?= base_url() ?>SuperAdmin/edit_finance/<?= $school_year->settings_ID ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
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