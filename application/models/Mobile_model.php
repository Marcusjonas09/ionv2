<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mobile_model extends CI_Model
{

    ///////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////// MOBILE FUNCTIONS //////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////
    // LOGIN FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function mobilelogin($user, $pass)
    {
        $this->db->where(array('acc_username' => $user, 'acc_password' => sha1($pass)));
        $query = $this->db->get('accounts_tbl');
        $user = $query->row();

        $this->db->order_by('settings_tbl.settings_ID', 'DESC');
        $settings_query = $this->db->get('settings_tbl');
        $settings = $settings_query->row();

        if ($query->num_rows() > 0) {
            if ($user->acc_access_level == 3) {
                // $credentials = array(
                //     'login' => true,
                //     'acc_status' => $user->acc_status,
                //     'acc_number' => $user->acc_number,
                //     'Firstname' => $user->acc_fname,
                //     'Lastname' => $user->acc_lname,
                //     'Curriculum_code' => $user->curriculum_code
                // );
                $credentials = array(
                    'login' => true,
                    'acc_status' => $user->acc_status,
                    'acc_number' => $user->acc_number,
                    'Firstname' => $user->acc_fname,
                    'Middlename' => $user->acc_mname,
                    'Lastname' => $user->acc_lname,
                    'Citizenship' => $user->acc_citizenship,
                    'College' => $user->acc_college,
                    'Program' => $user->acc_program,
                    'Curriculum_code' => $user->curriculum_code,
                    'school_term' => $settings->school_term,
                    'school_year' => $settings->school_year
                );
                return $credentials;
            }
            return false;
        } else {
            return false;
        }
    }


    ///////////////////////////////////////////////////////////////////////////////////////////
    // ACCOUNT FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function studentDetails($studNumber)
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_number' => $studNumber));
        return $query->row();
    }

    public function fetchCurriculum($curriculum_code)
    {
        $this->db->select('*');
        $this->db->where(array('courses_tbl.curriculum_code' => $curriculum_code));
        $this->db->from('curriculum_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_id = curriculum_tbl.laboratory_id');
        $this->db->join('courses_tbl', 'courses_tbl.course_id = curriculum_tbl.course_id');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_curriculum($curriculum_code)
    {
        $this->db->select('*');
        $this->db->where(array('courses_tbl.curriculum_code' => $curriculum_code));
        $this->db->from('courses_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl.laboratory_code', 'LEFT');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
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

    ///////////////////////////////////////////////////////////////////////////////////////////
    // COURSE CARD FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function fetch_course_card($year, $term, $stud_number)
    {
        $this->db->select('*');
        $this->db->where(array(
            'cc_stud_number' => $stud_number,
            'cc_year' => $year,
            'cc_term' => $term,
            'cc_status' => "finished",
        ));
        $this->db->from('course_card_tbl');
        $this->db->join('courses_tbl', 'course_card_tbl.cc_course = courses_tbl.course_code', 'LEFT');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = course_card_tbl.cc_course', 'LEFT');
        $this->db->order_by('course_card_tbl.cc_course', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_course_card_term($stud_number)
    {
        $this->db->distinct();
        $this->db->select('cc_term');
        $this->db->where(array('cc_stud_number' => $stud_number));
        $this->db->order_by('cc_term', 'DESC');
        $query = $this->db->get('course_card_tbl');
        return $query->result();
    }

    public function fetch_course_card_year($stud_number)
    {
        $this->db->distinct();
        $this->db->select('cc_year');
        $this->db->where(array('cc_stud_number' => $stud_number));
        $this->db->order_by('cc_year', 'DESC');
        $query = $this->db->get('course_card_tbl');
        return $query->result();
    }

    public function fetch_course_card_latest($stud_number)
    {
        // $this->db->distinct();
        $this->db->select('cc_year');
        $this->db->where(array('cc_stud_number' => $stud_number));
        $this->db->order_by('cc_year', 'desc');
        $queryYear = $this->db->get('course_card_tbl');
        $year = $queryYear->row();

        // $this->db->distinct();
        $this->db->select('cc_term');
        $this->db->where(array('cc_stud_number' => $stud_number));
        $this->db->order_by('cc_term', 'asc');
        $queryTerm = $this->db->get('course_card_tbl');
        $term = $queryTerm->row();

        $this->db->select('*');
        $this->db->where(array(
            'cc_stud_number' => $stud_number,
            'cc_year' => $year->cc_year,
            'cc_term' => $term->cc_term,
            'cc_status' => "finished",
        ));
        $this->db->from('course_card_tbl');
        $this->db->join('courses_tbl', 'course_card_tbl.cc_course = courses_tbl.course_code', 'LEFT');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = course_card_tbl.cc_course', 'LEFT');
        $this->db->order_by('course_card_tbl.cc_course', 'ASC');
        $query = $this->db->get();
        return $query->result();
        // return $year->cc_year;
        // return $term->cc_term;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // END
    ///////////////////////////////////////////////////////////////////////////////////////////


    ///////////////////////////////////////////////////////////////////////////////////////////
    // COURSE CARD FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function get_final_balance($stud_number)
    {
        $this->db->select_sum('payment');
        $this->db->from('payments_tbl');
        $this->db->where(array('pay_stud_number' => $stud_number));
        $total_payments_query = $this->db->get();

        $this->db->select_sum('bal_total_assessment');
        $this->db->from('balance_tbl');
        $this->db->where(array('bal_stud_number' => $stud_number));
        $total_balance_query = $this->db->get();

        $total_balance = $total_balance_query->row();
        $total_payment = $total_payments_query->row();

        return $total_balance->bal_total_assessment - $total_payment->payment;
    }

    public function get_balance($stud_number)
    {
        $this->db->order_by('bal_year', 'DESC');
        $this->db->order_by('bal_term', 'DESC');
        $query = $this->db->get_where('balance_tbl', array('bal_stud_number' => $stud_number));
        return $query->result();
    }

    public function get_balance_single($stud_number, $term, $year)
    {
        $query = $this->db->get_where('balance_tbl', array(
            'bal_stud_number' => $stud_number,
            'bal_term' => $term,
            'bal_year' => $year
        ));
        return $query->result();
    }

    public function get_payments($stud_number, $term, $year)
    {
        $query = $this->db->get_where('payments_tbl', array(
            'pay_stud_number' => $stud_number,
            'pay_term' => $term,
            'pay_year' => $year
        ));

        return $query->result();
    }

    public function get_balance_term($stud_number)
    {
        $this->db->distinct();
        $this->db->select('bal_term');
        $this->db->where(array('bal_stud_number' => $stud_number));
        $query = $this->db->get('balance_tbl');
        return $query->result();
    }

    public function get_balance_year($stud_number)
    {
        $this->db->distinct();
        $this->db->select('bal_year');
        $this->db->where(array('bal_stud_number' => $stud_number));
        $query = $this->db->get('balance_tbl');
        return $query->result();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // END 
    ///////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SERVICES FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////// PETITION FUNCTIONS //////////////////////////////////////

    public function signPetition($stud_number, $course_code, $petition_unique)
    {
        $petitioner = array(
            'stud_number' => $stud_number,
            'course_code' => $course_code,
            'petition_unique' => $petition_unique,
            'date_submitted' => time()
        );
        $this->db->insert('petitioners_tbl', $petitioner);
    }

    public function submitPetition($petition_details)
    {
        $this->db->insert('petitions_tbl', $petition_details);
        $this->db->insert('petitioners_tbl', $petition_details);
    }

    public function check_petition($course_code)
    {
        $conditions = array(
            'course_code' => $course_code
        );
        $query = $this->db->get_where('petitions_tbl', $conditions);
        $petition_count = $query->num_rows();

        if ($petition_count > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function fetchMyPetitions($stud_number)
    {
        $this->db->select('*');
        $this->db->order_by('petitions_tbl.date_submitted', 'DESC');
        $this->db->where(array(
            'petitioners_tbl.stud_number' => $stud_number
        ));
        $this->db->join('petitioners_tbl', 'petitioners_tbl.petition_unique = petitions_tbl.petition_unique', 'LEFT');
        $this->db->from('petitions_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchPetition($petitionID)
    {
        $query = $this->db->get_where('petitions_tbl', array('petition_ID' => $petitionID));
        return $query->row();
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

    public function suggest_what_to_petition($curriculum_code, $stud_number, $curr_term, $curr_year)
    {

        //fetch untaken courses

        $this->db->distinct();
        $this->db->select('cc_course');
        $this->db->from('course_card_tbl');
        $this->db->where(array('cc_stud_number' => $stud_number));
        $this->db->order_by('cc_course', 'ASC');
        $query = $this->db->get();

        $allcourses = $query->result();

        $allcourse_array = array();
        foreach ($allcourses as $all_course) {
            array_push($allcourse_array, $all_course->cc_course);
        }

        $this->db->select('course_code');
        $this->db->where(array(
            'courses_tbl.curriculum_code' => $curriculum_code,
        ));
        $this->db->where_not_in('course_code', $allcourse_array);
        $this->db->from('courses_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl.laboratory_code', 'LEFT');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
        $query = $this->db->get();
        $untaken_courses = $query->result();

        $untaken_in_offering = array();
        foreach ($untaken_courses as $untaken_course) {
            array_push($untaken_in_offering, $untaken_course->course_code);
        }
        if ($untaken_in_offering) {
            //fetch untaken courses in offering table
            $this->db->distinct();
            $this->db->select('offering_course_code,offering_course_slot');
            $this->db->where(array(
                'offering_year' => $curr_year,
                'offering_term' => $curr_term,
                // 'offering_course_slot >' => 0
            ));
            $this->db->where_in('offering_course_code', $untaken_in_offering);
            $this->db->from('offering_tbl');
            $query = $this->db->get();

            $suggestions = $query->result();

            $suggestion = array();
            foreach ($suggestions as $suggest) {
                $sample = 0;
                foreach ($suggestions as $suggest_inner) {
                    if ($suggest_inner->offering_course_code == $suggest->offering_course_code) {
                        $sample += $suggest_inner->offering_course_slot;
                    }
                }
                if ($sample) {
                    $sample = 0;
                } else {
                    array_push($suggestion, $suggest->offering_course_code);
                }
            }

            $this->db->select('*');
            $this->db->from('courses_tbl');
            $this->db->where_in('course_code', $suggestion);
            $query = $this->db->get();

            return $query->result();
        }
        return $query->result();
    }

    public function suggested_petitions_available($curriculum_code, $stud_number, $curr_term, $curr_year)
    {
        //fetch untaken courses

        $this->db->distinct();
        $this->db->select('cc_course');
        $this->db->from('course_card_tbl');
        $this->db->where(array('cc_stud_number' => $stud_number));
        $this->db->order_by('cc_course', 'ASC');
        $query = $this->db->get();

        $allcourses = $query->result();

        $allcourse_array = array();
        foreach ($allcourses as $all_course) {
            array_push($allcourse_array, $all_course->cc_course);
        }

        $this->db->select('course_code');
        $this->db->where(array(
            'courses_tbl.curriculum_code' => $curriculum_code,
        ));
        $this->db->where_not_in('course_code', $allcourse_array);
        $this->db->from('courses_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl.laboratory_code', 'LEFT');
        $this->db->order_by('courses_tbl.course_code', 'ASC');
        $query = $this->db->get();
        $untaken_courses = $query->result();

        $untaken_in_offering = array();
        foreach ($untaken_courses as $untaken_course) {
            array_push($untaken_in_offering, $untaken_course->course_code);
        }
        if ($untaken_in_offering) {
            //fetch untaken courses in offering table
            $this->db->distinct();
            $this->db->select('offering_course_code,offering_course_slot');
            $this->db->where(array(
                'offering_year' => $curr_year,
                'offering_term' => $curr_term,
                // 'offering_course_slot >' => 0
            ));
            $this->db->where_in('offering_course_code', $untaken_in_offering);
            $this->db->from('offering_tbl');
            $query = $this->db->get();

            $suggestions = $query->result();

            $suggestion = array();
            foreach ($suggestions as $suggest) {
                $sample = 0;
                foreach ($suggestions as $suggest_inner) {
                    if ($suggest_inner->offering_course_code == $suggest->offering_course_code) {
                        $sample += $suggest_inner->offering_course_slot;
                    }
                }
                if ($sample) {
                    $sample = 0;
                } else {
                    array_push($suggestion, $suggest->offering_course_code);
                }
            }
            $this->db->distinct();
            $this->db->select('petition_unique');
            $this->db->where(array('petitioners_tbl.stud_number' => $stud_number));
            $this->db->from('petitioners_tbl');
            $query = $this->db->get();
            $samples = $query->result();
            $myarr = array();
            foreach ($samples as $sample) {
                array_push($myarr, $sample->petition_unique);
            }

            $this->db->select('*');
            $this->db->from('petitions_tbl');
            if ($myarr) {
                $this->db->where_not_in('petitions_tbl.petition_unique', $myarr);
            }
            $this->db->where_in('petitions_tbl.course_code', $suggestion);
            $query = $this->db->get();
            return $query->result();
        }
        return $query->result();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // ACADEMICS FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

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

    public function fetchCurrentOffering()
    {
        $this->db->order_by('settings_tbl.settings_ID', 'DESC');
        $settings_query = $this->db->get('settings_tbl');
        $settings = $settings_query->row();

        $query = $this->db->get_where('offering_tbl', array('offering_year' => $settings->school_year, 'offering_term' => $settings->school_term));
        return $query->result();
    }

    // public function fetch_term()
    // {
    //     $this->db->distinct();
    //     $this->db->select('offering_term');
    //     $this->db->order_by('offering_term', 'DESC');
    //     $query = $this->db->get('offering_tbl');
    //     return $query->result();
    // }

    // public function fetch_year()
    // {
    //     $this->db->distinct();
    //     $this->db->select('offering_year');
    //     $this->db->order_by('offering_year', 'DESC');
    //     $query = $this->db->get('offering_tbl');
    //     return $query->result();
    // }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // OTHER FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function fetchAnnouncements()
    {
        $this->db->select('*');
        $this->db->from('posts_tbl');
        $this->db->join('accounts_tbl', 'accounts_tbl.acc_number = posts_tbl.post_account_id');
        $this->db->order_by('post_created', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function sample($sample)
    {
        $data = array(
            'sample' => $sample
        );
        $this->db->insert('sample_tbl', $data);
        return json_encode(true);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // SERVICES FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function fetchAllNotifications($stud_number)
    {
        $this->db->select('*');
        $this->db->where(array('notif_recipient' => $stud_number));
        $this->db->or_where(array('notif_recipient' => 0));
        $this->db->from('notifications_tbl');
        $this->db->order_by('notif_created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // END
    ///////////////////////////////////////////////////////////////////////////////////////////
}
