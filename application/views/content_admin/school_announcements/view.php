  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <a class="navi" href="<?= base_url() ?>Admin/school_announcements"><span class="fa fa-chevron-left"></span></a>&nbsp&nbsp<strong>View Announcement</strong>
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
                                  <?php if (!$post_edited) : ?>
                                      <span class="description">Shared publicly - <?= date('F j, Y - g:i:a', $post_created) ?></span>
                                  <?php else : ?>
                                      <span class="description">Edited - <?= date('F j, Y - g:i:a', $post_edited) ?></span>
                                  <?php endif; ?>
                              </div>
                              <!-- /.user-block -->
                              <div class="box-tools">
                                  <div class="btn-group">
                                      <span class="btn dropdown-toggle" data-toggle="dropdown">
                                          <span class="fa fa-ellipsis-h"></span>
                                      </span>
                                      <ul class="dropdown-menu">
                                          <li><a href="<?= base_url() ?>Admin/delete_post/<?= $post_id ?>">Delete Post</a></li>
                                          <li><a href="<?= base_url() ?>Admin/edit_post/<?= $post_id ?>">Edit Post</a></li>
                                      </ul>
                                  </div>
                              </div>
                              <!-- /.box-tools -->
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                              <pre><?= word_wrap($post_caption, 70); ?></pre>
                              <?php if (!empty($post_image)) : ?>
                                  <img class="img-responsive pad col-md-6 col-md-offset-3" src="<?= base_url() ?>images/posts/processed/<?= $post_image ?>" alt="Photo">
                              <?php endif; ?>
                          </div>
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