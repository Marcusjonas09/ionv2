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
        <?php if (isset($message)) : ?>
            <?php echo $message; ?>
        <?php endif; ?>
        <div class="container-fluid col-md-9" style="padding-right:0px;">
            <form action="<?= base_url() ?>SuperAdmin/create_specialization" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Create specialization</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="curr_code">Code:</label>
                            <input class="form-control" type="text" name="specialization_code" id="specialization_code" placeholder="Enter code" required />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="curr_code">Program:</label>
                            <select class="form-control js-example-basic-single" name="assigned_program" id="assigned_program">
                                <?php foreach ($programs as $program) : ?>
                                    <option value="<?= $program->program_code ?>"><?= $program->program_code . ' - ' . $program->program_description ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="curr_code">Description:</label>
                            <input class="form-control" type="text" name="specialization_description" id="specialization_description" placeholder="Enter description" required />
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
                <form action="<?= base_url() ?>SuperAdmin/add_specialization_csv" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Upload CSV file</label>
                                <input class="form-control btn btn-default" type="file" name="csv_file" />
                            </div>

                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" name="import" value="Import" />
                    </div>
                </form>
            </div>
        </div>




    </section>
</div>
<!-- /.content-wrapper -->