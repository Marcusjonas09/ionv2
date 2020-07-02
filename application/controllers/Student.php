<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Manila");
		require 'vendor/autoload.php';

		$this->load->library('form_validation');

		$this->load->model('Account_model');
		$this->load->model('User_model');
		$this->load->model('Dashboard_model');
		$this->load->model('Curriculum_model');
		$this->load->model('Courseflow_model');
		$this->load->model('Post_model');
		$this->load->model('Petition_model');
		$this->load->model('Simul_model');
		$this->load->model('Notification_model');
		$this->load->model('CourseCard_model');
		$this->load->model('COR_model');
		$this->load->model('Academics_model');
		$this->load->model('Student_model');
		$this->load->model('Revision_model');
		$this->load->model('Assessment_model');
		$this->load->model('Overload_underload_model');
		$this->load->model('Calendar_model');

		$this->load->helper('date');
		$this->load->helper('text');
	}

	public function index()
	{
		$error['error'] = "";
		$this->load->view('UserAuth/login-student', $error);
	}

	public function login()
	{

		$totalunits = 0.0;
		$totalunitspassed = 0.0;
		$course_units = 0.0;
		$lab_units = 0.0;
		$coursepassed = 0.0;
		$labpassed = 0.0;

		$curriculum = $this->Dashboard_model->fetch_curriculum();
		$progress = $this->Dashboard_model->fetchProgress();
		$curr = json_decode(json_encode($curriculum));
		$grades = json_decode(json_encode($progress));

		foreach ($curr as $unit) {
			$course_units += $unit->course_units;
			$lab_units += $unit->laboratory_units;
			foreach ($grades as $grade) {
				if ($unit->course_code == $grade->cc_course && ($grade->cc_status == "finished" || $grade->cc_status == "credited") && $grade->cc_final >= 1.0) {
					$coursepassed += $unit->course_units;
				}
				if (strtoupper($unit->laboratory_code) == strtoupper($grade->cc_course) && ($grade->cc_final > 1.0 && $grade->cc_final <= 4.0)) {
					$labpassed += $unit->laboratory_units;
				}
			}
		}

		$totalunits = $course_units + $lab_units;
		$totalunitspassed = $coursepassed + $labpassed;

		$remaining_units = $totalunits - $totalunitspassed;

		$this->session->set_userdata('remaining_units', $remaining_units);
		$data = array(
			'acc_number' => strip_tags($this->input->post('acc_number')), //$_POST['username]
			'acc_password' => sha1(strip_tags($this->input->post('acc_password'))),
		);

		$this->User_model->login_student($data);
		$error['error'] = "";

		if ($this->session->login) {
			if ($this->session->acc_status) {
				if ($this->session->access == 'student') {
					redirect('Student/dashboard');
				} else {
					redirect('Student');
				}
			} else {
				$error['error'] = "Your Account has been blocked. Please contact your administrator for details";
				$this->load->view('UserAuth/login-student', $error);
			}
		} else {
			$error['error'] = "Invalid login credentials";
			$this->load->view('UserAuth/login-student', $error);
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

	public function user_data_submit()
	{
		$data = array(
			'caption' => $this->input->post('caption'),
			'account_id' => $this->input->post('account_id')
		);

		//Either you can print value or you can send value to database
		echo json_encode($data);
	}

	// =======================================================================================
	// DASHBOARD MODULE
	// =======================================================================================

	public function dashboard()
	{
		// $this->dd($data);
		$this->load->view('includes_student/student_header');
		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		// $data['cor'] = $this->CourseCard_model->fetch_current_COR();
		$data['curr'] = $this->Curriculum_model->get_curriculum($this->session->Curriculum_code);
		$data['grades'] = $this->Dashboard_model->fetchProgress();
		$data['offerings'] = $this->Dashboard_model->fetchOffering($this->session->curr_year, $this->session->curr_term);
		$data['cor'] = $this->COR_model->fetch_cor($this->session->acc_number, $this->session->curr_year, $this->session->curr_term);

		$this->load->view('content_student/student_dashboard', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	// =======================================================================================
	// END OF DASHBOARD MODULE
	// =======================================================================================

	// =======================================================================================
	// ANNOUNCEMENTS MODULE
	// =======================================================================================

	public function announcements()
	{
		$events = $this->Calendar_model->getAllEvent();
		$this->load->view('includes_student/student_header');
		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$data['announcements'] = $this->Post_model->fetch_posts();

		$this->load->view('content_student/student_announcements', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
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
	}

	// =======================================================================================
	// END OF ANNOUNCEMENTS MODULE
	// =======================================================================================

	// =======================================================================================
	// PROFILE MODULE
	// =======================================================================================

	public function Profile($error = null, $success = null)
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$data['account'] = $this->Account_model->view_user($this->session->acc_number);

		$data['curr'] = $this->Curriculum_model->get_curriculum($this->session->Curriculum_code);

		$data['grades'] = $this->Academics_model->fetch_progress_student();

		$data['offerings'] = $this->Dashboard_model->fetchOffering($this->session->curr_year, $this->session->curr_term);

		$data['cor'] = $this->COR_model->fetch_cor($this->session->acc_number, $this->session->curr_year, $this->session->curr_term);

		$data['success'] = $success;

		$data['error'] = $error;

		$this->load->view('content_student/student_profile', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	public function changepass()
	{
		$this->form_validation->set_message('matches', 'Please make sure that your passwords match');
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|strip_tags');
		$this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|strip_tags|min_length[8]|max_length[20]|matches[renewpassword]');
		$this->form_validation->set_rules('renewpassword', 'Retype Password', 'trim|required|strip_tags|min_length[8]|max_length[20]');

		$old = $this->input->post('oldpassword');
		$new = $this->input->post('newpassword');

		if ($this->form_validation->run() == FALSE) {
			if ($this->User_model->check_old_pass($this->session->acc_number, sha1($old))) {
				$this->Profile(null, null);
			} else {
				$error = "That was not your old password.";
				$this->Profile($error, null);
			}
		} else {
			if ($this->User_model->check_old_pass($this->session->acc_number, sha1($old))) {
				$this->User_model->changepass($this->session->acc_number, sha1($new));
				$success = "Password changed successfully!";
				$this->Profile(null, $success);
			} else {
				$error = "That was not your old password.";
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

	public function curriculum()
	{
		$this->load->view('includes_student/student_header');
		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$data['curr'] = $this->Curriculum_model->get_curriculum($this->session->Curriculum_code);
		$data['grades'] = $this->Academics_model->fetch_progress_student();

		$this->load->view('content_student/student_curriculum', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	// =======================================================================================
	// END OF CURRICULUM MODULE
	// =======================================================================================

	// =======================================================================================
	// COURSE CARD MODULE
	// =======================================================================================

	public function course_card()
	{
		$this->load->view('includes_student/student_header');
		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$term = $this->input->post('school_term');
		$year = $this->input->post('school_year');
		$data['terms'] = $this->CourseCard_model->fetch_term();
		$data['years'] = $this->CourseCard_model->fetch_year();
		$data['course_card'] = $this->CourseCard_model->fetch_course_card($this->session->acc_number, $year, $term);
		// $data['courses'] = $this->CourseCard_model->fetch_courses();

		// echo json_encode($data);

		$this->load->view('content_student/student_course_card', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	// =======================================================================================
	// END OF COURSE CARD MODULE
	// =======================================================================================

	// =======================================================================================
	// COR MODULE
	// =======================================================================================

	public function cor()
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');
		$term = $this->input->post('school_term');
		$year = $this->input->post('school_year');
		$data['terms'] = $this->COR_model->fetch_term();
		$data['years'] = $this->COR_model->fetch_year();
		// $this->dd($data);
		$data['cor'] = $this->COR_model->fetch_cor($this->session->acc_number, $year, $term);
		// $data['offerings'] = $this->Dashboard_model->fetchOffering($year, $term);
		$data['offerings'] = $this->Academics_model->fetchOffering($year, $term);
		// $data['offerings'] = $this->Dashboard_model->fetchOfferings();
		$this->load->view('content_student/student_COR', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	// =======================================================================================
	// END OF COR MODULE
	// =======================================================================================

	// =======================================================================================
	// BALANCE INQUIRY MODULE
	// =======================================================================================

	public function assessment($term, $year)
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$data['balances'] = $this->Assessment_model->get_balance();
		$data['bal'] = $this->Assessment_model->get_balance_single($term, $year);
		$data['payments'] = $this->Assessment_model->get_payments($term, $year);

		$this->load->view('content_student/student_balance_inquiry', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	// =======================================================================================
	// END OF BALANCE INQUIRY MODULE
	// =======================================================================================

	// =======================================================================================
	// PARELLEL MODULE
	// =======================================================================================

	public function parallel()
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$data['parallel'] = $this->Academics_model->fetchParallel();
		$data['parallelCourse'] = $this->Academics_model->fetchParallelCourse();

		// echo json_encode($data);

		$this->load->view('content_student/student_parallel_courses', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	// =======================================================================================
	// END OF PARALLEL MODULE
	// =======================================================================================

	// =======================================================================================
	// OFFERING MODULE
	// =======================================================================================

	public function offerings()
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$term = $this->input->post('term');
		$year = $this->input->post('year');
		$submit = $this->input->post('submit');
		$data['Y'] = $year;
		$data['T'] = $term;
		$data['years'] = $this->Academics_model->fetch_year();
		$data['terms'] = $this->Academics_model->fetch_term();
		$data['offering'] = $this->Academics_model->fetchOffering($year, $term);
		$data['classes'] = $this->Academics_model->fetchClass($year, $term);

		// $this->dd($data['classes']);
		// $data['sched'] = $this->Academics_model->fetchScheds($year, $term);
		// $data['offeringSched'] = $this->Academics_model->fetchOfferingSched();

		$this->load->view('content_student/student_course_offerings', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	// =======================================================================================
	// END OF OFFERING MODULE
	// =======================================================================================

	// =======================================================================================
	// REVISION
	// =======================================================================================

	public function revisions()
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$data['offerings'] = $this->Dashboard_model->fetchOffering($_SESSION['curr_year'], $_SESSION['curr_term']);
		$data['cor'] = $this->CourseCard_model->fetch_current_COR();

		$this->load->view('content_student/student_revision', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	// =======================================================================================
	// END OF REVISION
	// =======================================================================================

	// =======================================================================================
	// UNDERLOAD
	// =======================================================================================

	public function underload_request()
	{
		$this->load->view('includes_student/student_header');
		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		// $data['curr'] = $this->Dashboard_model->fetch_curriculum();
		$data['curr'] = $this->Curriculum_model->get_curriculum($this->session->Curriculum_code);


		$data['grades'] = $this->Dashboard_model->fetchProgress();
		$data['cor'] = $this->CourseCard_model->fetch_course_card_admin($this->session->acc_number);
		// $data['courses'] = $this->CourseCard_model->fetch_courses();
		$data['offerings'] = $this->Dashboard_model->fetchOffering($_SESSION['curr_year'], $_SESSION['curr_term']);
		$data['underload'] = $this->Overload_underload_model->fetch_underload($this->session->acc_number, $this->session->curr_term, $this->session->curr_year);

		$this->load->view('content_student/student_underload', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	public function submit_underload()
	{
		$stud_number = $this->session->acc_number;
		$curr_year = $this->session->curr_year;
		$curr_term = $this->session->curr_term;
		$type = 'underload';
		$this->Overload_underload_model->submit_ou($stud_number, $curr_year, $curr_term, $type);

		$recipients = $this->Overload_underload_model->fetch_coordinator();
		$message = 'Sent an underload request';

		$link = base_url() . "Admin/underload_view/" . $stud_number . "/" . $curr_term . "/" . $curr_year . "/";

		$this->send_notifications($recipients, $message, $link);
		redirect('Student/underload_request');
	}
	// =======================================================================================
	// END OF UNDERLOAD
	// =======================================================================================

	// =======================================================================================
	// OVERLOAD
	// =======================================================================================

	public function overload_request()
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		// $data['curr'] = $this->Dashboard_model->fetch_curriculum();
		$data['curr'] = $this->Curriculum_model->get_curriculum($this->session->Curriculum_code);
		$data['grades'] = $this->Dashboard_model->fetchProgress();
		$data['cor'] = $this->CourseCard_model->fetch_course_card_admin($this->session->acc_number);
		// $data['courses'] = $this->CourseCard_model->fetch_courses();
		$data['offerings'] = $this->Dashboard_model->fetchOffering($_SESSION['curr_year'], $_SESSION['curr_term']);
		$data['overload'] = $this->Overload_underload_model->fetch_overload($this->session->acc_number, $this->session->curr_term, $this->session->curr_year);

		$this->load->view('content_student/student_overload', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	public function submit_overload()
	{
		$stud_number = $this->session->acc_number;
		$curr_year = $this->session->curr_year;
		$curr_term = $this->session->curr_term;
		$type = 'overload';
		$this->Overload_underload_model->submit_ou($stud_number, $curr_year, $curr_term, $type);

		$recipients = $this->Overload_underload_model->fetch_coordinator();
		$message = 'Sent an overload request';

		$link = base_url() . "Admin/overload_view/" . $stud_number . "/" . $curr_term . "/" . $curr_year . "/";

		$this->send_notifications($recipients, $message, $link);
		redirect('Student/overload_request');
	}

	// =======================================================================================
	// END OF OVERLOAD
	// =======================================================================================

	// =======================================================================================
	// SIMUL MODULE
	// =======================================================================================

	//SIMUL REQUEST LINK
	// public function simulRequest()
	// {
	// 	$this->load->view('includes_student/student_header');

	// 	$this->load->view('includes_student/student_topnav');
	// 	$this->load->view('includes_student/student_sidebar');

	// 	$data['curr'] = $this->Dashboard_model->fetch_curriculum();
	// 	$data['grades'] = $this->Dashboard_model->fetchProgress();
	// 	// $data['courses'] = $this->CourseCard_model->fetch_courses();
	// 	$data['offerings'] = $this->Dashboard_model->fetchOffering();
	// 	$data['cor'] = $this->CourseCard_model->fetch_current_COR();

	// 	$this->load->view('content_student/student_simul', $data);

	// 	$this->load->view('includes_student/student_contentFooter');
	// 	$this->load->view('includes_student/student_rightnav');
	// 	$this->load->view('includes_student/student_footer');
	// }

	public function simulRequest()
	{
		if ($this->session->userdata('remaining_units') < 18) {

			$this->load->view('includes_student/student_header');
			$this->load->view('includes_student/student_topnav');
			$this->load->view('includes_student/student_sidebar');

			// $data['curr'] = $this->Dashboard_model->fetch_curriculum();
			$data['curr'] = $this->Curriculum_model->get_curriculum($this->session->Curriculum_code);
			$data['grades'] = $this->Dashboard_model->fetchProgress();
			// $data['courses'] = $this->CourseCard_model->fetch_courses();
			$data['offerings'] = $this->Dashboard_model->fetchOffering($_SESSION['curr_year'], $_SESSION['curr_term']);
			$data['cor'] = $this->CourseCard_model->fetch_current_COR();
			$data['status'] = $this->Simul_model->fetch_simul_status($this->session->acc_number);
			$data['simul'] = $this->Simul_model->fetch_simul_student($this->session->acc_number, $this->session->curr_term, $this->session->curr_year);
			// $this->dd($data['status']);

			$this->load->view('content_student/student_simul', $data);

			$this->load->view('includes_student/student_contentFooter');
			$this->load->view('includes_student/student_rightnav');
			$this->load->view('includes_student/student_footer');
		} else {
			$this->load->view('includes_student/student_header');
			$this->load->view('includes_student/student_topnav');
			$this->load->view('includes_student/student_sidebar');

			$this->load->view('content_student/not_qualified');

			$this->load->view('includes_student/student_contentFooter');
			$this->load->view('includes_student/student_rightnav');
			$this->load->view('includes_student/student_footer');
		}
	}

	public function submit_simul()
	{

		// $this->form_validation->set_rules('LetterOfIntent', 'Letter Of Intent', 'required');
		// $this->form_validation->set_rules('ScholasticRecords', 'Scholastic Records', 'required');
		// $this->form_validation->set_rules('LetterFromCompany', 'Letter From the Company', 'required');
		// if ($this->form_validation->run() == FALSE) {
		$this->simulRequest();
		// } else {
		$uploaded = $this->upload_requirement();

		$sample = array(
			'LetterOfIntent' => $uploaded['LetterOfIntent'],
			'ScholasticRecords' => $uploaded['ScholasticRecords'],
			'LetterFromCompany' => $uploaded['LetterFromCompany'],
			'StudentNumber' => $this->input->post('acc_number'),
			'date_submitted' => date('Y-m-d H:i:s', time()),
			'school_year' => $this->session->curr_year,
			'school_term' => $this->session->curr_term
		);
		$this->Simul_model->submit_simul($sample);
		redirect('Student/sample_simul');
		// }
	}


	public function upload_requirement()
	{
		$config['upload_path']          = './simul_requirements/';
		$config['allowed_types']        = 'pdf';
		$config['max_size']             = 10000;
		$config['file_name'] 			= 'requirement';

		$this->load->library('upload', $config);
		$LetterOfIntent = "";
		$ScholasticRecords = "";
		$LetterFromCompany = "";
		if ($this->upload->do_upload('LetterOfIntent')) {
			$data = array('upload_data' => $this->upload->data());
			$LetterOfIntent = $data['upload_data']['file_name'];
		}
		if ($this->upload->do_upload('ScholasticRecords')) {
			$data = array('upload_data' => $this->upload->data());
			$ScholasticRecords = $data['upload_data']['file_name'];
		}
		if ($this->upload->do_upload('LetterFromCompany')) {
			$data = array('upload_data' => $this->upload->data());
			$LetterFromCompany = $data['upload_data']['file_name'];
		}
		return array(
			'LetterOfIntent' => $LetterOfIntent,
			'ScholasticRecords' => $ScholasticRecords,
			'LetterFromCompany' => $LetterFromCompany
		);
	}

	// =======================================================================================
	// EBD OF SIMUL
	// =======================================================================================

	// =======================================================================================
	// PETITIONING MODULE
	// =======================================================================================

	public function petitions()
	{
		$this->load->view('includes_student/student_header');
		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$per_page = 5;
		$end_page = $this->uri->segment(3);
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('Student/petitions'),
			'per_page' => $per_page,
			'total_rows' => $this->Petition_model->fetchPetitions_num_rows(),
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

		$data['petitions'] = $this->Petition_model->fetchPetitions($per_page, $end_page);

		$data['courses'] = $this->Petition_model->fetchCourses();

		// $data['petition_suggestions'] = $this->Courseflow_model->suggest_what_to_petition();

		$data['petition_suggestions'] = $this->Courseflow_model->suggest_what_to_petition_v2();
		// $this->dd($rs);
		// $this->dd($data['petition_suggestions']);
		$data['petitions_available'] = $this->Courseflow_model->suggested_petitions_available();
		$data['petitioners'] = $this->Petition_model->fetchAllPetitioners();

		// echo json_encode($data);

		$this->load->view('content_student/student_petitions', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	public function submitPetition()
	{
		$course_code = $this->input->post('course_code');
		$petition_unique = $course_code . time();

		$result = $this->Courseflow_model->check_if_existing_petition($course_code);

		$petition_details = array(
			'course_code' => $course_code,
			'petition_unique' => $petition_unique,
			'stud_number' => $this->session->acc_number,
			'date_submitted' => time()
		);

		if ($result) {
			if ($this->Petition_model->submitPetition($petition_details)) {
				$success = "Petition created successfully!";
				$this->session->set_flashdata('petition_message', $success);
				redirect('Student/petitions');
				// $this->petitions($success, null);
			} else {
				$error = "Failed to create petition.";
				$this->session->set_flashdata('petition_message', $error);
				redirect('Student/petitions');
				// $this->petitions(null, $error);
			}
		} else {
			$error = "Failed to create petition.";
			$this->session->set_flashdata('petition_message', $error);
			redirect('Student/petitions');
			// $this->petitions(null, $error);
		}
	}

	public function petitionView($petitionID, $petition_unique)
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$data['petition'] = $this->Petition_model->fetchPetition($petitionID);
		$data['petitioners'] = $this->Petition_model->fetchPetitioners($petition_unique);
		$data['courses'] = $this->Petition_model->fetchCourses();
		$data['petition_sched'] = $this->Petition_model->fetch_petition_class_sched($petitionID);

		$data['check_if_you_petitioned'] = $this->Petition_model->check_if_you_petitioned($petition_unique);

		$this->load->view('content_student/student_petitionView', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
	}

	public function sign_petition($stud_number, $course_code, $petition_unique)
	{
		$this->Petition_model->signPetition($stud_number, $course_code, $petition_unique);
		redirect('Student/petitions');
	}

	public function withdraw_petition($stud_number, $petition_unique)
	{
		$this->Petition_model->withdrawPetition($stud_number, $petition_unique);
		$success = "Petition withdrawn succesfully!";
		$this->petitions($success, null);
	}

	// =======================================================================================
	// END OF PETITIONING MODULE
	// =======================================================================================

	// =======================================================================================
	// NOTIFICATIONS
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
				'notif_recipient' => $recipient->acc_number,
				'notif_content' => $message,
				'notif_link' => $link,
				'notif_created_at' => time()
			);

			$this->Notification_model->notify($notif_details);
			array_push($clients, $recipient->acc_number);
		}

		$announcement['message'] = $message;
		$announcement['recipient'] = $clients;
		$pusher->trigger('my-channel', 'client_specific', $announcement);
	}

	public function notifications()
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$per_page = 10;
		$end_page = $this->uri->segment(3);
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('Student/notifications'),
			'per_page' => $per_page,
			'total_rows' => $this->Notification_model->get_all_notif_count(),
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

		$data['notifications'] = $this->Notification_model->get_notifs($per_page, $end_page);

		$this->load->view('content_student/student_notifications', $data);

		$this->load->view('includes_student/student_contentFooter');
		$this->load->view('includes_student/student_rightnav');
		$this->load->view('includes_student/student_footer');
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
		$pusher->trigger('my-channel', 'update_dashboard_admin', null);
	}

	// =======================================================================================
	// END OF NOTIFICATIONS
	// =======================================================================================

	// =======================================================================================
	// OTHER
	// =======================================================================================

	public function check_units()
	{
		$this->load->view('includes_student/student_header');
		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$totalunits = 0;
		$data = $this->CourseCard_model->fetch_course_card_admin($this->session->acc_number);
		$array = json_decode(json_encode($data));
		foreach ($array as $arr) {
			$totalunits += ($arr->course_units + $arr->laboratory_units);
		}
		// echo $totalunits;
		if ($totalunits < 12 && $totalunits > 0) {
			redirect('Student/underload_request');
		} else if ($totalunits > 0 && $totalunits > 21 && $totalunits <= 24) {
			redirect('Student/overload_request');
		} else {
			$this->load->view('content_student/not_qualified');

			$this->load->view('includes_student/student_contentFooter');
			$this->load->view('includes_student/student_rightnav');
			$this->load->view('includes_student/student_footer');
		}
	}

	public function check_graduating()
	{
		$this->load->view('includes_student/student_header');

		$this->load->view('includes_student/student_topnav');
		$this->load->view('includes_student/student_sidebar');

		$totalunits = 0.0;
		$totalunitspassed = 0.0;
		$course_units = 0.0;
		$lab_units = 0.0;
		$coursepassed = 0.0;
		$labpassed = 0.0;

		$curriculum = $this->Curriculum_model->get_curriculum($this->session->Curriculum_code);
		$progress = $this->Dashboard_model->fetchProgress();
		$curr = json_decode(json_encode($curriculum));
		$grades = json_decode(json_encode($progress));

		foreach ($curr as $unit) {
			$course_units += $unit->course_units;
			$lab_units += $unit->laboratory_units;
			foreach ($grades as $grade) {
				if ($unit->course_code == $grade->cc_course && ($grade->cc_status == "finished" || $grade->cc_status == "credited") && $grade->cc_final >= 1.0) {
					$coursepassed += $unit->course_units;
				}
				if (strtoupper($unit->laboratory_code) == strtoupper($grade->cc_course) && ($grade->cc_final > 1.0 && $grade->cc_final <= 4.0)) {
					$labpassed += $unit->laboratory_units;
				}
			}
		}

		$totalunits = $course_units + $lab_units;
		$totalunitspassed = $coursepassed + $labpassed;

		$remaining_units = $totalunits - $totalunitspassed;
		$this->session->set_userdata('remaining_units', $remaining_units);

		if (($remaining_units) <= 18) {
			redirect('Student/simulRequest');
		} else {
			$this->load->view('content_student/not_qualified');

			$this->load->view('includes_student/student_contentFooter');
			$this->load->view('includes_student/student_rightnav');
			$this->load->view('includes_student/student_footer');
		}
	}

	public function maintenance()
	{
		$this->load->view('maintenance_page');
	}

	public function dd($data)
	{
		echo "<pre>";
		print_r($data);
		echo "<pre>";
		die();
	}
}
