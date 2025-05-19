<?php

class ManagePayroll extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load URL helper for redirect
        $this->load->helper('url');
    }

    public function index() {
        // Fetch all records from tbl_admin
        $this->db->where('id !=', $this->session->userdata('user_id'));
    $this->db->where('role !=', 'SUPERADMIN');
    $data['admins'] = $this->db->get('tbl_admin')->result_array();

        // Load the view for displaying records
        $data['main_content'] = 'payroll/index'; // Adjust to the actual view path if needed
        $this->load->view('template', $data);
    }
    
    
    public function manage_payroll_add($encoded_id) {
    // Decode the admin ID
    $admin_id = base64_decode($encoded_id);

    // Fetch employee details from tbl_admin
    $this->db->select('id,name, profile_pic, age, dob, gender, joining_date, employment_type, ctc');
    $this->db->where('id', $admin_id);
    $employee = $this->db->get('tbl_admin')->row_array();

    // Get total workdays for the current month and year from tbl_attendance
    $current_month = date('Y-m');
    $this->db->where('user_id', $admin_id);
    $this->db->like('date', $current_month, 'after'); // Matches YYYY-MM format
    $attendance = $this->db->get('tbl_attendance')->result_array();
    $total_work_days = count($attendance);
    
    // Fetch approved leaves for the current month
    $this->db->where('user_id', $admin_id);
    $this->db->where('status', 'Approved');
    $this->db->where('leave_pay_type', 'unpaid');
    $this->db->where("DATE_FORMAT(start_date, '%Y-%m') =", $current_month);
    $approved_leaves = $this->db->get('tbl_leave_request')->result_array();
    

    $this->db->select('name, type, amount, is_percentage, percentage');
    $common_allowances_deductions = $this->db->get('tbl_common_allowances_deductions_bonus')->result_array();

    // Fetch allowances, deductions, and bonus for the employee from tbl_private_allowances_deductions_bonus (with employee_id filter)
    $this->db->where('employee_id', $admin_id);
    $private_allowances_deductions = $this->db->get('tbl_private_allowances_deductions_bonus')->result_array();

    // Merge the results
    $allowances_deductions = array_merge($common_allowances_deductions, $private_allowances_deductions);

    // Initialize adjusted CTC and adjustments array
    $adjusted_ctc = $employee['ctc'];
    $adjustments = [];

    // Calculate final salary adjustments based on allowances, deductions, and bonuses
    foreach ($allowances_deductions as $item) {
        $adjustment = [
            'name' => $item['name'],
            'type' => ucfirst($item['type']),
            'is_percentage' => $item['is_percentage'] == 1 ? 'Yes' : 'No',
            'impact' => 0
        ];

        // Calculate the adjustment amount
        if ($item['is_percentage'] == 1) {
            $impact = round($employee['ctc'] * ($item['percentage'] / 100), 2);
        } else {
            $impact = $item['amount'];
        }

        // Apply impact to CTC based on type
        if ($item['type'] == 'allowance' || $item['type'] == 'bonus') {
            $adjusted_ctc += $impact;
            $adjustment['impact'] = "+ " . number_format($impact, 2);
        } elseif ($item['type'] == 'deduction') {
            $adjusted_ctc -= $impact;
            $adjustment['impact'] = "- " . number_format($impact, 2);
        }

        // Store each adjustment detail
        $adjustments[] = $adjustment;
    }

    // Pass data to the view
    $data = [
        'employee' => $employee,
        'total_work_days' => $total_work_days,
        'attendance' => $attendance,
        'adjusted_ctc' => $adjusted_ctc,
        'adjustments' => $adjustments,
        'approved_leaves' => $approved_leaves,
    ];
    $data['main_content'] = 'payroll/manage_payroll_add'; 
    $this->load->view('template', $data);
}

