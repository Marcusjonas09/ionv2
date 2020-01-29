<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Real_time_model extends CI_Model
{
    ///////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////// REALTIME FUNCTIONS ////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////////
    // ADMIN DASHBOARD FUNCTIONS
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function fetchPetitions_num_rows()
    {
        $query = $this->db->get_where('petitions_tbl', array('petition_status' => '2'));
        return $query->num_rows();
    }

    public function fetchUnderload_num_rows()
    {
        $query = $this->db->get_where('overload_underload_tbl', array('ou_type' => 'underload', 'ou_status' => '2'));
        return $query->num_rows();
    }

    public function fetchOverload_num_rows()
    {
        $query = $this->db->get_where('overload_underload_tbl', array('ou_type' => 'overload', 'ou_status' => '2'));
        return $query->num_rows();
    }

    public function fetchSimul_num_rows()
    {
        $query = $this->db->get('simul_tbl');
        // return $query->num_rows();
        // $query = $this->db->get_where('simul_tbl', array('simul_status' => '2'));
        return $query->num_rows();
    }
}
