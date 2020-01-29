<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Overload_underload_model extends CI_Model
{
    ///////////////////////////////////////////////////////////////////////////////////////////
    // STUDENT FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function submit_ou($stud_number, $curr_year, $curr_term, $type)
    {
        $ou_details = array(
            'ou_stud_number' => $stud_number,
            'ou_year' => $curr_year,
            'ou_term' => $curr_term,
            'ou_date_posted' => time(),
            'ou_type' => $type
        );
        $this->db->insert('overload_underload_tbl', $ou_details);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // ADMIN FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function fetch_all_revisions()
    {
        $this->db->order_by('ou_id', 'DESC');
        $query = $this->db->get('overload_underload_tbl');
        return $query->result();
    }

    public function fetch_all_overload()
    {
        $this->db->order_by('ou_id', 'DESC');
        $this->db->where(array(
            'ou_type' => 'overload'
        ));
        $query = $this->db->get('overload_underload_tbl');
        return $query->result();
    }

    public function fetch_all_underload()
    {
        $this->db->order_by('ou_date_posted', 'DESC');
        $this->db->where(array(
            'ou_type' => 'underload'
        ));
        $this->db->from('overload_underload_tbl');
        $this->db->join('accounts_tbl', 'accounts_tbl.acc_number = overload_underload_tbl.ou_stud_number');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_overload($stud_number, $term, $year)
    {
        $this->db->where(array(
            'ou_stud_number' => $stud_number,
            'ou_year' => $year,
            'ou_term' => $term,
            'ou_type' => 'overload'
        ));
        $query = $this->db->get('overload_underload_tbl');
        return $query->row();
    }

    public function fetch_underload($stud_number, $term, $year)
    {
        $this->db->where(array(
            'ou_stud_number' => $stud_number,
            'ou_year' => $year,
            'ou_term' => $term,
            'ou_type' => 'underload'
        ));
        $query = $this->db->get('overload_underload_tbl');
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
            'offering_year' => $this->session->curr_year,
            'offering_term' => $this->session->curr_term,
        ));
        $this->db->from('offering_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function approve_underload($id)
    {
        $this->db->set('ou_status', 1);
        $this->db->set('ou_date_processed', time());
        $this->db->where(array(
            'ou_id' => $id,
        ));
        $this->db->update('overload_underload_tbl');
    }

    public function decline_underload($id)
    {
        $this->db->set('ou_status', 0);
        $this->db->set('ou_date_processed', time());
        $this->db->where(array(
            'ou_id' => $id,
        ));
        $this->db->update('overload_underload_tbl');
    }

    public function approve_overload($id)
    {
        $this->db->set('ou_status', 1);
        $this->db->set('ou_date_processed', time());
        $this->db->where(array(
            'ou_id' => $id,
        ));
        $this->db->update('overload_underload_tbl');
    }

    public function decline_overload($id)
    {
        $this->db->set('ou_status', 0);
        $this->db->set('ou_date_processed', time());
        $this->db->where(array(
            'ou_id' => $id,
        ));
        $this->db->update('overload_underload_tbl');
    }

    public function fetch_coordinator()
    {
        $this->db->select('acc_number');
        $this->db->from('accounts_tbl');
        $this->db->where(array(
            'acc_program' => $this->session->Program,
            'acc_college' => $this->session->College,
            'acc_access_level' => 2,
        ));
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_potential_petitioner()
    { }
}
