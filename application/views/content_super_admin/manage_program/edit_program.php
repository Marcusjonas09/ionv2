<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/program"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
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
            <form action="<?= base_url() ?>SuperAdmin/edit_program_function" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Edit program</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="curr_code">Code:</label>
                            <input class="form-control" type="text" name="program_code" id="program_code" value="<?= $program->program_code ?>" placeholder="Enter code" required />
                        </div>

                        <div class="form-group col-md-6">
                            <!-- <label for="curr_code">College:</label>
                            <select class="form-control" name="assigned_college" id="assigned_college">
                                <?php foreach ($colleges as $college) : ?>
                                    <option <?php if ($college->college_code == $program->assigned_college) {
                                                echo "selected";
                                            } ?> value="<?= $college->college_code ?>"><?= $college->college_code . ' - ' . $college->college_description ?></option>
                                <?php endforeach; ?>
                            </select> -->
                            <label for="curr_code">Department:</label>
                            <select class="form-control js-example-basic-single" name="assigned_department" id="assigned_department">
                                <?php foreach ($departments as $department) : ?>
                                    <option value="<?= $department->department_code ?>"><?= $department->department_code . ' - ' . $department->department_description ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="curr_code">Description:</label>
                            <input class="form-control" type="text" name="program_description" id="program_description" value="<?= $program->program_description ?>" placeholder="Enter description" required />
                        </div>
                        <input type="hidden" type="text" name="program_id" id="program_id" value="<?= $program->program_id ?>" />
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