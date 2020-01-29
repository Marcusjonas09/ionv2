<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>School Parameters</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid col-md-6" style="padding:0px;">
            <div class="box box-success ">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Current Parameters</strong></h3>
                </div>
                <!-- /.box-header -->
                <form action="<?= base_url() ?>Student/changepass" method="post">
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label>School Year</label>
                            <input type="text" disabled class="form-control" name="schoolyear" placeholder="School Year">
                        </div>
                        <div class="form-group col-md-4">
                            <label>School Term</label>
                            <input type="text" disabled class="form-control" name="schoolterm" placeholder="School Term">
                        </div>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="container-fluid col-md-6" style="padding-right:0px;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Update Parameters</strong></h3>
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
                </form>

                <!-- /.box-body -->
            </div>
        </div>

        <div class="container-fluid col-md-12" style="padding:0px;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Set Parameters</strong></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="simul_number"><?= $college_count ?></h3>

                                <p>College/s</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/college" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="simul_number"><?= $department_count ?></h3>

                                <p>Department/s</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/department" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="simul_number"><?= $program_count ?></h3>

                                <p>Program/s</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/program" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="simul_number"><?= $specialization_count ?></h3>

                                <p>Specialization/s</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/specialization" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="simul_number"><?= $course_count ?></h3>

                                <p>Course/s</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/courses" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="simul_number"><?= $lab_count ?></h3>

                                <p>Laboratory</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/laboratories" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 id="simul_number">0</h3>

                                <p>Pre Requisite</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/laboratories" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="simul_number"><?= $section_count ?></h3>

                                <p>Section/s</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/section" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 id="simul_number"><?= $curriculum_count ?></h3>

                                <p>Curriculum</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/curriculum" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 id="simul_number">0</h3>

                                <p>Course Offering</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/laboratories" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 id="simul_number">0</h3>

                                <p>Parallel Courses</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/laboratories" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>



                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 id="simul_number">0</h3>

                                <p>Faculty</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/curriculum" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 id="simul_number">0</h3>

                                <p>Student/s</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/curriculum" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Added modules</strong></h3>
                </div>


                <div class="box-body">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 id="simul_number">0</h3>

                                <p>Class Schedule</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/curriculum" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3 id="simul_number">0</h3>

                                <p>Finance</p>
                            </div>
                            <div class="icon">
                                <!-- <i class="fa fa-shopping-cart"></i> -->
                            </div>
                            <a href="<?= base_url() ?>SuperAdmin/curriculum" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->