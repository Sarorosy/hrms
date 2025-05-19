<div class="container mx-auto p-4 bg-white mt-2">
    <div class="flex justify-between items-center mb-4">
        <button onclick="window.history.back()" class="bg-red-700 text-white px-4 py-2 rounded-lg">Back</button>
        <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add Heads</button>
    </div>

    <h2 class="text-2xl font-bold mb-4">Common Heads</h2>
    <table class="table-auto w-full mb-4" id="commonHeads">
        <thead class="blue-bg text-white">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Percentage</th>
                <th class="px-4 py-2">Created at</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($common_heads as $head): ?>
                <tr>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($head['name']); ?></td>
                    <td class="border px-4 py-2"><?php echo ucfirst($head['type']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($head['amount']); ?></td>
                    <td class="border px-4 py-2"><?php echo htmlspecialchars($head['percentage']); ?></td>
                    <td class="border px-4 py-2"><?php echo strdate($head['created_at']); ?></td>
                    <td class="border px-4 py-2">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded-lg" onclick="editHead(<?php echo $head['id']; ?>, '<?php echo htmlspecialchars($head['name']); ?>', '<?php echo htmlspecialchars($head['type']); ?>', <?php echo $head['is_percentage']; ?>, <?php echo $head['percentage'] ?: 0; ?>, <?php echo $head['amount'] ?: 0; ?>)">Edit</button>
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
        <form method="post" action="<?php echo base_url('managepayroll/add_common_bonus_deduction'); ?>">
            <input type="hidden" name="redirect_url" value="<?php echo base_url(uri_string()); ?>">
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
        <form id="editForm" method="post" action="<?php echo base_url('managepayroll/edit_common_bonus_deduction'); ?>">
            <input type="hidden" name="redirect_url" value="<?php echo base_url(uri_string()); ?>">
            <input type="hidden" name="id" id="editId" value="">
            <div class="mt-4">
                <label for="editName" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="editName" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter Name">
            </div>

            <label for="editType" class="block text-sm font-medium text-gray-700 mt-4">Type</label>
            <select name="type" id="editType" class="w-full mt-1 p-2 border rounded-lg">
                <option value="allowance">Allowance</option>
                <option value="deduction">Deduction</option>
                <option value="bonus">Bonus</option>
            </select>

            <label for="editIsPercentage" class="block text-sm font-medium text-gray-700 mt-4">Is Percentage?</label>
            <select name="is_percentage" id="editIsPercentage" class="w-full mt-1 p-2 border rounded-lg" onchange="toggleEditFields()">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>

            <div id="editPercentageField" class="hidden mt-4">
                <label for="editPercentage" class="block text-sm font-medium text-gray-700">Percentage</label>
                <input type="number" name="percentage" id="editPercentage" class="w-full mt-1 p-2 border rounded-lg" placeholder="Enter percentage" step="0.01">
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

function editHead(id, name, type, isPercentage, percentage, amount) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editType').value = type;
    document.getElementById('editIsPercentage').value = isPercentage;
    document.getElementById('editPercentage').value = percentage;
    document.getElementById('editAmount').value = amount;

    toggleEditFields();

    document.getElementById('editModal').classList.remove('hidden');
}

function toggleFields() {
    const isPercentage = document.getElementById('is_percentage').value;
    document.getElementById('percentageField').classList.toggle('hidden', isPercentage == 0);
    document.getElementById('amountField').classList.toggle('hidden', isPercentage == 1);
}

function toggleEditFields() {
    const isPercentageSelect = document.getElementById('editIsPercentage').value;
    const percentageField = document.getElementById('editPercentageField');
    const amountField = document.getElementById('editAmountField');

    if (isPercentageSelect == '1') {
        percentageField.classList.remove('hidden'); // Show percentage field
        amountField.classList.add('hidden'); // Hide amount field
    } else {
        percentageField.classList.add('hidden'); // Hide percentage field
        amountField.classList.remove('hidden'); // Show amount field
    }
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function deleteHead(id) {
    if (confirm("Are you sure you want to delete this head?")) {
        window.location.href = "<?php echo base_url('managepayroll/delete_common_bonus_deduction/'); ?>" + id;
    }
}
</script>

