<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		require 'vendor/autoload.php';
		date_default_timezone_set("Asia/Singapore");

		$this->load->library('form_validation');

		$this->load->model('Account_model');
		$this->load->model('User_model');
		$this->load->model('Academics_model');
		$this->load->model('Petition_model');
		$this->load->model('Curriculum_model');
		$this->load->model('CourseCard_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Revision_model');
		$this->load->model('Post_model');
		$this->load->model('Notification_model');
		$this->load->model('Overload_underload_model');
		$this->load->model('Real_time_model');
		$this->load->model('Events_model');

		$this->load->helper('date');
		$this->load->helper('text');
	}

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
					redirect('Admin/dashboard');
				} else if ($this->session->access == 'superadmin') {
					redirect('SuperAdmin/dashboard');
				} else {
					redirect('Admin');
				}
			} else {
				$error['error'] = "Your Account has been blocked. Please contact your administrator for details";
				$this->load->view('UserAuth/login-admin', $error);
			}
		} else {
			$error['error'] = "Invalid login credentials";
			$this->load->view('UserAuth/login-admin', $error);
		}
	}

	public function logout()
	{
		$log_details = array(
			'log_user' => $this->session->acc_number,
			'log_type' => 'logout',
			'log_time' => time()
		);
		$this->db->insert('account_logs', $log_details);
		session_destroy();
		$this->index();
	}

	// =======================================================================================
	// DASHBOARD MODULE
	// =======================================================================================

	public function dashboard() // | Display Dashboard |
	{
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/dashboard/dashboard');

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
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
			'base_url' => base_url('Admin/student_accounts'),
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

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/student_accounts/student_accounts', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	public function block_user($studnumber)
	{
		$this->Account_model->block_user($studnumber);
		redirect('Admin/student_accounts');
	}

	public function show_account($studNumber, $curriculum_code) // | Display Specific Student Account |
	{
		$data['account'] = $this->Account_model->view_user($studNumber);
		$data['curr'] = $this->Academics_model->fetch_curriculum_admin($curriculum_code);
		$data['grades'] = $this->Academics_model->fetch_progress_admin($studNumber);
		$data['offerings'] = $this->Academics_model->fetchCurrentOffering();
		$data['cor'] = $this->Academics_model->fetch_current_COR($studNumber);

		// echo json_encode($data);

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/student_accounts/show_account', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
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

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/parallel_courses/parallel_courses', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
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
		$data['years'] = $this->Academics_model->fetch_year();
		$data['terms'] = $this->Academics_model->fetch_term();
		$data['offering'] = $this->Academics_model->fetchOffering($year, $term);

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/course_offering/course_offering', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
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
			'base_url' => base_url('Admin/course_petitions'),
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

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/student_petitions/student_petitions', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	// =======================================================================================
	// END OF COURSE PETITIONING MODULE
	// =======================================================================================

	// =======================================================================================
	// CALENDAR MODULE
	// =======================================================================================

	public function academic_calendar() // | Display Academic Calendar |
	{

		$year = $this->uri->segment(3);
		$month = $this->uri->segment(4);
		$prefs = array(
			'start_day'    => 'saturday',
			'month_type'   => 'long',
			'day_type'     => 'short',
			'show_next_prev'  => TRUE,
			'next_prev_url'   => base_url() . 'Admin/academic_calendar/'
		);


		$prefs['template'] = '

		        {table_open}<table class="table text-center" border="0" cellpadding="0" cellspacing="0">{/table_open}

		        {heading_row_start}<tr>{/heading_row_start}

		        {heading_previous_cell}<th><h3><strong><a href="{previous_url}" class="navi"><span class="fa fa-chevron-left"></span></a></strong></h3></th>{/heading_previous_cell}
		        {heading_title_cell}<th colspan="5"><h3><strong>{heading}</strong></h3></th>{/heading_title_cell}
		        {heading_next_cell}<th><h3><strong><a href="{next_url}" class="navi"><span class="fa fa-chevron-right"></span></a></strong></h3></th>{/heading_next_cell}

		        {heading_row_end}</tr>{/heading_row_end}

		        {week_row_start}<tr style="background-color:#efefef;">{/week_row_start}
		        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
		        {week_row_end}</tr>{/week_row_end}

		        {cal_row_start}<tr>{/cal_row_start}
		        {cal_cell_start}<td>{/cal_cell_start}
		        {cal_cell_start_today}<td>{/cal_cell_start_today}
		        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

		        {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
		        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

		        {cal_cell_no_content}{day}{/cal_cell_no_content}
		        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

		        {cal_cell_blank}&nbsp;{/cal_cell_blank}

		        {cal_cell_other}{day}{/cal_cel_other}

		        {cal_cell_end}</td>{/cal_cell_end}
		        {cal_cell_end_today}</td>{/cal_cell_end_today}
		        {cal_cell_end_other}</td>{/cal_cell_end_other}
		        {cal_row_end}</tr>{/cal_row_end}

		        {table_close}</table>{/table_close}
		';

		$this->load->library('calendar', $prefs);

		$data['my_calendar'] = $this->calendar->generate($year, $month);

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/academic_calendar/academic_calendar', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	public function fetch_events()
	{
		$data = $this->Events_model->fetch_events();
		echo json_encode($data);
	}

	public function create_event()
	{
		$title = $this->input->post('title');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$event_details = array(
			'title' => $title,
			'start' => $start,
			'end' => $end
		);

		// $this->Events_model->create_event($event_details);

		echo json_encode($start);
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
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/school_announcements/school_announcements', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	public function fetch_post($post_id)
	{
		$data = $this->Post_model->fetch_post($post_id);
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/school_announcements/view', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	public function delete_post($post_id)
	{
		$this->Post_model->delete_post($post_id);
		redirect('Admin/school_announcements');
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
			redirect('Admin/school_announcements');
		} else {

			if ($this->form_validation->run() == FALSE) {
				redirect('Admin/school_announcements');
			} else {
				if (!$this->upload->do_upload('attachment')) {
					$data['msg'] = array('success' => 'Image successfully uploaded');

					$data1 = array(
						'post_account_id' => $this->session->acc_number,
						'post_caption' => $this->input->post('caption'),
						'post_created' => time()
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
						'post_created' => time()
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

				redirect('Admin/school_announcements');
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
			redirect('Admin/school_announcements');
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
			redirect('Admin/school_announcements');
		}
	}

	public function edit_post($post_id)
	{
		$data = $this->Post_model->fetch_post($post_id);
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/school_announcements/edit', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	// =======================================================================================
	// END OF SCHOOL ANNOUNCEMENT MODULE
	// =======================================================================================

	// =======================================================================================
	// ALL CURRICULA MODULE
	// =======================================================================================

	public function curricula()
	{
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/curricula/curricula');

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	// =======================================================================================
	// END OF ALL CURRICULA MODULE
	// =======================================================================================

	// =======================================================================================
	// COR REVISION MODULE
	// =======================================================================================

	public function cor() // | Display all COR revision requests |
	{

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/cor/cor');

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
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

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/overload_underload/underload_requests', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	public function underload_view($stud_number, $term, $year) // | Display underload request view |
	{
		$data['cor'] = $this->Overload_underload_model->fetch_course_card_admin($stud_number, $term, $year);
		$data['student'] = $this->Overload_underload_model->fetch_user($stud_number);
		$data['courses'] = $this->Overload_underload_model->fetch_courses();
		$data['offerings'] = $this->Overload_underload_model->fetchOffering();
		$data['underload'] = $this->Overload_underload_model->fetch_underload($stud_number, $term, $year);

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/overload_underload/underload_view', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	public function approve_underload($id, $stud_number)
	{
		$message = 'Underload request granted!';

		$link = base_url() . "Student/underload_request/" . $stud_number;
		$this->send_notification($stud_number, $message, $link);
		$this->Overload_underload_model->approve_underload($id);

		redirect('Admin/underload');
	}

	public function decline_underload($id, $stud_number)
	{
		$message = 'Underload request declined!';

		$link = base_url() . "Student/underload_request/" . $stud_number;
		$this->send_notification($stud_number, $message, $link);
		$this->Overload_underload_model->decline_underload($id);

		redirect('Admin/underload');
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

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/overload_underload/overload_requests', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	public function overload_view($stud_number, $term, $year) // | Display overload request view |
	{

		$data['cor'] = $this->Overload_underload_model->fetch_course_card_admin($stud_number, $term, $year);
		$data['student'] = $this->Overload_underload_model->fetch_user($stud_number);
		$data['courses'] = $this->Overload_underload_model->fetch_courses();
		$data['offerings'] = $this->Overload_underload_model->fetchOffering();
		$data['overload'] = $this->Overload_underload_model->fetch_overload($stud_number, $term, $year);

		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/overload_underload/overload_view', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	public function approve_overload($id, $stud_number)
	{
		$message = 'Overload request granted!';

		$link = base_url() . "Student/overload_request/" . $stud_number;
		$this->send_notification($stud_number, $message, $link);
		$this->Overload_underload_model->approve_overload($id);

		redirect('Admin/overload');
	}

	public function decline_overload($id, $stud_number)
	{
		$message = 'Overload request declined!';

		$link = base_url() . "Student/overload_request/" . $stud_number;
		$this->send_notification($stud_number, $message, $link);
		$this->Overload_underload_model->decline_overload($id);

		redirect('Admin/overload');
	}

	// =======================================================================================
	// END OF OVERLOAD MODULE
	// =======================================================================================

	// =======================================================================================
	// SIMUL MODULE
	// =======================================================================================

	public function simul() // | Display all simul request |
	{
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/simul/simul');

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	// =======================================================================================
	// END OF SIMUL MODULE
	// =======================================================================================

	public function admin_curriculum() // | Display All Curricula |
	{
		$data['labs'] = $this->Curriculum_model->fetchLab();
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/curricula/curricula', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
	}

	// =======================================================================================
	// ADMIN PROFILE MODULE
	// =======================================================================================

	public function profile($error = null, $success = null) // | Display Admin Profile |
	{
		$data['account'] = $this->Account_model->view_user($this->session->acc_number);
		$data['success'] = $success;
		$data['error'] = $error;
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/profile/profile', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
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
			$this->load->view('includes_admin/admin_header');

			$this->load->view('includes_admin/admin_topnav');
			$this->load->view('includes_admin/admin_sidebar');

			$this->load->view('content_admin/curricula/curricula', $data);

			$this->load->view('includes_admin/admin_contentFooter');
			$this->load->view('includes_admin/admin_rightnav');
			$this->load->view('includes_admin/admin_footer');
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
			redirect('Admin/course_petitions');
		}
	}

	public function approve_petition()
	{
		//fetch number of petitioners
		//approve petition of more than or equal to 15 but less than of equal to 40
		$petitionID = $this->input->post('petitionID');
		$petition_unique = $this->input->post('petitionUnique');

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
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/student_petitions/show_petition', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
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
		$this->load->view('includes_admin/admin_header');

		$this->load->view('includes_admin/admin_topnav');
		$this->load->view('includes_admin/admin_sidebar');

		$this->load->view('content_admin/admin_accounts', $data);

		$this->load->view('includes_admin/admin_contentFooter');
		$this->load->view('includes_admin/admin_rightnav');
		$this->load->view('includes_admin/admin_footer');
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
}
