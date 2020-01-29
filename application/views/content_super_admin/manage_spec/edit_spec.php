<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/specialization"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
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
            <form action="<?= base_url() ?>SuperAdmin/edit_specialization_function" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Edit specialization</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="curr_code">Code:</label>
                            <input class="form-control" type="text" name="specialization_code" id="specialization_code" value="<?= $specialization->specialization_code ?>" placeholder="Enter code" required />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="curr_code">College:</label>
                            <select class="form-control" name="assigned_program" id="assigned_program">
                                <?php foreach ($programs as $program) : ?>
                                    <option <?php if ($program->program_code == $specialization->assigned_program) {
                                                echo "selected";
                                            } ?> value="<?= $program->program_code ?>"><?= $program->program_code . ' - ' . $program->program_description ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="curr_code">Description:</label>
                            <input class="form-control" type="text" name="specialization_description" id="specialization_description" value="<?= $specialization->specialization_description ?>" placeholder="Enter description" required />
                            <input type="hidden" name="specialization_id" value="<?= $specialization->specialization_id ?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" value="Submit" />
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid col-md-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Insert Multiple Entry</strong></h3>
                </div>
                <div class="box-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Upload CSV file</label>
                            <input class="form-control btn btn-default" type="file" name="facultycsv" />
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <input class="btn btn-success pull-right" type="submit" value="Import" />
                </div>
            </div>
        </div>




    </section>
</div>
<!-- /.content-wrapper -->