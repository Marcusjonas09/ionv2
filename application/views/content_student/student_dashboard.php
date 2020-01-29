<?php
$totalunits = 0.0;
$totalunitspassed = 0.0;
$course_units = 0.0;
$lab_units = 0.0;
$coursepassed = 0.0;
$labpassed = 0.0;
?>

<?php foreach ($curr as $unit) {
    $course_units += $unit->course_units;
    $lab_units += $unit->laboratory_units;
    foreach ($grades as $grade) {
        if ($unit->course_code == $grade->cc_course && ($grade->cc_status == "finished" || $grade->cc_status == "credited") && $grade->cc_final >= 1.0) {
            $coursepassed += $unit->course_units;
        }
        if (strtoupper($unit->laboratory_code) == strtoupper($grade->cc_course) && ($grade->cc_final > 1.0 && $grade->cc_final <= 4.0)) {
            $labpassed += $unit->laboratory_units;
        }
    }
}
$totalunits = $course_units + $lab_units;
$totalunitspassed = $coursepassed + $labpassed;
?>

<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Dashboard</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div id="dash" class=' alert alert-warning alert-dismissible' style='display:none;' role='alert'>
        </div>

        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><b>Student Progress</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="col-md-4">
                    <h4 class="text-center">Student Badge</h4>
                </div>
                <div align="center" class="col-md-4">
                    <h4 class="text-center">Overall Progress</h4>
                    <div id="container"></div>
                </div>

                <div class="col-md-4">
                    <h4 class="text-center">Progress Info</h4>

                    <div class="small-box bg-green" style="height:100%;">
                        <div class="inner">
                            <h3><?= $this->session->curriculum ?></h3><br />
                            <p>Total Units: <strong><?= $totalunits ?></strong></p>
                            <p>Total Units Earned: <strong><?= $totalunitspassed ?></strong></p>
                        </div>

                        <div class="icon">
                            <i style="margin-top:70px;" class="fa fa-list-alt"></i>
                        </div>
                        <a href="<?= base_url() ?>/Student/curriculum" class="small-box-footer">
                            View Curriculum <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><strong>Certification of Registration (Term: <?= $this->session->curr_term ?> SY: <?= $this->session->curr_year ?>)</strong></h3>
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
                            <td><strong>Year Level: </strong><?php if ($totalunitspassed >= 3 && $totalunitspassed <= 56) {
                                                                        echo "1";
                                                                    } else if ($totalunitspassed >= 57 && $totalunitspassed <= 116) {
                                                                        echo "2";
                                                                    } else if ($totalunitspassed >= 117 && $totalunitspassed <= 173) {
                                                                        echo "3";
                                                                    } else if ($totalunitspassed >= 174 && $totalunitspassed <= ($totalunits - 18)) {
                                                                        echo "4";
                                                                    } else if (($totalunits - $totalunitspassed) <= 18) {
                                                                        echo "GRADUATING";
                                                                    } else { } ?></td>
                        </tr>
                    </table>
                    <table class="table">
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
                            <?php $total = 0;
                                foreach ($cor as $record) : ?>
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
                                        <td><?= strtoupper($record->cc_section) ?></td>
                                        <td class="text-center">
                                            <?php if (strtoupper($record->cc_course) == strtoupper($record->course_code)) {
                                                            echo strtoupper($record->course_units);
                                                            $total += $record->course_units;
                                                        } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                                            echo strtoupper($record->laboratory_units);
                                                            $total += $record->laboratory_units;
                                                        } else {
                                                            echo '';
                                                        } ?>
                                        </td>
                                        <?php foreach ($offerings as $offering) : ?>
                                            <?php if ($record->cc_course == $offering->offering_course_code && $record->cc_section == $offering->offering_course_section) : ?>
                                                <td><?= $offering->offering_course_day ?></td>
                                                <td><?= $offering->offering_course_time ?></td>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><strong>Total:</strong></td>
                                <td class="text-center">
                                    <strong><?= $total ?></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
            <!-- /.box-body -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
    var progress = "<?php echo $totalunitspassed / $totalunits; ?>";
    var bar = new ProgressBar.Circle(container, {
        color: '#ffc20e',
        // This has to be the same size as the maximum width to
        // prevent clipping
        strokeWidth: 10,
        trailWidth: 5,
        easing: 'easeInOut',
        duration: 1000,
        text: {
            autoStyleContainer: false
        },
        from: {
            color: '#f00',
            width: 10
        },
        to: {
            color: '#00a65a',
            width: 10
        },
        // Set default step function for all animate calls
        step: function(state, circle) {
            circle.path.setAttribute('stroke', state.color);
            circle.path.setAttribute('stroke-width', state.width);

            var value = Math.round(circle.value() * 100);
            if (value === 0) {
                circle.setText('0%');
            } else {
                circle.setText(value + '%');
            }

        }
    });
    bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
    bar.text.style.fontSize = '6rem';

    bar.animate(progress); // Number from 0.0 to 1.0
</script>