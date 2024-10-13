<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function get_user($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('tbl_admin');
        return $query->row();
    }

    public function update_attendance_status($user_id, $status) {
        $data = ['attendance' => $status];
        $this->db->where('id', $user_id);
        $this->db->update('tbl_admin', $data);
    }
    public function insert_notice($data) {
        $this->db->insert('tbl_notice', $data);
        return $this->db->insert_id(); // Return the inserted notice ID
    }
    public function insert_event($data) {
        return $this->db->insert('tbl_events', $data);
    }
    public function get_all_notices() {
        // Adjust the query as per your table structure
        $this->db->select('*');
        $this->db->from('tbl_notice');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }
    public function get_notice($notice_id)
    {
        // Assuming you have a table named 'tbl_notice'
        $query = $this->db->get_where('tbl_notice', array('id' => $notice_id));

        return $query->row_array();
    }
    public function update_notice($notice_id, $data)
    {
        // Assuming you have a table named 'tbl_notice'
        $this->db->where('id', $notice_id);
        $this->db->update('tbl_notice', $data);
        
        // Return true if update was successful, false otherwise
        return $this->db->affected_rows() > 0;
    }
    public function delete_notice($notice_id)
    {
        $this->db->where('id', $notice_id);
        return $this->db->delete('tbl_notice');
    }

    public function insert_holiday($holiday_data)
    {
        return $this->db->insert('tbl_holidays', $holiday_data);
    }

}
?>
