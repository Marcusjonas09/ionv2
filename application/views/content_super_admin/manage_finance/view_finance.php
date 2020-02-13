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
        <div class="container-fluid col-md-9" style="padding-left:0px; padding-right:0px;">
            <form action="<?= base_url() ?>SuperAdmin/edit_finance_function" method="post">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Edit finance (SY: <?= $school_year->school_year . ' - Term: ' . $school_year->school_term ?>)</strong></h3>
                    </div>
                    <!-- <div class="box-body">
                        <div class="form-group col-md-4">
                            <label for="finance_code">Code:</label>
                            <input class="form-control" type="text" name="finance_code" id="finance_code" value="<?= $finance->finance_code ?>" value="<?= set_value('finance_code') ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="finance_description">Description:</label>
                            <input class="form-control" type="text" name="finance_description" id="finance_description" value="<?= $finance->finance_description ?>" value="<?= set_value('finance_description') ?>" />
                            <input type="hidden" type="text" name="finance_id" id="finance_id" value="<?= $finance->finance_id ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="finance_value">Value:</label>
                            <input class="form-control" type="text" name="finance_value" id="finance_value" value="<?= $finance->finance_value ?>" value="<?= set_value('finance_value') ?>" />
                        </div>
                    </div> -->
                    <div class="box-footer">
                        <input class="btn btn-success pull-right" type="submit" value="Submit" />
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->