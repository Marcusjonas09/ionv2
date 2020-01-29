  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <strong>All Curricula</strong>
              <!-- <small>Administrator</small> -->
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i>Administrator</a></li>
              <li class="active">Edit Curriculum</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Horizontal Form -->
          <div class="box box-widget">
              <div class="box-header with-border">
                  <h4 class="box-title">Search Curriculum</h4>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="<?= base_url() ?>Admin/show_curriculum" class="form-horizontal">
                  <div class="box-body">
                      <div class="form-group">
                          <div class="col-sm-12 col-md-4">
                              <input type="text" name="CurriculumCode" class="form-control" placeholder="Curriculum Code">
                          </div>
                          <div class="col-sm-12 col-md-1">
                              <button type="submit" class="btn btn-success pull-right">Search</button>
                          </div>
                      </div>
                  </div>
                  <!-- /.box-body -->
              </form>
          </div>
          <!-- /.box -->
          <?php if (!empty($curr)) : ?>
              <div class="box box-success">
                  <div class="box-header">
                      <h3 class="box-title"><b>Curriculum Code: <?= $currCode ?></b></h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">

                      <table class="table table-bordered table-responsive">
                          <thead class=" bg-success" style="background-color:#00a65a; color:white;">
                              <th class="text-center">COURSE</th>
                              <th class="text-center">COURSE TITLE</th>
                              <th class="text-center">UNITS</th>
                              <th class="text-center">LABORATORY</th>
                              <th class="text-center">UNITS</th>
                              <th class="text-center">PREREQUISITE</th>
                          </thead>

                          <?php for ($y = 1; $y < 5; $y++) : ?>
                              <tr>
                                  <th class="text-center" style="background-color:#00a65a; color:white;" colspan="7"><?= 'YEAR: ' . $y ?></th>
                              </tr>
                              <?php for ($t = 1; $t < 4; $t++) : ?>
                                  <tr>
                                      <th style="background-color:#ccc;" colspan="7"><?= 'Term: ' . $t ?></th>
                                  </tr>

                                  <?php foreach ($curr as $cur) : ?>
                                      <?php if ($cur->Year == $y && $cur->Term == $t) : ?>
                                          <tr>
                                              <td><?= $cur->course_code ?></td>
                                              <td><?= $cur->course_title ?></td>
                                              <td class="text-center"><?= $cur->course_units ?></td>
                                              <td><?= $cur->laboratory_code ?></td>
                                              <td class="text-center"><?= $cur->laboratory_units ?></td>
                                              <td><?= $cur->pr_requisite ?></td>
                                          </tr>
                                      <?php endif; ?>

                                  <?php endforeach; ?>
                              <?php endfor; ?>
                          <?php endfor; ?>
                      </table>
                  </div>
                  <!-- /.box-body -->
              </div>
          <?php endif; ?>
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

















  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <strong>Curriculum</strong>
          </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
          <div class="box box-success">
              <div class="box-header">
                  <h3 class="box-title"><b>Curriculum Code: <?= $this->session->Curriculum_code ?></b></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                  <table class="table table-bordered table-responsive">
                      <thead class=" bg-success" style="background-color:#00a65a; color:white;">
                          <th class="text-center">COURSE</th>
                          <th class="text-center">COURSE TITLE</th>
                          <th class="text-center">UNITS</th>
                          <th class="text-center">LABORATORY</th>
                          <th class="text-center">UNITS</th>
                          <th class="text-center">PREREQUISITE</th>
                      </thead>

                      <?php for ($y = 1; $y < 5; $y++) : ?>
                          <tr>
                              <th class="text-center" style="background-color:#00a65a; color:white;" colspan="7"><?= 'YEAR: ' . $y ?></th>
                          </tr>
                          <?php for ($t = 1; $t < 4; $t++) : ?>
                              <tr>
                                  <th style="background-color:#ccc;" colspan="7"><?= 'Term: ' . $t ?></th>
                              </tr>

                              <?php foreach ($curr as $cur) : ?>
                                  <?php if ($cur->Year == $y && $cur->Term == $t) : ?>
                                      <tr>
                                          <td><?= $cur->course_code ?></td>
                                          <td><?= $cur->course_title ?></td>
                                          <td class="text-center"><?= $cur->course_units ?></td>
                                          <td><?= $cur->laboratory_code ?></td>
                                          <td class="text-center"><?= $cur->laboratory_units ?></td>
                                          <td><?= $cur->pr_requisite ?></td>
                                      </tr>
                                  <?php endif; ?>

                              <?php endforeach; ?>
                          <?php endfor; ?>
                      <?php endfor; ?>
                  </table>
              </div>
              <!-- /.box-body -->
          </div>
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->