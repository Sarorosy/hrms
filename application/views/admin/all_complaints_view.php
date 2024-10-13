<div class="flex flex-col gap-4 p-4 md:p-6">
  <div class="flex flex-col gap-4 md:flex-row md:items-center">
    <div class="relative flex-1">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground">
        <circle cx="11" cy="11" r="8"></circle>
        <path d="m21 21-4.3-4.3"></path>
      </svg>
      <input id="search" class="flex h-10 border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full rounded-lg bg-background pl-8 md:w-[300px]" placeholder="Search complaints..." type="search" name="search" value="<?php echo $this->input->get('search'); ?>" />
    </div>
    <div class="flex flex-col gap-2 md:flex-row md:gap-4">
      <div class="grid gap-2">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="user_id">User ID</label>
        <input id="user_id" class="flex h-10 border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full rounded-lg bg-background" type="text" name="user_id" value="<?php echo $this->input->get('user_id'); ?>" />
      </div>
      <div class="grid gap-2">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="subject">Subject</label>
        <input id="subject" class="flex h-10 border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full rounded-lg bg-background" type="text" name="subject" value="<?php echo $this->input->get('subject'); ?>" />
      </div>
      <div class="grid gap-2">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="start_date">Start Date</label>
        <input id="start_date" class="flex h-10 border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full rounded-lg bg-background" type="date" name="start_date" value="<?php echo $this->input->get('start_date'); ?>" />
      </div>
      <div class="grid gap-2">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="end_date">End Date</label>
        <input id="end_date" class="flex h-10 border border-input px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 w-full rounded-lg bg-background" type="date" name="end_date" value="<?php echo $this->input->get('end_date'); ?>" />
      </div>
    </div>
  </div>
  <div class="rounded-lg border bg-card bg-white roundedtext-card-foreground shadow-lg" data-v0-t="card">
    <div class="flex flex-col space-y-1.5 p-6">
      <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">Employee Complaints</h3>
      <p class="text-sm text-muted-foreground">View and manage all employee complaints</p>
    </div>
    <div id="complaints-container" class="p-6 ">
      <!-- Complaints table will be dynamically updated here -->
      <?php if (!empty($complaints)) : ?>
        <table class="w-full caption-bottom text-sm">
          <thead class="[&amp;_tr]:border-b">
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 cursor-pointer">User ID</th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 cursor-pointer">Subject</th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 cursor-pointer">Description</th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 cursor-pointer">Happened At</th>
              <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 cursor-pointer">Action</th>
            </tr>
          </thead>
          <tbody class="[&amp;_tr:last-child]:border-0">
            <?php foreach($complaints as $complaint): ?>
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?php echo $complaint->user_id; ?></td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?php echo $complaint->subject; ?></td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?php echo $complaint->description; ?></td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?php echo strdate($complaint->happened_at); ?></td>
              <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                    <form method="post" action="<?php echo site_url('complaints/take_action/'.$complaint->complaint_id); ?>" class="flex w-full mb-2">
                    <input class="border border-input px-3 py-2 text-sm ring-offset-background w-2/3 rounded-lg bg-background" type="text" name="action" placeholder="Enter action taken">
                    <button class="blue-bg text-white px-4 py-2 rounded-md mt-2 w-1/3 ml-2" type="submit">Submit</button>
                    </form>
                     <!-- Display message if action has been taken -->
                     <?php if (!empty($complaint->admin_action)): ?>
                        <strong class="text-green-600 mt-2">Action Taken: <?php echo htmlspecialchars($complaint->admin_action); ?></strong>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No complaints found.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
document.querySelectorAll('#search, #user_id, #subject, #start_date, #end_date').forEach(input => {
  input.addEventListener('change', filterComplaints);
});

function filterComplaints() {
  const search = document.getElementById('search').value;
  const user_id = document.getElementById('user_id').value;
  const subject = document.getElementById('subject').value;
  const start_date = document.getElementById('start_date').value;
  const end_date = document.getElementById('end_date').value;

  const url = `<?php echo site_url('complaints/filter_complaints'); ?>?search=${search}&user_id=${user_id}&subject=${subject}&start_date=${start_date}&end_date=${end_date}`;

  fetch(url)
    .then(response => response.text())
    .then(data => {
      document.getElementById('complaints-container').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
</script>
