<div class="container mx-auto mt-5">
    <h2 class="text-3xl font-semibold mb-4">Your Rewards</h2>

    <?php if (!empty($rewards)): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($rewards as $reward): ?>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-xl font-bold"><?php echo htmlspecialchars($reward['subject']); ?></h3>
                    <p class="text-gray-700"><?php echo htmlspecialchars($reward['description']); ?></p>
                    <?php if (!empty($reward['image'])): ?>
                        <img src="<?php echo base_url('uploads/rewardsimages/'.$reward['image']); ?>" alt="Reward Image" class="mt-2 rounded-lg" />
                    <?php endif; ?>
                    <p class="text-gray-500 mt-2"><?php echo date('F j, Y, g:i a', strtotime($reward['created_at'])); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg p-6 mt-4 shadow-lg flex items-start">
    <div class="mr-4 text-4xl">
        <span role="img" aria-label="sad emoji">☹️</span>
    </div>
    <div>
        <h3 class="font-bold text-xl">No Rewards Found</h3>
        <p class="mt-2">Rewards are calculated based on daily attendance, working hours, manager feedback, etc.</p>
        <h4 class="mt-4 font-medium text-gray-800">🌟 Keep pushing! Here are some recommendations to earn rewards:</h4>
        <ul class="list-disc list-inside mt-2 text-gray-700">
            <li>Manage your daily attendance</li>
            <li>Log in on time consistently</li>
            <li>Avoid late comes</li>
            <li>Avoid frequent leaves</li>
            <li>Complete your tasks on time</li>
            <li>Seek feedback from your manager</li>
            <li>Stay focused and motivated!</li>
        </ul>
    </div>
</div>

    <?php endif; ?>
</div>