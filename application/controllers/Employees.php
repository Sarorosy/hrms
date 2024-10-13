<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Employees extends CI_Controller {

    public $Employees_model, $session, $form_validation,$Dashboard_model, $agent;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employees_model');
        $this->load->library('user_agent');
    }

    public function index()
    {
        $data['employees'] = $this->Employees_model->get_all_employees();
        $data['main_content'] = 'admin/employees_view';
        $this->load->view('template', $data);
    }
    public function view_employee($employee_id)
    {
        // Fetch employee details from database
        $data['employee'] = $this->Employees_model->get_employee_details($employee_id);

        // Load view with template
        $data['main_content'] = 'admin/view_employee'; // Assuming view file is view_employee.php
        $this->load->view('template', $data);
    }
    public function send_message() {
        $user_id = $this->input->post('user_id'); // Get user ID
        $message = $this->input->post('message'); // Get message content
        $sender_id = $this->input->post('sender_id');
    
        $data = array(
            'user_id' => $user_id,
            'message' => $message,
            'sender_id' => $sender_id,
            'created_at' => date('Y-m-d H:i:s')
        );
    
        $this->db->insert('tbl_messages', $data); // Insert into the messages table
    
        // Optionally, you can set a flash message and redirect
        $this->session->set_flashdata('message', 'Message sent successfully!');
        redirect($this->agent->referrer()); 
    }
    

    public function edit_employee($employee_id)
    {
        $data['admins'] = $this->Employees_model->get_admins();
        // Fetch employee details from database
        $data['employee'] = $this->Employees_model->get_employee_details($employee_id);

        // Load view with template
        $data['main_content'] = 'admin/edit_employee'; // Assuming view file is edit_employee.php
        $this->load->view('template', $data);
    }

    public function update_employee($employee_id)
    {
        // Validate form input (you can add more validation rules as needed)
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('manager_id', 'Manager', 'required');

        if ($this->form_validation->run() == false) {
            // Form validation failed, reload the edit form with validation errors
            $this->edit_employee($employee_id);
        } else {
            // Form validation passed, update employee details in the database
            $update_data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'role' => $this->input->post('role'),
                'manager_id' => $this->input->post('manager_id')
            );

            $result = $this->Employees_model->update_employee($employee_id, $update_data);

            if ($result) {
                // Employee details updated successfully
                $this->session->set_flashdata('success', 'Employee details updated successfully.');
            } else {
                // Failed to update employee details
                $this->session->set_flashdata('error', 'Failed to update employee details. Please try again.');
            }

            // Redirect back to view employee details
            redirect(base_url('Employees/view_employee/'.$employee_id));
        }
    }

    // Function to load the create employee form
    public function create_employee_form()
    {
        $data['admins'] = $this->Employees_model->get_admins();
        $data['positions'] = $this->Employees_model->get_positions();
        // Load view with template
        $data['main_content'] = 'admin/create_employee'; // Assuming view file is create_employee.php
        $this->load->view('template', $data);
    }

    // Function to handle form submission and create employee
    public function create_employee()
    {
        // Form validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_admin.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[USER,ADMIN,SUPERADMIN,HR]');
        $this->form_validation->set_rules('manager_id', 'Manager', 'required');
        $this->form_validation->set_rules('ctc', 'CTC', 'required|numeric');
        $this->form_validation->set_rules('joining_date', 'Joining Date', 'required');
        $this->form_validation->set_rules('employment_type', 'Employment Type', 'required|in_list[Full-time,Part-time]');

        if ($this->form_validation->run() == false) {
            // Form validation failed, reload the create form with validation errors
            $this->create_employee_form();
        } else {
            // Form validation passed, prepare data for insertion
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'), 
                'employee_id' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'pass' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'decrypt_pass' =>$this->input->post('password'),
                'role' => $this->input->post('role'),
                'position' => $this->input->post('position'),
                'manager_id' => $this->input->post('manager_id'),
                'ctc' => $this->input->post('ctc'),
                'joining_date' => $this->input->post('joining_date'),
                'employment_type' => $this->input->post('employment_type')
            );

            // Insert employee into database
            $result = $this->Employees_model->create_employee($data);

            if ($result) {
                // Employee created successfully
                $this->session->set_flashdata('success', 'Employee created successfully.');
            } else {
                // Failed to create employee
                $this->session->set_flashdata('error', 'Failed to create employee. Please try again.');
            }

            // Redirect back to create employee form
            redirect(base_url('Employees/create_employee_form'));
        }
    }

    public function delete_employee($employee_id)
    {
        // Load model
        $this->load->model('Employees_model');

        // Delete employee
        $result = $this->Employees_model->delete_employee($employee_id);

        if ($result) {
            // Success message or toast
            $this->session->set_flashdata('success', 'Employee deleted successfully.');
        } else {
            // Error message or toast
            $this->session->set_flashdata('error', 'Failed to delete employee.');
        }

        // Redirect or load view
        redirect(base_url('Employees')); 
    }
    public function view_team()
{
    $this->load->model('Employees_model');
    $data['employees'] = $this->Employees_model->get_employees_by_manager($this->session->userdata('user_id'));
    $data['main_content'] = 'admin/view_team';
    $this->load->view('template', $data);
}

public function give_feedback()
{
    // Form validation rules
    $this->form_validation->set_rules('employee_id', 'Employee', 'required');
    $this->form_validation->set_rules('productivity_rating', 'Productivity Rating', 'required|integer');
    $this->form_validation->set_rules('quality_rating', 'Quality Rating', 'required|integer');
    $this->form_validation->set_rules('punctuality_rating', 'Punctuality Rating', 'required|integer');
    $this->form_validation->set_rules('comments', 'Comments', 'required');

    if ($this->form_validation->run() == false) {
        // Form validation failed, reload the view with validation errors
        $this->view_team();
    } else {
        // Form validation passed, prepare data for insertion
        $data = array(
            'employee_id' => $this->input->post('employee_id'),
            'manager_id' => $this->session->userdata('user_id'),
            'productivity_rating' => $this->input->post('productivity_rating'),
            'quality_rating' => $this->input->post('quality_rating'),
            'punctuality_rating' => $this->input->post('punctuality_rating'),
            'comments' => $this->input->post('comments'),
            'created_at' => date('Y-m-d H:i:s')
        );

        // Insert feedback into database
        $result = $this->Employees_model->create_feedback($data);

        if ($result) {
            // Feedback created successfully
            $this->session->set_flashdata('success', 'Feedback given successfully.');
        } else {
            // Failed to give feedback
            $this->session->set_flashdata('error', 'Failed to give feedback. Please try again.');
        }

        // Redirect back to the team view
        redirect(base_url('Employees/view_team'));
    }
}


}
?>