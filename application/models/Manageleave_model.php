<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageleave_model extends CI_Model {

    public function apply_leave($data) {
        return $this->db->insert('tbl_leave_request', $data);
    }

    public function get_leaves($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get('tbl_leave_request');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null; // Return null if no results found
        }
    }

    public function get_leave_requests() {
        $this->db->select('*');
        $this->db->from('tbl_leave_request');
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_leave_status($leave_id, $status) {
        $this->db->where('id', $leave_id);
        $this->db->update('tbl_leave_request', array('status' => $status));
    }

    public function reject_leave_request($leave_id, $reject_reason) {
        $this->db->where('id', $leave_id);
        $this->db->update('tbl_leave_request', array('status' => 'Rejected', 'reject_reason' => $reject_reason));
    }
}
