<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Parallel Courses</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="datatables table table-bordered table-responsive">
                    <thead class="bg-success" style="background-color:#00a65a; color:white;">
                        <th class="text-center">COURSE</th>
                        <th class="text-center">PARALLEL COURSES</th>
                    </thead>
                    <tbody>
                        <?php foreach ($parallel as $pl) : ?>
                            <tr>
                                <td class="text-center"><?= $pl->parallel_root_course ?></td>
                                <td>
                                    <?php foreach ($parallelCourse as $plc) : ?>
                                        <?php if ($pl->parallel_root_course == $plc->parallel_root_course) : ?>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <?= $plc->parallel_course ?>
                                                </div>
                                                <div class="col-md-10">
                                                    <?= $plc->parallel_description ?><br />
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->