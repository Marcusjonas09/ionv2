<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong><a class="navi" href="<?= base_url() ?>SuperAdmin/finances"><span class="fa fa-chevron-left"></span>&nbsp&nbspBack</a></strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <?php if (validation_errors()) : ?>
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Warning!</h4>
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($message)) : ?>
            <?php echo $message; ?>
        <?php endif; ?>
        <div class="container-fluid col-md-9" style="padding-left:0px; padding-right:0px;">
            <form action="<?= base_url() ?>SuperAdmin/create_finance" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Create finance</strong></h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group col-md-4">
                            <label for="finance_code">Code:</label>
                            <input class="form-control" type="text" name="finance_code" id="finance_code" placeholder="Enter code" value="<?= set_value('finance_code') ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="finance_description">Description:</label>
                            <input class="form-control" type="text" name="finance_description" id="finance_description" placeholder="Enter description" value="<?= set_value('finance_description') ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="finance_value">Value:</label>
                            <input class="form-control" type="text" name="finance_value" id="finance_value" placeholder="Enter value" value="<?= set_value('finance_value') ?>" />
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
                <form action="<?= base_url() ?>SuperAdmin/add_finance_csv" method="post" enctype="multipart/form-data">
                    <div class="box-body">
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