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









  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog bd-example-modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Update Calendar Event</h3>
      </div>
      <div class="modal-body">
        <?php echo form_open(site_url(""), array("class" => "form-horizontal")) ?>

        <div class="output"></div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Event Name</label>
          <div class="col-md-8 ui-front ">
            <input type="text" class="form-control" name="name" id="editname" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Description</label>
          <div class="col-md-8 ui-front">
            <textarea id="editdescription" rows="8" class="col-md-12" name="description" disabled></textarea>
            <!-- <input type="text" class="form-control" name="description" id="editdescription" readonly> -->
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Start Date</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="start_date" id="start_date" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">End Date</label>
          <div class="col-md-8">
            <input required type="text" class="form-control" name="end_date" id="end_date" readonly>
          </div>
        </div>
        <input type="hidden" name="eventid" id="event_id" value="0" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>