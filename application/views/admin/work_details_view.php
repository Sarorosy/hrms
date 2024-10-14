<div class="max-w-7xl mx-auto p-8">
<h2 class="text-2xl font-bold mb-4 flex items-center">
    <?php if ($user): ?>
        <!-- Display User Name -->
         
        Work Details of 
        <!-- Display the profile picture -->
        <img src="<?= base_url('uploads/userdetailuploads/' . $user->profile_pic); ?>" 
             alt="Profile Picture of <?= $user->name ?>" 
             style="width:50px;height:50px;border-radius:50%;margin-left:10px"> <?= $user->name ?>
    <?php else: ?>
        User not found
    <?php endif; ?>
</h2>
    <?php if ($work_details): ?>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg px-2">
        <table class="min-w-full bg-white border border-gray-300 " id="workdetails">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase  leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Date</th>
                    <th class="py-3 px-6 text-left">Work Details</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm ">
                <?php foreach ($work_details as $work): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap"><?= $work->id; ?></td>
                    <td class="py-3 px-6 text-left"><?= strdate($work->date); ?></td>
                    <td class="py-3 px-6 text-left"><?= $work->work_details; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <p class="text-gray-500 text-center mt-8">No work details found for this user.</p>
    <?php endif; ?>
</div>
