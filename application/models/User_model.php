<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function login_student($data)
    {
        $this->db->order_by('settings_tbl.settings_ID', 'DESC');
        $settings_query = $this->db->get('settings_tbl');
        $settings = $settings_query->row();

        $query = $this->db->get_where('accounts_tbl', $data);
        $user = $query->row();
        if ($query->num_rows() > 0) {
            if ($user->acc_access_level == 3) {
                $this->session->set_userdata('login', true);
                $this->session->set_userdata('acc_status', $user->acc_status);
                $this->session->set_userdata('acc_number', $user->acc_number);
                $this->session->set_userdata('Firstname', $user->acc_fname);
                $this->session->set_userdata('Middlename', $user->acc_mname);
                $this->session->set_userdata('College', $user->acc_college);
                $this->session->set_userdata('Program', $user->acc_program);
                $this->session->set_userdata('Lastname', $user->acc_lname);
                $this->session->set_userdata('curriculum', $user->curriculum_code);
                $this->session->set_userdata('Curriculum_code', $user->curriculum_code);
                $this->session->set_userdata('curr_term', $settings->school_term);
                $this->session->set_userdata('curr_year', $settings->school_year);
                $this->session->set_userdata('remaining_units', $settings->school_year);
                $this->session->set_userdata('access', 'student');
            } else {
                $this->session->set_userdata('login', false);
            }
        } else {
            return false;
        }
    }

    public function login_admin($data)
    {
        $this->db->order_by('settings_tbl.settings_ID', 'DESC');
        $settings_query = $this->db->get('settings_tbl');
        $settings = $settings_query->row();

        $query = $this->db->get_where('accounts_tbl', $data);
        $user = $query->row();
        if ($query->num_rows() > 0) {
            if ($user->acc_access_level == 1) { // IF SUPER ADMIN
                $this->session->set_userdata('login', true);
                $this->session->set_userdata('acc_status', $user->acc_status);
                $this->session->set_userdata('acc_number', $user->acc_number);
                $this->session->set_userdata('Firstname', $user->acc_fname);
                $this->session->set_userdata('Middlename', $user->acc_mname);
                $this->session->set_userdata('Lastname', $user->acc_lname);
                $this->session->set_userdata('College', $user->acc_college);
                $this->session->set_userdata('Program', $user->acc_program);
                $this->session->set_userdata('curr_term', $settings->school_term);
                $this->session->set_userdata('curr_year', $settings->school_year);
                if ($user->UsesCollege || $user->UsesDepartment || $user->UsesProgram || $user->UsesSpec || $user->UsesCourse || $user->UsesLab || $user->UsesSection || $user->UsesCurriculum || $user->UsesParallel || $user->UsesFaculty || $user->UsesStudent || $user->UsesClass || $user->UsesFinance) {
                    $this->session->set_userdata('has_school_parameters', TRUE);

                    $this->session->set_userdata('UsesCollege', $user->UsesCollege);
                    $this->session->set_userdata('UsesDepartment', $user->UsesDepartment);
                    $this->session->set_userdata('UsesProgram', $user->UsesProgram);
                    $this->session->set_userdata('UsesSpec', $user->UsesSpec);
                    $this->session->set_userdata('UsesCourse', $user->UsesCourse);
                    $this->session->set_userdata('UsesLab', $user->UsesLab);
                    $this->session->set_userdata('UsesSection', $user->UsesSection);
                    $this->session->set_userdata('UsesCurriculum', $user->UsesCurriculum);
                    $this->session->set_userdata('UsesParallel', $user->UsesParallel);
                    $this->session->set_userdata('UsesFaculty', $user->UsesFaculty);
                    $this->session->set_userdata('UsesStudent', $user->UsesStudent);
                    $this->session->set_userdata('UsesClass', $user->UsesClass);
                    $this->session->set_userdata('UsesFinance', $user->UsesFinance);
                } else {
                    $this->session->set_userdata('has_school_parameters', FALSE);

                    $this->session->set_userdata('UsesCollege', FALSE);
                    $this->session->set_userdata('UsesDepartment', FALSE);
                    $this->session->set_userdata('UsesProgram', FALSE);
                    $this->session->set_userdata('UsesSpec', FALSE);
                    $this->session->set_userdata('UsesCourse', FALSE);
                    $this->session->set_userdata('UsesLab', FALSE);
                    $this->session->set_userdata('UsesSection', FALSE);
                    $this->session->set_userdata('UsesCurriculum', FALSE);
                    $this->session->set_userdata('UsesParallel', FALSE);
                    $this->session->set_userdata('UsesFaculty', FALSE);
                    $this->session->set_userdata('UsesStudent', FALSE);
                    $this->session->set_userdata('UsesClass', FALSE);
                    $this->session->set_userdata('UsesFinance', FALSE);
                }
                $this->session->set_userdata('access', 'superadmin');
            } else if ($user->acc_access_level == 2) { // IF ADMIN
                $this->session->set_userdata('login', true);
                $this->session->set_userdata('acc_status', $user->acc_status);
                $this->session->set_userdata('acc_number', $user->acc_number);
                $this->session->set_userdata('Firstname', $user->acc_fname);
                $this->session->set_userdata('Middlename', $user->acc_mname);
                $this->session->set_userdata('Lastname', $user->acc_lname);
                $this->session->set_userdata('College', $user->acc_college);
                $this->session->set_userdata('Program', $user->acc_program);
                $this->session->set_userdata('curr_term', $settings->school_term);
                $this->session->set_userdata('curr_year', $settings->school_year);
                if ($user->UsesCollege || $user->UsesDepartment || $user->UsesProgram || $user->UsesSpec || $user->UsesCourse || $user->UsesLab || $user->UsesSection || $user->UsesCurriculum || $user->UsesParallel || $user->UsesFaculty || $user->UsesStudent || $user->UsesClass || $user->UsesFinance) {
                    $this->session->set_userdata('has_school_parameters', TRUE);

                    $this->session->set_userdata('UsesCollege', $user->UsesCollege);
                    $this->session->set_userdata('UsesDepartment', $user->UsesDepartment);
                    $this->session->set_userdata('UsesProgram', $user->UsesProgram);
                    $this->session->set_userdata('UsesSpec', $user->UsesSpec);
                    $this->session->set_userdata('UsesCourse', $user->UsesCourse);
                    $this->session->set_userdata('UsesLab', $user->UsesLab);
                    $this->session->set_userdata('UsesSection', $user->UsesSection);
                    $this->session->set_userdata('UsesCurriculum', $user->UsesCurriculum);
                    $this->session->set_userdata('UsesParallel', $user->UsesParallel);
                    $this->session->set_userdata('UsesFaculty', $user->UsesFaculty);
                    $this->session->set_userdata('UsesStudent', $user->UsesStudent);
                    $this->session->set_userdata('UsesClass', $user->UsesClass);
                    $this->session->set_userdata('UsesFinance', $user->UsesFinance);
                } else {
                    $this->session->set_userdata('has_school_parameters', FALSE);

                    $this->session->set_userdata('UsesCollege', FALSE);
                    $this->session->set_userdata('UsesDepartment', FALSE);
                    $this->session->set_userdata('UsesProgram', FALSE);
                    $this->session->set_userdata('UsesSpec', FALSE);
                    $this->session->set_userdata('UsesCourse', FALSE);
                    $this->session->set_userdata('UsesLab', FALSE);
                    $this->session->set_userdata('UsesSection', FALSE);
                    $this->session->set_userdata('UsesCurriculum', FALSE);
                    $this->session->set_userdata('UsesParallel', FALSE);
                    $this->session->set_userdata('UsesFaculty', FALSE);
                    $this->session->set_userdata('UsesStudent', FALSE);
                    $this->session->set_userdata('UsesClass', FALSE);
                    $this->session->set_userdata('UsesFinance', FALSE);
                }
                $this->session->set_userdata('access', 'admin');
            } else {
                $this->session->set_userdata('login', false);
            }
        } else {
            return false;
        }
    }

    public function check_old_pass($studNumber, $old)
    {
        $this->db->select('*');
        $this->db->where(array('acc_number' => $studNumber, 'acc_password' => $old));
        $this->db->from('accounts_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function changepass($studNumber, $old)
    {
        $this->db->set('acc_password', $old);
        $this->db->where('acc_number', $studNumber);
        $this->db->update('accounts_tbl');
    }

    public function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
        die();
    }
}
