<?php
if (!$this->session->userdata("userloggedin") == true) {
    redirect(base_url('login'));
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/vda-logo.ico') ?>" type="image/x-icon">
    <title>EMPLOYEE</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- jquery  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        .active-link {
            /* background: aliceblue; */
            color: white;
            border-radius: 10px;
        }

        .offcanvas {
            position: fixed;
            top: 0;
            right: 0;
            /* Change to right */
            height: 100%;
            width: 300px;
            background-color: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
            /* Change to negative for right shadow */
            transform: translateX(100%);
            /* Change to translateX(100%) for right */
            transition: transform 0.3s ease-in-out;
            z-index: 1050;
        }

        .offcanvas.show {
            transform: translateX(0);
        }

        .offcanvas-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .offcanvas-title {
            margin: 0;
            font-size: 1.25rem;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .offcanvas-body {
            padding: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.jqueryui.min.css">
</head>
<?php include(APPPATH . 'helpers/common_helper.php'); ?>

<body class="flex flex-col h-screen">
    <!-- Header -->
    <header class="bg-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="logo-box ">
                <a href="<?php echo base_url(); ?>" class="flex items-center">
                    <img src="<?php echo base_url('assets/images/vda-logo.png') ?>" alt="Logo" class="w-10 rounded-lg mx-2">
                    <h1 class="text-3xl font-bold">EMPLOYEE</h1>
                </a>
            </div>

            <nav>
                <ul class="flex space-x-4">
                    <li class="flex items-center blue-text">
                        <a class="btn pointer blue-text rounded text-2xl relative" id="messageToggle">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <?php
                            $unread_count = get_unread_messages_count();
                            if ($unread_count > 0):
                            ?>
                                <span class="absolute  right-4 bottom-4 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs">
                                    <?php echo $unread_count; ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <li class="flex items-center blue-text">
                        <a class="btn pointer blue-text rounded text-2xl relative" id="offcanvasToggle">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <?php
                            $unread_count = get_unread_notifications_count();
                            if ($unread_count > 0):
                            ?>
                                <span class="absolute  right-4 bottom-4 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs">
                                    <?php echo $unread_count; ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                    
                     <!-- Display red reminder if not empty -->
                <?php
                $pending_reminder = get_pending_reminders(); // Fetch the first pending reminder
                if (!empty($pending_reminder)):
                ?>
                    <li class="flex items-center">
                        <div class="bg-red-500 text-white rounded-full h-8 w-8 flex items-center justify-center text-xs">
                            <i class="fas fa-stopwatch"></i>
                        </div>
                        <span class="ml-2 text-red-500 font-semibold flex flex-col">
                            <?php echo htmlspecialchars($pending_reminder['name']); // Adjust this to your actual reminder field ?>
                            <span class="text-xsm text-gray-400" style="font-size:12px;">
                            <?php echo htmlspecialchars($pending_reminder['datetime']); // Adjust this to your actual reminder field ?>
                        </span>
                        </span>
                    </li>
                <?php endif; ?>
                
                    <li class="relative">
                        <a href="#" class="text-black flex items-center dropdown-toggle">
                            <img src="<?php echo base_url('uploads/userdetailuploads/' . get_profile_pic_by_id($this->session->userdata('user_id'))) ?>" alt="profile_pic" class="w-10 rounded-full mx-1">
                            <span class="font-semibold"><?php echo $this->session->userdata('username'); ?></span>
                            <i class="fas fa-chevron-down ml-1"></i>
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="absolute hidden bg-red-300 hover:bg-red-400 shadow-md mt-2 w-48 rounded-lg py-2 dropdown-menu" style="right: 3px;top:35px;">
                            <li><a href="<?php echo base_url('login/logout'); ?>" class="block px-4 py-2 text-gray-800 flex items-center "><svg style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <style type="text/css">
                                            .st0 {
                                                opacity: 0.2;
                                                fill: none;
                                                stroke: #000000;
                                                stroke-width: 5.000000e-02;
                                                stroke-miterlimit: 10;
                                            }
                                        </style>
                                        <g id="grid_system" />
                                        <g id="_icons">
                                            <g>
                                                <path d="M20.9,11.6c-0.1-0.1-0.1-0.2-0.2-0.3l-3-3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4l1.3,1.3H13c-0.6,0-1,0.4-1,1s0.4,1,1,1h4.6    l-1.3,1.3c-0.4,0.4-0.4,1,0,1.4c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l3-3c0.1-0.1,0.2-0.2,0.2-0.3C21,12.1,21,11.9,20.9,11.6z    " />
                                                <path d="M15.5,18.1C14.4,18.7,13.2,19,12,19c-3.9,0-7-3.1-7-7s3.1-7,7-7c1.2,0,2.4,0.3,3.5,0.9c0.5,0.3,1.1,0.1,1.4-0.4    c0.3-0.5,0.1-1.1-0.4-1.4C15.1,3.4,13.6,3,12,3c-5,0-9,4-9,9s4,9,9,9c1.6,0,3.1-0.4,4.5-1.2c0.5-0.3,0.6-0.9,0.4-1.4    C16.6,18,16,17.8,15.5,18.1z" />
                                            </g>
                                        </g>
                                    </svg> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="offcanvas fixed top-0 right-0 h-full w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50 overflow-y-scroll" id="offcanvasExample">
        <div class="offcanvas-header flex justify-between items-center p-4 border-b border-gray-200 blue-bg text-white">
            <h5 class="offcanvas-title text-xl">All Notifications</h5>
            <button type="button" class="btn-close text-2xl" id="offcanvasClose" aria-label="Close">&times;</button>
        </div>
        <div class="offcanvas-body p-6">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm w-full max-w-md mx-auto">
                <div class="flex flex-col space-y-1.5 p-6 items-center justify-between">
                    <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Notifications</h3>
                    <form action="<?php echo site_url('dashboard/update_notifications'); ?>" method="post">
                        <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                            Mark all as read
                        </button>
                    </form>
                </div>
                <div class="p-6 space-y-4">
                    <div class="space-y-2">
                        <div class="text-sm font-medium text-muted-foreground">Today</div>
                        <div class="grid gap-3">
                            <?php
                            $notifications = get_user_notifications();
                            if (!empty($notifications)):
                                foreach ($notifications as $notification):
                            ?>
                                    <div class="flex items-start gap-3">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary text-primary-foreground">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 space-y-1">
                                            <div class="font-medium"><?php echo $notification['title']; ?></div>
                                            <p class="text-sm text-muted-foreground"><?php echo $notification['message']; ?></p>
                                            <div class="text-xs text-muted-foreground"><?php echo date('h:i A', strtotime($notification['created_at'])); ?></div>
                                        </div>
                                    </div>
                                <?php
                                endforeach;
                            else:
                                ?>
                                <p>No notifications found.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- You can add more sections for Yesterday, Last Week, etc. -->
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end " id="messageCanvas" tabindex="-1">
        <div class="offcanvas-header mr-10 blue-bg text-white">
            <h5 class="offcanvas-title text-xl">All Messages</h5>
            <button type="button" class="btn-close text-red-700 hover:bg-red-100 rounded-xl px-4 py-2" id="messageClose" aria-label="Close">&times;</button>
        </div>
        <div class="offcanvas-body max-w-5xl mx-auto" id="messageContent">
            <!-- Messages will be dynamically loaded here -->
        </div>
    </div>

    <style>
        #messageCanvas {
            width: 100vw;
            /* Full width of the viewport */
            height: 100vh;
            /* Full height of the viewport */
            top: 0;
            /* Align to the top */
            left: 0;
            /* Align to the left */
            padding: 0;
            /* Remove default padding */
        }

        #messageContent {
            height: calc(100vh - 56px);
            /* Full height minus header height */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }

        .message-item {
            background-color: white;
            /* Default background */
            transition: background-color 0.3s;
        }

        .message-item.unread {
            background-color: #ebf8ff;
            /* Blue-100 background color for unread messages */
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#messageToggle').click(function() {
                $('#messageCanvas').addClass('show');
                getAllMessages(); // Call the function to load messages
            });

            $('#messageClose').click(function() {
                $('#messageCanvas').removeClass('show');
            });
        });

        function getAllMessages() {
            $.ajax({
                url: '<?php echo site_url("dashboard/get_all_messages"); ?>', // Replace with your URL
                method: 'GET',
                success: function(data) {
                    $('#messageContent').html(data);
                },
                error: function() {
                    $('#messageContent').html('<p>An error occurred while fetching messages.</p>');
                }
            });
        }
    </script>
    <script>
        function markAsRead(element) {
            // Get the message ID from the data-id attribute
            var messageId = $(element).data('id');

            $.ajax({
                url: '<?php echo base_url('Dashboard/read_message') ?>', // URL for your controller method
                type: 'POST',
                data: {
                    id: messageId // Sending the message ID
                },
                success: function(response) {
                    // Optionally, update the UI to reflect the read status
                    $(element).removeClass('unread'); // Remove the unread class
                    $(element).find('.unread-indicator').remove(); // Remove the blue dot indicator
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error marking message as read:', textStatus, errorThrown);
                }
            });
        }
    </script>

    <!-- Main Content and Sidebar -->
    <div class="flex">
        <!-- Sidebar -->
        <aside class="text-gray-500 w-64 min-h-screen" style="background: #000034;">
            <nav class="p-2">
                <ul class="space-y-2 nav-ul">
                    <li class="<?php echo $this->uri->uri_string() == 'Dashboard' ? 'active-link' : ''; ?>">
                        <a href="<?php echo base_url('Dashboard') ?>" class="block py-2 px-4 "><i class="fas fa-th-large"></i> Dashboard</a>
                    </li>
                    <li class="<?php echo $this->uri->uri_string() == 'Attendance' ? 'active-link' : ''; ?>">
                        <a href="<?php echo base_url('Attendance') ?>" class="block py-2 px-4 "><i class="far fa-list-alt"></i> Attendance</a>
                    </li>
                    <li class="<?php echo $this->uri->uri_string() == 'Parking' ? 'active-link' : ''; ?>">
                        <a href="<?php echo base_url('Parking') ?>" class="block py-2 px-4 "><i class="fas fa-car"></i> Parking</a>
                    </li>
                    <?php if ($this->session->userdata('admin_type') == 'SUPERADMIN' || $this->session->userdata('admin_type') == 'ADMIN') { ?>
                        <li class="<?php echo $this->uri->uri_string() == 'Parking/requests' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Parking/requests') ?>" class="block py-2 px-4 "><i class="fas fa-history"></i> Parking Requests</a>
                        </li>
                    <?php  } ?>
                    <li class="accordion <?php echo $this->uri->uri_string() == 'ManageLeave' ? 'active-link' : ''; ?>">
                        <a href="#" class="block py-2 px-4 accordion-btn"><i class="fas fa-suitcase"></i> Manage Leave<i class="fas fa-chevron-down text-sm" id="down"></i></a>
                        <ul class="accordion-content ml-8">
                            <li class="text-white ">
                                <a href="<?php echo base_url('Manageleave/apply_leave') ?>" class="block py-2 px-1"><i class="fas fa-plus"></i> Apply Leave</a>
                            </li>
                            <li class="text-white">
                                <a href="<?php echo base_url('Manageleave/leave_summary') ?>" class="block py-2 px-1 "><i class="fas fa-suitcase"></i> My Summary</a>
                            </li>
                            <?php if ($this->session->userdata('admin_type') == 'SUPERADMIN' || $this->session->userdata('admin_type') == 'ADMIN') { ?>
                                <li class="text-white">
                                    <a href="<?php echo base_url('Manageleave/view_leave_request') ?>" class="block py-2 px-1 "><i class="fas fa-history"></i> View Requests</a>
                                </li>
                            <?php  } ?>


                        </ul>
                    </li>
                    <li class="<?php echo $this->uri->uri_string() == 'Rooms' ? 'active-link' : ''; ?>">
                        <a href="<?php echo base_url('Rooms') ?>" class="block py-2 px-4 "><i class="fas fa-door-open"></i> Rooms</a>
                    </li>
                    <li class="<?php echo $this->uri->uri_string() == 'asset' ? 'active-link' : ''; ?> flex items-center">
                        <a href="<?php echo base_url('asset') ?>" class="block py-2 px-4 "><i class="fas fa-box"></i> Asset </a>
                        <?php if($this->session->userdata("admin_type") == "SUPERADMIN" ||$this->session->userdata("admin_type") == "HR" ){ ?>
                        <?php 
                        $assetcount = count_pending_asset_requests();
                        if($assetcount > 0){ ?>
                           <span class="bg-white px-2 py-1 bluetext rounded-full text-sm  "> <?php echo $assetcount; ?> </span>
                      <?php  }
                        ?> <?php } ?>
                    </li>

                    <?php if ($this->session->userdata('admin_type') == 'SUPERADMIN' || $this->session->userdata('admin_type') == 'HR') { ?>
                        <li class="<?php echo $this->uri->uri_string() == 'Employees' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Employees') ?>" class="block py-2 px-4 "><i class="fas fa-users"></i> Employees</a>
                        </li>
                        <li class="<?php echo $this->uri->uri_string() == 'Admin/create' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Admin/create') ?>" class="block py-2 px-4 "><i class="fas fa-plus-circle"></i> Create</a>
                        </li>
                        <li class="<?php echo $this->uri->uri_string() == 'Positions' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Positions') ?>" class="block py-2 px-4 "><i class="fas fa-smile-beam"></i> Positions</a>
                        </li>
                    <?php } ?>
                    <?php if ($this->session->userdata('admin_type') == 'ADMIN') { ?>
                        <li class="<?php echo $this->uri->uri_string() == 'Employees/view_team' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Employees/view_team') ?>" class="block py-2 px-4 "><i class="fas fa-users"></i> View Team</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?php echo base_url('payslips/' . base64_encode($this->session->userdata('user_id'))); ?>"  class="block py-2 px-4 <?php echo $this->uri->uri_string() == 'payslips' ? 'active-link' : ''; ?>"><i class="fas fa-money-check-alt"></i> Payslip</a>
                    </li>
                    <?php if ($this->session->userdata('admin_type') == 'SUPERADMIN' || $this->session->userdata('admin_type') == 'HR') { ?>
                    <li>
                        <a href="<?php echo base_url('manage-payroll') ?>" class="block py-2 px-4 <?php echo $this->uri->uri_string() == 'manage-payroll' ? 'active-link' : ''; ?>"><i class="fas fa-money-check-alt"></i> Manage Payroll</a>
                    </li>
                    <?php } ?>
                    <li class="<?php echo $this->uri->uri_string() == 'Profile' ? 'active-link' : ''; ?>">
                        <a href="<?php echo base_url('Profile') ?>" class="block py-2 px-4 "><i class="fas fa-user"></i> Profile</a>
                    </li>
                    <?php if ($this->session->userdata('admin_type') != 'SUPERADMIN') { ?>
                        <li class="<?php echo $this->uri->uri_string() == 'Complaints' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Complaints') ?>" class="block py-2 px-4 "><i class="fas fa-exclamation-triangle"></i> Complaint</a>
                        </li>
                    <?php } ?>
                    <li class="<?php echo $this->uri->uri_string() == 'Notes' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Notes') ?>" class="block py-2 px-4 "><i class="fas fa-sticky-note"></i> Notes</a>
                        </li>
                    <?php if ($this->session->userdata('admin_type') != 'SUPERADMIN') { ?>
                        <li class="<?php echo $this->uri->uri_string() == 'rewards' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('rewards') ?>" class="block py-2 px-4 "><i class="fas fa-gift"></i> Rewards</a>
                        </li>
                    <?php  } ?>
                    <?php if ($this->session->userdata('admin_type') == 'SUPERADMIN') { ?>
                        <li class="<?php echo $this->uri->uri_string() == 'Complaints' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Complaints/all_complaints_view') ?>" class="block py-2 px-4 "><i class="fa fa-exclamation-circle" aria-hidden="true"></i> View Complaints</a>
                        </li>
                        <li class="<?php echo $this->uri->uri_string() == 'Departments' ? 'active-link' : ''; ?>">
                            <a href="<?php echo base_url('Departments') ?>" class="block py-2 px-4 "><i class="fas fa-building"></i> Departments</a>
                        </li>
                    <?php  } ?>
                    <li class="logout-li">
                        <a href="<?php echo base_url('login/logout'); ?>" class="block py-2 px-4 <?php echo $this->uri->uri_string() == 'login/logout' ? 'active-link' : ''; ?>"><i class="fas fa-walking"></i> Logout</a>
                    </li>
                </ul>
            </nav>
        </aside>


        <style>
            .accordion-content {
                display: none;
                border-left: 1.5px solid white;
            }

            .accordion-content.show {
                display: block;
            }

            .accordion-btn i {
                float: right;
                margin-left: 5px;
                /* Adjust the spacing between icons */
            }

            .fa-chevron-up {
                display: none;
            }
        </style>



        <!-- Main Content Section -->
        <main class="container mx-auto p-4 flex-grow">
            <?php $this->load->view('partials/breadcrumbs'); ?>