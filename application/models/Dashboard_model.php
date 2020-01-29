<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function fetch_curriculum()
    {
        $this->db->select('*');
        $this->db->where(array('courses_tbl.curriculum_code' => $this->session->Curriculum_code));
        $this->db->from('courses_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl.laboratory_code', 'LEFT');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchProgress()
    {
        $this->db->select('cc_status,cc_course,cc_final');
        $this->db->where(array(
            'course_card_tbl.cc_stud_number' => $this->session->acc_number,
            'course_card_tbl.cc_final > ' => 0.5,
            'course_card_tbl.cc_final <= ' => 4.0,
        ));
        $this->db->from('course_card_tbl');
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

    public function fetchCourses()
    {
        $this->db->select('*');
        $this->db->where(array('curriculum_code' => $this->session->Curriculum_code));
        $this->db->from('courses_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchLaboratory()
    {
        $query = $this->db->get('laboratory_tbl');
        return $query->result();
    }
}
