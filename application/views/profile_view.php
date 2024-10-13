<style>
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1000;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scrolling if needed */
        background-color: rgba(0, 0, 0, 0.7);
        /* Black with opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 800px;
        max-height: 80%;
        margin-top: 25px;
        object-fit: contain;
        /* Ensure image scales properly */
    }

    /* Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #fff;
        font-size: 30px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div class="container mx-auto p-6 w-full  rounded-lg border-top-blue mt-4">
    <h2 class="text-3xl font-bold mb-6 text-center">Profile</h2>
    <?php echo validation_errors('<div class="text-red-500 mb-4">', '</div>'); ?>`
    <?php echo form_open_multipart('profile/save_profile'); ?>

    <div class="flex">
        <!-- Sidebar Navigation -->
        <div class="w-1/4 bg-white p-4 rounded-lg m-2">
            <ul class="space-y-4">
                <li class="p-2 bg-yellow-500 rounded text-center font-bold"><a href="#personal-details" class="tab-linkt" onclick="showTab(event, 'personal-details')">Personal Details</a></li>
                <li class="p-2 bg-gray-300 rounded text-center font-bold"><a href="#contact-details" class="tab-link" onclick="showTab(event, 'contact-details')">Contact Details</a></li>
                <li class="p-2 bg-gray-300 rounded text-center font-bold"><a href="#educational-qualifications" class="tab-link" onclick="showTab(event, 'educational-qualifications')">Educational Qualifications</a></li>
                <li class="p-2 bg-gray-300 rounded text-center font-bold"><a href="#family-details" class="tab-link" onclick="showTab(event, 'family-details')">Family Details</a></li>
                <li class="p-2 bg-gray-300 rounded text-center font-bold"><a href="#job-details" class="tab-link" onclick="showTab(event, 'job-details')">Job Details</a></li>
                <li class="p-2 bg-gray-300 rounded text-center font-bold"><a href="#documents" class="tab-link" onclick="showTab(event, 'documents')">Documents</a></li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="w-3/4 bg-white shadow-lg p-4 m-2 rounded-lg">
            <!-- Personal Details Tab -->
            <div id="personal-details" class="tab-content active p-6 bg-gray-100 rounded-lg shadow-lg">
                <div class="mb-6">

                    <?php if (isset($user['profile_pic'])) : ?>
                        <div class="flex flex-col items-center space-y-4 mt-2">

                            <div class=" space-x-4">
                                <button type="button" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $user['profile_pic']); ?>')" class="text-white font-bold py-2 px-4 rounded flex items-center space-x-2 ">
                                    <i class="far fa-eye"></i> <span><img src="<?php echo base_url('uploads/userdetailuploads/' . $user['profile_pic']); ?>" alt="Profile Photo" class="w-32 h-32 object-cover rounded-full" style="border: 2px solid #000034 ;"></span>
                                </button>
                                <div>
                                    <!-- <label for="profile_pic" class="block text-sm font-medium text-gray-700 mb-2">Profile Picture:</label> -->
                                    <div class="relative cursor-pointer h-10 mx-auto">
                                        <input type="file" id="profile_pic" name="profile_pic" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        <button type="button" class="blue-bg text-white font-bold py-2 px-4 rounded-md w-full text-center"><i class="fas fa-cloud-upload-alt"></i>Change</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-6">
                    <label for="name" class="block text-sm font-bold text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo set_value('name', $user['name'] ?? ''); ?>" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div class="flex space-x-4 mb-6">
                    <div class="w-1/2">
                        <label for="age" class="block text-sm font-bold text-gray-700">Age</label>
                        <input type="number" id="age" name="age" value="<?php echo set_value('age', $user['age'] ?? ''); ?>" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div class="w-1/2">
                        <label for="dob" class="block text-sm font-bold text-gray-700">Date of Birth</label>
                        <input type="date" id="dob" name="dob" value="<?php echo set_value('dob', $user['dob'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>
                <div class="flex space-x-4 mb-6">
                    <div class="w-1/2">
                        <label for="gender" class="block text-sm font-bold text-gray-700">Gender</label>
                        <select id="gender" name="gender" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="Male" <?php echo set_select('gender', 'Male', ($user['gender'] ?? '') == 'Male'); ?>>Male</option>
                            <option value="Female" <?php echo set_select('gender', 'Female', ($user['gender'] ?? '') == 'Female'); ?>>Female</option>
                            <option value="Other" <?php echo set_select('gender', 'Other', ($user['gender'] ?? '') == 'Other'); ?>>Other</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="phone_number" class="block text-sm font-bold text-gray-700">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" value="<?php echo set_value('phone_number', $user['phone_number'] ?? ''); ?>" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>

                <div class="flex space-x-4 mb-6">
                    <div class="w-1/2">
                        <label for="blood_group" class="block text-sm font-bold text-gray-700">Blood Group</label>
                        <select id="blood_group" name="blood_group" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="">Select Blood Group</option>
                            <option value="O+" <?php echo set_select('blood_group', 'O+', ($user['blood_group'] ?? '') == 'O+'); ?>>O+</option>
                            <option value="O-" <?php echo set_select('blood_group', 'O-', ($user['blood_group'] ?? '') == 'O-'); ?>>O-</option>
                            <option value="A+" <?php echo set_select('blood_group', 'A+', ($user['blood_group'] ?? '') == 'A+'); ?>>A+</option>
                            <option value="A-" <?php echo set_select('blood_group', 'A-', ($user['blood_group'] ?? '') == 'A-'); ?>>A-</option>
                            <option value="B+" <?php echo set_select('blood_group', 'B+', ($user['blood_group'] ?? '') == 'B+'); ?>>B+</option>
                            <option value="B-" <?php echo set_select('blood_group', 'B-', ($user['blood_group'] ?? '') == 'B-'); ?>>B-</option>
                            <option value="AB+" <?php echo set_select('blood_group', 'AB+', ($user['blood_group'] ?? '') == 'AB+'); ?>>AB+</option>
                            <option value="AB-" <?php echo set_select('blood_group', 'AB-', ($user['blood_group'] ?? '') == 'AB-'); ?>>AB-</option>
                        </select>
                    </div>
                    <div class="w-1/2">
                        <label for="nationality" class="block text-sm font-bold text-gray-700">Nationality</label>
                        <input type="text" id="nationality" name="nationality" value="<?php echo set_value('nationality', $user['nationality'] ?? ''); ?>" required class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>

            </div>

            <!-- Contact Details Tab -->
            <div id="contact-details" class="tab-content hidden bg-gray-100 p-6 rounded-md">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="personal_email" class="block text-sm font-bold text-gray-700">Personal Email</label>
                        <input type="email" id="personal_email" name="personal_email" value="<?php echo set_value('personal_email', $user['personal_email'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="marital_status" class="block text-sm font-bold text-gray-700">Marital Status</label>
                        <select id="marital_status" name="marital_status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            <option value="Single" <?php echo set_select('marital_status', 'Single', ($user['marital_status'] ?? '') === 'Single'); ?>>Single</option>
                            <option value="Married" <?php echo set_select('marital_status', 'Married', ($user['marital_status'] ?? '') === 'Married'); ?>>Married</option>
                            <option value="Divorced" <?php echo set_select('marital_status', 'Divorced', ($user['marital_status'] ?? '') === 'Divorced'); ?>>Divorced</option>
                            <option value="Widowed" <?php echo set_select('marital_status', 'Widowed', ($user['marital_status'] ?? '') === 'Widowed'); ?>>Widowed</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="address1" class="block text-sm font-bold text-gray-700">Address 1</label>
                        <input type="text" id="address1" name="address1" value="<?php echo set_value('address1', $user['address1'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="address2" class="block text-sm font-bold text-gray-700">Address 2</label>
                        <input type="text" id="address2" name="address2" value="<?php echo set_value('address2', $user['address2'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="address3" class="block text-sm font-bold text-gray-700">Address 3</label>
                        <input type="text" id="address3" name="address3" value="<?php echo set_value('address3', $user['address3'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="city" class="block text-sm font-bold text-gray-700">City</label>
                        <input type="text" id="city" name="city" value="<?php echo set_value('city', $user['city'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="state" class="block text-sm font-bold text-gray-700">State</label>
                        <input type="text" id="state" name="state" value="<?php echo set_value('state', $user['state'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="zip_code" class="block text-sm font-bold text-gray-700">Zip Code</label>
                        <input type="text" id="zip_code" name="zip_code" value="<?php echo set_value('zip_code', $user['zip_code'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                </div>
            </div>


            <!-- Educational Qualifications Tab -->
            <div id="educational-qualifications" class="tab-content hidden bg-gray-100 p-2">
                <!-- First Educational Qualification -->
                <div class="mb-4">
                    <label for="qualification1" class="block text-sm font-bold text-gray-700">Qualification 1</label>
                    <input type="text" id="qualification1" name="qualification1" 
                        value="<?php echo set_value('qualification1', $user['education']['qualification1'] ?? ''); ?>" 
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" 
                        placeholder="e.g., Bachelors of Science">
                </div>
                <div class="mb-4">
                    <label for="college1" class="block text-sm font-bold text-gray-700">College / University 1</label>
                    <input type="text" id="college1" name="college1" 
                        value="<?php echo set_value('college1', $user['education']['college1'] ?? ''); ?>" 
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" 
                        placeholder="e.g., Harvard University">
                </div>
                <div class="mb-4">
                    <label for="year1" class="block text-sm font-bold text-gray-700">Year of Passing 1</label>
                    <input type="number" id="year1" name="year1" 
                        value="<?php echo set_value('year1', $user['education']['year1'] ?? ''); ?>" 
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" 
                        placeholder="e.g., 2020">
                </div>

                <!-- Optional Second Educational Qualification -->
                <div class="mb-4">
                    <label for="qualification2" class="block text-sm font-bold text-gray-700">Qualification 2 (Optional)</label>
                    <input type="text" id="qualification2" name="qualification2" 
                        value="<?php echo set_value('qualification2', $user['education']['qualification2'] ?? ''); ?>" 
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" 
                        placeholder="e.g., Masters of Arts">
                </div>
                <div class="mb-4">
                    <label for="college2" class="block text-sm font-bold text-gray-700">College / University 2 (Optional)</label>
                    <input type="text" id="college2" name="college2" 
                        value="<?php echo set_value('college2', $user['education']['college2'] ?? ''); ?>" 
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" 
                        placeholder="e.g., Oxford University">
                </div>
                <div class="mb-4">
                    <label for="year2" class="block text-sm font-bold text-gray-700">Year of Passing 2 (Optional)</label>
                    <input type="number" id="year2" name="year2" 
                        value="<?php echo set_value('year2', $user['education']['year2'] ?? ''); ?>" 
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md" 
                        placeholder="e.g., 2018">
                </div>
            </div>




            <div id="family-details" class="tab-content hidden bg-gray-100">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="father_name" class="block text-sm font-medium text-gray-700">Father's Name</label>
                        <input type="text" id="father_name" name="father_name" value="<?php echo set_value('father_name', $user['father_name'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="mother_name" class="block text-sm font-medium text-gray-700">Mother's Name</label>
                        <input type="text" id="mother_name" name="mother_name" value="<?php echo set_value('mother_name', $user['mother_name'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="spouse_name" class="block text-sm font-medium text-gray-700">Spouse's Name</label>
                        <input type="text" id="spouse_name" name="spouse_name" value="<?php echo set_value('spouse_name', $user['spouse_name'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="marital_status" class="block text-sm font-medium text-gray-700">Marital Status</label>
                        <select id="marital_status" name="marital_status" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <option value="Single" <?php echo set_select('marital_status', 'Single', ($user['marital_status'] ?? '') == 'Single'); ?>>Single</option>
                            <option value="Married" <?php echo set_select('marital_status', 'Married', ($user['marital_status'] ?? '') == 'Married'); ?>>Married</option>
                            <option value="Divorced" <?php echo set_select('marital_status', 'Divorced', ($user['marital_status'] ?? '') == 'Divorced'); ?>>Divorced</option>
                            <option value="Widowed" <?php echo set_select('marital_status', 'Widowed', ($user['marital_status'] ?? '') == 'Widowed'); ?>>Widowed</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="son_count" class="block text-sm font-medium text-gray-700">Number of Sons</label>
                        <input type="number" id="son_count" name="son_count" value="<?php echo set_value('son_count', $user['son_count'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label for="daughter_count" class="block text-sm font-medium text-gray-700">Number of Daughters</label>
                        <input type="number" id="daughter_count" name="daughter_count" value="<?php echo set_value('daughter_count', $user['daughter_count'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    </div>
                </div>
            </div>

            <!-- Job Details Tab -->
            <div id="job-details" class="tab-content hidden">
                <div class="bg-gray-100 p-6 rounded-md">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Employee ID</label>
                            <div class="relative mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2 flex items-center">
                                <span id="employeeId"><?php echo $user['employee_id'] ?? ''; ?></span>

                                <i class="far fa-copy text-xl bluetext ml-5" onclick="copyToClipboard('#employeeId')"></i>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Manager Name</label>
                            <p class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2"><?php echo getAdminNameById($user['manager_id']) ?? 'Not Defined'; ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Official ID</label>
                            <p class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2"><?php echo $user['email'] ?? ''; ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Position</label>
                            <p class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2">
                                <?php 
                                    // Check for admin_type session value
                                    if ($this->session->userdata('admin_type') == 'SUPERADMIN') {
                                        echo 'SUPERADMIN';
                                    } elseif ($this->session->userdata('admin_type') == 'ADMIN') {
                                        echo 'ADMINISTRATOR';
                                    } elseif ($this->session->userdata('admin_type') == 'HR') {
                                        echo 'HR';
                                    } elseif (!empty($user['position']) && is_numeric($user['position'])) {
                                        // If user has a position and it's an integer, get position name by ID
                                        echo getPositionById($user['position']);
                                    } else {
                                        // Default if no conditions match
                                        echo 'No position assigned';
                                    }
                                ?>
                            </p>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Joining Date</label>
                            <p class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2"><?php echo $user['joining_date'] ?? 'Not Defined'; ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Work Location</label>
                            <p class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2"><?php echo $user['work_location'] ?? 'Not Defined'; ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Employment Type</label>
                            <p class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2"><?php echo $user['employment_type'] ?? 'Not Defined'; ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Leave Balance</label>
                            <p class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2"><?php echo $user['leave_balance'] ?? '90'; ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">CTC</label>
                            <p class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2"><?php echo $user['ctc'] ?? ''; ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Official Id</label>
                            <div class="relative mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2 flex items-center">
                                <span id="official_id"><?php echo $user['email'] ?? ''; ?></span>

                                <i class="far fa-copy text-xl bluetext ml-5" onclick="copyToClipboard('#official_id')"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
<div id="documents" class="tab-content hidden bg-gray-100 p-6 rounded-md">
    <h3 class="text-xl font-bold mb-4">Documents</h3>
    
    <!-- Passport -->
    <div class="mb-4">
        <label for="passport" class="block text-sm font-bold text-gray-700">Passport</label>
        <input type="file" id="passport" name="passport_photo" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($user['passport_photo'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $user['passport_photo']); ?>')">View Passport</a></p>
        <?php endif; ?>
    </div>
    
    <!-- Aadhar -->
    <div class="mb-4">
        <label for="aadhar" class="block text-sm font-bold text-gray-700">Aadhar</label>
        <input type="file" id="aadhar" name="aadhar" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($user['aadhar'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $user['aadhar']); ?>')">View Aadhar</a></p>
        <?php endif; ?>
    </div>
    
    <!-- 10th Marksheet -->
    <div class="mb-4">
        <label for="marksheet_10th" class="block text-sm font-bold text-gray-700">10th Marksheet</label>
        <input type="file" id="marksheet_10th" name="10th_marksheet" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($user['10th_marksheet'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $user['10th_marksheet']); ?>')">View 10th Marksheet</a></p>
        <?php endif; ?>
    </div>
    
    <!-- Degree -->
    <div class="mb-4">
        <label for="degree" class="block text-sm font-bold text-gray-700">Degree</label>
        <input type="file" id="degree" name="degree_certificate" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($user['degree_certificate'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $user['degree_certificate']); ?>')">View Degree</a></p>
        <?php endif; ?>
    </div>
    
    <!-- Post Graduation -->
    <div class="mb-4">
        <label for="pg" class="block text-sm font-bold text-gray-700">Post Graduation</label>
        <input type="file" id="pg" name="pg_certificate" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($user['pg_certificate'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $user['pg_certificate']); ?>')">View Post Graduation</a></p>
        <?php endif; ?>
    </div>
    
    <!-- CV -->
    <div class="mb-4">
        <label for="cv" class="block text-sm font-bold text-gray-700">CV (PDF, DOC, etc.)</label>
        <input type="file" id="cv" name="cv" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($user['cv'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a target="_blank" href='<?php echo base_url('uploads/userdetailuploads/' . $user['cv']); ?>'>View CV</a></p>
        <?php endif; ?>
    </div>
</div>

        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="blue-bg  text-white font-bold p-2 rounded mt-4"><i class="fas fa-save"></i> Save Profile</button>
    </div>
    <?php echo form_close(); ?>
</div>
<div class="bg-gray-100 rounded-lg p-6 mt-6 mx-auto max-w-3xl border-top-blue">
    <h2 class="text-2xl font-bold mb-4">Change Password</h2>

    <?php echo form_open('profile/reset_password'); ?>

    <div class="mb-4">
        <label for="new_password" class="block text-sm font-bold text-gray-700">New Password</label>
        <input type="password" id="new_password" name="new_password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
    </div>

    <div class="mb-4">
        <label for="confirm_password" class="block text-sm font-bold text-gray-700">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
    </div>

    <div class="text-center">
        <button type="submit" class="blue-bg text-white font-bold py-2 px-4 rounded"><i class="fas fa-save mr-2"></i>Save Password</button>
    </div>

    <?php echo form_close(); ?>

</div>

<!-- Modal for image preview -->
<div id="imageModal" class="modal">
    <span class="close cursor-pointer" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>


<script>
    // Open modal with image
    function openModal(imageUrl) {
        var modal = document.getElementById('imageModal');
        var modalImg = document.getElementById("modalImage");
        modal.style.display = "block";
        modalImg.src = imageUrl;
    }

    // Close modal
    function closeModal() {
        var modal = document.getElementById('imageModal');
        modal.style.display = "none";
    }
</script>
<!-- JavaScript for Tab Switching -->
<script>
    function showTab(event, tabId) {
        event.preventDefault();
        var tabLinks = document.getElementsByClassName('tab-link');
        var tabContents = document.getElementsByClassName('tab-content');

        for (var i = 0; i < tabLinks.length; i++) {
            tabLinks[i].classList.remove('active');
        }

        for (var i = 0; i < tabContents.length; i++) {
            tabContents[i].classList.add('hidden');
        }

        document.getElementById(tabId).classList.remove('hidden');
        event.currentTarget.classList.add('active');
    }

    // Default tab
    // document.getElementsByClassName('tab-link')[2].click();
</script>
<script>
    function copyToClipboard(element) {
        const copyText = document.querySelector(element).textContent;
        navigator.clipboard.writeText(copyText)
            .then(() => {
                toastr.success('Copied to clipboard');
            })
            .catch(err => {
                console.error('Failed to copy: ', err);
            });
    }
</script>