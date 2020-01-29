<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/curriculum"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

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

        <div class="container-fluid col-md-9" style="padding-right:0px;">
            <form action="<?= base_url() ?>SuperAdmin/add_course_to_curriculum" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Add Courses to <?= $curriculum_code->curriculum_code ?></strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="">Course Code</label>
                            <select id="course_id" name="course_id" class="form-control js-example-basic-single">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= $course->course_id ?>"><?= $course->course_code . " - " . $course->course_title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Laboratory Code</label>
                            <select id="laboratory_id" name="laboratory_id" class="form-control js-example-basic-single">
                                <?php foreach ($laboratories as $laboratory) : ?>
                                    <option value="<?= $laboratory->laboratory_id ?>"><?= $laboratory->laboratory_code . " - " . $laboratory->laboratory_title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Year</label>
                            <select id="year" name="year" class="form-control js-example-basic-single">
                                <option value="">--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">Term</label>
                            <select id="term" name="term" class="form-control js-example-basic-single">
                                <option value="">--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>

                        <input type="hidden" name="curriculum_code_id" id="curriculum_code_id" value="<?= $curriculum_code->curriculum_code_id ?>" />
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" value="Add Course" />
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid col-md-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Insert Multiple Entry</strong></h3>
                </div>
                <div class="box-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Upload CSV file</label>
                            <input class="form-control btn btn-default" type="file" name="facultycsv" />
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <input class="btn btn-success pull-right" type="submit" value="Import" />
                </div>
            </div>
        </div>

        <div class="container-fluid col-md-12" style="padding-right:0px;">
            <!-- <form action="<?= base_url() ?>SuperAdmin/create_curriculum" method="post"> -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?= $curriculum_code->curriculum_code ?></strong></h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-responsive">
                        <thead class=" bg-success" style="background-color:#00a65a; color:white;">
                            <th class="text-center">COURSE</th>
                            <th class="text-center">COURSE TITLE</th>
                            <th class="text-center">UNITS</th>
                            <th class="text-center">LABORATORY</th>
                            <th class="text-center">UNITS</th>
                            <th class="text-center">PREREQUISITE</th>
                            <th class="text-center">ACTION</th>
                        </thead>

                        <?php for ($y = 1; $y < 5; $y++) : ?>
                            <tr>
                                <th class="text-center" style="background-color:#00a65a; color:white;" colspan="7"><?= 'YEAR: ' . $y ?></th>
                            </tr>
                            <?php for ($t = 1; $t < 4; $t++) : ?>
                                <tr>
                                    <th style="background-color:#ccc;" colspan="7"><?= 'Term: ' . $t ?></th>
                                </tr>

                                <?php foreach ($curriculum as $cur) : ?>
                                    <?php if ($cur->Year == $y && $cur->Term == $t) : ?>
                                        <tr>
                                            <td><?= $cur->course_code ?></td>
                                            <td><?= $cur->course_title ?></td>
                                            <td class="text-center"><?= $cur->course_units ?></td>
                                            <td><?= $cur->laboratory_code ?></td>
                                            <td class="text-center"><?= $cur->laboratory_units ?></td>
                                            <td><?= $cur->pr_requisite ?></td>
                                            <td>
                                                <button class="btn btn-danger" onclick="delete_course_from_curriculum(<?= $cur->curriculum_id ?>,<?= $curriculum_code->curriculum_code_id ?>)"><i class="fa fa-minus"></i></button>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endfor; ?>
                        <?php endfor; ?>
                    </table>
                </div>
            </div>
            <!-- </form> -->
        </div>


    </section>
</div>
<!-- /.content-wrapper -->