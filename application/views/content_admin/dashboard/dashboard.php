<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <strong>Dashboard</strong>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3 id="petition_number">0</h3>

          <p>Pending Petitions</p>
        </div>
        <div class="icon">
          <!-- <i class="fa fa-envelope-o"></i> -->
        </div>
        <a href="<?= base_url() ?>Admin/course_petitions" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3 id="underload_number">0</h3>

          <p>Pending Underload Request/s</p>
        </div>
        <div class="icon">
          <!-- <i class="fa fa-shopping-cart"></i> -->
        </div>
        <a href="<?= base_url() ?>Admin/underload" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3 id="overload_number">0</h3>

          <p>Pending Overload Request/s</p>
        </div>
        <div class="icon">
          <!-- <i class="fa fa-shopping-cart"></i> -->
        </div>
        <a href="<?= base_url() ?>Admin/overload" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3 id="simul_number">0</h3>

          <p>Pending Simul Request/s</p>
        </div>
        <div class="icon">
          <!-- <i class="fa fa-shopping-cart"></i> -->
        </div>
        <a href="<?= base_url() ?>Admin/simul" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->