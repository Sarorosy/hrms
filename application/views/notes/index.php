<!-- notes/index.php -->
<div class="container mx-auto p-5">
    <!-- Header with summary cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-5">
        <!-- Pending Notes Card -->
        <div class="bg-yellow-100 p-6 rounded-lg shadow-md flex flex-col items-center text-center">
            <h2 class="text-2xl font-semibold text-yellow-600">Pending Notes</h2>
            <p class="text-5xl font-bold text-yellow-700 mt-2">
                <?php echo array_reduce($notes, fn($count, $note) => $note['status'] === 'pending' ? $count + 1 : $count, 0); ?>
            </p>
        </div>

        <!-- Completed Notes Card -->
        <div class="bg-green-100 p-6 rounded-lg shadow-md flex flex-col items-center text-center">
            <h2 class="text-2xl font-semibold text-green-600">Completed Notes</h2>
            <p class="text-5xl font-bold text-green-700 mt-2">
                <?php echo array_reduce($notes, fn($count, $note) => $note['status'] === 'completed' ? $count + 1 : $count, 0); ?>
            </p>
        </div>

        <!-- Total Notes Card -->
        <div class="bg-blue-100 p-6 rounded-lg shadow-md flex flex-col items-center text-center">
            <h2 class="text-2xl font-semibold text-blue-600">Total Notes</h2>
            <p class="text-5xl font-bold text-blue-700 mt-2">
                <?php echo count($notes); ?>
            </p>
        </div>
    </div>

    <!-- Title and Add New Note Button -->
    
    <div class="text-center mb-5">
        <a href="<?php echo base_url('notes/add'); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow flex w-48 items-center float-right"><i class="fas fa-plus-circle mr-2"></i> Add New Note</a>
    </div>

    <!-- Notes List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php if (!empty($notes)): ?>
            <?php foreach ($notes as $note): ?>
                <div class="bg-white border rounded-lg shadow-md p-4 flex flex-col justify-between relative max-w-2xl">
                    <h2 class="text-xl font-semibold <?php echo $note['status'] === 'completed' ? 'text-green-600 line-through' : ''; ?>">
                        <?php echo $note['name']; ?>
                    </h2>
                    <p class="text-gray-700 mt-2">
                        <?php echo $note['description']; ?>
                    </p>

                    <!-- Status and Reminder -->
                    <div class="mt-3">
                        <span class="text-sm font-medium <?php echo $note['status'] === 'completed' ? 'text-green-600' : 'text-yellow-600'; ?>">
                            <?php echo ucfirst($note['status']); ?>
                        </span>
                        <?php if ($note['remind'] === 'yes' && $note['datetime']): ?>
                            <div class="text-sm text-blue-500 mt-1">
                                <strong>Reminder:</strong> <?php echo date('d M Y, h:i A', strtotime($note['datetime'])); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center mt-4 space-x-3">
                       
                        <a href="<?php echo base_url('notes/delete/' . base64_encode($note['id'])); ?>" class="bg-red-100 p-2 rounded-full text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this note?');">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <?php if ($note['status'] === 'pending'): ?>
                         <a href="<?php echo base_url('notes/edit/' . base64_encode($note['id'])); ?>" class="bg-blue-100 p-2 rounded-full text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </a>
                            <a href="<?php echo base_url('notes/mark_as_completed/' . base64_encode($note['id'])); ?>" class="bg-green-100 rounded-xl p-2 text-green-500 hover:text-green-700">
                                <i class="fas fa-check-circle"></i> Mark as Completed
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-600 col-span-full text-center">No notes found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- FontAwesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
