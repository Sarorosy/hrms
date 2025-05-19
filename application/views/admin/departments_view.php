<!-- application/views/admin/departments_view.php -->

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center flex-wrap">
        <h2 class="text-2xl font-bold mb-4">Department List</h2>
        <a href="<?php echo base_url('departments/create_department_form') ?>" class="blue-bg text-white font-bold py-2 px-4 rounded inline-block mb-2">Add Department</a>
    </div>
    <div class="bg-white overflow-x-auto shadow-md rounded-lg px-2">
        <table class="min-w-full bg-white" id="departments">
            <thead>
                <tr>
                    
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                   
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $department) : ?>
                    <tr class="hover:bg-gray-100">
                        
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $department['name']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $department['description']; ?>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 flex space-x-2 flex-col justify-center items-center">
                            <a href="<?php echo base_url('departments/edit_department/' . $department['id']); ?>" class="text-green-500 hover:text-green-700">Edit</a>
                            <a href="<?php echo base_url('departments/delete_department/' . $department['id']); ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
