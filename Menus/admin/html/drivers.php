<!DOCTYPE html>
<html>
<head>
    <title>Manage Drivers</title>
    <link rel="stylesheet" href="../css/drivers.css">
</head>
<body>

<div class="header">
    <h1>🚚 Manage Drivers</h1>
</div>

<div class="container">
    <a href="dashboard.php" class="back">⬅ Back to Dashboard</a>

    <div class="form-box">
        <h3>Add New Driver</h3>
        <?php if ($message) echo "<div class='message'>$message</div>"; ?>
        <form method="post" action="../php/drivers.php">
            <input type="text" name="name" placeholder="Driver Name" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <button type="submit">➕ Add Driver</button>
        </form>
    </div>
    <h2>Existing Drivers</h2>

    <?php while($row = $result->fetch_assoc()) { ?>
        <div class="card">
            <div class="info">
                <div class="name"><?php echo $row['name']; ?></div>
                <div class="phone"><?php echo $row['phone']; ?></div>
            </div>
            <a class="delete"
               href="delete_driver.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Delete this driver?')">
               Delete
            </a>
        </div>
    <?php } ?>

</div>

</body>
</html>
