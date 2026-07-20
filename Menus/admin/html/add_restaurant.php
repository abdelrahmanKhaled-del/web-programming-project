<!DOCTYPE html>
<html>
<head>
    <title>Add Restaurant</title>
    <link rel="stylesheet" href="../css/add_restaurant.css">
</head>
<body>

<div class="header">
    <h1>Admin - Add Restaurant</h1>
</div>

<div class="container">
    <div class="card">
        <h2>New Restaurant</h2>

        <?php if ($message) echo "<div class='message'>$message</div>"; ?>

        <form method="post" enctype="multipart/form-data" action="../php/add_restaurant.php">
            <input type="text" name="name" placeholder="Restaurant Name" required>
            <input type="file" name="image" required>
            <button type="submit">➕ Add Restaurant</button>
        </form>

        <a href="dashboard.php" class="back">⬅ Back to Dashboard</a>
    </div>
</div>

<div class="list-container">
    <h2>Existing Restaurants</h2>
    <?php if ($result && $result->num_rows > 0) { ?>
        <?php while($row = $result->fetch_assoc()) { ?>
            <div class="restaurant-card">
                <div class="info">
                    <img src="../../images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                    <p><?php echo $row['name']; ?></p>
                </div>
                <a href="../php/add_restaurant.php?delete=<?php echo $row['id']; ?>" 
                   class="delete" 
                   onclick="return confirm('Delete this restaurant?')">🗑 Delete</a>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p class="empty">No restaurants found.</p>
    <?php } ?>
</div>

</body>
</html>
