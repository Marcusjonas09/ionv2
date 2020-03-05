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
        <div class="container-fluid" style="padding:0px;">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($message)) : ?>
                <?php echo $message; ?>
            <?php endif; ?>
        </div>

        <div class="container-fluid <?= ($this->session->access == 'superadmin') ? 'col-md-6' : 'col-md-12' ?>" style="padding:0px;">
            <div class="box box-success ">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Current School Year</strong></h3>
                </div>
                <!-- /.box-header -->
                <form action="<?= base_url() ?>Student/changepass" method="post">
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label>School Year</label>
                            <input type="text" disabled value="<?= $current_sy->school_year ?>" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>School Term</label>
                            <input type="text" disabled value="<?php if ($current_sy->school_term == 1) {
                                                                    echo '1st Term';
                                                                } else if ($current_sy->school_term == 2) {
                                                                    echo '2nd Term';
                                                                } else {
                                                                    echo '3rd Term';
                                                                } ?>" class="form-control">
                        </div>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
        </div>
        <?php if ($this->session->access == 'superadmin') : ?>
            <div class="container-fluid col-md-6" style="padding-right:0px;">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Update School Year</strong></h3>
                    </div>
                    <!-- /.box-header -->
                    <form action="<?= base_url() ?>SuperAdmin/change_sy" method="post">
                        <div class="box-body">

                            <div class="form-group col-md-4">
                                <label>School Year</label>
                                <!-- <input type="text" class="form-control" name="schoolyear" placeholder="School Year"> -->
                                <select class="form-control" name="schoolyear">
                                    <option value="20192020">2019-2020</option>
                                    <option value="20202021">2020-2021</option>
                                    <option value="20212022">2021-2022</option>
                                    <option value="20222023">2022-2023</option>
                                    <option value="20232024">2023-2024</option>
                                    <option value="20242025">2024-2025</option>
                                    <option value="20252026">2025-2026</option>
                                    <option value="20262027">2026-2027</option>
                                    <option value="20272028">2027-2028</option>
                                    <option value="20282029">2028-2029</option>
                                    <option value="20292030">2029-2030</option>
                                    <option value="20202030">2020-2030</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>School Term</label>
                                <select class="form-control" name="schoolterm">
                                    <option value="1">1st Term</option>
                                    <option value="2">2nd Term</option>
                                    <option value="3">3rd Term</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>&nbsp</label>
                                <button type="submit" class="form-control btn btn-success">Update</button>
                            </div>

                        </div>
                    </form>

                    <!-- /.box-body -->
                </div>
            </div>
        <?php endif; ?>

        <div class="container-fluid col-md-12" style="padding:0px;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Set Parameters</strong></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php if ($this->session->access == 'superadmin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $college_count ?></h3>

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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $department_count ?></h3>

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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $program_count ?></h3>

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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $specialization_count ?></h3>

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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin' || $this->session->access == 'admin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $course_count ?></h3>
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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin' || $this->session->access == 'admin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $lab_count ?></h3>

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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin' || $this->session->access == 'admin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $section_count ?></h3>

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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin' || $this->session->access == 'admin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $curriculum_count ?></h3>

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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin' || $this->session->access == 'admin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>0</h3>

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
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>0</h3>

                                    <p>Faculty</p>
                                </div>
                                <div class="icon">
                                    <!-- <i class="fa fa-shopping-cart"></i> -->
                                </div>
                                <a href="<?= base_url() ?>SuperAdmin/faculties" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin' || $this->session->access == 'admin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $student_count ?></h3>
                                    <p>Student/s</p>
                                </div>
                                <div class="icon">
                                    <!-- <i class="fa fa-shopping-cart"></i> -->
                                </div>
                                <a href="<?= base_url() ?>SuperAdmin/students" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin' || $this->session->access == 'admin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3><?= $class_count ?></h3>

                                    <p>Class Schedule</p>
                                </div>
                                <div class="icon">
                                    <!-- <i class="fa fa-shopping-cart"></i> -->
                                </div>
                                <a href="<?= base_url() ?>SuperAdmin/classes" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->access == 'superadmin') : ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>0</h3>

                                    <p>Finance</p>
                                </div>
                                <div class="icon">
                                    <!-- <i class="fa fa-shopping-cart"></i> -->
                                </div>
                                <a href="<?= base_url() ?>SuperAdmin/finances" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>

            <!-- <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Added modules</strong></h3>
                </div>


                <div class="box-body">

                </div>
            </div> -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->