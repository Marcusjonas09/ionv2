<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simul_model extends CI_Model
{

    public function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
        die();
    }

    // =======================================================================================
    // ADMIN FUNCTIONS
    // =======================================================================================

    public function fetch_curriculum($curriculum_code)
    {
        $this->db->select('*');
        $this->db->where(array('curriculum_tbl.curriculum_code' => $curriculum_code));
        $this->db->from('curriculum_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = curriculum_tbl.laboratory_code', 'left');
        $this->db->join('courses_tbl_v2', 'courses_tbl_v2.course_code = curriculum_tbl.course_code', 'left');
        $this->db->order_by('courses_tbl_v2.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchOffering()
    {
        $this->db->select('*');
        $this->db->where(array(
            'offering_year' => $this->session->curr_year,
            'offering_term' => $this->session->curr_term,
        ));
        $this->db->from('offering_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_current_COR($stud_number)
    {
        $this->db->select('*');
        $this->db->where(array(
            'course_card_tbl.cc_stud_number' => $stud_number,
            'course_card_tbl.cc_year' => $this->session->curr_year,
            'course_card_tbl.cc_term' => $this->session->curr_term
        ));
        $this->db->from('course_card_tbl');
        $this->db->join('courses_tbl_v2', 'course_card_tbl.cc_course = courses_tbl_v2.course_code', 'LEFT');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = course_card_tbl.cc_course', 'LEFT');
        $this->db->order_by('course_card_tbl.cc_course', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchProgress($stud_number)
    {
        $this->db->select('cc_status,cc_course,cc_final');
        $this->db->where(array(
            'course_card_tbl.cc_stud_number' => $stud_number,
            'course_card_tbl.cc_final > ' => 0.5,
            'course_card_tbl.cc_final <= ' => 4.0,
        ));
        $this->db->from('course_card_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_all_simul()
    {
        $this->db->select('*');
        $this->db->from('simul_tbl');
        $this->db->join('accounts_tbl', 'simul_tbl.StudentNumber = accounts_tbl.acc_number');
        $q = $this->db->get();
        return $q->result();
    }

    public function fetch_simul($id)
    {
        $this->db->select('*');
        $this->db->from('simul_tbl');
        $this->db->where(array(
            'simul_id' => $id
        ));
        $this->db->join('accounts_tbl', 'simul_tbl.StudentNumber = accounts_tbl.acc_number');
        $q = $this->db->get();
        return $q->row();
    }

    public function fetch_pdf($stud_number)
    {
        $this->db->select('*');
        $this->db->from('simul_tbl');
        $this->db->where(array(
            'StudentNumber' => $stud_number
        ));
        $q = $this->db->get();
        return $q->row();
    }

    // =======================================================================================
    // STUDENT FUNCTIONS
    // =======================================================================================

    public function submit_simul($simul_request)
    {
        $this->db->insert('simul_tbl', $simul_request);
    }

    public function fetch_simul_student($stud_number, $term, $year)
    {
        $this->db->where(array(
            'StudentNumber' => $stud_number,
            'school_year' => $year,
            'school_term' => $term
        ));
        $query = $this->db->get('simul_tbl');
        return $query->row();
    }

    public function fetch_simul_status($stud_number)
    {
        $this->db->select('IsApproved');
        $this->db->from('simul_tbl');
        $this->db->where(array(
            'StudentNumber' => $stud_number
        ));
        $q = $this->db->get();
        return $q->row();
    }

    public function approve_simul($id)
    {
        $this->db->set('IsApproved', 1);
        $this->db->set('date_processed', time());
        $this->db->where(array(
            'simul_id' => $id,
        ));
        $this->db->update('simul_tbl');
    }

    public function decline_simul($id)
    {
        $this->db->set('IsApproved', 0);
        $this->db->set('date_processed', time());
        $this->db->where(array(
            'simul_id' => $id,
        ));
        $this->db->update('simul_tbl');
    }
}
