<!-- application/views/admin/create_employee.php -->

<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Create Employee</h2>

    <div class="bg-white overflow-hidden shadow-md rounded-lg p-4">
        <!-- Display validation errors -->
        <?php if (validation_errors()) : ?>
            <div class="mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Validation Error!</strong>
                    <span class="block sm:inline"><?php echo validation_errors(); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Employee creation form -->
        <form action="<?php echo base_url('Employees/create_employee'); ?>" method="post">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo set_value('username', 'EMP' . rand(1000000, 9999999)); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" readonly>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="text" id="password" name="password" value="<?php echo set_value('password'); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <button type="button" onclick="generatePassword()" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Generate Password</button>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                <select id="role" name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" onchange="toggleManagerDropdown()">
                    <option value="USER">Employee</option>
                    <option value="ADMIN">Manager</option>
                    <option value="SUPERADMIN">Super Admin</option>
                    <option value="HR">HR</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
                <select id="position" name="position" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
                    <option value="">Select Position</option>
                    <?php foreach ($positions as $position): ?>
                        <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                <select id="department" name="department" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" >
                    <option value="">Select Department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4" id="managerDropdown" >
                <label for="manager_id" class="block text-sm font-medium text-gray-700">Manager:</label>
                <select id="manager_id" name="manager_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="">Select Manager</option>
                    <?php foreach ($admins as $admin): ?>
                        <option value="<?php echo $admin['id']; ?>"><?php echo $admin['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- CTC -->
            <div class="mb-4">
                <label for="ctc" class="block text-sm font-medium text-gray-700">CTC (Cost to Company):</label>
                <input type="number" id="ctc" name="ctc" value="<?php echo set_value('ctc'); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" step="0.01" placeholder="Enter CTC in INR">
            </div>

            <!-- Joining Date -->
            <div class="mb-4">
                <label for="joining_date" class="block text-sm font-medium text-gray-700">Joining Date:</label>
                <input type="date" id="joining_date" name="joining_date" value="<?php echo set_value('joining_date'); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            </div>

            <!-- Employment Type -->
            <div class="mb-4">
                <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type:</label>
                <select id="employment_type" name="employment_type" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Employee</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Function to generate a random password
    function generatePassword() {
        var length = 10,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            password = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            password += charset.charAt(Math.floor(Math.random() * n));
        }
        document.getElementById("password").value = password;
    }
</script>
<script>
    function toggleManagerDropdown() {
        const roleSelect = document.getElementById('role');
        const managerDropdown = document.getElementById('managerDropdown');

        // Show manager dropdown only if the selected role is 'USER'
        if (roleSelect.value === 'USER') {
            managerDropdown.style.display = 'block';
        } else {
            managerDropdown.style.display = 'none';
        }
    }
</script>