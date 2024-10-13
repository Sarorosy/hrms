<?php if ($this->session->userdata('admin_type') == 'SUPERADMIN') { ?>
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Edit Employee Details</h2>

    <div class="bg-white overflow-hidden shadow-md rounded-lg p-4">
        <!-- Form for editing employee details -->
        <form action="<?php echo base_url('Employees/update_employee/' . $employee['id']); ?>" method="post">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $employee['email']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                <input type="text" id="status" name="status" value="<?php echo $employee['status']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                <input type="text" id="role" name="role" value="<?php echo $employee['role']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="manager_id" class="block text-sm font-medium text-gray-700">Manager:</label>
                <select id="manager_id" name="manager_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <?php foreach ($admins as $admin): ?>
                        <option value="<?php echo $admin['id']; ?>"><?php echo $admin['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- <div class="mb-4">
                <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $employee['department']; ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div> -->

            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Employee</button>
            </div>
        </form>
    </div>
</div>
<?php } else {
    redirect(base_url());
} ?>
