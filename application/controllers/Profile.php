<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public $Dashboard_model, $Profile_model,$session, $form_validation, $agent;

    public function __construct() {
        parent::__construct();
        // Load necessary models and libraries
        $this->load->model('Profile_model');
        $this->load->library('session');
    }

    public function index() {
        // Assuming you have a method to get the current logged-in user's ID
        $user_id = $this->session->userdata('user_id');
    
        // Load the profile data for the current user
        $data['title'] = 'Profile';
        $data['user'] = $this->Profile_model->get_profile($user_id);
        if (!empty($data['user']['education'])) {
            $data['user']['education'] = json_decode($data['user']['education'], true);
        }
        $data['main_content'] = 'profile_view';
        $this->load->view('template', $data);
    }

    public function save_profile() {
        // Validate input data
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required|integer');
        // Add more validation rules as needed

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, set error message and reload the form with validation errors
            $this->session->set_flashdata('error', validation_errors());
            $this->index();
        } else {
            // Validation passed, process and save profile data
            $user_id = $this->session->userdata('user_id');

            $education_data = json_encode([
                'qualification1' => $this->input->post('qualification1'),
                'college1' => $this->input->post('college1'),
                'year1' => $this->input->post('year1'),
                'qualification2' => $this->input->post('qualification2'), // Optional
                'college2' => $this->input->post('college2'), // Optional
                'year2' => $this->input->post('year2') // Optional
            ]);
            $profile_data = array(
                'name' => $this->input->post('name'),
                'age' => $this->input->post('age'),
                'dob' => $this->input->post('dob'),
                'phone_number' => $this->input->post('phone_number'),
                'blood_group' => $this->input->post('blood_group'),
                'nationality' => $this->input->post('nationality'),
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
                'spouse_name' => $this->input->post('spouse_name'),
                'mother_name' => $this->input->post('mother_name'),
                'son_count' => $this->input->post('son_count'),
                'daughter_count' => $this->input->post('daughter_count'),
                'education' => $education_data
            );

            // Save profile data to database
            $this->Profile_model->save_profile($user_id, $profile_data);

            // Handle file uploads
            $this->handle_file_uploads($user_id);

            // Set success message and redirect to profile view
            $this->session->set_flashdata('success', 'Profile updated successfully.');
            redirect('profile');
        }
    }

    private function handle_file_uploads($user_id) {
        // Configure file upload settings
        $config['upload_path'] = './uploads/userdetailuploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf'; // Adjust allowed file types as needed
        $config['max_size'] = 2048; // Max size in KB
        $config['encrypt_name'] = TRUE; // Encrypt filename for security

        $this->load->library('upload', $config);

        // Upload Passport Photo
        if (!empty($_FILES['passport_photo']['name'])) {
            if ($this->upload->do_upload('passport_photo')) {
                $upload_error = $this->upload->display_errors();
                log_message('error', 'Passport Photo Upload Error: ' . $upload_error);

                $upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
                // Save filename to database
                $this->Profile_model->update_file($user_id, 'passport_photo', $filename);
            } else {
                // Handle upload failure
                $upload_error = $this->upload->display_errors();
                log_message('error', 'Passport Photo Upload Error: ' . $upload_error);
                $this->session->set_flashdata('error', 'Failed to upload passport photo: ' . $upload_error);
            }
        }
        // Upload Profile picture
        if (!empty($_FILES['profile_pic']['name'])) {
            if ($this->upload->do_upload('profile_pic')) {
                $upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
                // Save filename to database
                $this->Profile_model->update_file($user_id, 'profile_pic', $filename);
            } else {
                // Handle upload failure
                $upload_error = $this->upload->display_errors();
                log_message('error', 'profile Photo Upload Error: ' . $upload_error);
                $this->session->set_flashdata('error', 'Failed to upload profile photo: ' . $upload_error);
            }
        }

        // Repeat similar logic for other file uploads (aadhar, 10th_marksheet, etc.)
        $files = ['aadhar', '10th_marksheet', 'degree_certificate', 'pg_certificate', 'cv'];
        foreach ($files as $file) {
            if (!empty($_FILES[$file]['name'])) {
                if ($this->upload->do_upload($file)) {
                    $upload_data = $this->upload->data();
                    $filename = $upload_data['file_name'];
                    // Save filename to database
                    $this->Profile_model->update_file($user_id, $file, $filename);
                } else {
                    // Handle upload failure
                    $upload_error = $this->upload->display_errors();
                    log_message('error', ucfirst($file) . ' Upload Error: ' . $upload_error);
                    $this->session->set_flashdata('error', 'Failed to upload ' . $file . ': ' . $upload_error);
                }
            }
        }
    }

    public function reset_password() {
        // Validate form submission
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile'); // Redirect to profile page or wherever appropriate
        } else {
            // Validation passed, update password
            $new_password = $this->input->post('new_password');
            $user_id = $this->session->userdata('user_id'); // Assuming user_id is stored in session

            $result = $this->Profile_model->update_password($user_id, $new_password);

            if ($result) {
                // Password updated successfully
                $this->session->set_flashdata('success', 'Password updated successfully.');
            } else {
                // Error updating password
                $this->session->set_flashdata('error', 'Failed to update password. Please try again.');
            }

            redirect('profile'); // Redirect to profile page or wherever appropriate
        }
}

}
?>
