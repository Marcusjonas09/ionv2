  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <strong>Simul Requests</strong>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Pending Requests</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-striped datatables">
            <thead>
              <th>Student Number</th>
              <th>Student Name</th>
              <th>Date Submitted</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php foreach ($requests as $request) : ?>
                <tr>
                  <td><?= $request->acc_number ?></td>
                  <td><?= $request->acc_lname . ', ' . $request->acc_lname . ' ' . $request->acc_mname ?></td>
                  <td><?= date('M-d-Y h:i:s a', strtotime($request->date_submitted)) ?></td>
                  <td>
                    <?php
                    if ($request->IsApproved  == 1) {
                      echo "<span class='label label-success'>Approved</span>";
                    } elseif ($request->IsApproved  == 2) {
                      echo "<span class='label label-warning'>Pending</span>";
                    } else {
                      echo "<span class='label label-danger'>Denied</span>";
                    } ?>
                  </td>
                  <td>
                    <a href="<?= base_url() ?>SuperAdmin/view_simul/<?= $request->simul_id ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i> View</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->