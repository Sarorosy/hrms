<h1 class="text-2xl font-bold mb-4">Payslips for Employee ID: <?php echo htmlspecialchars($employee_id); ?></h1>

<?php if ($this->session->flashdata('error')): ?>
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>

<table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
    <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-3 px-6 text-left">Date</th>
            <th class="py-3 px-6 text-left">Actions</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 text-sm font-light">
    <?php if (empty($payslips)): ?>
        <tr>
            <td colspan="2" class="text-center py-4">No Payslips Found</td>
        </tr>
    <?php else: ?>
        <?php foreach ($payslips as $payslip): ?>
            <tr class="border-b border-gray-300 hover:bg-gray-100">
                <td class="py-4 px-6"><?php echo htmlspecialchars($payslip['date']); ?></td>
                <td class="py-4 px-6">
                    <a href="<?php echo base_url('manage-payroll/view-payslip-details/' . base64_encode($payslip['id'])); ?>" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 transition duration-300">View</a>
                    <form action="<?php echo base_url('manage-payroll/delete-payslip/' . base64_encode($payslip['id'])); ?>" method="POST" style="display:inline;">
                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 transition duration-300 ml-2" onclick="return confirm('Are you sure you want to delete this payslip?');">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
