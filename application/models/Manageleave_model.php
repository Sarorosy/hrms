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
    // Get the leave request to find the user ID and leave details
    $leave_request = $this->db->get_where('tbl_leave_request', array('id' => $leave_id))->row_array();

    // Check if the leave request exists
    if (!$leave_request) {
        return "Leave request not found.";
    }

    $user_id = $leave_request['user_id'];
    $user = $this->db->get_where('tbl_admin', array('id' => $user_id))->row_array(); // Use associative array

    // Check if the status is 'Approved'
    if ($status === 'Approved') {
        $leave_type = $leave_request['leave_type_duration'];
        $leave_pay_type = $leave_request['leave_pay_type']; // Assuming you have this field in your leave_request table
        
        $leave_days = 0;

        // Handle leave types
        if ($leave_type === 'single_day') {
            // Single day leave
            $leave_days = 1;
        } elseif ($leave_type === 'multi_days') {
            // Multi-day leave: calculate the difference in days
            $start_date = new DateTime($leave_request['start_date']); // Assuming you have start_date field
            $end_date = new DateTime($leave_request['end_date']); // Assuming you have end_date field
            $leave_days = $start_date->diff($end_date)->days + 1; // Include both start and end dates
        }

        // Check if the user has enough leave balance
        if ($leave_pay_type === 'paid' && $user['leave_balance'] >= $leave_days) {
            // Deduct leave days from the user's leave balance
            $new_leave_balance = $user['leave_balance'] - $leave_days; // Calculate new balance
            
            $this->db->where('id', $user_id);
            $this->db->update('tbl_admin', array('leave_balance' => $new_leave_balance));
        } elseif ($leave_pay_type !== 'paid') {
            // If leave_pay_type is not paid, you can either do nothing or set some status
            // For example, you might want to log this or notify the user
        } else {
            // If leave_pay_type is paid but the user doesn't have enough leave balance
            $this->session->set_flashdata('error', 'Insufficient leave balance for the requested days.');
            return false;
        }

        // Update the leave request status to Approved
        $this->db->where('id', $leave_id);
        $this->db->update('tbl_leave_request', array('status' => $status));

        date_default_timezone_set('Asia/Kolkata');


        // Prepare notification data
        $notification_data = array(
            'user_id' => $user_id,
            'message' => "Your leave request has been " . strtolower($status),
            'read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'title' => "Leave Application Status"
        );

        // Insert the notification
        $this->db->insert('tbl_notifications', $notification_data);
        $this->session->set_flashdata('message', 'Leave request approved successfully.');
    } else {
        // Update the leave request status for non-approval cases
        $this->db->where('id', $leave_id);
        $this->db->update('tbl_leave_request', array('status' => $status));

        date_default_timezone_set('Asia/Kolkata');


        // Prepare notification data for other statuses
        $notification_data = array(
            'user_id' => $leave_request['user_id'],
            'message' => "Your leave request has been " . strtolower($status),
            'read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'title' => "Leave Application Status"
        );

        // Insert the notification
        $this->db->insert('tbl_notifications', $notification_data);
    }
}

    
    
    
    

    public function reject_leave_request($leave_id, $reject_reason) {
        // Update the leave request status to Rejected
        $this->db->where('id', $leave_id);
        $this->db->update('tbl_leave_request', array('status' => 'Rejected', 'reject_reason' => $reject_reason));
    
        // Get user ID from the leave request to insert notification
        $leave_request = $this->db->get_where('tbl_leave_request', array('id' => $leave_id))->row();

        date_default_timezone_set('Asia/Kolkata');

        
        // Prepare notification data
        $notification_data = array(
            'user_id' => $leave_request->user_id,
            'message' => "Your leave request has been rejected.",
            'read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'title' => "Leave Application Status"
        );
    
        // Insert the notification
        $this->db->insert('tbl_notifications', $notification_data);
        $this->session->set_flashdata('message', 'Leave request rejected successfully.');
    }
    
}
