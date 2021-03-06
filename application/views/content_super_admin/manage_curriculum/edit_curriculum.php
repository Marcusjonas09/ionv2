<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/curriculum"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
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
        <div class="container-fluid col-md-8" style="padding:0px;">
            <form action="<?= base_url() ?>SuperAdmin/edit_curriculum_function" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Edit curriculum</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label for="curr_code">Code:</label>
                            <input class="form-control" type="text" name="curriculum_code" id="curriculum_code" value="<?= $curriculum->curriculum_code ?>" />
                        </div>

                        <div class="form-group col-md-8">
                            <label for="curr_code">Department:</label>
                            <select class="form-control js-example-basic-single" name="assigned_department" id="assigned_department">
                                <?php foreach ($departments as $department) : ?>
                                    <option <?php if ($department->department_code == $curriculum->assigned_department) {
                                                echo "selected";
                                            } ?> value="<?= $department->department_code ?>"><?= $department->department_code . ' - ' . $department->department_description ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="curriculum_code" value="<?= $curriculum->curriculum_code ?>">
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" value="Update" />
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->