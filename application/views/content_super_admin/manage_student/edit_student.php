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
        <div class="container-fluid col-md-9" style="padding:0px;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Student details</strong></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label for="curr_code">Student Number:</label>
                                <input disabled class="form-control" type="number" name="stud_number" id="stud_number" value="<?= $student->acc_number ?>" placeholder="Enter student Number">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">First Name:</label>
                                <input disabled class="form-control" type="text" name="acc_fname" id="acc_fname" value="<?= $student->acc_fname ?>" placeholder="Enter first name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">Middle Name:</label>
                                <input disabled class="form-control" type="text" name="acc_mname" id="acc_mname" value="<?= $student->acc_mname ?>" placeholder="Enter middle Name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">Last Name:</label>
                                <input disabled class="form-control" type="text" name="acc_lname" id="acc_lname" value="<?= $student->acc_lname ?>" placeholder="Enter last name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">Citizenship:</label>
                                <input disabled class="form-control" type="text" name="citizenship" id="citizenship" value="<?= $student->acc_citizenship ?>" placeholder="Enter citizenship">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label for="curr_code">College:</label>
                                <input disabled class="form-control" type="text" name="college" id="college" value="<?= $student->acc_college ?>" placeholder="Enter college">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="curr_code">Program:</label>
                                <input disabled class="form-control" type="text" name="program" id="program" value="<?= $student->acc_program ?>" placeholder="Enter program">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="curr_code">Program:</label>
                                <input disabled class="form-control" type="text" name="specialization" id="specialization" value="<?= $student->acc_specialization ?>" placeholder="Enter program">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">Curriculum:</label>
                                <input disabled class="form-control" type="text" name="curr_code" id="curr_code" value="<?= $student->curriculum_code ?>" placeholder="Enter first name">
                            </div>
                        </div>
                    </div>



                </div>
                <div class="box-footer">
                    <!-- <input class="btn btn-success pull-right" type="submit" value="Submit" /> -->
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->