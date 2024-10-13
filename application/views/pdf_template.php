<!DOCTYPE html>
<html>
<head>
    <title>Parking Slot Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .card {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Parking Slot Details</h2>
            <p><strong>Name:</strong> <?php echo $slot['name']; ?></p>
            <p><strong>Vehicle Number:</strong> <?php echo $slot['vehicle_number']; ?></p>
            <p><strong>Parking ID:</strong> <?php echo $slot['slot_id']; ?></p>
            <p><strong>Vehicle Type:</strong> <?php echo ucfirst($slot['vehicle_type']); ?></p>
            <p><strong>Date:</strong> <?php echo date('Y-m-d', strtotime($slot['date'])); ?></p>
        </div>
    </div>
</body>
</html>
