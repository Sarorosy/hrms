<!-- application/views/payroll/index.php -->

<div class="container mx-auto p-4">
    <!-- Header with Buttons -->
    <div class="flex justify-between items-center mb-6 bg-white py-2 px-1 rounded-lg">
        <h2 class="text-2xl font-bold">Payroll Management</h2>
        <div>
            <!-- Button to view Common Heads -->
            <button onclick="window.location.href='<?php echo base_url('managepayroll/common_heads'); ?>'" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-blue-600">
                View Common Heads
            </button>
            
            <!-- Button to view Private Heads -->
            <button onclick="window.location.href='<?php echo base_url('managepayroll/private_heads'); ?>'" 
                    class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                View Private Heads
            </button>
        </div>
    </div>
    
    <div class="flex justify-between items-center flex-wrap">
        <h2 class="text-2xl font-bold mb-4">Employee List</h2>
    </div>
    <div class="bg-white overflow-x-auto shadow-md rounded-lg px-2">
        <table class="min-w-full bg-white"id="employees">
            <thead>
                <tr>
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
                <?php foreach ($admins as $admin) : ?>
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <img src="<?php echo base_url('uploads/userdetailuploads/'.get_profile_pic_by_id($admin['id'])) ?>" alt="profile" class="w-10 rounded-full">
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $admin['name']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $admin['username']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $admin['email']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 <?php echo ($admin['status'] == 'active') ? 'text-green-500' : 'text-red-500'; ?>">
                            <?php echo $admin['status']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $admin['role']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 ">
                            <a href="<?php echo base_url('manage-payroll/add/' . base64_encode($admin['id'])); ?>" class="text-blue-900 hover:text-blue-700 flex items-center bg-blue-100 p-2 rounded"> 
                            <i class="fas fa-money-bill-wave mr-2"></i>
                            manage
                            </a>
                             <a href="<?php echo base_url('manage-payroll/view_all_payslips/' . base64_encode($admin['id'])); ?>" class="text-blue-800 hover:text-blue-700 flex items-center mt-2 bg-blue-100 p-2 rounded"> 
                            <i class="fas fa-eye mr-2"></i>
                            View
                            </a>

                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    
</script>