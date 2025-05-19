<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Display all notes for the logged-in user
public function index() {
    $user_id = $this->session->userdata('user_id'); // Get logged-in user's ID

    // Fetch all notes where employee_id matches the current user's ID
    $this->db->where('employee_id', $user_id);
    $data['notes'] = $this->db->get('tbl_notes')->result_array();

    $data['main_content'] = 'notes/index';
    $this->load->view('template', $data);
}


    // Insert a new note
    public function add() {
        if ($this->input->post()) {
            $data = [
                'employee_id' => $this->input->post('employee_id'),
                'name'        => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'status'      => 'pending',
                'remind'      => $this->input->post('remind'),
                'datetime'    => $this->input->post('datetime')
            ];
            $this->db->insert('tbl_notes', $data);
            redirect('notes');
        } else {
            $data['main_content'] = 'notes/add';
            $this->load->view('template', $data);
        }
    }

    // Edit an existing note
    public function edit($id) {
        $id = base64_decode($id);
        if ($this->input->post()) {
            $data = [
                'name'        => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'remind'      => $this->input->post('remind'),
                'datetime'    => $this->input->post('datetime')
            ];
            $this->db->where('id', $id);
            $this->db->update('tbl_notes', $data);
            redirect('notes');
        } else {
            $data['main_content'] = 'notes/edit';
            $data['note'] = $this->db->get_where('tbl_notes', ['id' => $id])->row_array(); // Fetch note by id
            $this->load->view('template', $data);
        }
    }

    // Delete a note
    public function delete($id) {
         $id = base64_decode($id);
        $this->db->where('id', $id);
        $this->db->delete('tbl_notes');
        redirect('notes');
    }

    // Mark a note as completed
    public function mark_as_completed($id) {
         $id = base64_decode($id);
        $data = ['status' => 'completed'];
        $this->db->where('id', $id);
        $this->db->update('tbl_notes', $data);
        redirect('notes');
    }
}
