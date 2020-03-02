</div>

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>dist/js/demo.js"></script>
<!-- page script -->
<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Full Calendar JS -->
<script src="<?= base_url() ?>bower_components/moment/moment.js"></script>
<script src="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

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

        // get last login
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
        function get_announce(notif, index) {
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

        $('.js-example-basic-single').select2();

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



        // $('#submit_petition').click(function() {
        //     var petition_course_code = $("#course_code").val();
        //     $.post("<?= base_url() ?>Student/submitPetition", {
        //         course_code: petition_course_code
        //     }).done(function() {
        //         swal('successful');
        //     }).fail(function() {
        //         swal('failed');
        //     });
        // });

        function show_error(header, message, context) {

        }
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
        var date_last_clicked = null;

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,listMonth'
            },
            
            eventSources: [
            {
            events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: '<?php echo base_url() ?>Admin/get_events',
                        dataType: 'json',
                        data: {
                            // our hypothetical feed requires UNIX timestamps
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(msg) {
                            var events = msg.events;
                            callback(events);
                        }
                    });
                }
                },
            ],
            
            });
});
</script>


<script type="text/javascript">
    // var progress = "<?php echo $totalunitspassed / $totalunits; ?>";
    // var bar = new ProgressBar.Circle(container, {
    //     color: '#1f5',
    //     strokeWidth: 10,
    //     trailWidth: 7,
    //     easing: 'easeInOut',
    //     duration: 2000,
    //     text: {
    //         autoStyleContainer: false
    //     },
    //     from: {
    //         color: '#1f5',
    //         width: 10
    //     },
    //     to: {
    //         color: '#1f5',
    //         width: 10
    //     },
    //     // Set default step function for all animate calls
    //     step: function(state, circle) {
    //         circle.path.setAttribute('stroke', state.color);
    //         circle.path.setAttribute('stroke-width', state.width);

    //         var value = Math.round(circle.value() * 100);
    //         if (value === 0) {
    //             circle.setText('');
    //         } else {
    //             circle.setText(value + '%');
    //         }

    //     }
    // });
    // bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
    // bar.text.style.fontSize = '2rem';

    // bar.animate(progress); // Number from 0.0 to 1.0



    
</script>

</body>

</html>