<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Revision_model extends CI_Model
{
    ///////////////////////////////////////////////////////////////////////////////////////////
    // STUDENT FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function submit_revision($stud_number, $curr_year, $curr_term)
    {
        $revision_details = array(
            'rev_stud_number' => $stud_number,
            'rev_year' => $curr_year,
            'rev_term' => $curr_term
        );
        $this->db->insert('cor_revision_tbl', $revision_details);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // ADMIN FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function fetch_all_revisions()
    {
        $this->db->order_by('revision_id', 'DESC');
        $query = $this->db->get('cor_revision_tbl');
        return $query->result();
    }

    public function fetch_revision($stud_number, $term, $year)
    {
        $this->db->where(array(
            'rev_stud_number' => $stud_number,
            'rev_year' => $year,
            'rev_term' => $term
        ));
        $this->db->order_by('revision_id');
        $query = $this->db->get('cor_revision_tbl');
        return $query->row();
    }

    public function fetch_user($stud_number)
    {
        $this->db->select('*');
        $this->db->where(array('acc_number' => $stud_number));
        $this->db->from('accounts_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    public function fetch_course_card_admin($stud_number, $term, $year)
    {
        $this->db->select('*');
        $this->db->where(array(
            'course_card_tbl.cc_stud_number' => $stud_number,
            'course_card_tbl.cc_year' => $year,
            'course_card_tbl.cc_term' => $term
        ));
        $this->db->from('course_card_tbl');
        $this->db->join('courses_tbl', 'course_card_tbl.cc_course = courses_tbl.course_code', 'LEFT');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = course_card_tbl.cc_course', 'LEFT');
        $this->db->order_by('course_card_tbl.cc_course', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_courses()
    {
        $this->db->select('*');
        $this->db->where(array('curriculum_code' => $this->session->Curriculum_code));
        $this->db->from('courses_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchOffering()
    {
        $this->db->select('*');
        $this->db->where(array(
            'year' => $this->session->curr_year,
            'term' => $this->session->curr_term,
        ));
        $this->db->from('offering_tbl');
        $query = $this->db->get();
        return $query->result();
    }
}
