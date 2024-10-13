<?php
class Feedback_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    // Function to fetch all feedback from the database
    public function get_all_feedback() {
        $query = $this->db->get('tbl_feedback');
        return $query->result_array();
    }

    // Function to add new feedback to the database
    public function add_feedback($data) {
        return $this->db->insert('tbl_feedback', $data);
    }
    public function get_feedback_by_id($id) {
        $this->db->where('employee_id', $id);
    $query = $this->db->get('tbl_feedback');
    return $query->result_array();
    }
}
?>
