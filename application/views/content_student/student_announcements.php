  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <strong>School Announcements</strong>
          </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
          <div class="col-md-5" style="padding-left: 0px;">
              <div class="box box-solid">
                  <div class="box-body">
                      <!-- THE CALENDAR -->
                      <div id="calendar"></div>
                  </div>
                  <!-- /.box-body -->
              </div>
              <!-- /. box -->
          </div>
          <!-- /.col -->
          <div class="col-md-7 pre-scrollable bg-gray" style="max-height:800px; padding:30px; padding-top:15px; ">
              <?php if ($announcements) : ?>
                  <?php foreach ($announcements as $announcement) : ?>
                      <div class="row">
                          <div class="col">
                              <!-- Box Comment -->
                              <div class="box box-widget">
                                  <div class="box-header with-border">
                                      <div class="user-block">
                                          <img class="img-circle" src="<?= base_url() ?>dist/img/default_avatar.png" alt="User Image">
                                          <span class="username"><a href="#"><?= $announcement->acc_fname . ' ' . $announcement->acc_lname ?></a></span>

                                          <?php if (!$announcement->post_edited) : ?>
                                              <span class="description">Shared publicly - <?= date('F j, Y - g:i:a', $announcement->post_created) ?></span>
                                          <?php else : ?>
                                              <span class="description">Edited - <?= date('F j, Y - g:i:a', $announcement->post_edited) ?></span>
                                          <?php endif; ?>
                                      </div>
                                      <!-- /.user-block -->

                                  </div>
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                      <p><?= word_limiter($announcement->post_caption, 30, '<a href=' . base_url() . 'Post/announcement/' . $announcement->post_id . '> ... see more<a>'); ?></p>
                                      <?php if (!empty($announcement->post_image)) : ?>
                                          <img class="img-responsive pad col-md-6 col-md-offset-3" src="<?= base_url() ?>images/posts/processed/<?= $announcement->post_image ?>" alt="Photo">
                                      <?php endif; ?>

                                  </div>

                              </div>
                              <!-- /.box -->
                          </div>
                          <!-- /.col -->
                      </div>
                      <!-- /.row -->
                  <?php endforeach; ?>
              <?php else : ?>
                  <div class="box box-widget">
                      <div class="box-header with-border">
                          <h3 class="text-center">No Announcements for Today</h3>
                      </div>
                  </div>
              <?php endif; ?>
          </div>

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->