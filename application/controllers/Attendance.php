<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {
    public $Attendance_model, $Admin_model, $Dashboard_model , $session, $form_validation, $agent;

    public function __construct() {
        parent::__construct();
        $this->load->model('Attendance_model');
        $this->load->model('Admin_model'); // Load the Admin_model to handle tbl_admin
        $this->load->database();
        
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['title'] = 'Attendance';
        $data['attendance'] = $this->Attendance_model->get_attendance($user_id);
        $data['user'] = $this->Admin_model->get_user($user_id); // Fetch the user data
        $user_attendance = $this->Attendance_model->check_user_attendance($user_id);
        $data['user_attendance'] = $user_attendance;
        $data['holidays'] = $this->Attendance_model->get_holidays();
        $data['main_content'] = 'attendance_view';
        $this->load->view('template', $data);
    }

    public function mark_login() {
        $user_id = $this->session->userdata('user_id');
        $result = $this->Attendance_model->mark_login($user_id);
        
        if ($result === true) {
            // Update attendance status in session
            $this->Admin_model->update_attendance_status($user_id, true); // Mark attendance as true
            $this->session->set_flashdata('success', 'Login marked successfully.');
        } else {
            $this->session->set_flashdata('error', $result);
        }
    
        redirect(base_url('Attendance')); // Reload page to reflect the change
    }
    
    public function mark_logout() {
        $user_id = $this->session->userdata('user_id');
        $result = $this->Attendance_model->mark_logout($user_id);
        
        if ($result === true) {
            // Update attendance status in session
            $this->Admin_model->update_attendance_status($user_id, false); // Mark attendance as false
            $this->session->set_flashdata('success', 'Logout marked successfully.');
        } else {
            $this->session->set_flashdata('error', $result);
        }
    
        redirect(base_url('Attendance')); // Reload page to reflect the change
    }
    public function save_work_details() {
        $input = json_decode(file_get_contents('php://input'), true);
        $date = $input['date'];
        $user_id = $input['user_id'];
        $work_details = $input['work_details'];
    
        // Prepare data for insertion
        $data = [
            'date' => $date,
            'user_id' => $user_id,
            'work_details' => $work_details,
        ];
    
        // Insert into tbl_work_details
        if ($this->db->insert('tbl_work_details', $data)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
    
}
?>
