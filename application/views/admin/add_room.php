<!-- add_room.php -->
<div class="flex flex-col gap-4 p-4 md:p-6">
    <h2 class="text-2xl font-semibold mb-4">Add New Room</h2>
    
    <?php if($this->session->flashdata('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline"><?php echo $this->session->flashdata('success'); ?></span>
    </div>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('error')): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline"><?php echo $this->session->flashdata('error'); ?></span>
    </div>
    <?php endif; ?>

    <form action="<?php echo site_url('rooms/add_room'); ?>" method="post" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="room_name" class="block text-sm font-medium text-gray-700">Room Name</label>
            <input type="text" id="room_name" name="room_name" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2">
        </div>

        <div>
            <label for="seat_count" class="block text-sm font-medium text-gray-700">Seat Count</label>
            <input type="number" id="seat_count" name="seat_count" required min="1" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2">
        </div>

        <div>
            <label for="room_img" class="block text-sm font-medium text-gray-700">Room Image</label>
            <input type="file" id="room_img" name="room_img" accept="image/*" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2">
        </div>

        <div>
            <button type="submit" class="blue-bg text-white px-4 py-2 rounded-md  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Add Room</button>
        </div>
    </form>
</div>
