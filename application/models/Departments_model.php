<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments_model extends CI_Model {

    // Fetch all departments
    public function get_all_departments() {
        $query = $this->db->get('tbl_departments');
        return $query->result_array();
    }

    // Insert a new department
    public function insert_department($data) {
        return $this->db->insert('tbl_departments', $data);
    }

    // Get a department by ID
    public function get_department_by_id($id) {
        $query = $this->db->get_where('tbl_departments', array('id' => $id));
        return $query->row_array();
    }

    // Update a department
    public function update_department($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_departments', $data);
    }

    // Delete a department
    public function delete_department($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_departments');
    }
}
?>
