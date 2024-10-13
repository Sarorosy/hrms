<style>
    /* Custom CSS for styling the tabs */
    .tab-list {
        display: flex;
        margin-bottom: 6px;
        border-bottom: 2px solid #ccc; /* default border color */
    }

    .tab-item {
        flex: 1;
        margin-right: 1px; /* Adjust spacing between tabs */
    }

    .tab-link {
        display: block;
        text-align: center;
        padding: 10px 0;
        background-color: #fff; /* Background color */
        color: #666; /* Default text color */
        border-bottom: 2px solid transparent; /* Bottom border */
        text-decoration: none; /* Remove underline from links */
        cursor: pointer;
    }

    .tab-link.active {
        color: #000034; /* Active text color */
        border-bottom-color: #000034; /* Active border color */
    }
</style>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 p-6">
    <div class="blue-bg text-white p-4 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold mb-2 text-center"><i class="fas fa-calendar-check"></i>Annual Leave</h3>
        <div class="flex items-center justify-center gap-2">
            <div class="text-4xl font-bold">25</div>
            <div class="text-sm text-gray-300">days</div>
        </div>
    </div>
    <div class="blue-bg text-white p-4 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold mb-2 text-center"><i class="fas fa-thermometer-full"></i>Sick Leave</h3>
        <div class="flex items-center justify-center gap-2">
            <div class="text-4xl font-bold">14</div>
            <div class="text-sm text-gray-300">days</div>
        </div>
    </div>
    <div class="blue-bg text-white p-4 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold mb-2 text-center"><i class="fas fa-baby-carriage"></i>Maternity Leave</h3>
        <div class="flex items-center justify-center gap-2">
            <div class="text-4xl font-bold">60</div>
            <div class="text-sm text-gray-300">days</div>
        </div>
    </div>
    <div class="blue-bg text-white p-4 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold mb-2 text-center flex"><svg viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.cls-1{fill:none;stroke:#ffffff;stroke-miterlimit:10;stroke-width:1.91px;}</style></defs><circle class="cls-1" cx="8.66" cy="15.34" r="7.16"></circle><circle class="cls-1" cx="16.3" cy="12.48" r="6.2"></circle><polygon class="cls-1" points="16.77 6.27 15.82 6.27 12.96 3.41 13.91 1.5 18.68 1.5 19.64 3.41 16.77 6.27"></polygon></g></svg>Wedding Leave</h3>
        <div class="flex items-center justify-center gap-2">
            <div class="text-4xl font-bold">5</div>
            <div class="text-sm text-gray-300">days</div>
        </div>
    </div>
</div>

<div class="flex justify-center mt-10">
    <div class="w-full max-w-xl bg-white shadow-md rounded-lg p-6">
        <ul class="tab-list">
            <li class="tab-item">
                <a href="#" id="singleDayTab" class="tab-link text-blue-500 font-bold">Single Day</a>
            </li>
            <li class="tab-item">
                <a href="#" id="multiDayTab" class="tab-link text-gray-400">Multi-Day</a>
            </li>
        </ul>
        <div id="singleDayForm">
            <div class="my-10 text-center">
            <h2 class="text-2xl font-bold mb-2"><i class="fas fa-calendar-day"></i> Apply for Single Day Leave</h2>
            <p class="text-gray-600">Fill out the form to request time off for a single day.</p>
            </div>
            <?php if($this->session->flashdata('success_single_day')): ?>
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded"><?php echo $this->session->flashdata('success_single_day'); ?></div>
            <?php elseif($this->session->flashdata('error_single_day')): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded"><?php echo $this->session->flashdata('error_single_day'); ?></div>
            <?php endif; ?>
            <?php echo form_open('ManageLeave/apply_leave'); ?>
                <input type="hidden" name="leave_type_duration" value="single_day">
                <div class="w-full flex items-center justify-between">
                <div class="mb-4 w-3/5 mx-2">
                    <label for="leave_type" class="block text-gray-700 font-bold mb-2">Leave Type</label>
                    <select name="leave_type_select" id="leave_type" class="w-full p-2 border border-gray-300 rounded">
                        <option value="">Select leave type</option>
                        <option value="vacation">Vacation</option>
                        <option value="sick">Sick</option>
                        <option value="personal">Personal</option>
                        <option value="family">Family</option>
                    </select>
                    <?php echo form_error('leave_type_select', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                </div>
                <div class="mb-4 w-2/5 mx-2">
                    <label for="start_date" class="block text-gray-700 font-bold mb-2">Date</label>
                    <input type="date" name="start_date" id="start_date_single" class="w-full p-2 border border-gray-300 rounded" value="<?php echo set_value('start_date'); ?>">
                    <?php echo form_error('start_date', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                </div>
                <input type="hidden" name="end_date" id="end_date_single" value="">
                </div>
                <div class="mb-4">
                    <label for="leave_reason" class="block text-gray-700 font-bold mb-2">Leave Reason</label>
                    <textarea name="leave_reason" id="leave_reason_single" class="w-full p-2 border border-gray-300 rounded" placeholder="Provide a reason for your leave"><?php echo set_value('leave_reason'); ?></textarea>
                    <?php echo form_error('leave_reason', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="blue-bg text-white px-4 py-2 rounded">Submit</button>
                </div>
            <?php echo form_close(); ?>
        </div>

        <div id="multiDayForm" style="display: none;">
            <div class="my-10 text-center">
            <h2 class="text-2xl font-bold mb-2"><i class="fas fa-calendar-alt"></i> Apply for Multi-Day Leave</h2>
            <p class="text-gray-600">Fill out the form to request time off for multiple days.</p>
            </div>
            <?php if($this->session->flashdata('success_multi_day')): ?>
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded"><?php echo $this->session->flashdata('success_multi_day'); ?></div>
            <?php elseif($this->session->flashdata('error_multi_day')): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded"><?php echo $this->session->flashdata('error_multi_day'); ?></div>
            <?php endif; ?>
            <?php echo form_open('ManageLeave/apply_leave'); ?>
                <input type="hidden" name="leave_type_duration" value="multi_days">
                <div class="mb-4">
                    <label for="leave_type" class="block text-gray-700 font-bold mb-2">Leave Type</label>
                    <select name="leave_type_select" id="leave_type" class="w-full p-2 border border-gray-300 rounded">
                        <option value="">Select leave type</option>
                        <option value="vacation">Vacation</option>
                        <option value="sick">Sick</option>
                        <option value="personal">Personal</option>
                        <option value="family">Family</option>
                    </select>
                    <?php echo form_error('leave_type_select', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                </div>
                <div class="flex w-full items-center justify-between">
                <div class="mb-4 w-1/2 mx-2">
                    <label for="start_date" class="block text-gray-700 font-bold mb-2">Start Date</label>
                    <input type="date" name="start_date" id="start_date_multi" class="w-full p-2 border border-gray-300 rounded" value="<?php echo set_value('start_date'); ?>">
                    <?php echo form_error('start_date', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                </div>
                <div class="mb-4 w-1/2 mx-2">
                    <label for="end_date" class="block text-gray-700 font-bold mb-2">End Date</label>
                    <input type="date" name="end_date" id="end_date_multi" class="w-full p-2 border border-gray-300 rounded" value="<?php echo set_value('end_date'); ?>">
                    <?php echo form_error('end_date', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                </div>
                </div>
                <div class="mb-4">
                    <label for="leave_reason" class="block text-gray-700 font-bold mb-2">Leave Reason</label>
                    <textarea name="leave_reason" id="leave_reason_multi" class="w-full p-2 border border-gray-300 rounded" placeholder="Provide a reason for your leave"><?php echo set_value('leave_reason'); ?></textarea>
                    <?php echo form_error('leave_reason', '<div class="text-red-500 text-sm mt-1">', '</div>'); ?>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="blue-bg text-white px-4 py-2 rounded">Submit</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Show single day form by default
        $('#singleDayForm').show();
        
        // Handle tab clicks
        $('.tab-link').click(function(e) {
            e.preventDefault();
            $('.tab-link').removeClass('active');
            $(this).addClass('active');

            // Show corresponding form
            var tabId = $(this).attr('id');
            if (tabId === 'singleDayTab') {
                $('#singleDayForm').show();
                $('#multiDayForm').hide();
            } else if (tabId === 'multiDayTab') {
                $('#singleDayForm').hide();
                $('#multiDayForm').show();
            }
        });
    });

    document.getElementById('start_date_single').addEventListener('change', function() {
        document.getElementById('end_date_single').value = this.value;
    });
</script>
