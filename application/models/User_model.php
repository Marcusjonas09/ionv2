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
                $this->session->set_userdata('access', 'student');
            } else {
                $this->session->set_userdata('login', false);
            }
            $log_details = array(
                'log_user' => $user->acc_number,
                'log_type' => 'login',
                'log_time' => time()
            );
            $this->db->insert('account_logs', $log_details);
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
                $this->session->set_userdata('access', 'admin');
            } else {
                $this->session->set_userdata('login', false);
            }
            $log_details = array(
                'log_user' => $user->acc_number,
                'log_type' => 'login',
                'log_time' => time()
            );
            $this->db->insert('account_logs', $log_details);
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
}
