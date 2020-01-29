</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- bootstrap time picker -->
<script src="<?= base_url() ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
<!-- Pusher JS -->
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Full Calendar JS -->
<script src="<?= base_url() ?>bower_components/moment/moment.js"></script>
<script src="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?= base_url() ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- DataTables -->
<script src="<?= base_url() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.datatables').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        });

        $(".alert").click(function() {
            $(".alert").fadeOut(1000);
        });

        var last_checked;

        $.get("<?= base_url() ?>Notification/get_last_login", function(data) {
            var obj = JSON.parse(data);
            last_checked = obj.log_time;
        });

        //pusher config
        var pusher = new Pusher('8a5cfc7f91e3ec8112f4', {
            cluster: 'ap1',
            forceTLS: true,
        });

        var channel = pusher.subscribe('my-channel');
        var student_number = <?= $this->session->acc_number ?>;

        //pusher broadcast notifications
        channel.bind('school_announcement', function(data) {
            var obj = JSON.parse(JSON.stringify(data));
            $("#dash").fadeIn(1000).html(
                "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + obj.message
            );
            $.get("<?= base_url() ?>Notification/get_notif", function(data) {
                var obj = JSON.parse(data);
                obj.notifications.forEach(get_notif);
            });
        });

        //pusher client-specific notifications
        channel.bind('client_specific', function(data) {
            var obj = JSON.parse(JSON.stringify(data));
            for (var i = 0; i < obj.recipient.length; i++) {
                if (student_number == obj.recipient[i]) {
                    $("#client").fadeIn(1000).html(
                        "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + obj.message
                    );
                    $.get("<?= base_url() ?>Notification/get_notif", function(data) {
                        var obj = JSON.parse(data);
                        obj.notifications.forEach(get_notif);
                    });
                }
            }
        });

        // click notifications shortcut
        $('#notif_active').click(function() {
            $('#notif_container').text('');
            $.get("<?= base_url() ?>Notification/get_notif", function(data) {
                var obj = JSON.parse(data);
                obj.notifications.forEach(get_notif);
            });
            last_checked = Math.round((new Date()).getTime() / 1000);
        });

        // fetch notifications
        function get_notif(notif, index) {
            var content = notif.notif_content;
            var sender_name = notif.notif_sender_name;
            var time_posted = notif.notif_created_at;
            var formattedDate = convert_unix(time_posted);
            var link = notif.notif_link;
            var status = notif.notif_status;
            $("#notif_container").append(
                "<li>" +
                "<a href='" + link + "'>" +
                "<div class='pull-left'>" +
                "<img src='<?= base_url() ?>dist/img/default_avatar.png' class='img-circle' alt='User Image'>" +
                "</div>" +
                "<div class='pull-right'>" +
                "<span class='label label-info'><small>NEW</small></span>" +
                "</div>" +
                "<h4>" + sender_name + "</h4>" +
                "<p>" + content + "</p>" +
                "<small>" + formattedDate + "</small>" +
                "</a>" +
                "<li>"
            );
        }

        // fetch new notif count
        setInterval(() => {
            $.post("<?= base_url() ?>Notification/get_latest_notifications", {
                time: last_checked
            }).done(function(data) {
                var obj = JSON.parse(data);
                if (obj) {
                    $('#notif_badge').text(obj);
                } else {
                    $('#notif_badge').hide();
                }
            });
        }, 1000);

        //convert unix to humar readable
        function convert_unix(timeinunix) {
            var timestampInMilliSeconds = timeinunix * 1000;
            var date = new Date(timestampInMilliSeconds);

            var day = (date.getDate() < 10 ? '0' : '') + date.getDate();
            var month = (date.getMonth() < 9 ? '0' : '') + (date.getMonth());
            var year = date.getFullYear();

            var hours = ((date.getHours() % 12 || 12) < 10 ? '0' : '') + (date.getHours() % 12 || 12);
            var minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
            var meridiem = (date.getHours() >= 12) ? 'pm' : 'am';
            var wordmonth = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];


            var formattedDate = wordmonth[month] + '-' + day + '-' + year + ' at ' + hours + ':' + minutes + ' ' + meridiem;
            return formattedDate;

        }

        // Initialize variables

        var schedule_entry;
        var sched_table = [];
        var offering_entry;
        var petition_details = [];

        var course_code = $("#offering_course_code").val();
        var course_section = $("#offering_course_section").val();

        offering_entry = {
            offering_course_code: course_code,
            offering_course_section: course_section
        };
        petition_details.push(offering_entry);

        // add schedule
        schedule_entry_old = {
            day: '',
            start_time: '',
            end_time: '',
            room: ''
        };

        $("#add_sched").click(function() {

            var day = $("#sched_day").val();
            var start_time = $("#start_time").val();
            var end_time = $("#end_time").val();
            var room = $("#room").val();

            schedule_entry = {
                day: day,
                start_time: start_time,
                end_time: end_time,
                room: room
            };

            if ((start_time < end_time && start_time != end_time) && schedule_entry != schedule_entry_old) {
                sched_table.push(schedule_entry);
                var tr = '<tr><td class="col-md-2 text-center">' + day + '</td><td class="col-md-7">' + start_time + ' - ' + end_time + '</td><td class="col-md-3">' + room + '</td></tr>';
                $("#sched_table_body").append(tr);

            };

            schedule_entry_old = schedule_entry;
        });

        $("#save_sched").click(function() {
            $.post("<?= base_url() ?>Admin/save_sched", {
                    course_details: petition_details,
                    course_sched: sched_table
                }).done(function(data) {
                    alert("success " + data);
                })
                .fail(function() {
                    alert("Petition approval failed!");
                });
        });

        setInterval(() => {
            $.get("<?= base_url() ?>Admin/petitions_number", function(data) {
                $("#petition_number").text(data);
            });
            $.get("<?= base_url() ?>Admin/underload_number", function(data) {
                $("#underload_number").text(data);
            });
            $.get("<?= base_url() ?>Admin/overload_number", function(data) {
                $("#overload_number").text(data);
            });
            $.get("<?= base_url() ?>Admin/simul_number", function(data) {
                $("#simul_number").text(data);
            });
        }, 1000);


        $('.timepicker').timepicker({
            showInputs: false
        });

        // =======================================================================================
        // petitioning module
        // =======================================================================================

        var petition_ID = $("#petition_ID").val();
        var petition_unique = $("#petition_unique").val();

        $("#approve_petition").click(function() {
            $.post("<?= base_url() ?>Admin/approve_petition", {
                    petitionID: petition_ID,
                    petitionUnique: petition_unique
                }).done(function(data) {
                    var obj = JSON.parse(data);
                    if (obj.context == "success") {
                        swal(obj.message, {
                            title: "Success",
                            icon: "success",
                        });
                    } else {
                        swal(obj.message, {
                            title: "Error!",
                            icon: "error",
                        });
                    }

                    $.post("<?= base_url() ?>Admin/fetch_updated_petition_status", {
                        petitionUnique: petition_unique
                    }).done(function(data) {
                        var obj = JSON.parse(data);
                        $('#petition_status_badge').text('');
                        if (obj.petition_status == 1) {
                            $("#petition_status_badge").append("Petition Status: <span class='label label-success'>Approved</span>");
                        } else if (obj.petition_status == 2) {
                            $("#petition_status_badge").append("Petition Status: <span class='label label-warning'>Pending</span>");
                        } else {
                            $("#petition_status_badge").append("Petition Status: <span class='label label-danger'>Denied</span>");
                        }
                    });
                })
                .fail(function() {
                    swal("Failed to process petition, Please check your network connection!", {
                        icon: "error",
                    });
                });
        });

        $("#decline_petition").click(function() {
            swal({
                    title: "Are you sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.post("<?= base_url() ?>Admin/decline_petition", {
                                petitionID: petition_ID,
                                petitionUnique: petition_unique
                            }).done(function(data) {
                                var obj = JSON.parse(data);
                                if (obj.context == "success") {
                                    swal(obj.message, {
                                        title: "Success!",
                                        icon: "success",
                                    });
                                } else {
                                    swal(obj.message, {
                                        title: "Error!",
                                        icon: "error",
                                    });
                                }
                                $.post("<?= base_url() ?>Admin/fetch_updated_petition_status", {
                                    petitionUnique: petition_unique
                                }).done(function(data) {
                                    var obj = JSON.parse(data);
                                    $('#petition_status_badge').text('');
                                    if (obj.petition_status == 1) {
                                        $("#petition_status_badge").append("Petition Status: <span class='label label-success'>Approved</span>");
                                    } else if (obj.petition_status == 2) {
                                        $("#petition_status_badge").append("Petition Status: <span class='label label-warning'>Pending</span>");
                                    } else {
                                        $("#petition_status_badge").append("Petition Status: <span class='label label-danger'>Denied</span>");
                                    }
                                });
                            })
                            .fail(function() {
                                swal("Failed to process petition, Please check your network connection!", {
                                    icon: "error",
                                });
                            });
                    }
                });
        });

        // =======================================================================================
        // end of petitioning module
        // =======================================================================================

        // =======================================================================================
        // overload module
        // =======================================================================================

        // =======================================================================================
        // end of overload module
        // =======================================================================================

        // =======================================================================================
        // underload module
        // =======================================================================================

        // =======================================================================================
        // end of underload module
        // =======================================================================================

        var calendar_events;

        $.get("<?= base_url() ?>Admin/fetch_events", function(data) {
            calendar_events = data;
            // swal(data);
        });

        /* initialize the external events
         -----------------------------------------------------------------*/
        function init_events(ele) {
            ele.each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                })
            })
        }

        init_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'today'
            },
            buttonText: {
                today: 'today',
            },
            //Random default events
            calendar_events,
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject')

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject)

                // assign it the date that was reported
                copiedEventObject.start = date
                copiedEventObject.allDay = allDay
                copiedEventObject.backgroundColor = $(this).css('background-color')
                copiedEventObject.borderColor = $(this).css('border-color')

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove()
                }

            }
        })

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        //Color chooser button
        var colorChooser = $('#color-chooser-btn')
        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault()
            //Save color
            currColor = $(this).css('color')
            //Add color effect to button
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        })

        $('#add-new-event').click(function(e) {
            e.preventDefault()
            //Get value and make sure it is not null
            var inputtitle = $('#new-event').val()
            var inputstart = $("#start_date").val();
            var inputend = $("#end_date").val();
            // if (title.length == 0 || start.length == 0 || end.length == 0) {
            //     return
            // }

            $.post('<?= base_url() ?>Admin/create_event', {
                    title: inputtitle,
                    start: inputstart,
                    end: inputend
                }).done(function(data) {
                    swal(data);
                })
                .fail(function() {
                    swal("failed!");
                });

            // //Create events
            // var event = $('<div />')
            // event.css({
            //     'background-color': currColor,
            //     'border-color': currColor,
            //     'color': '#fff'
            // }).addClass('external-event')
            // event.html(val)
            // $('#external-events').prepend(event)

            // //Add draggable funtionality
            // init_events(event)

            //Remove event from text input
            $('#new-event').val('')
        })

        $('#start_date,#end_date').datepicker({
            autoclose: true
        })
    });
</script>

</body>

</html>