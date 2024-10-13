<div class="container mx-auto">

 <!-- Display the card with user's parking slot details -->
 <?php if (!empty($user_slot)) : ?>
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8 mt-4">
            <h3 class="text-2xl font-bold mb-4">Your Parking Slot Details</h3>
            <div class="mb-4">
                <p><strong>Name:</strong> <?php echo $user_slot['name']; ?></p>
                
                <p><strong>Parking ID:</strong> <?php echo $user_slot['slot_id']; ?></p>
                <p><strong>Vehicle Type:</strong> <?php echo ucfirst($user_slot['vehicle_type']); ?></p>
                <p><strong>Date:</strong> <?php echo date('Y-m-d', strtotime($user_slot['created_at'])); ?></p>
            </div>
            <div class="text-right">
                <a href="<?php echo site_url('Parking/download_pdf/' . $user_slot['slot_id']); ?>" class="blue-bg text-white px-4 py-2 rounded-lg ">
                    Download as PDF
                </a>
            </div>
        </div>
    <?php else : ?>
        <p class="text-gray-500">No parking slot details available.</p>
    <?php endif; ?>


    <h2 class="text-3xl font-bold text-center my-4">Parking Slots</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <?php foreach ($slots as $slot): ?>
            <div class="relative p-4 rounded-lg shadow-md 
    <?php echo $slot['occupied'] ? 'bg-red-300 cursor-block' : 'bg-green-300 cursor-pointer'; ?>"
    onclick="<?php echo $slot['occupied'] ? '' : 'openParkingModal(' . $slot['slot_id'] . ')'; ?>"
    data-slot-id="<?php echo $slot['slot_id']; ?>"
    data-user-id="<?php echo isset($slot['user_id']) ? $slot['user_id'] : ''; ?>">
    <div class="text-center">
        <h5 class="text-xl font-bold"><?php echo $slot['slot_name']; ?></h5>
        <p class="mt-2">ID: <?php echo $slot['slot_id']; ?></p>
        <?php if ($slot['occupied']): ?>
            <p class="mt-2 text-red-500">Occupied</p>
        <?php else: ?>
            <p class="mt-2 text-green-500">Available</p>
        <?php endif; ?>
    </div>
    <?php if ($slot['occupied'] && isset($slot['user_id'])): ?>
        <div class="absolute top-100 right-100 mt-2 mr-2 hover-tooltip">
            <div class="tooltip">
                <p><strong>User ID:</strong> <?php echo $slot['user_id']; ?></p>
                <?php if ($slot['vehicle_type'] == 'car'): ?>
                                <img src="<?php echo base_url('assets/images/car.png'); ?>" alt="Car">
                            <?php elseif ($slot['vehicle_type'] == 'bike'): ?>
                                <img src="<?php echo base_url('assets/images/bike.png'); ?>" alt="Bike">
                            <?php endif; ?>
            </div>
            
        </div>
    <?php endif; ?>
</div>

        <?php endforeach; ?>
    </div>

    <!-- Container for pending requests -->
    <?php if (!empty($pending_requests)): ?>
        <div class="mt-8">
            <h3 class="text-2xl font-bold text-center mb-4">Pending Parking Requests</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php foreach ($pending_requests as $request): ?>
                    <div class="p-4 pending-request rounded-lg shadow-lg blue-border">
                        
                        <p><strong>Request ID:</strong> <?php echo $request['id']; ?></p>
                        <p><strong>At:</strong> <?php echo date('Y-m-d H:i:s', strtotime($request['created_at'])); ?></p>
                        <p><strong>Vehicle Type:</strong> <?php echo $request['vehicle_type']; ?></p>
                        <p><strong>Vehicle Number:</strong> <?php echo $request['vehicle_number']; ?></p>
                        <p><strong>Status:</strong> <span class="<?php echo getStatusColorClass($request['status']); ?>"><?php echo $request['status']; ?></span></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal -->
<div id="parkingModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 hidden">
    <div class="modal-container bg-white w-1/2 mx-auto rounded-lg mt-20 p-4">
        <h3 class="text-2xl font-bold text-center mb-4">Parking Request</h3>
        <form id="parkingForm" action="<?php echo site_url('parking/send_request'); ?>" method="post">
            <input type="hidden" id="slot_id" name="slot_id">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="form-input rounded-md w-full" value="<?php echo $this->session->userdata("username");?>" readonly>
            </div>
            <div class="mb-4">
                <label for="vehicle_type" class="block text-sm font-medium text-gray-700">Vehicle Type</label>
                <select id="vehicle_type" name="vehicle_type" class="form-select rounded-md w-full">
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="vehicle_number" class="block text-sm font-medium text-gray-700">Vehicle Number</label>
                <input type="text" id="vehicle_number" name="vehicle_number" class="form-input rounded-md w-full">
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openParkingModal(slotId) {
    // Set the slot ID in the hidden input field of the modal
    document.getElementById('slot_id').value = slotId;
    
    // Display the modal
    document.getElementById('parkingModal').classList.remove('hidden');
}

// Event listener to close the modal if needed (e.g., clicking outside the modal)
document.getElementById('parkingModal').addEventListener('click', function(event) {
    if (event.target === this) {
        this.classList.add('hidden');
    }
});

 document.querySelectorAll('.relative').forEach(slot => {
    slot.addEventListener('mouseover', () => {
        const tooltip = slot.querySelector('.tooltip');
        if (tooltip) {
            tooltip.style.display = 'block';
        }
    });

    slot.addEventListener('mouseleave', () => {
        const tooltip = slot.querySelector('.tooltip');
        if (tooltip) {
            tooltip.style.display = 'none';
        }
    });
});


</script>

<style>
    .tooltip {
    display: none;
    position: absolute;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 4px;
    padding: 5px;
    z-index: 10;
    white-space: nowrap;
}

.hover-tooltip:hover .tooltip {
    display: block;
}

</style>
