
<div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-5 text-gray-800">Asset Requests</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="mt-4 bg-green-500 text-white p-4 rounded-md"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    
    <form method="post" action="<?php echo base_url('asset/view_requests'); ?>" class="mb-5 p-6 bg-white rounded-lg shadow-md max-w-md mx-auto flex items-center space-x-4">
    <div class="flex-1">
        <label for="user_id" class="block text-gray-800 font-semibold mb-2">Select User:</label>
        <select id="user_id" name="user_id" class="select2 border border-gray-300 rounded-md p-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full">
            <option value="">All Users</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user->id; ?>" <?php echo (isset($user_id) && $user_id == $user->id) ? 'selected' : ''; ?>>
                    <?php echo $user->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 mt-4">
        Search
    </button>
</form>





    <table class="min-w-full mt-5 bg-white border border-gray-300 rounded-md shadow-md" id="viewrequests">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b text-left text-gray-600">Request ID</th>
                <th class="py-2 px-4 border-b text-left text-gray-600">Asset</th>
                <th class="py-2 px-4 border-b text-left text-gray-600">User</th>
                <th class="py-2 px-4 border-b text-left text-gray-600">Count</th>
                <th class="py-2 px-4 border-b text-left text-gray-600">Status</th>
                <th class="py-2 px-4 border-b text-left text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b"><?php echo $request->id; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo getAssetNameById($request->assetid); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo getAdminNameById($request->userid); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo $request->need_count; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo ucfirst($request->status); ?></td>
                    <td class="py-2 px-4 border-b">
                        <?php if ($request->status == 'pending'): ?>
                            <a href="<?php echo base_url('asset/approve_request/' . $request->id); ?>" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 transition duration-200">Approve</a>
                            <a href="<?php echo base_url('asset/reject_request/' . $request->id); ?>" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-200">Reject</a>
                        <?php endif; ?>
                        <a href="<?php echo base_url('asset/delete_request/' . $request->id); ?>" class="bg-gray-500 text-white px-3 py-1 rounded-md hover:bg-gray-600 transition duration-200">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- Include Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#user_id').select2({
            placeholder: 'Select User', // Placeholder text
            allowClear: true // Allow clearing the selection
        });

        // Submit the form on change
        $('#user_id').on('change', function() {
            $(this).closest('form').submit(); // Submit the form
        });
    });
</script>

