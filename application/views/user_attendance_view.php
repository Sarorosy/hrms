<div class="container mx-auto p-4">
<h2 class="text-2xl font-bold mb-4 flex items-center">
    <?php if ($user): ?>
        <!-- Display User Name -->
         
        Attendance of 
        <!-- Display the profile picture -->
        <img src="<?= base_url('uploads/userdetailuploads/' . $user->profile_pic); ?>" 
             alt="Profile Picture of <?= $user->name ?>" 
             style="width:50px;height:50px;border-radius:50%;margin-left:10px"> <?= $user->name ?>
    <?php else: ?>
        User not found
    <?php endif; ?>
</h2>

    
    <div class="flex justify-between">
        <div id="calendar" class="calendar-container mt-4 bg-white p-3 rounded"></div>
        <div class="p-4 mb-2 bg-white rounded-lg shadow-md border-t-4 border-blue-500 w-sm mr-2 max-h-40">
            <ul>
                <li class="flex items-center mb-2">
                    <span class="w-6 h-6 rounded-full  mr-2 flex items-center justify-center" style="background-color:#c6f6d5;"><i class="fas fa-calendar-check"></i></span>
                    <span class="text-green-700">Present</span>
                </li>
                <li class="flex items-center mb-2">
                    <span class="w-6 h-6 rounded-full bg-red-300 mr-2 flex items-center justify-center"><i class="far fa-frown"></i></span>
                    <span class="text-red-600">Absent</span>
                </li>
                <li class="flex items-center">
                    <span class="w-6 h-6 rounded-full bg-blue-300 mr-2 flex items-center justify-center"><i class="fas fa-umbrella-beach"></i></span>
                    <span class="text-blue-600">Holiday</span>
                </li>
            </ul>
        </div>

        <div id="working-hours-card" class="p-4 mb-2 bg-white rounded-lg shadow-md border-t-4 border-blue-500 w-lg">
            <h3 class="text-xl font-bold bg-blue-100 p-2 rounded text-center">Attendance Details</h3>
            
            <div class="bg-blue-100 my-2 p-2 rounded">
                <p id="attendance-details" class="text-lg bg-blue-300 p-2 rounded text-center rounded">
                    Please select a date from the calendar to view attendance details.
                </p>
                <p id="login-time" class="bg-green-300 text-center my-2 rounded text-lg"></p>
                <p id="logout-time" class="bg-red-300 text-center my-2 rounded text-lg"></p>
                <p id="total-working-hours" class="text-md font-bold mt-4">
                    Total: <span id="total-hours"></span> hours <span id="total-minutes"></span> minutes
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Work Details -->
<div id="workDetailsModal" class="modal fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="modal-content bg-white p-4 rounded shadow-lg">
        <h2 class="text-xl font-bold mb-4">Enter Today's Work Details</h2>
        <textarea id="workDetailsTextarea" class="w-full p-2 border rounded" rows="5" placeholder="Enter your work details..."></textarea>
        <p id="wordCount" class="text-right text-gray-600 mt-2">Minimum 10 words required.</p>
        <button id="submitWorkDetails" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4" disabled>Submit</button>
        <button id="closeModal" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded mt-2">Close</button>
    </div>
</div>

<!-- Modal for Confirmation -->
<div id="confirmSignOffModal" class="modal fixed inset-0 flex items-center justify-center hidden z-50">
    <div class="modal-content bg-white p-4 rounded shadow-lg">
        <h2 class="text-xl font-bold mb-4">Confirm Sign Off</h2>
        <p>Are you sure you want to sign off?</p>
        <button id="confirmSignOffButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">Yes, Sign Off</button>
        <button id="cancelSignOffButton" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded mt-2">Cancel</button>
    </div>
</div>

