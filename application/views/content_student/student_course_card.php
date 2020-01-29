<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Course Card</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-header with-border">
                <form action="<?= base_url() ?>Student/course_card" method="POST">
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
                <?php if ($course_card) : ?>
                    <h4><strong>Term: School Year: </strong></h4>
                    <table class="table table-bordered table-responsive">
                        <thead class="bg-success" style="background-color:#00a65a; color:white;">
                            <th class="text-center col-md-1">COURSE</th>
                            <th class="text-center col-md-7">COURSE TITLE</th>
                            <th class="text-center col-md-1">SECTION</th>
                            <th class="text-center col-md-1">UNITS</th>
                            <th class="text-center col-md-1">MIDTERM</th>
                            <th class="text-center col-md-1">FINAL</th>
                        </thead>
                        <tbody>
                            <?php foreach ($course_card as $record) : ?>
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
                                    <td><?= strtoupper($record->cc_section) ?></td>
                                    <td class="text-center">
                                        <?php if (strtoupper($record->cc_course) == strtoupper($record->course_code)) {
                                            echo strtoupper($record->course_units);
                                        } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                            echo strtoupper($record->laboratory_units);
                                        } else {
                                            echo '';
                                        } ?></td>
                                    <td class="text-center"><?= $record->cc_midterm ?></td>
                                    <td class="text-center"><?= $record->cc_final ?></td>
                                </tr>
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