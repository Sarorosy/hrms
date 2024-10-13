<?php if (!empty($complaints)) : ?>
    <table class="w-full caption-bottom text-sm bg-white rounded">
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
                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0"><?php echo $complaint->happened_at; ?></td>
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