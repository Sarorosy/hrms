<style>
    /* Tooltip container */
    .tooltip {
        position: relative;
        display: inline-block;
    }

    /* Tooltip text */
    .tooltip .tooltiptext {
        visibility: hidden;
        width: 200px; /* Maximum width of the tooltip */
        padding: 5px 8px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        white-space: normal; /* Ensures text wraps instead of overflow */
        word-wrap: break-word; /* Handles word wrapping */
        /* Position the tooltip text */
        position: absolute;
        z-index: 10; /* Ensure tooltip is above other elements */
        bottom: calc(100% + 5px); /* Position above the question mark */
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    /* Tooltip arrow */
    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Show the tooltip text when you mouse over the tooltip container */
    .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }
</style>

<div class="container mx-auto mt-10 w-fit bg-white rounded-xl px-2">
    <h2 class="text-3xl font-bold mb-6">Leave Summary</h2>

    <!-- Leave Summary Table -->
    <?php if (!empty($leaves)) : ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200" id="leavesummary">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leave Reason</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><i class="fas fa-quote-left blue-text"></i>From</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To<i class="fas fa-quote-right blue-text"></i></th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($leaves as $leave) : ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $leave['id']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $leave['leave_type']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $leave['leave_reason']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $leave['leave_type_duration']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo strdate($leave['start_date']); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo (!empty($leave['end_date'])) ? strdate($leave['end_date']) : NULL ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm relative text-gray-900 <?php echo getStatusColorClass($leave['status']); ?>">
                                <?php echo $leave['status']; ?>
                                <?php if ($leave['status'] == 'Rejected' && isset($leave['reject_reason'])) : ?>
                                    <div class="tooltip">
                                        <i class="fas fa-question-circle text-blue-500 cursor-pointer"></i>
                                        <span class="tooltiptext"><?php echo htmlspecialchars($leave['reject_reason']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo strdate($leave['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="p-4 bg-blue-100 text-blue-700 rounded">No leave requests found.</div>
    <?php endif; ?>
</div>
