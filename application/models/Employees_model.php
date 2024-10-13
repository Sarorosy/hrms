<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // Function to create employee
    public function create_employee($data)
    {
        return $this->db->insert('tbl_admin', $data);
    }
    public function get_admins()
{
    $this->db->where('role', 'ADMIN');
    $query = $this->db->get('tbl_admin');
    return $query->result_array();
}
public function get_positions()
{
    $this->db->where('status', '1');
    $query = $this->db->get('tbl_positions');
    return $query->result_array();
}

    public function get_all_employees()
    {
        $this->db->where('id !=', $this->session->userdata('user_id'));
        $this->db->where('role !=', 'SUPERADMIN');
        return $this->db->get('tbl_admin')->result_array();
    }
    public function get_employee_details($employee_id)
    {
        // Example query to fetch employee details from database
        $query = $this->db->get_where('tbl_admin', array('id' => $employee_id));
        return $query->row_array(); // Return employee details as an array
    }
    public function update_employee($employee_id, $data)
    {
        $this->db->where('id', $employee_id);
        return $this->db->update('tbl_admin', $data);
    }

    public function delete_employee($employee_id)
    {
        // Perform deletion logic here
        $this->db->where('id', $employee_id);
        $this->db->delete('tbl_admin');

        // Check if deletion was successful
        if ($this->db->affected_rows() > 0) {
            return true; // Return true if deletion is successful
        } else {
            return false; // Return false if deletion failed
        }
    }
    public function get_employees_by_manager($manager_id)
{
    $this->db->where('manager_id', $manager_id);
    $query = $this->db->get('tbl_admin');
    return $query->result_array();
}

public function create_feedback($data)
{
    return $this->db->insert('tbl_feedback', $data);
}

}
?>
