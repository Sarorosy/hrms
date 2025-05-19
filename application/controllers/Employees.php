<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Employees extends CI_Controller {

    public $Employees_model, $session, $form_validation,$Dashboard_model, $agent, $Feedback_model, $Positions_model;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employees_model');
        $this->load->model('Positions_model');
        $this->load->model('Feedback_model');
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
        $employee_id = base64_decode($employee_id);
        $employee = $this->Employees_model->get_employee_details($employee_id);
        if(!$employee){
            $this->session->set_flashdata('error', 'no employee found!');
            redirect($this->agent->referrer()); 
        }
        // Fetch employee details from database
        $data['employee'] = $employee;
        $all_feedback = $this->Feedback_model->get_feedback_by_id($employee_id);
        $data['feedback'] = !empty($all_feedback) ? $all_feedback[0] : null; 
        // Load view with template
        $data['main_content'] = 'admin/view_employee'; // Assuming view file is view_employee.php
        $this->load->view('template', $data);
    }
    public function view_all_feedback($employee_id)
{
    $data['employee'] = $this->Employees_model->get_employee_details($employee_id);
    $data['feedback'] = $this->Feedback_model->get_feedback_by_id($employee_id); // Get all feedback
    $data['main_content'] = 'admin/all_feedback'; // Assuming the view file is all_feedback.php
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
        $employee_id = base64_decode($employee_id);
        
        $data['admins'] = $this->Employees_model->get_admins();
        // Fetch employee details from database
        $data['employee'] = $this->Employees_model->get_employee_details($employee_id);
        $data['positions'] = $this->Positions_model->get_all_positions();
        $data['departments'] = $this->Employees_model->get_departments();
        // Load view with template
        $data['main_content'] = 'admin/edit_employee'; // Assuming view file is edit_employee.php
        $this->load->view('template', $data);
    }

    public function update_employee($employee_id)
    {
        // Validate form input
        $this->form_validation->set_rules('name', 'Name', '');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('status', 'Status', '');
        $this->form_validation->set_rules('role', 'Role', '');
        $this->form_validation->set_rules('age', 'Age', 'integer');
        $this->form_validation->set_rules('dob', 'Date of Birth', '');
        $this->form_validation->set_rules('gender', 'Gender', '');
        $this->form_validation->set_rules('personal_email', 'Personal Email', 'valid_email');
        $this->form_validation->set_rules('marital_status', 'Marital Status', '');
        $this->form_validation->set_rules('address', 'Address', '');
        $this->form_validation->set_rules('family_details', 'Family Details');

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
                'age' => $this->input->post('age'),
                'dob' => $this->input->post('dob'),
                'gender' => $this->input->post('gender'),
                'personal_email' => $this->input->post('personal_email'),
                'marital_status' => $this->input->post('marital_status'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'address3' => $this->input->post('address3'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zip_code' => $this->input->post('zip_code'),
                'father_name' => $this->input->post('father_name'),
                'mother_name' => $this->input->post('mother_name'),
                'spouse_name' => $this->input->post('spouse_name'),
                'son_count' => $this->input->post('son_count'),
                'daughter_count' => $this->input->post('daughter_count'),
                'aadharno' => $this->input->post('aadharno'),
                'pancard' => $this->input->post('pancard'),
                'bankname' => $this->input->post('bankname'),
                'branch' => $this->input->post('branch'),
                'account_no' => $this->input->post('account_no'),
                'ifsc_code' => $this->input->post('ifsc_code'),
                'uanno' => $this->input->post('uanno'),
                'esic' => $this->input->post('esic'),
                'position' => $this->input->post('position'),
                'department_id' => $this->input->post('department'),
                'ctc' => $this->input->post('ctc'),
                'joining_date' => $this->input->post('joining_date'),
                'employment_type' => $this->input->post('employment_type'),
                'manager_id' => $this->input->post('manager_id'),
                'phone_number' => $this->input->post('phone_number'),
                'blood_group' => $this->input->post('blood_group'),
            );

            // Handle file uploads
            if (!empty($_FILES['passport_photo']['name'])) {
                $passport_photo = $this->upload_file('passport_photo');
                if ($passport_photo) {
                    $update_data['passport_photo'] = $passport_photo;
                }
            }
            // Handle file uploads
            if (!empty($_FILES['profile_pic']['name'])) {
                $profilepic = $this->upload_file('profile_pic');
                if ($profilepic) {
                    $update_data['profile_pic'] = $profilepic;
                }
            }

            if (!empty($_FILES['aadhar']['name'])) {
                $aadhar_card = $this->upload_file('aadhar');
                if ($aadhar_card) {
                    $update_data['aadhar'] = $aadhar_card;
                }
            }
            if (!empty($_FILES['degree']['name'])) {
                $degree = $this->upload_file('degree');
                if ($degree) {
                    $update_data['degree'] = $degree;
                }
            }
            if (!empty($_FILES['pg']['name'])) {
                $pg = $this->upload_file('pg');
                if ($pg) {
                    $update_data['pg'] = $pg;
                }
            }
            if (!empty($_FILES['cv']['name'])) {
                $cv = $this->upload_file('cv');
                if ($cv) {
                    $update_data['cv'] = $cv;
                }
            }

            $result = $this->Employees_model->update_employee($employee_id, $update_data);

            if ($result) {
                // Employee details updated successfully
                $this->session->set_flashdata('success', 'Employee details updated successfully.');
            } else {
                // Failed to update employee details
                $this->session->set_flashdata('error', 'Failed to update employee details. Please try again.');
            }

            // Redirect back to view employee details
            redirect(base_url('Employees/view_employee/' . base64_encode($employee_id)));
        }
    }

    // Function to load the create employee form
    public function create_employee_form()
    {
        $data['admins'] = $this->Employees_model->get_admins();
        $data['positions'] = $this->Employees_model->get_positions();
        $data['departments'] = $this->Employees_model->get_departments();
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
                'department_id' => $this->input->post('department'),
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
                $this->send_welcome_email($data['name'], $data['email'], $data['username'], $this->input->post('password'));
            } else {
                // Failed to create employee
                $this->session->set_flashdata('error', 'Failed to create employee. Please try again.');
            }

            // Redirect back to create employee form
            redirect(base_url('Employees/create_employee_form'));
        }
    }
    private function send_welcome_email($name,$email, $username, $password)
{
    $url = base_url('login');  // The login page URL

    // Prepare the email subject and body
    $subject = "Your account has been successfully created";

    $body = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                line-height: 1.6;
            }
            .email-container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #f9f9f9;
            }
            h1 {
                color: #000034;
                text-align: center;
            }
            p {
                font-size: 16px;
            }
            .credentials-list {
                margin-top: 10px;
                padding-left: 20px;
            }
            .credentials-list li {
                font-size: 14px;
            }
            .footer {
                text-align: center;
                font-size: 14px;
                margin-top: 20px;
            }
            img {
                width: 50px;
                height: auto;
            }
            .cta {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #000034;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                text-align: center;
            }
            .cta:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <h1 style='display:flex;align-items-center;'> <img src='https://ryupunch.com/vda/assets/images/vda-logo.png' alt='Employee Logo' style='margin-right:7px;'> EMPLOYEE</h1>
            <p>Dear $username,</p>
            <p>Your account has been successfully created. Welcome to Employee!</p>
            <p>Here are your login credentials:</p>
            <ul class='credentials-list'>
                <li><strong>Username:</strong> $username</li>
                <li><strong>Password:</strong> $password</li>
            </ul>
            <p>You can login using the link below:</p>
            <a href='$url' class='cta'>Login to your account</a>
            <div class='footer'>
                <p>Best regards,<br>Employee</p>
                
            </div>
        </div>
    </body>
    </html>
    ";

    // Data to post to the Email/send endpoint
    $data = array(
        'to' => $email,
        'subject' => $subject,
        'body' => $body
    );

    // Send POST request to Email/send
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, base_url('Email/send'));  // Assuming the endpoint is '/Email/send'
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    // Handle response (optional)
    if ($response) {
        // Email sent successfully
    } else {
        // Email sending failed, log the error if needed
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
public function give_rewards($employee_id)
{
    // Check if the form is submitted via POST
    if ($this->input->method() === 'post') {
        $subject = $this->input->post('subject');
        $description = $this->input->post('description');

        // Handle image upload
        $image_path = $this->handle_file_uploads('image', './uploads/rewardsimages/', 'jpg|png|jpeg|webp|jfif', 4096);

        if ($image_path) {
            //print_r("Image uploaded successfully: " . $image_path . "<br>");
        } else {
            //print_r("Image upload failed.<br>");
        }
        
        // Insert reward into the tbl_rewards
        $reward_data = array(
            'employee_id' => $employee_id,
            'subject' => $subject,
            'description' => $description,
            'image' => $image_path,
            'created_at' => date('Y-m-d H:i:s')
        );
        
        if ($this->db->insert('tbl_rewards', $reward_data)) {
            //print_r("Reward inserted successfully.<br>");
        } else {
            //print_r("Failed to insert reward: " . $this->db->last_query() . "<br>");
        }
        
        // Prepare notification data
        $notification_data = array(
            'user_id' => $employee_id,
            'message' => "You have been rewarded, check the rewards section.",
            'read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'title' => "REWARDS"
        );
        
        if ($this->db->insert('tbl_notifications', $notification_data)) {
           // print_r("Notification inserted successfully.<br>");
        } else {
          //  print_r("Failed to insert notification: " . $this->db->last_query() . "<br>");
        }
        
        // Redirect with a success message
        $this->session->set_flashdata('message', 'Reward has been successfully sent.');
        redirect(base_url('Employees/view_employee/' . $employee_id));
    }

    // Load the form for giving rewards
    $data['employee_id'] = $employee_id;
    $data['employee'] = $this->Employees_model->get_employee_details($employee_id);
    $data['main_content'] = 'admin/give_rewards';
    $this->load->view('template', $data);
}

private function handle_file_uploads($file_input_name, $upload_path, $allowed_types, $max_size)
{
    // Configure file upload settings
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = $allowed_types;
    $config['max_size'] = $max_size; 
    $config['encrypt_name'] = TRUE; // Encrypt filename for security

    $this->load->library('upload', $config);

   // Check if a file is uploaded
    if (!empty($_FILES[$file_input_name]['name'])) {
        if ($this->upload->do_upload($file_input_name)) {
            $upload_data = $this->upload->data();
            $filename = $upload_data['file_name'];
            return $filename; // Return only the filename
        } else {
            // Handle upload failure and log error
            $upload_error = $this->upload->display_errors();
            log_message('error', ucfirst($file_input_name) . ' Upload Error: ' . $upload_error);
            $this->session->set_flashdata('error', 'Failed to upload ' . $file_input_name . ': ' . $upload_error);
            return null;
        }
    } else {
        // No file uploaded
        return null;
    }
}
public function rewards()
{
    // Get the current user's ID from the session
    $user_id = $this->session->userdata('user_id');

    // Fetch the rewards for the user directly in the controller
    $this->db->where('employee_id', $user_id);
    $this->db->limit(8); // Limit to the last 8 rewards
    $query = $this->db->get('tbl_rewards');

    // Check if rewards are found and store in the data array
    $data['rewards'] = $query->result_array();

    // Load the view for displaying rewards
    $data['main_content'] = 'rewards'; // Adjust the view path as needed
    $this->load->view('template', $data);
}





}
?>