//for private alowances deductions, bonus
public function add_bonus_deduction() {
    // Load form validation library
    $this->load->library('form_validation');

    // Set validation rules
    $this->form_validation->set_rules('employee_id', 'Employee ID', 'required|numeric');
    $this->form_validation->set_rules('type', 'Type', 'required|in_list[allowance,deduction,bonus]');
    $this->form_validation->set_rules('is_percentage', 'Is Percentage', 'required|in_list[0,1]');

    // Only validate percentage or amount based on is_percentage value
    if ($this->input->post('is_percentage') == 1) {
        $this->form_validation->set_rules('percentage', 'Percentage', 'required|numeric');
    } else {
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
    }

    // Check if the form validation passed
    if ($this->form_validation->run() == FALSE) {
        // Reload the previous page with errors
        $this->session->set_flashdata('error', validation_errors());
        echo  validation_errors();
        $prev_url = $this->input->post('redirect_url'); // Replace with a default route if needed
        redirect($prev_url);
    } else {
        // Gather form data
        $data = [
            'employee_id' => $this->input->post('employee_id'),
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'is_percentage' => $this->input->post('is_percentage'),
            'percentage' => $this->input->post('is_percentage') == 1 ? $this->input->post('percentage') : null,
            'amount' => $this->input->post('is_percentage') == 0 ? $this->input->post('amount') : null,
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert data into the database
        if ($this->db->insert('tbl_private_allowances_deductions_bonus', $data)) {
            $this->session->set_flashdata('success', 'Record added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to add record. Please try again.');
        }

        // Redirect to the previous URL
        $prev_url = $this->input->post('redirect_url');// Replace with a default route if needed
        redirect($prev_url);
    }
}


public function edit_bonus_deduction() {
    $id = $this->input->post('id');
    // Load form validation library
    $this->load->library('form_validation');

    // Set validation rules
    $this->form_validation->set_rules('employee_id', 'Employee ID', 'required|numeric');
    $this->form_validation->set_rules('type', 'Type', 'required|in_list[allowance,deduction,bonus]');
    $this->form_validation->set_rules('is_percentage', 'Is Percentage', 'required|in_list[0,1]');
    
    // Only validate percentage or amount based on is_percentage value
    if ($this->input->post('is_percentage') == 1) {
        $this->form_validation->set_rules('percentage', 'Percentage', 'required|numeric|greater_than[0]');
    } else {
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric|greater_than[0]');
    }

    // Check if the form validation passed
    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect($this->input->post('redirect_url'));
    } else {
        // Gather form data
        $data = [
            'employee_id' => $this->input->post('employee_id'),
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'is_percentage' => $this->input->post('is_percentage'),
            'percentage' => $this->input->post('is_percentage') == 1 ? $this->input->post('percentage') : null,
            'amount' => $this->input->post('is_percentage') == 0 ? $this->input->post('amount') : null
        ];

        // Update data in the database
        $this->db->where('id', $id);
        if ($this->db->update('tbl_private_allowances_deductions_bonus', $data)) {
            $this->session->set_flashdata('success', 'Record updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update record. Please try again.');
        }

        redirect($this->input->post('redirect_url'));
    }
}

