<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Certificate Of Registration</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
                <form action="<?= base_url() ?>Student/cor" method="POST">
                    <div class="row container">
                        <h3 class="box-title pull-left"><strong>School Year: </strong></h3>
                        <div class="form-group col-md-2">
                            <select name="school_year" class="form-control">
                                <option value="--">--</option>
                                <?php foreach ($years as $year) : ?>
                                    <option value="<?= $year->cc_year ?>"><?= $year->cc_year ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <h3 class="box-title pull-left"><strong>School Term: </strong></h3>
                        <div class="form-group col-md-2">
                            <select name="school_term" class="form-control">
                                <option value="--">--</option>
                                <?php foreach ($terms as $term) : ?>
                                    <option value="<?= $term->cc_term ?>"><?= $term->cc_term ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" name="submit" class="btn btn-success" style="margin-left:10px;">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php if ($cor) : ?>
                    <table class="table">
                        <tr>
                            <td><strong>Student #: </strong><?= $this->session->acc_number ?></td>
                            <td><strong>College: </strong> <?= $this->session->College ?></td>
                            <td><strong>Program: </strong><?= $this->session->Program ?></td>
                        </tr>
                        <tr>
                            <td><strong>Name: </strong><?= $this->session->Lastname . ', ' . $this->session->Firstname . ' ' . $this->session->Middlename ?></td>
                            <td><strong>Year Level: </strong></td>
                        </tr>
                    </table>
                    <table class="table table-striped table-bordered">
                        <tr class="bg-success" style="background-color:#00a65a; color:white;">
                            <th class="text-center col-md-1">COURSES</th>
                            <th class="text-center col-md-4">TITLE</th>
                            <th class="text-center col-md-1">SECTION</th>
                            <th class="text-center col-md-1">UNITS</th>
                            <th class="text-center col-md-1">DAYS</th>
                            <th class="text-center col-md-3">TIME</th>
                            <th class="text-center col-md-1">ROOM</th>
                        </tr>
                        <tbody>
                            <?php foreach ($cor as $record) : ?>
                                <?php if ($record->cc_status != "credited") : ?>
                                    <tr>
                                        <td><?= strtoupper($record->cc_course) ?></td>
                                        <td>
                                            <?php if (strtoupper($record->cc_course) == strtoupper($record->course_code)) {
                                                echo strtoupper($record->course_title);
                                            } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                                echo strtoupper($record->laboratory_title);
                                            } else {
                                                echo '';
                                            } ?>
                                        </td>
                                        <td class="text-center"><?= strtoupper($record->cc_section) ?></td>
                                        <td class="text-center">
                                            <?php if (strtoupper($record->cc_course) == strtoupper($record->course_code)) {
                                                echo strtoupper($record->course_units);
                                            } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                                echo strtoupper($record->laboratory_units);
                                            } else {
                                                echo '';
                                            } ?>
                                        </td>
                                        <?php foreach ($offerings as $offering) : ?>
                                            <?php if ($record->cc_course == $offering->offering_course_code && $record->cc_section == $offering->offering_course_section) : ?>
                                                <td class="text-center"><?= $offering->offering_course_day ?></td>
                                                <td class="text-center"><?= $offering->offering_course_time ?></td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
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