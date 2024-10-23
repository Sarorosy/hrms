<div class="rounded-lg border bg-white text-card-foreground shadow-sm p-6">
<div class="flex items-center mb-4">
        <?php if (!empty($employee['profile_picture'])): ?>
            <img src="<?php echo base_url('uploads/userdetailuploads/' . $employee['profile_picture']); ?>" alt="Profile Picture" class="w-16 h-16 rounded-full mr-4">
        <?php else: ?>
            <img src="<?php echo base_url('uploads/userdetailuploads/default-avatar.png'); ?>" alt="Default Profile Picture" class="w-16 h-16 rounded-full mr-4">
        <?php endif; ?>
        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">
            Give Reward to <?php echo $employee['name']; ?>
        </h3>
    </div>
    <form action="<?php echo base_url('Employees/give_rewards/' . $employee_id); ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="subject" class="block text-sm font-medium text-gray-700">Subject:</label>
            <input type="text" id="subject" name="subject" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Reward Image (Optional):</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <button type="submit" name="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Send Reward</button>
        </div>
    </form>
</div>
