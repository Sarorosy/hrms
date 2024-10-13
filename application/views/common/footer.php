</main>
    </div>
    <!-- Footer -->
    <footer class="bg-white p-4 text-center text-black mt-auto">
        <div class="container mx-auto">
            <p>&copy; <?php echo date('Y'); ?><strong> VDA SOLUTIONS</strong> All rights reserved.</p>
        </div>
    </footer>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')): ?>
                toastr.success('<?php echo $this->session->flashdata('success'); ?>');
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                toastr.error('<?php echo $this->session->flashdata('error'); ?>');
            <?php endif; ?>
        });

        // Toggle dropdown menu
        $(document).ready(function(){
            $('.dropdown-toggle').click(function(e){
                e.stopPropagation();
                $('.dropdown-menu').toggleClass('hidden');
            });

            $(document).click(function(){
                $('.dropdown-menu').addClass('hidden');
            });
        });
    </script>
    
    

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(accordion => {
            const btn = accordion.querySelector('.accordion-btn');
            const content = accordion.querySelector('.accordion-content');
            const downIcon = btn.querySelector('#down');
            const upIcon = btn.querySelector('#up');
            
            btn.addEventListener('click', () => {
                content.classList.toggle('show');
                if (content.classList.contains('show')) {
                    downIcon.style.display = "none";
                    upIcon.style.display = "inline"; // Change to "inline" to show the up icon
                } else {
                    downIcon.style.display = "inline"; // Change to "inline" to show the down icon
                    upIcon.style.display = "none";
                }
            });
        });
    });
</script>

<script>
  document.getElementById('offcanvasToggle').addEventListener('click', function() {
    document.getElementById('offcanvasExample').classList.add('show');
  });

  document.getElementById('offcanvasClose').addEventListener('click', function() {
    document.getElementById('offcanvasExample').classList.remove('show');
  });

  document.getElementById('dropdownMenuButton').addEventListener('click', function() {
    this.nextElementSibling.classList.toggle('show');
  });
</script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.jqueryui.min.js"></script>
<script>
    let table = new DataTable('#employees');
    let tabletwo = new DataTable('#leavesummary', {
    order: [[0, 'desc']]  // Assuming 'id' is in the first column (index 0)
});
let tablethree = new DataTable('#leaverequests', {
    order: [[0, 'desc']]  // Assuming 'id' is in the first column (index 0)
});
</script>
</body>
</html>
