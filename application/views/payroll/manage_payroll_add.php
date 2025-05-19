<section class="container mx-auto p-6">
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Employee Details Card -->
        <div class="bg-gradient-to-br from-blue-50 to-white shadow-lg rounded-lg p-6 border border-blue-200">
            <h2 class="text-2xl font-semibold mb-6 text-blue-700">Employee Information</h2>
            <div class="flex items-center mb-6">
                <img src="<?php echo base_url('uploads/userdetailuploads/' . $employee['profile_pic']); ?>"
                     alt="Profile Picture" class="w-20 h-20 rounded-full border-2 border-blue-300 mr-6">
                <div>
                    <p class="text-lg font-semibold text-gray-800"><?php echo $employee['name']; ?></p>
                    <p class="text-gray-500"><?php echo $employee['employment_type']; ?></p>
                </div>
            </div>
            <div class="space-y-2 grid grid-cols-2 text-gray-700">
                <p><strong>Age:</strong> <?php echo $employee['age']; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $employee['dob']; ?></p>
                <p><strong>Gender:</strong> <?php echo $employee['gender']; ?></p>
                <p><strong>Joining Date:</strong> <?php echo $employee['joining_date']; ?></p>
            </div>
        </div>

        <!-- Salary & Attendance Card -->
<div class="bg-gradient-to-br from-green-50 to-white shadow-lg rounded-lg p-6 border border-green-200">
    <h2 class="text-2xl font-semibold mb-6 text-green-700">Salary and Attendance</h2>
    <p><strong>Employee Name:</strong> <?php echo htmlspecialchars($employee['name']); ?></p>
    <p><strong>CTC:</strong> <?php echo number_format($employee['ctc'], 2); ?></p>
    <p><strong>Total Work Days (<?php echo date('F Y'); ?>):</strong> <?php echo $total_work_days; ?></p>
    <p><strong>Net Payable:</strong> <?php echo (int) $adjusted_ctc; ?></p>
    
    <!-- Approved Leaves Section -->
    <h3 class="text-xl font-semibold mt-6 text-green-700">Approved Leaves (<?php echo date('F Y'); ?>)</h3>
    <?php if (!empty($approved_leaves)): ?>
        <div class="mt-4">
            <?php foreach ($approved_leaves as $leave): ?>
                <div class="bg-white shadow-md rounded-lg p-4 mb-4 border border-green-100">
                    <p><strong>Leave Type:</strong> <?php echo htmlspecialchars($leave['leave_type']); ?></p>
                    <p><strong>Start Date:</strong> <?php echo htmlspecialchars($leave['start_date']); ?></p>
                    <p><strong>End Date:</strong> <?php echo htmlspecialchars($leave['end_date']); ?></p>
                    <p><strong>Duration:</strong> <?php echo htmlspecialchars($leave['leave_type_duration']); ?></p>
                    <p><strong>Reason:</strong> <?php echo htmlspecialchars($leave['leave_reason']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="mt-4 text-gray-500">No approved leaves for this month.</p>
    <?php endif; ?>

    <button class="mt-4 bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700" onclick="openModal()">Add Heads</button>
    <a href="<?php echo base_url('manage-payroll/view_all_payslips/'.base64_encode($employee['id']) ) ?>" class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700" >View all Payslips For This User</a>
</div>


        <!-- Detailed Adjustments Section -->
        <div class="bg-gradient-to-br from-purple-50 to-white shadow-lg rounded-lg p-6 col-span-2 border border-purple-200">
            <h3 class="text-2xl font-semibold mb-6 text-purple-700">Allowances, Deductions, and Bonuses</h3>
            <table class="table-auto w-full border-collapse bg-white">
                <thead>
                    <tr class="bg-purple-100 text-purple-700">
                        <th class="px-4 py-2 border-b border-purple-300">Name</th>
                        <th class="px-4 py-2 border-b border-purple-300">Type</th>
                        <th class="px-4 py-2 border-b border-purple-300">Impact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adjustments as $adjustment): ?>
                        <tr class="hover:bg-purple-50">
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($adjustment['name']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($adjustment['type']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($adjustment['impact']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Summary Section -->
            <div class="mt-6 bg-gradient-to-r from-green-100 to-green-50 rounded-lg p-4 shadow">
                <h4 class="text-xl font-semibold text-green-700 mb-2">Calculation Summary</h4>
                <p><strong>Initial CTC:</strong> <?php echo number_format($employee['ctc'], 2); ?></p>
                <?php foreach ($adjustments as $adjustment): ?>
                    <p><strong><?php echo $adjustment['name']; ?>:</strong> <?php echo $adjustment['impact']; ?></p>
                <?php endforeach; ?>
                <p class="mt-2 text-lg font-semibold text-green-800"><strong>Net Payable:</strong> <?php echo (int) $adjusted_ctc; ?></p>
            </div>
        </div>
        <a class="mt-4 bg-green-600 text-white px-1 py-2 rounded-lg shadow hover:bg-green-700 flex items-center" style="width:180px;" href="<?php echo base_url('managepayroll/generate_payslip/'. base64_encode($employee['id'])); ?>">Generate Payslip <i class="fas fa-file-invoice"></i></a>

    </div>
</section>

<!-- Modal Form -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-xl font-semibold mb-6 text-gray-800">Add Allowance/Deduction/Bonus</h2>
        
        <form action="<?php echo base_url('managepayroll/add_bonus_deduction'); ?>" method="POST">
            <input type="hidden" name="employee_id" value="<?php echo $employee['id']; ?>">
            <input type="hidden" name="redirect_url" value="<?php echo base_url(uri_string()); ?>">

            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select name="type" id="type" class="w-full mt-1 p-2 border rounded-lg bg-gray-50">
                <option value="allowance">Allowance</option>
                <option value="deduction">Deduction</option>
                <option value="bonus">Bonus</option>
            </select>

            <div id="nameField" class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full mt-1 p-2 border rounded-lg bg-gray-50" placeholder="Enter Name">
            </div>

            <label for="is_percentage" class="block text-sm font-medium text-gray-700 mt-4">Is Percentage?</label>
            <select name="is_percentage" id="is_percentage" class="w-full mt-1 p-2 border rounded-lg bg-gray-50" onchange="toggleFields()">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>

            <div id="percentageField" class="hidden mt-4">
                <label for="percentage" class="block text-sm font-medium text-gray-700">Percentage</label>
                <input type="number" name="percentage" id="percentage" class="w-full mt-1 p-2 border rounded-lg bg-gray-50" placeholder="Enter percentage">
            </div>

            <div id="amountField" class="mt-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" id="amount" class="w-full mt-1 p-2 border rounded-lg bg-gray-50" placeholder="Enter amount">
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" class="bg-gray-300 text-gray-700 px-5 py-2 rounded-lg mr-2 hover:bg-gray-400" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function toggleFields() {
        const isPercentage = document.getElementById('is_percentage').value;
        document.getElementById('percentageField').classList.toggle('hidden', isPercentage === '0');
        document.getElementById('amountField').classList.toggle('hidden', isPercentage === '1');
    }
</script>
<script>
    function generatePayslip(employeeId) {
        // Open a modal or redirect to a payslip generation page
        window.location.href = "<?php echo base_url('managepayroll/generate_payslip/'); ?>" + "<?php echo base64_encode(''); ?>" + employeeId;
    }
</script>