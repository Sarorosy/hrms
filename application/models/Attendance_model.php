<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Set the timezone to Asia/Kolkata
        date_default_timezone_set('Asia/Kolkata');
    }

    public function get_attendance($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('tbl_attendance');
        return $query->result_array();
    }
    public function get_attendance_by_user($user_id) {
        $this->db->select('*');
        $this->db->from('tbl_attendance');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result(); // Return an array of attendance records
    }
    public function get_work_details_by_user($user_id) {
        // Query to fetch all work details where user_id matches
        $this->db->select('*');
        $this->db->from('tbl_work_details');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        
        return $query->result();
    }
    public function get_holidays() {
        $this->db->select('holiday_date, title');
        $this->db->from('tbl_holidays');
        $query = $this->db->get();
        
        return $query->result_array(); // Returns an array of holidays
    }
    

    public function mark_login($user_id) {
        // Check if login has already been marked for today
        $this->db->where('user_id', $user_id);
        $this->db->where('date', date('Y-m-d'));
        $existing_entry = $this->db->get('tbl_attendance')->row();
    
        if (!$existing_entry) {
            // If no entry exists for today, insert a new one
            $data = [
                'user_id' => $user_id,
                'date' => date('Y-m-d'),
                'login_time' => null, // Set to null initially
                'logout_time' => null
            ];
            $this->db->insert('tbl_attendance', $data);
    
            // Update login_time using NOW() from MySQL
            $this->db->set('login_time', 'NOW()', false)
                     ->where('user_id', $user_id)
                     ->where('date', date('Y-m-d'))
                     ->update('tbl_attendance');
        } else {
            // If login has already been marked, you can return an error message or handle it as needed
            return "Login already marked for today.";
        }
    }
    
    public function mark_logout($user_id) {
        // Check if login exists for today and logout hasn't been marked yet
        $this->db->where('user_id', $user_id);
        $this->db->where('date', date('Y-m-d'));
        $this->db->where('logout_time', null); // Ensure logout hasn't been marked yet
        $existing_entry = $this->db->get('tbl_attendance')->row();
    
        if ($existing_entry) {
            // If the user has logged in today but hasn't logged out, mark the logout time
            $this->db->set('logout_time', 'NOW()', false)
                     ->where('user_id', $user_id)
                     ->where('date', date('Y-m-d'))
                     ->update('tbl_attendance');
        } else {
            // If no login exists for today or logout has already been marked, handle it as needed
            return "No active login found for today or logout already marked.";
        }
    }
    public function check_user_attendance($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('date', date('Y-m-d'));
        $query = $this->db->get('tbl_attendance');
    
        return $query->row_array(); // Returns the attendance record for today or null if not found
    }
    
    
    
}
?>
