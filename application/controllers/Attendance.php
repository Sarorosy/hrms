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
    public function view_attendance($user_id) {
        // Load models
        $this->load->model('Attendance_model');
        $this->load->model('Admin_model');

        // Fetch attendance data for the user
        $data['attendance'] = $this->Attendance_model->get_attendance_by_user($user_id);
        $data['user'] = $this->Admin_model->get_user($user_id); // Fetch user data

        // Check if user data exists
        if (!$data['user']) {
            show_404(); // Show 404 page if user not found
        }

        // Load the view with attendance data
        $data['title'] = 'Attendance for ' . $data['user']->name; // Assuming the user model has a 'name' field
        $data['main_content'] = 'user_attendance_view'; // Adjust as per your view structure

        // Pass holidays to the view if needed
        $data['holidays'] = $this->Attendance_model->get_holidays();

        $this->load->view('template', $data);
    }

    public function view_work_details($id) {
    
        // Fetch the work details for the given user ID
        $data['work_details'] = $this->Attendance_model->get_work_details_by_user($id);
        $data['user'] = $this->Admin_model->get_user($id); // Fetch user data

        // Check if user data exists
        if (!$data['user']) {
            show_404(); // Show 404 page if user not found
        }
        $data['main_content'] = 'admin/work_details_view';
        // Load the view and pass the work details data
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
