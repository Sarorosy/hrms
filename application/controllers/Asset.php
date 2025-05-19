<?php

class Asset extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary libraries and helpers
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        // Fetch all assets from the database
        $data['assets'] = $this->db->get('tbl_assets')->result();
    
        // Get the current user's ID from session
        $userId = $this->session->userdata('user_id');
    
        // Fetch the user's asset requests
        $this->db->select('*');
        $this->db->from('tbl_asset_requests');
        $this->db->where('userid', $userId);
        $query = $this->db->get();
        $data['user_requests'] = $query->result(); // Store user requests
    
        $data['main_content'] = 'assets/index'; // Load the view for displaying assets
    
        // Load the template with the specified content
        $this->load->view('template', $data);
    }
    

    public function add_asset() {
        // Load the form for adding a new asset
        $data['main_content'] = 'assets/add_asset'; 
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


    public function save_asset() {
        // Define upload parameters
        $upload_path = './uploads/assetimages/';
        $allowed_types = 'jpg|jpeg|png|gif';
        $max_size = 2048; // 2 MB

        // Handle file upload using the helper function
        $image_url = $this->handle_file_uploads('assetimage', $upload_path, $allowed_types, $max_size);

        // Prepare asset data
        $asset_data = array(
            'assetid' => uniqid('asset_'), // Auto-generated unique asset ID
            'assetname' => $this->input->post('asset_name'),
            'assetimage' => $image_url, // Use the URL returned from the upload function
            'available' => (int)$this->input->post('available'), // Convert to integer
            'vacant' => (int)$this->input->post('vacant') // Convert to integer
        );

        // Insert asset into the database if image upload was successful
        if ($image_url) {
            $this->db->insert('tbl_assets', $asset_data);
            $this->session->set_flashdata('success', 'Asset added successfully.');
        } else {
            // Handle case where image upload failed
            $this->session->set_flashdata('error', 'Asset could not be added due to image upload failure.');
        }

        redirect(base_url('asset/add_asset')); // Redirect to add asset form
    }
    public function request_asset() {
        $data = json_decode(file_get_contents('php://input'), true);
    
        $assetId = $data['asset_id'];
        $userId = $data['user_id'];
        $status = $data['status'];
        $need_count = $data['need_count'];
    
        // Insert the request into the database
        $this->db->insert('tbl_asset_requests', [
            'assetid' => $assetId,
            'userid' => $userId,
            'status' => $status,
            'need_count' => $need_count
        ]);
    
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Could not insert request.']);
        }
    }

    public function view_requests() {
        // Check if the logged-in user is HR or SUPERADMIN
    $admin_type = $this->session->userdata('admin_type');
    if ($admin_type != 'HR' && $admin_type != 'SUPERADMIN') {
        // Set flashdata message for unauthorized access
        $this->session->set_flashdata('error', 'Unauthorized access.');
        redirect('asset/view_requests'); // Replace with your actual controller name
        return;
    }
    
    $data['users'] = $this->db->get('tbl_admin')->result();
    
    $user_id = $this->input->post('user_id');
    if ($user_id) {
        $this->db->where('userid', $user_id);
    }
        // Fetch all requests from the database
        $data['requests'] = $this->db->get('tbl_asset_requests')->result();
        
    
        // Load the template with the specified content
        $data['main_content'] = 'assets/view_requests'; // Adjust the view path as necessary
        $this->load->view('template', $data);
    }
    
    // Approve request
public function approve_request($request_id) {
    
    // Check if the logged-in user is HR or SUPERADMIN
    $admin_type = $this->session->userdata('admin_type');
    if ($admin_type != 'HR' && $admin_type != 'SUPERADMIN') {
        // Set flashdata message for unauthorized access
        $this->session->set_flashdata('error', 'Unauthorized access.');
        redirect('asset/view_requests'); // Replace with your actual controller name
        return;
    }
    // Fetch the request details
    $request = $this->db->get_where('tbl_asset_requests', ['id' => $request_id])->row();
    
    // Update asset's vacant count
    $this->db->set('vacant', 'vacant - 1', FALSE); // Decrement vacant by 1
    $this->db->where('assetid', $request->assetid);
    $this->db->update('tbl_assets');

    // Update request status to approved
    $this->db->set('status', 'approved');
    $this->db->where('id', $request_id);
    $this->db->update('tbl_asset_requests');
    
    // Send notification
    $notification_data = array(
        'user_id' => $request->userid, // Assuming `user_id` is the column in `tbl_asset_requests`
        'message' => "Your asset request has been approved.",
        'read' => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'title' => "Asset Request Status"
    );
    $this->db->insert('tbl_notifications', $notification_data);

    // Set flashdata message
    $this->session->set_flashdata('success', 'Request approved successfully.');
    redirect('asset/view_requests'); // Replace with your actual controller name
}

