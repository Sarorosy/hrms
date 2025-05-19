<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

public $session, $form_validation, $agent;
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    // Send Email Function
    public function send() {
        // Get input values from POST request
        
        $to_email = $this->input->post('to');
        $subject = $this->input->post('subject');
        $body = $this->input->post('body');

        // Validation (you can adjust according to your needs)
        if ( empty($to_email) || empty($subject) || empty($body)) {
            // Error response if inputs are empty
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            return;
        }

        // MailerSend API URL
        $url = "https://api.mailersend.com/v1/email";

        // API Authorization Token (use environment variables or config to store this securely)
        $api_key = 'mlsn.73b7ac6d58a65bf9d03c9e399bd056bf10c8f8d013c526bf50dd413702dd02db';

        // Prepare the request data
        $data = [
            'from' => [
                'email' => 'vdasolutions@ryupunch.com'
            ],
            'to' => [
                [
                    'email' => $to_email
                ]
            ],
            'subject' => $subject,
            'text' => $body,
            'html' => $body
        ];

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // cURL Request to MailerSend API
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Requested-With: XMLHttpRequest',
            'Authorization: Bearer ' . $api_key
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        // Execute cURL
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo json_encode(['status' => 'error', 'message' => curl_error($ch)]);
        } else {
            // Decode the response from MailerSend API
            $response_data = json_decode($response, true);

            // Handle the API response
            // if (isset($response_data['status']) && $response_data['status'] === 'success') {
            //     echo json_encode(['status' => 'success', 'message' => 'Email sent successfully!']);
            // } else {
            //     echo json_encode(['status' => 'error', 'message' => 'Failed to send email']);
            // }
            echo $response;
        }

        // Close cURL
        curl_close($ch);
    }
}
