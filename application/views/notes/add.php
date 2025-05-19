<!-- notes/add.php -->
<div class="container mx-auto p-5">
    <h1 class="text-3xl font-bold mb-5">Add New Note</h1>
    <form action="<?php echo base_url('notes/add'); ?>" method="post" class="bg-white p-5 rounded shadow-md">
        <div class="mb-4 hidden">
            <label for="employee_id" class="block text-gray-700">Employee ID</label>
            <input type="hidden" name="employee_id" id="employee_id" class="w-full px-3 py-2 border rounded" value="<?php echo $this->session->userdata("user_id") ?>">
        </div>
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="w-full px-3 py-2 border rounded" required></textarea>
        </div>
        <div class="flex w-full justify-between space-x-2 items-center">
            <div class="w-1/2 mb-2">
            <label for="remind" class="block text-gray-700">Remind</label>
            <select name="remind" id="remind" class="w-full px-3 py-2 border rounded" onchange="toggleReminderField()">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
        </div>
        <div class="w-1/2 mb-2" id="reminder-time" style="display: none;">
            <label for="datetime" class="block text-gray-700">Reminder Date and Time</label>
            <input type="datetime-local" name="datetime" id="datetime" class="w-full px-3 py-2 border rounded">
        </div>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Note</button>
    </form>
</div>

<script>
    function toggleReminderField() {
        var remind = document.getElementById("remind").value;
        var reminderTime = document.getElementById("reminder-time");
        if (remind === "yes") {
            reminderTime.style.display = "block";
        } else {
            reminderTime.style.display = "none";
        }
    }
</script>
