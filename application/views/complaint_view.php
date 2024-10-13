<div class="flex h-screen">
        <div class="flex-1 bg-background flex items-center justify-center h-full">
            <div class="rounded-lg border bg-white text-gray-800 shadow-sm w-full max-w-4xl mx-4" data-v0-t="card">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Submit a Complaint</h3>
                    <p class="text-sm text-gray-500">Help us address your concerns by providing the details below.</p>
                </div>
                <div class="p-6 flex flex-col space-y-2">
                <div class="mb-4 p-4 bg-blue-100 text-blue-700 rounded-md">
                        <p class="text-sm"><i class="far fa-thumbs-up"></i> Feel free to complain. Your complaints are kept private and action will be taken.</p>
                    </div>
                    <?php echo form_open('Complaints/submit_complaint'); ?>
                    <div class="flex flex-col space-y-2">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="subject">Subject</label>
                        <input class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-background placeholder:text-gray-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="subject" name="subject" placeholder="Enter the subject of your complaint" />
                        <?php echo form_error('subject'); ?>
                    </div>
                    <div class="flex w-full justify-around mt-4">
                    <div class="flex flex-col space-y-2 w-2/3 mx-1">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="user-type">User Type</label>
                        <select class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-background placeholder:text-gray-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="user-type" name="user_type">
                            <option value="">Select user type</option>
                            <option value="user">User</option>
                            <option value="co_employee">Co-Employee</option>
                            <option value="hr">HR</option>
                            <option value="manager">Manager</option>
                        </select>
                        <?php echo form_error('user_type'); ?>
                    </div>
                    <div class="flex flex-col space-y-2 w-1/3 mx-1">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="happened_at">Date of Incident</label>
                        <input type="date" class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-background placeholder:text-gray-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="happened_at" name="happened_at" />
                        <?php echo form_error('happened_at'); ?>
                    </div>
                    </div>
                    <div class="flex flex-col space-y-2 mt-4">
                        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="description">Description</label>
                        <textarea class="flex min-h-[80px] w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-background placeholder:text-gray-400 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" id="description" name="description" placeholder="Provide details about your complaint" rows=5 ></textarea>
                        <?php echo form_error('description'); ?>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button class="blue-bg text-white px-4 py-2 rounded-md" type="submit">Submit</button>
                    </div>
                    <?php echo form_close(); ?>
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="bg-green-500 text-white p-4 rounded-md mt-4">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>