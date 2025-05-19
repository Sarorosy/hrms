<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

    public $Dashboard_model, $Departments_model, $session, $form_validation, $agent;

    public function __construct() {
        parent::__construct();
        $this->load->model('Departments_model');
    }

    // List all departments
    public function index() {
        $data['departments'] = $this->Departments_model->get_all_departments();
        $data['main_content'] = 'admin/departments_view';
        $this->load->view('template', $data);
    }

    // Create a new department
    public function create_department() {
        $this->form_validation->set_rules('name', 'Department Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->create_department_form();
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            $this->Departments_model->insert_department($data);
            $this->session->set_flashdata('success', 'Department created successfully.');
            redirect('Departments');
        }
    }

    // Load create department form
    public function create_department_form() {
        $data['main_content'] = 'admin/create_department';
        $this->load->view('template', $data);
    }

    // Edit a department
    public function edit_department($id) {
        $data['department'] = $this->Departments_model->get_department_by_id($id);
        $data['main_content'] = 'admin/edit_department';
        $this->load->view('template', $data);
    }

    // Update a department
    public function update_department($id) {
        $this->form_validation->set_rules('name', 'Department Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit_department($id);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );

            $this->Departments_model->update_department($id, $data);
            $this->session->set_flashdata('success', 'Department updated successfully.');
            redirect('Departments');
        }
    }

    // Delete a department
    public function delete_department($id) {
        $this->Departments_model->delete_department($id);
        $this->session->set_flashdata('success', 'Department deleted successfully.');
        redirect('Departments');
    }
}
?>
