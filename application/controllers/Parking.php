<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
use Dompdf\Options;

class Parking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load necessary models and libraries
        $this->load->model('Parking_model');
        // Load form helper to handle form submissions
        $this->load->helper('form');
    }

    public function index() {
        // Load view for parking management
        $data['slots'] = $this->Parking_model->get_available_slots(); 
        $data['user_slot'] = $this->Parking_model->get_user_slot($this->session->userdata("user_id"));
        $user_id = $this->session->userdata('user_id'); 
        $data['pending_requests'] = $this->Parking_model->get_pending_requests($user_id);
        $data['main_content'] = 'parking_view';
        $this->load->view('template', $data);
    }

    public function send_request() {
        // Handle form submission to send parking request
        $user_id = $this->session->userdata("user_id"); 
        $parking_type = $this->input->post('vehicle_type');
        $slot_id = $this->input->post('slot_id');
        $vehicle_number = $this->input->post('vehicle_number');
        $vehicle_type = $this->input->post('vehicle_type');
    
        $request_data = array(
            'user_id' => $user_id,
            'slot_id' => $slot_id,
            'vehicle_number' => $vehicle_number,
            'vehicle_type' => $vehicle_type,
            'status' => 'pending', // Default status for new requests
        );
    
        // Send parking request to model
        $result = $this->Parking_model->send_parking_request($request_data);
    
        // Check result and show toastr notification
        if ($result) {
            $this->session->set_flashdata('success', 'Parking request sent successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to send parking request. Please try again.');
        }
    
        redirect(base_url('Parking')); // Redirect to index method of Parking controller
    }
    public function requests() {
        // Fetch all parking requests
        $data['requests'] = $this->Parking_model->get_all_requests();
        $data['main_content'] = 'admin/parking_requests';
        $this->load->view('template', $data);
    }

    public function approve_request($request_id) {
        // Approve the parking request
        $request = $this->Parking_model->get_request_by_id($request_id);
        if ($request) {
            $slot_id = $request['slot_id'];
            $user_id = $request['user_id'];
            $vehicle_type = $request['vehicle_type'];
            $this->Parking_model->approve_request($request_id, $slot_id, $user_id,$vehicle_type);
            $this->session->set_flashdata('success', 'Parking request approved successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to approve parking request. Please try again.');
        }
        redirect(base_url('Parking/requests'));
    }
    public function download_pdf($slot_id) {
		// Load the user slot details
		$user_slot = $this->Parking_model->get_slot_by_id($slot_id);
	
		// Check if the slot exists
		if (empty($user_slot)) {
			show_404();
		}
	
		// Base URL for assets
		$base_url = base_url();
	
		// Vehicle image based on vehicle type
		$vehicle_image = $user_slot['vehicle_type'] === 'car' ? 'car.png' : 'bike.png';
	
		// Prepare the HTML content for the PDF
		$html = '
		<html>
		<head>
			<style>
				body {
					font-family: Arial, sans-serif;
					color: #333;
				}
				.header {
					text-align: center;
					margin-bottom: 20px;
				}
				.header img {
					width: 100px;
					border-radius: 50%;
				}
				.header h1 {
					font-size: 24px;
					margin-top: 10px;
					color: #000034;
				}
				.content {
					display: flex;
					justify-content: space-between;
					align-items: center;
					margin-bottom: 20px;
				}
				.details {
					max-width: 60%;
				}
				.details p {
					margin: 5px 0;
					font-size: 18px;
				}
				.details strong {
					color: #000034;
				}
				.vehicle-image {
					max-width: 30%;
				}
				.vehicle-image img {
					width: 100%;
					border-radius: 10px;
				}
				.confirmation {
					text-align: center;
					margin: 20px 0;
					font-size: 18px;
					color: #000034;
				}
				.warning {
					text-align: center;
					font-size: 16px;
					color: #FF0000;
				}
			</style>
		</head>
		<body>
			<div class="header">
				<img src="' . $base_url . 'assets/images/vda-logo.png" alt="VDA Logo">
				<h1>VDA Parking Receipt</h1>
			</div>
			<div class="content">
				<div class="details">
					<p><strong>Name:</strong> ' . $user_slot['name'] . '</p>
					<p><strong>Parking ID:</strong> ' . $user_slot['slot_id'] . '</p>
					<p><strong>Vehicle Type:</strong> ' . ucfirst($user_slot['vehicle_type']) . '</p>
					<p><strong>Date:</strong> ' . date('Y-m-d', strtotime($user_slot['created_at'])) . '</p>
				</div>
				<div class="vehicle-image">
					<img src="' . $base_url . 'assets/images/' . $vehicle_image . '" alt="Vehicle Image">
				</div>
			</div>
			<div class="confirmation">
				<p>This slot is registered for ' . $user_slot['name'] . '.</p>
			</div>
			<div class="warning">
				<p>You are only allowed to park your vehicle at your reserved slot.</p>
			</div>
		</body>
		</html>';
	
		// Initialize Dompdf
		$options = new Options();
		$options->set('isRemoteEnabled', true);
		$dompdf = new Dompdf($options);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
	
		// Output the generated PDF (force download)
		$dompdf->stream('parking_slot_details.pdf', array('Attachment' => 1));
	}
	







    
    
}
?>
