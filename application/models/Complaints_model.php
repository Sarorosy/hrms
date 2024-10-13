<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaints_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_complaint($data) {
        return $this->db->insert('tbl_complaints', $data);
    }
    public function get_complaints($search = '', $user_id = '', $subject = '', $start_date = '', $end_date = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_complaints');

        if (!empty($search)) {
            $this->db->like('subject', $search);
            $this->db->or_like('description', $search);
        }

        if (!empty($user_id)) {
            $this->db->where('user_id', $user_id);
        }

        if (!empty($subject)) {
            $this->db->like('subject', $subject);
        }

        if (!empty($start_date)) {
            $this->db->where('happened_at >=', $start_date);
        }

        if (!empty($end_date)) {
            $this->db->where('happened_at <=', $end_date);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function update_complaint_action($complaint_id, $action, $admin_id) {
        // Get the user_id of the complaint
        $this->db->select('user_id');
        $this->db->from('tbl_complaints');
        $this->db->where('complaint_id', $complaint_id);
        $query = $this->db->get();
        $complaint = $query->row();
    
        $data = array(
            'admin_action' => $action,
            'action_taken_by' => $admin_id,
            'action_taken_at' => date('Y-m-d H:i:s'),
            'status' => 'resolved'
        );
    
        $this->db->where('complaint_id', $complaint_id);
        $this->db->update('tbl_complaints', $data);
    
        return $complaint->user_id; // Return the user ID
    }
    public function insert_notification($user_id, $message) {
        $data = array(
            'user_id' => $user_id,
            'title'=>'Complaint Status',
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s'),
            'read' => 0 // Unread by default
        );
    
        $this->db->insert('tbl_notifications', $data);
    }
    
}
?>
