<?php if ($this->session->userdata('admin_type') == 'SUPERADMIN' || $this->session->userdata('admin_type') == 'HR') { ?>
    <style>
    .blue-bg {
        background-color: #000034;
    }
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
<!-- Modal for image preview -->
<div id="imageModal" class="modal">
    <span class="close cursor-pointer" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
<div class="container mx-auto p-6 w-full rounded-lg border-top-blue mt-4">
    <h2 class="text-3xl font-bold mb-6 text-center">Edit Employee Details</h2>

    <?php echo validation_errors('<div class="text-red-500 mb-4">', '</div>'); ?>
    <?php echo form_open_multipart('Employees/update_employee/' . $employee['id']); ?>

    <div class="bg-white overflow-hidden shadow-md rounded-lg p-6">
        <ul class="flex border-b">
            <li class="mr-1">
                <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 blue-text font-semibold" href="#personal-details">Personal Details</a>
            </li>
            <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4 blue-text font-semibold" href="#contact-info">Contact Information</a>
            </li>
            <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4 blue-text font-semibold" href="#family-details">Family Details</a>
            </li>
            <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4 blue-text font-semibold" href="#job-details">Job Details</a>
            </li>
            <li class="mr-1">
                <a class="bg-white inline-block py-2 px-4 blue-text font-semibold" href="#document-uploads">Document Uploads</a>
            </li>
        </ul>

        <div id="personal-details" class="tab-content">
            <div class="mb-6">
                <?php if (isset($employee['profile_pic'])) : ?>
                    <div class="flex flex-col items-center space-y-4 mt-2">
                        <div class="space-x-4">
                            <button type="button" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $employee['profile_pic']); ?>')" class="text-white font-bold py-2 px-4 rounded flex items-center space-x-2">
                                <i class="far fa-eye"></i>
                                <span><img src="<?php echo base_url('uploads/userdetailuploads/' . $employee['profile_pic']); ?>" alt="Profile Photo" class="w-32 h-32 object-cover rounded-full" style="border: 2px solid #000034;"></span>
                            </button>
                            <div>
                                <div class="relative cursor-pointer h-10 mx-auto">
                                    <input type="file" id="profile_pic" name="profile_pic" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    <button type="button" class="blue-bg text-white font-bold py-2 px-4 rounded-md w-full text-center"><i class="fas fa-cloud-upload-alt"></i> Change</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="<?php echo set_value('name', $employee['name'] ?? ''); ?>"  class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div class="flex space-x-4 mb-6">
                <div class="w-1/2">
                    <label for="age" class="block text-sm font-bold text-gray-700">Age</label>
                    <input type="number" id="age" name="age" value="<?php echo set_value('age', $employee['age'] ?? ''); ?>"  class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div class="w-1/2">
                    <label for="dob" class="block text-sm font-bold text-gray-700">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="<?php echo set_value('dob', $employee['dob'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
            </div>
            <div class="flex space-x-4 mb-6">
                <div class="w-1/2">
                    <label for="gender" class="block text-sm font-bold text-gray-700">Gender</label>
                    <select id="gender" name="gender" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="Male" <?php echo set_select('gender', 'Male', ($employee['gender'] ?? '') == 'Male'); ?>>Male</option>
                        <option value="Female" <?php echo set_select('gender', 'Female', ($employee['gender'] ?? '') == 'Female'); ?>>Female</option>
                        <option value="Other" <?php echo set_select('gender', 'Other', ($employee['gender'] ?? '') == 'Other'); ?>>Other</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label for="phone_number" class="block text-sm font-bold text-gray-700">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="<?php echo set_value('phone_number', $employee['phone_number'] ?? ''); ?>"  class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
            </div>
            <div class="flex space-x-4 mb-6">
                <div class="w-1/2">
                    <label for="blood_group" class="block text-sm font-bold text-gray-700">Blood Group</label>
                    <select id="blood_group" name="blood_group"  class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="">Select Blood Group</option>
                        <option value="O+" <?php echo set_select('blood_group', 'O+', ($employee['blood_group'] ?? '') == 'O+'); ?>>O+</option>
                        <option value="O-" <?php echo set_select('blood_group', 'O-', ($employee['blood_group'] ?? '') == 'O-'); ?>>O-</option>
                        <option value="A+" <?php echo set_select('blood_group', 'A+', ($employee['blood_group'] ?? '') == 'A+'); ?>>A+</option>
                        <option value="A-" <?php echo set_select('blood_group', 'A-', ($employee['blood_group'] ?? '') == 'A-'); ?>>A-</option>
                        <option value="B+" <?php echo set_select('blood_group', 'B+', ($employee['blood_group'] ?? '') == 'B+'); ?>>B+</option>
                        <option value="B-" <?php echo set_select('blood_group', 'B-', ($employee['blood_group'] ?? '') == 'B-'); ?>>B-</option>
                        <option value="AB+" <?php echo set_select('blood_group', 'AB+', ($employee['blood_group'] ?? '') == 'AB+'); ?>>AB+</option>
                        <option value="AB-" <?php echo set_select('blood_group', 'AB-', ($employee['blood_group'] ?? '') == 'AB-'); ?>>AB-</option>
                    </select>
                </div>
                <div class="w-1/2">
                    <label for="nationality" class="block text-sm font-bold text-gray-700">Nationality</label>
                    <input type="text" id="nationality" name="nationality" value="<?php echo set_value('nationality', $employee['nationality'] ?? ''); ?>"  class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
            </div>
        </div>

        <div id="contact-info" class="tab-content hidden bg-gray-100 p-6 rounded-md">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="personal_email" class="block text-sm font-bold text-gray-700">Personal Email</label>
                        <input type="email" id="personal_email" name="personal_email" value="<?php echo set_value('personal_email', $employee['personal_email'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="marital_status" class="block text-sm font-bold text-gray-700">Marital Status</label>
                        <select id="marital_status" name="marital_status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                            <option value="Single" <?php echo set_select('marital_status', 'Single', ($employee['marital_status'] ?? '') === 'Single'); ?>>Single</option>
                            <option value="Married" <?php echo set_select('marital_status', 'Married', ($employee['marital_status'] ?? '') === 'Married'); ?>>Married</option>
                            <option value="Divorced" <?php echo set_select('marital_status', 'Divorced', ($employee['marital_status'] ?? '') === 'Divorced'); ?>>Divorced</option>
                            <option value="Widowed" <?php echo set_select('marital_status', 'Widowed', ($employee['marital_status'] ?? '') === 'Widowed'); ?>>Widowed</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="address1" class="block text-sm font-bold text-gray-700">Address 1</label>
                        <input type="text" id="address1" name="address1" value="<?php echo set_value('address1', $employee['address1'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="address2" class="block text-sm font-bold text-gray-700">Address 2</label>
                        <input type="text" id="address2" name="address2" value="<?php echo set_value('address2', $employee['address2'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="address3" class="block text-sm font-bold text-gray-700">Address 3</label>
                        <input type="text" id="address3" name="address3" value="<?php echo set_value('address3', $employee['address3'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="city" class="block text-sm font-bold text-gray-700">City</label>
                        <input type="text" id="city" name="city" value="<?php echo set_value('city', $employee['city'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="state" class="block text-sm font-bold text-gray-700">State</label>
                        <input type="text" id="state" name="state" value="<?php echo set_value('state', $employee['state'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-4">
                        <label for="zip_code" class="block text-sm font-bold text-gray-700">Zip Code</label>
                        <input type="text" id="zip_code" name="zip_code" value="<?php echo set_value('zip_code', $employee['zip_code'] ?? ''); ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                    </div>
                </div>
            </div>

        <div id="family-details" class="tab-content hidden bg-gray-100">
        <div class="flex flex-wrap -mx-3">
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label for="father_name" class="block text-sm font-medium text-gray-700">Father's Name</label>
                <input type="text" id="father_name" name="father_name" value="<?php echo set_value('father_name', $employee['father_name'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label for="mother_name" class="block text-sm font-medium text-gray-700">Mother's Name</label>
                <input type="text" id="mother_name" name="mother_name" value="<?php echo set_value('mother_name', $employee['mother_name'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label for="spouse_name" class="block text-sm font-medium text-gray-700">Spouse's Name</label>
                <input type="text" id="spouse_name" name="spouse_name" value="<?php echo set_value('spouse_name', $employee['spouse_name'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label for="marital_status" class="block text-sm font-medium text-gray-700">Marital Status</label>
                <select id="marital_status" name="marital_status" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                    <option value="Single" <?php echo set_select('marital_status', 'Single', ($employee['marital_status'] ?? '') == 'Single'); ?>>Single</option>
                    <option value="Married" <?php echo set_select('marital_status', 'Married', ($employee['marital_status'] ?? '') == 'Married'); ?>>Married</option>
                    <option value="Divorced" <?php echo set_select('marital_status', 'Divorced', ($employee['marital_status'] ?? '') == 'Divorced'); ?>>Divorced</option>
                    <option value="Widowed" <?php echo set_select('marital_status', 'Widowed', ($employee['marital_status'] ?? '') == 'Widowed'); ?>>Widowed</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label for="son_count" class="block text-sm font-medium text-gray-700">Number of Sons</label>
                <input type="number" id="son_count" name="son_count" value="<?php echo set_value('son_count', $employee['son_count'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6">
                <label for="daughter_count" class="block text-sm font-medium text-gray-700">Number of Daughters</label>
                <input type="number" id="daughter_count" name="daughter_count" value="<?php echo set_value('daughter_count', $employee['daughter_count'] ?? ''); ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
            </div>
        </div>
    </div>
    <div id="job-details" class="tab-content hidden">
                <div class="bg-gray-100 p-6 rounded-md">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Employee ID</label>
                            <div class="relative mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2 flex items-center">
                                <span id="employeeId"><?php echo $employee['employee_id'] ?? ''; ?></span>

                                <i class="far fa-copy text-xl bluetext ml-5" onclick="copyToClipboard('#employeeId')"></i>
                            </div>
                        </div>
                        <?php if($employee['role'] === "USER") { ?>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Manager Name</label>
                            <select id="manager_name" name="manager_id" class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white">
                                <option value="">Select Manager</option>
                                <?php foreach ($admins as $admin): ?>
                                    <option value="<?php echo $admin['id']; ?>" 
                                        <?php echo isset($employee['manager_id']) && $employee['manager_id'] == $admin['id'] ? 'selected' : ''; ?>>
                                        <?php echo $admin['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php } ?>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                            <select id="role" name="role" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="USER" <?php echo (isset($employee['role']) && $employee['role'] == 'USER') ? 'selected' : ''; ?>>User</option>
                                <option value="ADMIN" <?php echo (isset($employee['role']) && $employee['role'] == 'ADMIN') ? 'selected' : ''; ?>>Admin</option>
                                <?php if($this->session->userdata("admin_type") == "SUPERADMIN") { ?>
                                <option value="SUPERADMIN" <?php echo (isset($employee['role']) && $employee['role'] == 'SUPERADMIN') ? 'selected' : ''; ?>>Super Admin</option>
                                <?php } ?>
                                <option value="HR" <?php echo (isset($employee['role']) && $employee['role'] == 'HR') ? 'selected' : ''; ?>>HR</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
                            <select id="status" name="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <option value="ACTIVE" <?php echo (isset($employee['status']) && $employee['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                <option value="INACTIVE" <?php echo (isset($employee['status']) && $employee['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>



                         
                        <div class="w-full md:w-1/2 px-3 mb-6">
    <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
    <select id="position" name="position" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <option value="">Select Job Profile</option>
        <?php foreach ($positions as $position): ?>
            <option value="<?php echo $position['id']; ?>" 
                <?php echo isset($employee['position']) && $employee['position'] == $position['id'] ? 'selected' : ''; ?>>
                <?php echo $position['name']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


                        <!-- Joining Date -->
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Joining Date</label>
                            <input type="date" id="joiningDate" name="joining_date" value="<?php echo $employee['joining_date'] ?? ''; ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2">
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">Employment Type</label>
                            <select id="employment_type" name="employment_type" class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white">
                                <option value="Full-time" <?php echo (isset($employee['employment_type']) && $employee['employment_type'] == 'Full-time') ? 'selected' : ''; ?>>Full-time</option>
                                <option value="Part-time" <?php echo (isset($employee['employment_type']) && $employee['employment_type'] == 'Part-time') ? 'selected' : ''; ?>>Part-time</option>
                            </select>
                        </div>

                        <!-- CTC -->
                        <div class="w-full md:w-1/2 px-3 mb-6">
                            <label class="block text-sm font-bold text-gray-700">CTC</label>
                            <input type="number" id="ctc" name="ctc" value="<?php echo $employee['ctc'] ?? ''; ?>" class="mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2">
                        </div>

                        <!-- Official ID -->
                    <div class="w-full md:w-1/2 px-3 mb-6">
                        <label class="block text-sm font-bold text-gray-700">Official Email</label>
                        <div class="relative mt-1 block w-full p-3 border border-gray-300 rounded-md bg-white px-4 py-2 flex items-center">
                            <input id="official_id" type="text" name="email" value="<?php echo $employee['email'] ?? ''; ?>" 
                                class="w-full focus:outline-none bg-transparent" >
                            <i class="far fa-copy text-xl bluetext ml-5" onclick="copyToClipboard('#official_id')"></i>
                        </div>
                    </div>

                    </div>
                </div>
            </div>

        <!-- Documents Tab -->
<div id="document-uploads" class="tab-content hidden bg-gray-100 p-6 rounded-md">
    <h3 class="text-xl font-bold mb-4">Documents</h3>
    
    <!-- Passport -->
    <div class="mb-4">
        <label for="passport_photo" class="block text-sm font-bold text-gray-700">Passport</label>
        <input type="file" id="passport_photo" name="passport_photo" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($employee['passport_photo'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $employee['passport_photo']); ?>')">View Passport</a></p>
        <?php endif; ?>
    </div>
    
    <!-- Aadhar -->
    <div class="mb-4">
        <label for="aadhar" class="block text-sm font-bold text-gray-700">Aadhar</label>
        <input type="file" id="aadhar" name="aadhar" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($employee['aadhar'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $employee['aadhar']); ?>')">View Aadhar</a></p>
        <?php endif; ?>
    </div>
    
    <!-- 10th Marksheet -->
    <div class="mb-4">
        <label for="10th_marksheet" class="block text-sm font-bold text-gray-700">10th Marksheet</label>
        <input type="file" id="10th_marksheet" name="10th_marksheet" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($employee['10th_marksheet'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $employee['10th_marksheet']); ?>')">View 10th Marksheet</a></p>
        <?php endif; ?>
    </div>
    
    <!-- Degree -->
    <div class="mb-4">
        <label for="degree" class="block text-sm font-bold text-gray-700">Degree</label>
        <input type="file" id="degree" name="degree" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($employee['degree'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $employee['degree']); ?>')">View Degree</a></p>
        <?php endif; ?>
    </div>
    
    <!-- Post Graduation -->
    <div class="mb-4">
        <label for="pg" class="block text-sm font-bold text-gray-700">Post Graduation</label>
        <input type="file" id="pg" name="pg" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($employee['pg'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="javascript:void(0);" onclick="openModal('<?php echo base_url('uploads/userdetailuploads/' . $employee['pg']); ?>')">View Post Graduation</a></p>
        <?php endif; ?>
    </div>
    
    <!-- CV -->
    <div class="mb-4">
        <label for="cv" class="block text-sm font-bold text-gray-700">CV (PDF, DOC, etc.)</label>
        <input type="file" id="cv" name="cv" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
        <?php if (isset($employee['cv'])): ?>
            <p class="text-sm text-green-600 mt-2">Uploaded: <a href="<?php echo base_url('uploads/userdetailuploads/' . $employee['cv']); ?>" target="_blank">View CV</a></p>
        <?php endif; ?>
    </div>
</div>
    </div>

    <div class="mt-6 text-center">
        <button type="submit" class="blue-bg text-white font-bold py-3 px-8 rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">Update Employee</button>
    </div>

    </form>
</div>
<?php } ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('ul.flex li a');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                const target = this.getAttribute('href').substring(1);

                tabContents.forEach(content => {
                    if (content.id === target) {
                        content.classList.remove('hidden');
                    } else {
                        content.classList.add('hidden');
                    }
                });

                tabs.forEach(t => {
                    t.classList.remove('border-l', 'border-t', 'border-r', 'rounded-t', 'blue-text');
                    t.classList.add('blue-text', 'blue-text');
                });

                this.classList.add('border-l', 'border-t', 'border-r', 'rounded-t', 'blue-text');
                this.classList.remove('blue-text', 'blue-text');
            });
        });
    });

    
</script>




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