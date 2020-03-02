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
        <div class="container-fluid col-md-9" style="padding-right:0px;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Faculty details</strong></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label for="curr_code">Employee Number:</label>
                                <input disabled class="form-control" type="number" name="stud_number" id="stud_number" value="<?= $faculty->acc_number ?>" placeholder="Enter faculty Number">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">First Name:</label>
                                <input disabled class="form-control" type="text" name="acc_fname" id="acc_fname" value="<?= $faculty->acc_fname ?>" placeholder="Enter first name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">Middle Name:</label>
                                <input disabled class="form-control" type="text" name="acc_mname" id="acc_mname" value="<?= $faculty->acc_mname ?>" placeholder="Enter middle Name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">Last Name:</label>
                                <input disabled class="form-control" type="text" name="acc_lname" id="acc_lname" value="<?= $faculty->acc_lname ?>" placeholder="Enter last name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">Citizenship:</label>
                                <input disabled class="form-control" type="text" name="citizenship" id="citizenship" value="<?= $faculty->acc_citizenship ?>" placeholder="Enter citizenship">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <label for="curr_code">College:</label>
                                <input disabled class="form-control" type="text" name="college" id="college" value="<?= $faculty->acc_college ?>" placeholder="Enter college">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="curr_code">Department:</label>
                                <input disabled class="form-control" type="text" name="program" id="program" value="<?= $faculty->acc_program ?>" placeholder="Enter program">
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