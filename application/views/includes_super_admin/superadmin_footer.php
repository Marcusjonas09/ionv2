</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?= base_url() ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- bootstrap time picker -->
<script src="<?= base_url() ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url() ?>dist/js/adminlte.min.js"></script>
<!-- Pusher JS -->

<!-- DataTables -->
<script src="<?= base_url() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
    var baselink = "<?= base_url() ?>";

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
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>