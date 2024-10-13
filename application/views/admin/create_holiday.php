<!-- application/views/admin/create_holiday_form.php -->

<div class="bg-gray-100 rounded-lg p-6 mt-6 mx-auto max-w-3xl">
    <h2 class="text-2xl font-bold mb-4">Add Holiday</h2>

    <?php echo form_open('Admin/save_holiday'); ?>
    
    <div class="mb-4">
        <label for="holiday_title" class="block text-sm font-medium text-gray-700">Holiday Title:</label>
        <input type="text" id="holiday_title" name="holiday_title" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
    </div>

    <div class="mb-4">
        <label for="holiday_date" class="block text-sm font-medium text-gray-700">Holiday Date:</label>
        <input type="date" id="holiday_date" name="holiday_date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
    </div>

    <div class="text-center">
        <button type="submit" class="blue-bg text-white font-bold py-2 px-4 rounded">Save Holiday</button>
    </div>

    <?php echo form_close(); ?>
</div>
