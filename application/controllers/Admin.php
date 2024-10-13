<?php 

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load necessary models and libraries
        $this->load->model('Admin_model');
        $this->load->helper('form');
    }
    public function index(){
        redirect(base_url());
    }

    public function create_notice_form() {
        // Set main content to load in the template
        $data['notices'] = $this->Admin_model->get_all_notices(); 
        $data['main_content'] = 'admin/create_notice';
        // Load the template with the specified content
        $this->load->view('template', $data);
    }

    public function save_notice() {
        // Validate form submission
        $this->form_validation->set_rules('notice', 'Notice', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/create_notice_form'); // Redirect to create notice form
        } else {
            // Validation passed, insert notice into database
            $notice_content = $this->input->post('notice');
            $data = array(
                'notice' => $notice_content
            );

            $result = $this->Admin_model->insert_notice($data);

            if ($result) {
                // Notice inserted successfully
                $this->session->set_flashdata('success', 'Notice created successfully.');
            } else {
                // Error inserting notice
                $this->session->set_flashdata('error', 'Failed to create notice. Please try again.');
            }

            redirect(base_url('Admin/create_notice_form')); // Redirect to create notice form
        }
    }
    public function create_event_form() {
        // Load the create event form view
        $data['main_content'] = 'admin/create_event';
        $this->load->view('template', $data);
    }
    public function save_event() {
        // Set validation rules
        $this->form_validation->set_rules('name', 'Event Name', 'required');
        $this->form_validation->set_rules('date', 'Event Date', 'required');
        $this->form_validation->set_rules('event_description', 'Event Description', 'required');
        $this->form_validation->set_rules('time_start', 'Start Time', 'required');
        $this->form_validation->set_rules('time_end', 'End Time', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the form with validation errors
            $this->create_event_form();
        } else {
            // Validation passed, insert event into database
            $event_data = array(
                'name' => $this->input->post('name'),
                'date' => $this->input->post('date'),
                'event_description' => $this->input->post('event_description'),
                'time_range' => $this->input->post('time_start') . ' - ' . $this->input->post('time_end'),
                'created_by' => $this->session->userdata('username'), // Assuming you have username in session data
                'created_at' => date('Y-m-d H:i:s') // Set the current timestamp
            );
    
            $result = $this->Admin_model->insert_event($event_data);
    
            if ($result) {
                // Event inserted successfully
                $this->session->set_flashdata('success', 'Event created successfully.');
            } else {
                // Error inserting event
                $this->session->set_flashdata('error', 'Failed to create event. Please try again.');
            }
    
            redirect(base_url('Admin/create_event_form')); // Redirect to create event form
        }
    }
    
    public function view_notice($notice_id)
    {

        // Fetch the notice details based on $notice_id
        $data['notice'] = $this->Admin_model->get_notice($notice_id);

        $data['main_content'] = 'admin/view_notice';
        $this->load->view('template', $data);
    }
    public function edit_notice($notice_id)
    {

        // Fetch the notice details based on $notice_id
        $data['notice'] = $this->Admin_model->get_notice($notice_id);

        $data['main_content'] = 'admin/edit_notice';
        $this->load->view('template', $data);
    }

    // Function to update the notice after form submission
    public function update_notice($notice_id)
    {
        // Load form validation library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('notice', 'Notice', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            // Validation failed, reload edit form with validation errors
            $this->load->view('admin/edit_notice', array('notice_id' => $notice_id));
        }
        else
        {
            $updated_data = array(
                'notice' => $this->input->post('notice')
            );
            $result = $this->Admin_model->update_notice($notice_id, $updated_data);

            if ($result) {
                // Success: redirect with success message
                $this->session->set_flashdata('success', 'Notice updated successfully.');
                redirect(base_url('admin/view_notice/' . $notice_id));
            } else {
                // Error: redirect with error message
                $this->session->set_flashdata('error', 'Failed to update notice.');
                redirect(base_url('admin/edit_notice/' . $notice_id));
            }
        }
    }

    public function delete_notice($notice_id)
    {
        if ($this->Admin_model->delete_notice($notice_id)) {
            $this->session->set_flashdata('success', 'Notice deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete notice.');
        }

        redirect(base_url('admin/create_notice_form'));
    }
    public function create(){
        $data['main_content'] = 'admin/create_page';
        $this->load->view('template', $data);
    }

    public function create_holiday_form()
    {
        $data['main_content'] = 'admin/create_holiday';
        $this->load->view('template',$data); // Create a view for adding holidays
    }

    public function save_holiday()
    {
        // Load form validation library
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('holiday_title', 'Holiday Title', 'required');
        $this->form_validation->set_rules('holiday_date', 'Holiday Date', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            // Validation failed, reload the form with validation errors
            redirect(base_url('Admin/create_holiday_form'));
        }
        else
        {
            // Prepare data to be inserted
            $holiday_data = array(
                'title' => $this->input->post('holiday_title'),
                'holiday_date' => $this->input->post('holiday_date')
            );

            // Save data to the database
            $this->Admin_model->insert_holiday($holiday_data);

            // Set success message
            $this->session->set_flashdata('success', 'Holiday added successfully.');

            // Redirect to the dashboard or any other appropriate page
            redirect(base_url('Admin/create'));
        }
    }
}

?>