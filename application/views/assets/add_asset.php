<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Add New Asset</h1>

    <?php echo form_open_multipart('asset/save_asset'); ?>
    <div class="mb-4">
        <label for="asset_name" class="block text-gray-700">Asset Name</label>
        <input type="text" name="asset_name" id="asset_name" class="mt-1 block w-full border border-gray-300 rounded p-2" required>
    </div>
    <div class="mb-4">
        <label for="assetimage" class="block text-gray-700">Asset Image</label>
        <input type="file" name="assetimage" id="assetimage" class="mt-1 block w-full border border-gray-300 rounded p-2" required>
    </div>
    <div class="mb-4">
        <label for="available" class="block text-gray-700">Total Available</label>
        <input type="number" name="available" id="available" class="mt-1 block w-full border border-gray-300 rounded p-2" required min="0">
    </div>
    <div class="mb-4">
        <label for="vacant" class="block text-gray-700">Total Vacant</label>
        <input type="number" name="vacant" id="vacant" class="mt-1 block w-full border border-gray-300 rounded p-2" required min="0">
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Asset</button>
    <?php echo form_close(); ?>
</div>
