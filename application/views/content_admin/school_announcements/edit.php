  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <a class="navi" href="<?= base_url() ?>Admin/school_announcements"><span class="fa fa-chevron-left"></span></a>&nbsp&nbsp<strong>Edit Announcement</strong>
              <small>Administrator</small>
          </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
          <div class="col-md-6">
              <div class="row">
                  <div class="col">
                      <!-- Box Comment -->
                      <div class="box box-widget">
                          <div class="box-header with-border">
                              <div class="user-block">
                                  <img class="img-circle" src="<?= base_url() ?>dist/img/default_avatar.png" alt="User Image">
                                  <span class="username"><a href="#"><?= $acc_fname . " " . $acc_lname ?></a></span>
                                  <span class="description">Shared publicly - <?= date('F j, Y - g:i:a', $post_created) ?></span>
                              </div>
                              <!-- /.user-block -->
                              <div class="box-tools">
                                  <a href="<?= base_url() ?>Admin/delete_post/<?= $post_id ?>"><span class="fa fa-close"></span></a>
                              </div>
                              <!-- /.box-tools -->
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                              <form action="<?= base_url() ?>Admin/update_post/<?= $post_id ?>" method="post" enctype="multipart/form-data">
                                  <div class="form-group">
                                      <textarea name="caption" style="resize:none;" class="form-control" rows="3" placeholder="Your announcement!"><?= $post_caption ?></textarea>
                                  </div>
                                  <?php if (!empty($post_image)) : ?>
                                      <div class="container-fluid" style="background-color:gray;">
                                          <img class="img-responsive pad col-md-6 col-md-offset-3" src="<?= base_url() ?>images/posts/processed/<?= $post_image ?>" alt="Photo">
                                      </div>
                                  <?php endif; ?>
                          </div>
                          <div class="container">
                              <div class="form-group">
                                  <label for="attachment">Upload image</label>
                                  <input type="file" name="attachment">
                              </div>
                          </div>

                          <div class="box-footer">
                              <button class="btn btn-success pull-right col-md-2" type="submit" value="submit"><strong>Save</strong></button>
                              <a href="<?= base_url() ?>Admin/school_announcements" class="btn btn-default pull-right col-md-2" style="margin-right:10px;" type="submit" value="submit"><strong>Cancel</strong></a>
                          </div>
                          </form>
                      </div>
                  </div>
                  <!-- /.col -->
              </div>
              <!-- /.row -->
          </div>
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->