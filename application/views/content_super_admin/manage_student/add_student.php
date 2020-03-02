<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/students"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
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
        <div class="container-fluid col-md-9" style="padding:0px;">
            <form action="<?= base_url() ?>SuperAdmin/create_student" method="post" enctype="multipart/form-data">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Add New Student</strong></h3>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="curr_code">Student Number:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><?= substr($current_sy->school_year, 0, 4) . $current_sy->school_term ?></span>
                                        <input type="number" name="acc_number" class="form-control" placeholder="Student Number">
                                    </div>
                                    <!-- <input class="form-control" type="number" name="acc_number" id="acc_number" placeholder="Enter student Number"> -->
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="curr_code">First Name:</label>
                                    <input class="form-control" type="text" name="acc_fname" id="acc_fname" placeholder="Enter first name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="curr_code">Middle Name:</label>
                                    <input class="form-control" type="text" name="acc_mname" id="acc_mname" placeholder="Enter middle Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="curr_code">Last Name:</label>
                                    <input class="form-control" type="text" name="acc_lname" id="acc_lname" placeholder="Enter last name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="curr_code">Citizenship:</label>
                                    <input class="form-control" type="text" name="acc_citizenship" id="acc_citizenship" placeholder="Enter citizenship">
                                    <input type="hidden" name="acc_status" value="1">
                                    <input type="hidden" name="acc_access_level" value="3">
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
                                <div class="form-group col-md-6">
                                    <label for="curr_code">Program:</label>
                                    <select class="form-control js-example-basic-single" name="acc_program" id="acc_program">
                                        <option value="">--</option>
                                        <?php foreach ($programs as $program) : ?>
                                            <option value="<?= $program->program_code ?>"><?= $program->program_code . ' - ' . $program->program_description ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="curr_code">Specialization:</label>
                                    <select class="form-control js-example-basic-single" name="acc_specialization" id="acc_specialization">
                                        <option value="">--</option>
                                        <?php foreach ($specs as $spec) : ?>
                                            <option value="<?= $spec->specialization_code ?>"><?= $spec->specialization_code . ' - ' . $spec->specialization_description ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="curr_code">Curriculum:</label>
                                    <select class="form-control js-example-basic-single" name="curriculum_code" id="curriculum_code">
                                        <option value="">--</option>
                                        <?php foreach ($curricula as $curriculum) : ?>
                                            <option value="<?= $curriculum->curriculum_code ?>"><?= $curriculum->curriculum_code ?></option>
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

        <div class="container-fluid col-md-3" style="padding-right:0px;">
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