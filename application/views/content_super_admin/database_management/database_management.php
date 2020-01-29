<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Database Queries</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="nav-tabs-custom tab-success">
            <ul class="nav nav-tabs" style="color:#161616;">
                <li class="active"><a href="#faculty" data-toggle="tab"><strong>Faculty</strong></a></li>
                <li><a href="#curriculum" data-toggle="tab"><strong>Curriculum</strong></a></li>
                <li><a href="#course" data-toggle="tab"><strong>Course</strong></a></li>
                <li><a href="#laboratory" data-toggle="tab"><strong>Laboratory</strong></a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="faculty">
                    <div class="container-fluid">
                        <table class="datatables table table-bordered text-center" data-page-length='10'>
                            <thead class="bg-success" style="background-color:#00a65a; color:white;">
                                <th class="text-center col-md-4">Emp ID</th>
                                <th class="text-center col-md-4">Full Name</th>
                                <th class="text-center col-md-4">Department</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="container-fluid col-md-4" style="padding:0px;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Upload CSV file</strong></h3>
                                </div>
                                <div class="box-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input class="btn btn-default" type="file" name="facultycsv" />
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <input class="btn btn-success pull-right" type="submit" value="Import" />
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid col-md-8" style="padding-right:0px;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Insert Single Entry</strong></h3>
                                </div>
                                <div class="box-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="curr_code">Curriculum Code</label>
                                            <input class="form-control" type="text" name="curr_code" id="curr_code">
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <input class="btn btn-success pull-right" type="submit" value="Save" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="curriculum">
                    <div class="container-fluid">
                        <table class="datatables table table-bordered text-center" data-page-length='10'>
                            <thead class="bg-success" style="background-color:#00a65a; color:white;">
                                <th class="text-center col-md-4">Curriculum Code</th>
                                <th class="text-center col-md-4">Curriculum Description</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="container-fluid col-md-4" style="padding:0px;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Upload CSV file</strong></h3>
                                </div>
                                <div class="box-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input class="btn btn-default" type="file" name="facultycsv" />
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <input class="btn btn-success pull-right" type="submit" value="Import" />
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid col-md-8" style="padding-right:0px;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Insert Single Entry</strong></h3>
                                </div>
                                <div class="box-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="curr_code">Curriculum Code</label>
                                            <input class="form-control" type="text" name="curr_code" id="curr_code">
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <input class="btn btn-success pull-right" type="submit" value="Save" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="course">
                    <div class="container-fluid">
                        <table class="datatables table table-bordered text-center" data-page-length='10'>
                            <thead class="bg-success" style="background-color:#00a65a; color:white;">
                                <th class="text-center col-md-4">Course Code</th>
                                <th class="text-center col-md-4">Course Description</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="container-fluid col-md-4" style="padding:0px;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Upload CSV file</strong></h3>
                                </div>
                                <div class="box-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input class="btn btn-default" type="file" name="facultycsv" />
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <input class="btn btn-success pull-right" type="submit" value="Import" />
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid col-md-8" style="padding-right:0px;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Insert Single Entry</strong></h3>
                                </div>
                                <div class="box-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="curr_code">Curriculum Code</label>
                                            <input class="form-control" type="text" name="curr_code" id="curr_code">
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <input class="btn btn-success pull-right" type="submit" value="Save" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="laboratory">
                    <div class="container-fluid">
                        <table class="datatables table table-bordered text-center" data-page-length='10'>
                            <thead class="bg-success" style="background-color:#00a65a; color:white;">
                                <th class="text-center col-md-4">Laboratory Code</th>
                                <th class="text-center col-md-4">Laboratory Description</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="container-fluid col-md-4" style="padding:0px;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Upload CSV file</strong></h3>
                                </div>
                                <div class="box-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input class="btn btn-default" type="file" name="facultycsv" />
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <input class="btn btn-success pull-right" type="submit" value="Import" />
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid col-md-8" style="padding-right:0px;">
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>Insert Single Entry</strong></h3>
                                </div>
                                <div class="box-body">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="curr_code">Curriculum Code</label>
                                            <input class="form-control" type="text" name="curr_code" id="curr_code">
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer">
                                    <input class="btn btn-success pull-right" type="submit" value="Save" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
        <div class="box box-success">

            <!-- /.box-header -->
            <div class="box-body">
                <a class="btn btn-danger" href="<?= base_url() ?>SuperAdmin/empty_petitions">DELETE PETITIONS</a>
                <a class="btn btn-danger" href="<?= base_url() ?>SuperAdmin/empty_notifications">DELETE NOTIFICATIONS</a>
                <a class="btn btn-danger" href="<?= base_url() ?>SuperAdmin/empty_overload_underload">DELETE OVERLOAD/UNDERLOAD</a>
            </div>
            <!-- /.box-body -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->