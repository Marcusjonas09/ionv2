  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <strong>Underload Requests</strong>
              <!-- <small>Manage accounts</small> -->
          </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

          <div class="box box-success">
              <div class="box-header">
                  <h3 class="box-title">Pending requests</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="box-body table-responsive no-padding">
                      <table id="petitionTable" class="table table-striped">
                          <thead>
                              <th>Student Number</th>
                              <th>Student Name</th>
                              <th>Date Submitted</th>
                              <th>Status</th>
                              <th>Action</th>
                          </thead>
                          <tbody>
                              <?php foreach ($underloads as $underload) : ?>
                                  <tr>
                                      <td><?= $underload->ou_stud_number ?></td>
                                      <td><?= $underload->acc_fname . ' ' . $underload->acc_mname . ' ' . $underload->acc_lname ?></td>
                                      <td><?= date("F j, Y, g:i a", $underload->ou_date_posted) ?></td>
                                      <td>
                                          <?php if ($underload->ou_status == 1) {
                                                    echo "<span class='label label-success'>Approved</span>";
                                                } elseif ($underload->ou_status == 2) {
                                                    echo "<span class='label label-warning'>Pending</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>Denied</span>";
                                                } ?>
                                      </td>
                                      <td><a href="<?= base_url() ?>Admin/underload_view/<?= $underload->ou_stud_number ?>/<?= $underload->ou_term ?>/<?= $underload->ou_year ?>" class="btn btn-warning btn-sm"><span class="fa fa-eye"></span> View</a></td>
                                  </tr>
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