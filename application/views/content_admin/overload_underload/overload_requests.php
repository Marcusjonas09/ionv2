  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <strong>Overload Requests</strong>
              <!-- <small>Manage accounts</small> -->
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

                              <?php foreach ($overloads as $overload) : ?>
                                  <tr>
                                      <td><?= $overload->ou_stud_number ?></td>
                                      <td><?= $overload->acc_fname . ' ' . $overload->acc_mname . ' ' . $overload->acc_lname ?></td>
                                      <td><?= date("F j, Y, g:i a", $overload->ou_date_posted) ?></td>
                                      <td>
                                          <?php if ($overload->ou_status == 1) {
                                                    echo "<span class='label label-success'>Approved</span>";
                                                } elseif ($overload->ou_status == 2) {
                                                    echo "<span class='label label-warning'>Pending</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>Denied</span>";
                                                } ?>
                                      </td>
                                      <td><a href="<?= base_url() ?>Admin/underload_view/<?= $overload->ou_stud_number ?>/<?= $overload->ou_term ?>/<?= $overload->ou_year ?>" class="btn btn-warning btn-sm"><span class="fa fa-eye"></span> View</a></td>
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