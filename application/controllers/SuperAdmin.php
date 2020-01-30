<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SuperAdmin_model');
        $this->load->model('Account_model');
        $this->load->model('Academics_model');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('text');
        date_default_timezone_set("Asia/Singapore");
        require 'vendor/autoload.php';
    }

    // =======================================================================================
    // DATABASE FUNCTIONALITIES
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
                    redirect('Admin/dashboard');
                } else if ($this->session->access == 'superadmin') {
                    redirect('SuperAdmin');
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

    public function add_student($message = null)
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

        $this->load->view('content_super_admin/manage_student/add_student', $data);

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

    // public function add_program_csv()
    // {
    //     if (isset($_POST["import"])) {
    //         $message = $this->SuperAdmin_model->add_program_csv($_FILES['csv_file']);
    //     } else {
    //         $message = '
    //     <div class="alert alert-success alert-dismissible">
    //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    //         <h4><i class="icon fa fa-warning"></i>Warning!</h4>
    //         <p>Please select a file!</p>
    //     </div>
    //     ';
    //     }
    //     $this->add_program($message);
    // }

    public function create_student()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // die();
        $this->form_validation->set_rules('acc_number', 'Student number', 'required|strip_tags|is_unique[accounts_tbl.acc_number]');
        $this->form_validation->set_rules('acc_fname', 'First Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_mname', 'Middle Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_lname', 'Last Name', 'required|strip_tags');
        $this->form_validation->set_rules('acc_program', 'Program designation', 'required|strip_tags');
        $this->form_validation->set_rules('acc_college', 'College designation', 'required|strip_tags');
        $this->form_validation->set_rules('curriculum_code', 'Curriculum code', 'required|strip_tags');
        $this->form_validation->set_rules('acc_citizenship', 'Citizenship', 'required|strip_tags');
        $this->form_validation->set_rules('acc_access_level', 'Access level', 'required|strip_tags');
        $this->form_validation->set_rules('acc_citizenship', 'Citizenship', 'required|strip_tags');

        if ($this->form_validation->run() == FALSE) {
            $this->add_student();
        } else {
            $program = array(
                'acc_number' => $this->input->post('acc_number'),
                'acc_fname' => $this->input->post('acc_fname'),
                'acc_mname' => $this->input->post('acc_mname'),
                'acc_lname' => $this->input->post('acc_lname'),
                'acc_program' => $this->input->post('acc_program'),
                'acc_college' => $this->input->post('acc_college'),
                'curriculum_code' => $this->input->post('curriculum_code'),
                'acc_citizenship' => $this->input->post('acc_citizenship'),
                'acc_status' => $this->input->post('acc_status'),
                'acc_access_level' => $this->input->post('acc_access_level')
            );

            $this->SuperAdmin_model->create_student($program);
            $message = '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Success!</h4>
            <p>Record successfully added!</p>
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
        // $id = $this->input->post('college_id');
        $data['college'] = $this->SuperAdmin_model->fetch_college($id);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        // print_r($data);
        // die();

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
        $this->form_validation->set_rules('college_code', 'College Code', 'required|strip_tags');
        $this->form_validation->set_rules('college_description', 'College Description', 'required|strip_tags');
        $id = $this->input->post('college_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_college($id);
        } else {
            $college = array(
                'college_code' => $this->input->post('college_code'),
                'college_description' => $this->input->post('college_description')
            );

            $this->SuperAdmin_model->edit_college($id, $college);
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
        $this->form_validation->set_rules('college_code', 'College Code', 'required|strip_tags|is_unique[college_tbl.college_code]');
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
        $this->form_validation->set_rules('department_code', 'Department Code', 'required|strip_tags');
        $this->form_validation->set_rules('department_description', 'Department Description', 'required|strip_tags');
        $this->form_validation->set_rules('assigned_college', 'College assignment', 'required|strip_tags');
        $id = $this->input->post('department_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_department($id);
        } else {
            $department = array(
                'department_code' => $this->input->post('department_code'),
                'department_description' => $this->input->post('department_description'),
                'assigned_college' => $this->input->post('assigned_college')
            );

            $this->SuperAdmin_model->edit_department($id, $department);
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
        $this->form_validation->set_rules('department_code', 'Department Code', 'required|strip_tags|is_unique[department_tbl.department_code]');
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

    public function add_course_curriculum($id, $success_msg = null, $fail_msg = null)
    {
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;
        $data['curriculum_code'] = $this->SuperAdmin_model->fetch_curriculum($id);
        $data['courses'] = $this->Academics_model->fetch_all_courses();
        $data['laboratories'] = $this->Academics_model->fetch_all_laboratories();
        $data['curriculum'] = $this->SuperAdmin_model->fetch_single_curriculum($data['curriculum_code']->curriculum_code);

        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_curriculum/add_course_curriculum', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_curriculum($success_msg = null)
    {
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['success_msg'] = $success_msg;
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_curriculum/add_curriculum', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function add_course_to_curriculum()
    {
        $this->form_validation->set_rules('course_id', 'Course Code', 'required|strip_tags');
        $this->form_validation->set_rules('laboratory_id', 'Laboratory Code', 'required|strip_tags');
        $this->form_validation->set_rules('curriculum_code_id', 'Curriculum Code', 'required|strip_tags');
        $this->form_validation->set_rules('year', 'Year', 'required|strip_tags');
        $this->form_validation->set_rules('term', 'Term', 'required|strip_tags');
        $id = $this->input->post('curriculum_code_id');
        if ($this->form_validation->run() == FALSE) {
            $this->add_course_curriculum($id);
        } else {
            $curriculum = array(
                'course_id' => $this->input->post('course_id'),
                'laboratory_id' => $this->input->post('laboratory_id'),
                'curriculum_code_id' => $this->input->post('curriculum_code_id'),
                'year' => $this->input->post('year'),
                'term' => $this->input->post('term')
            );

            $this->SuperAdmin_model->add_course_to_curriculum($curriculum);
            $this->add_course_curriculum($id, "Record successfully edited!");
        }
    }

    public function edit_curriculum($id, $success_msg = null, $fail_msg = null)
    {
        // $id = $this->input->post('college_id');
        $data['curriculum'] = $this->SuperAdmin_model->fetch_curriculum($id);
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;

        // print_r($data);
        // die();

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
        $id = $this->input->post('curriculum_code_id');
        if ($this->form_validation->run() == FALSE) {
            $this->edit_curriculum($id);
        } else {
            $curriculum = array(
                'curriculum_code' => $this->input->post('curriculum_code'),
                'assigned_department' => $this->input->post('assigned_department')
            );

            $this->SuperAdmin_model->edit_curriculum($id, $curriculum);
            $this->edit_curriculum($id, "Record successfully edited!");
        }
    }

    public function delete_course_from_curriculum($id, $curr_id)
    {
        if (!$this->SuperAdmin_model->delete_course_from_curriculum($id)) {
            $this->SuperAdmin_model->delete_course_from_curriculum($id);
            $this->add_course_curriculum($curr_id, "Record successfully deleted!");
        } else {
            $this->add_course_curriculum($curr_id, null, "Failed to delete Record!");
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

    public function delete_curriculum($id)
    {

        if (!$this->SuperAdmin_model->delete_curriculum($id)) {
            $this->SuperAdmin_model->delete_curriculum($id);
            $this->curriculum("Record successfully deleted!", null);
        } else {
            $this->curriculum(null, "Failed to delete Record!");
        }
    }

    // =======================================================================================
    // END OF CURRICULUM
    // =======================================================================================

    // =======================================================================================
    // DASHBOARD
    // =======================================================================================

    public function dashboard()
    {
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/dashboard/dashboard');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF DASHBOARD
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

        $this->load->view('content_super_admin/manage_accounts/view_admin');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function create_admin()
    {
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_accounts/create_admin');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    //INSERT FUNCTION
    public function create_admin_function()
    {
        //here are the validation entry
        $this->form_validation->set_rules('emp_fname', 'First Name', 'required|max_length[50]|strip_tags');
        $this->form_validation->set_rules('emp_lname', 'Last Name', 'required|max_length[50]|strip_tags');
        $this->form_validation->set_rules('emp_mname', 'Middle Name', 'required|max_length[50]|strip_tags');
        $this->form_validation->set_rules('emp_dept', 'Department', 'required|max_length[50]|strip_tags');
        $this->form_validation->set_rules('emp_no', 'Employee Number', 'required|max_length[50]|strip_tags');
        $this->form_validation->set_rules('emp_desig', 'Employee Designation', 'required|max_length[50]|strip_tags');

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

        $this->load->view('content_super_admin/manage_accounts/block_admin');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    public function edit_admin($id, $data)
    {
        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/manage_accounts/edit_admin');

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
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
        // $id = $this->input->post('college_id');
        $data['course'] = $this->SuperAdmin_model->fetch_course($id);
        $data['laboratories'] = $this->SuperAdmin_model->fetch_all_laboratories();
        $data['departments'] = $this->SuperAdmin_model->fetch_all_department();
        $data['prereqs'] = $this->SuperAdmin_model->fetch_all_prereq($data['course']->course_code);
        $data['prereq_courses'] = $this->SuperAdmin_model->fetch_all_prereq_courses($data['course']->course_code);
        $data['success_msg'] = $success_msg;
        $data['fail_msg'] = $fail_msg;
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();

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

    public function school_parameters()
    {
        $data['college_count'] = $this->SuperAdmin_model->fetch_college_count();
        $data['department_count'] = $this->SuperAdmin_model->fetch_department_count();
        $data['program_count'] = $this->SuperAdmin_model->fetch_program_count();
        $data['specialization_count'] = $this->SuperAdmin_model->fetch_specialization_count();
        $data['course_count'] = $this->SuperAdmin_model->fetch_course_count();
        $data['lab_count'] = $this->SuperAdmin_model->fetch_laboratory_count();
        $data['section_count'] = $this->SuperAdmin_model->fetch_section_count();
        $data['curriculum_count'] = $this->SuperAdmin_model->fetch_curriculum_count();


        $this->load->view('includes_super_admin/superadmin_header');
        $this->load->view('includes_super_admin/superadmin_topnav');
        $this->load->view('includes_super_admin/superadmin_sidebar');

        $this->load->view('content_super_admin/school-parameters/school-parameters', $data);

        $this->load->view('includes_super_admin/superadmin_contentFooter');
        $this->load->view('includes_super_admin/superadmin_rightnav');
        $this->load->view('includes_super_admin/superadmin_footer');
    }

    // =======================================================================================
    // END OF SCHOOL PARAMETERS
    // =======================================================================================
}
