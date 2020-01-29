<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a class="navi" href="<?= base_url() ?>Student/petitions"><span class="fa fa-chevron-left"></span>&nbsp&nbsp<strong>Back</strong></a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <!-- Table showing all petitions related to this student account -->

        <div class="col-md-7">
            <div class="box box-success">
                <div class="box-header">
                    <h4><strong>Petition Status: </strong>
                        <?php if ($petition->petition_status == 1) {
                            echo "<span class='label label-success'>Approved</span>";
                        } elseif ($petition->petition_status == 2) {
                            echo "<span class='label label-warning'>Pending</span>";
                        } else {
                            echo "<span class='label label-danger'>Denied</span>";
                        } ?></h4>
                </div>
                <div class="box-body">
                    <div class="container-fluid col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Course Code: </label>
                                    <input readonly type="text" class="form-control" value="<?= $petition->course_code ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date submitted: </label>
                                    <input type="text" class="form-control" readonly value="<?= date("F j, Y, g:i a", $petition->date_submitted) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Section</label>
                                    <input readonly type="text" class="form-control" placeholder="Course section">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date processed: </label>
                                    <input type="text" class="form-control" readonly value="<?php if ($petition->date_processed) {
                                                                                                echo date("F j, Y, g:i a", $petition->date_processed);
                                                                                            } else {
                                                                                                echo "Pending";
                                                                                            } ?>">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Course Description</label>
                                    <?php foreach ($courses as $course) : ?>
                                        <?php if ($petition->course_code == $course->course_code) : ?>
                                            <input readonly type="text" class="form-control" placeholder="Course description" value="<?= $course->course_title ?>">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php if (!$check_if_you_petitioned) : ?>
                            <a class="btn btn-success pull-right" href="<?= base_url() ?>Student/sign_petition/<?= $this->session->acc_number ?>/<?= $petition->course_code ?>/<?= $petition->petition_unique ?>">Sign</a>
                        <?php endif; ?>
                        <?php if ($check_if_you_petitioned && $petition->petition_status == 2) : ?>
                            <a class="btn btn-danger pull-right" href="<?= base_url() ?>Student/withdraw_petition/<?= $this->session->acc_number ?>/<?= $petition->petition_unique ?>">Withdraw</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><strong>Schedule</strong></h3>
                </div>
                <div class="container-fluid">
                    <table class="table">
                        <thead style="background-color:#00a65a; color:white;">
                            <th class="text-center">Day</th>
                            <th>Time</th>
                            <th>Room</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-md-2 text-center">T</td>
                                <td class="col-md-7">7:00 - 9:00</td>
                                <td class="col-md-3">F1201</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Faculty</label>
                                    <input readonly type="text" class="form-control" placeholder="Faculty">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><strong>Petitioners</strong></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Student Number</th>
                            <th>Student Name</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($petitioners as $petitioner) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $petitioner->stud_number ?></td>
                                    <td><?= $petitioner->acc_fname . ' ' . $petitioner->acc_lname ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->