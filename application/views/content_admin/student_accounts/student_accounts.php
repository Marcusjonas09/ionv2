  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <strong>Student Accounts</strong>
        <small>Manage accounts</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">Student Accounts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Students</h3> -->

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <!-- <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div> -->
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="datatables table table-bordered table-hover table-responsive" data-page-length='20'>
                <thead>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Curriculum</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php foreach ($students as $student) : ?>
                    <tr>
                      <td><?= $student->acc_number ?></td>
                      <td><?= $student->acc_lname . ', ' . $student->acc_fname ?></td>
                      <td><?= $student->acc_username ?></td>
                      <td><?= $student->curriculum_code ?></td>
                      <td>
                        <!-- <a href="<?= base_url() ?>Admin/show_account/<?= $student->acc_number ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i></a>
                      <?php if ($student->acc_status) {
                        echo '<a href="' . base_url() . 'Admin/block_user/' . $student->acc_number . '" class="btn btn-danger btn-sm rounded"><i class="fa fa-ban"></i></a>';
                      } else {
                        echo '<a href="' . base_url() . 'Admin/block_user/' . $student->acc_number . '" class="btn btn-success btn-sm rounded"><i class="fa fa-check"></i></a>';
                      }; ?> -->


                        <a href="<?= base_url() ?>Admin/show_account/<?= $student->acc_number ?>/<?= $student->curriculum_code ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i></a>
                        <?php if ($student->acc_status) {
                          echo '<a href="' . base_url() . 'Admin/block_user/' . $student->acc_number . '" class="btn btn-danger btn-sm rounded"><i class="fa fa-ban"></i></a>';
                        } else {
                          echo '<a href="' . base_url() . 'Admin/block_user/' . $student->acc_number . '" class="btn btn-success btn-sm rounded"><i class="fa fa-check"></i></a>';
                        }; ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <div class="col-md-6"><?= $this->pagination->create_links(); ?></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->