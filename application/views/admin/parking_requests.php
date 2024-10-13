<div class="container mx-auto mt-5 px-4">
    <h2 class="text-3xl font-bold mb-6">Parking Requests</h2>
    <?php if (!empty($requests)) : ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="blue-bg text-white">
                    <tr>
                        <th class="py-2 px-4 border-b">User ID</th>
                        <th class="py-2 px-4 border-b">Vehicle Type</th>
                        <th class="py-2 px-4 border-b">Slot ID</th>
                        <th class="py-2 px-4 border-b">Vehicle Number</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $request) : ?>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b"><?php echo $request['user_id']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo ucfirst($request['vehicle_type']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $request['slot_id']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $request['vehicle_number']; ?></td>
                            <td class="py-2 px-4 border-b">
                                <span class="<?php echo $request['status'] === 'approved' ? 'text-green-500' : 'text-yellow-500'; ?>">
                                    <?php echo ucfirst($request['status']); ?>
                                </span>
                            </td>
                            <td class="py-2 px-4 border-b">
                                <?php if ($request['status'] == 'pending') : ?>
                                    <a href="<?php echo base_url('Parking/approve_request/' . $request['id']); ?>" class="inline-block bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                                        Approve
                                    </a>
                                <?php else : ?>
                                    <span class="text-green-500">Approved</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="text-gray-500">No parking requests found.</p>
    <?php endif; ?>
</div>
