<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/vda-logo.ico') ?>" type="image/x-icon">
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container  mx-auto  mt-20 bg-white rounded-lg shadow-lg shadow-grey-300">
        <div class="logo-box flex bg-white mx-auto items-center justify-center py-2 px-1 my-3">
            <img src="<?php echo base_url('assets/images/vda-logo.png') ?>" alt="Logo" class="w-10 rounded" />
            <h3>EMPLOYEE</h3>
        </div>
        <div class=" flex items-center justify-center bg-white ">
            <div class="bg-white ">
                <img src="<?php echo base_url('assets/images/login-vector.jpg') ?>" alt="Login-vector" class="img-vector">
            </div>
            <div class="bg-white p-8 border border-gray-300 my-2 rounded-lg">
                <h1 class="text-2xl font-bold mb-1">Login</h1>
                <span class="mb-5"></span>
                <?php if ($this->session->flashdata('error')) : ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <form action="<?php echo base_url('login/authenticate'); ?>" method="post">
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700">Username</label>
                        <input type="text" name="username" id="username" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" name="password" id="password" class="w-full px-3 py-2 border rounded" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <h5 class="font-bold text-white text-center">Release Notes</h5>
        <p>Version 3.2</p>
        <p>&copy; <?php echo date('Y'); ?><strong> Employee</strong> All rights reserved.</p>
    </div>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')) : ?>
                toastr.success('<?php echo $this->session->flashdata('success'); ?>');
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')) : ?>
                toastr.error('<?php echo $this->session->flashdata('error'); ?>');
            <?php endif; ?>
        });
    </script>
</body>

</html>