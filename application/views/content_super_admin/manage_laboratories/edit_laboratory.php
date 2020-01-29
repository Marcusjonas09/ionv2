<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/laboratories"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($success_msg)) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i>Success!</h4>
                <?php echo $success_msg; ?>
            </div>
        <?php endif; ?>
        <div class="container-fluid col-md-9" style="padding-right:0px;">
            <form action="<?= base_url() ?>SuperAdmin/edit_laboratory_function" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Edit laboratory</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="laboratory_code">Laboratory Code:</label>
                                <input class="form-control" type="text" name="laboratory_code" id="laboratory_code" value="<?= $laboratory->laboratory_code ?>" placeholder="Enter laboratory code" required />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="laboratory_units">Units:</label>
                                <input class="form-control" type="number" name="laboratory_units" id="laboratory_units" value="<?= $laboratory->laboratory_units ?>" placeholder="Enter units" required />
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="laboratory_title">Laboratory Title:</label>
                                <input class="form-control" type="text" name="laboratory_title" id="laboratory_title" value="<?= $laboratory->laboratory_title ?>" placeholder="Enter laboratory title" required />
                                <input type="hidden" name="laboratory_id" value="<?= $laboratory->laboratory_id ?>">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" value="Submit" />
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->