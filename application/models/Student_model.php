<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_model extends CI_Model
{

    public function fetchCOR($stud_number, $year, $term)
    {
        $query = $this->db->get_where('enrolment_tbl', array('stud_number' => $stud_number, 'school_year' => $year, 'school_term' => $term));
        return $query->result();
    }

    public function fetchCourseCard($stud_number, $year, $term)
    {
        $this->db->select('*');
        $this->db->where(array('enrolment_tbl.stud_number' => $stud_number, 'enrolment_tbl.school_year' => $year, 'enrolment_tbl.school_term' => $term));
        $this->db->from('enrolment_tbl');
        $this->db->join('courses_tbl', 'courses_tbl.course_code = enrolment_tbl.course_code');
        $query = $this->db->get();
        return $query->result();
    // }
        // $query = $this->db->get_where('enrolment_tbl', array('stud_number' => $stud_number, 'school_year' => $year, 'school_term' => $term));
        // return $query->result();
    }

    public function fetchTerm()
    {
        $this->db->distinct();
        $this->db->select('school_term');
        $query = $this->db->get('enrolment_tbl');
        return $query->result();
    }

    public function fetchYear()
    {
        $this->db->distinct();
        $this->db->select('school_year');
        $query = $this->db->get('enrolment_tbl');
        return $query->result();
    }
}
