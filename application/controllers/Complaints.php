<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaints extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Complaints_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['main_content'] = 'complaint_view';
        $this->load->view('template',$data);
    }

    public function submit_complaint() {
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('user_type', 'User Type', 'required');
        $this->form_validation->set_rules('happened_at', 'Incident Date', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('complaint_view');
        } else {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'user_type' => $this->input->post('user_type'),
                'happened_at' => $this->input->post('happened_at')
            );

            $this->Complaints_model->insert_complaint($data);
            $this->session->set_flashdata('success', 'Your complaint has been submitted successfully.');
            redirect(base_url('complaints'));
        }
    }
    
    public function all_complaints_view() {
         // Get search and filter inputs
    $search = $this->input->get('search');
    $user_id = $this->input->get('user_id');
    $subject = $this->input->get('subject');
    $start_date = $this->input->get('start_date');
    $end_date = $this->input->get('end_date');

        // Get complaints with filters
        $data['complaints'] = $this->Complaints_model->get_complaints($search, $user_id, $subject, $start_date, $end_date);
        $data['main_content']='admin/all_complaints_view';
        $this->load->view('template', $data);
    }
    public function filter_complaints() {
        $search = $this->input->get('search');
        $user_id = $this->input->get('user_id');
        $subject = $this->input->get('subject');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
    
        // Fetch filtered complaints
        $data['complaints'] = $this->Complaints_model->get_complaints($search, $user_id, $subject, $start_date, $end_date);
    
        // Load the table HTML
        $this->load->view('admin/complaints_table', $data);
    }
    public function take_action($complaint_id) {
        $action = $this->input->post('action');
        $admin_id = $this->session->userdata('admin_id');
    
        // Update complaint action and get the user_id
        $user_id = $this->Complaints_model->update_complaint_action($complaint_id, $action, $admin_id);
    
        // Insert notification for the user
        $this->Complaints_model->insert_notification($user_id, $action);
    
        $this->session->set_flashdata('success', 'Action taken successfully.');
        redirect('complaints/all_complaints_view');
    }
    
}
?>
