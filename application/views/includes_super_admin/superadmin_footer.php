</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3
<script src="<?= base_url() ?>bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- jQuery 3 -->
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- bootstrap time picker -->
<script src="<?= base_url() ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<!-- Full Calendar JS -->
<script src="<?= base_url() ?>bower_components/moment/moment.js"></script>
<script src="<?= base_url() ?>bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/bootstrap/main.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?= base_url() ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
<!-- Pusher JS -->
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>


<!-- DataTables -->
<script src="<?= base_url() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Datepicker disable date JS -->
<script src="<?= base_url() ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- SWAL JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- date-range-picker -->
<script src="<?= base_url() ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap time picker -->
<script src="<?= base_url() ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url() ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= base_url() ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= base_url() ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>



<script type="text/javascript">
    $('#petitionsched').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        format: 'MM/DD/YYYY h:mm A'
    })
    var baselink = "<?= base_url() ?>";

    function block_account(acc_id) {
        Swal.fire({
            title: 'Are you sure you want to BLOCK this account?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Block'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url() ?>SuperAdmin/block_account',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        acc_id: acc_id
                    },
                    success: function(data) {
                        if (data.status) {
                            Swal.fire({
                                title: 'Success',
                                icon: 'success',
                                text: data.message,
                                timer: 1100
                            }).then(() => {
                                window.location.replace(baselink + "SuperAdmin/faculties/");
                            })

                        } else {
                            Swal.fire({
                                title: 'Error',
                                icon: 'warning',
                                text: data.message
                            })
                        }
                    }
                });
            }
        })
    }


    function unblock_account(acc_id) {
        Swal.fire({
            title: 'Are you sure you want to UNBLOCK this account?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Block'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url() ?>SuperAdmin/unblock_account',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        acc_id: acc_id
                    },
                    success: function(data) {
                        if (data.status) {
                            Swal.fire({
                                title: 'Success',
                                icon: 'success',
                                text: data.message,
                                timer: 1100
                            }).then(() => {
                                window.location.replace(baselink + "SuperAdmin/faculties/");
                            })
                        } else {
                            Swal.fire({
                                title: 'error',
                                icon: 'warning',
                                text: data.message
                            })
                        }
                    }
                });
            }
        })
    }

    function delete_program(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_program/" + id)
            }
        })
    }

    function delete_program(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_program/" + id)
            }
        })
    }

    function delete_class(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_class/" + id)
            }
        })
    }

    function delete_finance(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_finance/" + id)
            }
        })
    }

    function delete_college(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_college/" + id)
            }
        })
    }

    function delete_course(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_course/" + id)
            }
        })
    }

    function delete_laboratory(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_laboratory/" + id)
            }
        })
    }

    function delete_section(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_section/" + id)
            }
        })
    }

    function delete_department(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_department/" + id)
            }
        })
    }

    function delete_specialization(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_specialization/" + id)
            }
        })
    }

    function delete_curriculum(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_curriculum/" + id)
            }
        })
    }

    function delete_course_from_curriculum(curriculum_id, curriculum_code) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_course_from_curriculum/" + curriculum_id + "/" + curriculum_code)
            }
        })
    }

    function delete_prereq_from_course(id, course_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_prereq_from_course/" + id + "/" + course_id)
            }
        })
    }

    function delete_sched(class_id, cs_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/delete_sched/" + class_id + "/" + cs_id)
            }
        })
    }

    function delete_petition_sched(petition_id, cs_id, petition_unique) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            $.ajax({
                url: '<?php echo base_url() ?>SuperAdmin/delete_petition_sched',
                method: 'POST',
                dataType: 'json',
                data: {
                    petition_id: petition_id,
                    cs_id: cs_id,

                },
                dataType: 'JSON',
                success: function(data) {
                    if (data.status == 'success') {
                        swal.fire(data.title, {
                            icon: data.icon,
                            buttons: false,
                            timer: 1100,
                        }).then((value) => {
                            window.location.replace(baselink + "SuperAdmin/show_petition/" + petition_id + "/" + petition_unique)
                        });

                    } else {
                        swal.fire("Invalid Request", {
                            icon: 'error',
                            buttons: false,
                            timer: 1100,
                        }).then((value) => {
                            window.location.replace(baselink + "SuperAdmin/show_petition/" + petition_id + "/" + petition_unique)
                        });
                    }
                }
            });

        })
    }

    function edit_class() {
        var class_id = $("#class_id").val();
        var class_faculty_id = $("#class_faculty_id").val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save!'
        }).then((result) => {

            if (result.value) {
                window.location.replace(baselink + "SuperAdmin/edit_class_function/" + class_id + "/" + class_faculty_id)
            }
        })
    }



    $(document).ready(function() {
        $.ajax({
            url: '<?php echo base_url() ?>SuperAdmin/fetch_lab_code',
            method: 'POST',
            dataType: 'json',
            data: {
                course_code: $('#class_course_code').val()
            },
            success: function(data) {
                $('.lab_code').val(data.laboratory_code);
                if (data.laboratory_code != 'none') {
                    $('#lab_instructor_edit').prop("disabled", false)
                } else {
                    $('#lab_instructor_edit').prop("disabled", true)
                }
            }
        });
        $('#class_course_code').change(function() {
            $.ajax({
                url: '<?php echo base_url() ?>SuperAdmin/fetch_lab_code',
                method: 'POST',
                dataType: 'json',
                data: {
                    course_code: $('#class_course_code').val()
                },
                success: function(data) {
                    $('.lab_code').val(data.laboratory_code);
                    if (data.laboratory_code != 'none') {
                        $('#lab_instructor').prop("disabled", false)
                    } else {
                        $('#lab_instructor').prop("disabled", true)
                    }

                }
            });

            $.ajax({
                url: '<?php echo base_url() ?>SuperAdmin/show_sections_available',
                method: 'POST',
                dataType: 'json',
                data: {
                    course_code: $('#class_course_code').val()
                },
                success: function(data) {
                    console.log(data.data);
                    $('#class_section_code').children('option:not(:first)').remove();
                    $("#class_section_code").append(data.data);
                }
            });
        });

        $('.datatables').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': true,
            'autoWidth': false
        });

        var schedule_entry;
        var sched_table = new Array();


        // Initialize variables

        schedule_entry_old = {
            faculty: '',
            section: '',
            course: '',
            day: '',
            start_time: '',
            end_time: '',
            room: '',
            class_sched: ''
        };

        $("#add_class_sched").click(function() {
            var day = $("#class_sched_day").val();
            var start_time = $("#class_start_time").val();
            var end_time = $("#class_end_time").val();
            var room = $("#class_room").val();
            var faculty = $("#class_faculty_id").val();
            var course = $("#class_course_code").val();
            var section = $("#class_section_code").val();
            var class_sched = course + section;

            schedule_entry = {
                faculty_id: faculty,
                class_section: section,
                class_code: course,
                class_day: day,
                class_start_time: start_time,
                class_end_time: end_time,
                class_room: room,
                class_sched: class_sched
            };

            if ((start_time < end_time && start_time != end_time) && schedule_entry != schedule_entry_old) {
                sched_table.push(schedule_entry);
                var tr = '<tr>' +
                    '<td>' + day + '</td>' +
                    '<td>' + start_time + ' - ' + end_time + '</td>' +
                    '<td>' + room + '</td>' +
                    '<td><button class="btn btn-danger"><span class="fa fa-minus"></span></button></td>' +
                    '</tr>'
                $("#class_sched_table_body").append(tr);
            };

            // echo date("G:i", strtotime($time));

            schedule_entry_old = schedule_entry;

        });
        $("#save_sched").click(function() {
            $.post("<?= base_url() ?>SuperAdmin/save_sched", {
                    schedule_entry
                }).done(function(data) {
                    Swal.fire({
                        title: 'Success',
                        text: data,
                    });
                })
                .fail(function(data) {
                    Swal.fire({
                        title: 'Failed',
                        text: data,
                    });
                });
        });


        // Create a new object
        $('.js-example-basic-single').select2();

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        });
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
        $.post("<?= base_url() ?>SuperAdmin/save_sched", {
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
        $.get("<?= base_url() ?>SuperAdmin/petitions_number", function(data) {
            $("#petition_number").text(data);
        });
        $.get("<?= base_url() ?>SuperAdmin/underload_number", function(data) {
            $("#underload_number").text(data);
        });
        $.get("<?= base_url() ?>SuperAdmin/overload_number", function(data) {
            $("#overload_number").text(data);
        });
        $.get("<?= base_url() ?>SuperAdmin/simul_number", function(data) {
            $("#simul_number").text(data);
        });
    }, 1000);

    $('.timepicker').timepicker({
        showInputs: false
    });

    // =======================================================================================
    // petitioning module
    // =======================================================================================

    $("#approve_petition").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Approve!'
        }).then((result) => {
            if (result.value) {
                var petition_ID = $("#petition_ID").val();
                var petition_unique = $("#petition_unique").val();
                var petition_code = $("#petition_code").val();
                var petition_section = $("#petition_section").val();

                $.ajax({
                    url: '<?= base_url() ?>SuperAdmin/approve_petition',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        petitionID: petition_ID,
                        petitionUnique: petition_unique,
                        petitionSection: petition_section,
                        petitionSched: petition_code + petition_section
                    },
                    success: function(data) {
                        if (data.context == "success") {
                            Swal.fire(
                                'Success!',
                                data.message,
                                'success'
                            )
                            $.ajax({
                                url: '<?= base_url() ?>SuperAdmin/fetch_updated_petition_status',
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    petitionUnique: petition_unique
                                },
                                success: function(data) {
                                    $('#petition_status_badge').text('');
                                    if (data.petition_status == 1) {
                                        $("#petition_status_badge").append("Petition Status: <span class='label label-success'>Approved</span>");
                                    } else if (data.petition_status == 2) {
                                        $("#petition_status_badge").append("Petition Status: <span class='label label-warning'>Pending</span>");
                                    } else {
                                        $("#petition_status_badge").append("Petition Status: <span class='label label-danger'>Denied</span>");
                                    }
                                }
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                data.message,
                                'error'
                            )
                        }


                    }
                });
            }
        })
    });

    $("#decline_petition").click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Decline!'
        }).then((result) => {
            if (result.value) {
                var petition_ID = $("#petition_ID").val();
                var petition_unique = $("#petition_unique").val();
                var petition_section = $("#petition_section").val();
                $.post("<?= base_url() ?>SuperAdmin/decline_petition", {
                        petitionID: petition_ID,
                        petitionUnique: petition_unique,
                        petitionSection: petition_section
                    }).done(function(data) {
                        var obj = JSON.parse(data);
                        if (obj.context == "success") {
                            Swal.fire(
                                'Success!',
                                obj.message,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Error!',
                                obj.message,
                                'error'
                            )
                        }
                        $.post("<?= base_url() ?>SuperAdmin/fetch_updated_petition_status", {
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
                        Swal.fire(
                            'Failed to process petition, Please check your network connection!',
                            'error'
                        )
                    });
            }
        })
    });

    var date_last_clicked = null;

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,listMonth'
        },

        eventSources: [{
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: '<?php echo base_url() ?>SuperAdmin/get_events',
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
        }, ],
        dayClick: function(date, jsEvent, view) {
            // date_last_clicked = $(this);
            var now = new Date();
            var selected_date = new Date(date);

            // if (now.getTime() > selected_date.getTime()){

            if (selected_date < now) {
                Swal.fire({
                    icon: 'warning',
                    title: 'TRY AGAIN ',
                    text: 'YOU CLICKED A PAST DATE!',
                })
            } else {
                var add_selected_date = date.format('YYYY/MM/DD')
                $('#add_start_date').val(add_selected_date);

                $('#add_end_date').datepicker({
                    changeMonth: true,
                    dateFormat: "yy/mm/dd",
                    autoclose: true,
                    minDate: add_selected_date
                })

                $('#addModal').modal(
                    $('#add_calendar_event').click(function(e) {
                        var valid = this.form.checkValidity();
                        if (valid) {
                            Swal.fire(
                                'Good job!',
                                'You clicked the button!',
                                'success'
                            )
                        } else {

                        }
                    })
                );

            }



        },
        eventClick: function(event, jsEvent, view) {

            var now = new Date();
            var dateFormat = "yy/mm/dd",
                from = $("#start_date")
                .datepicker({
                    dateFormat: "yy/mm/dd",
                    defaultDate: "+1w",
                    changeMonth: true,
                    minDate: now
                })
                .on("change", function() {
                    to.datepicker("option", "minDate", getDate(this));
                }),
                to = $("#end_date").datepicker({
                    dateFormat: "yy/mm/dd",
                    defaultDate: "+1w",
                    changeMonth: true,
                    minDate: now
                })
                .on("change", function() {
                    from.datepicker("option", "maxDate", getDate(this));
                });

            function getDate(element) {
                var date;
                try {
                    date = $.datepicker.parseDate(dateFormat, element.value);
                } catch (error) {
                    date = null;
                }

                return date;
            }

            $('#editname').val(event.title);
            $('#editdescription').val(event.description);
            $('#start_date').val(moment(event.start).format('YYYY/MM/DD'));
            if (event.end) {
                $('#end_date').val(moment(event.end).format('YYYY/MM/DD'));
            } else {
                $('#end_date').val(moment(event.start).format('YYYY/MM/DD'));
            }
            $('#event_id').val(event.id);


            $('#editModal').modal(
                $('#edit_calendar_event').click(function(e) {
                    var valid = this.form.checkValidity();
                    if (valid) {
                        Swal.fire(
                            'Updated!',
                            'Details succesfully updated!',
                            'success'
                        )
                    } else {

                    }
                })
            );
        },
    });
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>