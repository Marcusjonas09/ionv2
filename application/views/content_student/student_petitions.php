<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <strong>Petition Courses</strong>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <?php if (isset($success_msg)) : ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <p><?php echo $success_msg; ?></p>
        <p><?php echo "Click on this box to dismiss."; ?></p>
      </div>
    <?php endif; ?>

    <?php if (isset($error_msg)) : ?>
      <div class="alert alert-warning alert-dismissible" role="alert">
        <p><?php echo $error_msg; ?></p>
        <p><?php echo "Click on this box to dismiss."; ?></p>
      </div>
    <?php endif; ?>
    <div id="client" class='alert alert-success alert-dismissible' style='display:none;' role='alert'></div>
    <div class="box box-success col-md-12">
      <div class="box-header with-border">
        <h3 class="box-title">Submit Petition</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="<?= base_url() ?>Student/submitPetition" method="POST">
        <div class="box-body">

          <?php if (validation_errors()) : ?>
            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-warning"></i> Alert!</h4>
              <?php echo validation_errors(); ?>
            </div>
          <?php endif; ?>

          <div class="form-group">
            <label class="col-md-2 control-label">Course Code</label>
            <div class="form-group col-md-6">
              <select id="course_code" name="course_code" class="form-control js-example-basic-single">
                <?php foreach ($petition_suggestions as $petition_suggestion) : ?>
                  <?php if ($petition_suggestion->course_code) : ?>
                    <option value="<?= $petition_suggestion->course_code ?>"><?= $petition_suggestion->course_code . " - " . $petition_suggestion->course_title ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <!-- id="submit_petition" -->
            <button type="submit" class="btn btn-success" style="margin-left:10px;">Submit</button>
            <!-- </div> -->
          </div>
        </div>
        <!-- /.box-body -->
      </form>
    </div>
    <!-- /.box -->

    <!-- Table showing all petitions related to this student account -->
    <div class="col-md-6" style="padding-left:0px;">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">My Petitions</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-striped">
            <thead>
              <th>Course</th>
              <th>Slots</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php foreach ($petitions as $petition) : ?>
                <tr>
                  <td>
                    <strong><?= $petition->course_code ?></strong>
                    <?php foreach ($courses as $course) : ?>
                      <?php if ($petition->course_code == $course->course_code) : ?>
                        </p><small><?= $course->course_title ?></small></p>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </td>

                  <td>
                    <?= $petition->petitioner_count . '/40' ?>
                  </td>

                  <td>
                    <?php if ($petition->petition_status == 1) {
                      echo "<span class='label label-success col-md-12'>Approved</span>";
                    } elseif ($petition->petition_status == 2) {
                      echo "<span class='label label-warning col-md-12'>Pending</span>";
                    } else {
                      echo "<span class='label label-danger col-md-12'>Denied</span>";
                    } ?>
                  </td>
                  <td>
                    <a href="<?= base_url() ?>Student/petitionView/<?= $petition->petition_ID ?>/<?= $petition->petition_unique ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <div class="col-md-6"><?= $this->pagination->create_links(); ?></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <div class="container-fluid col-md-6" style="padding-right:0px;">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">Suggested Petitions</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-striped">
            <thead>
              <th>Course</th>
              <th>Slots</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php foreach ($petitions_available as $petition_available) : ?>
                <?php if ($petition_available->petition_status == 2) : ?>
                  <tr>
                    <td>
                      <strong><?= $petition_available->course_code ?></strong>
                      <?php foreach ($courses as $course) : ?>
                        <?php if ($petition_available->course_code == $course->course_code) : ?>
                          </p><small><?= $course->course_title ?></small></p>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </td>

                    <td>
                      <?= $petition_available->petitioner_count . '/40' ?>
                    </td>

                    <td>
                      <?php if ($petition_available->petition_status == 1) {
                        echo "<span class='label label-success col-md-12'>Approved</span>";
                      } elseif ($petition_available->petition_status == 2) {
                        echo "<span class='label label-warning col-md-12'>Pending</span>";
                      } else {
                        echo "<span class='label label-danger col-md-12'>Denied</span>";
                      } ?>
                    </td>
                    <td>
                      <a href="<?= base_url() ?>Student/petitionView/<?= $petition_available->petition_ID ?>/<?= $petition_available->petition_unique ?>" class="btn btn-warning btn-sm rounded"><i class="fa fa-eye"></i></a>
                    </td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
          <!-- <div class="col-md-6"><?= $this->pagination->create_links(); ?></div> -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->