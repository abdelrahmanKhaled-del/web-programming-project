<?php
session_start();

$conn = new mysqli("localhost", "root", "", "menus");
$result = $conn->query("SELECT * FROM restaurant");
?>

<!DOCTYPE html>
<html>
<head>
<title>Restaurants</title>

<link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div class="navbar">

    <div style="display:flex; align-items:center; gap:10px;">
       <img src="../images/logo.png" style="height:60px; width:auto; border-radius:6px;">
        <span>MENUS</span>
    </div>

    <div class="nav-links">
        <?php echo $_SESSION['name']; ?> |

        <a href="my_orders.php">📦 My Orders</a>
        <a href="cart.php">🛒 Cart</a>

        <a href="logout.php" class="logout-btn">🚪 Logout</a>
    </div>

</div>

<div class="wrapper">

<div class="hero">
    <h1>Find Your Favorite Food</h1>
    <p>Choose from top restaurants near you</p>
</div>

<div class="search-box">
    <input type="text" placeholder="Search restaurants...">
</div>
<div class="container">

<?php while($row = $result->fetch_assoc()) { ?>

<a href="menu.php?restaurant_id=<?php echo $row['id']; ?>" class="card">

    <img src="../images/<?php echo $row['image'] ? $row['image'] : 'default.jpg'; ?>">

    <div class="card-content">
        <h3><?php echo $row['name']; ?></h3>
        <p><?php echo $row['location']; ?></p>

        <div class="meta">⭐ 4.5 • 30-40 min</div>
    </div>

</a>

<?php } ?>

</div>

</div>

</body>
</html>