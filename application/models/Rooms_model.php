<?php
class Rooms_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_room($data) {
        return $this->db->insert('tbl_rooms', $data);
    }
    public function get_all_rooms() {
        $query = $this->db->get('tbl_rooms');
        return $query->result();
    }
    // Method to check if a time slot is available
    public function is_time_slot_available($room_id, $start_time, $end_time) {
        $this->db->where('room_id', $room_id);
        $this->db->where('start_time <', $end_time);
        $this->db->where('end_time >', $start_time);
        $query = $this->db->get('tbl_room_bookings');

        return $query->num_rows() == 0;
    }
    public function get_future_bookings() {
        $this->db->select('tbl_room_bookings.*, tbl_rooms.room_name, tbl_rooms.room_img');
        $this->db->from('tbl_room_bookings');
        $this->db->join('tbl_rooms', 'tbl_room_bookings.room_id = tbl_rooms.room_id');
        $this->db->where('start_time >', date('Y-m-d H:i:s'));
        $query = $this->db->get();
        return $query->result();
    }
    
    public function insert_booking($data) {
        return $this->db->insert('tbl_room_bookings', $data);
    }
    public function get_room_by_id($room_id) {
        $this->db->where('room_id', $room_id);
        $query = $this->db->get('tbl_rooms');
        return $query->row_array();
    }

    // Delete room by ID
    public function delete_room($room_id) {
        // Delete all bookings for this room
        $this->db->where('room_id', $room_id);
        $this->db->delete('tbl_room_bookings');
        
        // Now delete the room
        $this->db->where('room_id', $room_id);
        return $this->db->delete('tbl_rooms');
    }
    
}
