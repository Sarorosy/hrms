<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($username, $password)
{
    $this->db->where('email', $username);
    $this->db->or_where('employee_id', $username);
    $this->db->where('status', 'active');
    $query = $this->db->get('tbl_admin');

    // Check if the query returned a result
    if ($query->num_rows() == 1) {
        $user = $query->row();

        // Verify the password
        if (password_verify($password, $user->pass)) {
            return $user; // Return the user object if the password matches
        } else {
            return false; // Incorrect password
        }
    } else {
        return false; // User not found or inactive
    }
}

    
}
