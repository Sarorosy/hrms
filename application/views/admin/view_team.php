<style>
.rating-star {
    font-size: 24px;
    color: #d3d3d3; /* Default color for stars */
    cursor: pointer;
}
.selected-star {
    color: #000034; /* Selected star color */
}
.text-yellow-500 {
  color: #fbbf24; /* Tailwind yellow-500 */
}
.text-gray-400 {
  color: #d1d5db; /* Tailwind gray-400 */
}
</style>

<div class="container mx-auto p-4">
  <h2 class="text-2xl font-bold mb-4">My Team</h2>

  <!-- Display success or error messages -->
  <?php if ($this->session->flashdata('success')) : ?>
  <div class="mb-4">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Success!</strong>
      <span class="block sm:inline"><?php echo $this->session->flashdata('success'); ?></span>
    </div>
  </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')) : ?>
  <div class="mb-4">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Error!</strong>
      <span class="block sm:inline"><?php echo $this->session->flashdata('error'); ?></span>
    </div>
  </div>
  <?php endif; ?>

  <div class="bg-white overflow-hidden shadow-md rounded-lg p-4">
    <table class="min-w-full bg-white">
      <thead class="blue-bg text-white">
        <tr>
        <th class=" px-4 py-2">Profile</th>
          <th class="px-4 py-2">Name</th>
          <th class=" px-4 py-2">Email</th>
          <th class=" px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($employees as $employee) : ?>
        <tr class="bg-gray-100">
        <td class="px-4 py-2 whitespace-no-wrap border-b border-gray-300">
                            <img src="<?php echo base_url('uploads/userdetailuploads/'.get_profile_pic_by_id($employee['id'])) ?>" alt="profile" class="w-10 rounded-full">
                        </td>
          <td class="border px-4 py-2"><?php echo $employee['name']; ?></td>
          <td class="border px-4 py-2"><?php echo $employee['email']; ?></td>
          <td class="border px-4 py-2 text-center">
            <button class="blue-bg text-white font-bold py-2 px-4 rounded"
              onclick="openFeedbackForm(<?php echo $employee['id']; ?>)">Give Feedback</button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Feedback Form Modal -->
  <!-- Feedback Form Modal -->
  <div id="feedbackModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Give Feedback</h3>
                    <form id="feedbackForm" action="<?php echo base_url('Employees/give_feedback'); ?>" method="post">
                        <input type="hidden" id="employee_id" name="employee_id">

                        <!-- Productivity Rating -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Productivity Rating:</label>
                            <div class="flex items-center gap-2" id="productivity_rating_container">
                                <i class="fas fa-star rating-star" data-field="productivity_rating" data-value="1" onclick="setRating('productivity_rating', 1)"></i>
                                <i class="fas fa-star rating-star" data-field="productivity_rating" data-value="2" onclick="setRating('productivity_rating', 2)"></i>
                                <i class="fas fa-star rating-star" data-field="productivity_rating" data-value="3" onclick="setRating('productivity_rating', 3)"></i>
                                <i class="fas fa-star rating-star" data-field="productivity_rating" data-value="4" onclick="setRating('productivity_rating', 4)"></i>
                                <i class="fas fa-star rating-star" data-field="productivity_rating" data-value="5" onclick="setRating('productivity_rating', 5)"></i>
                                <input type="hidden" name="productivity_rating" id="productivity_rating" value="0">
                            </div>
                        </div>

                        <!-- Quality Rating -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Quality Rating:</label>
                            <div class="flex items-center gap-2" id="quality_rating_container">
                                <i class="fas fa-star rating-star" data-field="quality_rating" data-value="1" onclick="setRating('quality_rating', 1)"></i>
                                <i class="fas fa-star rating-star" data-field="quality_rating" data-value="2" onclick="setRating('quality_rating', 2)"></i>
                                <i class="fas fa-star rating-star" data-field="quality_rating" data-value="3" onclick="setRating('quality_rating', 3)"></i>
                                <i class="fas fa-star rating-star" data-field="quality_rating" data-value="4" onclick="setRating('quality_rating', 4)"></i>
                                <i class="fas fa-star rating-star" data-field="quality_rating" data-value="5" onclick="setRating('quality_rating', 5)"></i>
                                <input type="hidden" name="quality_rating" id="quality_rating" value="0">
                            </div>
                        </div>

                        <!-- Punctuality Rating -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Punctuality Rating:</label>
                            <div class="flex items-center gap-2" id="punctuality_rating_container">
                                <i class="fas fa-star rating-star" data-field="punctuality_rating" data-value="1" onclick="setRating('punctuality_rating', 1)"></i>
                                <i class="fas fa-star rating-star" data-field="punctuality_rating" data-value="2" onclick="setRating('punctuality_rating', 2)"></i>
                                <i class="fas fa-star rating-star" data-field="punctuality_rating" data-value="3" onclick="setRating('punctuality_rating', 3)"></i>
                                <i class="fas fa-star rating-star" data-field="punctuality_rating" data-value="4" onclick="setRating('punctuality_rating', 4)"></i>
                                <i class="fas fa-star rating-star" data-field="punctuality_rating" data-value="5" onclick="setRating('punctuality_rating', 5)"></i>
                                <input type="hidden" name="punctuality_rating" id="punctuality_rating" value="0">
                            </div>
                        </div>

                        <!-- Comments -->
                        <div class="mb-4">
                            <label for="comments" class="block text-sm font-medium text-gray-700">Comments:</label>
                            <textarea id="comments" name="comments"
                                      class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                    class="blue-bg text-white font-bold py-2 px-4 rounded">Submit
                                Feedback
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                            onclick="closeFeedbackForm()">Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openFeedbackForm(employeeId) {
    document.getElementById('employee_id').value = employeeId;
    document.getElementById('feedbackModal').classList.remove('hidden');
}

function closeFeedbackForm() {
    document.getElementById('feedbackModal').classList.add('hidden');
}

function setRating(field, value) {
    document.getElementById(field).value = value;
    updateStars(field, value);
}

function updateStars(field, value) {
    const stars = document.querySelectorAll(`.rating-star[data-field="${field}"]`);
    stars.forEach(star => {
        if (star.getAttribute('data-value') <= value) {
            star.classList.add('selected-star');
        } else {
            star.classList.remove('selected-star');
        }
    });
}
</script>