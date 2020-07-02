<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Curriculum_model extends CI_Model
{

    public function all_curriculum()
    {
        return $this->db->get('curriculum_tbl')->result();
    }

    public function get_curriculum($CurriculumCode)
    {
        return $this->db->get_where('curriculum_view', array('curriculum_code' => $CurriculumCode))->result();
    }























    //ADMIN FUNCTIONS

    public function show_curriculum($CurriculumCode)
    {
        $this->db->select('*');
        $this->db->where(array('courses_tbl_v2.curriculum_code' => $CurriculumCode));
        $this->db->from('courses_tbl_v2');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl_v2.laboratory_code', 'LEFT');
        $this->db->join('course_card_tbl', 'course_card_tbl.cc_course = courses_tbl_v2.course_code', 'LEFT');
        $this->db->order_by('courses_tbl_v2.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    //STUDENT FUNCTIONS

    public function fetch_curriculum()
    {
        $this->db->select('*');
        $this->db->where(array(
            'courses_tbl_v2.curriculum_code' => $this->session->Curriculum_code,
            // 'course_card_tbl.cc_stud_number' => $this->session->acc_number,
        ));
        $this->db->from('courses_tbl_v2');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl_v2.laboratory_code', 'LEFT');
        // $this->db->join('course_card_tbl', 'course_card_tbl.cc_course = courses_tbl_v2.course_code', 'LEFT');
        $this->db->order_by('courses_tbl_v2.course_code', 'ASC');
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
        $this->db->from('courses_tbl_v2');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchCoursesAdmin()
    {
        $query = $this->db->get('courses_tbl_v2');
        return $query->result();
    }


























    // UNUSED FUNCTIONS

    // public function fetchCurriculum()
    // {
    //     $this->db->select('*');
    //     $this->db->where(array('courses_tbl_v2.curriculum_code' => $this->session->Curriculum_code));
    //     $this->db->from('curriculum_tbl');
    //     $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_id = curriculum_tbl.laboratory_id');
    //     $this->db->join('courses_tbl_v2', 'courses_tbl_v2.course_id = curriculum_tbl.course_id');
    //     $this->db->join('course_status', 'course_status.status_id = curriculum_tbl.status_id');
    //     $this->db->order_by('courses_tbl_v2.course_code', 'ASC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}
