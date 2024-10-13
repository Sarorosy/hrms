
<div class="bg-gray-100 rounded-lg p-6 mt-6 mx-auto max-w-3xl border-t-4 border-blue-500">
    <h2 class="text-2xl font-bold mb-4">Create Notice</h2>

    <?php echo form_open('Admin/save_notice'); ?>
    
    <div class="mb-4">
        <label for="notice" class="block text-sm font-medium text-gray-700">Notice:</label>
        <textarea id="notice" name="notice" class="mt-1 block w-full p-2 border border-gray-300 rounded-md h-48"></textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Notice</button>
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

<div class="bg-gray-100 rounded-lg p-6 mt-6 mx-auto max-w-3xl">
    <h2 class="text-2xl font-bold mb-4">Notices List</h2>

    <?php if (!empty($notices)) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($notices as $notice) : ?>
                <div class="border border-gray-300 p-4 rounded-lg bg-white w-full">
                    <p class="text-gray-600 text-sm mb-2"><?php echo date('M d, Y', strtotime($notice['created_at'])); ?></p>
                    <p class="text-lg font-semibold mb-2"><?php echo (strlen($notice['notice']) > 150) ? substr($notice['notice'], 0, 150) . '...' : $notice['notice']; ?></p>
                    <div class="flex justify-end icons-box">
                        <a href="<?php echo base_url('admin/view_notice/' . $notice['id']); ?>" class="text-blue-500 hover:text-blue-700 mr-2">
                        <i class="fa fa-eye" id="eye" aria-hidden="true"></i>
                        </a>
                        <a href="<?php echo base_url('admin/edit_notice/' . $notice['id']); ?>" class="text-green-500 hover:text-green-700 mr-2">
                        <i class="fas fa-pen" id="edit"></i>
                        </a>
                        <a href="<?php echo base_url('admin/delete_notice/' . $notice['id']); ?>" class="text-red-500 hover:text-red-700">
                        <i class="fa fa-trash" id="trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>No notices found.</p>
    <?php endif; ?>
</div>
