<!-- book_room.php -->
<div class="flex flex-col gap-4 p-4 md:p-6">
    <h2 class="text-2xl font-semibold mb-4">Book a Room</h2>
    
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

    <form action="<?php echo site_url('Rooms/create_booking'); ?>" method="post" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2"></textarea>
        </div>

        <div>
            <label for="room_id" class="block text-sm font-medium text-gray-700">Room</label>
            <input type="hidden" id="room_id" name="room_id" required>
            <div class="flex flex-wrap gap-4">
                <?php foreach($rooms as $room): ?>
                    <label class="room-card flex flex-col items-center border border-gray-300 rounded-lg shadow-sm p-4 cursor-pointer" for="room_<?php echo $room->room_id; ?>">
                        <input type="checkbox" id="room_<?php echo $room->room_id; ?>" name="room_id" value="<?php echo $room->room_id; ?>" class="hidden room-checkbox">
                        <img src="<?php echo base_url('uploads/rooms/'.$room->room_img); ?>" alt="<?php echo $room->room_name; ?>" class="w-full h-32 object-cover mb-2">
                        <span class="text-sm font-medium text-gray-700"><?php echo $room->room_name; ?></span>
                        <span class="text-sm font-medium text-gray-700">Seat Count : <?php echo $room->seat_count; ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex w-2/3">
        <div class="w-1/3">
            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
            <input type="text" id="start_time" name="start_time" required class="flatpickr mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2">
        </div>

        <div class="w-1/3">
            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
            <input type="text" id="end_time" name="end_time" required class="flatpickr mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 p-2">
        </div>
        </div>

        <div>
            <button type="submit" class="blue-bg text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none ">Book Room</button>
        </div>
    </form>
</div>
<h2 class="text-2xl font-semibold mt-8 mb-4">Upcoming Bookings</h2>
    <div class=" flex items-center justify-start">
        <?php foreach($bookings as $booking): ?>
            <div class="bg-white p-4 rounded-lg shadow-md w-2xl blue-border ml-2">
                <h3 class="text-lg font-semibold"><?php echo $booking->title; ?></h3>
                <p class="text-sm text-gray-600"><?php echo $booking->description; ?></p>
                <p class="text-sm text-gray-600">Room: <?php echo $booking->room_name; ?></p>
                <p class="text-sm text-gray-600">Start Time: <?php echo date('Y-m-d H:i', strtotime($booking->start_time)); ?></p>
                <p class="text-sm text-gray-600">End Time: <?php echo date('Y-m-d H:i', strtotime($booking->end_time)); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.flatpickr', {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        document.querySelectorAll('.room-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                document.querySelectorAll('.room-checkbox').forEach(function(cb) {
                    cb.checked = false;
                    cb.closest('.room-card').classList.remove('blue-border');
                    cb.closest('.room-card').classList.remove('shadow-lg');
                });
                this.checked = true;
                this.closest('.room-card').classList.add('blue-border');
                this.closest('.room-card').classList.add('shadow-lg');
                document.getElementById('room_id').value = this.value;
            });
        });
    });
</script>
