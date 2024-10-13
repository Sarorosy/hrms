<!-- application/views/reject_reason_form.php -->

<div class="p-4 bg-white shadow-md rounded">
    <h2 class="text-lg font-bold mb-4">Reject Reason</h2>
    <?php echo form_open('Manageleave/process_reject_leave'); ?>
        <input type="hidden" name="leave_id" value="<?php echo $leave_id; ?>">
        <div class="mb-4">
            <label for="reject_reason" class="block text-gray-700 font-bold mb-2">Reason for Rejection</label>
            <textarea name="reject_reason" id="reject_reason" rows="4" class="w-full p-2 border border-gray-300 rounded" placeholder="Provide a reason for rejecting the leave request" required></textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Reject</button>
        </div>
    <?php echo form_close(); ?>
</div>
