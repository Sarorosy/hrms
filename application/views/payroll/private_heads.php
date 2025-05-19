<div class="container mx-auto p-4 bg-white mt-2">
    <div class="flex justify-between items-center mb-4">
        <button onclick="window.history.back()" class="bg-red-700 text-white px-4 py-2 rounded-lg">Back</button>
        <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Heads</button>
    </div>

    <h2 class="text-2xl font-bold mb-4">Private Heads</h2>
    <table class="table-auto w-full mb-4" id="privateheads">
        <thead class="blue-bg text-white">
            <tr>
                <th class="px-4 py-2">For</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Created at</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($private_heads as $head): ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo getAdminNameById($head['employee_id']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($head['name']); ?></td>
                    <td class="border px-4 py-2"><?php echo ucfirst($head['type']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($head['amount']); ?></td>
                    <td class="border px-4 py-2"><?php echo strdate($head['created_at']); ?></td>
                    <td class="border px-4 py-2">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editHead(<?php echo $head['id']; ?>,<?php echo $head['employee_id']; ?>, '<?php echo htmlspecialchars($head['name']); ?>', '<?php echo htmlspecialchars($head['type']); ?>', <?php echo $head['is_percentage']; ?>, <?php echo $head['percentage'] ?: 0; ?>, <?php echo $head['amount'] ?: 0; ?>)">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded-lg" onclick="deleteHead(<?php echo $head['id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal for adding heads -->
<div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-4 w-1/3">
        <h3 class="text-lg font-bold mb-4">Add Heads</h3>
        <form method="post" action="<?php echo base_url('managepayroll/add_bonus_deduction'); ?>">
            <input type="hidden" name="redirect_url" value="<?php echo base_url(uri_string()); ?>">
            <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <select id="employee_id" class="border px-4 py-2 w-full mb-4" name="employee_id">
            <?php foreach ($admins as $employee): ?>
                <option value="<?php echo $employee['id']; ?>"><?php echo htmlspecialchars($employee['name']); ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        
        <div class="mt-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter Name" required>
            </div>

            <label for="type" class="block text-sm font-medium text-gray-700 mt-4">Type</label>
            <select name="type" id="type" class="w-full mt-1 p-2 border rounded-lg" required>
                <option value="allowance">Allowance</option>
                <option value="deduction">Deduction</option>
                <option value="bonus">Bonus</option>
            </select>

            <label for="is_percentage" class="block text-sm font-medium text-gray-700 mt-4">Is Percentage?</label>
            <select name="is_percentage" id="is_percentage" class="w-full mt-1 p-2 border rounded-lg" onchange="toggleFields()" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>

            <div id="percentageField" class="hidden mt-4">
                <label for="percentage" class="block text-sm font-medium text-gray-700">Percentage</label>
                <input type="number" name="percentage" id="percentage" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter percentage" step="0.01">
            </div>

            <div id="amountField" class="mt-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" id="amount" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter amount" >
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add</button>
                <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg" onclick="closeModal()">Cancel</button>
            </div>
        
        </form>
    </div>
</div>

<!-- Modal for editing heads -->
<div id="editModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-4 w-1/3">
        <h3 class="text-lg font-bold mb-4">Edit Heads</h3>
        <form id="editForm" method="post" action="<?php echo base_url('managepayroll/edit_bonus_deduction'); ?>">
            <input type="hidden" name="redirect_url" value="<?php echo base_url(uri_string()); ?>">
            <input type="hidden" name="id" id="editId" value="">
            <label for="editEmployeeId" class="block text-sm font-medium text-gray-700">Select Employee</label>
            <select name="employee_id" id="editEmployeeId" class="w-full mt-1 p-2 border rounded-lg">
                <?php foreach ($admins as $admin): ?>
                    <option value="<?php echo $admin['id']; ?>"><?php echo htmlspecialchars($admin['name']); ?></option>
                <?php endforeach; ?>
            </select>

            <label for="editType" class="block text-sm font-medium text-gray-700 mt-4">Type</label>
            <select name="type" id="editType" class="w-full mt-1 p-2 border rounded-lg">
                <option value="allowance">Allowance</option>
                <option value="deduction">Deduction</option>
                <option value="bonus">Bonus</option>
            </select>

            <div id="editNameField" class="mt-4">
                <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="editName" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter Name">
            </div>

            <label for="editIsPercentage" class="block text-sm font-medium text-gray-700 mt-4">Is Percentage?</label>
            <select name="is_percentage" id="editIsPercentage" class="w-full mt-1 p-2 border rounded-lg" onchange="toggleEditFields()">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>

            <div id="editPercentageField" class="hidden mt-4">
                <label for="editPercentage" class="block text-sm font-medium text-gray-700">Percentage</label>
                <input type="number" name="percentage" id="editPercentage" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter percentage">
            </div>

            <div id="editAmountField" class="mt-4">
                <label for="editAmount" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="amount" id="editAmount" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter amount">
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Update</button>
                <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg" onclick="closeEditModal()">Cancel</button>
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

function editHead(id,employeeid,  name, type, isPercentage, percentage, amount) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmployeeId').value = employeeid;
    document.getElementById('editType').value = type;
    document.getElementById('editIsPercentage').value = isPercentage;
    document.getElementById('editPercentage').value = percentage;
    document.getElementById('editAmount').value = amount;

    // Show/hide fields based on is_percentage value
    toggleEditFields();

    document.getElementById('editModal').classList.remove('hidden');
}

function toggleEditFields() {
    const isPercentage = document.getElementById('editIsPercentage').value;
    document.getElementById('editPercentageField').classList.toggle('hidden', isPercentage == 0);
    document.getElementById('editAmountField').classList.toggle('hidden', isPercentage == 1);
}
function toggleFields() {
    const isPercentage = document.getElementById('is_percentage').value;
    document.getElementById('percentageField').classList.toggle('hidden', isPercentage == 0);
    document.getElementById('amountField').classList.toggle('hidden', isPercentage == 1);
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function deleteHead(id) {
    if (confirm('Are you sure you want to delete this record?')) {
        fetch('<?php echo base_url("managepayroll/delete_head"); ?>/' + id, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to delete record.');
            }
        });
    }
}
</script>
