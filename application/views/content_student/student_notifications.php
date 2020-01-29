<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <strong>Notifications</strong>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="box box-success">
            <div class="box-body">
                <table class="tabel table-hover col-md-12">
                    <?php foreach ($notifications as $notification) : ?>
                        <tr>
                            <td class="col-md-1"><img src='<?= base_url() ?>dist/img/default_avatar.png' class='img-circle' style="width:80px;" alt='User Image'></td>
                            <td>
                                <h4><?= $notification->notif_sender_name ?></h4>
                                <p><?= $notification->notif_content ?></p>
                            </td>
                            <td><small> <?= date("F j, Y, g:i a", $notification->notif_created_at) ?> </small></td>
                            <td><span class='label label-info'><small>NEW</small></span></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="col-md-6"><?= $this->pagination->create_links(); ?></div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->