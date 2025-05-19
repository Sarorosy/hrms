<!-- notes/edit.php -->
<div class="container mx-auto p-5">
    <h1 class="text-3xl font-bold mb-5">Edit Note</h1>
    <form action="<?php echo base_url('notes/edit/' .base64_encode( $note['id'])); ?>" method="post" class="bg-white p-5 rounded shadow-md">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $note['name']; ?>" class="w-full px-3 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="w-full px-3 py-2 border rounded" required><?php echo $note['description']; ?></textarea>
        </div>
        <div class="mb-4">
            <label for="remind" class="block text-gray-700">Remind</label>
            <select name="remind" id="remind" class="w-full px-3 py-2 border rounded">
                <option value="no" <?php echo ($note['remind'] == 'no') ? 'selected' : ''; ?>>No</option>
                <option value="yes" <?php echo ($note['remind'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="datetime" class="block text-gray-700">Reminder Date and Time</label>
            <input type="datetime-local" name="datetime" id="datetime" value="<?php echo $note['datetime']; ?>" class="w-full px-3 py-2 border rounded">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Changes</button>
    </form>
</div>
