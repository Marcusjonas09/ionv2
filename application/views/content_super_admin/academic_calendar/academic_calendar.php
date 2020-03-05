<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <strong>School Calendar</strong>
      <small>Administrator</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content container-fluid" style="padding-left:0px; padding-right:0px;">
    <!-- THE CALENDAR -->
    <div class="col-md-7">
      <div class="box box-solid">
        <div class="box-body ">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->


    <div class="col-md-5" style="padding-left:0px;">
      <div class="box box-solid ">
        <h3 class="box-header" style="margin-top:0px; margin-bottom:0px;">
          <strong>All Events</strong>
        </h3>
        <div class="box-body">
          <!-- THE CALENDAR -->
          <table class="table table-hover table-responsive">
            <thead>
              <th>Event</th>
              <th>Description</th>
              <th>Start</th>
              <th>End</th>
            </thead>
            <tbody>
              <?php foreach ($events as $event) : ?>
                <tr>
                  <td><?= $event->title ?></td>
                  <td><?= $event->description ?></td>
                  <td><?= $event->start ?></td>
                  <td><?= $event->end ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Calendar Event</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(site_url("SuperAdmin/add_event"), array("class" => "form-horizontal")) ?>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Event Name</label>
          <div class="col-md-8 ui-front">
            <input required type="text" class="form-control" name="name" id="name">
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Description</label>
          <div class="col-md-8 ui-front">
            <input type="text" class="form-control" name="description" id="description">
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Start Date</label>
          <div class="col-md-8">
            <input required type="text" class="form-control" name="start_date" id="add_start_date" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">End Date</label>
          <div class="col-md-8">
            <input required type="text" class="form-control" name="end_date" id="add_end_date">
          </div>
        </div>

        <!-- <div class="form-group">
                <label for="p-in" class="col-md-4 label-heading">Color</label>
                <div class="col-md-8">
                    <ul class="fc-color-picker" id="color-chooser">
                        <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                        <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                    </ul>
                </div>
        </div> -->



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Add Event" id="add_calendar_event">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Calendar Event</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(site_url("SuperAdmin/edit_event"), array("class" => "form-horizontal")) ?>


        <!-- <textarea id="myTextarea" rows="5" cols="60" placeholder="Type something here..."></textarea> -->

        <div class="output"></div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Event Name</label>
          <div class="col-md-8 ui-front">
            <input type="text" class="form-control" name="name" id="editname" required>
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Description</label>
          <div class="col-md-8 ui-front">
            <input type="text" class="form-control" name="description" id="editdescription">
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Start Date</label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="start_date" id="start_date" required readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">End Date</label>
          <div class="col-md-8">
            <input required type="text" class="form-control" name="end_date" id="end_date" readonly>
          </div>
        </div>
        <div class="form-group">
          <label for="p-in" class="col-md-4 label-heading">Delete Event</label>
          <div class="col-md-8">
            <input type="checkbox" name="delete" value="1">
          </div>
        </div>
        <input type="hidden" name="eventid" id="event_id" value="0" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Update Event" id="edit_calendar_event">
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>