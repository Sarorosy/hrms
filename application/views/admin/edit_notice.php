<!-- application/views/admin/edit_notice.php -->

<div class="bg-gray-100 rounded-lg p-6 mt-6 mx-auto max-w-3xl">
    <h2 class="text-2xl font-bold mb-4">Edit Notice</h2>

    <?php echo form_open('admin/update_notice/' . $notice['id']); ?>
    
    <div class="mb-4">
        <label for="notice" class="block text-sm font-medium text-gray-700">Notice:</label>
        <textarea id="notice" name="notice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md h-48"><?php echo $notice['notice']; ?></textarea>
        <?php echo form_error('notice', '<p class="text-red-500 text-sm mt-1">', '</p>'); ?>
    </div>

    <div class="text-center">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Notice</button>
    </div>

    <?php echo form_close(); ?>
</div>

<!-- Include TinyMCE script with your API key -->
<script src="https://cdn.tiny.cloud/1/2crkajrj0p3qpzebc7qfndt5c6xoy8vwer3qt5hsqqyv8hb8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    // Initialize TinyMCE
    tinymce.init({
        selector: '#notice',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor',
        toolbar_mode: 'floating',
        height: 400,
        setup: function (editor) {
            editor.on('Change', function () {
                editor.save();
            });
        }
    });
</script>
