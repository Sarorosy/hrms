<!-- application/views/admin/employees_view.php -->

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center flex-wrap">
        <h2 class="text-2xl font-bold mb-4">Employee List</h2>
        <a href="<?php echo base_url('Employees/create_employee_form') ?>" class="blue-bg text-white font-bold py-2 px-4 rounded inline-block mb-2">Add Employee</a>
    </div>
    <div class="bg-white overflow-x-auto shadow-md rounded-lg px-2">
        <table class="min-w-full bg-white"id="employees">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Emp ID</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Profile</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Username</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) : ?>
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $employee['id']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <img src="<?php echo base_url('uploads/userdetailuploads/'.get_profile_pic_by_id($employee['id'])) ?>" alt="profile" class="w-10 rounded-full">
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $employee['name']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $employee['username']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $employee['email']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 <?php echo ($employee['status'] == 'active') ? 'text-green-500' : 'text-red-500'; ?>">
                            <?php echo $employee['status']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php 
                                if ($employee['role'] == "USER") {
                                    echo "Employee";
                                } elseif ($employee['role'] == "ADMIN") {
                                    echo "Manager";
                                } elseif ($employee['role'] == "HR") {
                                    echo "HR";
                                } elseif ($employee['role'] == "SUPERADMIN") {
                                    echo "Super Admin";
                                } else {
                                    echo "Unknown Role"; // Default case if role doesn't match
                                }
                            ?>
                        </td>

                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 flex space-x-2 flex-col justify-center items-center">
                            <a href="<?php echo base_url('Employees/view_employee/' . base64_encode($employee['id'])); ?>" class="text-blue-500 hover:text-blue-700">View</a>
                            <a href="<?php echo base_url('Employees/edit_employee/' . base64_encode($employee['id'])); ?>" class="text-green-500 hover:text-green-700">Edit</a>
                            <a href="<?php echo base_url('Employees/delete_employee/' . $employee['id']); ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    
</script>