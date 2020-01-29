<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Assessment</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="col-md-5">
            <div class="box box-success">
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table text-center">
                        <thead style="background-color:#00a65a; color:white;">
                            <th class="col-md-2">Term</th>
                            <th class="col-md-5">School Year</th>
                            <th class="col-md-4">Status</th>
                            <th class="col-md-1">Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($balances as $balance) : ?>
                                <tr>
                                    <td><?= $balance->bal_term ?></td>
                                    <td><?= $balance->bal_year ?></td>
                                    <td>
                                        <?php if ($balance->bal_status == 0) {
                                                echo "Not Registered";
                                            } elseif ($balance->bal_status == 1) {
                                                echo "Enrolled";
                                            } else {
                                                echo "Unknown";
                                            } ?>
                                    </td>
                                    <td><a href="<?= base_url() ?>Student/assessment/<?= $balance->bal_term ?>/<?= $balance->bal_year ?>" class="btn btn-warning btn-sm"><span class="fa fa-search"></span></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="col-md-7">
            <div class="box box-success">
                <div class="box-header with-border">
                    <strong>
                        <h4>Statement of account</h4>
                    </strong>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <tr style="background-color:#00a65a; color:white;">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Student Number: </td>
                            <td colspan="4"><?= $this->session->acc_number ?></td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td colspan="4"><?= strtoupper($this->session->Lastname . ', ' . $this->session->Firstname . ' ' . $this->session->Middlename) ?></td>
                        </tr>
                        <tr>
                            <td>Program</td>
                            <td colspan="4"><?= $this->session->Program ?></td>
                        </tr>
                        <tr style="background-color:#00a65a; color:white;">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Beginning Balance</td>
                            <td>
                                <?php if ($bal->bal_beginning >= 0) {
                                    echo '(' . $bal->bal_beginning . ')';
                                } else {
                                    echo abs($bal->bal_beginning);
                                }  ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Total Assessment</td>
                            <td><?= $bal->bal_total_assessment ?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Payments</td>
                        </tr>
                        <?php if ($bal->bal_beginning > 0) : ?>
                            <tr>
                                <td></td>
                                <td>
                                    <?= '(' . $bal->bal_beginning . ')' ?>
                                </td>
                                <td>Beginning Balance (Forwarded)</td>
                            </tr>
                        <?php endif; ?>

                        <?php $totalpayment = 0.00; ?>

                        <?php foreach ($payments as $payment) : ?>
                            <?php if ($payment) : ?>
                                <tr>
                                    <td></td>
                                    <td><?= '(' . $payment->payment . ')' ?></td>
                                    <td>OR# <?= $payment->or_number ?>
                                        <?= date(' - Y-m-d', $payment->pay_date) ?>
                                        <?php if ($payment->pay_type == 0) {
                                                    echo "(elink)";
                                                } else {
                                                    echo "(cash)";
                                                } ?>
                                    </td>
                                </tr>
                                <?php $totalpayment += $payment->payment; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr style="background-color:#00a65a; color:white;">
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Remaining Balance</h4>
                            </td>
                            <?php $remaining =  $bal->bal_total_assessment - $totalpayment - $bal->bal_beginning; ?>
                            <?php  ?>
                            <td><?php if ($remaining >= 0.00) {
                                    $remaining = abs($remaining);
                                    echo '<h4><strong>' . number_format((float) $remaining, 2, '.', '') . '</strong></h4>';
                                } else {
                                    $remaining = abs($remaining);
                                    echo '<h4><strong>(' . number_format((float) $remaining, 2, '.', '') . ')</strong></h4>';
                                } ?></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->