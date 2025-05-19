<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database library
    }

    /**
     * Retrieve recent notices from the database.
     *
     * @param int $limit Limit number of notices to fetch.
     * @return array Array of recent notices.
     */
    public function get_user_by_id($user_id) {
        $query = $this->db->get_where('tbl_admin', array('id' => $user_id));
        return $query->row_array();
    }
    public function get_recent_notices($limit = 2) {
        // Adjust the query as per your table structure
        $this->db->select('*');
        $this->db->from('tbl_notice');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->result_array();
    }
    public function get_all_events() {
    $this->db->where('date >=', date('Y-m-d'));
    $query = $this->db->get('tbl_events');
    return $query->result_array();
}

    public function get_holidays($limit = 5) {
        $query = $this->db->where('holiday_date >=', date('Y-m-d'))
                          ->order_by('holiday_date', 'ASC')
                          ->limit($limit)
                          ->get('tbl_holidays');
        return $query->result_array();
    }
    public function get_birthdays() {
        // Get today's date
        $today = date('Y-m-d');
    
        // Build the SQL query
        $sql = "SELECT * 
                FROM `tbl_admin` 
                WHERE DATE_FORMAT(dob, '%m-%d') >= ?
                ORDER BY DATE_FORMAT(dob, '%m-%d') ASC 
                LIMIT 5";
    
        // Execute the query with parameter binding
        $query = $this->db->query($sql, [date('m-d', strtotime($today))]);
    
        // Return fetched birthdays
        return $query->result_array();
    }
    public function mark_all_as_read($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->update('tbl_notifications', array('read' => 1));
        return $this->db->affected_rows() > 0;
    }
    public function get_latest_leave_request($user_id) {
        $this->db->select('*')
                 ->from('tbl_leave_request')
                 ->where('user_id', $user_id)
                 ->where_in('status', ['pending', 'approved'])
                 ->order_by('id', 'DESC')
                 ->limit(2);
        $query = $this->db->get();
        return $query->result_array(); // Returns last row if exists, else null
    }

    public function get_latest_note_for_employee($employee_id) {
        $this->db->select('*')
                 ->from('tbl_notes')
                 ->where('employee_id', $employee_id)
                 ->order_by('id', 'DESC')
                 ->limit(3);
        $query = $this->db->get();
        return $query->result_array(); // Returns last row if exists, else null
    }
}
?>
