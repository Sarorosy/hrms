<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manageleave extends CI_Controller {
    public $session, $form_validation, $Manageleave_model, $agent, $Dashboard_model;

    public function __construct() {
        parent::__construct();
        $this->load->model('Manageleave_model');
    }

    public function index(){
        redirect(base_url('Manageleave/apply_leave'));
    }
    public function apply_leave() {
        $this->form_validation->set_rules('leave_reason', 'Leave Reason', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['main_content'] = 'apply_leave';
            $this->load->view('template',$data);
        } else {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'leave_reason' => $this->input->post('leave_reason'),
                'status' => 'Pending',
                'leave_type_duration' =>$this->input->post('leave_type_duration'),
                'leave_type' =>$this->input->post('leave_type_select'),
                'leave_pay_type' =>$this->input->post('leave_pay_type_select'),
                'start_date' =>$this->input->post('start_date'),
                'end_date' =>$this->input->post('end_date'),
            );

            if ($this->Manageleave_model->apply_leave($data)) {
                $this->session->set_flashdata('success', 'Leave request submitted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to submit leave request.');
            }

            redirect(base_url('Manageleave/apply_leave'));
        }
    }

    public function leave_summary() {
        $data['leaves'] = $this->Manageleave_model->get_leaves($this->session->userdata('user_id'));
        $data['main_content'] = 'leave_summary';
        $this->load->view('template', $data);
    }

     // View Leave Requests
     public function view_leave_request() {
        // Perform authorization check here to ensure only SUPERADMIN can view

        // Fetch leave requests
        $data['leaves'] = $this->Manageleave_model->get_leave_requests();
        $data['main_content'] = 'admin/view_leave_request';
        $this->load->view('template', $data);
    }

    // Approve Leave Request
    public function approve_leave($leave_id) {
        // Perform authorization check here to ensure only SUPERADMIN can approve
        
        // Update leave status to Approved
        $this->Manageleave_model->update_leave_status($leave_id, 'Approved');

        // Redirect or show success message
        redirect(base_url('Manageleave/view_leave_request'));
    }

    // Reject Leave Request
    public function reject_leave($leave_id) {
        // Display reject reason form popup
        $data['leave_id'] = $leave_id;
        $data['main_content']='admin/reject_reason_form';
        $this->load->view('template', $data);
    }

    // Process Reject Leave Request
    public function process_reject_leave() {
        $leave_id = $this->input->post('leave_id');
        $reject_reason = $this->input->post('reject_reason');

        // Update leave status to Rejected and insert reject reason
        $this->Manageleave_model->reject_leave_request($leave_id, $reject_reason);

        // Redirect or show success message
        redirect(base_url('Manageleave/view_leave_request'));
    }
}
