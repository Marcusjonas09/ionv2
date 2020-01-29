<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Curriculum_model extends CI_Model
{
    //ADMIN FUNCTIONS

    public function show_curriculum($CurriculumCode)
    {
        $this->db->select('*');
        $this->db->where(array('courses_tbl.curriculum_code' => $CurriculumCode));
        $this->db->from('courses_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl.laboratory_code', 'LEFT');
        $this->db->join('course_card_tbl', 'course_card_tbl.cc_course = courses_tbl.course_code', 'LEFT');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    //STUDENT FUNCTIONS

    public function fetch_curriculum()
    {
        $this->db->select('*');
        $this->db->where(array(
            'courses_tbl.curriculum_code' => $this->session->Curriculum_code,
            // 'course_card_tbl.cc_stud_number' => $this->session->acc_number,
        ));
        $this->db->from('courses_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl.laboratory_code', 'LEFT');
        // $this->db->join('course_card_tbl', 'course_card_tbl.cc_course = courses_tbl.course_code', 'LEFT');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_grades()
    {
        $query = $this->db->get_where('course_card_tbl', array('cc_stud_number' => $this->session->acc_number));
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

    public function fetchCoursesAdmin()
    {
        $query = $this->db->get('courses_tbl');
        return $query->result();
    }


























    // UNUSED FUNCTIONS

    // public function fetchCurriculum()
    // {
    //     $this->db->select('*');
    //     $this->db->where(array('courses_tbl.curriculum_code' => $this->session->Curriculum_code));
    //     $this->db->from('curriculum_tbl');
    //     $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_id = curriculum_tbl.laboratory_id');
    //     $this->db->join('courses_tbl', 'courses_tbl.course_id = curriculum_tbl.course_id');
    //     $this->db->join('course_status', 'course_status.status_id = curriculum_tbl.status_id');
    //     $this->db->order_by('courses_tbl.course_code', 'ASC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}
