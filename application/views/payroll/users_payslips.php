<div class="container mx-auto p-8 bg-white shadow-lg rounded-lg mt-3">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-semibold bluetext">Payslips</h3>
        <a href="javascript:history.back()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Back</a>
    </div>

    <?php if (!empty($payslips)) : ?>
        <div class="overflow-x-auto max-w-2xl mx-auto">
            <table class="max-w-xl bg-white border border-gray-200 text-left rounded-xl my-2" id="usersPayslip">
                <thead class="blue-bg rounded-xl">
                    <tr class="text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light rounded-xl">
                    <?php foreach ($payslips as $payslip) : ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left"><?= strdate($payslip['date']); ?></td>
                            <td class="py-3 px-6 text-center">
                                <a href="<?= base_url('manage-payroll/view-payslip-details/' . base64_encode($payslip['id'])); ?>" class="text-blue-700 bg-blue-100 px-2 py-1 rounded hover:text-blue-700  text-xl">View</a>
                                <?php if($this->session->userdata("admin_type") == "SUPERADMIN" || $this->session->userdata("admin_type") == "HR" ) { ?>
                                <a href="<?= base_url('manage-payroll/delete_payslip/' . base64_encode($payslip['id'])); ?>" class="text-red-500 hover:text-red-700 text-xl bg-red-100 p-2 rounded ml-2">Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="text-center text-gray-500 mt-6">No payslips found.</p>
    <?php endif; ?>
</div>
