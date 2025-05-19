<!-- application/views/admin/edit_position_view.php -->

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Department</h2>

    <?php echo form_open('Departments/update_department/' . $department['id'], ['class' => 'w-full max-w-lg']); ?>
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Department Name</label>
            <input type="text" name="name" value="<?php echo set_value('name', $department['name']); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <?php echo form_error('name', '<p class="text-red-500 text-xs italic mt-1">', '</p>'); ?>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo set_value('description', $department['description']); ?></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="blue-bg text-white font-bold py-2 px-4 rounded  focus:outline-none focus:shadow-outline">Update Department</button>
        </div>
    <?php echo form_close(); ?>
</div>
