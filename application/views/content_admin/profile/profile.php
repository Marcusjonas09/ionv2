  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <strong>My Profile</strong>
          </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
          <?php if (validation_errors()) : ?>
              <div class="alert alert-warning alert-dismissible" role="alert">
                  <?php if (isset($error)) : ?>
                      <p><?php echo $error; ?></p>
                  <?php endif; ?>
                  <p><?php echo validation_errors(); ?></p>
                  <p><?php echo "Click on this box to dismiss."; ?></p>
              </div>
          <?php endif; ?>
          <?php if (isset($success)) : ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                  <p><?php echo $success; ?></p>
                  <p><?php echo "Click on this box to dismiss."; ?></p>
              </div>
          <?php endif; ?>
          <div class="col-md-4">
              <!-- Profile Image -->
              <div class="box box-success">
                  <div class="box-body box-profile">
                      <img class="profile-user-img img-responsive img-circle" src="<?= base_url() ?>dist/img/default_avatar.png" style="width:200px; height:200px;" alt="User profile picture">
                      <br />
                      <h3 class="profile-username text-center"><?= $account->acc_fname . ' ' . $account->acc_mname . ' ' . $account->acc_lname ?></h3>

                      <p class="text-muted text-center">Program Director</p>

                  </div>
                  <!-- /.box-body -->
              </div>
              <!-- /.box -->
              <!-- Employee Details Box -->
              <div class="box box-success">
                  <div class="box-header with-border">
                      <h3 class="box-title">Student Details</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <table class="table">
                          <tr>
                              <td><strong class="pull-right">Employee No: </strong></td>
                              <td><?= $account->acc_number ?></td>
                          </tr>
                          <tr>
                              <td><strong class="pull-right">Designation: </strong></td>
                              <td><?= $account->acc_program ?></td>
                          </tr>
                      </table>
                  </div>
                  <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>

          <div class="col-md-8">
              <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                      <li class="active"><a href="#studInfo" data-toggle="tab">Basic Information</a></li>
                      <li><a href="#settings" data-toggle="tab">Settings</a></li>
                      <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li> -->
                  </ul>
                  <div class="tab-content">
                      <div class="active tab-pane" id="studInfo">
                          <div class="container-fluid">
                              <strong>First Name : </strong><?= $account->acc_fname ?><br /><br />
                              <strong>Middle Name: </strong><?= $account->acc_mname ?><br /><br />
                              <strong>Last Name: </strong><?= $account->acc_lname ?><br /><br />
                              <strong>Username: </strong><?= $account->acc_username ?>
                          </div>
                      </div>

                      <div class="tab-pane" id="settings">
                          <div class="container-fluid">

                              <form action="<?= base_url() ?>Admin/changepass" method="post">
                                  <h3><strong>Change Password</strong></h3>
                                  <div class="form-group col-md-4">
                                      <label>Old password</label>
                                      <input type="password" class="form-control" name="oldpassword" placeholder="Enter old password">
                                  </div>
                                  <div class="form-group col-md-4">
                                      <label>New password</label>
                                      <input type="password" class="form-control" name="newpassword" placeholder="Enter new password">
                                  </div>
                                  <div class="form-group col-md-4">
                                      <label>Retype new password</label>
                                      <input type="password" class="form-control" name="renewpassword" placeholder="Retype new password">
                                  </div>
                                  <button id="change_pass" class="btn btn-success pull-right col-md-2">Save</button>
                              </form>
                          </div>
                      </div>

                  </div>
                  <!-- /.tab-content -->
              </div>
              <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
  </div>
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->