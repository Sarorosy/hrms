<!-- application/views/admin/view_employee.php -->
<?php if ($this->session->userdata('admin_type') != 'USER') { ?>

  <style>
    /* Modal container (hidden by default) */
    #documentModal {
      display: none;
      /* Hide modal by default */
      position: fixed;
      /* Position fixed to cover the viewport */
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      /* Semi-transparent background */
      align-items: center;
      /* Center content vertically */
      justify-content: center;
      /* Center content horizontally */
    }

    /* Modal content (hidden by default) */
    #documentModal>div {
      display: none;
      /* Hide modal content by default */
      background-color: #fff;
      border-radius: 0.5rem;
      /* Rounded corners */
      padding: 1.5rem;
      /* Padding */
      max-width: 90%;
      /* Limit width to 90% of viewport width */
      max-height: 90%;
      /* Limit height to 90% of viewport height */
      overflow-y: auto;
      /* Allow scrolling if content overflows */
      position: relative;
      /* For positioning the close button */
    }
  </style>


  <?php if ($this->session->flashdata('message')): ?>
    <script>
      $(document).ready(function() {
        toastr.success("<?php echo $this->session->flashdata('message'); ?>", "Success", {
          closeButton: true,
          progressBar: true,
          timeOut: 3000 // Duration in milliseconds
        });
      });
    </script>
  <?php endif; ?>



  <div class="w-full max-w-6xl mx-auto p-6 sm:p-8 md:p-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      <div class="col-span-1 md:col-span-1">
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Personal Information</h3>
          </div>
          <div class="p-6 grid gap-4">
            <div class="flex items-center gap-4">
              <span class="relative flex shrink-0 overflow-hidden rounded-full w-20 h-20">
                <img class="aspect-square h-full w-full" src="<?php echo base_url('uploads/userdetailuploads/' . $employee['profile_pic']) ?>" />
              </span>
              <div class="grid gap-1">
                <div class="text-xl font-semibold "><?php echo $employee['name'] ?></div>
                <div class="text-sm text-muted-foreground flex flex-col"><?php echo getPositionById($employee['position']) ?><div class="flex items-center text-xl bluetext">
                    <button type="button" class="btn btn-icon " data-toggle="modal" data-target="#messageModal" onclick="openMessageModal(<?php echo $employee['id']; ?>)">
                      <i class="fas fa-comment-dots"></i>
                    </button>


                  </div>
                </div>
              </div>

            </div>
            <div data-orientation="horizontal" role="none" class="shrink-0 bg-border h-[1px] w-full"></div>
            <div class="grid gap-2">
              <div class="flex items-center justify-between">
                <div class="text-sm font-medium">Date of Birth</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['dob'] ?></div>
              </div>
              <div class="flex items-center justify-between">
                <div class="text-sm font-medium">Gender</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['gender'] ?></div>
              </div>
              <div class="flex items-center justify-between">
                <div class="text-sm font-medium">Marital Status</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['marital_status'] ?></div>
              </div>
            </div>
            <div data-orientation="horizontal" role="none" class="shrink-0 bg-border h-[1px] w-full"></div>
            <div class="grid gap-2">
              <div class="flex items-center justify-between">
                <div class="text-sm font-medium">Nationality</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['nationality'] ?></div>
              </div>
              <!-- <div class="flex items-center justify-between">
              <div class="text-sm font-medium">Religion</div>
              <div class="text-sm text-muted-foreground"><?php echo $employee['religion'] ?></div>
            </div> -->
              <div class="flex items-center justify-between">
                <div class="text-sm font-medium">Blood Group</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['blood_group'] ?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Documents</h3>
          </div>
          <div class="p-6 grid gap-4">
            <div class="flex items-center justify-between">
              <div class="text-sm font-medium">Passport</div>
              <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" onclick="openModal('passport', '<?= base_url('uploads/userdetailuploads/' . $employee['passport_photo']) ?>')">
                View
              </button>
            </div>
            <div class="flex items-center justify-between">
              <div class="text-sm font-medium">10th Marksheet</div>
              <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" onclick="openModal('marksheet', '<?= base_url('uploads/userdetailuploads/' . $employee['10th_marksheet']) ?>')">
                View
              </button>
            </div>
            <div class="flex items-center justify-between">
              <div class="text-sm font-medium">Degree Certificate</div>
              <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" onclick="openModal('degree', '<?= base_url('uploads/userdetailuploads/' . $employee['degree_certificate']) ?>')">
                View
              </button>
            </div>
            <div class="flex items-center justify-between">
              <div class="text-sm font-medium">CV</div>
              <button class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3" onclick="openModal('cv', '<?= base_url('uploads/userdetailuploads/' . $employee['cv']) ?>')">
                View
              </button>
            </div>
          </div>
        </div>
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-6">
          <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Employee Feedback</h3>
        </div>
        <div class="p-6 grid gap-4">
          <?php if(isset($feedback) && is_array($feedback)): ?>
          <?php foreach($feedback as $item): ?>
          <div class="grid gap-2 border-b border-muted-foreground pb-4">
            <div class="flex items-center">
              <span class="text-lg font-bold text-muted-foreground">Punctuality:</span>
              <div class="ml-2">
                <?php echo generateStarRating($item['punctuality_rating']); ?>
              </div>
            </div>
            <div class="flex items-center">
              <span class="text-lg font-bold text-muted-foreground">Productivity:</span>
              <div class="ml-2">
                <?php echo generateStarRating($item['productivity_rating']); ?>
              </div>
            </div>
            <div class="flex items-center">
              <span class="text-lg font-bold text-muted-foreground">Quality:</span>
              <div class="ml-2">
                <?php echo generateStarRating($item['quality_rating']); ?>
              </div>
            </div>
            <div class="text-lg font-bold text-muted-foreground"> Comments: <span class="font-light"><?php echo $item['comments']; ?></span></div>
            <div class="text-lg font-bold text-muted-foreground"> Date: <span class="font-light"><?php echo strdate($item['created_at']) ?></span></div>
          </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      </div>
      <div class="col-span-1 md:col-span-2">
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Employment Details</h3>
          </div>
          <div class="p-6 grid gap-4">
            <div class="grid grid-cols-2 gap-4">
              <div class="grid gap-2">
                <div class="text-sm font-medium">Employee ID</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['employee_id'] ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Email ID</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['email'] ?></div>
              </div>

            </div>
            <div class="grid grid-cols-2 gap-4">
              <div class="grid gap-2">
                <div class="text-sm font-medium">Designation</div>
                <div class="text-sm text-muted-foreground"><?php echo getPositionById($employee['position']) ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Date of Joining</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['joining_date'] ?></div>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div class="grid gap-2">
                <div class="text-sm font-medium">Reporting To</div>
                <div class="text-sm text-muted-foreground"><?php echo getAdminNameById($employee['manager_id']) ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Employment Type</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['employment_type'] ?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Contact Information</h3>
          </div>
          <div class="p-6 grid gap-4">
            <div class="grid grid-cols-2 gap-4">

              <div class="grid gap-2">
                <div class="text-sm font-medium">Personal Email</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['personal_email'] ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Phone</div>
                <div class="text-sm text-muted-foreground">+91 <?php echo $employee['phone_number'] ?></div>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div class="grid gap-2">
                <div class="text-sm font-medium">Address</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['address1'] ?></div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['address2'] ?></div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['address3'] ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Secondary Phone Number</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['secondary_phone_number'] ?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Family Details</h3>
          </div>
          <div class="p-6 grid gap-4">
            <div class="grid grid-cols-2 gap-4">
              <div class="grid gap-2">
                <div class="text-sm font-medium">Spouse Name</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['spouse_name'] ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Son count</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['son_count'] ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Daughter count</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['daughter_count'] ?></div>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div class="grid gap-2">
                <div class="text-sm font-medium">Father's Name</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['father_name'] ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Mother's Name</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['mother_name'] ?></div>
              </div>
            </div>
          </div>
        </div>
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Compensation</h3>
          </div>
          <div class="p-6 grid gap-4">
            <div class="grid grid-cols-2 gap-4">
              <div class="grid gap-2">
                <div class="text-sm font-medium">Salary (CTC)</div>
                <div class="text-sm text-muted-foreground"><?php echo $employee['ctc'] ?></div>
              </div>
              <!-- <div class="grid gap-2">
              <div class="text-sm font-medium">Bonus</div>
              <div class="text-sm text-muted-foreground">$5,000 (last year)</div>
            </div> -->
            </div>
            <!-- <div class="grid grid-cols-2 gap-4">
            <div class="grid gap-2">
              <div class="text-sm font-medium">Allowances</div>
              <div class="text-sm text-muted-foreground">$500 (monthly)</div>
            </div>
            <div class="grid gap-2">
              <div class="text-sm font-medium">Deductions</div>
              <div class="text-sm text-muted-foreground">$200 (monthly)</div>
            </div>
          </div> -->
          </div>
        </div>
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Attendance</h3>
          </div>
          <div class="p-6 grid gap-4">
            <div class="grid grid-cols-2 gap-4">
              <div class="grid gap-2">
                <div class="text-sm font-medium">Total Days Worked</div>
                <div class="text-sm text-muted-foreground"><?php echo getTotalWorkedDays($employee['id']) ?></div>
              </div>
              <div class="grid gap-2">
                <div class="text-sm font-medium">Total Leaves Taken</div>
                <div class="text-sm text-muted-foreground"><?php echo (90 - $employee['leave_balance']) ?></div>
              </div>
            </div>
            <!-- <div class="grid grid-cols-2 gap-4">
            <div class="grid gap-2">
              <div class="text-sm font-medium">Overtime Hours</div>
              <div class="text-sm text-muted-foreground">50 hours</div>
            </div>
            <div class="grid gap-2">
              <div class="text-sm font-medium">Attendance Score</div>
              <div class="text-sm text-muted-foreground">95%</div>
            </div>
          </div> -->
          </div>
        </div>
        <div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card">
          <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Education Details</h3>
          </div>
          <div class="p-6 grid gap-4">
            <div class="grid gap-2">
              <div class="text-sm font-medium">Education</div>
              <div class="text-sm text-muted-foreground">
                <?php
                // Decode the education JSON data
                $education_data = json_decode($employee['education'], true);

                // Check if there are any valid education entries
                if (!empty($education_data)) {
                  // Loop through the education data and display non-empty qualifications
                  for ($i = 1; $i <= 2; $i++) {
                    if (!empty($education_data["qualification$i"])) {
                      echo '<div class="mb-4">';
                      echo '<p class="text-lg font-medium">Qualification: ' . htmlspecialchars($education_data["qualification$i"]) . '</p>';
                      echo '<p class="text-base">College: ' . htmlspecialchars($education_data["college$i"]) . '</p>';
                      echo '<p class="text-base">Year: ' . htmlspecialchars($education_data["year$i"]) . '</p>';
                      echo '</div>';
                    }
                  }
                } else {
                  echo '<p>No education details available.</p>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="documentModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
    <div class="p-6 rounded-lg w-full relative">
      <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-3xl blue-border">close</button>
      <div id="modalContent" class="flex flex-col space-y-4">
        <!-- Content will be dynamically inserted here -->
      </div>
    </div>
  </div>
  <div id="messageModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-lg w-full">
      <h3 class="text-lg font-semibold mb-4">Send a Message</h3>
      <form id="messageForm" action="<?php echo base_url('Employees/send_message') ?>" method="POST">
        <textarea id="messageText" name="message" class="w-full h-32 p-2 border border-gray-300 rounded-lg" placeholder="Type your message here..."></textarea>
        <input type="hidden" id="userIdInput" name="user_id" value="">
        <input type="hidden" id="senderId" name="sender_id" value="<?php echo $this->session->userdata('username') ?>">
        <div class="flex justify-end mt-4">
          <button type="submit" class="blue-bg text-white px-4 py-2 rounded-lg">Send</button>
          <button type="button" onclick="closeMessageModal()" class="bg-red-500 text-white px-4 py-2 rounded-lg ml-2">Cancel</button>
        </div>
      </form>
    </div>
  </div>


  <script>
    // Function to open the modal and display content
    function openModal(documentType, documentUrl) {
      const modal = document.getElementById('documentModal');
      const modalContent = document.querySelector('#documentModal > div');

      // Set the content of the modal
      modalContent.innerHTML = `
    <span id="closeModal" style="cursor: pointer;" class="blue-border rounded-lg p-2">close</span>
    <img src="${documentUrl}" alt="${documentType}" class="w-full h-auto max-h-96 object-contain" />
  `;

      modal.style.display = 'flex'; // Show the modal container
      modalContent.style.display = 'block'; // Show the modal content
    }

    // Function to close the modal
    function closeModal() {
      const modal = document.getElementById('documentModal');
      const modalContent = document.querySelector('#documentModal > div');

      modal.style.display = 'none'; // Hide the modal container
      modalContent.style.display = 'none'; // Hide the modal content
    }

    // Event listener for closing the modal when clicking the close button
    document.addEventListener('click', (e) => {
      if (e.target.id === 'closeModal' || e.target === document.getElementById('documentModal')) {
        closeModal();
      }
    });
  </script>
  <script>
    function openMessageModal(userId) {
      // Set the user ID in a data attribute of the modal (if needed)
      const messageModal = document.getElementById('messageModal');
      document.getElementById('userIdInput').value = userId;

      // Show the modal
      messageModal.classList.remove('hidden');
    }

    function closeMessageModal() {
      const messageModal = document.getElementById('messageModal');

      // Hide the modal
      messageModal.classList.add('hidden');
    }
  </script>


<?php } else {
  redirect(base_url());
} ?>
<?php
// Helper function to generate star rating
function generateStarRating($rating) {
  $output = '';
  for ($i = 1; $i <= 5; $i++) {
    if ($i <= $rating) {
      $output .= '<i class="fas fa-star text-yellow-500"></i>';
    } else {
      $output .= '<i class="far fa-star text-yellow-500"></i>';
    }
  }
  return $output;
}
?>