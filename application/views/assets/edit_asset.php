<div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-5 text-gray-800">Edit Asset</h1>

    <?php echo form_open('asset/update_asset/' . $asset->assetid); ?>
        <div class="mb-4">
            <label class="block text-gray-700">Asset Name</label>
            <input type="text" name="asset_name" value="<?php echo $asset->assetname; ?>" class="border rounded w-full px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Available</label>
            <input type="number" name="available" value="<?php echo $asset->available; ?>" class="border rounded w-full px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Vacant</label>
            <input type="number" name="vacant" value="<?php echo $asset->vacant; ?>" class="border rounded w-full px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Image cannot be edited</label>
            <img src="<?php echo base_url('uploads/assetimages/'. $asset->assetimage) ?>"class="h-40 w-auto" />
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200">Update Asset</button>
    <?php echo form_close(); ?>
</div>
