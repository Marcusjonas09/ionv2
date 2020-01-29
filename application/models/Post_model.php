<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{



    public function fetch_posts()
    {
        $this->db->select('*');
        $this->db->from('posts_tbl');
        $this->db->join('accounts_tbl', 'accounts_tbl.acc_number = posts_tbl.post_account_id');
        $this->db->order_by('post_created', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function fetch_post($post_id)
    {
        $this->db->join('accounts_tbl', 'accounts_tbl.acc_number = posts_tbl.post_account_id');
        $query = $this->db->get_where('posts_tbl', array('post_id' => $post_id));
        return $query->row();
    }

    public function update_post($post_id, $data)
    {
        $this->db->where('post_id', $post_id);
        $this->db->update('posts_tbl', $data);

        return $data;
    }

    public function delete_post($post_id)
    {
        $this->db->where('post_id', $post_id);
        $this->db->delete('posts_tbl');
    }

    public function create_post($data)
    {
        $this->db->insert('posts_tbl', $data);
    }
}
