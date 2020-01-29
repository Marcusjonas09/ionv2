<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment_model extends CI_Model
{
    public function get_balance()
    {
        $this->db->order_by('bal_year', 'DESC');
        $this->db->order_by('bal_term', 'DESC');
        $query = $this->db->get_where('balance_tbl', array('bal_stud_number' => $this->session->acc_number));
        return $query->result();
    }

    public function get_balance_single($term, $year)
    {
        $query = $this->db->get_where('balance_tbl', array(
            'bal_stud_number' => $this->session->acc_number,
            'bal_term' => $term,
            'bal_year' => $year
        ));
        return $query->row();
    }

    public function get_payments($term, $year)
    {
        $query = $this->db->get_where('payments_tbl', array(
            'pay_stud_number' => $this->session->acc_number,
            'pay_term' => $term,
            'pay_year' => $year
        ));
        return $query->result();
    }
}
