<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/faculties"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
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
            <form action="<?= base_url() ?>SuperAdmin/create_faculty" method="post" enctype="multipart/form-data">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Add New Faculty</strong></h3>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="curr_code">First Name:</label>
                                    <input class="form-control" type="text" name="acc_fname" id="acc_fname" placeholder="Enter first name" value="<?= set_value('acc_fname') ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="curr_code">Middle Name:</label>
                                    <input class="form-control" type="text" name="acc_mname" id="acc_mname" placeholder="Enter middle Name" value="<?= set_value('acc_mname') ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="curr_code">Last Name:</label>
                                    <input class="form-control" type="text" name="acc_lname" id="acc_lname" placeholder="Enter last name" value="<?= set_value('acc_lname') ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="curr_code">Citizenship:</label>
                                    <input class="form-control" type="text" name="acc_citizenship" id="acc_citizenship" placeholder="Enter citizenship" value="<?= set_value('acc_citizenship') ?>">
                                    <input type="hidden" name="acc_status" value="1">
                                    <input type="hidden" name="acc_access_level" value="2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="curr_code">College:</label>
                                    <!-- <input class="form-control" type="text" name="college" id="college" placeholder="Enter college"> -->
                                    <select class="form-control js-example-basic-single" name="acc_college" id="acc_college">
                                        <option value="">--</option>
                                        <?php foreach ($colleges as $college) : ?>
                                            <option value="<?= $college->college_code ?>"><?= $college->college_code . ' - ' . $college->college_description ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="curr_code">Department:</label>
                                    <select class="form-control js-example-basic-single" name="acc_program" id="acc_program">
                                        <option value="">--</option>
                                        <?php foreach ($programs as $program) : ?>
                                            <option value="<?= $program->program_code ?>"><?= $program->program_code . ' - ' . $program->program_description ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>




                            </div>
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
                            <input class="form-control btn btn-default" type="file" name="csv_file" />
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <input class="btn btn-success pull-right" type="submit" name="import" value="Import" />
                </div>
            </div>
        </div>

    </section>
</div>
<!-- /.content-wrapper -->