<style>
    .calendar-container {
        width: 600px;
        height: auto;
        margin: 0 auto; 
        border: 1px solid #ccc;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .fc-sun {
        background-color: rgba(147, 197, 253) !important; 
    }
    .fc-daygrid-day, .fc-daygrid-day-top {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        cursor: pointer; /* Make the cursor a pointer */
    }
    #working-hours-card {
        width: 300px;
    }
    .fc-day, .fc-day-top {
        cursor: pointer;
    }
    .modal {
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        width: 400px;
        max-width: 90%;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const workDetailsModal = document.getElementById('workDetailsModal');
        const confirmSignOffModal = document.getElementById('confirmSignOffModal');
        const workDetailsTextarea = document.getElementById('workDetailsTextarea');
        const submitButton = document.getElementById('submitWorkDetails');
        const wordCountDisplay = document.getElementById('wordCount');
        
        // Function to open the work details modal
        function openWorkDetailsModal() {
            workDetailsModal.classList.remove('hidden');
        }

        // Function to close the work details modal
        function closeWorkDetailsModal() {
            workDetailsModal.classList.add('hidden');
            workDetailsTextarea.value = ''; // Clear the textarea
            submitButton.disabled = true; // Disable button
            wordCountDisplay.textContent = 'Minimum 10 words required.'; // Reset word count message
        }

        // Function to close the confirmation modal
        function closeConfirmSignOffModal() {
            confirmSignOffModal.classList.add('hidden');
        }

        // Validate word count
        workDetailsTextarea.addEventListener('input', function() {
            const words = this.value.trim().split(/\s+/).filter(Boolean);
            const wordCount = words.length;

            if (wordCount >= 10) {
                submitButton.disabled = false;
                wordCountDisplay.textContent = `${wordCount} words entered.`;
            } else {
                submitButton.disabled = true;
                wordCountDisplay.textContent = `Minimum 10 words required. Current: ${wordCount}`;
            }
        });

        // Submit work details
        submitButton.addEventListener('click', function() {
            const workDetails = workDetailsTextarea.value;

            // Close the work details modal and open confirmation modal
            closeWorkDetailsModal();
            confirmSignOffModal.classList.remove('hidden');
            
            // Handle confirmation
            document.getElementById('confirmSignOffButton').onclick = function() {
                // AJAX call to save work details
                fetch('<?php echo base_url('Attendance/save_work_details'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        date: new Date().toISOString().split('T')[0], // Get current date
                        user_id: '<?php echo $this->session->userdata('user_id'); ?>', // Pass user ID
                        work_details: workDetails
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Work details saved successfully!');

                        // Mark logout after successful saving
                        return fetch('<?php echo base_url('Attendance/mark_logout'); ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                user_id: '<?php echo $this->session->userdata('user_id'); ?>' // Pass user ID for logout
                            }),
                        });
                    } else {
                        toastr.error('Error saving work details.');
                    }
                })
                .then(() => {
                    // Close confirmation modal and refresh or redirect
                    closeConfirmSignOffModal();
                    location.reload(); // Reload to reflect the sign-off
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('An error occurred.');
                });
            };
        });

        // Close work details modal
        document.getElementById('closeModal').addEventListener('click', closeWorkDetailsModal);
        document.getElementById('signOffButton').addEventListener('click', openWorkDetailsModal);
        
        // Cancel sign off
        document.getElementById('cancelSignOffButton').addEventListener('click', closeConfirmSignOffModal);
    });
