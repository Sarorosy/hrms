<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Rooms_model');
        $this->load->library('upload');
        $this->load->library('session');
    }
    public function index(){
        $this->book_room();
    }

    public function add_room() {
        // Load the view to display the form
        $data['main_content'] = 'admin/add_room';
        $this->load->view('template',$data);

        if ($this->input->post()) { // Check if the form is submitted
            // Configuration for image upload
            $config['upload_path'] = './uploads/rooms/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 2048; // 2MB
            $config['encrypt_name'] = TRUE; // Encrypt the file name

            $this->upload->initialize($config);

            if ($this->upload->do_upload('room_img')) {
                $upload_data = $this->upload->data();
                $room_img = $upload_data['file_name'];

                // Prepare data for insertion
                $data = array(
                    'room_name' => $this->input->post('room_name'),
                    'seat_count' => $this->input->post('seat_count'),
                    'room_img' => $room_img
                );

                // Insert data into the model
                if ($this->Rooms_model->insert_room($data)) {
                    $this->session->set_flashdata('success', 'Room added successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add room.');
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            }

            // Redirect to the form page
            redirect(base_url('Rooms/add_room'));
        }
    }

    public function book_room() {
        $data['rooms'] = $this->Rooms_model->get_all_rooms();
        $data['bookings'] = $this->Rooms_model->get_future_bookings();
        $data['main_content']='book_room';
        $this->load->view('template', $data);

    }

    public function create_booking() {
        $room_id = $this->input->post('room_id');
        $start_time = $this->input->post('start_time');
        $end_time = $this->input->post('end_time');

        if ($this->Rooms_model->is_time_slot_available($room_id, $start_time, $end_time)) {
            $data = array(
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'room_id' => $room_id,
                'booked_user_id' => $this->session->userdata('user_id'), // Assuming user is logged in and user_id is stored in session
                'start_time' => $start_time,
                'end_time' => $end_time
            );

            if ($this->Rooms_model->insert_booking($data)) {
                $this->session->set_flashdata('success', 'Room booked successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to book room.');
            }
        } else {
            $this->session->set_flashdata('error', 'Sorry, this time slot is not available.Since it was already Booked!');
        }

        redirect(base_url('Rooms/book_room'));
    }
    public function delete_room($room_id) {
        // Fetch the room details based on the room ID
        $room = $this->Rooms_model->get_room_by_id($room_id);
        
        if ($room) {
            // Delete room image from the server if it exists
            $room_img_path = './uploads/rooms/' . $room['room_img'];
            if (file_exists($room_img_path) && !empty($room['room_img'])) {
                unlink($room_img_path); // Delete the file
            }

            // Delete the room from the database
            if ($this->Rooms_model->delete_room($room_id)) {
                $this->session->set_flashdata('success', 'Room deleted successfully!');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete room.');
            }
        } else {
            $this->session->set_flashdata('error', 'Room not found.');
        }

        // Redirect to the room listing page
        redirect(base_url('Rooms/book_room'));
    }
}
