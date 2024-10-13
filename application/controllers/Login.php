<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public $session, $form_validation, $Login_model,$agent ;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function authenticate()
{
    $this->load->model('Login_model');
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->Login_model->get_user($username, $password);

    if ($user) {
        $this->session->set_userdata('userloggedin', true);
        $this->session->set_userdata('user_id', $user->id);
        $this->session->set_userdata('username', $user->name);
        $this->session->set_userdata('email', $user->email);
        $this->session->set_userdata('admin_type', $user->role);
        $this->session->set_userdata('position', $user->position);
        $this->session->set_userdata('leave_balance', $user->leave_balance);
        $this->session->set_flashdata('success', 'Login successful!');
        redirect(base_url('Dashboard')); 
    } else {
        $this->session->set_flashdata('error', 'Invalid username or password.');
        redirect(base_url('login')); 
    }
}


    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
