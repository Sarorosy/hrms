<!-- application/views/view_leave_request.php -->

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
<?php if ($this->session->flashdata('message')): ?>
    <script>
      $(document).ready(function() {
        toastr.success("<?php echo $this->session->flashdata('message'); ?>", "Success", {
          closeButton: true,
          progressBar: true,
          timeOut: 3000 // Duration in milliseconds
        });
      });
    </script>
  <?php endif; ?>

<div class="container mx-auto mt-10 w-fit bg-white rounded-xl px-2">
    <h2 class="text-3xl font-bold mb-6">Leave Requests</h2>

    <?php if (!empty($leaves)): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg" id="leaverequests">
                <thead class="blue-bg text-white">
                    <tr class=" border-b border-gray-200">
                        <th class="p-4 text-left font-bold">ID</th>
                        <th class="p-4 text-left font-bold">Name</th>
                        <th class="p-4 text-left font-bold">Leave Type</th>
                        <th class="p-4 text-left font-bold">Pay Type</th>
                        <th class="p-4 text-left font-bold">Leave Reason</th>
                        <th class="p-4 text-left font-bold"><i class="fas fa-quote-left blue-text"></i>From</th>
                        <th class="p-4 text-left font-bold">To<i class="fas fa-quote-right blue-text"></i></th>
                        <th class="p-4 text-left font-bold">Status</th>
                        <th class="p-4 text-left font-bold">Requested At</th>
                        <th class="p-4 text-left font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leaves as $leave): ?>
                        <tr class="border-b border-gray-200">
                            <td class="p-4 text-gray-600"><?php echo $leave['id']; ?></td>
                            <td class="p-4 text-gray-600"><?php echo getAdminNameById($leave['user_id'])?></td>

                            <td class="p-4 text-gray-600"><?php echo $leave['leave_type']; ?></td>
                            <td class="p-4 text-gray-600"><?php echo $leave['leave_pay_type']; ?></td>
                            <td class="p-4 text-gray-600"><?php echo $leave['leave_reason']; ?></td>
                            <td class="p-4 text-gray-600"><?php echo strdate($leave['start_date']); ?></td>
                            <td class="p-4 text-gray-600"><?php echo (!empty($leave['end_date'])) ? strdate( $leave['end_date']) : NULL ?></td>
                            <td class="p-4 <?php echo getStatusColorClass($leave['status']); ?>">
                            <h4 class="<?php echo $leave['status'] == 'Rejected' ? 'text-red-600' : ($leave['status'] == 'Approved' ? 'text-green-600' : 'text-yellow-700'); ?>">
                                <?php echo $leave['status']; ?>
                            </h4>

                                <?php if ($leave['status'] == 'Rejected' && isset($leave['reject_reason'])) : ?>
                                    <div class="tooltip">
                                        <i class="fas fa-question-circle text-blue-500 cursor-pointer"></i>
                                        <span class="tooltiptext"><?php echo htmlspecialchars($leave['reject_reason']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 text-gray-600"><?php echo date('d F Y', strtotime($leave['created_at'])); ?></td>
                            <td class="p-4">
                                <?php if ($leave['status'] == 'Pending'): ?>
                                   <div class="flex flex-column">
                                   <a href="<?php echo base_url('Manageleave/approve_leave/'.$leave['id']); ?>" class="blue-bg text-white px-4 py-1 rounded">Approve</a>
                                   <a href="<?php echo base_url('Manageleave/reject_leave/'.$leave['id']); ?>" class="bg-red-700 text-white px-4 py-1 rounded hover:bg-red-800 ml-2 ">Reject</a>
                                   </div>
                                <?php endif; ?>
                                <?php if ($leave['status'] == 'Rejected' && isset($leave['reject_reason'])) : ?>
                                    <div class="mt-2">
                                        <span class="font-bold text-red-600">Request Rejected</span>
                                    </div>
                                <?php endif; ?>
                                <?php if ($leave['status'] == 'Approved') : ?>
                                    <div class="mt-">
                                        <span class="font-bold text-green-600">Request Approved</span>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="p-4 bg-blue-100 text-blue-700 rounded">No leave requests found.</div>
    <?php endif; ?>
</div>
