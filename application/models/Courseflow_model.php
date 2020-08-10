<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courseflow_model extends CI_Model
{

    public function fetchCurriculum()
    {
        $this->db->select('*');
        $this->db->where(array('courses_tbl_v2.curriculum_code' => $this->session->Curriculum_code));
        $this->db->from('curriculum_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_id = curriculum_tbl.laboratory_id');
        $this->db->join('courses_tbl_v2', 'courses_tbl_v2.course_id = curriculum_tbl.course_id');
        $this->db->order_by('courses_tbl_v2.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetchRecommended()
    {
        $this->db->select('courses_tbl_v2.course_code');
        $this->db->where(array('courses_tbl_v2.curriculum_code' => $this->session->Curriculum_code, 'courses_tbl_v2.course'));
        $this->db->from('courses_tbl_v2');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = courses_tbl_v2.laboratory_code');
        $this->db->order_by('Year', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function studentDetails()
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_number' => $this->session->acc_number));
        return $query->row();
    }

    public function inputDebug($users)
    {
        echo '<pre>';
        var_dump($users);
        die();
        echo '</pre>';
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // PETITIONING FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    // RECOMMEND WHAT TO PETITION

    public function suggest_what_to_petition_v2()
    {
        $parallel_courses = array();
        $courses_passed = array();
        $untaken = array();
        $curr_courses = array();
        $approved_pending_petitions = array();

        $parallel = $this->db->get_where('parallel_curriculum', array('curriculum_code' => $this->session->Curriculum_code))->result();

        foreach ($parallel as $course) {
            array_push($parallel_courses, $course->parallel_course);
        }

        $course_card_passed = $this->db->get_where('course_card_view', array(
            'cc_stud_number' => $this->session->acc_number,
            'cc_final > ' => 0.5,
            'cc_final <= ' => 4.0,
            'course_code !=' => null,
        ))->result();

        foreach ($course_card_passed as $course) {
            array_push($courses_passed, $course->course_code);
        }

        $this->db->where_not_in('course_code', $courses_passed);
        $untaken_failed_courses = $this->db->get_where('curriculum_view', array('curriculum_code' => $this->session->Curriculum_code))->result();

        foreach ($untaken_failed_courses as $course) {
            array_push($untaken,  $course->course_code);
        }

        $curr = $this->db->get_where('curriculum_view', array('curriculum_code' => $this->session->Curriculum_code))->result();

        foreach ($curr as $course) {
            array_push($curr_courses,  $course->course_code);
        }

        $this->db->distinct();
        $this->db->select('course_code');
        $mypetitions = $this->db->get_where('petitions_tbl', array(
            'stud_number' => $this->session->acc_number,
            'petition_status !=' => 0
        ))->result();

        foreach ($mypetitions as $petition) {
            array_push($approved_pending_petitions,  $petition->course_code);
        }

        // return $approved_pending_petitions;

        if ($this->session->curr_year <= 20192020 && $this->session->curr_term < 3) {
            $this->db->distinct();
            $this->db->select('offering_tbl.offering_course_code,offering_tbl.offering_year,offering_term, courses_tbl_v2.course_title,offering_tbl.offering_course_slot');
            $this->db->where_in('offering_course_code', $untaken);
            $this->db->where_not_in('offering_course_code', $parallel_courses);
            $this->db->where_in('offering_course_code', $curr_courses);
            if (!empty($approved_pending_petitions)) {
                $this->db->where_not_in('offering_course_code', $approved_pending_petitions);
            }
            $this->db->join('courses_tbl_v2', 'courses_tbl_v2.course_code = offering_tbl.offering_course_code');
            $suggestions = $this->db->get_where('offering_tbl', array(
                'offering_year' => $this->session->curr_year,
                'offering_term' => $this->session->curr_term,
                // 'offering_course_slot ' => 0
            ))->result();
        } else {
            $this->db->select('*');
            $this->db->where(array(
                'school_year' => $this->session->curr_year,
                'school_term' => $this->session->curr_term
            ));
            // $this->db->where_in('class_code', $untaken_in_offering);
            $this->db->where_in('class_code', $untaken);
            $this->db->where_not_in('class_code', $parallel_courses);
            $this->db->where_in('class_code', $curr_courses);
            $suggestions = $this->db->from('classes_tbl');
        }

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
                array_push($suggestion, $suggest);
            }
        }

        return $suggestion;
    }

    public function suggest_what_to_petition()
    {
        //fetch untaken courses

        $this->db->distinct();
        $this->db->select('cc_course');
        $this->db->from('course_card_tbl');
        $this->db->where(array('cc_stud_number' => $this->session->acc_number));
        $this->db->order_by('cc_course', 'ASC');
        $query = $this->db->get();

        $allcourses = $query->result();

        $allcourse_array = array();
        foreach ($allcourses as $all_course) {
            array_push($allcourse_array, $all_course->cc_course);
        }

        // fetch courses related to specific curriculum

        $this->db->select('courses_tbl_v2.course_code');
        $this->db->where(array('curriculum_tbl.curriculum_code' => $this->session->Curriculum_code));
        $this->db->where_not_in('courses_tbl_v2.course_code', $allcourse_array);
        $this->db->from('curriculum_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = curriculum_tbl.laboratory_code', 'left');
        $this->db->join('courses_tbl_v2', 'courses_tbl_v2.course_code = curriculum_tbl.course_code', 'left');
        $this->db->order_by('courses_tbl_v2.course_code', 'ASC');
        $query = $this->db->get();


        $untaken_courses = $query->result();

        $untaken_in_offering = array();
        foreach ($untaken_courses as $untaken_course) {
            array_push($untaken_in_offering, $untaken_course->course_code);
        }

        if (count($untaken_in_offering) > 0) {

            //fetch untaken courses in offering table

            if ($this->session->curr_year <= 20192020 && $this->session->curr_term < 3) {
                $this->db->distinct();
                $this->db->select('offering_course_code,offering_course_slot');
                $this->db->where(array(
                    'offering_year' => $this->session->curr_year,
                    'offering_term' => $this->session->curr_term,
                ));
                $this->db->where_in('offering_course_code', $untaken_in_offering);
                $this->db->from('offering_tbl');
                $query = $this->db->get();

                $suggestions = $query->result();
                $suggestion = array();
                // $this->dd($suggestions);
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
            } else {

                $this->db->select('*');
                $this->db->where(array(
                    'school_year' => $this->session->curr_year,
                    'school_term' => $this->session->curr_term
                ));
                $this->db->where_in('class_code', $untaken_in_offering);
                $this->db->from('classes_tbl');

                $query = $this->db->get();
                $all_classes = $query->result();

                $classes = array();
                $day = "";
                $time = "";
                $room = "";
                foreach ($all_classes as $class) {
                    $class_scheds = $this->fetchScheds($class->class_sched, $this->session->curr_year, $this->session->curr_year);
                    foreach ($class_scheds as $class_sched) {
                        $day .= ' ' . $class_sched->class_day . ' /';
                        $time .= ' ' . date('H:i:s', strtotime($class_sched->class_start_time)) . '-' . date('H:i:s', strtotime($class_sched->class_end_time)) . ' /';
                        $room .= ' ' . $class_sched->class_room . ' /';
                    }
                    array_push($classes, array(
                        'class_code' => $class->class_code,
                        'class_section' => $class->class_section,
                        'class_faculty' => $class->class_faculty,
                        'class_sched' => $class->class_sched,
                        'class_capacity' => $class->class_capacity,
                        'school_year' => $class->school_year,
                        'school_term' => $class->school_term,
                        'school_term' => $class->school_term,
                        'school_term' => $class->school_term,
                        'sched_day' => substr($day, 0, -1),
                        'sched_time' => substr($time, 0, -1),
                        'sched_room' => substr($room, 0, -1),
                    ));
                    $day = "";
                    $time = "";
                    $room = "";
                }
                $suggestions = $classes;
                $suggestion = array();

                foreach ($suggestions as $suggest) {
                    array_push($suggestion, $suggest['class_code']);
                }
            }

            //fetch course details of suggested courses
            if (count($suggestion) > 0) {
                $this->db->select('*');
                $this->db->from('courses_tbl_v2');
                $this->db->where_in('course_code', $suggestion);
                $query = $this->db->get();
                $course_suggestions = $query->result();
                // return $query->result();
            } else {
                $course_suggestions = 0;
                // return "No suggestions!";
            }

            return $course_suggestions;
        }
        return $query->result();
    }

    public function fetchScheds($class_sched, $year, $term)
    {
        $this->db->select('*');
        $this->db->from('class_schedule_tbl');
        $this->db->where(array(
            'class_sched' => $class_sched,
            'school_year' => $year,
            'school_term' => $term
        ));
        $query = $this->db->get();
        return $query->result();
    }

    //FETCH SUGGESTED PETITIONS AVAILABLE

    public function suggested_petitions_available()
    {
        //fetch untaken courses

        $this->db->distinct();
        $this->db->select('cc_course');
        $this->db->from('course_card_tbl');
        $this->db->where(array('cc_stud_number' => $this->session->acc_number));
        $this->db->order_by('cc_course', 'ASC');
        $query = $this->db->get();

        $allcourses = $query->result();

        $allcourse_array = array();
        foreach ($allcourses as $all_course) {
            array_push($allcourse_array, $all_course->cc_course);
        }

        // fetch courses related to specific curriculum

        $this->db->select('courses_tbl_v2.course_code');
        $this->db->where(array('curriculum_tbl.curriculum_code' => $this->session->Curriculum_code));
        $this->db->where_not_in('courses_tbl_v2.course_code', $allcourse_array);
        $this->db->from('curriculum_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = curriculum_tbl.laboratory_code', 'left');
        $this->db->join('courses_tbl_v2', 'courses_tbl_v2.course_code = curriculum_tbl.course_code', 'left');
        $this->db->order_by('courses_tbl_v2.course_code', 'ASC');
        $query = $this->db->get();

        $untaken_courses = $query->result();

        $untaken_in_offering = array();
        foreach ($untaken_courses as $untaken_course) {
            array_push($untaken_in_offering, $untaken_course->course_code);
        }

        if ($untaken_in_offering) {
            //fetch untaken courses in offering table
            // $this->db->distinct();
            // $this->db->select('offering_course_code,offering_course_slot');
            // $this->db->where(array(
            //     'offering_year' => $this->session->curr_year,
            //     'offering_term' => $this->session->curr_term,
            //     // 'offering_course_slot >' => 0
            // ));
            // $this->db->where_in('offering_course_code', $untaken_in_offering);
            // $this->db->from('offering_tbl');
            // $query = $this->db->get();

            // $suggestions = $query->result();

            // $suggestion = array();
            // foreach ($suggestions as $suggest) {
            //     $sample = 0;
            //     foreach ($suggestions as $suggest_inner) {
            //         if ($suggest_inner->offering_course_code == $suggest->offering_course_code) {
            //             $sample += $suggest_inner->offering_course_slot;
            //         }
            //     }
            //     if ($sample) {
            //         $sample = 0;
            //     } else {
            //         array_push($suggestion, $suggest->offering_course_code);
            //     }
            // }

            if ($this->session->curr_year <= 20192020 && $this->session->curr_term < 3) {
                $this->db->distinct();
                $this->db->select('offering_course_code,offering_course_slot');
                $this->db->where(array(
                    'offering_year' => $this->session->curr_year,
                    'offering_term' => $this->session->curr_term,
                ));
                $this->db->where_in('offering_course_code', $untaken_in_offering);
                $this->db->from('offering_tbl');
                $query = $this->db->get();

                $suggestions = $query->result();
                $suggestion = array();
                // $this->dd($suggestions);
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
            } else {

                $this->db->select('*');
                $this->db->where(array(
                    'school_year' => $this->session->curr_year,
                    'school_term' => $this->session->curr_term
                ));
                $this->db->where_in('class_code', $untaken_in_offering);
                $this->db->from('classes_tbl');

                $query = $this->db->get();
                $all_classes = $query->result();

                $classes = array();
                $day = "";
                $time = "";
                $room = "";
                foreach ($all_classes as $class) {
                    $class_scheds = $this->fetchScheds($class->class_sched, $this->session->curr_year, $this->session->curr_year);
                    foreach ($class_scheds as $class_sched) {
                        $day .= ' ' . $class_sched->class_day . ' /';
                        $time .= ' ' . date('H:i:s', strtotime($class_sched->class_start_time)) . '-' . date('H:i:s', strtotime($class_sched->class_end_time)) . ' /';
                        $room .= ' ' . $class_sched->class_room . ' /';
                    }
                    array_push($classes, array(
                        'class_code' => $class->class_code,
                        'class_section' => $class->class_section,
                        'class_faculty' => $class->class_faculty,
                        'class_sched' => $class->class_sched,
                        'class_capacity' => $class->class_capacity,
                        'school_year' => $class->school_year,
                        'school_term' => $class->school_term,
                        'school_term' => $class->school_term,
                        'school_term' => $class->school_term,
                        'sched_day' => substr($day, 0, -1),
                        'sched_time' => substr($time, 0, -1),
                        'sched_room' => substr($room, 0, -1),
                    ));
                    $day = "";
                    $time = "";
                    $room = "";
                }
                $suggestions = $classes;
                $suggestion = array();

                foreach ($suggestions as $suggest) {
                    array_push($suggestion, $suggest['class_code']);
                }
            }



            // select petitions that we do not want to be suggested
            $this->db->distinct();
            $this->db->select('petitioners_tbl.petition_unique,petitions_tbl.course_code,petitions_tbl.petition_status');
            $this->db->where(array(
                'petitioners_tbl.stud_number' => $this->session->acc_number,
            ));
            $this->db->from('petitioners_tbl');
            $this->db->join('petitions_tbl', 'petitions_tbl.petition_unique = petitioners_tbl.petition_unique');
            $query = $this->db->get();
            $samples = $query->result();

            $myarr = array();
            foreach ($samples as $sample) {
                array_push($myarr, $sample->course_code);
            }

            // $this->dd($myarr);

            if (count($suggestion) > 0) {
                $this->db->select('*');
                $this->db->from('petitions_tbl');
                if ($myarr) {
                    $this->db->where_not_in('petitions_tbl.course_code', $myarr);
                }
                // $this->db->where(array(
                //     'petitions_tbl.stud_number !=' => $this->session->acc_number,
                // ));
                $this->db->where_in('petitions_tbl.course_code', $suggestion);
                $query = $this->db->get();
                $course_suggestions = $query->result();
            } else {
                $course_suggestions = 0;
            }
            // $this->dd($course_suggestions);
            return $course_suggestions;
        }
        return $query->result();
    }

    public function fetchOffering($course_code)
    {
        $this->db->select('offering_course_code, offering_course_slot');
        $this->db->where(array(
            'offering_year' => $this->session->curr_year,
            'offering_term' => $this->session->curr_term,
            'offering_course_code' => $course_code
        ));
        $this->db->from('offering_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function check_if_existing_petition($course_code)
    {
        $this->db->select('petition_unique');
        $this->db->where(array(
            'course_code' => $course_code,
            'petition_status' => 2
        ));
        $this->db->from('petitions_tbl');
        $query = $this->db->get();
        $petition_count = $query->num_rows();

        if ($petition_count > 0) {

            $petition_unique = $query->result();

            $available_petitions = $this->check_if_full($petition_unique);
            //suggest petition
            if ($available_petitions) {
                //suggest petition
                return false;
            } else {
                //create petitions
                return true;
            }
        } else {
            return true;
        }
    }

    public function check_if_full($petition_unique)
    {
        $available_petitions = array();
        foreach ($petition_unique as $petition) {
            $this->db->select('*');
            $this->db->where(array('petition_unique' => $petition->petition_unique));
            $this->db->from('petitioners_tbl');
            $query = $this->db->get();
            $petitioners = $query->num_rows();
            if ($petitioners < 40) {
                array_push($available_petitions, $petition->petition_unique);
            }
        }
        return $available_petitions;
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    // LOAD REVISION FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////



    ///////////////////////////////////////////////////////////////////////////////////////////
    // OVERLOAD/UNDERLOAD FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////



    ///////////////////////////////////////////////////////////////////////////////////////////
    // SIMUL FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
        die();
    }
}
