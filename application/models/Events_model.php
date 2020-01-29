<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Events_model extends CI_Model
{
    public function fetch_events()
    {
        $this->db->select('title,start,end');
        $this->db->from('events_tbl');
        $query = $this->db->get();
        return $query->result();
    }

    public function create_event($event_details)
    {
        $this->db->insert('events_tbl', $event_details);
    }
}
