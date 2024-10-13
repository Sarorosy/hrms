<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $session, $form_validation, $Dashboard_model, $agent, $Message_model;

    public function __construct() {
        parent::__construct();
        // Load necessary model
        $this->load->model('Dashboard_model');
    }

    public function index() {
        // Load recent notices from the model
        $data['recent_notices'] = $this->Dashboard_model->get_recent_notices(2);
        $data['holidays'] = $this->Dashboard_model->get_holidays(5);
        $data['birthdays'] = $this->Dashboard_model->get_birthdays(5);
        $data['events'] = $this->Dashboard_model->get_all_events();
        // Set the main content view
        $data['main_content'] = 'dashboard_view';

        // Load the template view with data
        $this->load->view('template', $data);
    }

    public function update_notifications() {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            $this->session->set_flashdata('error', 'User not logged in.');
            redirect('your_redirect_url'); // Redirect to an appropriate page
        }
    
        $this->load->model('Dashboard_model');
        $result = $this->Dashboard_model->mark_all_as_read($user_id);
    
        if ($result) {
            $this->session->set_flashdata('success', 'All notifications marked as read.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update notifications.');
        }
        
        redirect(base_url()); // Redirect to the same page or wherever you want
    }
    public function get_all_messages() {
        $user_id = $this->session->userdata('user_id');
        $this->load->model('Message_model'); // Load your model
        $this->load->helper('common_helper'); // Load your common helper
    
        $messages = $this->Message_model->get_all_messages($user_id); // Fetch messages
    
        // Check if messages are not empty
        if (!empty($messages)) {
            foreach ($messages as $message) {
                // Check if the message is unread
                $isUnread = $message->read == 0;
                $messageClass = $isUnread ? 'message-item unread' : 'message-item';
    
                // Use data-id to store the message ID for AJAX request
                echo '<div class="' . $messageClass . ' hover:bg-blue-200" style="display: flex; align-items: center; padding: 10px; border-radius: 5px; margin-bottom: 10px;" data-id="' . $message->id . '" onclick="markAsRead(this)">';
    
                // Safely handle the message property
                $messageText = isset($message->message) ? htmlspecialchars($message->message) : 'No content available';
                echo '<p style="flex-grow: 1; margin: 0;">' . $messageText . '</p>';
    
                // Fetch the sender's name
                $senderName = htmlspecialchars($message->sender_id); // Get the sender's name
                echo '<span style="font-weight: bold;display:flex;"><p style="font-weight:300;margin-right:10px;"> Sent by </p> ' . $senderName . '</span>';
    
                // Display a blue dot for unread messages
                if ($isUnread) {
                    echo '<span class="unread-indicator" style="width: 10px; height: 10px; border-radius: 50%; background-color: #3b82f6; margin-left: 5px;"></span>';
                }
    
                // Safely handle the created_at property
                $createdAt = isset($message->created_at) ? date('h:i A', strtotime($message->created_at)) : 'Unknown time';
                echo '<small style="margin-left: 10px; color: gray;">' . $createdAt . '</small>';
        
                echo '</div>';
            }
        } else {
            echo '<p>No messages found.</p>';
        }
    }
    public function read_message() {
        $this->load->model('Message_model'); // Load your model
    
        // Get the message ID from the POST request
        $message_id = $this->input->post('id');
    
        // Call the model method to update the message status
        if ($this->Message_model->mark_message_as_read($message_id)) {
            echo 'success';
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    
    

    
    
    

}
?>
