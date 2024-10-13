<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_all_messages($user_id) {
        $this->db->select('m.*, a.name AS sender_name'); // Select message fields and the admin name
        $this->db->from('tbl_messages m');
        $this->db->join('tbl_admin a', 'm.sender_id = a.id', 'left'); // Join with tbl_admin
        $this->db->where('m.user_id', $user_id); // Filter by user_id
        $this->db->order_by('m.created_at', 'DESC'); // Order by created_at in descending order
        $query = $this->db->get();
    
        return $query->result(); // Return result as an array of objects
    }
    
    public function mark_message_as_read($message_id) {
        $this->db->set('read', "1");
        $this->db->where('id', $message_id);
        return $this->db->update('tbl_messages'); // Adjust the table name if necessary
    }
        
    
}
