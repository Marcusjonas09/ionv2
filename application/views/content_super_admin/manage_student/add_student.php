<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>Superadmin/student"><span class="fa fa-chevron-left"></span>&nbsp&nbsp</a>Add Student Entry</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="container-fluid col-md-9" style="padding-right:0px;">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Insert Single Entry</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-6">
                            <label for="curr_code">Student Number:</label>
                            <input class="form-control" type="number" name="stud_number" id="stud_number" placeholder="Enter student Number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="curr_code">Program:</label>
                            <!-- <input class="form-control" type="text" name="program" id="program" placeholder="Enter program"> -->
                            <select class="form-control" name="program" id="program">
                                <option value="--">--</option>
                                <option value="BSITWMA">BSITWMA</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="curr_code">College:</label>
                            <!-- <input class="form-control" type="text" name="college" id="college" placeholder="Enter college"> -->
                            <select class="form-control" name="college" id="college">
                                <option value="--">--</option>
                                <option value="Computer Studies">Computer Studies</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="curr_code">Curriculum:</label>
                            <!-- <input class="form-control" type="text" name="curr_code" id="curr_code" placeholder="Enter curriculum code"> -->
                            <select class="form-control" name="curr_code" id="curr_code">
                                <option value="--">--</option>
                                <option value="BSITWMA2015">BSITWMA2015</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">First Name:</label>
                            <input class="form-control" type="text" name="fname" id="fname" placeholder="Enter first name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">Middle Name:</label>
                            <input class="form-control" type="text" name="mname" id="mname" placeholder="Enter middle Name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">Last Name:</label>
                            <input class="form-control" type="text" name="lname" id="lname" placeholder="Enter last name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="curr_code">Citizenship:</label>
                            <input class="form-control" type="text" name="citizenship" id="citizenship" placeholder="Enter citizenship">
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