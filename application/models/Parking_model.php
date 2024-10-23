<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parking_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_available_slots()
    {
        // Fetch only slot_id and slot_name from tbl_parking_slots
        $this->db->select('slot_id, slot_name,occupied,user_id, vehicle_type');
        return $this->db->get('tbl_parking_slots')->result_array();
    }
    public function check_pending_request($user_id, $slot_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('slot_id', $slot_id);
        $this->db->where('status', 'pending'); // Check for pending status
        $query = $this->db->get('tbl_parking_requests');
    
        // Return true if a pending request exists, otherwise false
        return $query->num_rows() > 0;
    }
    
    public function send_parking_request($data)
    {
        // Insert parking request into tbl_parking_requests
        $inserted = $this->db->insert('tbl_parking_requests', $data);

        // Return true if insert was successful, false otherwise
        return $inserted;
    }
    public function get_pending_requests($user_id)
    {
        // Fetch pending parking requests for the given user
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'pending');
        $query = $this->db->get('tbl_parking_requests');
        return $query->result_array();
    }
    public function get_all_requests()
    {
        // Fetch all parking requests
        $query = $this->db->get('tbl_parking_requests');
        return $query->result_array();
    }

    public function get_request_by_id($request_id)
    {
        // Fetch a specific parking request by ID
        $this->db->where('id', $request_id);
        $query = $this->db->get('tbl_parking_requests');
        return $query->row_array();
    }
    public function free_slot($slot_id)
    {
        $this->db->where('slot_id', $slot_id);
        return $this->db->update('tbl_parking_slots', [
            'occupied' => 0,
            'user_id' => null,
            'vehicle_type' => null
        ]);
    }
    public function insert_slot($data)
    {
        return $this->db->insert('tbl_parking_slots', $data);
    }


    public function approve_request($request_id, $slot_id, $user_id, $vehicle_type)
    {
        // Update the request status to approved
        $this->db->where('id', $request_id);
        $this->db->update('tbl_parking_requests', array('status' => 'approved'));

        // Update the parking slot to occupied and set occupied_by
        $this->db->where('slot_id', $slot_id);
        $this->db->update('tbl_parking_slots', array(
            'occupied' => 1,
            'user_id' => $user_id, // Set the user's ID who occupied the slot
            'vehicle_type' => $vehicle_type // Set the vehicle type who occupied the slot
        ));

        return $this->db->affected_rows() > 0;
    }
    public function get_user_slot($user_id)
    {
        $this->db->select('p.slot_id, p.vehicle_type, p.created_at, u.name');
        $this->db->from('tbl_parking_slots p');
        $this->db->join('tbl_admin u', 'p.user_id = u.id', 'left');
        $this->db->where('p.user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return a single row
        } else {
            return []; // Return an empty array if no data found
        }
    }
    public function get_slot_by_id($slot_id)
    {
        $this->db->select('slots.*, admin.name');
        $this->db->from('tbl_parking_slots as slots');
        $this->db->join('tbl_admin as admin', 'slots.user_id = admin.id', 'left');
        $this->db->where('slots.slot_id', $slot_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}
