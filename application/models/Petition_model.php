<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petition_model extends CI_Model
{

    // =======================================================================================
    // ADMIN FUNCTIONS
    // =======================================================================================

    public function fetchPetitionsAdmin($per_page, $end_page)
    {
        $this->db->limit($per_page, $end_page);
        $this->db->order_by('date_submitted', 'DESC');
        $query = $this->db->get('petitions_tbl');
        return $query->result();
    }

    public function fetchPetitionsAdmin_num_rows()
    {
        $query = $this->db->get('petitions_tbl');
        return $query->num_rows();
    }

    public function approve_petition($petition_unique)
    {
        $this->db->set('petition_status', 1);
        $this->db->set('date_processed', time());
        $this->db->where('petition_unique', $petition_unique);
        $this->db->update('petitions_tbl');
    }

    public function decline_petition($petition_unique)
    {
        $this->db->set('petition_status', 0);
        $this->db->set('date_processed', time());
        $this->db->where('petition_unique', $petition_unique);
        $this->db->update('petitions_tbl');
    }

    public function fetchCoursesAdmin()
    {
        $query = $this->db->get('courses_tbl');
        return $query->result();
    }

    // =======================================================================================
    // STUDENT FUNCTIONS
    // =======================================================================================

    public function fetchPetitions($per_page, $end_page)
    {
        $this->db->limit($per_page, $end_page);
        $this->db->select('*');
        $this->db->order_by('petitions_tbl.date_submitted', 'DESC');
        $this->db->where(array(
            // 'petitions_tbl.stud_number' => $this->session->acc_number,
            'petitioners_tbl.stud_number' => $this->session->acc_number
        ));
        $this->db->join('petitioners_tbl', 'petitioners_tbl.petition_unique = petitions_tbl.petition_unique', 'LEFT');
        $this->db->from('petitions_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchPetitions_num_rows()
    {
        $query = $this->db->get_where('petitions_tbl', array('stud_number' => $this->session->acc_number));
        return $query->num_rows();
    }

    public function fetchPetition($petitionID)
    {
        $query = $this->db->get_where('petitions_tbl', array('petition_ID' => $petitionID));
        return $query->row();
    }

    public function fetch_petition_recipients($petition_unique)
    {
        $this->db->select('stud_number');
        $query = $this->db->get_where('petitioners_tbl', array('petition_unique' => $petition_unique));
        return $query->result();
    }

    public function fetchPetitioners($petition_unique)
    {
        $this->db->select('*');
        $this->db->where(array('petition_unique' => $petition_unique));
        $this->db->from('petitioners_tbl');
        $this->db->join('accounts_tbl', 'accounts_tbl.acc_number = petitioners_tbl.stud_number');
        $query = $this->db->get();
        return $query->result();
    }

    public function check_if_you_petitioned($petition_unique)
    {
        $this->db->select('*');
        $this->db->where(array('petition_unique' => $petition_unique, 'stud_number' => $this->session->acc_number));
        $this->db->from('petitioners_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_recipients($petition_unique)
    {
        $this->db->select('stud_number');
        $this->db->where(array('petition_unique' => $petition_unique));
        $this->db->from('petitioners_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchAllPetitioners()
    {
        $this->db->select('*');
        $this->db->from('petitioners_tbl');
        // $this->db->join('accounts_tbl', 'accounts_tbl.acc_number = petitioners_tbl.stud_number');
        $query = $this->db->get();
        return $query->result();
    }

    public function submitPetition($petition_details)
    {
        $this->db->insert('petitions_tbl', $petition_details);
        $this->db->insert('petitioners_tbl', $petition_details);

        $this->db->select('petitioner_count');
        $this->db->from('petitions_tbl');
        $this->db->where('petition_unique', $petition_details['petition_unique']);
        $query = $this->db->get();
        $current_count = $query->result();

        $this->db->set('petitioner_count', $current_count[0]->petitioner_count + 1);
        $this->db->where('petition_unique', $petition_details['petition_unique']);
        $this->db->update('petitions_tbl');
        return true;
    }

    public function signPetition($stud_number, $course_code, $petition_unique)
    {
        $petitioner = array(
            'stud_number' => $stud_number,
            'course_code' => $course_code,
            'petition_unique' => $petition_unique,
            'date_submitted' => time()
        );
        $this->db->insert('petitioners_tbl', $petitioner);

        $this->db->select('petitioner_count');
        $this->db->from('petitions_tbl');
        $this->db->where('petition_unique', $petition_unique);
        $query = $this->db->get();
        $current_count = $query->result();

        $this->db->set('petitioner_count', $current_count[0]->petitioner_count + 1);
        $this->db->where('petition_unique', $petition_unique);
        $this->db->update('petitions_tbl');

        // return true;
    }

    public function withdrawPetition($stud_number, $petition_unique)
    {
        $petitioner = array(
            'stud_number' => $stud_number,
            'petition_unique' => $petition_unique,
        );
        $this->db->delete('petitioners_tbl', $petitioner);

        $this->db->select('petitioner_count');
        $this->db->from('petitions_tbl');
        $this->db->where('petition_unique', $petition_unique);
        $query = $this->db->get();
        $current_count = $query->result();
        $this->db->set('petitioner_count', $current_count[0]->petitioner_count - 1);
        $this->db->where('petition_unique', $petition_unique);
        $this->db->update('petitions_tbl');
        // return true;
    }

    public function check_number_of_petitioners($petition_unique)
    {
        $this->db->select('*');
        $this->db->where(array('petition_unique' => $petition_unique));
        $this->db->from('petitioners_tbl');
        $this->db->join('accounts_tbl', 'accounts_tbl.acc_number = petitioners_tbl.stud_number');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetchCourses()
    {
        $this->db->select('*');
        $this->db->where(array('curriculum_code' => $this->session->Curriculum_code));
        $this->db->from('courses_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_updated_petition_status($petition_unique)
    {
        $this->db->select('petition_status');
        $query = $this->db->get_where('petitions_tbl', array('petition_unique' => $petition_unique));
        return $query->row();
    }
}