</script>
<script>
$(document).ready(function() {
    var attendance = <?php echo json_encode($attendance); ?>;
    var holidays = <?php echo json_encode($holidays); ?>; // Fetch holidays from PHP

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        events: [],
        dayRender: function(date, cell) {
            var formattedDate = date.format('YYYY-MM-DD');
            var entries = attendance.filter(function(entry) {
                return entry.date === formattedDate;
            });

            // Check if the current date is a holiday
            var holiday = holidays.find(function(holiday) {
                return holiday.holiday_date === formattedDate;
            });
            var isSunday = date.day() === 0;

            // If it's a holiday, set the background and append holiday text
            if (holiday) {
                cell.css('background-color', '#add8e6'); // Light blue background color
                cell.append('<div style="color: blue; font-weight: 500;font-size:15px;">' + holiday.title + '</div>');
            } else if (entries.length > 0) {
                // Directly format the times if they are in the correct timezone already
                var loginTime = entries[0].login_time ? moment(entries[0].date + ' ' + entries[0].login_time).format('hh:mm A') : '';
                var logoutTime = entries[0].logout_time ? moment(entries[0].date + ' ' + entries[0].logout_time).format('hh:mm A') : '';

                var content = '<div style="font-size: 12px;">';
                content += '<div style="font-weight: bold;">' + date.format('D') + '</div>';
                content += '<div>' + loginTime + '</div>';
                content += '<div>' + logoutTime + '</div>';
                content += '</div>';

                cell.append(content);
                cell.css('background-color', '#c6f6d5'); // Green background color for attendance
            }else if (!isSunday && date.isBefore(moment())) {
                // If no entries, not a Sunday, and past date, mark as absent
                cell.css('background-color', '#E6ACAC'); // Red for absence
                cell.append('<div style="color: red; font-weight: bold; font-size: 15px;">Absent</div>');
            }
        },
        dayClick: function(date) {
            var selectedDate = date.format('YYYY-MM-DD');
            var selectedEntries = attendance.filter(function(entry) {
                return entry.date === selectedDate;
            });

            if (selectedEntries.length > 0) {
                displayAttendanceDetails(selectedEntries[0]); // Display details for the first entry of the selected date
                displayTotalTime(selectedEntries); // Calculate and display total working time
            } else {
                $('#attendance-details').text('No attendance recorded for this day.');
                $('#login-time').text('');
                $('#logout-time').text('');
                $('#total-hours').text('');
                $('#total-minutes').text('');
            }
        }
    });

    // Display working hours for the current day by default
    var today = moment().utcOffset("+05:30").format('YYYY-MM-DD'); // UTC +05:30 for IST
    var todayEntries = attendance.filter(function(entry) {
        return entry.date === today;
    });
    if (todayEntries.length > 0) {
        displayAttendanceDetails(todayEntries[0]); // Display details for the first entry of today
        displayTotalTime(todayEntries); // Calculate and display total working time for today
    } else {
        $('#attendance-details').text('No attendance recorded for today.');
        $('#login-time').text('');
        $('#logout-time').text('');
        $('#total-hours').text('');
        $('#total-minutes').text('');
    }

    function calculateTotalTime(entries) {
        let totalSeconds = 0;

        entries.forEach(function(entry) {
            if (entry.login_time && entry.logout_time) {
                const loginTime = moment.utc(entry.date + ' ' + entry.login_time).local();
                const logoutTime = moment.utc(entry.date + ' ' + entry.logout_time).local();
                totalSeconds += logoutTime.diff(loginTime, 'seconds');
            }
        });

        const totalDuration = moment.duration(totalSeconds, 'seconds');
        const hours = Math.floor(totalDuration.asHours());
        const minutes = totalDuration.minutes();

        return { hours: hours, minutes: minutes };
    }

    function displayTotalTime(entries) {
        const { hours, minutes } = calculateTotalTime(entries);

        $('#total-hours').text(hours);
        $('#total-minutes').text(minutes);
    }

    function displayAttendanceDetails(entry) {
        $('#attendance-details').html('<i class="far fa-calendar"></i> ' + moment(entry.date).format('MMMM DD, YYYY'));
        if (entry.login_time) {
            $('#login-time').text('Login Time: ' + moment(entry.date + ' ' + entry.login_time).local().format('hh:mm A'));
        } else {
            $('#login-time').text('Login Time: N/A');
        }
        if (entry.logout_time) {
            $('#logout-time').text('Logout Time: ' + moment(entry.date + ' ' + entry.logout_time).local().format('hh:mm A'));
        } else {
            $('#logout-time').text('Logout Time: N/A');
        }
    }
});
</script>
