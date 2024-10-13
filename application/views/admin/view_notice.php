<!-- application/views/admin/view_notice.php -->

<div class="bg-gray-100 rounded-lg p-6 mt-6 mx-auto max-w-3xl">
    <h2 class="text-2xl font-bold mb-4">View Notice</h2>

    <?php if (!empty($notice)) : ?>
        <div class="border border-gray-300 p-4 rounded-lg bg-white w-full">
            <p class="text-gray-600 text-sm mb-2"><?php echo date('M d, Y', strtotime($notice['created_at'])); ?></p>
            <p class="text-lg font-semibold mb-2"><?php echo $notice['notice']; ?></p>
        </div>
    <?php else : ?>
        <p>Notice not found.</p>
    <?php endif; ?>
</div>