public function delete_head($id) {
    // Check if ID is valid and delete from database
    if ($this->db->delete('tbl_private_allowances_deductions_bonus', ['id' => $id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}


public function get_head($id) {
    $head = $this->db->get_where('tbl_private_allowances_deductions_bonus', ['id' => $id])->row_array();
    echo json_encode($head);
}

public function private_heads() {
        $this->db->where('id !=', $this->session->userdata('user_id'));
    $this->db->where('role !=', 'SUPERADMIN');
    $data['admins'] = $this->db->get('tbl_admin')->result_array();

    // Fetch private heads
    $data['private_heads'] = $this->db->get('tbl_private_allowances_deductions_bonus')->result_array();


        // Load the private heads view
        $data['main_content'] = 'payroll/private_heads';
        $this->load->view('template', $data);
    }

//for common allowances deductions bonus 

public function add_common_bonus_deduction() {
        // Validate and get form data
        $data = [
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'is_percentage' => $this->input->post('is_percentage'),
            'percentage' => $this->input->post('is_percentage') ? $this->input->post('percentage') : null,
            'amount' => $this->input->post('amount'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert into the database
        $this->db->insert('tbl_common_allowances_deductions_bonus', $data);

        // Redirect back to the page
        redirect($this->input->post('redirect_url'));
    }

    public function edit_common_bonus_deduction() {
        // Validate and get form data
        $id = $this->input->post('id');
        $data = [
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'is_percentage' => $this->input->post('is_percentage'),
            'percentage' => $this->input->post('is_percentage') ? $this->input->post('percentage') : null,
            'amount' => $this->input->post('amount')
        ];

        // Update in the database
        $this->db->where('id', $id);
        $this->db->update('tbl_common_allowances_deductions_bonus', $data);

        // Redirect back to the page
        redirect($this->input->post('redirect_url'));
    }

    public function delete_common_bonus_deduction($id) {
        // Delete from the database
        $this->db->delete('tbl_common_allowances_deductions_bonus', ['id' => $id]);

        // Redirect back to the page
        redirect($this->input->get('redirect_url'));
    }
    
    
public function common_heads() {
        // Load the data for Common Heads (fetch from database if necessary)
        $data['common_heads'] = $this->db->get('tbl_common_allowances_deductions_bonus')->result_array();

        // Load the common heads view
        $data['main_content'] = 'payroll/common_heads';
        $this->load->view('template', $data);
    }

    public function generate_payslip($employee_id) {
     $employee_id  = base64_decode($employee_id);

    // Fetch employee data from the database
    $this->db->select('*');
    $this->db->where('id', $employee_id);
    $employee = $this->db->get('tbl_admin')->row_array();

    // Check if employee exists
    if (!$employee) {
        // Employee not found, redirect back with an error message
        $this->session->set_flashdata('error', 'Employee not found.');
        $back_url = $_SERVER['HTTP_REFERER'];
redirect($back_url);
    }

    // Check if a payslip already exists for the employee for the current date
    $current_date = date('Y-m-d');
    $this->db->where('employee_id', $employee_id);
    $this->db->where('date', $current_date);
    $existing_payslip = $this->db->get('tbl_payslip')->row_array();

    if ($existing_payslip) {
        // Payslip already exists, redirect back with an error message
        $this->session->set_flashdata('error', 'Payslip already exists for this employee on the selected date.');
        $back_url = $_SERVER['HTTP_REFERER'];
redirect($back_url);
    }
    
    // Calculate allowances
    $this->db->where('type', 'allowance');
    $common_allowances = $this->db->get('tbl_common_allowances_deductions_bonus')->result_array();
    
    // Fetch private allowances
    $this->db->where('employee_id', $employee_id);
    $this->db->where('type', 'allowance');
    $private_allowances = $this->db->get('tbl_private_allowances_deductions_bonus')->result_array();
    
    // Merge allowances
    $allowances = array_merge($common_allowances, $private_allowances);
    
    // Calculate deductions
    $this->db->where('type', 'deduction');
    $common_deductions = $this->db->get('tbl_common_allowances_deductions_bonus')->result_array();
    
    // Fetch private deductions
    $this->db->where('employee_id', $employee_id);
    $this->db->where('type', 'deduction');
    $private_deductions = $this->db->get('tbl_private_allowances_deductions_bonus')->result_array();
    
    // Merge deductions
    $deductions = array_merge($common_deductions, $private_deductions);
    
    // Calculate bonuses
    
    $this->db->where('type', 'bonus');
    $common_bonuses = $this->db->get('tbl_common_allowances_deductions_bonus')->result_array();
    
    // Fetch private bonuses
    $this->db->where('employee_id', $employee_id);
    $this->db->where('type', 'bonus');
    $private_bonuses = $this->db->get('tbl_private_allowances_deductions_bonus')->result_array();
    
    // Merge bonuses
    $bonuses = array_merge($common_bonuses, $private_bonuses);
    
    // Calculate unpaid leaves for the current month
    $current_month = date('Y-m');
    $this->db->where('user_id', $employee_id);
    $this->db->where('status', 'Approved');
    $this->db->where('leave_pay_type', 'unpaid');
    $this->db->where("DATE_FORMAT(start_date, '%Y-%m') =", $current_month);
    $unpaid_leaves = $this->db->get('tbl_leave_request')->result_array();
    
    // Count the number of unpaid leave days
    $unpaid_leave_days = count($unpaid_leaves);
    
    // Convert to JSON
    $allowances_json = json_encode($allowances);
    $deductions_json = json_encode($deductions);
    $bonuses_json = json_encode($bonuses);

    // Insert into tbl_payslip
    $data = [
        'employee_id' => $employee_id,
        'basic_salary' => $employee['ctc'],
        'allowances' => $allowances_json,
        'deductions' => $deductions_json,
        'bonuses' => $bonuses_json,
        'unpaid_leave_days' => $unpaid_leave_days,
        'date' => date('Y-m-d'),
    ];
    
    $this->db->insert('tbl_payslip', $data);
    
    $this->session->set_flashdata('success', 'Payslip Generated.');
    // Redirect or load view to show payslip
    $back_url = $_SERVER['HTTP_REFERER'];
    redirect($back_url);
}

public function view_payslip($encoded_employee_id) {
    // Decode the employee ID
    $employee_id = base64_decode($encoded_employee_id);

    // Fetch all payslips for the given employee ID
    $this->db->where('employee_id', $employee_id);
    $payslips = $this->db->get('tbl_payslip')->result_array();

    // Check if any payslips were found
    if (empty($payslips)) {
        // No payslips found for the employee
        $this->session->set_flashdata('error', 'No payslips found for this employee.');
        redirect(base_url('managepayroll')); // Redirect to the payroll management page
    }

    // Pass data to the view
    $data = [
        'employee_id' => $employee_id,
        'payslips' => $payslips,
        'main_content' => 'payroll/view_payslip', // Specify your view file
    ];
    
    // Load the view
    $this->load->view('template', $data);
}
public function view_payslip_details($encoded_id) {
    // Decode the  ID
    $id = base64_decode($encoded_id);

    // Fetch all payslips for the given  ID
    $this->db->where('id', $id);
    $payslips = $this->db->get('tbl_payslip')->row_array();

    // Check if any payslips were found
    if (empty($payslips)) {
        // No payslips found for the employee
        $this->session->set_flashdata('error', 'No payslip found.');
        redirect(base_url('managepayroll')); // Redirect to the payroll management page
    }
    
    $employee_id = $payslips['employee_id'];
    $this->db->where('id', $employee_id);
    $employee = $this->db->get('tbl_admin')->row_array();

    // Pass data to the view
    $data = [
        'payslips' => $payslips,
        'employee' => $employee,
        'main_content' => 'payroll/view_payslip_details', // Specify your view file
    ];
    
    // Load the view
    $this->load->view('template', $data);
}
public function delete_payslip($payslip_id) {
    $payslip_id = base64_decode($payslip_id);
    
    // Check if the payslip exists
    $this->db->where('id', $payslip_id);
    $payslip = $this->db->get('tbl_payslip')->row_array();
    
    if (!$payslip) {
        $this->session->set_flashdata('error', 'Payslip not found.');
        redirect('manage-payroll/view-payslips'); // Adjust the redirect as needed
    }
    
    // Proceed to delete
    $this->db->delete('tbl_payslip', ['id' => $payslip_id]);
    
    $this->session->set_flashdata('success', 'Payslip deleted successfully.');
    // Redirect or load view to show payslip
    $back_url = $_SERVER['HTTP_REFERER'];
    redirect($back_url); // Adjust the redirect as needed
}

public function view_user_allpayslips($encoded_employee_id)
{
    // Decode the employee_id from the encoded parameter
    $employee_id = base64_decode($encoded_employee_id);

    // Query the database to retrieve all payslips for the decoded employee_id
    $query = $this->db->query("SELECT * FROM tbl_payslip WHERE employee_id = ? ORDER BY id DESC LIMIT 24", array($employee_id));
    $data['payslips'] = $query->result_array(); // Store the results as an associative array

    // Set the main content view template and pass the data
    $data['main_content'] = 'payroll/users_payslips'; // Specify the main content view
    $this->load->view('template', $data); // Load the main template view with the data
}


}
