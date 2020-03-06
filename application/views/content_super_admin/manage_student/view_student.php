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
        <div class="container-fluid col-md-12" style="padding:0px;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Student details</strong></h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="curr_code">Student Number:</label>
                            <input disabled class="form-control" type="text" value="<?= $student->acc_number ?>" placeholder="Enter student Number">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">College:</label>
                            <input disabled class="form-control" type="text" value="<?= $student->acc_college ?>" placeholder="Enter college">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">Program:</label>
                            <input disabled class="form-control" type="text" value="<?= $student->acc_program . '' . $student->acc_specialization ?>" placeholder="Enter college">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="curr_code">Full Name:</label>
                            <input disabled class="form-control" type="text" value="<?= strtoupper($student->acc_lname . ', ' . $student->acc_fname . ' ' . $student->acc_mname) ?>" placeholder="Enter first name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">Citizenship:</label>
                            <input disabled class="form-control" type="text" value="<?= $student->acc_citizenship ?>" placeholder="Enter citizenship">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">Curriculum:</label>
                            <input disabled class="form-control" type="text" name="curr_code" id="curr_code" value="<?= $student->curriculum_code ?>" placeholder="Enter first name">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid col-md-12" style="padding:0px;">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Current Course Load</strong></h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Section</th>
                            <th>Day</th>
                            <th>Time</th>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->