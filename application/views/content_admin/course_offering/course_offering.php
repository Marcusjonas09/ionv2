<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Course Offerings</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
                <form action="<?= base_url() ?>Admin/offerings" method="POST">
                    <div class="row container">
                        <h3 class="box-title pull-left"><strong>School Year: </strong></h3>
                        <div class="form-group col-md-2">
                            <select name="year" class="form-control">
                                <option value="--">--</option>
                                <?php foreach ($years as $year) : ?>
                                    <option value="<?= $year->offering_year ?>"><?= $year->offering_year ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <h3 class="box-title pull-left"><strong>Term: </strong></h3>
                        <div class="form-group col-md-2">
                            <select name="term" class="form-control">
                                <option value="--">--</option>
                                <?php foreach ($terms as $term) : ?>
                                    <option value="<?= $term->offering_term ?>"><?= $term->offering_term ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" name="submit" class="btn btn-success" style="margin-left:10px;">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if ($offering || $classes) : ?>
                    <table class="datatables table table-bordered table-responsive text-center" data-page-length="100">
                        <thead class="bg-success" style="background-color:#00a65a; color:white;">
                            <th class="text-center">COURSE</th>
                            <th class="text-center">SECTION</th>
                            <th class="text-center">REMAINING</th>
                            <th class="text-center">DAY</th>
                            <th class="text-center">TIME</th>
                        </thead>
                        <tbody>
                            <?php if ($Y <= 20192020 && $T < 3) : ?>
                                <?php foreach ($offering as $of) : ?>
                                    <tr class="<?php if ($of->offering_course_slot == 0) {
                                                    echo "bg-danger";
                                                } else {
                                                    echo "bg-default";
                                                } ?>">
                                        <td class="col-md-1"><?= $of->offering_course_code ?></td>
                                        <td class="col-md-1"><?= $of->offering_course_section ?></td>
                                        <td class="col-md-1"><?= $of->offering_course_slot ?></td>
                                        <td class="col-md-2"><?= $of->offering_course_day ?></td>
                                        <td class="col-md-7"><?= $of->offering_course_time ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php foreach ($classes as $class) : ?>
                                    <tr class="<?php if ($class['class_capacity'] == 0) {
                                                    echo "bg-danger";
                                                } else {
                                                    echo "bg-default";
                                                } ?>">
                                        <td class="col-md-2"><?= $class['class_code'] ?></td>
                                        <td class="col-md-1"><?= $class['class_section'] ?></td>
                                        <td class="col-md-1"><?= $class['class_capacity'] ?></td>
                                        <td class="col-md-2"><?= $class['sched_day'] ?></td>
                                        <td class="col-md-6"><?= $class['sched_time'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <?php if (isset($_POST['submit'])) : ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <p><?php echo "No records retrieved"; ?></p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>


            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->