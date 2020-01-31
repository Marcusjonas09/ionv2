<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuperAdmin_model extends CI_Model
{

    // =======================================================================================
    // END OF STUDENTS
    // =======================================================================================

    public function fetch_all_student()
    {
        $this->db->select('*');
        $this->db->where(array('acc_access_level' => 3));
        $this->db->from('accounts_tbl');
        $this->db->order_by('acc_lname', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_student_count()
    {
        $this->db->select('*');
        $this->db->where(array('acc_access_level' => 3));
        $this->db->from('accounts_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_student($id)
    {
        $this->db->select('*');
        $this->db->where(array('acc_id' => $id));
        $this->db->from('accounts_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    // public function add_program_csv($data)
    // {
    //     if ($data['name']) {
    //         $filename = explode(".", $data['name']);
    //         if (end($filename) == "csv") {
    //             $handle = fopen($data['tmp_name'], "r");
    //             while ($data = fgetcsv($handle)) {
    //                 $code = strip_tags($data[0]);
    //                 $description = strip_tags($data[1]);
    //                 $assigned_college = strip_tags($data[2]);
    //                 $data = array(
    //                     'program_code' => $code,
    //                     'program_description' => $description,
    //                     'assigned_college' => $assigned_college
    //                 );

    //                 $this->db->insert('programs_tbl', $data);
    //             }
    //             fclose($handle);
    //             $message = '
    //     <div class="alert alert-success alert-dismissible">
    //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    //         <h4><i class="icon fa fa-warning"></i>Success!</h4>
    //         <p>Import complete!</p>
    //     </div>
    //     ';
    //         } else {
    //             $message = '
    //     <div class="alert alert-warning alert-dismissible">
    //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    //         <h4><i class="icon fa fa-warning"></i>Warning!</h4>
    //         <p>Please Select CSV File only</p>
    //     </div>
    //     ';
    //         }
    //     } else {
    //         $message = '
    //     <div class="alert alert-warning alert-dismissible">
    //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    //         <h4><i class="icon fa fa-warning"></i>Warning!</h4>
    //         <p>Please Select File</p>
    //     </div>
    //     ';
    //     }
    //     return $message;
    // }

    public function create_student($student)
    {
        $this->db->insert('accounts_tbl', $student);
    }

    // public function edit_program($id, $content)
    // {
    //     $this->db->where('program_id', $id);
    //     $this->db->update('programs_tbl', $content);
    // }

    // public function delete_program($id)
    // {
    //     $this->db->delete('programs_tbl', array('program_id' => $id));
    // }

    // =======================================================================================
    // END OF STUDENTS
    // =======================================================================================

    // =======================================================================================
    // COLLEGE
    // =======================================================================================

    public function fetch_all_college()
    {
        $this->db->select('*');
        $this->db->from('college_tbl');
        $this->db->order_by('college_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_college_count()
    {
        $this->db->select('*');
        $this->db->from('college_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_college($id)
    {
        $this->db->select('*');
        $this->db->where(array('college_id' => $id));
        $this->db->from('college_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    public function add_college_csv($data)
    {
        if ($data['name']) {
            $filename = explode(".", $data['name']);
            if (end($filename) == "csv") {
                $handle = fopen($data['tmp_name'], "r");
                $line_errors = 0;
                $records_imported = 0;
                while ($data = fgetcsv($handle)) {
                    if (count($data) == 2) {
                        $code = (!empty(strip_tags($data[0])) ? strip_tags($data[0]) : "");
                        $description = (!empty(strip_tags($data[1])) ? strip_tags($data[1]) : "");

                        $data = array(
                            'college_code' => $code,
                            'college_description' => $description
                        );

                        $this->db->insert('college_tbl', $data);
                        $records_imported++;
                    } else {
                        $line_errors++;
                    }
                }
                fclose($handle);
                if ($line_errors > 0) {
                    $message = '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Error!</h4>
                        <p>' . $line_errors . ' records were not imported!</p>
                    </div>
                    ';
                } else {
                    $message = '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Success!</h4>
                        <p>Import complete!</p>
                        <p>' . $records_imported . ' records imported!</p>
                    </div>
                    ';
                }
            } else {
                $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select CSV File only</p>
            <p>Please Select CSV File only</p>
        </div>
        ';
            }
        } else {
            $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select File</p>
        </div>
        ';
        }
        return $message;
    }

    public function create_college($college)
    {
        $this->db->insert('college_tbl', $college);
    }

    public function edit_college($id, $content)
    {
        $this->db->where('college_id', $id);
        $this->db->update('college_tbl', $content);
    }

    public function delete_prereq_from_course($id)
    {
        $this->db->delete('prereq_tbl', array('prereq_id' => $id));
    }

    public function delete_college($id)
    {
        $this->db->delete('college_tbl', array('college_id' => $id));
    }

    // =======================================================================================
    // END OF COLLEGE
    // =======================================================================================

    // =======================================================================================
    // DEPARTMENT
    // =======================================================================================

    public function fetch_all_department()
    {
        $this->db->select('*');
        $this->db->from('department_tbl');
        $this->db->order_by('department_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_department_count()
    {
        $this->db->select('*');
        $this->db->from('department_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_department($id)
    {
        $this->db->select('*');
        $this->db->where(array('department_id' => $id));
        $this->db->from('department_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    public function add_department_csv($data)
    {
        if ($data['name']) {
            $filename = explode(".", $data['name']);
            if (end($filename) == "csv") {
                $handle = fopen($data['tmp_name'], "r");
                $line_errors = 0;
                $records_imported = 0;
                while ($data = fgetcsv($handle)) {
                    if (count($data) == 3) {
                        $code = strip_tags($data[0]);
                        $description = strip_tags($data[1]);
                        $assigned_college = strip_tags($data[2]);
                        $data = array(
                            'department_code' => $code,
                            'department_description' => $description,
                            'assigned_college' => $assigned_college
                        );

                        $this->db->insert('department_tbl', $data);
                        $records_imported++;
                    } else {
                        $line_errors++;
                    }
                }
                fclose($handle);
                if ($line_errors > 0) {
                    $message = '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Error!</h4>
                        <p>' . $line_errors . ' records were not imported!</p>
                    </div>
                    ';
                } else {
                    $message = '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Success!</h4>
                        <p>Import complete!</p>
                        <p>' . $records_imported . ' records imported!</p>
                    </div>
                    ';
                }
            } else {
                $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select CSV File only</p>
        </div>
        ';
            }
        } else {
            $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select File</p>
        </div>
        ';
        }
        return $message;
    }

    public function create_department($department)
    {
        $this->db->insert('department_tbl', $department);
    }

    public function edit_department($id, $content)
    {
        $this->db->where('department_id', $id);
        $this->db->update('department_tbl', $content);
    }

    public function delete_department($id)
    {
        $this->db->delete('department_tbl', array('department_id' => $id));
    }

    // =======================================================================================
    // END OF DEPARTMENT
    // =======================================================================================

    // =======================================================================================
    // PROGRAM
    // =======================================================================================

    public function fetch_all_program()
    {
        $this->db->select('*');
        $this->db->from('programs_tbl');
        $this->db->join('department_tbl', 'department_tbl.department_code = programs_tbl.assigned_department', 'left');
        $this->db->order_by('program_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_program_count()
    {
        $this->db->select('*');
        $this->db->from('programs_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_program($id)
    {
        $this->db->select('*');
        $this->db->where(array('program_id' => $id));
        $this->db->from('programs_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    public function add_program_csv($data)
    {
        if ($data['name']) {
            $filename = explode(".", $data['name']);
            if (end($filename) == "csv") {
                $handle = fopen($data['tmp_name'], "r");
                $line_errors = 0;
                $records_imported = 0;
                while ($data = fgetcsv($handle)) {
                    if (count($data) == 3) {
                        $code = (!empty(strip_tags($data[0])) ? strip_tags($data[0]) : "");
                        $description = (!empty(strip_tags($data[1])) ? strip_tags($data[1]) : "");
                        $assigned_department = (!empty(strip_tags($data[2])) ? strip_tags($data[2]) : "");
                        $data = array(
                            'program_code' => $code,
                            'program_description' => $description,
                            'assigned_department' => $assigned_department
                        );

                        $this->db->insert('programs_tbl', $data);
                        $records_imported++;
                    } else {
                        $line_errors++;
                    }
                }
                fclose($handle);
                if ($line_errors > 0) {
                    $message = '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Error!</h4>
                        <p>' . $line_errors . ' records were not imported!</p>
                    </div>
                    ';
                } else {
                    $message = '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Success!</h4>
                        <p>Import complete!</p>
                        <p>' . $records_imported . ' records imported!</p>
                    </div>
                    ';
                }
            } else {
                $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select CSV File only</p>
        </div>
        ';
            }
        } else {
            $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select File</p>
        </div>
        ';
        }
        return $message;
    }

    public function create_program($program)
    {
        $this->db->insert('programs_tbl', $program);
    }

    public function edit_program($id, $content)
    {
        $this->db->where('program_id', $id);
        $this->db->update('programs_tbl', $content);
    }

    public function delete_program($id)
    {
        $this->db->delete('programs_tbl', array('program_id' => $id));
    }

    // =======================================================================================
    // END OF DEPARTMENT
    // =======================================================================================

    // =======================================================================================
    // SPECIALIZATION
    // =======================================================================================

    public function fetch_all_specializations()
    {
        $this->db->select('*');
        $this->db->from('specialization_tbl');
        $this->db->order_by('specialization_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_specialization_count()
    {
        $this->db->select('*');
        $this->db->from('specialization_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_specialization($id)
    {
        $this->db->select('*');
        $this->db->where(array('specialization_id' => $id));
        $this->db->from('specialization_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    public function add_specialization_csv($data)
    {
        if ($data['name']) {
            $filename = explode(".", $data['name']);
            if (end($filename) == "csv") {
                $handle = fopen($data['tmp_name'], "r");
                $line_errors = 0;
                $records_imported = 0;
                while ($data = fgetcsv($handle)) {
                    if (count($data) == 3) {
                        $code = strip_tags($data[0]);
                        $description = strip_tags($data[1]);
                        $assigned_program = strip_tags($data[2]);
                        $data = array(
                            'specialization_code' => $code,
                            'specialization_description' => $description,
                            'assigned_program' => $assigned_program
                        );

                        $this->db->insert('specialization_tbl', $data);
                        $records_imported++;
                    } else {
                        $line_errors++;
                    }
                }
                fclose($handle);
                if ($line_errors > 0) {
                    $message = '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Error!</h4>
                        <p>' . $line_errors . ' records were not imported!</p>
                    </div>
                    ';
                } else {
                    $message = '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Success!</h4>
                        <p>Import complete!</p>
                        <p>' . $records_imported . ' records imported!</p>
                    </div>
                    ';
                }
            } else {
                $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select CSV File only</p>
        </div>
        ';
            }
        } else {
            $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select File</p>
        </div>
        ';
        }
        return $message;
    }

    public function create_specialization($specialization)
    {
        $this->db->insert('specialization_tbl', $specialization);
    }

    public function edit_specialization($id, $content)
    {
        $this->db->where('specialization_id', $id);
        $this->db->update('specialization_tbl', $content);
    }

    public function delete_specialization($id)
    {
        $this->db->delete('specialization_tbl', array('specialization_id' => $id));
    }

    // =======================================================================================
    // END OF SPECIALIZATION
    // =======================================================================================

    // =======================================================================================
    // CURRICULUM
    // =======================================================================================

    public function fetch_all_curricula()
    {
        $this->db->select('*');
        $this->db->from('curriculum_code_tbl');
        $this->db->order_by('curriculum_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_curriculum_count()
    {
        $this->db->select('*');
        $this->db->from('curriculum_code_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_curriculum($curriculum_code)
    {
        $this->db->select('*');
        $this->db->where(array('curriculum_code' => $curriculum_code));
        $this->db->from('curriculum_code_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    public function create_curriculum($curriculum)
    {
        $this->db->insert('curriculum_code_tbl', $curriculum);
    }

    public function add_course_to_curriculum($curriculum)
    {
        $this->db->insert('curriculum_tbl', $curriculum);
    }

    public function edit_curriculum($id, $content)
    {
        $this->db->where('curriculum_code_id', $id);
        $this->db->update('curriculum_code_tbl', $content);
    }

    public function delete_curriculum($id)
    {
        $this->db->delete('curriculum_code_tbl', array('curriculum_code_id' => $id));
    }

    public function delete_course_from_curriculum($id)
    {
        $this->db->delete('curriculum_tbl', array('curriculum_id' => $id));
    }

    public function fetch_single_curriculum($curriculum_code)
    {
        $this->db->select('*');
        $this->db->where(array('curriculum_tbl.curriculum_code' => $curriculum_code));
        $this->db->from('curriculum_tbl');
        $this->db->join('laboratory_tbl', 'laboratory_tbl.laboratory_code = curriculum_tbl.laboratory_code', 'left');
        $this->db->join('courses_tbl_v2', 'courses_tbl_v2.course_code = curriculum_tbl.course_code', 'left');
        $this->db->order_by('courses_tbl_v2.course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    // =======================================================================================
    // END OF CURRICULUM
    // =======================================================================================

    // =======================================================================================
    // COURSES
    // =======================================================================================

    public function fetch_all_courses()
    {
        $this->db->select('*');
        $this->db->from('courses_tbl_v2');
        $this->db->order_by('course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_all_prereq($code)
    {
        $this->db->select('*');
        $this->db->where(array(
            'course_code !=' => $code,
        ));
        $this->db->from('courses_tbl_v2');
        $this->db->order_by('course_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_all_prereq_courses($code)
    {
        $this->db->select('*');
        $this->db->where(array(
            'root_course =' => $code,
        ));
        $this->db->from('prereq_tbl');
        $this->db->order_by('prereq_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_prereq_to_course($prereq)
    {
        $this->db->insert('prereq_tbl', $prereq);
    }

    public function fetch_all_laboratories()
    {
        $this->db->select('*');
        $this->db->from('laboratory_tbl');
        $this->db->order_by('laboratory_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_course_count()
    {
        $this->db->select('*');
        $this->db->from('courses_tbl_v2');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_course($id)
    {
        $this->db->select('*');
        $this->db->where(array('course_id' => $id));
        $this->db->from('courses_tbl_v2');
        $query = $this->db->get();
        return $query->row();
    }

    public function add_course_csv($data)
    {
        if ($data['name']) {
            $filename = explode(".", $data['name']);
            if (end($filename) == "csv") {
                $handle = fopen($data['tmp_name'], "r");
                $line_errors = 0;
                $records_imported = 0;
                while ($data = fgetcsv($handle)) {
                    if (count($data) == 5) {
                        $code = (!empty(strip_tags($data[0])) ? strip_tags($data[0]) : "");
                        $title = (!empty(strip_tags($data[1])) ? strip_tags($data[1]) : "");
                        $units = (!empty(strip_tags($data[2])) ? strip_tags($data[2]) : "");
                        $lab = (!empty(strip_tags($data[3])) ? strip_tags($data[3]) : "");
                        $department = (!empty(strip_tags($data[4])) ? strip_tags($data[4]) : "");

                        $data = array(
                            'course_code' => $code,
                            'course_title' => $title,
                            'course_units' => $units,
                            'laboratory_code' => $lab,
                            'department_code' => $department
                        );

                        $this->db->insert('courses_tbl_v2', $data);
                        $records_imported++;
                    } else {
                        $line_errors++;
                    }
                }
                fclose($handle);
                if ($line_errors > 0) {
                    $message = '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Error!</h4>
                        <p>' . $line_errors . ' records were not imported!</p>
                    </div>
                    ';
                } else {
                    $message = '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Success!</h4>
                        <p>Import complete!</p>
                        <p>' . $records_imported . ' records imported!</p>
                    </div>
                    ';
                }
            } else {
                $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select CSV File only</p>
            <p>Please Select CSV File only</p>
        </div>
        ';
            }
        } else {
            $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select File</p>
        </div>
        ';
        }
        return $message;
    }



    public function create_course($college)
    {
        $this->db->insert('courses_tbl_v2', $college);
    }

    public function edit_course($id, $content)
    {
        $this->db->where('course_id', $id);
        $this->db->update('courses_tbl_v2', $content);
    }

    public function delete_course($id)
    {
        $this->db->delete('courses_tbl_v2', array('course_id' => $id));
    }

    // =======================================================================================
    // END OF COURSES
    // =======================================================================================

    // =======================================================================================
    // SECTIONS
    // =======================================================================================

    public function fetch_all_sections()
    {
        $this->db->select('*');
        $this->db->from('sections_tbl');
        $this->db->order_by('section_code', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function fetch_section_count()
    {
        $this->db->select('*');
        $this->db->from('sections_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_section($id)
    {
        $this->db->select('*');
        $this->db->where(array('section_id' => $id));
        $this->db->from('sections_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    public function add_section_csv($data)
    {
        if ($data['name']) {
            $filename = explode(".", $data['name']);
            if (end($filename) == "csv") {
                $handle = fopen($data['tmp_name'], "r");
                $line_errors = 0;
                $records_imported = 0;
                while ($data = fgetcsv($handle)) {
                    if (count($data) == 1) {
                        $code = strip_tags($data[0]);
                        // mysqli_query($connect, $query);
                        $data = array(
                            'section_code' => $code,
                        );

                        $this->db->insert('sections_tbl', $data);
                        $records_imported++;
                    } else {
                        $line_errors++;
                    }
                }
                fclose($handle);
                if ($line_errors > 0) {
                    $message = '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Error!</h4>
                        <p>' . $line_errors . ' records were not imported!</p>
                    </div>
                    ';
                } else {
                    $message = '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Success!</h4>
                        <p>Import complete!</p>
                        <p>' . $records_imported . ' records imported!</p>
                    </div>
                    ';
                }
            } else {
                $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select CSV File only</p>
        </div>
        ';
            }
        } else {
            $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select File</p>
        </div>
        ';
        }
        return $message;
    }

    public function create_section($section)
    {
        $this->db->insert('sections_tbl', $section);
    }

    public function edit_section($id, $content)
    {
        $this->db->where('section_id', $id);
        $this->db->update('sections_tbl', $content);
    }

    public function delete_section($id)
    {
        $this->db->delete('sections_tbl', array('section_id' => $id));
    }

    // =======================================================================================
    // END OF SECTIONS
    // =======================================================================================

    // =======================================================================================
    // LABORATORY
    // =======================================================================================

    // public function fetch_all_laboratories()
    // {
    //     $this->db->select('*');
    //     $this->db->from('laboratory_tbl');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function fetch_laboratory_count()
    {
        $this->db->select('*');
        $this->db->from('laboratory_tbl');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function fetch_laboratory($id)
    {
        $this->db->select('*');
        $this->db->where(array('laboratory_id' => $id));
        $this->db->from('laboratory_tbl');
        $query = $this->db->get();
        return $query->row();
    }

    public function add_laboratory_csv($data)
    {
        if ($data['name']) {
            $filename = explode(".", $data['name']);
            if (end($filename) == "csv") {
                $handle = fopen($data['tmp_name'], "r");
                $line_errors = 0;
                $records_imported = 0;
                while ($data = fgetcsv($handle)) {
                    if (count($data) == 3) {
                        $code = (!empty(strip_tags($data[0])) ? strip_tags($data[0]) : "");
                        $title = strip_tags($data[1]);
                        $units = (!empty(strip_tags($data[2])) ? strip_tags($data[2]) : "");
                        $data = array(
                            'laboratory_code' => $code,
                            'laboratory_title' => $title,
                            'laboratory_units' => $units
                        );

                        $this->db->insert('laboratory_tbl', $data);
                        $records_imported++;
                    } else {
                        $line_errors++;
                    }
                }
                fclose($handle);
                if ($line_errors > 0) {
                    $message = '
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Error!</h4>
                        <p>' . $line_errors . ' records were not imported!</p>
                    </div>
                    ';
                } else {
                    $message = '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i>Success!</h4>
                        <p>Import complete!</p>
                        <p>' . $records_imported . ' records imported!</p>
                    </div>
                    ';
                }
            } else {
                $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select CSV File only</p>
        </div>
        ';
            }
        } else {
            $message = '
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i>Warning!</h4>
            <p>Please Select File</p>
        </div>
        ';
        }
        return $message;
    }

    public function create_laboratory($laboratory)
    {
        $this->db->insert('laboratory_tbl', $laboratory);
    }

    public function edit_laboratory($id, $content)
    {
        $this->db->where('laboratory_id', $id);
        $this->db->update('laboratory_tbl', $content);
    }

    public function delete_laboratory($id)
    {
        $this->db->delete('laboratory_tbl', array('laboratory_id' => $id));
    }

    // =======================================================================================
    // END OF LABORATORY
    // =======================================================================================

    // =======================================================================================
    // ADMIN MANAGEMENT FUNCTIONS
    // =======================================================================================

    public function empty_petitions()
    {
        $this->db->truncate('petitioners_tbl');
        $this->db->truncate('petitions_tbl');
    }

    public function empty_notifications()
    {
        $this->db->truncate('notifications_tbl');
    }

    public function empty_overload_underload()
    {
        $this->db->truncate('overload_underload_tbl');
    }

    public function view_all_admin($per_page, $end_page)
    {
        $this->db->limit($per_page, $end_page);
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 2));
        return $query->result();
    }

    public function admin_num_rows()
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 2));
        return $query->num_rows();
    }

    public function create_admin()
    {
        $query = $this->db->insert('accounts_tbl', $_POST);
    }

    public function block_admin($acc_number)
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 2));
        return $query->num_rows();
    }

    public function edit_admin($acc_number, $data)
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_access_level' => 2));
        return $query->num_rows();
    }

    public function view_admin($acc_number)
    {
        $query = $this->db->get_where('accounts_tbl', array('acc_number' => $acc_number));
        return $query->row();
    }

    // =======================================================================================
    // END OF ADMIN MANAGEMENT FUNCTIONS
    // =======================================================================================

    // =======================================================================================
    // STUDENT MANAGEMENT FUNCTIONS
    // =======================================================================================

    // public function create_student($data)
    // {
    //     $this->db->insert('accounts_tbl', $data);
    // }

    // public function edit_student($acc_number, $data)
    // {
    //     $this->db->where('acc_id', $acc_number);
    //     $this->db->update('accounts_tbl', $data);
    // }

    // public function submit_course_card($data)
    // {
    //     $this->db->insert('course_card_tbl', $data);
    // }

    // public function submit_balance($data)
    // {
    //     $this->db->insert('balance_tbl', $data);
    // }

    // public function submit_payment($data)
    // {
    //     $this->db->insert('payments_tbl', $data);
    // }

    // =======================================================================================
    // END OF STUDENT MANAGEMENT FUNCTIONS
    // =======================================================================================
}
