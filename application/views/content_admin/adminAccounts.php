  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin Accounts
        <small>Manage accounts</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Administrator</a></li>
        <li class="active">Accounts</li>
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
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                  <th>EMP No.</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Action</th>
                </thead>
                <?php foreach ($admins as $admin) : ?>
                  <tr>
                    <td><?= $admin->acc_number ?></td>
                    <td><?= $admin->acc_lname . ', ' . $admin->acc_fname ?></td>
                    <td><?= $admin->acc_username ?></td>
                    <td>
                      <a href="#" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i></a>
                      <a href="#" class="btn btn-danger btn-sm rounded"><i class="fa fa-ban"></i></a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </table>
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