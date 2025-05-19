<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        <!-- Card for Creating a Notice -->
        <div class="border border-gray-300 p-4 rounded-lg bg-white">
            <h2 class="text-lg font-semibold mb-2">Create a Announcement <i class="fas fa-newspaper"></i></h2>
            <p class="text-gray-500 my-3">create a Announcement that will display on all employees dashboard.</p>
            <a href="<?php echo base_url('Admin/create_notice_form'); ?>" class="blue-bg text-white font-bold py-2 px-4 rounded">
                Create
            </a>
        </div>
        <!-- Card for Creating Holiday -->
        <div class="border border-gray-300 p-4 rounded-lg bg-white">
            <h2 class="text-lg font-semibold mb-2">Create a Holiday <i class="fas fa-calendar-day"></i></h2>
            <p class="text-gray-500 my-3">Add a holiday to the company calendar for all employees to see.</p>
            <a href="<?php echo base_url('Admin/create_holiday_form'); ?>" class="blue-bg text-white font-bold py-2 px-4 rounded">
                Add Holiday
            </a>
        </div>
        <!-- Card for Creating an Event -->
        <div class="border border-gray-300 p-4 rounded-lg bg-white">
            <h2 class="text-lg font-semibold mb-2">Create an Event <i class="fas fa-calendar-alt"></i></h2>
            <p class="text-gray-500 my-3">Schedule an event for employees to participate in.</p>
            <a href="<?php echo base_url('Admin/create_event_form'); ?>" class="blue-bg text-white font-bold py-2 px-4 rounded">
                Create Event
            </a>
        </div>
         <!-- Card for Creating an room -->
         <div class="border border-gray-300 p-4 rounded-lg bg-white">
            <h2 class="text-lg font-semibold mb-2">Create an Room <i class="fas fa-door-open"></i></h2>
            <p class="text-gray-500 my-3">Create a new room for Managers and HR use it for meeting and other purposes.</p>
            <a href="<?php echo base_url('Rooms/add_room'); ?>" class="blue-bg text-white font-bold py-2 px-4 rounded">
                Create Room
            </a>
        </div>
        
    </div>