// Reject request
public function reject_request($request_id) {
    // Check if the logged-in user is HR or SUPERADMIN
    $admin_type = $this->session->userdata('admin_type');
    if ($admin_type != 'HR' && $admin_type != 'SUPERADMIN') {
        // Set flashdata message for unauthorized access
        $this->session->set_flashdata('error', 'Unauthorized access.');
        redirect('asset/view_requests'); // Replace with your actual controller name
        return;
    }
    // Fetch the request details
    $request = $this->db->get_where('tbl_asset_requests', ['id' => $request_id])->row();
    
    // Update request status to rejected
    $this->db->set('status', 'rejected');
    $this->db->where('id', $request_id);
    $this->db->update('tbl_asset_requests');
    
    // Send notification
    $notification_data = array(
        'user_id' => $request->userid, // Assuming `user_id` is the column in `tbl_asset_requests`
        'message' => "Your asset request has been rejected.",
        'read' => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'title' => "Asset Request Status"
    );
    $this->db->insert('tbl_notifications', $notification_data);

    // Set flashdata message
    $this->session->set_flashdata('success', 'Request rejected successfully.');
    redirect('asset/view_requests'); // Replace with your actual controller name
}

    
    // Delete request
    public function delete_request($request_id) {
        // Check if the logged-in user is HR or SUPERADMIN
    $admin_type = $this->session->userdata('admin_type');
    if ($admin_type != 'HR' && $admin_type != 'SUPERADMIN') {
        // Set flashdata message for unauthorized access
        $this->session->set_flashdata('error', 'Unauthorized access.');
        redirect('asset/view_requests'); // Replace with your actual controller name
        return;
    }
        // Fetch the request details
        $request = $this->db->get_where('tbl_asset_requests', ['id' => $request_id])->row();
    
        // Delete the request
        $this->db->delete('tbl_asset_requests', ['id' => $request_id]);
    
        // Increment the asset's vacant count
        $this->db->set('vacant', 'vacant + 1', FALSE); // Increment vacant by 1
        $this->db->where('assetid', $request->assetid);
        $this->db->update('tbl_assets');
    
        // Set flashdata message
        $this->session->set_flashdata('success', 'Request deleted successfully.');
        redirect('asset/view_requests'); // Replace with your actual controller name
    }
    public function edit_asset($asset_id) {
        // Check if the logged-in user is HR or SUPERADMIN
    $admin_type = $this->session->userdata('admin_type');
    if ($admin_type != 'HR' && $admin_type != 'SUPERADMIN') {
        // Set flashdata message for unauthorized access
        $this->session->set_flashdata('error', 'Unauthorized access.');
        redirect('asset/view_requests'); // Replace with your actual controller name
        return;
    }
        // Fetch the asset details from the database
        $data['asset'] = $this->db->get_where('tbl_assets', ['assetid' => $asset_id])->row();
    
        // Load the edit asset view
        $data['main_content'] = 'assets/edit_asset'; // Create this view for editing
        $this->load->view('template', $data);
    }
    public function delete_asset($asset_id) {
        // Check if the logged-in user is HR or SUPERADMIN
    $admin_type = $this->session->userdata('admin_type');
    if ($admin_type != 'HR' && $admin_type != 'SUPERADMIN') {
        // Set flashdata message for unauthorized access
        $this->session->set_flashdata('error', 'Unauthorized access.');
        redirect('asset/view_requests'); // Replace with your actual controller name
        return;
    }
        // Delete the asset from the database
        $this->db->delete('tbl_assets', ['assetid' => $asset_id]);
    
        // Set flashdata message
        $this->session->set_flashdata('success', 'Asset deleted successfully.');
        redirect('asset/index'); // Redirect back to the assets index
    }
    public function update_asset($asset_id) {
        // Check if the logged-in user is HR or SUPERADMIN
    $admin_type = $this->session->userdata('admin_type');
    if ($admin_type != 'HR' && $admin_type != 'SUPERADMIN') {
        // Set flashdata message for unauthorized access
        $this->session->set_flashdata('error', 'Unauthorized access.');
        redirect('asset/view_requests'); // Replace with your actual controller name
        return;
    }
        // Define upload parameters (if updating image)
        $upload_path = './uploads/assetimages/';
        $allowed_types = 'jpg|jpeg|png|gif';
        $max_size = 2048; // 2 MB
    
        // Handle file upload (Check if an image is uploaded)
        $image_url = $this->handle_file_uploads('assetimage', $upload_path, $allowed_types, $max_size);
    
        // Prepare asset data
        $asset_data = array(
            'assetname' => $this->input->post('asset_name'),
            'available' => (int)$this->input->post('available'),
            'vacant' => (int)$this->input->post('vacant')
        );
    
        // If a new image was uploaded, update the asset image
        if ($image_url) {
            $asset_data['assetimage'] = $image_url;
        }
    
        // Update the asset in the database
        $this->db->where('assetid', $asset_id);
        $this->db->update('tbl_assets', $asset_data);
    
        // Set flashdata message
        $this->session->set_flashdata('success', 'Asset updated successfully.');
        redirect('asset/index');
    }
    
    
    
}
