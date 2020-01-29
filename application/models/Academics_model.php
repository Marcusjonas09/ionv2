<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Academics_model extends CI_Model
{

    // =======================================================================================
    // ADMIN QUERIES
    // =======================================================================================

    public function fetch_curriculum_admin($curriculum_code)
    {
        $this->db->select('*');
        $this->db->where(array(
            'courses_tbl.curriculum_code' => $curriculum_code,
        ));
        $this->db->from('courses_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl.laboratory_code', 'LEFT');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_progress_admin($stud_number)
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

    // =======================================================================================
    // STUDENT QUERIES
    // =======================================================================================

    public function fetchParallel()
    {
        $this->db->distinct();
        $this->db->select('parallel_root_course');
        $query = $this->db->get('parallel_tbl');
        return $query->result();
    }

    public function fetchParallelCourse()
    {
        $query = $this->db->get('parallel_tbl');
        return $query->result();
    }

    public function fetchOffering($year, $term)
    {
        $query = $this->db->get_where('offering_tbl', array('offering_year' => $year, 'offering_term' => $term));
        return $query->result();
    }

    public function fetch_term()
    {
        $this->db->distinct();
        $this->db->select('offering_term');
        $query = $this->db->get('offering_tbl');
        return $query->result();
    }

    public function fetch_year()
    {
        $this->db->distinct();
        $this->db->select('offering_year');
        $this->db->order_by('offering_year', 'DESC');
        $query = $this->db->get('offering_tbl');
        return $query->result();
    }

    public function fetch_curriculum_student()
    {
        $this->db->select('*');
        $this->db->where(array(
            'courses_tbl.curriculum_code' => $this->session->Curriculum_code,
        ));
        $this->db->from('courses_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl.laboratory_code', 'LEFT');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // public function fetch_sample()
    // {
    //     $this->db->select('*');
    //     // $this->db->where(array('courses_tbl.curriculum_code' => $curriculum_code));
    //     $this->db->from('curriculum_tbl');
    //     $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_id = curriculum_tbl.laboratory_id');
    //     $this->db->join('courses_tbl', 'courses_tbl.course_id = curriculum_tbl.course_id');
    //     $this->db->order_by('courses_tbl.course_code', 'ASC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function fetch_progress_student()
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

    public function fetchCurrentOffering()
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
        $this->db->join('courses_tbl', 'course_card_tbl.cc_course = courses_tbl.course_code', 'LEFT');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = course_card_tbl.cc_course', 'LEFT');
        $this->db->order_by('course_card_tbl.cc_course', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_courses($curriculum_code)
    {
        $this->db->select('*');
        $this->db->where(array('curriculum_code' => $curriculum_code));
        $this->db->from('courses_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_all_courses()
    {
        $this->db->select('*');
        $this->db->from('courses_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_all_laboratories()
    {
        $this->db->select('*');
        $this->db->from('laboratory_tbl');
        $query = $this->db->get();
        return $query->result();
    }
}
