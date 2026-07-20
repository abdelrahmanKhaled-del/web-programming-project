<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>

<div class="header">
    <h1>Admin Dashboard</h1>
    <a href="../html/logout.php" class="logout-btn">🚪 Logout</a>
</div>
<div class="container">
    <div class="card">
        <h2><?php echo $restaurants['total']; ?></h2>
        <p>Restaurants</p>
    </div>

    <div class="card">
        <h2><?php echo $menu['total']; ?></h2>
        <p>Menu Items</p>
    </div>

    <div class="card">
        <h2><?php echo $drivers['total']; ?></h2>
        <p>Drivers</p>
    </div>
</div>

<div class="buttons">
    <a href="add_restaurant.php" class="button">🏪 <span>Manage Restaurants</span></a>
    <a href="restaurants.php" class="button">🍔 <span>Add Menu Item</span></a>
    <a href="drivers.php" class="button">🚚 <span>Manage Drivers</span></a>
    <a href="orders.php" class="button">📦 <span>Manage Orders</span></a>
</div>

</body>
</html>