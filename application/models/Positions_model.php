<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Positions_model extends CI_Model {

    // Fetch all positions
    public function get_all_positions() {
        $query = $this->db->get('tbl_positions');
        return $query->result_array();
    }

    // Insert a new position
    public function insert_position($data) {
        return $this->db->insert('tbl_positions', $data);
    }

    // Get a position by ID
    public function get_position_by_id($id) {
        $query = $this->db->get_where('tbl_positions', array('id' => $id));
        return $query->row_array();
    }

    // Update a position
    public function update_position($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_positions', $data);
    }

    // Delete a position
    public function delete_position($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_positions');
    }
}
?>
