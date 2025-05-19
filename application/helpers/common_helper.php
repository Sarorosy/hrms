<?php 

if (!function_exists('get_profile_pic_by_id')) {
    function get_profile_pic_by_id($user_id) {
        $CI =& get_instance();
        $CI->load->model('Dashboard_model');
        $user = $CI->Dashboard_model->get_user_by_id($user_id);
        return isset($user['profile_pic']) ? $user['profile_pic'] : 'default.jpg';
    }
}

if (!function_exists('generate_breadcrumbs')) {
    function generate_breadcrumbs() {
        $CI =& get_instance();
        $segments = $CI->uri->segment_array();
        $breadcrumbs = [];
        $breadcrumbs[] = ['url' => base_url(), 'title' => 'Home'];

        $path = '';
        foreach ($segments as $segment) {
            $path .= '/' . $segment;
            $breadcrumbs[] = ['url' => base_url($path), 'title' => ucfirst(str_replace('_', ' ', $segment))];
        }

        return $breadcrumbs;
    }
}
if(!function_exists('strdate')){
    function strdate($date) {
        // Create DateTime object from the input date string
        $dateTime = new DateTime($date);
        
        // Format the date as desired: DD Month YYYY
        $formattedDate = $dateTime->format('d F Y'); // 'F' gives full month name
        
        return $formattedDate;
    }
    
}
if (!function_exists('count_pending_asset_requests')) {
    function count_pending_asset_requests()
    {
        // Get the CodeIgniter instance
        $CI =& get_instance();
        
        // Load the database if it is not already loaded
        $CI->load->database();

        // Run the query to count rows with status 'pending'
        $CI->db->from('tbl_asset_requests');
        $CI->db->where('status', 'pending');
        $count = $CI->db->count_all_results();

        return $count;
    }
}

if(!function_exists('getStatusColorClass')){
    function getStatusColorClass($status) {
        switch ($status) {
            case 'Pending' || 'pending':
                return 'text-yellow-500';
            case 'Approved' || 'approved':
                return 'text-green-600';
            case 'Rejected' || 'rejected':
                return 'text-red-600';
            default:
                return ''; 
        }
    }
}

if (!function_exists('getAdminNameById')) {
    function getAdminNameById($userId)
    {
        // Get CodeIgniter instance
        $CI = &get_instance();

        // Assuming you have autoloaded the database library or loaded it in the function
        $CI->load->database();

        // Query to fetch name from tbl_admin based on id
        $query = $CI->db->select('name')
                        ->from('tbl_admin')
                        ->where('id', $userId)
                        ->get();

        // Check if query returned a result
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->name;
        }

        // Return null if no matching user found
        return null;
    }
}

if (!function_exists('getAssetNameById')) {
    function getAssetNameById($userId)
    {
        // Get CodeIgniter instance
        $CI = &get_instance();

        // Assuming you have autoloaded the database library or loaded it in the function
        $CI->load->database();

        // Query to fetch name from tbl_admin based on id
        $query = $CI->db->select('assetname')
                        ->from('tbl_assets')
                        ->where('assetid', $userId)
                        ->get();

        // Check if query returned a result
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->assetname;
        }

        // Return null if no matching user found
        return null;
    }
}
if (!function_exists('getPositionById')) {
    function getPositionById($id)
    {
        // Get CodeIgniter instance
        $CI = &get_instance();

        // Ensure database is loaded
        if (!$CI->load->is_loaded('database')) {
            $CI->load->database();
        }

        // Query to fetch the 'name' field from 'tbl_positions' based on 'id'
        $query = $CI->db->select('name')
                        ->from('tbl_positions')
                        ->where('id', $id)
                        ->get();

        // Check if query returned a result
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->name;
        }

        // Return null if no matching position found
        return null;
    }
}
if (!function_exists('getDepartmentById')) {
    function getDepartmentById($id)
    {
        // Get CodeIgniter instance
        $CI = &get_instance();

        // Ensure database is loaded
        if (!$CI->load->is_loaded('database')) {
            $CI->load->database();
        }

        // Query to fetch the 'name' field from 'tbl_positions' based on 'id'
        $query = $CI->db->select('name')
                        ->from('tbl_departments')
                        ->where('id', $id)
                        ->get();

        // Check if query returned a result
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->name;
        }

        // Return null if no matching position found
        return null;
    }
}
if (!function_exists('getTotalWorkedDays')) {
    function getTotalWorkedDays($user_id)
    {
        // Get CodeIgniter instance
        $CI = &get_instance();
        
        // Load the database if it's not already loaded
        $CI->load->database();
        
        // Query to count rows where login_time is not null or empty
        $CI->db->from('tbl_attendance');
        $CI->db->where('user_id', $user_id);
        $CI->db->where('login_time IS NOT NULL'); // Check for non-null login_time
        $CI->db->where('login_time !=', ''); // Check for non-empty login_time

        // Get the count of records that match the conditions
        return $CI->db->count_all_results();
    }
}


if (!function_exists('get_user_notifications')) {
    function get_user_notifications() {
        // Get a reference to the CI instance
        $CI =& get_instance();

        // Load the database library if not already loaded
        $CI->load->database();

        // Get the current user's ID from the session
        $user_id = $CI->session->userdata('user_id');

        // Fetch notifications from the database
        $CI->db->where('user_id', $user_id);
        $CI->db->order_by('created_at', 'DESC');
        $query = $CI->db->get('tbl_notifications');

        // Return the result as an array
        return $query->result_array();
    }
}
if(!function_exists('get_unread_notifications_count')){
function get_unread_notifications_count() {
    $CI =& get_instance();
    $CI->load->database();
    $user_id = $CI->session->userdata('user_id');
    
    $CI->db->where('user_id', $user_id);
    $CI->db->where('read', 0);
    $CI->db->from('tbl_notifications');
    return $CI->db->count_all_results();
}}
if(!function_exists('get_unread_messages_count')){
    function get_unread_messages_count() {
        $CI =& get_instance();
        $CI->load->database();
        $user_id = $CI->session->userdata('user_id');
        
        $CI->db->where('user_id', $user_id);
        $CI->db->where('read', 0);
        $CI->db->from('tbl_messages');
        return $CI->db->count_all_results();
    }}
    
    
    if (!function_exists('get_pending_reminders')) {
    
    function get_pending_reminders()
    {
        $ci =& get_instance();
        $ci->load->database();
        
        // Get current user ID from session
        $user_id = $ci->session->userdata('user_id');
        
        // Set date range for current time to the end of today
        $start_datetime = date('Y-m-d H:i:s'); // Current time
        $end_datetime = date('Y-m-d 23:59:59'); // End of today

        // Run the query
        $ci->db->select('*');
        $ci->db->from('tbl_notes');
        $ci->db->where('employee_id', $user_id);
        $ci->db->where('status', 'pending');
        $ci->db->where('remind', 'yes');
        $ci->db->where('datetime >=', $start_datetime);
        $ci->db->where('datetime <=', $end_datetime);
        $ci->db->limit(1); // Fetch only the first row
        $query = $ci->db->get();
        
        return $query->row_array(); // Return the first row as an associative array
    }
    }
    
    