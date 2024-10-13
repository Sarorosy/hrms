<div class="flex items-center space-x-4 text-gray-600 bg-white rounded-lg p-2">
    <?php
    $breadcrumbs = generate_breadcrumbs();
    $count = count($breadcrumbs);
    foreach ($breadcrumbs as $index => $breadcrumb) {
        if ($index + 1 === $count) {
            echo '<span class="text-gray-900 font-bold">' . $breadcrumb['title'] . '</span>';
        } else {
            echo '<a href="' . $breadcrumb['url'] . '" class="blue-hover">' . $breadcrumb['title'] . '</a>';
            echo '<span>/</span>';
        }
    }
    ?>
</div>
