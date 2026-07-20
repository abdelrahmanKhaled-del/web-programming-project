<?php
session_start();

$conn = new mysqli("localhost", "root", "", "menus");

$customer_id = $_SESSION['id'];


$stmt = $conn->prepare("SELECT * FROM orders WHERE customer_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <link rel="stylesheet" href="../css/my_orders.css">
</head>
<body>

<div class="navbar">
    <div>📦 My Orders</div>
    <div><a href="restaurants.php">⬅ Back</a></div>
</div>

<div class="container">

<?php if ($result->num_rows == 0) { ?>
    <p>No orders yet 😢</p>
<?php } ?>

<?php while ($order = $result->fetch_assoc()) { ?>
    <div class="card">
        <h3>Order #<?php echo $order['id']; ?></h3>
        <div class="meta">
            Total: <?php echo $order['total']; ?> EGP <br>
            Date: <?php echo $order['created_at']; ?>
        </div>
        <a class="view" href="order_details.php?order_id=<?php echo $order['id']; ?>">
            View Details
        </a>
    </div>
<?php } ?>

</div>

</body>
</html>

