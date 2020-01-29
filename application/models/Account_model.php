<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_model extends CI_Model
{
    public function fetch_student_accounts($per_page, $end_page)
    {
        $this->db->limit($per_page, $end_page);
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 3));
        $students = $query->result();
        return $students;
    }

    public function fetchStudents()
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 3));
        $students = $query->result();
        return $students;
    }

    public function fetchFaculty()
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 4));
        $faculty = $query->result();
        return $faculty;
    }

    public function fetchAdminAccounts()
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 2));
        $admins = $query->result();
        return $admins;
    }

    public function inputDebug($users)
    {
        echo '<pre>';
        print_r($users);
        die();
        echo '</pre>';
    }

    public function block_user($studNumber)
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_number' => $studNumber));
        $students = $query->row();
        if ($students->acc_status) {
            $new = 0;
        } else {
            $new = 1;
        }

        $this->db->set('acc_status', $new);
        $this->db->where('acc_number', $studNumber);
        $this->db->update('accounts_tbl');
    }

    public function view_user($studNumber)
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_number' => $studNumber));
        return $query->row();
    }

    public function account_num_rows()
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 3));
        return $query->num_rows();
    }
}
