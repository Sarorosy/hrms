<div class="bg-gray-100 rounded-lg p-6 mt-6 mx-auto max-w-3xl">
    <h2 class="text-2xl font-bold mb-4">Create an Event</h2>

    <?php echo form_open('Admin/save_event'); ?>
    
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Event Name:</label>
        <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="<?php echo set_value('name'); ?>" required>
        <?php echo form_error('name', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
    </div>

    <div class="mb-4">
        <label for="date" class="block text-sm font-medium text-gray-700">Event Date:</label>
        <input type="date" id="date" name="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="<?php echo set_value('date'); ?>" required>
        <?php echo form_error('date', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
    </div>

    <div class="mb-4">
        <label for="event_description" class="block text-sm font-medium text-gray-700">Event Description:</label>
        <textarea id="event_description" name="event_description" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" rows="4" required><?php echo set_value('event_description'); ?></textarea>
        <?php echo form_error('event_description', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
    </div>

    <div class="flex w-full justify-around items-center">
    <div class="mb-4 w-1/2">
        <label for="time_start" class="block text-sm font-medium text-gray-700">Start Time:</label>
        <input type="time" id="time_start" name="time_start" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="<?php echo set_value('time_start'); ?>" required>
        <?php echo form_error('time_start', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
    </div>

    <div class="mb-4 w-1/2">
        <label for="time_end" class="block text-sm font-medium text-gray-700">End Time:</label>
        <input type="time" id="time_end" name="time_end" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" value="<?php echo set_value('time_end'); ?>" required>
        <?php echo form_error('time_end', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
    </div>
    </div>

    <div class="text-center">
        <button type="submit" class="blue-bg text-white font-bold py-2 px-4 rounded">Create Event</button>
    </div>

    <?php echo form_close(); ?>
</div>
