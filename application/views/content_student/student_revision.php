  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <strong>Load Revision</strong>
          </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
          <div class="col-md-12">
              <!-- Employee Details Box -->
              <div class="box box-success">
                  <div class="box-header with-border">
                      <h3 class="box-title">Current Load</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                      <table class="table">
                          <thead>
                              <th>STUDENT NO.</th>
                              <th>NAME</th>
                              <th>PROGRAM</th>
                              <th>TERM/YEAR</th>
                          </thead>

                          <tr>
                              <td><?= $this->session->acc_number ?></td>
                              <td><?= $this->session->Firstname . ' ' . $this->session->Lastname ?></td>
                              <td><?= $this->session->Program ?></td>
                              <td><?= 'TERM: ' . $this->session->curr_term . ' SY: ' . $this->session->curr_year ?></td>
                          </tr>
                      </table>
                      <table class="table">
                          <thead class="bg-success" style="background-color:#00a65a; color:white;">
                              <th class="text-center col-md-1">COURSES</th>
                              <th class="text-center col-md-3">TITLE</th>
                              <th class="text-center col-md-1">SECTION</th>
                              <th class="text-center col-md-1">UNITS</th>
                              <th class="text-center col-md-1">DAYS</th>
                              <th class="text-center col-md-3">TIME</th>
                              <th class="text-center col-md-1">ROOM</th>
                              <th class="text-center col-md-1">ACTION</th>
                          </thead>
                          <tbody>
                              <?php foreach ($cor as $record) : ?>
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
                                          <td class="text-center"><?= strtoupper($record->cc_section) ?></td>
                                          <td class="text-center">
                                              <?php if (strtoupper($record->cc_course) == strtoupper($record->course_code)) {
                                                            echo strtoupper($record->course_units);
                                                        } else if (strtoupper($record->cc_course) == strtoupper($record->laboratory_code)) {
                                                            echo strtoupper($record->laboratory_units);
                                                        } else {
                                                            echo '';
                                                        } ?>
                                          </td>
                                          <?php foreach ($offerings as $offering) : ?>
                                              <?php if ($record->cc_course == $offering->offering_course_code && $record->cc_section == $offering->offering_course_section) : ?>
                                                  <td class="text-center"><?= $offering->offering_course_day ?></td>
                                                  <td class="text-center"><?= $offering->offering_course_time ?></td>
                                                  <td></td>

                                              <?php endif; ?>
                                          <?php endforeach; ?>
                                          <td>
                                              <a class="btn btn-danger" href="#"><span class="fa fa-trash"></span></a>
                                          </td>
                                      </tr>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                      <button type="submit" class="btn btn-success pull-right" style="margin-left:10px;">Submit</button>
                      <a href="<?= base_url() ?>Student" class="btn btn-default pull-right">Cancel</a>
                  </div>
                  <!-- /.box-footer -->
              </div>
              <!-- /.box -->
          </div>
  </div>
  </div>
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->