<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Manila");

        $this->load->library('form_validation');

        $this->load->model('Account_model');
        $this->load->model('User_model');
        $this->load->model('Academics_model');
        $this->load->model('Petition_model');
        $this->load->model('Simul_model');
        $this->load->model('Curriculum_model');
        $this->load->model('CourseCard_model');
        $this->load->model('Dashboard_model');
        $this->load->model('Revision_model');
        $this->load->model('Post_model');
        $this->load->model('Notification_model');
        $this->load->model('Overload_underload_model');
        $this->load->model('Real_time_model');
        $this->load->model('Events_model');
        $this->load->model('Calendar_model');
        $this->load->model('SuperAdmin_model');
        $this->load->helper('date');
        $this->load->helper('text');
        require 'vendor/autoload.php';
    }

    // =======================================================================================
    // DASHBOARD MODULE
    // =======================================================================================

    public function dashboard() // | Display Dashboard |
    {
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/dashboard/dashboard');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function petitions_number()
    {
        echo json_encode($this->Real_time_model->fetchPetitions_num_rows());
    }

    public function underload_number()
    {
        echo json_encode($this->Real_time_model->fetchUnderload_num_rows());
    }

    public function overload_number()
    {
        echo json_encode($this->Real_time_model->fetchOverload_num_rows());
    }

    public function simul_number()
    {
        echo json_encode($this->Real_time_model->fetchSimul_num_rows());
    }


    // =======================================================================================
    // END OF DASHBOARD MODULE
    // =======================================================================================

    // =======================================================================================
    // STUDENT ACCOUNT MANAGEMENT MODULE
    // =======================================================================================

    public function student_accounts() // | Display Student Accounts |
    {
        $per_page = 10;
        $end_page = $this->uri->segment(3);
        $this->load->library('pagination');
        $config = [
            'base_url' => base_url('SuperAdmin/student_accounts'),
            'per_page' => $per_page,
            'total_rows' => $this->Account_model->account_num_rows(),
        ];

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config); // model function

        $data['students'] = $this->Account_model->fetch_student_accounts($per_page, $end_page);

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/student_accounts/student_accounts', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function block_user($studnumber)
    {
        $this->Account_model->block_user($studnumber);
        redirect('SuperAdmin/student_accounts');
    }

    public function show_account($studNumber, $curriculum_code) // | Display Specific Student Account |
    {
        $data['account'] = $this->Account_model->view_user($studNumber);
        $data['curr'] = $this->Academics_model->fetch_curriculum_admin($curriculum_code);
        $data['grades'] = $this->Academics_model->fetch_progress_admin($studNumber);
        $data['offerings'] = $this->Academics_model->fetchCurrentOffering();
        $data['cor'] = $this->Academics_model->fetch_current_COR($studNumber);

        // echo json_encode($data);

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/student_accounts/show_account', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF STUDENT ACCOUNT MANAGEMENT MODULE
    // =======================================================================================

    // =======================================================================================
    // PARALLEL MODULE
    // =======================================================================================

    public function parallel()
    {
        $data['parallel'] = $this->Academics_model->fetchParallel();
        $data['parallelCourse'] = $this->Academics_model->fetchParallelCourse();

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/parallel_courses/parallel_courses', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF PARALLEL MODULE
    // =======================================================================================

    // =======================================================================================
    // OFFERING MODULE
    // =======================================================================================

    public function offerings()
    {
        $term = $this->input->post('term');
        $year = $this->input->post('year');
        $submit = $this->input->post('submit');
        $data['Y'] = $year;
        $data['T'] = $term;
        $data['years'] = $this->Academics_model->fetch_year();
        $data['terms'] = $this->Academics_model->fetch_term();
        $data['offering'] = $this->Academics_model->fetchOffering($year, $term);
        $data['classes'] = $this->Academics_model->fetchClass($year, $term);

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/course_offering/course_offering', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF OFFERING MODULE
    // =======================================================================================

    // =======================================================================================
    // COURSE PETITIONING MODULE
    // =======================================================================================

    public function course_petitions() // | Display Course Petitions |
    {
        $per_page = 10;
        $end_page = $this->uri->segment(3);
        $this->load->library('pagination');
        $config = [
            'base_url' => base_url('SuperAdmin/course_petitions'),
            'per_page' => $per_page,
            'total_rows' => $this->Petition_model->fetchPetitionsAdmin_num_rows(),
        ];

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config); // model function

        $data['petitions'] = $this->Petition_model->fetchPetitionsAdmin($per_page, $end_page);
        $data['petitioners'] = $this->Petition_model->fetchAllPetitioners();
        $data['courses'] = $this->Petition_model->fetchCoursesAdmin();

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/student_petitions/student_petitions', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF COURSE PETITIONING MODULE
    // =======================================================================================

    // =======================================================================================
    // CALENDAR MODULE
    // =======================================================================================

    public function academic_calendar($success = null, $error = null) // | Display Academic Calendar |
    {
        $events = $this->Calendar_model->getAllEvent();
        $data['events'] = $events;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');
        $this->load->view('content_super_admin/academic_calendar/academic_calendar', $data);
        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');

        $data['success_msg'] = $success;
        $data['error_msg'] = $error;
    }

    public function get_events()
    {
        // Our Start and End Dates
        $start = $this->input->get("start");
        $end = $this->input->get("end");

        $startdt = new DateTime('now'); // setup a local datetime
        $startdt->setTimestamp($start); // Set the date based on timestamp
        $start_format = $startdt->format('Y-m-d');

        $enddt = new DateTime('now'); // setup a local datetime
        $enddt->setTimestamp($end); // Set the date based on timestamp
        $end_format = $enddt->format('Y-m-d');

        $events = $this->Calendar_model->get_events($start_format, $end_format);

        $data_events = array();

        foreach ($events->result() as $r) {

            $data_events[] = array(
                "id" => $r->ID,
                "title" => $r->title,
                "description" => $r->description,
                "start" => $r->start,
                "end" => $r->end

            );
        }

        echo json_encode(array("events" => $data_events));
        exit();
    }

    public function add_event()
    {
        /* Our calendar data */
        $name = $this->input->post("name", TRUE);
        $desc = $this->input->post("description", TRUE);
        $start_date = $this->input->post("start_date", TRUE);
        $end_date = $this->input->post("end_date", TRUE);

        if (!empty($start_date)) {
            $sd = DateTime::createFromFormat("Y/m/d", $start_date);
            $start_date = $sd->format('Y-m-d ');
        } else {
            $start_date = date("Y-m-d");
        }

        if (!empty($end_date)) {
            $ed = DateTime::createFromFormat("Y/m/d", $end_date);
            $end_date = $ed->format('Y-m-d');
        } else {
            $end_date = date("Y-m-d");
        }

        $this->Calendar_model->add_event(
            array(
                "title" => $name,
                "description" => $desc,
                "start" => $start_date,
                "end" => $end_date
            )
        );
        redirect('SuperAdmin/academic_calendar');
    }


    public function edit_event()
    {
        $eventid = intval($this->input->post("eventid"));
        $event = $this->Calendar_model->get_event($eventid);
        if ($event->num_rows() == 0) {
            echo ('Invalid');
            exit();
        }
        $event->row();

        /* Our calendar data */
        $name = $this->input->post("name");
        $desc = $this->input->post("description");
        $start_date = $this->input->post("start_date");
        $end_date = $this->input->post("end_date");
        $delete = intval($this->input->post("delete"));

        if (!$delete) {
            if (!empty($start_date)) {
                $sd = DateTime::createFromFormat("Y/m/d", $start_date);
                $start_date = $sd->format('Y-m-d');
            } else {
                $start_date = date("Y-m-d");
            }
            if (!empty($end_date)) {
                $ed = DateTime::createFromFormat("Y/m/d", $end_date);
                $end_date = $ed->format('Y-m-d');
            } else {
                $end_date = date("Y-m-d");
            }
            $this->Calendar_model->update_event(
                $eventid,
                array(
                    "title" => $name,
                    "description" => $desc,
                    "start" => $start_date,
                    "end" => $end_date,
                )
            );
        } else {
            $this->Calendar_model->delete_event($eventid);
        }

        redirect('SuperAdmin/academic_calendar');
    }

    // =======================================================================================
    // END OF CALENDAR MODULE
    // =======================================================================================

    // =======================================================================================
    // ANNOUNCEMENT MODULE
    // =======================================================================================

    public function school_announcements() // | Display school announcement |
    {
        $data['posts'] = $this->Post_model->fetch_posts();
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/school_announcements/school_announcements', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function fetch_post($post_id)
    {
        $data = $this->Post_model->fetch_post($post_id);
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/school_announcements/view', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function delete_post($post_id)
    {
        $this->Post_model->delete_post($post_id);
        redirect('SuperAdmin/school_announcements');
    }

    public function announce()
    {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '8a5cfc7f91e3ec8112f4',
            'e5e5c5534c2aa13bb349',
            '880418',
            $options
        );

        $config['upload_path']          = './images/posts/';
        $config['allowed_types']        = 'gif|jpg|png|JPG';
        $config['max_size']             = 512;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('caption', 'Caption', 'strip_tags');

        if (empty($this->input->post('caption')) && !$this->upload->do_upload('attachment')) {
            redirect('SuperAdmin/school_announcements');
        } else {

            if ($this->form_validation->run() == FALSE) {
                redirect('SuperAdmin/school_announcements');
            } else {
                if (!$this->upload->do_upload('attachment')) {
                    $data['msg'] = array('success' => 'Image successfully uploaded');

                    $data1 = array(
                        'post_account_id' => $this->session->acc_number,
                        'post_caption' => $this->input->post('caption'),
                        'post_created' => time(),
                        'post_edited' => time()
                    );
                    $this->Post_model->create_post($data1);
                } else {
                    $data['msg'] = array('success' => 'Image successfully uploaded');
                    $data = array('upload_data' => $this->upload->data());
                    $filename = $data['upload_data']['file_name'];

                    $data1 = array(
                        'post_account_id' => $this->session->acc_number,
                        'post_caption' => $this->input->post('caption'),
                        'post_image' => $filename,
                        'post_created' => time(),
                        'post_edited' => time()
                    );

                    $this->Post_model->create_post($data1);
                    $this->load->library('image_lib');

                    $config1['image_library'] =  'gd2';
                    $config1['source_image'] = './images/posts/' . $filename;
                    $config1['new_image'] = './images/posts/processed/';
                    $config1['maintain_ratio'] = TRUE;
                    $config1['width']         = 500;
                    $config1['height']       = 500;

                    $this->image_lib->initialize($config1);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }

                $notif_details = array(
                    'notif_sender' => $this->session->acc_number,
                    'notif_sender_name' => $this->session->Firstname . ' ' . $this->session->Lastname,
                    'notif_recipient' => 0,
                    'notif_content' => $this->input->post('caption'),
                    'notif_created_at' => time()
                );

                $this->Notification_model->notify($notif_details);

                $announcement['message'] = $this->input->post('caption');
                $pusher->trigger('my-channel', 'school_announcement', $announcement);

                redirect('SuperAdmin/school_announcements');
            }
        }
    }

    public function update_post($post_id)
    {
        $config['upload_path']          = './images/posts/';
        $config['allowed_types']        = 'gif|jpg|png|JPG';
        $config['max_size']             = 512;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('caption', 'Caption', 'strip_tags');

        if ($this->form_validation->run() == FALSE) {
            redirect('SuperAdmin/school_announcements');
        } else {
            if (!$this->upload->do_upload('attachment')) {
                $data['msg'] = array('success' => 'Image successfully uploaded');
                $fullname = $this->session->Firstname . ' ' . $this->session->Lastname;
                $data = array(
                    'post_caption' => $this->input->post('caption'),
                    'post_edited' => time()
                );
                $this->Post_model->update_post($post_id, $data);
            } else {
                $data['msg'] = array('success' => 'Image successfully uploaded');
                $data = array('upload_data' => $this->upload->data());
                $filename = $data['upload_data']['file_name'];
                $data = array(
                    'post_account_id' => $this->session->acc_number,
                    'post_caption' => $this->input->post('caption'),
                    'post_image' => $filename,
                    'post_edited' => time()
                );

                $this->Post_model->update_post($post_id, $data);

                $this->load->library('image_lib');

                $config1['image_library'] =  'gd2';
                $config1['source_image'] = './images/posts/' . $filename;
                $config1['new_image'] = './images/posts/processed/';
                $config1['maintain_ratio'] = TRUE;
                $config1['width']         = 500;
                $config1['height']       = 500;

                $this->image_lib->initialize($config1);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
            redirect('SuperAdmin/school_announcements');
        }
    }

    public function edit_post($post_id)
    {
        $data = $this->Post_model->fetch_post($post_id);
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/school_announcements/edit', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF SCHOOL ANNOUNCEMENT MODULE
    // =======================================================================================

    // =======================================================================================
    // ALL CURRICULA MODULE
    // =======================================================================================

    public function curricula()
    {
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/curricula/curricula');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF ALL CURRICULA MODULE
    // =======================================================================================

    // =======================================================================================
    // COR REVISION MODULE
    // =======================================================================================

    public function cor() // | Display all COR revision requests |
    {

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/cor/cor');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF COR REVISION MODULE
    // =======================================================================================

    // =======================================================================================
    // UNDERLOAD MODULE
    // =======================================================================================

    public function underload() // | Display all underload requests |
    {
        $data['underloads'] = $this->Overload_underload_model->fetch_all_underload();

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/overload_underload/underload_requests', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function underload_view($stud_number, $term, $year) // | Display underload request view |
    {
        $data['cor'] = $this->Overload_underload_model->fetch_course_card_admin($stud_number, $term, $year);
        $data['student'] = $this->Overload_underload_model->fetch_user($stud_number);
        // $data['courses'] = $this->Overload_underload_model->fetch_courses();
        $data['offerings'] = $this->Overload_underload_model->fetchOffering();
        $data['underload'] = $this->Overload_underload_model->fetch_underload($stud_number, $term, $year);

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/overload_underload/underload_view', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function approve_underload($id, $stud_number)
    {
        $message = 'Underload request granted!';

        $link = base_url() . "Student/underload_request/" . $stud_number;
        $this->send_notification($stud_number, $message, $link);
        $this->Overload_underload_model->approve_underload($id);

        redirect('SuperAdmin/underload');
    }

    public function decline_underload($id, $stud_number)
    {
        $message = 'Underload request declined!';

        $link = base_url() . "Student/underload_request/" . $stud_number;
        $this->send_notification($stud_number, $message, $link);
        $this->Overload_underload_model->decline_underload($id);

        redirect('SuperAdmin/underload');
    }

    // =======================================================================================
    // END OF UNDERLOAD MODULE
    // =======================================================================================

    // =======================================================================================
    // OVERLOAD MODULE
    // =======================================================================================

    public function overload() // | Display all overload request |
    {
        $data['overloads'] = $this->Overload_underload_model->fetch_all_overload();

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/overload_underload/overload_requests', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function overload_view($stud_number, $term, $year) // | Display overload request view |
    {

        $data['cor'] = $this->Overload_underload_model->fetch_course_card_admin($stud_number, $term, $year);
        $data['student'] = $this->Overload_underload_model->fetch_user($stud_number);
        // $data['courses'] = $this->Overload_underload_model->fetch_courses();
        $data['offerings'] = $this->Overload_underload_model->fetchOffering();
        $data['overload'] = $this->Overload_underload_model->fetch_overload($stud_number, $term, $year);

        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/overload_underload/overload_view', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function approve_overload($id, $stud_number)
    {
        $message = 'Overload request granted!';

        $link = base_url() . "Student/overload_request/" . $stud_number;
        $this->send_notification($stud_number, $message, $link);
        $this->Overload_underload_model->approve_overload($id);

        redirect('SuperAdmin/overload');
    }

    public function decline_overload($id, $stud_number)
    {
        $message = 'Overload request declined!';

        $link = base_url() . "Student/overload_request/" . $stud_number;
        $this->send_notification($stud_number, $message, $link);
        $this->Overload_underload_model->decline_overload($id);

        redirect('SuperAdmin/overload');
    }

    // =======================================================================================
    // END OF OVERLOAD MODULE
    // =======================================================================================

    // =======================================================================================
    // SIMUL MODULE
    // =======================================================================================

    public function simul() // | Display all simul request |
    {
        $data['requests'] = $this->Simul_model->fetch_all_simul();
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/simul/simul', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function view_simul($id) // | Display one simul request |
    {
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $data['details'] = $this->Simul_model->fetch_simul($id);
        $data['curr'] = $this->Simul_model->fetch_curriculum($data['details']->curriculum_code);
        $data['grades'] = $this->Simul_model->fetchProgress($data['details']->acc_number);
        $data['offerings'] = $this->Simul_model->fetchOffering();
        $data['cor'] = $this->Simul_model->fetch_current_COR($data['details']->acc_number);
        $data['status'] = $this->Simul_model->fetch_simul_status($data['details']->acc_number);
        $data['pdf'] = $this->Simul_model->fetch_pdf($data['details']->acc_number);
        $this->load->view('content_super_admin/simul/view_simul', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function approve_simul($id, $stud_number)
    {
        $message = 'Simul request granted!';

        $link = base_url() . "Student/sample_simul/";
        $this->send_notification($stud_number, $message, $link);
        $this->Simul_model->approve_simul($id);

        redirect('SuperAdmin/simul');
    }

    public function decline_simul($id, $stud_number)
    {
        $message = 'Simul request declined!';

        $link = base_url() . "Student/sample_simul";
        $this->send_notification($stud_number, $message, $link);
        $this->Simul_model->decline_simul($id);

        redirect('SuperAdmin/simul');
    }

    // =======================================================================================
    // END OF SIMUL MODULE
    // =======================================================================================

    public function admin_curriculum() // | Display All Curricula |
    {
        $data['labs'] = $this->Curriculum_model->fetchLab();
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/curricula/curricula', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // ADMIN PROFILE MODULE
    // =======================================================================================

    public function profile($error = null, $success = null) // | Display SuperAdmin Profile |
    {
        $data['account'] = $this->Account_model->view_user($this->session->acc_number);
        $data['success'] = $success;
        $data['error'] = $error;
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/profile/profile', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function changepass()
    {
        $this->form_validation->set_message('matches', 'Please make sure that your passwords match');
        $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|strip_tags');
        $this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|strip_tags|min_length[8]|max_length[20]|matches[renewpassword]');
        $this->form_validation->set_rules('renewpassword', 'Retype Password', 'trim|required|strip_tags|min_length[8]|max_length[20]');

        $old = $this->input->post('oldpassword');
        $new = $this->input->post('newpassword');

        if ($this->User_model->check_old_pass($this->session->acc_number, sha1($old))) {
            $this->User_model->changepass($this->session->acc_number, sha1($new));
            $success = "Password changed successfully!";
            $this->Profile(null, $success);
        } else {
            $error = "That was not your old password.";
            if ($this->form_validation->run() == FALSE) {
                $this->Profile($error, null);
            } else {
                $this->Profile($error, null);
            }
        }
    }

    // =======================================================================================
    // END OF PROFILE MODULE
    // =======================================================================================

    // =======================================================================================
    // CURRICULUM MODULE
    // =======================================================================================

    public function show_curriculum()
    {

        $this->form_validation->set_rules('CurriculumCode', 'Curriculum Code', 'required|strip_tags');
        $CurriculumCode = $this->input->post('CurriculumCode');

        if ($this->form_validation->run() == FALSE) {
            $this->curricula();
        } else {
            $data['curr'] = $this->Academics_model->fetch_curriculum_admin($CurriculumCode);
            $data['currCode'] = $CurriculumCode;
            $this->load->view('includes_super_admin/superadmin_header');

            $this->load->view('includes_super_admin/superadmin_topnav');
            $this->load->view('includes_super_admin/superadmin_sidebar');

            $this->load->view('content_super_admin/curricula/curricula', $data);

            $this->load->view('includes_super_admin/superadmin_contentFooter');
            $this->load->view('includes_super_admin/superadmin_rightnav');
            $this->load->view('includes_super_admin/superadmin_footer');
        }
    }

    // =======================================================================================
    // END OF CURRICULUM MODULE
    // =======================================================================================

    // =======================================================================================
    // COURSE PETITIONING MODULE
    // =======================================================================================

    public function process_petition()
    {
        $this->form_validation->set_rules('course_code', 'Course Code', 'required|strip_tags');
        $this->form_validation->set_rules('course_section', 'Section', 'required|strip_tags');
        $this->form_validation->set_rules('date_processed', 'Date Submitted', 'required|strip_tags');
        $this->form_validation->set_rules('course_description', 'Course Description', 'required|strip_tags');
        $this->form_validation->set_rules('time', 'Time', 'required|strip_tags');
        $this->form_validation->set_rules('day', 'Day', 'required|strip_tags');
        $this->form_validation->set_rules('room', 'Room', 'required|strip_tags');
        $this->form_validation->set_rules('faculty', 'faculty', 'required|strip_tags');

        $petition_ID = $this->input->post('petition_id');
        $course_code = $this->input->post('course_code');
        $date_processed = $this->input->post('date_processed');

        if ($this->form_validation->run() == FALSE) {
            $this->show_petition($petition_ID, $course_code);
        } else {
            $this->Petition_model->approve_petition($petition_ID, $date_processed);
            redirect('SuperAdmin/course_petitions');
        }
    }

    public function approve_petition()
    {
        //fetch number of petitioners
        //approve petition of more than or equal to 15 but less than of equal to 40
        $petitionID = $this->input->post('petitionID');
        $petition_unique = $this->input->post('petitionUnique');
        $petition_section = $this->input->post('petitionSection');

        $number_of_petitioners = $this->Petition_model->check_number_of_petitioners($petition_unique);

        if ($number_of_petitioners >= 1 && $number_of_petitioners <= 40) {
            //petition is approved
            $recipients = $this->Petition_model->fetch_petition_recipients($petition_unique);
            $notif_message = 'Petition approved!';
            $message['message'] = 'Petition approved!';
            $message['context'] = 'success';
            $link = base_url() . "Student/petitionView/" . $petitionID . "/" . $petition_unique;
            $this->send_notifications($recipients, $notif_message, $link);
            $this->Petition_model->approve_petition($petition_unique);
            $this->Petition_model->add_petition_to_offering($petitionID, $petition_section);
        } else {
            $message['message'] = 'Insufficient number of petitioners!';
            $message['context'] = 'failed';
        }

        echo json_encode($message);
    }

    public function decline_petition()
    {
        $petitionID = $this->input->post('petitionID');
        $petition_unique = $this->input->post('petitionUnique');

        //petition is declined
        $recipients = $this->Petition_model->fetch_petition_recipients($petition_unique);
        $notif_message = 'Petition declined!';
        $message['message'] = 'Petition declined!';
        $message['context'] = 'success';
        $link = base_url() . "Student/petitionView/" . $petitionID . "/" . $petition_unique;
        $this->send_notifications($recipients, $notif_message, $link);
        $this->Petition_model->decline_petition($petition_unique);

        echo json_encode($message);
    }

    public function show_petition($petition_ID, $petition_unique) // | Display Specific Student Account |
    {
        $data['petition'] = $this->Petition_model->fetchPetition($petition_ID);
        $data['petitioners'] = $this->Petition_model->fetchPetitioners($petition_unique);
        $data['courses'] = $this->Curriculum_model->fetchCoursesAdmin();
        $data['sections'] = $this->SuperAdmin_model->fetch_all_sections();
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/student_petitions/show_petition', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function save_sched()
    {
        echo json_encode($_POST['course_details']);
        echo json_encode($_POST['course_sched']);
    }

    public function fetch_updated_petition_status()
    {
        $petition_unique = $this->input->post('petitionUnique');
        $sample = $this->Petition_model->fetch_updated_petition_status($petition_unique);
        echo json_encode($sample);
    }

    // =======================================================================================
    // END OF COURSE PETITIONING MODULE
    // =======================================================================================

    // =======================================================================================
    // NOTIFICATION MODULE
    // =======================================================================================

    public function send_notifications($recipients, $message, $link)
    {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '8a5cfc7f91e3ec8112f4',
            'e5e5c5534c2aa13bb349',
            '880418',
            $options
        );

        $clients = array();
        foreach ($recipients as $recipient) {
            $notif_details = array(
                'notif_sender' => $this->session->acc_number,
                'notif_sender_name' => $this->session->Firstname . ' ' . $this->session->Lastname,
                'notif_recipient' => $recipient->stud_number,
                'notif_content' => $message,
                'notif_link' => $link,
                'notif_created_at' => time()
            );

            $this->Notification_model->notify($notif_details);
            array_push($clients, $recipient->stud_number);
        }

        $announcement['message'] = $message;
        $announcement['recipient'] = $clients;
        $pusher->trigger('my-channel', 'client_specific', $announcement);
    }

    public function send_notification($recipient, $message, $link)
    {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '8a5cfc7f91e3ec8112f4',
            'e5e5c5534c2aa13bb349',
            '880418',
            $options
        );

        $notif_details = array(
            'notif_sender' => $this->session->acc_number,
            'notif_sender_name' => $this->session->Firstname . ' ' . $this->session->Lastname,
            'notif_recipient' => $recipient,
            'notif_content' => $message,
            'notif_link' => $link,
            'notif_created_at' => time()
        );

        $this->Notification_model->notify($notif_details);

        $announcement['message'] = $message;
        $announcement['recipient'] = $recipient;
        $pusher->trigger('my-channel', 'client_specific', $announcement);
    }

    // =======================================================================================
    // END OF NOTIFICATIONS MODULE
    // =======================================================================================

    // =======================================================================================
    // OTHER MODULE
    // =======================================================================================

    public function admin_accounts() // | Display all admin accounts |
    {
        $data['admins'] = $this->Account_model->fetchAdminAccounts();
        $this->load->view('includes_super_admin/superadmin_header');

        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/admin_accounts', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function user_data_submit()
    {
        $data = array(
            'username' => $this->input->post('name'),
            'pwd' => $this->input->post('pwd')
        );

        //Either you can print value or you can send value to database
        echo json_encode($data);
    }

    // =======================================================================================
    // END OF OTHER MODULE
    // =======================================================================================

    public function index()
    {
        $error['error'] = "";
        $this->load->view('UserAuth/login-admin', $error);
    }

    public function login()
    {
        $data = array(
            'acc_number' => strip_tags($this->input->post('acc_number')), //$_POST['username]
            'acc_password' => sha1(strip_tags($this->input->post('acc_password')))
        );

        $this->User_model->login_admin($data);
        $error['error'] = "";

        if ($this->session->login) {
            if ($this->session->acc_status) {
                if ($this->session->access == 'admin') {
                    redirect('SuperAdmin/dashboard');
                } else if ($this->session->access == 'superadmin') {
                    redirect('SuperAdmin/school_parameters');
                } else {
                    redirect('SuperAdmin');
                }
            } else {
                $error['error'] = "Your Account has been blocked. Please contact your administrator for details";
                $this->load->view('UserAuth/login-admin', $error);
            }
        } else {
            $error['error'] = "Invalid login credentials";
            $this->load->view('UserAuth/login-admin', $error);
        }

        // if ($this->session->login) {
        //     if ($this->session->acc_status) {
        //         if ($this->session->access == 'superadmin' || $this->session->access == 'admin') {
        //             redirect('SuperAdmin/school_parameters');
        //         } else {
        //             redirect('SuperAdmin');
        //         }
        //     } else {
        //         $error['error'] = "Your Account has been blocked. Please contact your administrator for details";
        //         $this->load->view('UserAuth/login-admin', $error);
        //     }
        // } else {
        //     $error['error'] = "Invalid login credentials";
        //     $this->load->view('UserAuth/login-admin', $error);
        // }
    }

    public function logout()
    {
        session_destroy();
        redirect('Admin');
    }

    // =======================================================================================
    // DATABASE FUNCTIONALITIES
    // =======================================================================================

    public function database()
    {
        $data['faculty'] = $this->Account_model->fetchFaculty();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/database_management/database_management', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function empty_petitions()
    {
        $this->SuperAdmin_model->empty_petitions();
        redirect('SuperAdmin/database');
    }

    public function empty_notifications()
    {
        $this->SuperAdmin_model->empty_notifications();
        redirect('SuperAdmin/database');
    }

    public function empty_overload_underload()
    {
        $this->SuperAdmin_model->empty_overload_underload();
        redirect('SuperAdmin/database');
    }

    // =======================================================================================
    // END FOF DATABASE FUNCTIONALITIES
    // =======================================================================================

    // =======================================================================================
    // STUDENTS
    // =======================================================================================

    public function students($success_msg = null, $fail_msg = null)
    {
        $data['students'] = $this->SuperAdmin_model->fetch_all_student();
        // print_r($data);
        // die();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_student/all_students', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }


    public function fetch_last_student_number()
    {
        $last = $this->SuperAdmin_model->fetch_last_student_number();

        if (isset($last)) {
            $current = substr($this->session->curr_year, 0, 4) . ($this->session->curr_term);
        } else {
            $current = substr($this->session->curr_year, 0, 4) . ($this->session->curr_term + 1) * 10000;
            $current = $current + 1;
        }
        // $this->dd($current);
        return $current;
    }

    public function generate_stud_number()
    {
        $current_sy = $this->SuperAdmin_model->fetch_current();

        $curr_year = $current_sy->school_year;
        $curr_term = $current_sy->school_term;

        $result = $this->SuperAdmin_model->fetch_last_student_number();
        // $current_term = substr($curr_year, 0, 4) . $curr_term;

        // $result = (object) array(
        //     'acc_number' => 201920185
        // );

        $current_prefix = substr($curr_year, 0, 4) . $curr_term; // YYYYT

        $last_entry = $result->acc_number; // YYYYTXXXXX

        $last_prefix = substr($last_entry, 0, 5); // YYYYT

        // IF NEW STUDENT
        if ($curr_term < 3) {
            $stud_prefix = (substr($curr_year, 0, 4) . ($curr_term + 1));
        } else {
            $stud_prefix = ((substr($curr_year, 0, 4) + 1) . 1);
        }

        if ($last_prefix == $current_prefix) {
            $assigned = $last_entry + 1;
        } else if ($last_prefix < $current_prefix) {
            $assigned = ($stud_prefix * 10000) + 1;
        } else {
            $assigned  = 'error';
        }

        return $assigned;
        // $this->dd($assigned);
        // die();
    }


    public function add_student($message = null)
    {
        // $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['programs'] = $this->SuperAdmin_model->fetch_all_program();
        $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['curricula'] = $this->SuperAdmin_model->fetch_all_curricula();
        $data['specs'] = $this->SuperAdmin_model->fetch_all_specializations();

        $data['message'] = $message;
        // $data['stud_number'] = $this->generate_stud_number();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_student/add_student', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function view_student($id, $success_msg = null, $fail_msg = null)
    {
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['student'] = $this->SuperAdmin_model->fetch_student($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        // print_r($data);
        // die();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_student/view_student', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_student($id, $success_msg = null, $fail_msg = null)
    {
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['student'] = $this->SuperAdmin_model->fetch_student($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        // print_r($data);
        // die();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_student/edit_student', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_student_function()
    {
        $this->form_validation->set_rules('acc_number', 'Student Code', 'required|strip_tags');
        $id = $this->input->post('program_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_program($id);
        } else {
            $program = array(
                'program_code' => $this->input->post('program_code'),
                'program_description' => $this->input->post('program_description'),
                'assigned_department' => $this->input->post('assigned_department')
            );

            $this->SuperAdmin_model->edit_program($id, $program);
            $this->edit_program($id, "Record successfully edited!");
        }
    }

    public function add_student_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_student_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_student($message);
    }

    public function create_student()
    {
        // $this->dd($_POST);
        // $this->dd(substr($current_sy->school_year, 0, 4) . ($current_sy->school_term < 3 ? $current_sy->school_term + 1 : 1) . $last_number);
        // $this->form_validation->set_rules('acc_number', 'Student number', 'required|strip_tags|is_unique[accounts_tbl.acc_number]');

        $this->form_validation->set_rules('acc_fname', 'First Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_mname', 'Middle Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_lname', 'Last Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_program', 'Program designation', 'required|strip_tags');
        $this->form_validation->set_rules('acc_college', 'College designation', 'required|strip_tags');
        $this->form_validation->set_rules('curriculum_code', 'Curriculum code', 'required|strip_tags');
        $this->form_validation->set_rules('acc_specialization', 'Specialization', 'required|strip_tags');
        $this->form_validation->set_rules('acc_access_level', 'Access level', 'required|strip_tags');
        $this->form_validation->set_rules('acc_citizenship', 'Citizenship', 'required|strip_tags');

        $data['current_sy'] = $this->SuperAdmin_model->fetch_current();

        if ($this->form_validation->run() == FALSE) {
            $this->add_student();
        } else {
            $studNumber = $this->generate_stud_number();
            $student = array(
                'acc_number' => $studNumber,
                'acc_username' => $studNumber,
                'acc_password' => sha1('itamaraw'),
                'acc_fname' => $this->input->post('acc_fname'),
                'acc_mname' => $this->input->post('acc_mname'),
                'acc_lname' => $this->input->post('acc_lname'),
                'acc_program' => $this->input->post('acc_program'),
                'acc_college' => $this->input->post('acc_college'),
                'acc_specialization' => $this->input->post('acc_specialization'),
                'curriculum_code' => $this->input->post('curriculum_code'),
                'acc_citizenship' => $this->input->post('acc_citizenship'),
                'acc_status' => $this->input->post('acc_status'),
                'acc_access_level' => $this->input->post('acc_access_level')
            );

            $this->SuperAdmin_model->create_student($student);

            $message = '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i>Success!</h4>
                    <p>Record successfully added!</p>
                    <p>Please successfully added!</p>
                </div>
                ';

            $this->add_student($message);
        }
    }

    // public function delete_program($id)
    // {

    //     if (!$this->SuperAdmin_model->delete_program($id)) {
    //         $this->SuperAdmin_model->delete_program($id);
    //         $this->program("Record successfully deleted!", null);
    //     } else {
    //         $this->program(null, "Failed to delete Record!");
    //     }
    // }

    // =======================================================================================
    // END OF STUDENTS
    // =======================================================================================

    // =======================================================================================
    // CLASSES
    // =======================================================================================

    public function classes()
    {
        $data['classes'] = $this->SuperAdmin_model->fetch_all_classes();
        $data['faculties'] = $this->SuperAdmin_model->fetch_all_faculty();
        // $this->dd($data);

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_class/all_classes', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_class($message = null)
    {
        $data['courses'] = $this->SuperAdmin_model->fetch_all_courses();
        $data['sections'] = $this->SuperAdmin_model->fetch_all_sections();
        $data['faculties'] = $this->SuperAdmin_model->fetch_all_faculty();
        $data['message'] = $message;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_class/add_class', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function create_class()
    {
        $this->form_validation->set_rules('class_code', 'Course Code', 'required|strip_tags');
        $this->form_validation->set_rules('section_code', 'Section Code', 'required|strip_tags');
        $this->form_validation->set_rules('faculty_id', 'Faculty assignment', 'required|strip_tags');
        $this->form_validation->set_rules('class_capacity', 'Class capacity', 'required|strip_tags|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->add_class();
        } else {
            $current_sy = $this->SuperAdmin_model->fetch_current();
            $class = array(
                'class_code' => $this->input->post('class_code'),
                'class_section' => $this->input->post('section_code'),
                'class_faculty' => $this->input->post('faculty_id'),
                'class_sched' => $this->input->post('class_code') . $this->input->post('section_code'),
                'class_capacity' => $this->input->post('class_capacity'),
                'school_year' => $current_sy->school_year,
                'school_term' => $current_sy->school_term
            );

            if ($this->SuperAdmin_model->fetch_specific_class($class['class_sched']) > 0) {
                $message = '
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i>Warning!</h4>
                    <p>Class already exists!</p>
                </div>
                ';
            } else {
                $this->SuperAdmin_model->create_class($class);
                $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully edited!</p>
        </div>
        ';
            }

            $this->add_class($message);
        }

        // $this->SuperAdmin_model->create_class($class_sched);
    }

    public function edit_class($id, $message = null)
    {
        $data['courses'] = $this->SuperAdmin_model->fetch_all_courses();
        $data['sections'] = $this->SuperAdmin_model->fetch_all_sections();
        $data['faculties'] = $this->SuperAdmin_model->fetch_all_faculty();
        $data['class'] = $this->SuperAdmin_model->fetch_class($id);
        $class_sched = $data['class']->class_code . $data['class']->class_section;
        $data['class_scheds'] = $this->SuperAdmin_model->fetch_class_sched($class_sched);
        $data['message'] = $message;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_class/edit_class', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_class_function()
    {
        $this->form_validation->set_rules('class_capacity', 'Class Capacity', 'required|strip_tags|trim|is_natural|less_than_equal_to[40]');

        $class_id = $this->input->post('class_id');
        $class_data = array(
            'class_faculty' => $this->input->post('faculty_id'),
            'class_capacity' => $this->input->post('class_capacity')
        );

        if ($this->form_validation->run() == FALSE) {
            $this->edit_class($class_id);
        } else {
            $this->SuperAdmin_model->edit_class($class_id, $class_data);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully edited!</p>
        </div>
        ';
            $this->edit_class($class_id, $message);
        }
    }

    public function view_class($id, $message = null)
    {
        $data['courses'] = $this->SuperAdmin_model->fetch_all_courses();
        $data['sections'] = $this->SuperAdmin_model->fetch_all_sections();
        $data['faculties'] = $this->SuperAdmin_model->fetch_all_faculty();
        $data['class'] = $this->SuperAdmin_model->fetch_class($id);
        $data['message'] = $message;

        $class_sched = $data['class']->class_code . $data['class']->class_section;
        $data['class_scheds'] = $this->SuperAdmin_model->fetch_class_sched($class_sched);

        // $this->dd($data['class_scheds']);

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_class/view_class', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function delete_class($id)
    {

        if (!$this->SuperAdmin_model->delete_class($id)) {
            $this->SuperAdmin_model->delete_class($id);
            $this->classes("Record successfully deleted!", null);
        } else {
            $this->classes(null, "Failed to delete Record!");
        }
    }

    public function add_sched()
    {

        $this->form_validation->set_rules('class_day', 'class day', 'required|strip_tags');
        $this->form_validation->set_rules('class_room', 'class day', 'required|strip_tags');
        $this->form_validation->set_rules('class_start_time', 'class day', 'required|strip_tags');
        $this->form_validation->set_rules('class_end_time', 'class day', 'required|strip_tags');

        $id = $this->input->post('class_id');
        $current_sy = $this->SuperAdmin_model->fetch_current();

        $class_sched = array(
            'class_day' => $this->input->post('class_day'),
            'class_start_time' => date('H:i', strtotime($this->input->post('class_start_time'))),
            'class_end_time' => date('H:i', strtotime($this->input->post('class_end_time'))),
            'class_room' => $this->input->post('class_room'),
            'class_sched' => $this->input->post('class_sched'),
            'school_year' => $current_sy->school_year,
            'school_term' => $current_sy->school_term
        );

        if ($this->form_validation->run() == FALSE) {
            $this->edit_class($id);
        } else {
            $message = $this->SuperAdmin_model->add_sched($class_sched);
            $this->edit_class($id, $message);
        }
    }

    public function delete_sched($class_id, $cs_id)
    {
        if (!$this->SuperAdmin_model->delete_sched($cs_id)) {
            $this->SuperAdmin_model->delete_sched($cs_id);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully deleted!</p>
        </div>
        ';
            $this->edit_class($class_id, $message);
        } else {
            $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Failed to delete record!</p>
        </div>
        ';
            $this->edit_class($class_id, $message);
        }
    }

    // =======================================================================================
    // END OF CLASSES
    // =======================================================================================

    // =======================================================================================
    // STUDENT FUNCTIONALITIES
    // =======================================================================================

    // public function student()
    // {
    //     $data['students'] = $this->Account_model->fetchStudents();
    //     $this->load->view('includes_super_admin/superadmin_header');
    //     $this->load->view('includes_super_admin/superadmin_topnav');
    //     $this->load->view('includes_super_admin/superadmin_sidebar');

    //     $this->load->view('content_super_admin/manage_student/all_students', $data);

    //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    //     $this->load->view('includes_super_admin/superadmin_rightnav');
    //     $this->load->view('includes_super_admin/superadmin_footer');
    // }

    // public function add_student()
    // {
    //     $this->load->view('includes_super_admin/superadmin_header');
    //     $this->load->view('includes_super_admin/superadmin_topnav');
    //     $this->load->view('includes_super_admin/superadmin_sidebar');

    //     $this->load->view('content_super_admin/manage_student/add_student');

    //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    //     $this->load->view('includes_super_admin/superadmin_rightnav');
    //     $this->load->view('includes_super_admin/superadmin_footer');
    // }

    // public function view_student()
    // {
    //     $this->load->view('includes_super_admin/superadmin_header');
    //     $this->load->view('includes_super_admin/superadmin_topnav');
    //     $this->load->view('includes_super_admin/superadmin_sidebar');

    //     $this->load->view('content_super_admin/manage_students/view_student');

    //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    //     $this->load->view('includes_super_admin/superadmin_rightnav');
    //     $this->load->view('includes_super_admin/superadmin_footer');
    // }

    // public function edit_student()
    // {
    //     $this->load->view('includes_super_admin/superadmin_header');
    //     $this->load->view('includes_super_admin/superadmin_topnav');
    //     $this->load->view('includes_super_admin/superadmin_sidebar');

    //     $this->load->view('content_super_admin/manage_students/edit_student');

    //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    //     $this->load->view('includes_super_admin/superadmin_rightnav');
    //     $this->load->view('includes_super_admin/superadmin_footer');
    // }

    // =======================================================================================
    // END OF STUDENT FUNCTIONALITIES
    // =======================================================================================

    // =======================================================================================
    // COLLEGE
    // =======================================================================================

    public function college($success_msg = null, $fail_msg = null)
    {
        $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_college/all_college', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_college($message = null)
    {
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_college/add_college', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_college($id, $success_msg = null, $fail_msg = null)
    {
        $data['college'] = $this->SuperAdmin_model->fetch_college($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_college/edit_college', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_college_function()
    {
        $id = $this->input->post('college_id');
        $college = $this->SuperAdmin_model->fetch_college($id);
        $college_post = array(
            'college_code' => $this->input->post('college_code'),
            'college_description' => $this->input->post('college_description')
        );
        $this->form_validation->set_rules('college_code', 'College Code', 'required|strip_tags');
        $this->form_validation->set_rules('college_description', 'College Description', 'required|strip_tags');
        if ($college->college_code != $college_post['college_code']) {
            $this->form_validation->set_rules('college_code', 'College Code', 'required|strip_tags|is_unique[college_tbl.college_code]');
        }
        if ($college->college_description != $college_post['college_description']) {
            $this->form_validation->set_rules('college_description', 'College Description', 'required|strip_tags|is_unique[college_tbl.college_description]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->edit_college($id);
        } else {
            $this->SuperAdmin_model->edit_college($id, $college_post);
            $this->edit_college($id, "Record successfully edited!");
        }
    }

    public function add_college_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_college_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_college($message);
    }

    public function create_college()
    {
        $this->form_validation->set_rules(
            'college_code',
            'College Code',
            'required|strip_tags|is_unique[college_tbl.college_code]',
            array('is_unique' => 'This college already exists!')
        );
        $this->form_validation->set_rules('college_description', 'College Description', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_college();
        } else {
            $college = array(
                'college_code' => $this->input->post('college_code'),
                'college_description' => $this->input->post('college_description')
            );

            $this->SuperAdmin_model->create_college($college);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_college($message);
        }
    }

    public function delete_college($id)
    {

        if (!$this->SuperAdmin_model->delete_college($id)) {
            $this->SuperAdmin_model->delete_college($id);
            $this->college("Record successfully deleted!", null);
        } else {
            $this->college(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF COLLEGE
    // =======================================================================================

    // =======================================================================================
    // faculty
    // =======================================================================================

    public function faculties($success_msg = null, $fail_msg = null)
    {
        $data['faculties'] = $this->SuperAdmin_model->fetch_all_faculty();
        // print_r($data);
        // die();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_faculty/all_faculties', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_faculty($message = null)
    {
        // $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['programs'] = $this->SuperAdmin_model->fetch_all_program();
        $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['curricula'] = $this->SuperAdmin_model->fetch_all_curricula();
        $data['specs'] = $this->SuperAdmin_model->fetch_all_specializations();
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_faculty/add_faculty', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_faculty($id, $success_msg = null, $fail_msg = null)
    {
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['faculty'] = $this->SuperAdmin_model->fetch_faculty($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        // print_r($data);
        // die();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_faculty/edit_faculty', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_faculty_function()
    {
        $this->form_validation->set_rules('acc_number', 'faculty Code', 'required|strip_tags');
        $id = $this->input->post('program_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_program($id);
        } else {
            $program = array(
                'program_code' => $this->input->post('program_code'),
                'program_description' => $this->input->post('program_description'),
                'assigned_department' => $this->input->post('assigned_department')
            );

            $this->SuperAdmin_model->edit_program($id, $program);
            $this->edit_program($id, "Record successfully edited!");
        }
    }

    public function add_faculty_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_faculty_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_faculty($message);
    }

    public function create_faculty()
    {
        $this->form_validation->set_rules('acc_number', 'Student number', 'required|strip_tags|is_unique[accounts_tbl.acc_number]');
        $this->form_validation->set_rules('acc_fname', 'First Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_mname', 'Middle Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_lname', 'Last Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_program', 'Program designation', 'required|strip_tags');
        $this->form_validation->set_rules('acc_college', 'College designation', 'required|strip_tags');

        $this->form_validation->set_rules('acc_citizenship', 'Citizenship', 'required|strip_tags');
        $this->form_validation->set_rules('acc_access_level', 'Access level', 'required|strip_tags');
        $this->form_validation->set_rules('acc_citizenship', 'Citizenship', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_faculty();
        } else {
            $program = array(
                'acc_number' => $this->input->post('acc_number'),
                'acc_password' => sha1('itamaraw'),
                'acc_fname' => $this->input->post('acc_fname'),
                'acc_mname' => $this->input->post('acc_mname'),
                'acc_lname' => $this->input->post('acc_lname'),
                'acc_program' => $this->input->post('acc_program'),
                'acc_college' => $this->input->post('acc_college'),
                'acc_citizenship' => $this->input->post('acc_citizenship'),
                'acc_status' => $this->input->post('acc_status'),
                'acc_access_level' => $this->input->post('acc_access_level')
            );

            $this->SuperAdmin_model->create_faculty($program);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_faculty($message);
        }
    }

    // public function delete_program($id)
    // {

    //     if (!$this->SuperAdmin_model->delete_program($id)) {
    //         $this->SuperAdmin_model->delete_program($id);
    //         $this->program("Record successfully deleted!", null);
    //     } else {
    //         $this->program(null, "Failed to delete Record!");
    //     }
    // }

    // =======================================================================================
    // END OF faculty
    // =======================================================================================

    // =======================================================================================
    // FINANCE
    // =======================================================================================

    public function finances($success_msg = null, $fail_msg = null)
    {
        // $data['finances'] = $this->SuperAdmin_model->fetch_all_finance();
        $data['school_years'] = $this->SuperAdmin_model->fetch_all_sy();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_finance/all_finance', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_finance($message = null)
    {
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_finance/add_finance', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_finance($id, $success_msg = null, $fail_msg = null)
    {
        $data['school_year'] = $this->SuperAdmin_model->fetch_current_sy($id);
        // $this->dd($data);
        // $data['finance'] = $this->SuperAdmin_model->fetch_finance($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_finance/view_finance', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_finance_function()
    {
        $id = $this->input->post('finance_id');
        $finance = $this->SuperAdmin_model->fetch_finance($id);
        $finance_post = array(
            'finance_code' => $this->input->post('finance_code'),
            'finance_value' => $this->input->post('finance_value')
        );

        $this->form_validation->set_rules('finance_code', 'Finance Code', 'required|strip_tags');

        if ($finance->finance_code != $finance_post['finance_code']) {
            $this->form_validation->set_rules('finance_code', 'Finance Code', 'required|strip_tags|is_unique[finance_tbl.finance_code]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->edit_finance($id);
        } else {
            $this->SuperAdmin_model->edit_finance($id, $finance_post);
            $this->edit_finance($id, "Record successfully edited!");
        }
    }

    public function add_finance_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_finance_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_finance($message);
    }

    public function create_finance()
    {
        // $this->dd($_POST);
        $this->form_validation->set_rules(
            'finance_code',
            'Finance Code',
            'required|strip_tags|is_unique[finance_tbl.finance_code]',
            array('is_unique' => 'This parameter already exists!')
        );
        $this->form_validation->set_rules('finance_value', 'Value', 'required|strip_tags|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->add_finance();
        } else {
            $finance = array(
                'finance_code' => $this->input->post('finance_code'),
                'finance_value' => round($this->input->post('finance_value'), 2)
            );

            $this->SuperAdmin_model->create_finance($finance);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_finance($message);
        }
    }

    public function delete_finance($id)
    {

        if (!$this->SuperAdmin_model->delete_finance($id)) {
            $this->SuperAdmin_model->delete_finance($id);
            $this->finances("Record successfully deleted!", null);
        } else {
            $this->finances(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF FINANCE
    // =======================================================================================

    // =======================================================================================
    // PROGRAM
    // =======================================================================================

    public function program($success_msg = null, $fail_msg = null)
    {
        $data['programs'] = $this->SuperAdmin_model->fetch_all_program();
        // print_r($data);
        // die();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_program/all_program', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_program($message = null)
    {
        // $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_program/add_program', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_program($id, $success_msg = null, $fail_msg = null)
    {
        // $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['program'] = $this->SuperAdmin_model->fetch_program($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        // print_r($data);
        // die();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_program/edit_program', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_program_function()
    {
        $this->form_validation->set_rules('program_code', 'Program Code', 'required|strip_tags');
        $this->form_validation->set_rules('program_description', 'Program Description', 'required|strip_tags');
        $this->form_validation->set_rules('assigned_department', 'Department assignment', 'required|strip_tags');
        $id = $this->input->post('program_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_program($id);
        } else {
            $program = array(
                'program_code' => $this->input->post('program_code'),
                'program_description' => $this->input->post('program_description'),
                'assigned_department' => $this->input->post('assigned_department')
            );

            $this->SuperAdmin_model->edit_program($id, $program);
            $this->edit_program($id, "Record successfully edited!");
        }
    }

    public function add_program_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_program_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_program($message);
    }

    public function create_program()
    {
        $this->form_validation->set_rules('program_code', 'Program Code', 'required|strip_tags|is_unique[programs_tbl.program_code]');
        $this->form_validation->set_rules('program_description', 'Program Description', 'required|strip_tags');
        $this->form_validation->set_rules('assigned_department', 'Department assignment', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_program();
        } else {
            $program = array(
                'program_code' => $this->input->post('program_code'),
                'program_description' => $this->input->post('program_description'),
                // 'assigned_college' => $this->input->post('assigned_college'),
                'assigned_department' => $this->input->post('assigned_department')
            );

            $this->SuperAdmin_model->create_program($program);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_program($message);
        }
    }

    public function delete_program($id)
    {

        if (!$this->SuperAdmin_model->delete_program($id)) {
            $this->SuperAdmin_model->delete_program($id);
            $this->program("Record successfully deleted!", null);
        } else {
            $this->program(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF PROGRAM
    // =======================================================================================

    // =======================================================================================
    // DEPARTMENT
    // =======================================================================================

    public function department($success_msg = null, $fail_msg = null)
    {
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_department/all_department', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_department($message = null)
    {
        $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_department/add_department', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_department($id, $success_msg = null, $fail_msg = null)
    {
        $data['department'] = $this->SuperAdmin_model->fetch_department($id);
        $data['colleges'] = $this->SuperAdmin_model->fetch_all_college();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_department/edit_department', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_department_function()
    {
        $id = $this->input->post('department_id');
        $department = $this->SuperAdmin_model->fetch_department($id);
        $department_post = array(
            'department_code' => $this->input->post('department_code'),
            'department_description' => $this->input->post('department_description'),
            'assigned_college' => $this->input->post('assigned_college')
        );

        $this->form_validation->set_rules('department_code', 'Department Code', 'required|strip_tags');
        $this->form_validation->set_rules('department_description', 'Department Description', 'required|strip_tags');
        $this->form_validation->set_rules('assigned_college', 'College assignment', 'required|strip_tags');

        if ($department->department_code != $department_post['department_code']) {
            $this->form_validation->set_rules('department_code', 'Department Code', 'required|strip_tags|is_unique[department_tbl.department_code]');
        }
        if ($department->department_description != $department_post['department_description']) {
            $this->form_validation->set_rules('department_description', 'Department description', 'required|strip_tags|is_unique[department_tbl.department_description]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->edit_department($id);
        } else {
            $this->SuperAdmin_model->edit_department($id, $department_post);
            $this->edit_department($id, "Record successfully edited!");
        }
    }

    public function add_department_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_department_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_department($message);
    }

    public function create_department()
    {
        $this->form_validation->set_rules(
            'department_code',
            'Department Code',
            'required|strip_tags|is_unique[department_tbl.department_code]',
            array('is_unique' => 'This department already exists!')
        );
        $this->form_validation->set_rules('department_description', 'Department Description', 'required|strip_tags');
        $this->form_validation->set_rules('assigned_college', 'College assignment', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_department();
        } else {
            $department = array(
                'department_code' => $this->input->post('department_code'),
                'department_description' => $this->input->post('department_description'),
                'assigned_college' => $this->input->post('assigned_college')
            );

            $this->SuperAdmin_model->create_department($department);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_department($message);
        }
    }

    public function delete_department($id)
    {

        if (!$this->SuperAdmin_model->delete_department($id)) {
            $this->SuperAdmin_model->delete_department($id);
            $this->department("Record successfully deleted!", null);
        } else {
            $this->department(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF DEPARTMENT
    // =======================================================================================

    // =======================================================================================
    // SPECIALIZATION
    // =======================================================================================

    public function specialization($success_msg = null, $fail_msg = null)
    {
        $data['specializations'] = $this->SuperAdmin_model->fetch_all_specializations();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_spec/all_spec', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_specialization($message = null)
    {
        $data['programs'] = $this->SuperAdmin_model->fetch_all_program();
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_spec/add_spec', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_specialization($id, $success_msg = null, $fail_msg = null)
    {
        $data['programs'] = $this->SuperAdmin_model->fetch_all_program();
        $data['specialization'] = $this->SuperAdmin_model->fetch_specialization($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_spec/edit_spec', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_specialization_function()
    {
        $this->form_validation->set_rules('specialization_code', 'Specialization Code', 'required|strip_tags');
        $this->form_validation->set_rules('specialization_description', 'specialization Description', 'required|strip_tags');
        $id = $this->input->post('specialization_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_specialization($id);
        } else {
            $specialization = array(
                'specialization_code' => $this->input->post('specialization_code'),
                'specialization_description' => $this->input->post('specialization_description')
            );

            $this->SuperAdmin_model->edit_specialization($id, $specialization);
            $this->edit_specialization($id, "Record successfully edited!");
        }
    }

    public function add_specialization_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_specialization_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_specialization($message);
    }

    public function create_specialization()
    {
        $this->form_validation->set_rules('specialization_code', 'Specialization Code', 'required|strip_tags|is_unique[specialization_tbl.specialization_code]');
        $this->form_validation->set_rules('specialization_description', 'Specialization Description', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_specialization();
        } else {
            $specialization = array(
                'specialization_code' => $this->input->post('specialization_code'),
                'specialization_description' => $this->input->post('specialization_description'),
                'assigned_program' => $this->input->post('assigned_program'),
            );

            $this->SuperAdmin_model->create_specialization($specialization);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_specialization($message);
        }
    }

    public function delete_specialization($id)
    {
        if (!$this->SuperAdmin_model->delete_specialization($id)) {
            $this->SuperAdmin_model->delete_specialization($id);
            $this->specialization("Record successfully deleted!", null);
        } else {
            $this->specialization(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF SPECIALIZATION
    // =======================================================================================

    // =======================================================================================
    // CURRICULUM
    // =======================================================================================

    public function curriculum($success_msg = null, $fail_msg = null)
    {
        $data['curricula'] = $this->SuperAdmin_model->fetch_all_curricula();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_curriculum/all_curriculum', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_curriculum($message = null)
    {
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_curriculum/add_curriculum', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_course_curriculum($curriculum_code, $success_msg = null, $fail_msg = null, $message = null)
    {
        $data['message'] = $message;
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;
        $data['curriculum_code'] = $this->SuperAdmin_model->fetch_curriculum($curriculum_code);

        $data['courses'] = $this->Academics_model->fetch_all_courses();
        $data['laboratories'] = $this->Academics_model->fetch_all_laboratories();
        $data['curriculum'] = $this->SuperAdmin_model->fetch_single_curriculum($curriculum_code);
        // $this->dd($data['curriculum']);
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_curriculum/add_course_curriculum', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_course_to_curriculum()
    {
        $this->form_validation->set_rules('course_code', 'Course Code', 'required|strip_tags');
        $this->form_validation->set_rules('laboratory_code', 'Laboratory Code', 'required|strip_tags');
        $this->form_validation->set_rules('curriculum_code', 'Curriculum Code', 'required|strip_tags');
        $this->form_validation->set_rules('year', 'Year', 'required|strip_tags');
        $this->form_validation->set_rules('term', 'Term', 'required|strip_tags');
        $curriculum_code = $this->input->post('curriculum_code');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_curriculum($curriculum_code);
        } else {
            $curriculum = array(
                'course_code' => $this->input->post('course_code'),
                'laboratory_code' => $this->input->post('laboratory_code'),
                'curriculum_code' => $this->input->post('curriculum_code'),
                'year' => $this->input->post('year'),
                'term' => $this->input->post('term')
            );

            $this->SuperAdmin_model->add_course_to_curriculum($curriculum);
            $this->add_course_curriculum($curriculum_code, "Record successfully edited!");
        }
    }

    public function add_curriculum_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_curriculum_csv($_FILES['csv_file'], $_POST['curriculum_code']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_course_curriculum($_POST['curriculum_code'], null, null, $message);
    }

    public function edit_curriculum($curriculum_code, $success_msg = null, $fail_msg = null)
    {
        // $id = $this->input->post('college_id');
        $data['curriculum'] = $this->SuperAdmin_model->fetch_curriculum($curriculum_code);

        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_curriculum/edit_curriculum', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_curriculum_function()
    {
        $this->form_validation->set_rules('curriculum_code', 'Curriculum Code', 'required|strip_tags');
        $this->form_validation->set_rules('assigned_department', 'Department assignment', 'required|strip_tags');
        $curriculum_code = $this->input->post('curriculum_code');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_curriculum($curriculum_code);
        } else {
            $curriculum = array(
                'curriculum_code' => $this->input->post('curriculum_code'),
                'assigned_department' => $this->input->post('assigned_department')
            );
            $this->SuperAdmin_model->edit_curriculum($curriculum_code, $curriculum);
            $this->edit_curriculum($curriculum_code, "Record successfully edited!");
        }
    }

    public function delete_course_from_curriculum($id, $curr_code)
    {
        if (!$this->SuperAdmin_model->delete_course_from_curriculum($id)) {
            $this->SuperAdmin_model->delete_course_from_curriculum($id);
            $this->add_course_curriculum($curr_code, "Record successfully deleted!");
        } else {
            $this->add_course_curriculum($curr_code, null, "Failed to delete Record!");
        }
    }

    public function create_curriculum()
    {
        $this->form_validation->set_rules('curriculum_code', 'Curriculum Code', 'required|strip_tags|is_unique[curriculum_code_tbl.curriculum_code]');
        $this->form_validation->set_rules('assigned_department', 'Department assignment', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_curriculum();
        } else {
            $curriculum = array(
                'curriculum_code' => $this->input->post('curriculum_code'),
                'assigned_department' => $this->input->post('assigned_department')
            );

            $this->SuperAdmin_model->create_curriculum($curriculum);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_curriculum($message);
        }
    }

    public function delete_curriculum($curriculum_code)
    {

        if (!$this->SuperAdmin_model->delete_curriculum($curriculum_code)) {
            $this->SuperAdmin_model->delete_curriculum($curriculum_code);
            $this->curriculum("Record successfully deleted!", null);
        } else {
            $this->curriculum(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF CURRICULUM
    // =======================================================================================

    // =======================================================================================
    // STUDENTS FUNCTIONALITIES
    // =======================================================================================

    // public function students()
    // {
    //     $this->load->view('includes_super_admin/superadmin_header');
    //     $this->load->view('includes_super_admin/superadmin_topnav');
    //     $this->load->view('includes_super_admin/superadmin_sidebar');

    //     $this->load->view('content_super_admin/manage_students/manage_students');

    //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    //     $this->load->view('includes_super_admin/superadmin_rightnav');
    //     $this->load->view('includes_super_admin/superadmin_footer');
    // }

    // // public function add_student()
    // // {
    // //     $this->load->view('includes_super_admin/superadmin_header');
    // //     $this->load->view('includes_super_admin/superadmin_topnav');
    // //     $this->load->view('includes_super_admin/superadmin_sidebar');

    // //     $this->load->view('content_super_admin/manage_students/add_student');

    // //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    // //     $this->load->view('includes_super_admin/superadmin_rightnav');
    // //     $this->load->view('includes_super_admin/superadmin_footer');
    // // }

    // public function course_card()
    // {
    //     $this->load->view('includes_super_admin/superadmin_header');
    //     $this->load->view('includes_super_admin/superadmin_topnav');
    //     $this->load->view('includes_super_admin/superadmin_sidebar');

    //     $this->load->view('content_super_admin/manage_students/course_card');

    //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    //     $this->load->view('includes_super_admin/superadmin_rightnav');
    //     $this->load->view('includes_super_admin/superadmin_footer');
    // }

    // public function balance()
    // {
    //     $this->load->view('includes_super_admin/superadmin_header');
    //     $this->load->view('includes_super_admin/superadmin_topnav');
    //     $this->load->view('includes_super_admin/superadmin_sidebar');

    //     $this->load->view('content_super_admin/manage_students/balance');

    //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    //     $this->load->view('includes_super_admin/superadmin_rightnav');
    //     $this->load->view('includes_super_admin/superadmin_footer');
    // }

    // public function payment()
    // {
    //     $this->load->view('includes_super_admin/superadmin_header');
    //     $this->load->view('includes_super_admin/superadmin_topnav');
    //     $this->load->view('includes_super_admin/superadmin_sidebar');

    //     $this->load->view('content_super_admin/manage_students/payment');

    //     $this->load->view('includes_super_admin/superadmin_contentFooter');
    //     $this->load->view('includes_super_admin/superadmin_rightnav');
    //     $this->load->view('includes_super_admin/superadmin_footer');
    // }

    // public function create_student()
    // {
    //     $this->form_validation->set_rules('acc_number', 'Student number', 'required|strip_tags');
    //     $this->form_validation->set_rules('acc_fname', 'First Name', 'required|strip_tags');
    //     $this->form_validation->set_rules('acc_mname', 'Middle Name', 'required|strip_tags');
    //     $this->form_validation->set_rules('acc_lname', 'Last Name', 'required|strip_tags');
    //     $this->form_validation->set_rules('acc_citizenship', 'Citizenship', 'required|strip_tags');
    //     $this->form_validation->set_rules('acc_program', 'Program', 'required|strip_tags');
    //     $this->form_validation->set_rules('acc_college', 'College', 'required|strip_tags');
    //     $this->form_validation->set_rules('curriculum_code', 'Curriculum', 'required|strip_tags');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->add_student();
    //     } else {
    //         $data = array(
    //             'acc_number' => $this->input->post('acc_number'),
    //             'acc_fname' => $this->input->post('acc_fname'),
    //             'acc_mname' => $this->input->post('acc_mname'),
    //             'acc_lname' => $this->input->post('acc_lname'),
    //             'acc_username' => $this->input->post('acc_number'),
    //             'acc_password' => sha1('stud'),
    //             'acc_citizenship' => $this->input->post('acc_citizenship'),
    //             'acc_program' => $this->input->post('acc_program'),
    //             'acc_college' => $this->input->post('acc_college'),
    //             'acc_access_level' => 3,
    //             'curriculum_code' => $this->input->post('curriculum_code')
    //         );

    //         $this->SuperAdmin_model->create_student($data);
    //         redirect('SuperAdmin/add_student');
    //     }
    // }

    // public function submit_course_card()
    // {
    //     $this->form_validation->set_rules('cc_course', 'Course Code', 'required|strip_tags');
    //     $this->form_validation->set_rules('cc_section', 'Section', 'required|strip_tags');
    //     $this->form_validation->set_rules('cc_midterm', 'Midterm Grade', 'required|strip_tags');
    //     $this->form_validation->set_rules('cc_final', 'Final Grade', 'required|strip_tags');
    //     $this->form_validation->set_rules('cc_year', 'School Year', 'required|strip_tags');
    //     $this->form_validation->set_rules('cc_term', 'School Term', 'required|strip_tags');
    //     $this->form_validation->set_rules('cc_stud_number', 'Student Number', 'required|strip_tags');
    //     $this->form_validation->set_rules('cc_status', 'Course Status', 'required|strip_tags');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->course_card();
    //     } else {
    //         $data = array(
    //             'cc_course' => $this->input->post('cc_course'),
    //             'cc_section' => $this->input->post('cc_section'),
    //             'cc_midterm' => $this->input->post('cc_midterm'),
    //             'cc_final' => $this->input->post('cc_final'),
    //             'cc_year' => $this->input->post('cc_year'),
    //             'cc_term' => $this->input->post('cc_term'),
    //             'cc_stud_number' => $this->input->post('cc_stud_number'),
    //             'cc_status' => $this->input->post('cc_status'),
    //             'cc_is_enrolled' => 1
    //         );

    //         $this->SuperAdmin_model->submit_course_card($data);
    //         redirect('SuperAdmin/course_card');
    //     }
    // }

    // public function submit_balance()
    // {
    //     $this->form_validation->set_rules('bal_term', 'School Term', 'required|strip_tags');
    //     $this->form_validation->set_rules('bal_year', 'School Year', 'required|strip_tags');
    //     $this->form_validation->set_rules('bal_status', 'Status', 'required|strip_tags');
    //     $this->form_validation->set_rules('bal_stud_number', 'Student Number', 'required|strip_tags');
    //     $this->form_validation->set_rules('bal_beginning', 'Beginning Balance', 'required|strip_tags');
    //     $this->form_validation->set_rules('bal_total_assessment', 'Total Assessment', 'required|strip_tags');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->balance();
    //     } else {
    //         $data = array(
    //             'bal_term' => $this->input->post('bal_term'),
    //             'bal_year' => $this->input->post('bal_year'),
    //             'bal_status' => $this->input->post('bal_status'),
    //             'bal_stud_number' => $this->input->post('bal_stud_number'),
    //             'bal_beginning' => $this->input->post('bal_beginning'),
    //             'bal_total_assessment' => $this->input->post('bal_total_assessment')
    //         );

    //         $this->SuperAdmin_model->submit_balance($data);
    //         redirect('SuperAdmin/balance');
    //     }
    // }

    // public function submit_payment()
    // {
    //     $this->form_validation->set_rules('pay_stud_number', 'Student Number', 'required|strip_tags');
    //     $this->form_validation->set_rules('payment', 'Payment', 'required|strip_tags');
    //     $this->form_validation->set_rules('pay_term', 'School Term', 'required|strip_tags');
    //     $this->form_validation->set_rules('pay_year', 'School Year', 'required|strip_tags');
    //     $this->form_validation->set_rules('or_number', 'OR Number', 'required|strip_tags');
    //     $this->form_validation->set_rules('pay_date', 'Payment Date', 'required|strip_tags');
    //     $this->form_validation->set_rules('pay_type', 'Payment Type', 'required|strip_tags');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->payment();
    //     } else {
    //         $data = array(
    //             'pay_stud_number' => $this->input->post('pay_stud_number'),
    //             'payment' => $this->input->post('payment'),
    //             'pay_term' => $this->input->post('pay_term'),
    //             'pay_year' => $this->input->post('pay_year'),
    //             'or_number' => $this->input->post('or_number'),
    //             'pay_date' => $this->input->post('pay_date'),
    //             'pay_type' => $this->input->post('pay_type')
    //         );

    //         $this->SuperAdmin_model->submit_payment($data);
    //         redirect('SuperAdmin/payment');
    //     }
    // }

    // =======================================================================================
    // END OF STUDENT FUNCTIONALITIES
    // =======================================================================================

    // =======================================================================================
    // ADMIN FUNCTIONALITIES
    // =======================================================================================

    public function admin()
    {

        $per_page = 10;
        $end_page = $this->uri->segment(3);
        $this->load->library('pagination');
        $config = [
            'base_url' => base_url('SuperAdmin/manage_admins/manage_admins'),
            'per_page' => $per_page,
            'total_rows' => $this->SuperAdmin_model->admin_num_rows(),
        ];

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config); // model function

        $data['admins'] = $this->SuperAdmin_model->view_all_admin($per_page, $end_page);

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_admins/manage_admins', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function view_admin($id)
    {
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_admins/view_admin');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function create_admin()
    {
        $data['faculties'] = $this->SuperAdmin_model->fetch_all_faculty();
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_admins/create_admin', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    //INSERT FUNCTION
    public function create_admin_function()
    {
        // $this->dd($_POST);
        //here are the validation entry
        $this->form_validation->set_rules('faculty', 'Faculty Assignment', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->create_admin();
        } else {
            $this->SuperAdmin_model->create_admin($_POST);
            redirect('SuperAdmin');
        }
    }

    public function block_admin($id)
    {
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_admins/block_admin');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_admin($id, $message = null)
    {
        $data['faculties'] = $this->SuperAdmin_model->fetch_all_faculty();
        $data['acc_details'] = $this->SuperAdmin_model->fetch_faculty($id);
        $data['message'] = $message;
        // $this->dd($message);
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_admins/edit_admin', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    //EDIT ADMIN FUNCTION
    public function edit_admin_function()
    {
        // $this->dd($_POST);
        //here are the validation entry
        $this->form_validation->set_rules('acc_id', 'Faculty Assignment', 'required|strip_tags');

        $id = $this->input->post('acc_id');

        // $this->dd($modules);
        if ($this->form_validation->run() == FALSE) {
            // $this->dd('true');
            $this->edit_admin($id);
        } else {
            // $this->dd('false');
            $modules = array(
                'UsesCollege' => $this->input->post('UsesCollege'),
                'UsesDepartment' => $this->input->post('UsesDepartment'),
                'UsesProgram' => $this->input->post('UsesProgram'),
                'UsesSpec' => $this->input->post('UsesSpec'),
                'UsesCourse' => $this->input->post('UsesCourse'),
                'UsesLab' => $this->input->post('UsesLab'),
                'UsesSection' => $this->input->post('UsesSection'),
                'UsesCurriculum' => $this->input->post('UsesCurriculum'),
                'UsesParallel' => $this->input->post('UsesParallel'),
                'UsesFaculty' => $this->input->post('UsesFaculty'),
                'UsesStudent' => $this->input->post('UsesStudent'),
                'UsesClass' => $this->input->post('UsesClass'),
                'UsesFinance' => $this->input->post('UsesFinance')
            );
            $this->SuperAdmin_model->edit_admin($id, $modules);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i>Success!</h4>
            <p>Permissions have been set!</p>
        </div>
        ';
            $this->edit_admin($id, $message);
        }
    }

    // =======================================================================================
    // END OF ADMIN FUNCTIONALITIES
    // =======================================================================================

    // =======================================================================================
    // COURSES
    // =======================================================================================

    public function courses($success_msg = null, $fail_msg = null)
    {
        $data['courses'] = $this->SuperAdmin_model->fetch_all_courses();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_courses/all_courses', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_course($message = null)
    {
        $data['laboratories'] = $this->SuperAdmin_model->fetch_all_laboratories();
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_courses/add_course', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_course($id, $success_msg = null, $fail_msg = null)
    {
        $data['course'] = $this->SuperAdmin_model->fetch_course($id);
        $data['laboratories'] = $this->SuperAdmin_model->fetch_all_laboratories();
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['prereqs'] = $this->SuperAdmin_model->fetch_all_prereq($data['course']->course_code);
        $data['prereq_courses'] = $this->SuperAdmin_model->fetch_all_prereq_courses($data['course']->course_code);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_courses/edit_course', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_course_function()
    {
        $this->form_validation->set_rules('course_code', 'Course Code', 'required|strip_tags');
        $this->form_validation->set_rules('course_title', 'Course Title', 'required|strip_tags');
        $this->form_validation->set_rules('course_units', 'Course Units', 'required|strip_tags');
        $this->form_validation->set_rules('laboratory_code', 'Laboratory Code', 'required|strip_tags');
        $this->form_validation->set_rules('department_code', 'Department Designation', 'required|strip_tags');

        $id = $this->input->post('course_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_course($id);
        } else {
            $course = array(
                'course_code' => $this->input->post('course_code'),
                'course_title' => $this->input->post('course_title'),
                'course_units' => $this->input->post('course_units'),
                'laboratory_code' => $this->input->post('laboratory_code'),
                'department_code' => $this->input->post('department_code')
            );

            $this->SuperAdmin_model->edit_course($id, $course);
            $this->edit_course($id, "Record successfully edited!");
        }
    }

    public function add_prereq_to_course()
    {
        $this->form_validation->set_rules('prereq_code', 'Prereq Code', 'required|strip_tags|is_unique[prereq_tbl.prereq_code]');
        $id = $this->input->post('course_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_course($id);
        } else {
            $prereq = array(
                'root_course' => $this->input->post('root_course'),
                'prereq_code' => $this->input->post('prereq_code'),
                'prereq_title' => $this->input->post('prereq_title'),
                'prereq_units' => $this->input->post('prereq_units')
            );

            // print_r($_POST);
            // print_r($prereq);
            // die();

            $this->SuperAdmin_model->add_prereq_to_course($prereq);
            $this->edit_course($id, "Record successfully edited!");
        }
    }

    public function add_course_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_course_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_course($message);
    }

    public function create_course()
    {
        $this->form_validation->set_rules('course_code', 'Course Code', 'required|strip_tags|is_unique[courses_tbl_v2.course_code]');
        $this->form_validation->set_rules('course_title', 'Course Title', 'required|strip_tags');
        $this->form_validation->set_rules('course_units', 'Course Units', 'required|strip_tags');
        $this->form_validation->set_rules('laboratory_code', 'Laboratory Code', 'required|strip_tags');
        $this->form_validation->set_rules('department_code', 'Department Designation', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_course();
        } else {
            $course = array(
                'course_code' => $this->input->post('course_code'),
                'course_title' => $this->input->post('course_title'),
                'course_units' => $this->input->post('course_units'),
                'laboratory_code' => $this->input->post('laboratory_code'),
                'department_code' => $this->input->post('department_code')
            );

            $this->SuperAdmin_model->create_course($course);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_course($message);
        }
    }

    public function delete_course($id)
    {

        if (!$this->SuperAdmin_model->delete_course($id)) {
            $this->SuperAdmin_model->delete_course($id);
            $this->courses("Record successfully deleted!", null);
        } else {
            $this->courses(null, "Failed to delete Record!");
        }
    }

    public function delete_prereq_from_course($id, $course_id)
    {
        if (!$this->SuperAdmin_model->delete_prereq_from_course($id)) {
            $this->SuperAdmin_model->delete_prereq_from_course($id);
            $this->edit_course($course_id, "Record successfully deleted!");
        } else {
            $this->edit_course($course_id, null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF COURSES
    // =======================================================================================

    // =======================================================================================
    // SECTIONS
    // =======================================================================================

    public function section($success_msg = null, $fail_msg = null)
    {
        $data['sections'] = $this->SuperAdmin_model->fetch_all_sections();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_sections/all_sections', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_section($message = null)
    {
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_sections/add_section', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_section($id, $success_msg = null, $fail_msg = null)
    {
        // $id = $this->input->post('college_id');
        $data['section'] = $this->SuperAdmin_model->fetch_section($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        // print_r($data);
        // die();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_sections/edit_section', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_section_function()
    {
        $this->form_validation->set_rules('section_code', 'Section Code', 'required|strip_tags');
        $id = $this->input->post('section_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_section($id);
        } else {
            $section = array(
                'section_code' => $this->input->post('section_code'),
            );

            $this->SuperAdmin_model->edit_section($id, $section);
            $this->edit_section($id, "Record successfully edited!");
        }
    }

    public function add_section_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_section_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_section($message);
    }

    public function create_section()
    {
        $this->form_validation->set_rules('section_code', 'Section Code', 'required|strip_tags|is_unique[sections_tbl.section_code]');

        if ($this->form_validation->run() == FALSE) {
            $this->add_section();
        } else {
            $section = array(
                'section_code' => $this->input->post('section_code'),
            );

            $this->SuperAdmin_model->create_section($section);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_section($message);
        }
    }

    public function delete_section($id)
    {

        if (!$this->SuperAdmin_model->delete_section($id)) {
            $this->SuperAdmin_model->delete_section($id);
            $this->section("Record successfully deleted!", null);
        } else {
            $this->section(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF SECTIONS
    // =======================================================================================

    // =======================================================================================
    // LABORATORY
    // =======================================================================================

    public function laboratories($success_msg = null, $fail_msg = null)
    {
        $data['laboratories'] = $this->SuperAdmin_model->fetch_all_laboratories();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_laboratories/all_laboratories', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_laboratory($message = null)
    {
        $data['message'] = $message;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_laboratories/add_laboratory', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_laboratory($id, $success_msg = null, $fail_msg = null)
    {
        // $id = $this->input->post('college_id');
        $data['laboratory'] = $this->SuperAdmin_model->fetch_laboratory($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        // print_r($data);
        // die();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_laboratories/edit_laboratory', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_laboratory_function()
    {
        $this->form_validation->set_rules('laboratory_code', 'Laboratory Code', 'required|strip_tags');
        $this->form_validation->set_rules('laboratory_title', 'Laboratory Title', 'required|strip_tags');
        $this->form_validation->set_rules('laboratory_units', 'Laboratory Units', 'required|strip_tags');
        $id = $this->input->post('laboratory_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_laboratory($id);
        } else {
            $laboratory = array(
                'laboratory_code' => $this->input->post('laboratory_code'),
                'laboratory_title' => $this->input->post('laboratory_title'),
                'laboratory_units' => $this->input->post('laboratory_units')
            );

            $this->SuperAdmin_model->edit_laboratory($id, $laboratory);
            $this->edit_laboratory($id, "Record successfully edited!");
        }
    }

    public function add_laboratory_csv()
    {
        if (isset($_POST["import"])) {
            $message = $this->SuperAdmin_model->add_laboratory_csv($_FILES['csv_file']);
        } else {
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please select a file!</p>
        </div>
        ';
        }
        $this->add_laboratory($message);
    }

    public function create_laboratory()
    {
        $this->form_validation->set_rules('laboratory_code', 'Laboratory Code', 'required|strip_tags|is_unique[laboratory_tbl.laboratory_code]');
        $this->form_validation->set_rules('laboratory_title', 'Laboratory Title', 'required|strip_tags');
        $this->form_validation->set_rules('laboratory_units', 'Laboratory Units', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_laboratory();
        } else {
            $laboratory = array(
                'laboratory_code' => $this->input->post('laboratory_code'),
                'laboratory_title' => $this->input->post('laboratory_title'),
                'laboratory_units' => $this->input->post('laboratory_units')
            );

            $this->SuperAdmin_model->create_laboratory($laboratory);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
        </div>
        ';
            $this->add_laboratory($message);
        }
    }

    public function delete_laboratory($id)
    {
        if (!$this->SuperAdmin_model->delete_laboratory($id)) {
            $this->SuperAdmin_model->delete_laboratory($id);
            $this->laboratories("Record successfully deleted!", null);
        } else {
            $this->laboratories(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF LABORATORY
    // =======================================================================================

    // =======================================================================================
    // SCHOOL PARAMETERS
    // =======================================================================================

    public function school_parameters($message = null)
    {
        if ($this->session->has_school_parameters == TRUE) {
        } else {
            redirect('SuperAdmin/dashboard');
        }
        $data['college_count'] = $this->SuperAdmin_model->fetch_college_count();
        $data['department_count'] = $this->SuperAdmin_model->fetch_department_count();
        $data['program_count'] = $this->SuperAdmin_model->fetch_program_count();
        $data['specialization_count'] = $this->SuperAdmin_model->fetch_specialization_count();
        $data['course_count'] = $this->SuperAdmin_model->fetch_course_count();
        $data['lab_count'] = $this->SuperAdmin_model->fetch_laboratory_count();
        $data['section_count'] = $this->SuperAdmin_model->fetch_section_count();
        $data['curriculum_count'] = $this->SuperAdmin_model->fetch_curriculum_count();
        $data['student_count'] = $this->SuperAdmin_model->fetch_student_count();
        $data['class_count'] = $this->SuperAdmin_model->fetch_class_count();

        $data['message'] = $message;

        $data['current_sy'] = $this->SuperAdmin_model->fetch_current();

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/school-parameters/school-parameters', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function change_sy()
    {
        $this->form_validation->set_rules('schoolyear', 'School Year', 'required|strip_tags');
        $this->form_validation->set_rules('schoolterm', 'School Term', 'required|strip_tags');

        $sy_details = array(
            'school_year' => $this->input->post('schoolyear'),
            'school_term' => $this->input->post('schoolterm')
        );

        if ($this->form_validation->run() == FALSE) {
            $this->school_parameters();
        } else {
            $message = $this->SuperAdmin_model->change_sy($sy_details);
            $this->school_parameters($message);
        }
    }

    // =======================================================================================
    // END OF SCHOOL PARAMETERS
    // =======================================================================================

    public function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
        die();
    }
}
