<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification_model extends CI_Model
{
    public function get_all_notif_count()
    {
        $this->db->select('*');
        $this->db->from('notifications_tbl');
        $this->db->where(array('notif_recipient' => $this->session->acc_number));
        $this->db->or_where(array('notif_recipient' => 0));
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_notif()
    {
        $this->db->limit(10);
        $this->db->select('*');
        $this->db->where(array('notif_recipient' => $this->session->acc_number));
        $this->db->or_where(array('notif_recipient' => 0));
        $this->db->from('notifications_tbl');
        $this->db->order_by('notif_created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_notifs($per_page, $end_page)
    {
        $this->db->limit($per_page, $end_page);
        $this->db->select('*');
        $this->db->where(array('notif_recipient' => $this->session->acc_number));
        $this->db->or_where(array('notif_recipient' => 0));
        $this->db->from('notifications_tbl');
        $this->db->order_by('notif_created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }



    public function get_latest_notifications()
    {
        $this->db->select('*');
        $query = $this->db->get_where('notifications_tbl', array(
            'notif_created_at >= ' => $_POST['time'],
            'notif_recipient' => $this->session->acc_number
        ));
        return $query->num_rows();
    }

    public function get_last_login()
    {
        $this->db->select('log_time');
        $this->db->order_by('log_time', 'DESC');
        $query = $this->db->get_where('account_logs', array('log_user' => $this->session->acc_number, 'log_type' => "logout"));
        return $query->row();
    }

    public function notify($notif_details)
    {
        $this->db->insert('notifications_tbl', $notif_details);
    }
}
