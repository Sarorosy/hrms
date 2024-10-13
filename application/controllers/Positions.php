<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Positions extends CI_Controller {

    public $Dashboard_model, $Positions_model, $session, $form_validation, $agent;

    public function __construct() {
        parent::__construct();
        $this->load->model('Positions_model');
    }

    // List all positions
    public function index() {
        $data['positions'] = $this->Positions_model->get_all_positions();
        $data['main_content'] = 'admin/positions_view';
        $this->load->view('template', $data);
    }

    // Create a new position
    public function create_position() {
        $this->form_validation->set_rules('name', 'Position Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create_position_form();
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            $this->Positions_model->insert_position($data);
            $this->session->set_flashdata('success', 'Position created successfully.');
            redirect('Positions');
        }
    }

    // Load create position form
    public function create_position_form() {
        $data['main_content'] = 'admin/create_position';
        $this->load->view('template', $data);
    }

    // Edit a position
    public function edit_position($id) {
        $data['position'] = $this->Positions_model->get_position_by_id($id);
        $data['main_content'] = 'admin/edit_position';
        $this->load->view('template', $data);
    }

    // Update a position
    public function update_position($id) {
        $this->form_validation->set_rules('name', 'Position Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit_position($id);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            $this->Positions_model->update_position($id, $data);
            $this->session->set_flashdata('success', 'Position updated successfully.');
            redirect('Positions');
        }
    }

    // Delete a position
    public function delete_position($id) {
        $this->Positions_model->delete_position($id);
        $this->session->set_flashdata('success', 'Position deleted successfully.');
        redirect('Positions');
    }
}
?>
