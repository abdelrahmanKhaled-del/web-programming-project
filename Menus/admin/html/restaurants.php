<?php
$conn = new mysqli("localhost", "root", "", "menus");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, name, image FROM restaurant ORDER BY id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurants</title>
    <link rel="stylesheet" href="../css/restaurants.css">
</head>
<body>

<div class="header">
    <h1>🍽️ Restaurants</h1>
</div>

<div class="container">

    <a href="dashboard.php" class="back-btn">⬅ Back</a>

    <?php if ($result && $result->num_rows > 0): ?>

        <?php while ($row = $result->fetch_assoc()): ?>

            <div class="restaurant-card">

                <div class="info">
                    <img src="/MENUS/images/<?php echo htmlspecialchars($row['image']); ?>" class="logo">

                    <div>
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                        <small>ID: <?php echo $row['id']; ?></small>
                    </div>
                </div>

                <div class="actions">
                    <a href="../php/view_restaurant.php?id=<?php echo (int)$row['id']; ?>" class="view">
                        👀 View Menu
                    </a>
                </div>

            </div>

        <?php endwhile; ?>

    <?php else: ?>
        <p class="empty">No restaurants found.</p>
    <?php endif; ?>

</div>

</body>
</html>