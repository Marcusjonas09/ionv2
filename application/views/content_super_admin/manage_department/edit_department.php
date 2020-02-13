<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/department"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
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
        <div class="container-fluid col-md-9" style="padding:0px;">
            <form action="<?= base_url() ?>SuperAdmin/edit_department_function" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Edit department</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label for="curr_code">Code:</label>
                            <input class="form-control" type="text" name="department_code" id="department_code" value="<?= $department->department_code ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">Description:</label>
                            <input class="form-control" type="text" name="department_description" id="department_description" value="<?= $department->department_description ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">College:</label>
                            <select class="form-control js-example-basic-single" name="assigned_college" id="assigned_college">
                                <option value="">none</option>
                                <?php foreach ($colleges as $college) : ?>
                                    <option value="<?= $college->college_code ?>"><?= $college->college_code . ' - ' . $college->college_description ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" type="text" name="department_id" id="department_id" value="<?= $department->department_id ?>" />
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