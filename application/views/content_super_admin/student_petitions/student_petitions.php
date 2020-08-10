<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Course Petitions</strong>
            <small>Administrator</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">Course Petitions</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!-- Table showing all petitions related to this student account -->

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#Urgent" data-toggle="tab"><strong>Urgent</strong></a></li>
                <li><a href="#Pending" data-toggle="tab"><strong>Pending</strong></a></li>
                <li><a href="#Processed" data-toggle="tab"><strong>Processed</strong></a></li>
                <li><a href="#All" data-toggle="tab"><strong>All Petitions</strong></a></li>
                <li class="pull-right"><a href="#Settings" data-toggle="tab" class="text-muted"><span class="fa fa-gear"></span></a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="Urgent">
                    <table class="table table-striped datatables">
                        <thead>
                            <th>Course</th>
                            <th>Course Title</th>
                            <th>Date Posted</th>
                            <th class="text-center">Signees</th>
                            <th class="text-center">Urgency</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($petitions as $petition) : ?>
                                <?php if ($petition->petition_urgency == 2 && $petition->petition_status == 2) : ?>
                                    <tr>
                                        <td><?= $petition->course_code ?></td>
                                        <td>
                                            <?php foreach ($courses as $course) : ?>
                                                <?php if ($petition->course_code == $course->course_code) : ?>
                                                    <?= $course->course_title ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td><?= date("F j, Y - g:i a", $petition->date_submitted) ?></td>
                                        <td class="text-center">
                                            <?php $i = 0; ?>
                                            <?php foreach ($petitioners as $petitioner) {
                                                if ($petitioner->petition_unique == $petition->petition_unique) {
                                                    $i++;
                                                }
                                            } ?>
                                            <?= $i ?>
                                        </td>
                                        <td class="text-center"><?php if ($petition->petition_urgency == 1) {
                                                                    echo "<span class='label label-warning'>Medium</span>";
                                                                } elseif ($petition->petition_urgency == 2) {
                                                                    echo "<span class='label label-danger'>High</span>";
                                                                } else {
                                                                    echo "<span class='label label-success'>Low</span>";
                                                                } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($petition->petition_status == 1) {
                                                echo "<span class='label label-success'>Approved</span>";
                                            } elseif ($petition->petition_status == 2) {
                                                echo "<span class='label label-warning'>Pending</span>";
                                            } else {
                                                echo "<span class='label label-danger'>Denied</span>";
                                            } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url() ?>SuperAdmin/show_petition/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-md-6"><?= $this->pagination->create_links(); ?></div>
                </div>

                <div class="tab-pane" id="Pending">
                    <table class="table table-striped datatables">
                        <thead>
                            <th>Course</th>
                            <th>Course Title</th>
                            <th>Date Posted</th>
                            <th class="text-center">Signees</th>
                            <th class="text-center">Urgency</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($petitions as $petition) : ?>
                                <?php if ($petition->petition_status == 2) : ?>
                                    <tr>
                                        <td><?= $petition->course_code ?></td>
                                        <td>
                                            <?php foreach ($courses as $course) : ?>
                                                <?php if ($petition->course_code == $course->course_code) : ?>
                                                    <?= $course->course_title ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td><?= date("F j, Y - g:i a", $petition->date_submitted) ?></td>
                                        <td class="text-center">
                                            <?php $i = 0; ?>
                                            <?php foreach ($petitioners as $petitioner) {
                                                if ($petitioner->petition_unique == $petition->petition_unique) {
                                                    $i++;
                                                }
                                            } ?>
                                            <?= $i ?>
                                        </td>
                                        <td class="text-center"><?php if ($petition->petition_urgency == 1) {
                                                                    echo "<span class='label label-warning'>Medium</span>";
                                                                } elseif ($petition->petition_urgency == 2) {
                                                                    echo "<span class='label label-danger'>High</span>";
                                                                } else {
                                                                    echo "<span class='label label-success'>Low</span>";
                                                                } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($petition->petition_status == 1) {
                                                echo "<span class='label label-success'>Approved</span>";
                                            } elseif ($petition->petition_status == 2) {
                                                echo "<span class='label label-warning'>Pending</span>";
                                            } else {
                                                echo "<span class='label label-danger'>Denied</span>";
                                            } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url() ?>SuperAdmin/show_petition/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-md-6"><?= $this->pagination->create_links(); ?></div>
                </div>

                <div class="tab-pane" id="Processed">
                    <table class="table table-striped datatables">
                        <thead>
                            <th>Course</th>
                            <th>Course Title</th>
                            <th>Date Posted</th>
                            <th class="text-center">Signees</th>
                            <th class="text-center">Urgency</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($petitions as $petition) : ?>
                                <?php if ($petition->petition_status != 2) : ?>
                                    <tr>
                                        <td><?= $petition->course_code ?></td>
                                        <td>
                                            <?php foreach ($courses as $course) : ?>
                                                <?php if ($petition->course_code == $course->course_code) : ?>
                                                    <?= $course->course_title ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td><?= date("F j, Y - g:i a", $petition->date_submitted) ?></td>
                                        <td class="text-center">
                                            <?php $i = 0; ?>
                                            <?php foreach ($petitioners as $petitioner) {
                                                if ($petitioner->petition_unique == $petition->petition_unique) {
                                                    $i++;
                                                }
                                            } ?>
                                            <?= $i ?>
                                        </td>
                                        <td class="text-center"><?php if ($petition->petition_urgency == 1) {
                                                                    echo "<span class='label label-warning'>Medium</span>";
                                                                } elseif ($petition->petition_urgency == 2) {
                                                                    echo "<span class='label label-danger'>High</span>";
                                                                } else {
                                                                    echo "<span class='label label-success'>Low</span>";
                                                                } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($petition->petition_status == 1) {
                                                echo "<span class='label label-success'>Approved</span>";
                                            } elseif ($petition->petition_status == 2) {
                                                echo "<span class='label label-warning'>Pending</span>";
                                            } else {
                                                echo "<span class='label label-danger'>Denied</span>";
                                            } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url() ?>SuperAdmin/show_petition/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-md-6"><?= $this->pagination->create_links(); ?></div>
                </div>

                <div class="tab-pane" id="All">
                    <table class="table table-striped datatables">
                        <thead>
                            <th>Course</th>
                            <th>Course Title</th>
                            <th>Date Posted</th>
                            <th class="text-center">Signees</th>
                            <th class="text-center">Urgency</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($petitions as $petition) : ?>
                                <tr>
                                    <td><?= $petition->course_code ?></td>
                                    <td>
                                        <?php foreach ($courses as $course) : ?>
                                            <?php if ($petition->course_code == $course->course_code) : ?>
                                                <?= $course->course_title ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td><?= date("F j, Y - g:i a", $petition->date_submitted) ?></td>
                                    <td class="text-center">
                                        <?php $i = 0; ?>
                                        <?php foreach ($petitioners as $petitioner) {
                                            if ($petitioner->petition_unique == $petition->petition_unique) {
                                                $i++;
                                            }
                                        } ?>
                                        <?= $i ?>
                                    </td>
                                    <td class="text-center"><?php if ($petition->petition_urgency == 1) {
                                                                echo "<span class='label label-warning'>Medium</span>";
                                                            } elseif ($petition->petition_urgency == 2) {
                                                                echo "<span class='label label-danger'>High</span>";
                                                            } else {
                                                                echo "<span class='label label-success'>Low</span>";
                                                            } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($petition->petition_status == 1) {
                                            echo "<span class='label label-success'>Approved</span>";
                                        } elseif ($petition->petition_status == 2) {
                                            echo "<span class='label label-warning'>Pending</span>";
                                        } else {
                                            echo "<span class='label label-danger'>Denied</span>";
                                        } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>SuperAdmin/show_petition/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i> View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-md-6"><?= $this->pagination->create_links(); ?></div>
                </div>

                <div class="tab-pane" id="Settings">
                    <form action="<?= base_url() ?>SuperAdmin/set_petition_parameters" method="post">

                        <div class="row">
                            <div class="col-md-4">
                                <h3><strong>Petition Settings</strong></h3>
                                <div class="form-group">
                                    <label>Minimum petitioners for approval:</label>
                                    <input type="number" min="0" max="50" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3><strong>Petition schedule</strong></h3>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Date and time range:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input name="petition_sched" type="text" class="form-control pull-right" id="petitionsched">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->