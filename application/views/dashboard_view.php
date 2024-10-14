<!-- application/views/admin/dashboard_view.php -->
<?php if($this->session->userdata('userloggedin') == true) { ?>
    <style>
        .accord {
  color: #000034;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 0.4s;
}



/* Style the accordion panel. Note: hidden by default */
.panel {
  padding: 0 18px;
  background-color: white;
  display: none;
  overflow: hidden;
}
.noscrl::-webkit-scrollbar {
  display: none;
}
    </style>
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4 bluetext">Dashboard</h2>

    <div class="h-24 w-full rounded blue-bg">
        <div class="w-auto h-24 mx-auto flex justify-center items-center">
            <div class="flex items-center mx-2">
                <img src="<?php echo base_url('uploads/userdetailuploads/' . get_profile_pic_by_id($this->session->userdata('user_id'))) ?>" alt="profile_pic" class="w-20 rounded-full mx-1 border border-white p-1">
            </div>
            <div class="mx-2">
                <h2 class="text-white text-3xl font-bold">
                    <?php echo $this->session->userdata('username') ?>
                </h2>
                <p class="text-white">
                    <?php 
                    if ($this->session->userdata('position') && is_numeric($this->session->userdata('position'))) {
                        echo getPositionById($this->session->userdata('position'));
                    } else {
                        echo $this->session->userdata('admin_type');
                    }
                    ?>
                </p>

            </div>
            <div class="mx-2">
                <button class="px-4 py-2 bg-yellow-500 rounded mx-2 font-bold" onclick="window.location.href = '<?php echo base_url('Profile'); ?>'">Edit profile</button>
            </div>
        </div>
    </div>
    <div class="flex justify-between w-full mt-4">
        <!-- Recent Notices Section as Card -->

        <div class="bg-gray-100 rounded-lg shadow-md p-4 mb-6 border-top-blue w-2/3 mx-1">
            <h3 class="text-lg font-semibold mb-2 blue-text"><i class="fas fa-newspaper" id="notice"></i> Recent Announcement(s)</h3>
            <?php if (!empty($recent_notices)) : ?>
                <ul>
                    <?php foreach ($recent_notices as $notice) : ?>
                        <li class="mb-2">
                            <button class="accord w-96 my-1 rounded-lg flex justify-between"><?php echo strip_tags(substr($notice['notice'], 0, 50)) . '...'; ?><i class="fas fa-caret-down"></i></button>
                            <div class="panel w-full">
                                <span class="text-gray-600 mr-2 bg-blue-100 p-1 rounded"><?php echo date('M d, Y', strtotime($notice['created_at'])); ?></span>
                                <div class="max-h-64 overflow-y-auto noscrl">
                                    <?php echo nl2br($notice['notice']); ?>
                                </div>
                            </div>
                        </li>
                        <hr class="my-1">
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No recent notices found.</p>
            <?php endif; ?>
        </div>
        
        <div class="flex justify-center h-80 w-1/2 mx-1">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-top-blue max-w-lg w-full">
            <h3 class="text-xl font-semibold  blue-text">Leave Balance</h3>
            <canvas id="leaveDoughnutChart"></canvas>
        </div>
    </div>
    </div>
 
    <div class="flex justify-start space-x-4">
    <!-- Upcoming Birthdays -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6 border-left-blue max-w-lg mr-2">
        <h3 class="text-xl font-semibold mb-4 bluetext">Upcoming Birthdays</h3>
        <?php if (!empty($birthdays)) : ?>
            <div class="grid gap-4">
                <?php foreach ($birthdays as $birthday) : ?>
                    <div class="flex items-center gap-4 p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200">
                        <span class="relative flex shrink-0 overflow-hidden rounded-full h-14 w-14">
                            <img class="aspect-square h-full w-full object-cover" alt="<?php echo $birthday['name']; ?>" src="<?php echo base_url('uploads/userdetailuploads/' . get_profile_pic_by_id($birthday['id'])) ?>" />
                        </span>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800"><?php echo $birthday['name']; ?></div>
                            <div class="text-gray-500"><?php echo date('F d, Y', strtotime($birthday['dob'])); ?></div>
                        </div>
                        <button class="inline-flex items-center justify-center text-sm font-medium text-white blue-bg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md px-3 py-1 transition duration-200" onclick="sendwishes()">
                            Send Wishes
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500">No upcoming birthdays found.</p>
        <?php endif; ?>
    </div>

    <!-- Upcoming Holidays -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6 border-left-blue max-w-lg">
        <h3 class="text-xl font-semibold mb-4 bluetext flex items-center"><i class="fas fa-calendar-week mr-2"></i> Upcoming Holidays</h3>
        <?php if (!empty($holidays)) : ?>
            <div class="grid gap-4">
                <?php foreach ($holidays as $holiday) : ?>
                    <div class="flex items-start space-x-3 p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200">
                        <div class="blue-bg text-white font-semibold text-center py-2 px-4 rounded-md shadow-md">
                            <?php echo date('M d', strtotime($holiday['holiday_date'])); ?>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-900 text-lg font-semibold mb-1"><?php echo $holiday['title']; ?></p>
                            <p class="text-gray-500 text-sm"><?php echo date('l', strtotime($holiday['holiday_date'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500">No upcoming holidays found.</p>
        <?php endif; ?>
    </div>

    <!-- Upcoming Events -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6 border-left-blue max-w-lg">
        <h3 class="text-2xl font-bold mb-4 bluetext"><i class="fas fa-calendar-week"></i> Upcoming Events</h3>
        <?php if (!empty($events)) : ?>
            <div class="flex flex-col">
                <?php foreach ($events as $event) : ?>
                    <div class="flex items-start space-x-3 flex-col p-4 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-200">
                        <div class="blue-bg text-white font-semibold text-center py-2 px-4 rounded-md shadow-md">
                            <?php echo date('M d', strtotime($event['date'])); ?>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-gray-900 text-lg font-semibold mb-1"><?php echo $event['name']; ?></p>
                            <p class="text-gray-500 text-sm"><?php echo $event['time_range']; ?></p>
                        </div>
                        <div class="w-full">
                            <p class="text-gray-500 text-sm"><?php echo $event['event_description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-500">No upcoming events found.</p>
        <?php endif; ?>
    </div>
</div>


    
   
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const leaveBalance = <?php echo $this->session->userdata('leave_balance') ?? 0; ?>;
    const usedLeave = 12 - leaveBalance;
    
    const ctx = document.getElementById('leaveDoughnutChart').getContext('2d');
    const leaveDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Available Leave Days', 'Used Leave Days'],
            datasets: [{
                data: [leaveBalance, usedLeave],
                backgroundColor: ['#000034', '#f44336'],
                hoverBackgroundColor: ['#000036', '#ef5350'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
});

var acc = document.getElementsByClassName("accord");
    for (var i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }


function sendwishes(){
    toastr.success("Wishes sent successfully!!!")
}
</script>
<?php } else {
    redirect(base_url('login'));
} ?>
