<div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-5 text-gray-800">Assets</h1>
    <?php if ($this->session->userdata("admin_type") == "HR" || $this->session->userdata("admin_type") == "SUPERADMIN") { ?>
        <a href="<?php echo base_url('asset/add_asset'); ?>" class="bg-blue-600 ml-2 float-right text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
            <i class="fas fa-plus-circle mr-2"></i>Add Asset
        </a>
        <a href="<?php echo base_url('asset/view_requests'); ?>" class=" bg-blue-600 mb-2 float-right text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
            <i class="fas fa-list-alt mr-2"></i>View Requests <?php 
                        $assetcount = count_pending_asset_requests();
                        if($assetcount > 0){ ?>
                           <span class="bg-white px-2 py-1 bluetext rounded-full text-sm  "> <?php echo $assetcount; ?> </span>
                      <?php  }
                        ?>
        </a>
    <?php } ?>

    

    <table class="min-w-full mt-5 bg-white border border-gray-300 rounded-md shadow-md" id="assettable">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b text-left text-gray-600">Asset ID</th>
                <th class="py-2 px-4 border-b text-left text-gray-600">Asset Name</th>
                <?php if ($this->session->userdata("admin_type") == "HR" || $this->session->userdata("admin_type") == "SUPERADMIN") { ?>
                    <th class="py-2 px-4 border-b text-left text-gray-600">Available</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600">Vacant</th>
                <?php } ?>
                <th class="py-2 px-4 border-b text-left text-gray-600">Created At</th>
                <th class="py-2 px-4 border-b text-left text-gray-600">Asset Image</th>
                <th class="py-2 px-4 border-b text-left text-gray-600">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assets as $asset): ?>
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b"><?php echo $asset->assetid; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo $asset->assetname; ?></td>
                    <?php if ($this->session->userdata("admin_type") == "HR" || $this->session->userdata("admin_type") == "SUPERADMIN") { ?>
                        <td class="py-2 px-4 border-b"><?php echo $asset->available; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $asset->vacant; ?></td>
                    <?php } ?>
                    <td class="py-2 px-4 border-b"><?php echo strdate($asset->created_at); ?></td>
                    <td class="py-2 px-4 border-b">
                        <img src="<?php echo base_url('uploads/assetimages/' . $asset->assetimage); ?>" alt="<?php echo $asset->assetname; ?>" class="w-12 h-12 object-cover rounded">
                    </td>
                    <td class="py-2 px-4 border-b flex flex-col">
                        <?php
                        // Check if the user has requested this asset
                        $hasRequested = false;

                        // Loop through the user's requests to see if they have an existing request for this asset
                        foreach ($user_requests as $request) {
                            if ($request->assetid == $asset->assetid) {
                                if ($request->status == 'pending' || $request->status == 'approved') {
                                    $hasRequested = true; // User has a pending or approved request
                                    break;
                                } elseif ($request->status == 'rejected') {
                                    $hasRequested = false; // User can request again since it was rejected
                                }
                            }
                        }

                        // Display the button if the asset is available and vacant, and no pending or approved request exists
                        if ($asset->vacant != 0 && $asset->available > 0 && !$hasRequested && $this->session->userdata('admin_type') != "HR"): ?>
                            <button class="bg-yellow-500 text-white px-3 py-1 w-32 rounded-md hover:bg-yellow-600 transition duration-200"
                                onclick="confirmRequest('<?php echo $asset->assetid; ?>')">Request Asset
                            </button>
                        <?php else: ?>
                            <span class="text-gray-400">Requested</span> <!-- Indicate that the request is not available -->
                        <?php endif; ?>
                            <?php if($this->session->userdata("admin_type") == "HR" || $this->session->userdata("admin_type") == "SUPERADMIN") {?>
                        <div class="flex mt-2"><a href="<?php echo base_url('asset/edit_asset/' . $asset->assetid); ?>" class="w-24 bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition duration-200">Edit</a>
                        <button class=" ml-2 w-24 bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition duration-200 "
                            onclick="confirmDelete('<?php echo $asset->assetid; ?>')">Delete</button></div>
                            <?php } ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function confirmRequest(assetId) {
        const userId = <?php echo json_encode($this->session->userdata('user_id')); ?>; // Get user ID from PHP
        const quantity = prompt("Enter how many assets you want to request (minimum 1):");

        if (quantity === null) return; // User cancelled

        const count = parseInt(quantity, 10);

        if (isNaN(count) || count < 1) {
            alert("Please enter a valid number greater than or equal to 1.");
            return;
        }

        const confirmation = confirm(`Are you sure you want to request ${count} asset(s)?`);


        if (confirmation) {
            // Create a request to insert the asset request
            fetch('<?php echo base_url('asset/request_asset'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        asset_id: assetId,
                        user_id: userId,
                        need_count : count,
                        status: 'pending'
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Asset request sent successfully!");
                        location.reload(); // Reload the page to see changes
                    } else {
                        alert("Failed to send asset request: " + data.error);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert("An error occurred while sending the request.");
                });
        }
    }
</script>
<script>
    function confirmDelete(assetId) {
        const confirmation = confirm("Are you sure you want to delete this asset?");

        if (confirmation) {
            // Redirect to the delete asset controller method
            window.location.href = '<?php echo base_url('asset/delete_asset/'); ?>' + assetId;
        }
    }
</script>