<div class="flex items-center space-x-4 text-gray-600 bg-white rounded-lg p-2">
    <?php
    $breadcrumbs = generate_breadcrumbs();
    $count = count($breadcrumbs);
    
    // Set the maximum number of breadcrumb levels to display
    $max_depth = 2;
    
    foreach ($breadcrumbs as $index => $breadcrumb) {
        // Display only up to the maximum depth (2 levels: Home and Manage-payroll)
        if ($index < $max_depth) {
            // Check if it is the last item in the allowed depth
            if ($index + 1 === $max_depth) {
                echo '<span class="text-gray-900 font-bold">' . $breadcrumb['title'] . '</span>';
            } else {
                echo '<a href="' . $breadcrumb['url'] . '" class="blue-hover">' . $breadcrumb['title'] . '</a>';
                echo '<span>/</span>';
            }
        }
    }
    ?>
</div>
