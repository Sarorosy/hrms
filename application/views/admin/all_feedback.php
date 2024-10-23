<div class="rounded-lg border bg-white text-card-foreground shadow-sm" data-v0-t="card"> 
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight">All Feedback for <?php echo $employee['name']; ?></h3>
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
        <?php else: ?>
            <p>No feedback available for this employee.</p>
        <?php endif; ?>
    </div>
</div>
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