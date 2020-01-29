  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              <strong>School Announcements</strong>
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
                              <span class="username">
                                  <strong>Create Announcement</strong>
                              </span>
                              <!-- /.box-tools -->
                          </div>
                          <!-- /.box-header -->
                          <div class="box-body">
                              <div class="user-block">
                                  <div class="col">
                                      <img class="img-circle" src="<?= base_url() ?>dist/img/default_avatar.png" alt="User Image">
                                  </div>
                                  <div class="col-md-11">
                                      <form action="<?= base_url() ?>Admin/announce" method="post" enctype="multipart/form-data">
                                          <div class="form-group">
                                              <textarea name="caption" style="resize:none;" class="textarea form-control" rows="5" placeholder="Your announcement!"></textarea>
                                          </div>

                                          <div class="form-group">
                                              <label for="attachment">Upload image</label>
                                              <input type="file" name="attachment">
                                              <button class="btn btn-success pull-right col-md-2" type="submit" value="submit"><strong>Post</strong></button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /.box -->
                  </div>
                  <!-- /.col -->
              </div>
              <!-- /.row -->
              <?php foreach ($posts as $post) : ?>
                  <div class="row">
                      <div class="col">
                          <!-- Box Comment -->
                          <div class="box box-widget">
                              <div class="box-header with-border">
                                  <div class="user-block">
                                      <img class="img-circle" src="<?= base_url() ?>dist/img/default_avatar.png" alt="User Image">
                                      <span class="username"><a href="#"><?= $post->acc_fname . " " . $post->acc_lname ?></a></span>
                                      <?php if (!$post->post_edited) : ?>
                                          <span class="description">Shared publicly - <?= date('F j, Y - g:i:a', $post->post_created) ?></span>
                                      <?php else : ?>
                                          <span class="description">Edited - <?= date('F j, Y - g:i:a', $post->post_edited) ?></span>
                                      <?php endif; ?>
                                  </div>
                                  <!-- /.user-block -->
                                  <div class="box-tools">
                                      <div class="btn-group">
                                          <span class="btn dropdown-toggle" data-toggle="dropdown">
                                              <span class="fa fa-ellipsis-h"></span>
                                          </span>
                                          <ul class="dropdown-menu">
                                              <li><a href="<?= base_url() ?>Admin/fetch_post/<?= $post->post_id ?>">View</a></li>
                                              <li><a href="<?= base_url() ?>Admin/edit_post/<?= $post->post_id ?>">Edit</a></li>
                                              <li><a href="<?= base_url() ?>Admin/delete_post/<?= $post->post_id ?>">Delete</a></li>
                                          </ul>
                                      </div>
                                  </div>
                                  <!-- /.box-tools -->
                              </div>
                              <!-- /.box-header -->
                              <div class="box-body">
                                  <?php if (!empty($post->post_caption)) : ?>
                                      <pre><?= word_limiter($post->post_caption, 8, '<a href=' . base_url() . 'Admin/fetch_post/' . $post->post_id . '> see more ...<a>'); ?></pre>
                                  <?php endif; ?>
                                  <?php if (!empty($post->post_image)) : ?>
                                      <img class="img-responsive pad col-md-6 col-md-offset-3" src="<?= base_url() ?>images/posts/processed/<?= $post->post_image ?>" alt="Photo">
                                  <?php endif; ?>
                              </div>
                          </div>
                          <!-- /.box -->
                      </div>
                      <!-- /.col -->
                  </div>
                  <!-- /.row -->
              <?php endforeach; ?>
          </div>


      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->