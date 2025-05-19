<!-- application/views/admin/positions_view.php -->

<div class="container mx-auto p-4">
    <div class="flex justify-between items-center flex-wrap">
        <h2 class="text-2xl font-bold mb-4">Position List</h2>
        <a href="<?php echo base_url('Positions/create_position_form') ?>" class="blue-bg text-white font-bold py-2 px-4 rounded inline-block mb-2">Add Position</a>
    </div>
    <div class="bg-white overflow-x-auto shadow-md rounded-lg px-2">
        <table class="min-w-full bg-white" id="positions">
            <thead>
                <tr>
                   
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                   
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($positions as $position) : ?>
                    <tr class="hover:bg-gray-100">
                        
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $position['name']; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                            <?php echo $position['description']; ?>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300 flex space-x-2 flex-col justify-center items-center">
                            <a href="<?php echo base_url('Positions/edit_position/' . $position['id']); ?>" class="text-green-500 hover:text-green-700">Edit</a>
                            <a href="<?php echo base_url('Positions/delete_position/' . $position['id']); ?>" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this position?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
